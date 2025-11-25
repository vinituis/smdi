<?php
header('Cache-Control: no-cache, no-store, private');
// obrigado.php

// Tenta iniciar a sessão se ainda não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI 2025 - Inscrições fechadas</title>
    <!-- Ajuste o caminho do CSS -->
    <link rel="stylesheet" href="src/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="robots" content="noindex">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa; /* Um cinza claro de fundo */
        }
        .navbar-obrigado {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .main-content {
            flex-grow: 1;
            display: flex;
            align-items: center; /* Centraliza verticalmente o card */
            justify-content: center;
        }
        .thank-you-card {
            max-width: 600px;
            width: 100%;
            padding: 2rem;
            border-radius: 0.5rem;
        }
        .icon-success {
            font-size: 4rem;
            color: #198754; /* Verde Bootstrap */
        }
        .icon-error {
            font-size: 4rem;
            color: #dc3545; /* Vermelho Bootstrap */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark navbar-obrigado">
        <div class="container">
            <a class="navbar-brand" href="home">
                <img src="src/images/logo.png" width="150" alt="SMDI 2025 Logo">
            </a>
        </div>
    </nav>

    <main class="main-content py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="card shadow-lg thank-you-card">
                    <div class="card-body text-center">
                        
                            <i class="bi bi-check-circle-fill icon-success mb-3"></i>
                            <h1 class="card-title h3 mb-3">Inscrições Encerradas!</h1>
                            <p>Para mais informações envie um e-mail para marketing@abimaq.org.br ou ligue (11) 5582-6315.</p>
                            <hr class="my-4">
                            <a href="home" class="btn btn-primary">Voltar para a Página do Evento</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-4 mt-auto bg-light text-center text-muted">
        <div class="container">
            <small>©  SMDI <?= date('Y') ?> - ABIMAQ. Todos os direitos reservados.</small>
        </div>
    </footer>

    <script src="src/js/bootstrap.bundle.min.js"></script>
</body>
</html>