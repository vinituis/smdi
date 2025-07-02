<?php
// INICIA A SESSÃO OBRIGATORIAMENTE NO TOPO
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// --- Feedback e Repopulação (igual ao anterior) ---
$feedback = $_SESSION['form_feedback'] ?? null;
unset($_SESSION['form_feedback']);
$mensagemSucesso = '';
$mensagemErro = '';
$errosValidacaoGeral = [];
$errosValidacaoParticipantes = [];
$dadosForm = [];
$dadosParticipantesForm = [[]];
if ($feedback) {
    $dadosForm = $feedback['data']['geral'] ?? [];
    $dadosParticipantesForm = $feedback['data']['participantes'] ?? [[]];
    if ($feedback['status'] === 'success') {
        // $mensagemSucesso = $feedback['message'];
        $dadosForm = [];
        $dadosParticipantesForm = [[]];
    } elseif ($feedback['status'] === 'db_error' || $feedback['status'] === 'general_error') {
        $mensagemErro = $feedback['message'];
    } elseif ($feedback['status'] === 'validation_error') {
        $mensagemErro = "Por favor, corrija os erros indicados no formulário.";
        $errosValidacaoGeral = $feedback['errors']['geral'] ?? [];
        $errosValidacaoParticipantes = $feedback['errors']['participantes'] ?? [];
    }
}
if (empty($dadosParticipantesForm)) {
    $dadosParticipantesForm = [[]];
}

// --- Configurações JS (iguais) ---
$precoBaseAssociadoJS = 200.00;
$precoBaseNaoAssociadoJS = 400.00;
$dataLimiteLote1JS = [2025, 5, 13];
$dataLimiteLote2JS = [2025, 5, 27];
$dataLimiteLote3JS = [2025, 6, 11];
$percentualAumentoLote2JS = 10;
$percentualAumentoLote3JS = 20;
$percentualAumentoLote4JS = 30;
$urlApiCnpjAssociadoJS = 'api';
$urlApiCepJS = 'cep';
$urlApiRazaoSocialJS = 'razao';

