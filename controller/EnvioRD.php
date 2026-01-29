<?php

require 'controller/guzzle/vendor/autoload.php';

use GuzzleHttp\Client;
$client = new Client();
$apiKey = 'jmzTQpTCjrxpRqjmVwsbrJKotBYqFDOeFSdG';

$name = $_POST['name'] ?? 'Nome não preenchido';
$email = $_POST['email'] ?? '';
$telefone = $_POST['phone'] ?? '';

try {
    $response = $client->post("https://api.rd.services/platform/conversions?api_key={$apiKey}", [
        'headers' => [
            'Content-Type' => 'application/json',
            'accept'       => 'application/json',
        ],
        'json' => [
    'event_type'   => 'CONVERSION',
    'event_family' => 'CDP', // Deve ser exatamente assim, em maiúsculas
    'payload'      => [
        'conversion_identifier' => 'Interesse SMDI 2026',
        'email'                 => $email,
        'name'                  => $name,
        'personal_phone'        => $telefone,
        'available_for_mailing' => true,
        'traffic_source'        => 'cookie __trf.src',
        'legal_bases' => [
            [
                'category' => 'communications',
                'type'     => 'legitimate_interest',
                'status'   => 'granted',
            ]
        ]
    ]
]
    ]);

    echo "<script nonce='$nonce'>console.log(" . $response->getBody() . ")</script>";
    header("Location: obrigado-interesse");
} catch (\GuzzleHttp\Exception\ClientException $e) {
    echo "<script nonce='$nonce'>console.log('Erro 400: " . $e->getResponse()->getBody()->getContents() . "')</script>";
} catch (\Exception $e) {
    echo "<script nonce='$nonce'>console.log('Erro Geral: " . $e->getMessage() . "')</script>";
}