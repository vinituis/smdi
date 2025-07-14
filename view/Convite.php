<?php
header('Cache-Control: no-cache, no-store, private');

$Pessoa = $_GET['id'];

$res = DB::getUm("participantes", array('where' => array('email' => $Pessoa)));

$empresa = DB::getUm('empresas', array('where' => array('id' => $res->empresa_id)));

function geraQRCode ($link) {
    
    $dadosParaEnviar = http_build_query(
        array(
            'frame_name' => 'no-frame',
            'qr_code_text' => $link,
            'image_format' => 'SVG',
            'qr_code_logo' => '',
            'foreground_color' => '#4f4f6a',
        )
    );
    
    $opcoes = array('http' =>
           array(
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $dadosParaEnviar
        )
    );
    
    $contexto = stream_context_create($opcoes);
    $result   = file_get_contents('https://api.qr-code-generator.com/v1/create?access-token=ZFjk6w-pRmjOEuQDui17eAMEoRshhBK3VVCHdfog1niENZTCfCCnhnZyJ4kVOzeQ', $dadosParaEnviar, $contexto);

    return $result;
}

// var_dump($empresa);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- <link rel="stylesheet" href="src/css/temp.css"> -->
    <link rel="stylesheet" href="https://smdi.abimaq.org.br/src/css/bootstrap.css">
    <link rel="stylesheet" href="https://smdi.abimaq.org.br/src/css/reset.css">
    <link rel="stylesheet" href="https://smdi.abimaq.org.br/src/css/temp.css">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9DC39DW0VW"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-9DC39DW0VW');
    </script>
    <style>
        body {
            background-color: #fff !important;
        }
        p {
            color: var(--cor-cinza-borda) !important;
        }
        /* .container .row {
            background-color: var(--cor-cinza-borda);
        } */
        .id {
            width: 1px;
            height: 1px;
            rotate: -90deg;
            margin-top: 38%;
            float: left;
            padding: 25px;
        }

        .convite {
            min-width: 1000px;
            max-width: 1000px;
            gap: 1rem;
        }
        .qr svg {
            width: 10rem;
        }
        img {
            filter: brightness(1.5);
        }
        @media print {
            .convite {
                margin: 0;
                padding: 0;
                gap: 0;
            }
            .container {
                margin: 0; padding: 0;
            }
            @page {
                size: landscape;
                margin: 0; padding: 0;
            }
        }
        @media only screen and (max-width: 600px) {
            .row.convite div.id {
                margin-top: 20rem;
            }
            .row.convite div.col-sm-6.p-5 {
                margin-top: -28rem;
                margin-left: 2rem;
                width: 350px;
            }
            .row.convite div.col-sm-5.m-0.p-0 img {
                display: none;
            }
            .convite {
                width: 100%;
                min-width: auto;
                max-width: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row convite">
            <div class="col-sm-1 id">
                <p class="fs-5 text-center"><?= md5($res->id); ?></p>
            </div>
            <div class="col-sm-6 p-5">
                <p class="fs-6 my-3">Convite SMDI 2025</p>
                <p class="fs-5 mt-4">Participante:</p>
                <p class="fs-2 mb-2 text-uppercase"><?= $res->nome; ?></p>
                <span class="qr"><?= geraQRCode("https://painel.abimaq.org.br/smdi2025/convite?id=$res->id"); ?></span>
                <p class="fs-5 mt-2">Razão Social:</p>
                <p class="fs-4 mb-4 text-uppercase"><?= $empresa->razao_social; ?></p>
            </div>
            <div class="col-sm-5 m-0 p-0">
                <img src="https://smdi.abimaq.org.br/src/images/astronauta.png" width="100%" alt="">
            </div>
        </div>
    </div>
</body>

</html>