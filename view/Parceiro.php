<?php
// INICIA A SESSÃO OBRIGATORIAMENTE NO TOPO
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "model/db.class.php";

function Gerar($empresa, $CNPJ, $razao, $quantidade_convites) {
    if($empresa == false){
        $insert = DB::insert("empresas", array('cnpj'=>$CNPJ, 'razao_social'=>$razao, 'nome_boleto'=>'', 'email_boleto'=>''));
        // var_dump($insert);
    }else{
        // var_dump($empresa);
        $Participantes = DB::getTodos("participantes", array('where' => array('empresa_id'=>$empresa->id)));
        // var_dump($Participantes);

        if($Participantes == null){
            return $quantidade_convites = $quantidade_convites - 0;
        } else {
            $num = count($Participantes);

            $quantidade_convites = $quantidade_convites - $num;
            return $quantidade_convites;
        }
    }
}

// *** ALTERAÇÃO 1: INCLUIR O ARQUIVO DE CONFIGURAÇÃO ***
// Inclui o arquivo que define a quantidade de convites.
switch ($caminho) {
    case 'anamid':
        $quantidade_convites = 11;
        $nome_parceiro = "AnaMid";
        $CNPJ = "47967827000132";
        $razao = "ASSOCIACAO NACIONAL DO MERCADO E INDUSTRIA DIGITAL ANAMID";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
            header('location: limite');
        }
    break;
    case 'informa':
        $quantidade_convites = 6;
        $nome_parceiro = "Informa";
        $CNPJ = "01914765000108";
        $razao = "INFORMA MARKETS LTDA";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
            header('location: limite');
        }
    break;
    case 'tipo':
        $quantidade_convites = 16;
        $nome_parceiro = "Agência Tipo";
        $CNPJ = "21669624000176";
        $razao = "Tipo Publicidade LTDA";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
            header('location: limite');
        }
    break;
    case 'asta':
        $quantidade_convites = 4;
        $nome_parceiro = "Asta";
        $CNPJ = "62255682000130";
        $razao = "Ppe Fios Esmaltados S.a";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
            header('location: limite');
        }
    break;
    case 'tmd':
        $quantidade_convites = 8;
        $nome_parceiro = "TMD";
        $CNPJ = "15219638000195";
        $razao = "TMD STRATEGY LTDA";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
            header('location: limite');
        }
    break;
    case 'noara':
        $quantidade_convites = 7;
        $nome_parceiro = "Noara";
        $CNPJ = "30790076000129";
        $razao = "Noara Carina Pozzer Barbosa";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
            header('location: limite');
        }
    break;
    case 'programasom':
        $quantidade_convites = 6;
        $nome_parceiro = "PROGRAMASOM";
        $CNPJ = "53130563000160";
        $razao = "Programasom Producoes LTDA";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
            header('location: limite');
        }
    break;
    case 'jp':
        $quantidade_convites = 12;
        $nome_parceiro = "JP do Whats";
        $CNPJ = "04607705942";
        $razao = "João Paulo Nunes Borges";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'deea':
        $quantidade_convites = 10;
        $nome_parceiro = "Convidados DEEA";
        $CNPJ = "62646617000306";
        $razao = "Convidado ABIMAQ";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'estefania':
        $quantidade_convites = 3;
        $nome_parceiro = "Convidados Estefânia";
        $CNPJ = "00000000000095";
        $razao = "Convidado Estefânia";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'ello':
        $quantidade_convites = 1;
        $nome_parceiro = "Convidados ELLO";
        $CNPJ = "09477454000122";
        $razao = "ELLO SERVICOS PROFISSIONAIS LTDA";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'aps':
        $quantidade_convites = 4;
        $nome_parceiro = "Convidados AP&S";
        $CNPJ = "01913180000165";
        $razao = "Ap&S Editorial Feiras e Eventos LTDA";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'magma':
        $quantidade_convites = 2;
        $nome_parceiro = "Convidados Magma";
        $CNPJ = "02200801000126";
        $razao = "MAGMA ENGENHARIA DO BRASIL LTDA";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'tecnoaco':
        $quantidade_convites = 2;
        $nome_parceiro = "Convidados Tecnoaço";
        $CNPJ = "38085335000122";
        $razao = "TECNOACO - FUNDICAO DE ACO E LIGAS ESPECIAIS LTDA";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'injetaq':
        $quantidade_convites = 2;
        $nome_parceiro = "Convidados Injetaq";
        $CNPJ = "67117705000164";
        $razao = "INJETAQ INDUSTRIA E COMERCIO LTDA";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'cgitaim':
        $quantidade_convites = 5;
        $nome_parceiro = "CG Itaim";
        $CNPJ = "41333691000203";
        $razao = "CG Itaim Paulista";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'clm':
        $quantidade_convites = 1;
        $nome_parceiro = "CLM";
        $CNPJ = "18676987000124";
        $razao = "CLM";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'tele':
        $quantidade_convites = 1;
        $nome_parceiro = "Teleconexão";
        $CNPJ = "05741217000176";
        $razao = "Teleconexão";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'bidone':
        $quantidade_convites = 3;
        $nome_parceiro = "BidOne Gestão e Marketing";
        $CNPJ = "45498634000154";
        $razao = "BidOne Gestão e Marketing";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
    case 'rdigital':
        $quantidade_convites = 1;
        $nome_parceiro = "Result Digital";
        $CNPJ = "24723073000170";
        $razao = "Result Digital";
        $empresa = DB::getUm("empresas", array('where' => array('cnpj' => $CNPJ)));
        // var_dump($empresa);

        $quantidade_convites = Gerar($empresa, $CNPJ, $razao, $quantidade_convites);

        if($quantidade_convites == 0){
           header('location: limite');
        }
    break;
}

