<?php
// --- INÍCIO DO SCRIPT DE PROCESSAMENTO ---

// 1. INICIA A SESSÃO OBRIGATORIAMENTE NO TOPO
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. INCLUI DEPENDÊNCIAS E CONFIGURAÇÕES
require_once 'model/db.class.php'; // Ajuste o caminho
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // DEV only

// --- Constantes de Tabelas ---
define('TABLE_EMPRESAS', 'empresas');
define('TABLE_PARTICIPANTES', 'participantes');
define('TABLE_ASSOCIADOS', 'cnpj'); // <<< MUDE AQUI

// --- Configurações de Preço e Lotes ---
$precoBaseAssociado = 200.00;
$precoBaseNaoAssociado = 400.00;
$dataLimiteLote1Str = '2025-06-06 23:59:59';
$dataLimiteLote2Str = '2025-06-18 23:59:59';
$dataLimiteLote3Str = '2025-07-11 23:59:59';
$percentualAumentoLote2 = 10;
$percentualAumentoLote3 = 20;
$percentualAumentoLote4 = 30;

// --- Funções Auxiliares ---
function limparNumerosPhp($valor)
{
    return preg_replace('/[^0-9]/', '', (string)$valor);
}
function calcularPrecoFinalServer($precoBase)
{
    global $dataLimiteLote1Str, $dataLimiteLote2Str, $dataLimiteLote3Str,
        $percentualAumentoLote2, $percentualAumentoLote3, $percentualAumentoLote4;
    $hojeStr = date('Y-m-d H:i:s');
    $precoCalculado = $precoBase;
    $loteNumero = 1;
    $percentualAumento = 0;
    if ($hojeStr <= $dataLimiteLote1Str) {
        $loteNumero = 1;
        $percentualAumento = 0;
    } elseif ($hojeStr <= $dataLimiteLote2Str) {
        $loteNumero = 2;
        $percentualAumento = $percentualAumentoLote2;
    } elseif ($hojeStr <= $dataLimiteLote3Str) {
        $loteNumero = 3;
        $percentualAumento = $percentualAumentoLote3;
    } else {
        $loteNumero = 4;
        $percentualAumento = $percentualAumentoLote4;
    }
    $precoCalculado = round($precoBase * (1 + $percentualAumento / 100), 2);
    return ['preco' => $precoCalculado, 'lote' => $loteNumero];
}
function redirect_with_feedback($url, $feedback_data)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['form_feedback'] = $feedback_data;
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    header('Location: ' . $url);
    exit;
}

// 3. VERIFICA MÉTODO POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_feedback('individual', ['status' => 'general_error', 'message' => 'Método não permitido.']);
}

// 4. INICIALIZA VARIÁVEIS
$errosValidacaoGeral = [];
$errosValidacaoParticipantes = [];
$dadosGeraisPost = $_POST['geral'] ?? [];
$dadosParticipantesPost = $_POST['participantes'] ?? [];
$pdo = null; // Para usar no finally se necessário

