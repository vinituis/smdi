<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// session_start();
// var_dump($_POST);

// empresa
$cnpj = (int) $_POST['geral']['CNPJ'] ;
$empresa = $_POST['geral']['empresa'] ;

// participante
$nome = $_POST['participantes']['nome'];
$email = $_POST['participantes']['email'];
$telefone = $_POST['participantes']['telefone'];
$cargo = $_POST['participantes']['cargo'];
$termos = $_POST['geral']['exampleCheck1'] ;

$buscaIdPag = DB::getUm("empresas", ['where' => ['cnpj' => $cnpj]]);
var_dump($buscaIdPag);

if($buscaIdPag == false){
    $insertPag = DB::insert("empresas", [
        'cnpj' => $cnpj,
        'razao_social' => $empresa,
        'nome_boleto' => $nome,
        'email_boleto' => $email
    ]);
    var_dump($insertPag);
    $insertColab = DB::insert("participantes", [
        'empresa_id' => $insertPag,
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
        'cargo' => $cargo,
        'preco_inscricao' => 0.00,
        'lote_inscricao' => 1,
        'termos_aceitos' => (int) $termos,
        'data_inscricao' => date("Y-m-d H:i:s"),
        'status' => 5
    ]);

    if($insertColab != false){
        $_SESSION['form_feedback'] = [ // <-- INICIALIZE COMO ARRAY
            'status' => 'success',
            'message' => "Inscrição de colaborador e empresa realizados com sucesso!",
            'pids'    => [$insertColab] // Ou qualquer ID relevante, talvez o ID do colaborador
        ];
        header("location: obrigado");
    }else{

    }

}else{
    echo $buscaIdPag->id;
    $insertColab = DB::insert("participantes", [
        'empresa_id' => $buscaIdPag->id,
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
        'cargo' => $cargo,
        'preco_inscricao' => 0.00,
        'lote_inscricao' => 1,
        'termos_aceitos' => (int) $termos,
        'data_inscricao' => date("Y-m-d H:i:s"),
        'status' => 5
    ]);

    if($insertColab != false){
        $_SESSION['form_feedback'] = [ // <-- INICIALIZE COMO ARRAY
            'status' => 'success',
            'message' => "Inscrição de colaborador e empresa realizados com sucesso!",
            'pids'    => [$insertColab] // Ou qualquer ID relevante, talvez o ID do colaborador
        ];
        header("location: obrigado");
    }else{

    }

}

?>