header('Cache-Control: no-cache, no-store, private');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI 2025 - Inscrição Múltipla</title>
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
            <p>Após a inscrição, a equipe da ABIMAQ enviará o boleto de pagamento para o e-mail informado.<br>O pagamento é feito exclusivamente via boleto emitido apenas em nome da empresa, com emissão apenas de recibo simples.<br>O valor de associado é calculado automaticamente quando inserir o CNPJ</p>
        </div>
        <form class="row my-5" method="post" name='post' action="individual" novalidate>
            <h1 class="text-center pt-5 mb-3">Inscrição de Participantes</h1>

            <!-- Mensagens -->
            <?php if (!empty($mensagemSucesso)): ?><div class="col-12 alert alert-success" role="alert"><?= htmlspecialchars($mensagemSucesso) ?></div><?php endif; ?>
            <?php if (!empty($mensagemErro)): ?><div class="col-12 alert alert-danger" role="alert"><?= htmlspecialchars($mensagemErro) ?></div><?php endif; ?>

            <!-- === Dados Financeiros (Empresa) === -->
            <h4 class="text-center mb-4">Dados Financeiros (Empresa)</h4>
            <div class="col-md-6 col-12 mb-3">
                <label for="CNPJ" class="form-label">CNPJ</label>
                <input type="text" class="form-control <?= isset($errosValidacaoGeral['CNPJ']) ? 'is-invalid' : '' ?>" id="CNPJ" name="geral[CNPJ]" value="<?= htmlspecialchars($dadosForm['CNPJ'] ?? '') ?>" maxlength="18" required>
                <?php if (isset($errosValidacaoGeral['CNPJ'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['CNPJ'] ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-12 mb-3"> 
                <label for="empresa" class="form-label">Empresa (Razão Social)</label> 
                <input type="text" class="form-control <?= isset($errosValidacaoGeral['empresa']) ? 'is-invalid' : '' ?>" id="empresa" name="geral[empresa]" value="<?= htmlspecialchars($dadosForm['empresa'] ?? '') ?>" required> <?php if (isset($errosValidacaoGeral['empresa'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['empresa'] ?>
                    </div>
                <?php endif; ?> 
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="site" class="form-label">Site</label> 
                <input type="url" class="form-control <?= isset($errosValidacaoGeral['site']) ? 'is-invalid' : '' ?>" id="site" name="geral[site]" value="<?php if(!isset($dadosForm['site'])){ echo "https://"; } else { echo htmlspecialchars($dadosForm['site']); }?>" placeholder="https://..." required> 
                <?php if (isset($errosValidacaoGeral['site'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['site'] ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-12 mb-3"> 
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control <?= isset($errosValidacaoGeral['cep']) ? 'is-invalid' : '' ?>" id="cep" name="geral[cep]" value="<?= htmlspecialchars($dadosForm['cep'] ?? '') ?>" required>
                <div id="cep-feedback" class="form-text"></div> 
                <?php if (isset($errosValidacaoGeral['cep'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['cep'] ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-8 col-12 mb-3"> 
                <label for="logradouro" class="form-label">Logradouro</label> 
                <input type="text" class="form-control <?= isset($errosValidacaoGeral['logradouro']) ? 'is-invalid' : '' ?>" id="logradouro" name="geral[logradouro]" value="<?= htmlspecialchars($dadosForm['logradouro'] ?? '') ?>" required> 
                <?php if (isset($errosValidacaoGeral['logradouro'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['logradouro'] ?>
                    </div>
                <?php endif; ?> 
            </div>
            <div class="col-md-4 col-5 mb-3"> 
                <label for="num" class="form-label">Número</label>
                <input type="text" class="form-control <?= isset($errosValidacaoGeral['num']) ? 'is-invalid' : '' ?>" id="num" name="geral[num]" value="<?= htmlspecialchars($dadosForm['num'] ?? '') ?>"> 
                <?php if (isset($errosValidacaoGeral['num'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['num'] ?>
                    </div>
                <?php endif; ?> 
            </div>
            <div class="col-md-6 col-7 mb-3"> 
                <label for="complemento" class="form-label">Complemento</label> <input type="text" class="form-control <?= isset($errosValidacaoGeral['complemento']) ? 'is-invalid' : '' ?>" id="complemento" name="geral[complemento]" value="<?= htmlspecialchars($dadosForm['complemento'] ?? '') ?>"> 
                <?php if (isset($errosValidacaoGeral['complemento'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['complemento'] ?>
                    </div>
                <?php endif; ?> 
            </div>
            <div class="col-md-6 col-12 mb-3"> 
                <label for="bairro" class="form-label">Bairro</label> 
                <input type="text" class="form-control <?= isset($errosValidacaoGeral['bairro']) ? 'is-invalid' : '' ?>" id="bairro" name="geral[bairro]" value="<?= htmlspecialchars($dadosForm['bairro'] ?? '') ?>" required> 
                <?php if (isset($errosValidacaoGeral['bairro'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['bairro'] ?>
                    </div>
                <?php endif; ?> 
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="cidade" class="form-label">Cidade</label> 
                <input type="text" class="form-control <?= isset($errosValidacaoGeral['cidade']) ? 'is-invalid' : '' ?>" id="cidade" name="geral[cidade]" value="<?= htmlspecialchars($dadosForm['cidade'] ?? '') ?>" required> 
                <?php if (isset($errosValidacaoGeral['cidade'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['cidade'] ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-12 mb-3"> 
                <label for="estado" class="form-label">Estado (UF)</label> 
                <input type="text" class="form-control <?= isset($errosValidacaoGeral['estado']) ? 'is-invalid' : '' ?>" id="estado" name="geral[estado]" value="<?= htmlspecialchars($dadosForm['estado'] ?? '') ?>" required maxlength="2" style="text-transform: uppercase;"> 
                <?php if (isset($errosValidacaoGeral['estado'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['estado'] ?>
                    </div>
                <?php endif; ?> 
            </div>
            <div class="col-md-6 col-12 mb-3"> 
                <label for="nomeboleto" class="form-label">Nome do destinatário do boleto</label> 
                <input type="text" class="form-control <?= isset($errosValidacaoGeral['nomeboleto']) ? 'is-invalid' : '' ?>" id="nomeboleto" name="geral[nomeboleto]" value="<?= htmlspecialchars($dadosForm['nomeboleto'] ?? '') ?>" required> 
                <?php if (isset($errosValidacaoGeral['nomeboleto'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['nomeboleto'] ?>
                    </div>
                <?php endif; ?> 
            </div>
            <div class="col-md-6 col-12 mb-3"> 
                <label for="emailboleto" class="form-label">E-mail para envio do boleto</label> 
                <input type="email" class="form-control <?= isset($errosValidacaoGeral['emailboleto']) ? 'is-invalid' : '' ?>" id="emailboleto" name="geral[emailboleto]" value="<?= htmlspecialchars($dadosForm['emailboleto'] ?? '') ?>" required> 
                <?php if (isset($errosValidacaoGeral['emailboleto'])): ?>
                    <div class="invalid-feedback">
                        <?= $errosValidacaoGeral['emailboleto'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <hr class="my-4">

            <!-- === Dados dos Participantes === -->
            <div class="col-12">
                <h4 class="text-center mb-4">Dados dos Participantes</h4>
                <div id="participantes-container">
                    <?php foreach ($dadosParticipantesForm as $index => $participanteData): ?>
                        <div class="participante-bloco" data-index="<?= $index ?>">
                            <h5>Participante <span class="participante-numero"><?= $index + 1 ?></span></h5>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-remover-participante" style="<?= count($dadosParticipantesForm) <= 1 ? 'display: none;' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg> Remover</button>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="nome_<?= $index ?>" class="form-label">Nome</label>
                                    <input type="text" class="form-control <?= isset($errosValidacaoParticipantes[$index]['nome']) ? 'is-invalid' : '' ?>" id="nome_<?= $index ?>" name="participantes[<?= $index ?>][nome]" value="<?= htmlspecialchars($participanteData['nome'] ?? '') ?>" required>
                                    <?php if (isset($errosValidacaoParticipantes[$index]['nome'])): ?><div class="invalid-feedback"><?= $errosValidacaoParticipantes[$index]['nome'] ?></div><?php endif; ?>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="email_<?= $index ?>" class="form-label">E-mail</label>
                                    <input type="email" class="form-control <?= isset($errosValidacaoParticipantes[$index]['email']) ? 'is-invalid' : '' ?>" id="email_<?= $index ?>" name="participantes[<?= $index ?>][email]" value="<?= htmlspecialchars($participanteData['email'] ?? '') ?>" required>
                                    <?php if (isset($errosValidacaoParticipantes[$index]['email'])): ?><div class="invalid-feedback"><?= $errosValidacaoParticipantes[$index]['email'] ?></div><?php endif; ?>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="telefone_<?= $index ?>" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control <?= isset($errosValidacaoParticipantes[$index]['telefone']) ? 'is-invalid' : '' ?>" id="telefone_<?= $index ?>" name="participantes[<?= $index ?>][telefone]" value="<?= htmlspecialchars($participanteData['telefone'] ?? '') ?>" placeholder="(XX) XXXXX-XXXX" required>
                                    <?php if (isset($errosValidacaoParticipantes[$index]['telefone'])): ?><div class="invalid-feedback"><?= $errosValidacaoParticipantes[$index]['telefone'] ?></div><?php endif; ?>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="cargo_<?= $index ?>" class="form-label">Cargo</label>
                                    <input type="text" class="form-control <?= isset($errosValidacaoParticipantes[$index]['cargo']) ? 'is-invalid' : '' ?>" id="cargo_<?= $index ?>" name="participantes[<?= $index ?>][cargo]" value="<?= htmlspecialchars($participanteData['cargo'] ?? '') ?>" required>
                                    <?php if (isset($errosValidacaoParticipantes[$index]['cargo'])): ?><div class="invalid-feedback"><?= $errosValidacaoParticipantes[$index]['cargo'] ?></div><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-3">
                    <button type="button" id="btn-add-participante" class="btn btn-outline-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg> Adicionar Participante</button>
                </div>
            </div>

            <hr class="my-4">

            <!-- Área de Preço ATUALIZADA -->
            <div class="col-12 my-4 p-3 border rounded text-center">
                <h4>Resumo do Valor</h4>
                <p class="lead mb-1">
                    <span class="fw-bold">Valor Base:</span> <span id="base-price-info">Calculando...</span> <span id="participant-type-label">por participante</span> <br>
                    (<span id="lote-info" class="badge bg-secondary"></span> <small><span id="lote-percent-info">?</span>% acréscimo - válido até <span id="preco-validade-info">?</span></small>)
                </p>
                <!-- Novo elemento para mostrar o desconto -->
                <p class="lead mb-1 text-secondary" id="discount-info" style="display: none;">
                    <span class="fw-bold">Desconto por quantidade:</span> -<span id="discount-value"></span> (<span id="discount-percent"></span>%)
                </p>
                <hr style="max-width: 300px; margin: 1rem auto;">
                <h3 class="fw-bold roxo">
                    TOTAL: <span id="preco-final-display">Calculando...</span>
                </h3>
            </div>

            <!-- Checkbox Termos e Submit -->
            <div class="col-12 mb-3 form-check">
                <input type="checkbox" class="form-check-input <?= isset($errosValidacaoGeral['exampleCheck1']) ? 'is-invalid' : '' ?>" id="exampleCheck1" name="geral[exampleCheck1]" value="1" <?= (isset($dadosForm['exampleCheck1']) && $dadosForm['exampleCheck1'] == '1') ? 'checked' : '' ?> required>
                <label class="form-check-label" for="exampleCheck1">Ao preencher o formulário, você está ciente que a ABIMAQ e os Patrocinadores/Palestrantes poderão enviar comunicações e conteúdos, que podem ser do interesse do setor de máquinas e equipamentos. Confira a nossa <a href="https://abimaq.org.br/hub-de-servicos/65/politica-de-privacidade" target="_blank">Política de Privacidade</a>.</label>
                <?php if (isset($errosValidacaoGeral['exampleCheck1'])): ?><div class="invalid-feedback"><?= $errosValidacaoGeral['exampleCheck1'] ?></div><?php endif; ?>
            </div>
            <div class="col-12">
                <input type="submit" class="btn btn-primary btn-lg" value="Realizar Inscrição">
            </div>
            
        </form>
    </div>

    <script src="src/js/bootstrap.bundle.min.js"></script>
    <script>
        // --- Constantes Globais vindas do PHP ---
        const PRECO_BASE_ASSOCIADO = <?= json_encode($precoBaseAssociadoJS) ?>;
        const PRECO_BASE_NAO_ASSOCIADO = <?= json_encode($precoBaseNaoAssociadoJS) ?>;
        const DATA_LIMITE_LOTE1 = new Date(<?= $dataLimiteLote1JS[0] ?>, <?= $dataLimiteLote1JS[1] ?>, <?= $dataLimiteLote1JS[2] ?>, 23, 59, 59);
        const DATA_LIMITE_LOTE2 = new Date(<?= $dataLimiteLote2JS[0] ?>, <?= $dataLimiteLote2JS[1] ?>, <?= $dataLimiteLote2JS[2] ?>, 23, 59, 59);
        const DATA_LIMITE_LOTE3 = new Date(<?= $dataLimiteLote3JS[0] ?>, <?= $dataLimiteLote3JS[1] ?>, <?= $dataLimiteLote3JS[2] ?>, 23, 59, 59);
        const PERCENTUAL_AUMENTO_LOTE2 = <?= json_encode($percentualAumentoLote2JS) ?>;
        const PERCENTUAL_AUMENTO_LOTE3 = <?= json_encode($percentualAumentoLote3JS) ?>;
        const PERCENTUAL_AUMENTO_LOTE4 = <?= json_encode($percentualAumentoLote4JS) ?>;
        const urlApiCnpjAssociado = <?= json_encode($urlApiCnpjAssociadoJS) ?>;
        const urlApiCep = <?= json_encode($urlApiCepJS) ?>;
        const urlApiRazaoSocial = <?= json_encode($urlApiRazaoSocialJS) ?>;

        // --- Espera o DOM ---
        document.addEventListener('DOMContentLoaded', () => {

            // --- Seletores ---
            const cnpjInput = document.getElementById('CNPJ');
            const empresaInput = document.getElementById('empresa');
            const cepInput = document.getElementById('cep');
            const logradouroInput = document.getElementById('logradouro');
            const numeroInput = document.getElementById('num');
            const complementoInput = document.getElementById('complemento');
            const bairroInput = document.getElementById('bairro');
            const cidadeInput = document.getElementById('cidade');
            const estadoInput = document.getElementById('estado');
            const cepFeedback = document.getElementById('cep-feedback');
            const precoFinalDisplay = document.getElementById('preco-final-display');
            const basePriceInfo = document.getElementById('base-price-info');
            const loteInfo = document.getElementById('lote-info');
            const lotePercentInfo = document.getElementById('lote-percent-info');
            const precoValidadeInfo = document.getElementById('preco-validade-info');
            const discountInfo = document.getElementById('discount-info'); // Novo
            const discountValue = document.getElementById('discount-value'); // Novo
            const discountPercent = document.getElementById('discount-percent');
            const participantesContainer = document.getElementById('participantes-container');
            const btnAddParticipante = document.getElementById('btn-add-participante');
            const participantTypeLabel = document.getElementById('participant-type-label');

            // --- Estado Global JS ---
            let isAssociadoGlobal = false;

            // --- Funções (formatarMoeda, formatarData, calcularPrecoFinal) ---
            const formatarMoeda = (valor) => {
                return (valor || 0).toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
            }; // Default 0
            const formatarData = (data) => {
                if (!data || !(data instanceof Date)) return '?';
                const dia = String(data.getDate()).padStart(2, '0');
                const mes = String(data.getMonth() + 1).padStart(2, '0');
                const ano = data.getFullYear();
                return `${dia}/${mes}/${ano}`;
            }
            const calcularPrecoFinal = (precoBase) => {
                const hoje = new Date();
                let precoCalculado = precoBase;
                let loteNumero = 1;
                let percentualAumento = 0;
                let dataLimiteLoteAtual = DATA_LIMITE_LOTE1;
                if (hoje <= DATA_LIMITE_LOTE1) {
                    loteNumero = 1;
                    percentualAumento = 0;
                    dataLimiteLoteAtual = DATA_LIMITE_LOTE1;
                } else if (hoje <= DATA_LIMITE_LOTE2) {
                    loteNumero = 2;
                    percentualAumento = PERCENTUAL_AUMENTO_LOTE2;
                    dataLimiteLoteAtual = DATA_LIMITE_LOTE2;
                } else if (hoje <= DATA_LIMITE_LOTE3) {
                    loteNumero = 3;
                    percentualAumento = PERCENTUAL_AUMENTO_LOTE3;
                    dataLimiteLoteAtual = DATA_LIMITE_LOTE3;
                } else {
                    loteNumero = 4;
                    percentualAumento = PERCENTUAL_AUMENTO_LOTE4;
                    dataLimiteLoteAtual = null;
                }
                precoCalculado = precoBase * (1 + percentualAumento / 100);
                precoCalculado = Math.round(precoCalculado * 100) / 100;
                return {
                    preco: precoCalculado,
                    lote: loteNumero,
                    percentual: percentualAumento,
                    dataLimite: dataLimiteLoteAtual
                };
            };

            // --- Função Atualizar Display Preço (ATUALIZADA com Desconto e Texto Dinâmico) ---
            const atualizarDisplayPreco = () => {
                if (!participantesContainer || !basePriceInfo || !loteInfo || !lotePercentInfo || !precoValidadeInfo || !precoFinalDisplay || !discountInfo || !discountValue || !discountPercent || !participantTypeLabel) { // <<< Adiciona verificação do novo seletor
                    console.error("Elementos do display de preço não encontrados!"); return;
                }

                const participantCount = participantesContainer.querySelectorAll('.participante-bloco').length;
                const basePricePerParticipant = isAssociadoGlobal ? PRECO_BASE_ASSOCIADO : PRECO_BASE_NAO_ASSOCIADO; // Usa estado global
                const resultadoLote = calcularPrecoFinal(basePricePerParticipant);
                const pricePerParticipantWithLote = resultadoLote.preco;

                // Calcula desconto (igual)
                let discountPercentage = 0;
                if (participantCount === 2) discountPercentage = 5;
                else if (participantCount === 3) discountPercentage = 10;
                else if (participantCount >= 4) discountPercentage = 15;
                const initialTotalPrice = pricePerParticipantWithLote * participantCount;
                const discountAmount = Math.round(initialTotalPrice * (discountPercentage / 100) * 100) / 100;
                const finalTotalPrice = initialTotalPrice - discountAmount;

                // Atualiza HTML
                basePriceInfo.textContent = formatarMoeda(basePricePerParticipant); // Exibe o valor base

                // **** ATUALIZA O TEXTO DINÂMICO ****
                participantTypeLabel.textContent = isAssociadoGlobal ? 'por convite associado' : 'por participante';
                // **** FIM DA ATUALIZAÇÃO DO TEXTO ****

                loteInfo.textContent = `Lote ${resultadoLote.lote}`;
                loteInfo.className = `badge bg-${resultadoLote.lote === 1 ? 'success' : resultadoLote.lote === 2 ? 'info' : resultadoLote.lote === 3 ? 'warning' : 'danger'}`;
                lotePercentInfo.textContent = resultadoLote.percentual;
                precoValidadeInfo.textContent = resultadoLote.dataLimite ? formatarData(resultadoLote.dataLimite) : 'Lote final';

                // Atualiza desconto (igual)
                if (discountPercentage > 0 && discountAmount > 0) {
                    discountValue.textContent = formatarMoeda(discountAmount);
                    discountPercent.textContent = discountPercentage;
                    discountInfo.style.display = 'block';
                } else {
                    discountInfo.style.display = 'none';
                }

                // Atualiza TOTAL FINAL (igual)
                precoFinalDisplay.textContent = formatarMoeda(finalTotalPrice);
            };


            // --- Funções (limparNumeros, consultarCep, setEnderecoFieldsState, limparCamposEndereco) ---
            const limparNumeros = (valor) => valor ? String(valor).replace(/\D+/g, '') : '';
            const setEnderecoFieldsState = (disabled, message = '') => {
                // Verifica se os elementos existem antes de tentar usá-los
                if (!logradouroInput || !bairroInput || !cidadeInput || !estadoInput || !complementoInput || !cepFeedback) {
                    console.warn("setEnderecoFieldsState: Elementos de endereço não encontrados.");
                    return;
                }
                logradouroInput.disabled = disabled;
                bairroInput.disabled = disabled;
                cidadeInput.disabled = disabled;
                estadoInput.disabled = disabled;
                complementoInput.disabled = disabled; // Número geralmente não é desabilitado
                if (message) {
                    cepFeedback.textContent = message;
                    cepFeedback.className = 'form-text text-muted'; // Estilo padrão para "buscando"
                }
                // Limpa a mensagem se estiver reabilitando e não houve sucesso/erro explícito
                if (!disabled && !cepFeedback.classList.contains('text-success') && !cepFeedback.classList.contains('text-danger')) {
                    cepFeedback.textContent = '';
                }
            };

            const limparCamposEndereco = () => {
                if (!logradouroInput || !bairroInput || !cidadeInput || !estadoInput || !complementoInput || !numeroInput) return;
                logradouroInput.value = '';
                bairroInput.value = '';
                cidadeInput.value = '';
                estadoInput.value = '';
                complementoInput.value = '';
                numeroInput.value = ''; // Limpa número também
            };
            const consultarCep = async (cep) => {
                console.log("-> consultarCep INICIADA com valor:", cep); // Log inicial

                // Verifica novamente se os elementos essenciais existem
                if (!cepInput || !logradouroInput || !bairroInput || !cidadeInput || !estadoInput || !complementoInput || !numeroInput || !cepFeedback) {
                    console.error("ERRO dentro de consultarCep: Elementos necessários não encontrados.");
                    return;
                }

                const cepLimpo = limparNumeros(cep);
                console.log("CEP Limpo:", cepLimpo);

                cepFeedback.textContent = '';
                cepFeedback.className = 'form-text';

                if (cepLimpo.length !== 8) {
                    console.log("Consulta CEP abortada: Comprimento inválido.", cepLimpo.length);
                    // Limpa campos se o CEP ficar inválido? Opcional.
                    // limparCamposEndereco();
                    return;
                }

                const finalUrl = `${urlApiCep}?cep=${cepLimpo}`;
                console.log("Preparando para chamar FETCH para URL:", finalUrl);

                setEnderecoFieldsState(true, 'Buscando CEP...');

                try {
                    console.log("ANTES do fetch...");
                    const response = await fetch(finalUrl);
                    console.log("DEPOIS do fetch (Resposta inicial recebida, status:", response.status + ")");

                    // Tenta ler o corpo como JSON em qualquer caso (erro ou sucesso)
                    // para obter a mensagem de erro da API, se houver.
                    const data = await response.json();
                    console.log("Resposta JSON decodificada:", data);

                    // Verifica o status HTTP E a resposta da API
                    if (!response.ok) {
                        // Erro HTTP (404, 500, etc.)
                        throw new Error(data.erro || `Erro HTTP ${response.status}`);
                    }

                    if (data.sucesso && data.dados) {
                        // Preenche os campos
                        logradouroInput.value = data.dados.logradouro || '';
                        bairroInput.value = data.dados.bairro || '';
                        cidadeInput.value = data.dados.localidade || '';
                        estadoInput.value = data.dados.uf || '';
                        complementoInput.value = data.dados.complemento || '';

                        cepFeedback.textContent = 'Endereço encontrado!';
                        cepFeedback.classList.add('text-success');
                        numeroInput.focus(); // Move foco para o número
                    } else {
                        // Sucesso HTTP, mas a API retornou erro (ex: CEP não encontrado)
                        throw new Error(data.erro || 'CEP não encontrado ou resposta inválida.');
                    }
                } catch (error) {
                    console.error('ERRO NO FETCH ou processamento da resposta CEP:', error);
                    cepFeedback.textContent = `Erro: ${error.message}`;
                    cepFeedback.classList.add('text-danger');
                    limparCamposEndereco(); // Limpa campos em caso de erro
                } finally {
                    console.log("Bloco FINALLY de consultarCep");
                    setEnderecoFieldsState(false); // Reabilita campos
                }
            };

            // --- Função Consultar CNPJ ---
            const consultarCnpj = async (cnpj) => {
                // ... (igual, mas no finally chama atualizarDisplayPreco() sem argumentos) ...
                if (!cnpjInput || !empresaInput) return;
                const cnpjLimpo = limparNumeros(cnpj);
                cnpjInput.style.borderColor = '';
                empresaInput.style.borderColor = '';
                if (cnpjLimpo.length !== 14) {
                    isAssociadoGlobal = false;
                    atualizarDisplayPreco();
                    empresaInput.value = '';
                    return;
                }
                cnpjInput.style.borderColor = 'orange';
                empresaInput.disabled = true;
                empresaInput.value = 'Buscando...';
                let isAssociado = false;
                try {
                    const responseRazao = await fetch(`${urlApiRazaoSocial}?cnpj=${cnpjLimpo}`);
                    const dataRazao = await responseRazao.json();
                    if (responseRazao.ok && dataRazao.sucesso && dataRazao.dados?.razao_social) {
                        empresaInput.value = dataRazao.dados.razao_social;
                        empresaInput.style.borderColor = '';
                    } else {
                        if (empresaInput.value === 'Buscando...') empresaInput.value = '';
                        empresaInput.style.borderColor = 'orange';
                    }
                } catch (error) {
                    if (empresaInput.value === 'Buscando...') empresaInput.value = '';
                    empresaInput.style.borderColor = 'red';
                } finally {
                    empresaInput.disabled = false;
                }
                try {
                    const responseAssociado = await fetch(`${urlApiCnpjAssociado}?cnpj=${cnpjLimpo}`);
                    const dataAssociado = await responseAssociado.json();
                    if (!responseAssociado.ok) {
                        cnpjInput.style.borderColor = 'red';
                        isAssociado = false;
                    } else if (dataAssociado.existe) {
                        cnpjInput.style.borderColor = 'green';
                        isAssociado = true;
                    } else {
                        isAssociado = false;
                        cnpjInput.style.borderColor = '';
                    }
                } catch (error) {
                    cnpjInput.style.borderColor = 'red';
                    isAssociado = false;
                } finally {
                    isAssociadoGlobal = isAssociado;
                    atualizarDisplayPreco();
                    if (cnpjInput.style.borderColor === 'orange') {
                        cnpjInput.style.borderColor = '';
                    }
                }
            };

            // --- Lógica para Adicionar/Remover Participantes ---
            const atualizarIndicesEVisibilidadeRemover = () => {
                const blocos = participantesContainer.querySelectorAll('.participante-bloco');
                blocos.forEach((bloco, idx) => {
                    const titulo = bloco.querySelector('.participante-numero');
                    if (titulo) titulo.textContent = idx + 1;
                    bloco.dataset.index = idx;
                    bloco.querySelectorAll('label[for], input[id], input[name]').forEach(el => { // Inclui label
                        const oldId = el.getAttribute('id');
                        const oldName = el.getAttribute('name');
                        const oldFor = el.getAttribute('for');
                        if (oldId) el.id = oldId.replace(/_\d+$/, `_${idx}`);
                        if (oldName) el.name = oldName.replace(/\[\d+\]/, `[${idx}]`);
                        if (oldFor) el.setAttribute('for', oldFor.replace(/_\d+$/, `_${idx}`));
                    });
                    const btnRemover = bloco.querySelector('.btn-remover-participante');
                    if (btnRemover) {
                        btnRemover.style.display = blocos.length > 1 ? '' : 'none';
                    }
                });
                atualizarDisplayPreco(); // <<< CHAMA ATUALIZAÇÃO DE PREÇO APÓS AJUSTAR ÍNDICES
            };

            const adicionarParticipante = () => {
                const ultimoBloco = participantesContainer.querySelector('.participante-bloco:last-child');
                if (!ultimoBloco) {
                    return;
                }
                const novoBloco = ultimoBloco.cloneNode(true);
                novoBloco.querySelectorAll('input').forEach(input => {
                    input.value = '';
                    input.classList.remove('is-invalid');
                });
                novoBloco.querySelectorAll('.invalid-feedback').forEach(div => div.textContent = '');
                participantesContainer.appendChild(novoBloco);
                atualizarIndicesEVisibilidadeRemover(); // Atualiza tudo após adicionar
            };

            if (btnAddParticipante) {
                btnAddParticipante.addEventListener('click', adicionarParticipante);
            }
            if (participantesContainer) {
                participantesContainer.addEventListener('click', (event) => {
                    const btnRemover = event.target.closest('.btn-remover-participante');
                    if (btnRemover) {
                        const blocoParaRemover = btnRemover.closest('.participante-bloco');
                        if (blocoParaRemover && participantesContainer.querySelectorAll('.participante-bloco').length > 1) {
                            blocoParaRemover.remove();
                            atualizarIndicesEVisibilidadeRemover(); // Atualiza tudo após remover
                        }
                    }
                });
            }

            // --- Event Listeners Gerais ---
            if (cnpjInput) {
                cnpjInput.addEventListener('blur', () => consultarCnpj(cnpjInput.value));
            }
            if (cepInput) {
                cepInput.addEventListener('blur', () => consultarCep(cepInput.value));
            }

            // --- Inicialização ---
            if (cnpjInput && cnpjInput.value.trim() !== '') {
                // A função consultarCnpj é async, mas não precisamos esperar por ela aqui
                // para o fluxo principal. Ela atualizará o preço no seu 'finally'.
                consultarCnpj(cnpjInput.value.trim());
            } else {
                // Se o CNPJ estiver vazio, garante que o preço seja calculado com base em "não associado"
                isAssociadoGlobal = false;
                atualizarDisplayPreco();
            }

        }); // Fim DOMContentLoaded
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const cnpjInput = document.getElementById('CNPJ');

    if (cnpjInput) {
        cnpjInput.addEventListener('input', function(event) {
            let value = event.target.value;

            // 1. Remove tudo que não for dígito
            value = value.replace(/\D/g, '');

            // 2. Limita a 14 dígitos (CNPJ)
            value = value.substring(0, 14);

            // 3. Aplica a máscara
            let formattedValue = '';
            if (value.length > 0) {
                formattedValue = value.substring(0, 2); // XX
            }
            if (value.length > 2) {
                formattedValue += '.' + value.substring(2, 5); // XX.XXX
            }
            if (value.length > 5) {
                formattedValue += '.' + value.substring(5, 8); // XX.XXX.XXX
            }
            if (value.length > 8) {
                formattedValue += '/' + value.substring(8, 12); // XX.XXX.XXX/XXXX
            }
            if (value.length > 12) {
                formattedValue += '-' + value.substring(12, 14); // XX.XXX.XXX/XXXX-XX
            }

            event.target.value = formattedValue;
        });

        // Opcional: Formatar ao carregar a página se já houver um valor (ex: vindo do PHP)
        if (cnpjInput.value) {
            let initialValue = cnpjInput.value.replace(/\D/g, '').substring(0, 14);
            let formattedInitialValue = '';
            if (initialValue.length > 0) {
                formattedInitialValue = initialValue.substring(0, 2);
            }
            if (initialValue.length > 2) {
                formattedInitialValue += '.' + initialValue.substring(2, 5);
            }
            if (initialValue.length > 5) {
                formattedInitialValue += '.' + initialValue.substring(5, 8);
            }
            if (initialValue.length > 8) {
                formattedInitialValue += '/' + initialValue.substring(8, 12);
            }
            if (initialValue.length > 12) {
                formattedInitialValue += '-' + initialValue.substring(12, 14);
            }
            cnpjInput.value = formattedInitialValue;
        }
    }
});
</script>

</body>

</html>