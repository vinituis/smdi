<?php
// ApiRazao.php com CACHE

// --- Cabeçalho da Resposta ---
header('Cache-Control: no-cache, no-store, private');
header('Content-Type: application/json; charset=utf-8');

// --- Função para Limpar o CNPJ ---
function limparCnpj($cnpj) {
    return preg_replace('/[^0-9]/', '', (string)$cnpj);
}

// --- Preparar Resposta Padrão ---
$resposta = ['sucesso' => false, 'dados' => null, 'erro' => null, 'fonte' => null];

// --- Obter e Validar CNPJ ---
if (!isset($_GET['cnpj'])) {
    http_response_code(400);
    $resposta['erro'] = 'Parâmetro "cnpj" não fornecido.';
    echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}
$cnpjRecebido = $_GET['cnpj'];
$cnpjLimpo = limparCnpj($cnpjRecebido);
if (strlen($cnpjLimpo) !== 14) {
    http_response_code(400);
    $resposta['erro'] = 'Formato de CNPJ inválido.';
    echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

// --- LÓGICA DE CACHE ---
$cacheDir = __DIR__ . '/cache_cnpj'; // Cria uma pasta 'cache_cnpj' dentro da pasta 'controller'
$cacheFile = $cacheDir . '/' . $cnpjLimpo . '.json';
$cacheTTL = 86400 * 30; // Tempo de vida do cache em segundos (ex: 30 dias)

// Cria o diretório de cache se não existir
if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

// 1. Tenta ler do cache
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTTL) {
    $conteudoCache = file_get_contents($cacheFile);
    $dadosCnpj = json_decode($conteudoCache, true);

    // Verifica se o cache é válido e NÃO é um erro de "não encontrado"
    if (json_last_error() === JSON_ERROR_NONE && !isset($dadosCnpj['erro'])) {
        http_response_code(200);
        $resposta['sucesso'] = true;
        $resposta['dados'] = $dadosCnpj;
        $resposta['fonte'] = 'cache'; // Informa que veio do cache
        echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit; // << SUCESSO! Envia do cache e termina.
    }
}
// --- FIM LÓGICA DE CACHE ---

// Se não encontrou no cache, continua para a BrasilAPI...
$resposta['fonte'] = 'brasilapi'; // Informa que a fonte foi a API externa

// --- Consultar API BrasilAPI (código cURL igual ao anterior) ---
$urlBrasilApi = "https://brasilapi.com.br/api/cnpj/v1/{$cnpjLimpo}";
$ch = curl_init($urlBrasilApi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
$resultadoBrasilApi = curl_exec($ch);
$httpCodeBrasilApi = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if (curl_errno($ch)) { /* ... (bloco de erro cURL igual) ... */ exit; }
curl_close($ch);

// --- Processar Resposta da BrasilAPI (com gravação no cache) ---
if ($resultadoBrasilApi) {
    $dadosCnpj = json_decode($resultadoBrasilApi, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        // "Too many requests" cairá aqui
        http_response_code(502); // Bad Gateway, pois a API externa falhou
        $resposta['erro'] = 'Erro ao processar a resposta do serviço de CNPJ (JSON inválido). A API externa pode estar offline ou bloqueando requisições.';
        $resposta['resposta_original'] = mb_substr($resultadoBrasilApi, 0, 100);
        // NÃO SALVA ESSE ERRO NO CACHE
        echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    if ($httpCodeBrasilApi === 200) {
        http_response_code(200);
        $resposta['sucesso'] = true;
        $resposta['dados'] = [
            'razao_social' => $dadosCnpj['razao_social'] ?? null,
            'nome_fantasia' => $dadosCnpj['nome_fantasia'] ?? null,
        ];
        // ** SALVA O SUCESSO NO CACHE **
        if (is_writable($cacheDir)) {
             file_put_contents($cacheFile, json_encode($resposta['dados']));
        }

    } elseif ($httpCodeBrasilApi === 404) {
        http_response_code(404);
        $resposta['erro'] = $dadosCnpj['message'] ?? 'CNPJ não encontrado na base de dados externa.';
        // Opcional: Salvar o erro 404 no cache para não consultar de novo um CNPJ sabidamente inválido
        // if (is_writable($cacheDir)) { file_put_contents($cacheFile, json_encode(['erro' => 'nao_encontrado'])); }
    } else {
         http_response_code(502);
         $resposta['erro'] = 'O serviço de CNPJ externo retornou um erro inesperado.';
         $resposta['detalhes_externo'] = ['http_status' => $httpCodeBrasilApi, /*...*/];
    }

} else {
    http_response_code(502);
    $resposta['erro'] = 'O serviço de CNPJ externo retornou uma resposta vazia.';
}

echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit;

?>