// var_dump($_POST);

// --- Feedback e Repopulação (igual ao anterior) ---

// var_dump($_POST);

header('Cache-Control: no-cache, no-store, private');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI 2025 - Inscrição <?= $nome_parceiro; ?></title>
    <link rel="stylesheet" href="src/css/bootstrap.css">
    <meta name="robots" content="noindex">
    <style>
        /* Seu CSS permanece o mesmo - omitido para brevidade */
        :root {
            --dark-bg: #121212;
            --dark-surface: #1e1e1e;
            --dark-text: #e0e0e0;
            --dark-text-secondary: #b0b0b0;
            --dark-border: #303030;
            --primary-color: #9686f2;
            --primary-color-dark: #e17a25;
            --secondary-color: #e17a25;
            --success-color: rgb(228, 139, 37);
            --danger-color: #cf6679;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--dark-text);
            padding-top: 80px;
        }

        .form-container {
            background-color: var(--dark-surface);
            padding: 3rem;
            border-radius: 0.5rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .form-control,
        .form-select {
            background-color: #282828;
            color: var(--dark-text);
            border: 1px solid #505050;
        }

        .form-control:focus {
            background-color: #282828;
            color: var(--dark-text);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(150, 134, 242, 0.25);
        }

        .participante-bloco {
            border: 1px solid var(--dark-border);
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 0.5rem;
            background-color: var(--dark-surface);
        }

        .participante-bloco h5 {
            color: var(--secondary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #8a78e8;
            border-color: #8a78e8;
        }

        .destaque {
            border: 1px dashed #fff;
            margin-top: 2rem;
        }

        .navbar {
            background-color: rgba(30, 30, 30, 0.95);
        }

        .navbar-brand img {
            filter: brightness(0) invert(1);
        }

        a {
            color: var(--primary-color);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="home"><img src="src/images/logo.png" width="150" alt="SMDI 2025 Logo"></a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <span class="nav-link active me-3 text-white"><b>Data:</b> 12 de agosto de 2025</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="col-12 pt-4 pb-3 text-center destaque">
            <h2 class="fs-1">Informações importantes</h2>
            <p>Todas as inserções devem ser feitas no mesmo momento<br>Caso precise alterar algum nome, envie um e-mail para eventos@abimaq.org.br.</p>
        </div>
        <form class="row my-5" method="post" name='post' action="">
            <h1 class="text-center pt-5 mb-3">Inscrição <?= $nome_parceiro; ?></h1>

            <!-- === Dados Financeiros (Empresa) === -->
            <h4 class="text-center mb-4 d-none">Dados Financeiros (Empresa)</h4>
            <div class="col-md-6 col-12 mb-3 d-none">
                <label for="CNPJ" class="form-label">CNPJ</label>
                <input type="text" class="form-control" id="CNPJ" name="geral[CNPJ]" value="<?= $CNPJ; ?>" maxlength="18" required readonly>
            </div>
            <div class="col-md-6 col-12 mb-3 d-none">
                <label for="empresa" class="form-label">Empresa (Razão Social)</label>
                <input type="text" class="form-control" id="empresa" name="geral[empresa]" value="<?= $razao; ?>" required readonly>
            </div>

            <hr class="my-4 d-none">

            <!-- === Dados dos Participantes === -->
            <div class="col-12">
                <h4 class="text-center mb-4">Dados dos Participantes</h4>
                <div id="participantes-container">

                    <!-- *** ALTERAÇÃO 2: LOOP PARA GERAR OS BLOCOS *** -->
                    <?php for ($i = 0; $i < $quantidade_convites; $i++) : ?>
                        <div class="participante-bloco" data-index="<?= $i ?>">
                            <!-- Título dinâmico para cada participante -->
                            <h5>Participante <?= $i + 1 ?></h5>
                            <div class="row">
                                <!-- 
                                    *** ALTERAÇÃO 3: ATRIBUTOS DINÂMICOS ***
                                    Os atributos 'id', 'for' e 'name' foram ajustados para serem únicos
                                    em cada iteração do loop. O 'name' usa a sintaxe de array (participantes[<?= $i ?>][...])
                                    para que o PHP receba os dados de forma organizada.
                                -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="nome_<?= $i ?>" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome_<?= $i ?>" name="participantes[<?= $i ?>][nome]" value="" required>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="email_<?= $i ?>" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email_<?= $i ?>" name="participantes[<?= $i ?>][email]" value="" required>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="telefone_<?= $i ?>" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" id="telefone_<?= $i ?>" name="participantes[<?= $i ?>][telefone]" value="" placeholder="(XX) XXXXX-XXXX" required>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="cargo_<?= $i ?>" class="form-label">Cargo</label>
                                    <input type="text" class="form-control" id="cargo_<?= $i ?>" name="participantes[<?= $i ?>][cargo]" value="" required>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                    <!-- Fim do loop -->

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