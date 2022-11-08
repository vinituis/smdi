<?php

@include 'cabecalho.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ops... Ocorreu um erro</title>
    <link rel="stylesheet" href="./css/erro.css">
    <?php
        echo $GA4;
        echo $noIndex;
    ?>
</head>
<body>
    <div class="container">
        <h1>Ops... Ocorreu um erro!</h1>
        <p>Esta página não existe mais ou está indisponivel.</p>
        <a href="./"><button class="btn">Voltar para o site</button></a>
    </div>

</body>
</html>