// 5. OBTÉM CONEXÃO E INICIA TRANSAÇÃO
try {
    $pdo = DB::connect();
    if (!$pdo) {
        throw new Exception("Falha crítica na conexão com o banco de dados.");
    }
    $pdo->beginTransaction(); // << INICIA A TRANSAÇÃO >>

    // 6. COLETA E VALIDAÇÃO DE DADOS GERAIS
    $cnpj = limparNumerosPhp($dadosGeraisPost['CNPJ'] ?? '');
    $empresa = trim($dadosGeraisPost['empresa'] ?? '');
    // ... (coleta e valida TODOS os campos gerais como antes) ...
    $site = trim($dadosGeraisPost['site'] ?? '');
    $cep = limparNumerosPhp($dadosGeraisPost['cep'] ?? '');
    $logradouro = trim($dadosGeraisPost['logradouro'] ?? '');
    $numero = trim($dadosGeraisPost['num'] ?? '');
    $complemento = trim($dadosGeraisPost['complemento'] ?? '');
    $bairro = trim($dadosGeraisPost['bairro'] ?? '');
    $cidade = trim($dadosGeraisPost['cidade'] ?? '');
    $estado = strtoupper(preg_replace('/[^a-zA-Z]/', '', trim($dadosGeraisPost['estado'] ?? '')));
    $nomeBoleto = trim($dadosGeraisPost['nomeboleto'] ?? '');
    $emailBoleto = trim($dadosGeraisPost['emailboleto'] ?? '');
    $termos = isset($dadosGeraisPost['exampleCheck1']) && $dadosGeraisPost['exampleCheck1'] === '1';

    // Validações Gerais...
    if (empty($cnpj) || strlen($cnpj) !== 14) $errosValidacaoGeral['CNPJ'] = "CNPJ inválido.";
    if (empty($empresa)) $errosValidacaoGeral['empresa'] = "Nome da empresa é obrigatório.";
    if (!empty($site) && !filter_var($site, FILTER_VALIDATE_URL)) $errosValidacaoGeral['site'] = "URL do site inválida.";
    if (empty($cep) || strlen($cep) !== 8) $errosValidacaoGeral['cep'] = "CEP inválido.";
    if (empty($logradouro)) $errosValidacaoGeral['logradouro'] = "Logradouro é obrigatório.";
    if (empty($bairro)) $errosValidacaoGeral['bairro'] = "Bairro é obrigatório.";
    if (empty($cidade)) $errosValidacaoGeral['cidade'] = "Cidade é obrigatória.";
    if (empty($estado) || strlen($estado) !== 2) $errosValidacaoGeral['estado'] = "Estado (UF) inválido (2 letras).";
    if (empty($nomeBoleto)) $errosValidacaoGeral['nomeboleto'] = "Nome para o boleto é obrigatório.";
    if (empty($emailBoleto) || !filter_var($emailBoleto, FILTER_VALIDATE_EMAIL)) $errosValidacaoGeral['emailboleto'] = "E-mail para o boleto inválido.";
    if (!$termos) $errosValidacaoGeral['exampleCheck1'] = "Você deve aceitar os termos.";


    // 7. VALIDAÇÃO DOS DADOS DOS PARTICIPANTES
    $numParticipantesValidos = 0; // Conta participantes que passam na validação
    if (empty($dadosParticipantesPost) || !is_array($dadosParticipantesPost)) {
        $errosValidacaoGeral['participantes'] = "Adicione pelo menos um participante.";
    } else {
        foreach ($dadosParticipantesPost as $index => $participante) {
            // Dentro do foreach ($dadosParticipantesPost as $index => $participante) em controller/Post.php
            $telP_raw = $participante['telefone'] ?? '';
            $telP_cleaned = limparNumerosPhp($telP_raw);

            // Exemplo: Tornar telefone obrigatório
            if (empty($telP_raw)) {
                $errosValidacaoParticipantes[$index]['telefone'] = "Telefone obrigatório.";
                $isValidParticipant = false;
            }
            // Exemplo: Validar formato numérico (se preenchido)
            elseif (!empty($telP_raw) && $telP_cleaned !== $telP_raw) {
                $errosValidacaoParticipantes[$index]['telefone'] = "Telefone deve conter apenas números.";
                $isValidParticipant = false;
            }
            if (!empty($site) && !filter_var($site, FILTER_VALIDATE_URL)) {
                $errosValidacaoGeral['site'] = "URL do site inválida.";
            }
            // Exemplo: Validar tamanho (se preenchido e numérico)
            elseif (!empty($telP_cleaned) && (strlen($telP_cleaned) < 10 || strlen($telP_cleaned) > 11)) {
                $errosValidacaoParticipantes[$index]['telefone'] = "Telefone inválido (10 ou 11 dígitos).";
                $isValidParticipant = false;
            }

            // Validação similar para cargo (ex: tamanho máximo)
            $cargoP = trim($participante['cargo'] ?? '');
            // Exemplo: Tornar cargo obrigatório
            if (empty($cargoP)) {
                $errosValidacaoParticipantes[$index]['cargo'] = "Cargo obrigatório.";
                $isValidParticipant = false;
            }

            $nomeP = trim($participante['nome'] ?? '');
            $emailP = trim($participante['email'] ?? '');

            $isValidParticipant = true; // Assume válido inicialmente

            if (empty($nomeP)) {
                $errosValidacaoParticipantes[$index]['nome'] = "Nome obrigatório.";
                $isValidParticipant = false;
            }
            if (empty($emailP) || !filter_var($emailP, FILTER_VALIDATE_EMAIL)) {
                $errosValidacaoParticipantes[$index]['email'] = "E-mail inválido.";
                $isValidParticipant = false;
            }
            // Adicionar outras validações aqui...

            if ($isValidParticipant) {
                $numParticipantesValidos++;
            }
        }
        // Adiciona erro geral se nenhum participante foi válido (ex: todos adicionados mas nenhum preenchido)
        if ($numParticipantesValidos === 0 && empty($errosValidacaoGeral['participantes'])) {
            $errosValidacaoGeral['participantes'] = "Preencha os dados de pelo menos um participante válido.";
        }
    }

    // 8. SE HOUVER ERROS, FAZ ROLLBACK E REDIRECIONA
    if (!empty($errosValidacaoGeral) || !empty($errosValidacaoParticipantes)) {
        $pdo->rollBack();
        redirect_with_feedback('individual', [
            'status' => 'validation_error',
            'errors' => ['geral' => $errosValidacaoGeral, 'participantes' => $errosValidacaoParticipantes],
            'data' => ['geral' => $dadosGeraisPost, 'participantes' => $dadosParticipantesPost]
        ]);
    }

    // 9. OPERAÇÕES NO BANCO DE DADOS (Validação OK)

    // 9.1. Empresa (igual)
    $empresaId = null;
    $empresaExistente = DB::getUm(TABLE_EMPRESAS, ['select' => 'id', 'where' => ['cnpj' => $cnpj]]);
    $dadosEmpresaDB = ['cnpj' => $cnpj, 'razao_social' => $empresa, 'site' => $site ?: null, 'cep' => $cep, 'logradouro' => $logradouro, 'numero' => $numero ?: null, 'complemento' => $complemento ?: null, 'bairro' => $bairro, 'cidade' => $cidade, 'estado' => $estado, 'nome_boleto' => $nomeBoleto, 'email_boleto' => $emailBoleto];
    if ($empresaExistente) {
        $empresaId = $empresaExistente->id;
        if (DB::update(TABLE_EMPRESAS, $dadosEmpresaDB, ['id' => $empresaId]) === false) {
            error_log("Alerta: Falha ao ATUALIZAR empresa ID: $empresaId (CNPJ: $cnpj).");
        }
    } else {
        $empresaId = DB::insert(TABLE_EMPRESAS, $dadosEmpresaDB);
        if ($empresaId === false) {
            throw new Exception("Falha crítica ao inserir nova empresa.");
        }
    }
    if (!$empresaId) {
        throw new Exception("Erro crítico: ID da empresa não definido.");
    }

    // 9.2. Calcula Preço Base e Individual (igual)
    $associadoInfo = DB::getUm(TABLE_ASSOCIADOS, ['select' => 'COUNT(*) as count', 'where' => ['cnpj' => $cnpj]]);
    $isAssociadoServer = ($associadoInfo !== false && isset($associadoInfo->count) && $associadoInfo->count > 0);
    $precoBaseServer = $isAssociadoServer ? $precoBaseAssociado : $precoBaseNaoAssociado;
    $calculo = calcularPrecoFinalServer($precoBaseServer);
    $precoFinalPorParticipante = $calculo['preco']; // <-- Preço individual ANTES do desconto geral
    $loteServer = $calculo['lote'];

    // 9.3. Calcula Desconto Total (NOVO)
    $discountPercentageServer = 0;
    if ($numParticipantesValidos === 2) $discountPercentageServer = 5;
    elseif ($numParticipantesValidos === 3) $discountPercentageServer = 10;
    elseif ($numParticipantesValidos >= 4) $discountPercentageServer = 15;

    $initialTotalPriceServer = $precoFinalPorParticipante * $numParticipantesValidos;
    $discountAmountServer = round($initialTotalPriceServer * ($discountPercentageServer / 100), 2);
    $finalTotalPriceServer = $initialTotalPriceServer - $discountAmountServer;

    // 9.4. Insere Participantes (Loop)
    $idsParticipantesInseridos = [];
    foreach ($dadosParticipantesPost as $index => $participante) {
        // Verifica se este participante passou na validação (evita inserir inválidos se houver erro de lógica)
        if (!isset($errosValidacaoParticipantes[$index])) {
            $dadosParticipanteDB = [
                'empresa_id' => $empresaId,
                'nome' => trim($participante['nome']),
                'email' => trim($participante['email']),
                'telefone' => limparNumerosPhp($participante['telefone'] ?? '') ?: null,
                'cargo' => trim($participante['cargo'] ?? '') ?: null,
                'preco_inscricao' => $precoFinalPorParticipante, // Salva o preço individual antes do desconto total
                'lote_inscricao' => $loteServer,
                'termos_aceitos' => 1
            ];
            $participanteId = DB::insert(TABLE_PARTICIPANTES, $dadosParticipanteDB);
            if ($participanteId === false) {
                throw new Exception("Falha ao inserir participante #" . ($index + 1) . ". Operação cancelada.");
            }
            $idsParticipantesInseridos[] = $participanteId;
        }
    }

    // Verifica se pelo menos um participante foi inserido (importante se validação falhou em alguns)
    if (empty($idsParticipantesInseridos)) {
        throw new Exception("Nenhum participante válido foi encontrado para inserção.");
    }


    // 10. COMMIT DA TRANSAÇÃO
    $pdo->commit(); // << CONFIRMA AS OPERAÇÕES >>

    // 11. REDIRECIONAMENTO DE SUCESSO
    $numParticipantes = count($idsParticipantesInseridos);
    $mensagemSucesso = "{$numParticipantes} participante(s) inscrito(s) com sucesso! ";
    // Adiciona informação do valor final ao feedback de sucesso
    $mensagemSucesso .= "Valor total: " . number_format($finalTotalPriceServer, 2, ',', '.') . ".";
    if ($discountPercentageServer > 0) {
        $mensagemSucesso .= " (Desconto de {$discountPercentageServer}% aplicado)";
    }

    redirect_with_feedback('obrigado', [
        'status' => 'success',
        'message' => $mensagemSucesso,
        'pids' => $idsParticipantesInseridos // Envia os IDs se precisar
    ]);
} catch (Exception $e) {
    // 12. TRATAMENTO DE ERROS GERAIS / DB -> ROLLBACK
    if ($pdo && $pdo->inTransaction()) {
        $pdo->rollBack(); // << DESFAZ OPERAÇÕES PARCIAIS >>
    }
    error_log("Erro Processamento Inscrição Múltipla: " . $e->getMessage() . " - Dados POST: " . json_encode($_POST));
    $errorMessage = "Ocorreu um erro inesperado. Nenhuma inscrição foi salva. Por favor, tente novamente.";
    if (ini_get('display_errors')) {
        $errorMessage .= " Debug: " . htmlspecialchars($e->getMessage());
    }
    redirect_with_feedback('individual', [
        'status' => 'general_error', // Ou 'db_error'
        'message' => $errorMessage,
        'data' => ['geral' => $dadosGeraisPost, 'participantes' => $dadosParticipantesPost]
    ]);
}
// --- FIM DO SCRIPT DE PROCESSAMENTO ---
