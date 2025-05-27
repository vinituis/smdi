<?php

// --- Configuração do Banco de Dados ---
$dbHost = 'localhost'; // Ou o IP/host do seu servidor de banco de dados
$dbName = 'smdi2025';
$dbUser = 'root';
$dbPass = '1234';
$dbTable = 'cnpj'; // Nome da tabela que criamos
// ------------------------------------

// --- Cabeçalho da Resposta ---
// Informa ao cliente que a resposta será em JSON
header('Content-Type: application/json; charset=utf-8');
// ---------------------------

// --- Função para Limpar o CNPJ ---
// Remove caracteres não numéricos
function limparCnpj($cnpj) {
    return preg_replace('/[^0-9]/', '', (string)$cnpj);
}
// -------------------------------

// --- Preparar Resposta Padrão ---
$resposta = ['existe' => false, 'erro' => null];
// ------------------------------

// --- Obter CNPJ da Requisição ---
// Esperamos o CNPJ como um parâmetro GET na URL (ex: api.php?cnpj=01234567890123)
if (!isset($_GET['cnpj'])) {
    http_response_code(400); // Bad Request
    $resposta['erro'] = 'Parâmetro "cnpj" não fornecido.';
    echo json_encode($resposta);
    exit; // Interrompe a execução
}

$cnpjRecebido = $_GET['cnpj'];
$cnpjLimpo = limparCnpj($cnpjRecebido);

// Validar se o CNPJ limpo tem 14 dígitos (opcional, mas recomendado)
if (strlen($cnpjLimpo) !== 14) {
     http_response_code(400); // Bad Request
     $resposta['erro'] = 'Formato de CNPJ inválido. Forneça 14 dígitos numéricos (com ou sem formatação).';
     $resposta['cnpj_recebido'] = $cnpjRecebido; // Ajuda a debugar
     $resposta['cnpj_limpo'] = $cnpjLimpo;       // Ajuda a debugar
     echo json_encode($resposta);
     exit;
}
// ---------------------------------

// --- Conexão com o Banco de Dados (Usando PDO) ---
try {
    // Data Source Name (DSN)
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";

    // Opções do PDO
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em caso de erro
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna resultados como array associativo
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa prepared statements nativos do DB
    ];

    // Cria a instância do PDO
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);

} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    // Em produção, logue o erro em vez de expô-lo diretamente
    $resposta['erro'] = 'Erro ao conectar com o banco de dados.';
    // $resposta['detalhe_erro'] = $e->getMessage(); // Descomente APENAS para debug
    echo json_encode($resposta);
    exit;
}
// -------------------------------------------------

// --- Consulta ao Banco de Dados ---
try {
    // Prepara a consulta SQL usando Prepared Statements para evitar SQL Injection
    $sql = "SELECT COUNT(*) FROM {$dbTable} WHERE cnpj = :cnpj";
    $stmt = $pdo->prepare($sql);

    // Associa o valor do CNPJ limpo ao placeholder :cnpj
    $stmt->bindParam(':cnpj', $cnpjLimpo, PDO::PARAM_STR);

    // Executa a consulta
    $stmt->execute();

    // Pega o resultado (o número de linhas encontradas)
    // fetchColumn() é ótimo para buscar um único valor da primeira coluna
    $count = (int)$stmt->fetchColumn();

    // Define a resposta baseado na contagem
    if ($count > 0) {
        $resposta['existe'] = true;
    } else {
        $resposta['existe'] = false;
    }

} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    // Em produção, logue o erro
    $resposta['erro'] = 'Erro ao consultar o banco de dados.';
     // $resposta['detalhe_erro'] = $e->getMessage(); // Descomente APENAS para debug
    echo json_encode($resposta);
    exit;
}
// -------------------------------

// --- Envia a Resposta Final ---
http_response_code(200); // OK
// Adiciona a flag para não escapar caracteres Unicode e também não escapar barras (útil para URLs)
echo json_encode($resposta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
// --------------------------

?>