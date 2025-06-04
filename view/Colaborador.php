<?php
// INICIA A SESSÃO OBRIGATORIAMENTE NO TOPO
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// --- Feedback e Repopulação (igual ao anterior) ---

// var_dump($_POST);

header('Cache-Control: no-cache, no-store, private');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI 2025 - Inscrição Colaborador</title>
    <link rel="stylesheet" href="src/css/bootstrap.css">
    <meta name="robots" content="noindex">
    <style>
        /* Cores e Fundos para Dark Theme Aprimorado (Consistente com a Landing Page) */
        :root {
            --dark-bg: #121212;
            /* Fundo principal bem escuro */
            --dark-surface: #1e1e1e;
            /* Cor de superfície para cards, tabelas */
            --dark-text: #e0e0e0;
            /* Cor de texto principal */
            --dark-text-secondary: #b0b0b0;
            /* Cor de texto secundária/suave */
            --dark-border: #303030;
            /* Cor de bordas e divisores */
            --primary-color: #9686f2;
            /* Cor primária (um roxo/lilás) */
            --primary-color-dark: #e17a25;
            /* cor primária */
            --secondary-color: #e17a25;
            /* Cor secundária (um laranja) */
            --success-color: rgb(228, 139, 37);
            /* Cor de sucesso (laranja claro) */
            --danger-color: #cf6679;
            /* Cor de perigo/erro (vermelho suave) */
            --highlight-color: rgba(241, 241, 241, 0.0);
            /* Cor para destacar áreas */
            --form-bg: #282828;
            /* Fundo dos campos de formulário */
            --form-border: #505050;
            /* Borda dos campos de formulário */
            --form-placeholder: #888888;
            /* Cor do placeholder */
        }

        .roxo {
            color: var(--primary-color) !important;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--dark-text);
            font-family: 'Lato', sans-serif;
            line-height: 1.6;
            min-height: 100vh;
            /* Garante que o fundo cubra toda a viewport */
            padding-top: 80px;
            /* Espaço para a navbar fixa */
            overflow-x: hidden;
            /* Evita scroll horizontal por animações */
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #ffffff;
            /* Títulos mais claros */
            font-weight: 700;
            margin-bottom: 1rem;
        }

        p {
            margin-bottom: 1rem;
            color: var(--dark-text-secondary);
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: var(--primary-color-dark);
            text-decoration: underline;
        }

        /* Navbar (Consistente com Landing Page) */
        .navbar {
            background-color: rgba(30, 30, 30, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

        .navbar-brand img {
            filter: brightness(0) invert(1);
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .navbar-nav .nav-link {
            color: var(--dark-text) !important;
        }

        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
        }

        .navbar-text {
            color: var(--dark-text-secondary);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23e0e0e0' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Container Principal do Formulário */
        .form-container {
            background-color: var(--dark-surface);
            padding: 3rem;
            border-radius: 0.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        /* Títulos das Seções do Formulário */
        .form-section-title {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            text-align: center;
        }

        .form-section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background-color: var(--primary-color);
            margin: 10px auto 0;
            border-radius: 2px;
        }


        /* Campos de Formulário (Aprimorados para Dark Theme) */
        .form-control,
        .form-select {
            background-color: var(--form-bg);
            color: var(--dark-text);
            border: 1px solid var(--form-border);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control::placeholder {
            color: var(--form-placeholder);
            opacity: 1;
            /* Garante que o placeholder seja visível */
        }

        .form-control:focus {
            background-color: var(--form-bg);
            color: var(--dark-text);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.25);
            /* Glow com cor primária */
        }

        .form-label {
            color: var(--dark-text);
            /* Labels claras */
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-text {
            color: var(--dark-text-secondary) !important;
            /* Texto de ajuda suave */
        }

        /* Validação */
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: var(--danger-color) !important;
            box-shadow: 0 0 0 0.25rem rgba(207, 102, 121, 0.25);
            /* Glow com cor de perigo */
        }

        .invalid-feedback {
            color: var(--danger-color) !important;
            /* Texto de feedback de erro */
            font-size: 0.875em;
            margin-top: 0.25rem;
            display: block;
            /* Garante que seja exibido */
        }

        /* Bloco de Participante */
        .participante-bloco {
            border: 1px solid var(--dark-border);
            padding: 2rem;
            /* Mais padding */
            margin-bottom: 2rem;
            /* Mais espaço abaixo */
            border-radius: 0.5rem;
            /* Bordas mais arredondadas */
            background-color: var(--dark-surface);
            position: relative;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Animação no hover */
        }

        .participante-bloco:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.4);
        }


        .participante-bloco h5 {
            color: var(--secondary-color);
            /* Título do participante com cor secundária */
            border-bottom: 1px solid var(--dark-border);
            padding-bottom: 0.75rem;
            /* Mais padding */
            margin-bottom: 1.5rem;
            /* Mais espaço abaixo */
            font-size: 1.3rem;
        }

        .btn-remover-participante {
            position: absolute;
            top: 1.5rem;
            /* Ajuste de posição */
            right: 1.5rem;
            /* Ajuste de posição */
            z-index: 1;
            /* Garante que esteja acima de outros elementos */
            transition: transform 0.2s ease;
        }

        .btn-remover-participante:hover {
            transform: scale(1.1);
        }

        /* Botão Adicionar Participante */
        #btn-add-participante {
            background-color: transparent;
            border-color: var(--success-color);
            color: var(--success-color);
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        #btn-add-participante:hover {
            background-color: var(--success-color);
            color: var(--dark-surface);
            border-color: var(--success-color);
        }


        /* Área de Preço ATUALIZADA (Visualmente mais forte) */
        .price-summary-box {
            background-color: #252525;
            /* Fundo mais escuro para destaque */
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            margin-top: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--dark-border);
        }

        .price-summary-box h4 {
            color: #ffffff;
            margin-bottom: 1.5rem;
        }

        .price-summary-box .lead {
            color: var(--dark-text);
            /* Cor mais clara para informações de preço */
            font-size: 1.1rem;
        }

        .price-summary-box .fw-bold {
            color: #ffffff;
            /* Deixa os rótulos em negrito mais claros */
        }

        .price-summary-box #base-price-info {
            color: var(--success-color);
            /* Cor de sucesso para o preço base */
        }

        .price-summary-box .badge {
            font-size: 0.9rem;
            padding: 0.4em 0.6em;
            vertical-align: middle;
        }

        .price-summary-box .badge.bg-secondary {
            /* Mantém o padrão para o lote */
            background-color: var(--secondary-color) !important;
            color: var(--dark-bg);
        }


        .price-summary-box #discount-info {
            color: var(--secondary-color);
            /* Cor secundária para o desconto */
            font-weight: bold;
            font-size: 1.1rem;
        }

        .price-summary-box #discount-value {
            color: var(--danger-color);
            /* Cor de perigo suave para o valor do desconto */
        }


        .price-summary-box hr {
            border-top: 1px solid var(--dark-border);
            opacity: 0.7;
        }

        .price-summary-box h3 {
            color: var(--primary-color);
            /* Cor primária para o TOTAL */
            font-size: 2rem;
            margin-top: 1.5rem;
            margin-bottom: 0;
        }


        /* Checkbox e Botão Submit */
        .form-check-label {
            color: var(--dark-text);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.25);
        }

        .form-check-input.is-invalid {
            border-color: var(--danger-color);
        }


        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #ffffff;
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-color-dark);
            border-color: var(--primary-color-dark);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 170, 255, 0.3);
        }

        /* Rodapé Simples do Formulário */
        .form-footer-text {
            color: var(--dark-text-secondary);
            font-size: 0.9rem;
        }

        .dn {
            display: none !important;
        }

        .destaque {
            border: 1px dashed #fff;
            margin-top: 2rem;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            body {
                padding-top: 70px;
                /* Ajuste para navbar menor no mobile */
            }

            .form-container {
                padding: 1.5rem;
                /* Reduz padding no mobile */
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

            .form-section-title {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .participante-bloco {
                padding: 1rem;
                margin-bottom: 1.5rem;
            }

            .participante-bloco h5 {
                font-size: 1.1rem;
                margin-bottom: 1rem;
                padding-bottom: 0.5rem;
            }

            .btn-remover-participante {
                top: 0.5rem;
                right: 0.5rem;
            }

            .price-summary-box {
                padding: 1.5rem;
            }

            .price-summary-box h3 {
                font-size: 1.5rem;
            }

            .price-summary-box .lead {
                font-size: 1rem;
            }

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="home"><img src="src/images/logo.png" width="150" alt="SMDI 2025 Logo"></a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto"> <!-- Ajustado para mover a data para a direita -->
                    <span class="nav-link active me-3"><b>Data:</b> 12 de agosto de 2025</span>
                    <!-- Remover link 'Home' se esta página for apenas o formulário -->
                    <!-- <a class="nav-link" href="./">Voltar para a Home</a> -->
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="col-12 pt-4 pb-3 text-center destaque">
            <h2 class="fs-1">Informações importantes</h2>
            <p>Após a inscrição, a equipe da ABIMAQ enviará o boleto de pagamento para o e-mail informado.<br>O pagamento é feito exclusivamente via boleto, com emissão apenas de recibo simples.</p>
        </div>
        <form class="row my-5" method="post" name='post' action="colaborador">
            <h1 class="text-center pt-5 mb-3">Inscrição de Colaborador</h1>


            <!-- === Dados Financeiros (Empresa) === -->
            <h4 class="text-center mb-4">Dados Financeiros (Empresa)</h4>
            <div class="col-md-6 col-12 mb-3">
                <label for="CNPJ" class="form-label">CNPJ</label>
                <input type="text" class="form-control" id="CNPJ" name="geral[CNPJ]" value="46390209000100" placeholder="46.390.209/0001-00" maxlength="18" required readonly>
            </div>
            <div class="col-md-6 col-12 mb-3"> 
                <label for="empresa" class="form-label">Empresa (Razão Social)</label> 
                <input type="text" class="form-control" id="empresa" name="geral[empresa]" value="ASSOCIACAO BRASILEIRA DA IND DE MAQUINAS E EQUIPAMENTOS" required readonly>
            </div>

            <hr class="my-4">

            <!-- === Dados dos Participantes === -->
            <div class="col-12">
                <h4 class="text-center mb-4">Dados do Participante</h4>
                <div id="participantes-container">
                        <div class="participante-bloco" data-index="">
                            <h5>Participante</h5>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="nome_" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome_" name="participantes[nome]" value="" required>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="email_" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email_" name="participantes[email]" value="" required>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="telefone_" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" id="telefone_" name="participantes[telefone]" value="" placeholder="(XX) XXXXX-XXXX" required>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="cargo_" class="form-label">Cargo</label>
                                    <input type="text" class="form-control" id="cargo_" name="participantes[cargo]" value="" required>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Checkbox Termos e Submit -->
            <div class="col-12 mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="geral[exampleCheck1]" value="1" required>
                <label class="form-check-label" for="exampleCheck1">Ao preencher o formulário, você está ciente que a ABIMAQ e os Patrocinadores/Palestrantes poderão enviar comunicações e conteúdos, que podem ser do interesse do setor de máquinas e equipamentos. Confira a nossa <a href="https://abimaq.org.br/hub-de-servicos/65/politica-de-privacidade" target="_blank">Política de Privacidade</a>.</label>
            </div>
            <div class="col-12">
                <input type="submit" class="btn btn-primary btn-lg" value="Realizar Inscrição">
            </div>
            
        </form>
    </div>

    <script src="src/js/bootstrap.bundle.min.js"></script>
</body>

</html>