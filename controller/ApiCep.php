<?php
// controller/ApiCep.php

// --- Cabeçalho da Resposta ---
// Garante que sempre seja JSON, mesmo em caso de erro interno não capturado (útil para debug)
header('Content-Type: application/json; charset=utf-8');

// --- Ativa exibição de erros (APENAS PARA DESENVOLVIMENTO!) ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- Função para Limpar o CEP ---
function limparCepApi($cep) {
    return preg_replace('/[^0-9]/', '', (string)$cep);
}

// --- Preparar Resposta Padrão ---
$resposta = [
    'sucesso' => false,
    'dados' => null,
    'erro' => 'Erro desconhecido na API CEP.' // Mensagem padrão
];

// --- Obter e Validar CEP da Requisição GET ---
if (!isset($_GET['cep'])) {
    http_response_code(400); // Bad Request
    $resposta['erro'] = 'Parâmetro "cep" não fornecido.';
    echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

$cepRecebido = $_GET['cep'];
$cepLimpo = limparCepApi($cepRecebido);

if (strlen($cepLimpo) !== 8) {
     http_response_code(400); // Bad Request
     $resposta['erro'] = 'Formato de CEP inválido. Forneça 8 dígitos numéricos.';
     $resposta['detalhes'] = ['cep_recebido' => $cepRecebido, 'cep_limpo' => $cepLimpo];
     echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
     exit;
}

// --- Consultar API ViaCEP ---
$urlViaCep = "https://viacep.com.br/ws/{$cepLimpo}/json/";
$resultadoViaCep = null;
$httpCodeViaCep = 0;

// Tenta usar cURL (preferencial)
if (function_exists('curl_init')) {
    $ch = curl_init($urlViaCep);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Mantenha true por segurança
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    // Adiciona um User-Agent genérico (algumas APIs bloqueiam requisições sem User-Agent)
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');


    $resultadoViaCep = curl_exec($ch);
    $httpCodeViaCep = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch); // Pega erro do cURL se houver
    curl_close($ch);

    if ($curlError) {
        http_response_code(502); // Bad Gateway
        $resposta['erro'] = 'Falha na comunicação com o serviço externo de CEP (cURL).';
        $resposta['detalhes_curl'] = $curlError; // Informação de debug
        error_log("Erro cURL ViaCEP: " . $curlError . " para URL: " . $urlViaCep); // Log do erro
        echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

} else {
    // Fallback para file_get_contents (requer allow_url_fopen=On)
     $context = stream_context_create(['http' => ['timeout' => 10, 'user_agent' => 'PHP-Script/1.0']]);
     $resultadoViaCep = @file_get_contents($urlViaCep, false, $context);
     // Tenta obter o status code dos headers (funciona na maioria das vezes)
     if (isset($http_response_header)) {
        sscanf($http_response_header[0], 'HTTP/%*d.%*d %d', $httpCodeViaCep);
     } else {
         $httpCodeViaCep = $resultadoViaCep === false ? 0 : 200; // Assume 200 se não falhou
     }

     if ($resultadoViaCep === false) {
        http_response_code(502);
        $lastError = error_get_last();
        $errorMsg = $lastError ? $lastError['message'] : 'Desconhecido';
        $resposta['erro'] = 'Falha na comunicação com o serviço externo de CEP (file_get_contents).';
        $resposta['detalhes_fgc'] = $errorMsg;
        error_log("Erro file_get_contents ViaCEP: " . $errorMsg . " para URL: " . $urlViaCep);
        echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
}

// --- Processar Resposta da ViaCEP ---
if ($httpCodeViaCep === 200 && $resultadoViaCep) {
    $dadosEndereco = json_decode($resultadoViaCep, true);

    // Verifica erro na decodificação do JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500);
        $resposta['erro'] = 'Erro ao processar a resposta do serviço de CEP (JSON inválido).';
        $resposta['resposta_original'] = mb_substr($resultadoViaCep, 0, 200) . '...'; // Mostra parte da resposta
        error_log("Erro JSON Decode ViaCEP. Resposta: " . $resultadoViaCep);
        echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    // CRÍTICO: Verifica se a ViaCEP retornou o objeto de erro {"erro": true}
    if (isset($dadosEndereco['erro']) && $dadosEndereco['erro'] === true) {
        http_response_code(404); // Not Found (semântica correta para nossa API)
        $resposta['sucesso'] = false; // Garante que sucesso seja falso
        $resposta['dados'] = null;   // Garante que dados seja nulo
        $resposta['erro'] = 'CEP não encontrado na base de dados externa.';
        $resposta['cep_consultado'] = $cepLimpo;
    } else {
        // SUCESSO! Dados válidos recebidos da ViaCEP
        http_response_code(200); // OK
        $resposta['sucesso'] = true;
        $resposta['dados'] = $dadosEndereco;
        $resposta['erro'] = null; // Limpa a mensagem de erro padrão
    }

} else {
    // Se a ViaCEP retornou um código HTTP diferente de 200 ou resultado foi vazio
    http_response_code(502); // Bad Gateway
    $resposta['erro'] = 'O serviço de CEP externo (ViaCEP) retornou um erro ou resposta inesperada.';
    $resposta['detalhes_externo'] = [
        'http_status' => $httpCodeViaCep,
        // Cuidado ao expor a resposta bruta em produção
        'resposta_bruta' => mb_substr((string)$resultadoViaCep, 0, 200) . '...'
    ];
     error_log("Erro ViaCEP - Status: {$httpCodeViaCep}. Resposta: " . $resultadoViaCep);
}

// --- Envia a Resposta Final ---
echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit; // Garante que nada mais seja executado

?>