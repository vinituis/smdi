<?php

function enviaInscrito ($nome, $email, $assunto, $qtd) {
    // Sanitizar para segurança dentro do HTML (recomendado, mas opcional para este caso simples)
    $nomeHtml = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
    $qtdHtml = htmlspecialchars($qtd, ENT_QUOTES, 'UTF-8');

    $corpo = "
    <table width='100%' border='0' cellpadding='40' cellspacing='0' style='border:0px; border-collapse:collapse;'>
        <tr>
            <td style='background-color:#f0f0f0;'>
                <center>
                    <table width='600' border='0' cellpadding='40' cellspacing='0' style='border:0px; border-collapse:collapse;'>
                        <tr>
                            <td style='background-color:#FFF;'>
                                <span style='font-family: sans-serif; font-size: 12pt;'>Olá $nomeHtml,</span>
                                <br><br>
                                <span style='font-family: sans-serif; font-size: 12pt;'>Agradecemos sua inscrição de $qtdHtml participante(s) no Seminário de Marketing Digital na Indústria (SMDI).</span>
                                <br><br>
                                <span style='font-family: sans-serif; font-size: 12pt;'>Para mais informações sobre o evento acesse: <a href='https://smdi.abimaq.org.br'>https://smdi.abimaq.org.br</a></span>
                                <br><br>
                                <span style='font-family: sans-serif; font-size: 12pt;'>Dúvidas? Entre em contato conosco no e-mail eventos@abimaq.org.br</span>
                                <br><br>
                                <span style='font-family: sans-serif; font-size: 12pt;'>Até breve,<br>Equipe de Marketing e Eventos da ABIMAQ</span>
                                <br><br>
                                <span style='font-family: sans-serif; font-size: 9pt;'>Enviado por <b>ABIMAQ</b><br>Av. Jabaquara, 2925 - 04045-902 - São Paulo, SP, Brasil</span>
                            </td>
                        </tr>
                    </table>
                </center>
            </td>
        </tr>
    </table>
    ";

    // IMPORTANTE: Substitua pelo seu token real e considere armazená-lo de forma segura.
    // $apiToken = getenv('EMAIL_API_TOKEN') ?: '*|COLOQUE O TOKEN AQUI SE NÃO USAR VAR DE AMBIENTE|*';
    // Se não estiver usando variável de ambiente, substitua a linha acima por:
    $apiToken = 'KIB9bZ#ckb*gzxLxRWdOn25s2w';

    $post = [
        'token' => $apiToken,
        'sender_nome' => "SMDI",
        'sender_email' => 'naoresponda@abimaq.org.br',
        'reply_nome' => "SMDI",
        'reply_email' => 'eventos@abimaq.org.br',
        'recipient' => $email,
        'subject' => $assunto,
        'message' => $corpo
    ];

    $curl = curl_init();

    // !!! CRÍTICO: Use HTTPS se disponível !!!
    // Verifique se o serviço suporta HTTPS. Ex: "https://ses.abimaq.org.br/envio.php"
    $apiUrl = "http://ses.abimaq.org.br/envio.php"; // MANTENHA HTTP SE HTTPS NÃO FOR UMA OPÇÃO, MAS ESTEJA CIENTE DO RISCO

    curl_setopt_array($curl, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($post),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/x-www-form-urlencoded"
        ],
        // Se estiver usando HTTPS e tiver problemas com certificado (NÃO RECOMENDADO PARA PRODUÇÃO):
        // CURLOPT_SSL_VERIFYPEER => false,
        // CURLOPT_SSL_VERIFYHOST => false,
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); // Obter código HTTP da resposta
    curl_close($curl);

    if ($err) {
        // Em um ambiente de produção, você logaria este erro em vez de (ou além de) imprimi-lo.
        // error_log("Erro cURL ao enviar e-mail para $email: " . $err);
        // print_r("cURL Error #:" . $err); // Para depuração
        return ['success' => false, 'message' => "Erro de cURL: " . $err, 'http_code' => null, 'response_body' => null];
    } else {
        // Você pode querer analisar a $response para determinar o sucesso real
        // com base no que a API `envio.php` retorna.
        // Por exemplo, se a API retornar um JSON com um status:
        // $responseData = json_decode($response, true);
        // if ($httpCode == 200 && isset($responseData['status']) && $responseData['status'] == 'success') {
        //     return ['success' => true, 'message' => 'E-mail enviado (conforme API).', 'http_code' => $httpCode, 'response_body' => $responseData];
        // } else {
        //     return ['success' => false, 'message' => 'API reportou falha ou resposta inesperada.', 'http_code' => $httpCode, 'response_body' => $responseData ?: $response];
        // }

        // Para manter simples por agora, apenas retornamos a resposta e o código HTTP.
        // O `print_r($response);` original foi removido daqui. O chamador decide o que fazer.
        return ['success' => ($httpCode >= 200 && $httpCode < 300), 'message' => ($httpCode >= 200 && $httpCode < 300) ? 'Requisição enviada.' : 'Requisição falhou.', 'http_code' => $httpCode, 'response_body' => $response];
    }
}

// Exemplo de como usar a função e tratar o retorno:
/*
$resultado = enviaInscrito("Fulano de Tal", "fulano@example.com", "Confirmação de Inscrição SMDI", 1);

if ($resultado['success']) {
    echo "Status da requisição: Sucesso (HTTP {$resultado['http_code']}). Mensagem: {$resultado['message']}\n";
    // Analise $resultado['response_body'] para ver a resposta real da API de envio
    // var_dump($resultado['response_body']);
} else {
    echo "Status da requisição: Falha (HTTP {$resultado['http_code']}). Mensagem: {$resultado['message']}\n";
    // Analise $resultado['response_body'] para detalhes do erro da API
    // var_dump($resultado['response_body']);
}
*/

?>