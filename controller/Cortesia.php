<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Para depuração, é útil ver o que está chegando.
// var_dump($_POST);

// --- PASSO 1: Obter dados gerais que são os mesmos para todos os participantes ---
$cnpj = $_POST['geral']['CNPJ'];
$empresa = $_POST['geral']['empresa'];
$termos = $_POST['geral']['exampleCheck1'];
$participantes = $_POST['participantes']; // Este é o array de participantes

// Validação básica para garantir que há participantes para inserir
if (empty($participantes)) {
    // Definir uma mensagem de erro e redirecionar de volta
    $_SESSION['form_feedback'] = [
        'status' => 'error',
        'message' => 'Nenhum participante foi enviado. Por favor, preencha os dados.'
    ];
    header("Location: " . $_SERVER['HTTP_REFERER']); // Redireciona para a página anterior
    exit(); // Encerra o script
}


// --- PASSO 2: Encontrar ou criar a empresa UMA VEZ ---
$empresa_id = null; // Inicializa a variável do ID da empresa
$buscaEmpresa = DB::getUm("empresas", ['where' => ['cnpj' => $cnpj]]);

if ($buscaEmpresa === false) {
    // A empresa não existe, vamos inseri-la.
    // Usamos os dados do PRIMEIRO participante para o 'nome_boleto' e 'email_boleto'.
    $primeiro_participante = $participantes[0];

    $empresa_id = DB::insert("empresas", [
        'cnpj' => $cnpj,
        'razao_social' => $empresa,
        'nome_boleto' => $primeiro_participante['nome'], // Contato principal para o boleto
        'email_boleto' => $primeiro_participante['email'] // E-mail principal para o boleto
    ]);
} else {
    // A empresa já existe, apenas usamos o ID dela.
    $empresa_id = $buscaEmpresa->id;
}


// --- PASSO 3: Iterar sobre os participantes e inseri-los ---
if ($empresa_id) {
    $ids_inseridos = [];
    $todos_inseridos_com_sucesso = true;

    // Loop através de cada participante enviado pelo formulário
    foreach ($participantes as $participante) {
        $insertColab = DB::insert("participantes", [
            'empresa_id' => $empresa_id,
            'nome' => $participante['nome'],
            'email' => $participante['email'],
            'telefone' => $participante['telefone'],
            'cargo' => $participante['cargo'],
            'preco_inscricao' => 0.00,
            'lote_inscricao' => 1,
            'termos_aceitos' => (int) $termos,
            'data_inscricao' => date("Y-m-d H:i:s"),
            'status' => 5
        ]);

        if ($insertColab) {
            // Se a inserção for bem-sucedida, armazena o ID do novo participante
            $ids_inseridos[] = $insertColab;
        } else {
            // Se uma inserção falhar, marcamos que houve um erro e paramos o loop
            $todos_inseridos_com_sucesso = false;
            break; 
        }
    }

    // --- PASSO 4: Redirecionar com base no resultado final ---
    if ($todos_inseridos_com_sucesso && !empty($ids_inseridos)) {
        // Sucesso: todos os participantes foram inseridos
        $_SESSION['form_feedback'] = [
            'status' => 'success',
            'message' => "Inscrição de " . count($ids_inseridos) . " colaborador(es) realizada com sucesso!",
            'pids'    => $ids_inseridos // Passa a lista completa de IDs
        ];
        header("location: obrigado");
        exit();
    } else {
        // Erro: falha ao inserir a empresa ou um dos participantes
        $_SESSION['form_feedback'] = [
            'status' => 'error',
            'message' => 'Ocorreu um erro ao processar uma ou mais inscrições. Por favor, tente novamente.'
        ];
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

} else {
    // Erro crítico: não foi possível obter um ID para a empresa (nem criando, nem buscando)
    $_SESSION['form_feedback'] = [
        'status' => 'error',
        'message' => 'Ocorreu um erro ao registrar os dados da empresa. A inscrição não pôde ser concluída.'
    ];
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>