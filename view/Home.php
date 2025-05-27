<?php
header('Cache-Control: no-cache, no-store, private');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="src/css/old/temp.css">
    <link rel="stylesheet" href="src/css/old/reset.css">
    <link rel="stylesheet" href="src/css/old/bootstrap.css">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9DC39DW0VW"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-9DC39DW0VW');
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="pt-5 mt-5 d-flex justify-content-center">
                <h1 class="text-white fw-bold opacity-75">SMDI 2025</h1>
            </div>
            <div class="mt-2 d-flex justify-content-center">
                <p class="text-white opacity-75 text-center"><b>Data:</b> 12/08/2025<br><b>Horário:</b> Das 13h às 17h</p>
            </div>
            <div class="d-flex justify-content-center">
                <p class="text-white opacity-50 fs-3">Em breve mais informações</p>
            </div>
            <div class="position-absolute bottom-0 start-50 mb-5 translate-middle-x d-flex flex-column justify-content-center">
                <p class="text-white text-center opacity-75 fs-6">Quer apoiar esta edição?</p>
                <a href="src/docs/midia-kit.pdf" class="btn btn-secondary" target="_blank">Acesse o mídia kit</a>
            </div>
        </div>
    </div>
</body>
</html>