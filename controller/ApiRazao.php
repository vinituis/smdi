<?php

// --- Cabeçalho da Resposta ---
header('Content-Type: application/json; charset=utf-8');
// ---------------------------

// --- Função para Limpar o CNPJ ---
// Remove caracteres não numéricos
function limparCnpj($cnpj) {
    return preg_replace('/[^0-9]/', '', (string)$cnpj);
}
// -------------------------------

// --- Preparar Resposta Padrão ---
$resposta = [
    'sucesso' => false,
    'dados' => null, // Aqui irão os dados do CNPJ se encontrados
    'erro' => null   // Mensagem de erro, se houver
];
// ------------------------------

// --- Obter CNPJ da Requisição ---
// Esperamos o CNPJ como um parâmetro GET na URL (ex: razao_social_api.php?cnpj=00000000000191)
if (!isset($_GET['cnpj'])) {
    http_response_code(400); // Bad Request
    $resposta['erro'] = 'Parâmetro "cnpj" não fornecido.';
    echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

$cnpjRecebido = $_GET['cnpj'];
$cnpjLimpo = limparCnpj($cnpjRecebido);

// --- Validar Formato do CNPJ ---
if (strlen($cnpjLimpo) !== 14) {
     http_response_code(400); // Bad Request
     $resposta['erro'] = 'Formato de CNPJ inválido. Forneça 14 dígitos numéricos (com ou sem formatação).';
     $resposta['detalhes'] = [
         'cnpj_recebido' => $cnpjRecebido,
         'cnpj_limpo' => $cnpjLimpo
     ];
     echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
     exit;
}
// -----------------------------

// --- Consultar API BrasilAPI ---
// Monta a URL da BrasilAPI para CNPJ v1
$urlBrasilApi = "https://brasilapi.com.br/api/cnpj/v1/{$cnpjLimpo}";

// --- Usando cURL (Recomendado) ---
$ch = curl_init($urlBrasilApi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 15); // Timeout um pouco maior para consultas CNPJ
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
// BrasilAPI pode retornar 404, então não queremos que cURL trate isso como erro fatal
// curl_setopt($ch, CURLOPT_FAILONERROR, true); // <- NÃO usar isso aqui

$resultadoBrasilApi = curl_exec($ch);
$httpCodeBrasilApi = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Pega o status HTTP retornado pela BrasilAPI

if (curl_errno($ch)) {
    // Erro na execução do cURL (rede, SSL, etc.)
    http_response_code(502); // Bad Gateway
    $resposta['erro'] = 'Falha ao consultar o serviço de CNPJ externo (BrasilAPI).';
    $resposta['detalhes_erro_curl'] = curl_error($ch);
    curl_close($ch);
    echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}
curl_close($ch);
// --- Fim cURL ---


// --- Processar Resposta da BrasilAPI ---
if ($resultadoBrasilApi) {
    $dadosCnpj = json_decode($resultadoBrasilApi, true);

    // Verifica erro na decodificação do JSON (pouco provável com BrasilAPI, mas bom ter)
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500); // Internal Server Error
        $resposta['erro'] = 'Erro ao processar a resposta do serviço de CNPJ (JSON inválido).';
        $resposta['resposta_original'] = mb_substr($resultadoBrasilApi, 0, 500); // Limita o tamanho em caso de HTML de erro
        echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    // Verificar o Código HTTP retornado pela BrasilAPI
    if ($httpCodeBrasilApi === 200) {
        // Sucesso! Preenche os dados na resposta
        http_response_code(200); // OK
        $resposta['sucesso'] = true;
        // Vamos retornar apenas a razão social, mas a API retorna muito mais
        $resposta['dados'] = [
            'razao_social' => $dadosCnpj['razao_social'] ?? null,
            'nome_fantasia' => $dadosCnpj['nome_fantasia'] ?? null,
            // Adicione outros campos se precisar, ex:
            // 'logradouro' => $dadosCnpj['logradouro'] ?? null,
            // 'numero' => $dadosCnpj['numero'] ?? null,
            // 'municipio' => $dadosCnpj['municipio'] ?? null,
            // 'uf' => $dadosCnpj['uf'] ?? null,
            // 'cep' => $dadosCnpj['cep'] ?? null,
            // 'situacao_cadastral' => $dadosCnpj['descricao_situacao_cadastral'] ?? null,
            // ... veja a doc da BrasilAPI para todos os campos
        ];

    } elseif ($httpCodeBrasilApi === 404) {
        // CNPJ não encontrado pela BrasilAPI
        http_response_code(404); // Not Found
        $resposta['erro'] = $dadosCnpj['message'] ?? 'CNPJ não encontrado na base de dados da BrasilAPI.'; // Usa a msg da API se disponível
        $resposta['cep_consultado'] = $cnpjLimpo; // Corrigido para cnpj_consultado
        $resposta['cnpj_consultado'] = $cnpjLimpo;

    } else {
         // Outro erro retornado pela BrasilAPI (ex: 400 Bad Request se CNPJ inválido para eles, 5xx, etc.)
         http_response_code(502); // Bad Gateway (nossa API falhou por causa da externa)
         $resposta['erro'] = 'O serviço de CNPJ externo (BrasilAPI) retornou um erro inesperado.';
         $resposta['detalhes_externo'] = [
             'http_status' => $httpCodeBrasilApi,
             'mensagem' => $dadosCnpj['message'] ?? null, // Tenta pegar msg de erro da BrasilAPI
             'tipo_erro' => $dadosCnpj['type'] ?? null,
             'erros_detalhados' => $dadosCnpj['errors'] ?? null
         ];
    }

} else {
    // Resposta vazia E não houve erro de cURL (estranho, mas possível)
    // ou se $resultadoBrasilApi foi false (pode acontecer com file_get_contents se usar)
    http_response_code(502); // Bad Gateway
    $resposta['erro'] = 'O serviço de CNPJ externo (BrasilAPI) retornou uma resposta vazia ou inesperada.';
    $resposta['detalhes_externo'] = ['http_status' => $httpCodeBrasilApi];
}
// ------------------------------------

// --- Envia a Resposta Final ---
echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
// --------------------------

?>