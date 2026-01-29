<?php

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - SMDI 2026</title>
    <?php require "assets/Head.php"; ?>
    <link rel="stylesheet" href="src/css/main.css">
</head>
<body>
    <div class="container mt-5 pt-3 d-flex justify-content-center">
        <img src="src/images/logo.png" width="12%" alt="">
    </div>

    <div class="container col-sm-12 my-5">
        <div class="row text-center">
            <h1>Reserve esta data</h1>
            <h3>29 de setembro</h3>
        </div>
    </div>

    <div class="container col-sm-12 pt-2">
        <div class="row border p-4 m-2">
            <p class="mb-5 text-center mt-2"><b>Receba em primeira mão todas as novidades do SMDI 2026</b></p>
                <form class="row pb-4" action="" method="post">
                    <div class="col-sm-12 col-md-4 mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-main" id="name" name="name" required>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-main" id="email" name="email" required>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-3">
                        <label for="phone" class="form-label">Telefone</label>
                        <input type="tel" class="form-main" id="phone" name="phone" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="button w-100">Receber as novidades</button>
                    </div>
                </form>
        </div>
    </div>
</body>
</html>