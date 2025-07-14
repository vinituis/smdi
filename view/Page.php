<?php
// --- PHP Vars (igual ao anterior) ---
$palestrantesConfirmados = true;
$programacaoDefinida = true;
$ingressosDisponiveis = true;
$patrocinadoresConfirmados = true;
$lotes = [
    // Lote 1: 02/06/2025 - 13/06/2025
    // Lote 2: 14/06/2025 - 27/06/2025
    // Lote 3: 28/06/2025 - 11/07/2025
    // Lote F: 12/07/2025 - 01/08/2025
    [
        'nome' => 'Lote 1',
        'inicio' => '02/06/2025',
        'fim' => '13/06/2025',
        'associado' => 200.00,
        'nao_associado' => 400.00
    ],
    [
        'nome' => 'Lote 2',
        'inicio' => '14/06/2025',
        'fim' => '27/06/2025',
        'associado' => 220.00,
        'nao_associado' => 440.00
    ],
    [
        'nome' => 'Lote 3',
        'inicio' => '28/06/2025',
        'fim' => '11/07/2025',
        'associado' => 240.00,
        'nao_associado' => 480.00
    ],
    [
        'nome' => 'Lote Final',
        'inicio' => '12/07/2025',
        'fim' => '01/08/2025',
        'associado' => 260.00,
        'nao_associado' => 520.00
    ],
];
$linkInscricao = 'individual';
$palestrantes = [
    [
        'foto' => 'src/images/palestrante/beatriz.png',
        'nome' => 'Beatriz Guarezi',
        'titulo' => 'Especialista em branding, criadora de conteúdo, TEDx Speaker e LinkedIn Top Voice.',
        'bio' => 'Criadora da Bits to Brands, ela lidera um movimento que revoluciona a forma como profissionais pensam e constroem marcas. Com diversos prêmios e reconhecimentos, Beatriz conversa com mais de 100 mil profissionais em sua newsletter e redes sociais.',
        'linkedin' => 'https://www.linkedin.com/in/beatrizguarezi/'
    ],
    [
        'foto' => 'src/images/palestrante/gui.png',
        'nome' => 'Gui de Bortoli',
        'titulo' => 'Pai de duas filhas e Top 100 Profissionais Digitais de 2023.',
        'bio' => 'Com 28 anos de experiência, Gui é CEO da Orgânica Digital, agência com 17 anos de mercado e pioneira no método Content+Performance. Sob sua liderança, a empresa conquistou o selo Google Partner Premier, foi reconhecida quatro vezes como uma das melhores do ano.',
        'linkedin' => 'https://www.linkedin.com/in/guilhermebortoli/'
    ],
    [
        'foto' => 'src/images/palestrante/vinicius.png',
        'nome' => 'Vinicius Melo',
        'titulo' => 'CEO da D2B e Vice-presidente de Expansão da AnaMid',
        'bio' => 'Formado em Publicidade e Propaganda (Unaerp) com especialização em Redes Sociais e Inovação Digital (ESPM). Empreendedor, professor em cursos de pós-graduação (Unifran, Senac e Iladec/Itália). Palestrante em eventos como o Digitalks, Ecommerce Brasil e Fórum de Marketing da AMCHAM.',
        'linkedin' => 'https://www.linkedin.com/in/viniciusmelo84/'
    ],
];
$embaixadores = [
    [
        'foto' => 'src/images/palestrante/noara.png',
        'nome' => 'Noara Pozzer',
        'titulo' => 'Especialista em atendimento, vendas, marketing e liderança',
        'bio' => 'Se dedica há mais de 18 anos a melhorar os resultados em vendas e comportamento em empresas. Treinadora de equipes de alta performance, desenvolvedora dos Métodos Vendedor e Líder de resultado, professora de MBA e é consultora, palestrante e professora com foco em inovação, estratégia e cuidado com pessoas.',
        'linkedin' => 'https://www.linkedin.com/in/noarapozzer/'
    ],
     [
        'foto' => 'src/images/palestrante/jp.png',
        'nome' => 'João Paulo (JP do Whats)',
        'titulo' => 'Um pioneiro no marketing conversacional',
        'bio' => 'Conhecido como JP do Whats, é uma das maiores referências no Brasil no uso estratégico do WhatsApp como ferramenta de engajamento e comunicação de alto impacto. Desde 2016, JP explora o potencial do WhatsApp como canal estratégico, compartilhando sua expertise em mais de 70 palestras presenciais e on-line, impactando milhares de pessoas.',
        'linkedin' => 'https://www.linkedin.com/in/jpdowhats/'
    ],
];
$programacao = [
    [
        'horario' => '13:30 - 14:00',
        'titulo' => 'Credenciamento',
        'palestrante' => null,
        'descricao' => 'Recebimento dos participantes, entrega de materiais.'
    ],
    [
        'horario' => '14:00 - 15:00',
        'titulo' => 'Palestra Magna',
        'palestrante' => 'A definir',
        'descricao' => null
    ],
    [
        'horario' => '15:10 - 16:00',
        'titulo' => 'Trilha 1: Marketing',
        'palestrante' => 'Beatriz Guarezi',
        'descricao' => null
    ],
    [
        'horario' => '15:10 - 16:00',
        'titulo' => 'Trilha 1: Vendas',
        'palestrante' => 'Vinicius Mello',
        'descricao' => null
    ],
    [
        'horario' => '16:10 - 17:00',
        'titulo' => 'Trilha 2: Marketing',
        'palestrante' => 'Gui de Bortoli',
        'descricao' => null
    ],
    [
        'horario' => '16:10 - 17:00',
        'titulo' => 'Trilha 2: Vendas',
        'palestrante' => 'Sara Zimmermann',
        'descricao' => null
    ],
    [
        'horario' => '17:10 - 18:00',
        'titulo' => 'Encerramento e Coquetel de Networking',
        'palestrante' => null,
        'descricao' => 'Celebre o aprendizado, fortaleça conexões e gere novas oportunidades de negócio em um ambiente descontraído.'
    ],
];
$patrocinadoresRubi = [
    [
        'logo' => 'src/images/patrocinador/caminhos-rubi/tipo.png', // Substituir por logo real
        'link' => 'https://www.agenciatipo.com.br/', // Substituir por link real
        'nome' => 'Agência Tipo'
    ],
];

$patrocinadoresOuro = [

];

$patrocinadoresPrata = [
    [
        'logo' => 'src/images/patrocinador/explorador-prata/logo-tmd-strategy.png', // Substituir por logo real
        'link' => 'https://tmdstrategy.com.br/', // Substituir por link real
        'nome' => 'TMD Strategy'
    ],
    [
        'logo' => 'src/images/patrocinador/explorador-prata/noara.png', // Substituir por logo real
        'link' => 'https://noarapozzer.com.br/', // Substituir por link real
        'nome' => 'Noara Pozzer'
    ],
    [
        'logo' => 'src/images/patrocinador/explorador-prata/JPDOWHATS.png', // Substituir por logo real
        'link' => 'https://www.jpdowhats.com.br/', // Substituir por link real
        'nome' => 'JP do Whats'
    ]
];
$patrocinadoresBronze = [
    [
        'logo' => 'src/images/patrocinador/descobridor-bronze/anamid.png', // Substituir por logo real
        'link' => 'https://www.anamid.com.br/', // Substituir por link real
        'nome' => 'AnaMid'
    ],
    [
        'logo' => 'src/images/patrocinador/descobridor-bronze/programasom.png', // Substituir por logo real
        'link' => 'https://programasom.com.br/', // Substituir por link real
        'nome' => 'ProgramaSom'
    ],
    [
        'logo' => 'src/images/patrocinador/descobridor-bronze/vitamina.png', // Substituir por logo real
        'link' => 'https://vitaminaweb.digital/', // Substituir por link real
        'nome' => 'Vitamina Web'
    ],
];
$apoiador = [
    [
        'logo' => 'src/images/patrocinador/apoio/aVoz.png', // Substituir por logo real
        'link' => 'https://avozdaindustria.com.br/', // Substituir por link real
        'nome' => 'A Voz da Indústria'
    ],
    [
        'logo' => 'src/images/patrocinador/apoio/mundoPlastico.png', // Substituir por logo real
        'link' => 'https://mundodoplastico.plasticobrasil.com.br/', // Substituir por link real
        'nome' => 'Mundo do Plástico'
    ],
];

header('Cache-Control: no-cache, no-store, private');

// +++ ADICIONAR ESTA LINHA +++
date_default_timezone_set('America/Sao_Paulo'); // Defina seu fuso horário
$hoje = new DateTime();
$hoje->setTime(0, 0, 0); // Normaliza para meia-noite para comparações de data consistentes


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI 2025 - Seminário de Marketing Digital na Indústria</title>
    <!-- Atenção: Removi o require duplicado do Head.php -->
    <?php require "assets/Head.php"; ?>
    <link rel="stylesheet" href="src/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Link para a biblioteca AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <meta name="robots" content="noindex"> -->
    <style>
        /* Cores e Fundos para Dark Theme Aprimorado */
        :root {
            --dark-bg: #121212; /* Fundo principal bem escuro */
            --dark-surface: #1e1e1e; /* Cor de superfície para cards, tabelas */
            --dark-text: #e0e0e0; /* Cor de texto principal */
            --dark-text-secondary: #b0b0b0; /* Cor de texto secundária/suave */
            --dark-border: #303030; /* Cor de bordas e divisores */
            --primary-color: #9686f2; /* Cor primária (um azul vibrante) */
            --primary-color-dark: #e17a25; /* Versão mais escura da primária */
            --secondary-color:#e17a25; /* Cor secundária (um roxo/lilás) */
            --success-color:rgb(228, 139, 37); /* Cor de sucesso (verde-água) */
            --danger-color: #cf6679; /* Cor de perigo/erro (vermelho suave) */
            --highlight-color:rgba(241, 241, 241, 0.0) /* Cor para destacar áreas */
        }

        .laranja {
            color: var(--secondary-color) !important;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--dark-text);
            font-family: 'Roboto', sans-serif; /* Sugestão de fonte mais moderna */
            line-height: 1.6;
            overflow-x: hidden; /* Evita scroll horizontal causado por animações */
        }

        h1, h2, h3, h4, h5, h6 {
            color: #ffffff; /* Títulos mais claros */
            font-weight: 700;
            margin-bottom: 1rem; /* Espaçamento padrão abaixo dos títulos */
        }

        p {
             margin-bottom: 1rem;
             color: var(--dark-text-secondary); /* Texto do parágrafo mais suave */
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

        .link-footer, .link-contato {
             color: var(--dark-text-secondary);
             text-decoration: none;
             transition: color 0.3s ease;
        }
        .link-footer:hover, .link-contato:hover {
             color: var(--primary-color);
             text-decoration: underline;
        }

        .text-muted {
            color: var(--dark-text-secondary) !important; /* Garante a cor suave */
        }

        /* Navbar Aprimorada */
        .navbar {
            background-color: rgba(30, 30, 30, 0.95); /* Fundo semitransparente para o dark theme */
            backdrop-filter: blur(10px); /* Efeito de blur para modernizar */
            -webkit-backdrop-filter: blur(10px); /* Compatibilidade Safari */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

         /* Adiciona classe para navbar ao rolar */
        .navbar.scrolled {
            background-color: var(--dark-surface); /* Cor sólida ao rolar */
        }


        .navbar-brand img {
            filter: brightness(0) invert(1); /* Logo branco/claro */
            transition: transform 0.3s ease; /* Transição suave para o hover */
        }

         .navbar-brand img:hover {
             transform: scale(1.05); /* Efeito de zoom no hover */
         }


        .navbar-toggler {
            border-color: var(--dark-border);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23e0e0e0' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); /* Ícone do toggler claro */
        }


        .navbar-nav .nav-link {
            color: var(--dark-text) !important; /* Cor dos links */
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important; /* Cor ao hover e ativo */
            background-color: var(--highlight-color);
        }

         .navbar-text {
             color: var(--dark-text-secondary); /* Cor do texto da data */
         }


        .btn-cta {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #ffffff;
            font-weight: bold;
            padding: 0.5rem 1.5rem;
            border-radius: 50px; /* Botões mais arredondados */
            transition: all 0.3s ease;
        }

        .btn-cta:hover {
            background-color: var(--primary-color-dark);
            border-color: var(--primary-color-dark);
            color: #ffffff;
            transform: translateY(-2px); /* Leve elevação no hover */
            box-shadow: 0 4px 10px rgba(0, 170, 255, 0.3);
        }


        /* Seções */
        section {
            padding: 80px 0; /* Mais padding vertical para dar respiro */
        }

        section#home {
            padding-top: 120px; /* Ajuste para a navbar fixa */
        }

        .title {
            font-size: 2.5rem; /* Tamanho maior para os títulos das seções */
            font-weight: 700;
            margin-bottom: 3rem; /* Espaço maior abaixo dos títulos */
            position: relative;
            text-align: center;
        }

        .title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background-color: var(--primary-color);
            margin: 10px auto 0;
            border-radius: 2px;
        }


        /* Seção Hero */
        .hero-section {
            position: relative;
            height: 100vh; /* Altura total da viewport */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            background: url('src/images/fundo.jpg') no-repeat center center/cover; /* Adicione uma imagem de fundo */
            overflow: hidden; /* Esconde o que transborda */
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Overlay escuro para melhor contraste do texto */
        }

        .hero-content {
            position: relative; /* Para ficar acima do overlay */
            z-index: 1;
        }

        .hero-content h1 {
             color: white; /* Título principal branco */
             font-size: 3rem; /* Tamanho maior em telas grandes */
         }

         .hero-content p {
             color: rgba(255, 255, 255, 0.8); /* Texto do parágrafo mais suave */
         }

        .btn-primary-cta {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #ffffff;
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary-cta:hover {
            background-color: var(--primary-color-dark);
            border-color: var(--primary-color-dark);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 170, 255, 0.3);
        }


        .btn-secondary-cta {
            background-color: transparent;
            border-color: var(--dark-text);
            color: var(--dark-text);
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-secondary-cta:hover {
            background-color: var(--dark-text);
            border-color: var(--dark-text);
            color: var(--dark-bg);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
        }


        /* Seção Palestrantes */
        .palestrante-img {
            width: 150px; /* Tamanho fixo para a imagem */
            height: 150px;
            object-fit: cover; /* Garante que a imagem não distorça */
            border: 5px solid var(--dark-surface); /* Borda para destacar */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
             transition: transform 0.3s ease; /* Animação no hover */
        }

         .palestrante-img:hover {
             transform: scale(1.05);
         }


        .card.h-100 {
            background-color: var(--dark-surface);
            color: var(--dark-text);
            border: 1px solid var(--dark-border);
             transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animação no hover */
        }

         .card.h-100:hover {
             transform: translateY(-5px); /* Leve elevação no hover */
             box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
         }

        .card-title {
            color: #ffffff; /* Título do card mais claro */
        }

        .card-text {
            color: var(--dark-text-secondary); /* Texto do card mais suave */
        }

        .btn-outline-primary {
             color: var(--primary-color);
             border-color: var(--primary-color);
             transition: all 0.3s ease;
         }

         .btn-outline-primary:hover {
             background-color: var(--primary-color);
             color: var(--dark-surface);
             border-color: var(--primary-color);
         }


        /* Seção Programação */
        .programacao-item {
            padding: 1.5rem 0; /* Espaço maior entre os itens */
            border-bottom: 1px solid var(--dark-border); /* Separador sutil */
            align-items: flex-start; /* Alinha o horário no topo */
        }

        .programacao-item:last-child {
            border-bottom: none; /* Remove a borda do último item */
        }

        .programacao-item .fw-bold {
            color: var(--primary-color); /* Cor de destaque para o horário */
            font-size: 1.1rem;
        }

        .programacao-item h5 {
            color: #ffffff; /* Título da atividade mais claro */
            margin-bottom: 0.5rem;
        }

        .programacao-item .text-muted {
            font-style: italic; /* Itálico para o nome do palestrante */
        }

        .programacao-item .small {
            color: var(--dark-text-secondary); /* Descrição mais suave */
        }

         .border-start-md {
             border-left: 1px solid var(--dark-border) !important; /* Garante a cor da borda vertical */
         }

        /* Seção Ingressos */
        /* Estilo para os Cards de Lote */
        .card-lote {
            background-color: var(--dark-surface);
            color: var(--dark-text);
            border: 1px solid var(--dark-border);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex; /* Garante que o flexbox no body funcione */
             flex-direction: column; /* Garante que o conteúdo interno se organize em coluna */
        }

        .card-lote:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
        }

        .card-lote .card-header {
            background-color: #252525; /* Fundo do cabeçalho do lote */
            border-bottom: 1px solid var(--dark-border);
            color: var(--primary-color); /* Cor do nome do lote */
            padding: 0.75rem 1.25rem; /* Espaçamento interno */
            font-size: 1.1rem;
        }

        .card-lote .card-body {
            padding: 1.5rem; /* Espaçamento interno do corpo */
             display: flex; /* Usa flexbox para alinhar o conteúdo verticalmente */
             flex-direction: column;
        }

        .card-lote-divider {
            border-top: 1px solid var(--dark-border); /* Linha divisória */
            opacity: 0.5; /* Transparência para ser sutil */
             width: 80%; /* Largura menor */
             margin: 1rem auto; /* Centraliza */
        }

        .card-lote .card-title {
            font-size: 1.3rem; /* Tamanho maior para os valores */
            margin-bottom: 0.5rem;
        }

        .card-lote .text-success {
             color: var(--success-color) !important; /* Garante a cor de sucesso */
        }

         .card-lote .text-primary {
             color: var(--primary-color) !important; /* Usa a cor primária para não associado */
         }

        .card-lote .fw-semibold {
            color: var(--dark-text); /* Cor mais clara para os rótulos "Associado/Não Associado" */
        }

        .card-lote .text-muted {
             color: var(--dark-text-secondary) !important; /* Cor suave para o período */
        }

        /* Ajustes responsivos para os cards de lote */
        @media (max-width: 767.98px) {
            .card-lote {
                width: 100%;
            }
             .card-lote .card-body {
                 padding: 1rem; /* Reduz padding no mobile */
             }
             .card-lote .card-title {
                 font-size: 1.1rem; /* Reduz tamanho do valor no mobile */
             }
             .card-lote .card-header {
                 font-size: 1rem; /* Reduz tamanho do cabeçalho no mobile */
             }
        }

        .table {
            --bs-table-bg: var(--dark-surface); /* Fundo da tabela */
            --bs-table-color: var(--dark-text); /* Cor do texto da tabela */
            --bs-table-border-color: var(--dark-border); /* Cor das bordas da tabela */
            --bs-table-striped-bg: #2b2b2b; /* Fundo das linhas alternadas */
            --bs-table-hover-bg: #3a3a3a; /* Fundo ao hover */
        }

        .table thead th {
            color: var(--primary-color); /* Cabeçalho da tabela com cor primária */
            border-bottom-color: var(--primary-color);
            font-weight: bold;
        }

        .table tbody th {
            color: #ffffff; /* Nome do lote mais claro */
        }

        .bg-light-alt {
             background-color: var(--dark-surface) !important; /* Fundo para a caixa de descontos */
             border: 1px dashed var(--secondary-color); /* Borda pontilhada para destaque */
         }

         .bg-light-alt h4 {
             color: var(--secondary-color); /* Título da caixa de descontos com cor secundária */
         }

         .bg-light-alt ul {
             padding-left: 0; /* Remove padding padrão da lista */
         }

         .bg-light-alt li {
             color: var(--dark-text); /* Cor do texto da lista */
             margin-bottom: 0.5rem;
         }

         .bg-light-alt strong {
             color: var(--success-color); /* Cor de destaque para os valores de desconto */
         }


        .btn-cta-inscricao {
            background-color: var(--success-color); /* Botão de inscrição com cor de sucesso */
            border-color: var(--success-color);
            color: var(--dark-bg); /* Texto escuro para contraste */
            font-weight: bold;
            font-size: 1.5rem; /* Tamanho maior */
            padding: 1rem 3rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-cta-inscricao:hover {
            background-color: #02a794; /* Versão mais escura da cor sucesso */
            border-color: #02a794;
            color: var(--dark-bg);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(3, 218, 198, 0.4);
        }

        /* Seção Local */
         #local {
             background-color: var(--dark-surface); /* Fundo sutilmente diferente */
         }

         #local h4 {
             color: #ffffff; /* Título do local claro */
         }

         #local p {
              color: var(--dark-text); /* Texto do endereço e informações */
         }

        .btn-outline-light {
             color: var(--dark-text);
             border-color: var(--dark-border);
             transition: all 0.3s ease;
         }

         .btn-outline-light:hover {
             background-color: var(--dark-border);
             color: var(--dark-text);
         }

        .ratio iframe {
            border: none; /* Remove borda padrão do iframe */
        }

        /* Seção Patrocinio */
        #patrocinio {
             background-color: var(--dark-bg); /* Volta para o fundo principal */
        }

        #patrocinio .lead {
             color: var(--dark-text-secondary); /* Texto introdutório suave */
        }

         #patrocinio h4, #patrocinio h3 {
              color: #ffffff; /* Títulos claros */
         }

         #patrocinio .bi {
             color: #f1f1f1; /* Ícones com cor secundária */
         }

         #patrocinio ul li {
             color: var(--dark-text); /* Texto da lista */
         }

         #patrocinio ul li .bi-check-circle-fill {
             color: var(--success-color); /* Ícones de check com cor sucesso */
         }

        .card-cota {
            background-color: var(--dark-surface);
            color: var(--dark-text);
            border: 1px solid var(--dark-border);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
             transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animação no hover */
        }
         .card-cota:hover {
             transform: translateY(-5px); /* Leve elevação */
             box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
         }

        .card-cota .card-header {
            background-color: #252525; /* Fundo do cabeçalho do card de cota */
            border-bottom: 1px solid var(--dark-border);
            color: var(--primary-color); /* Cor do título da cota */
        }

        .card-cota .card-title {
            color: var(--success-color); /* Cor do valor da cota */
        }

        .card-cota ul {
            padding-left: 1rem; /* Espaço para os ícones na lista */
        }

        .card-cota ul li {
            list-style: none; /* Remove bullet points */
            margin-bottom: 0.5rem;
            color: var(--dark-text);
        }

        .card-cota ul li .bi {
            color: var(--success-color); /* Ícones da lista com cor sucesso */
            margin-right: 0.5rem;
        }

        .btn-primary {
             background-color: var(--primary-color);
             border-color: var(--primary-color);
             color: #ffffff;
             transition: all 0.3s ease;
         }
         .btn-primary:hover {
             background-color: var(--primary-color-dark);
             border-color: var(--primary-color-dark);
             color: #ffffff;
         }


        .btn-secondary {
             background-color: var(--secondary-color);
             border-color: var(--secondary-color);
             color: var(--dark-bg);
             transition: all 0.3s ease;
         }
         .btn-secondary:hover {
             background-color: #a576e0; /* Versão mais escura */
             border-color: #a576e0;
             color: var(--dark-bg);
         }

        .link-contato {
             font-size: 1.2rem;
         }


        /* Seção Patrocinadores (Logos) */
         #patrocinadores {
             background-color: var(--dark-surface); /* Fundo sutilmente diferente */
         }

        .sponsor-tier {
            color: var(--secondary-color); /* Título da categoria de patrocinador */
            font-size: 1.5rem;
            font-weight: 600;
        }

        .patrocinador-logo {
            /*max-height: 80px; /* Tamanho máximo para as logos */
            /*max-width: 150px; /* Tamanho máximo para as logos */
            /*filter: brightness(0) invert(1) opacity(0.7); /* Logos brancas/claras e semitransparentes */
            margin: 20px 30px; /* Espaço entre as logos */
            transition: all 0.3s ease; /* Animação no hover */
            /* padding: 1rem; */
            background-color: #fff;
        }

        .patrocinador-logo:hover {
            /*filter: brightness(0) invert(1) opacity(1); /* Fica totalmente opaco no hover */
            transform: scale(1.1); /* Leve zoom no hover */
        }

        /* Rodapé */
        footer {
            background-color: #1a1a1a; /* Fundo do rodapé */
            color: var(--dark-text-secondary);
            padding: 40px 0;
        }

        .footer-divider {
            border-top: 1px solid var(--dark-border);
        }

        .link-social {
            font-size: 1.5rem;
            color: var(--dark-text-secondary);
             transition: color 0.3s ease;
        }
         .link-social:hover {
             color: var(--primary-color);
         }

        .footer-copy {
            color: #555; /* Texto de copyright mais escuro */
            margin-top: 20px;
        }

        /* Animações adicionais (exemplo com keyframes) */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }

        .btn-cta-inscricao {
             animation: pulse 2s infinite ease-in-out; /* Exemplo de animação no botão de inscrição */
         }

         /* Ajustes responsivos */
         @media (max-width: 768px) {
             .navbar-collapse {
                 background-color: rgba(30, 30, 30, 0.98);
                 border-top: 1px solid var(--dark-border);
                 padding-top: 10px;
             }
             .navbar-nav {
                 align-items: center; /* Centraliza links no mobile */
             }
             .navbar-nav .nav-item {
                 margin-bottom: 10px;
             }
             .navbar-text {
                 text-align: center;
                 margin-bottom: 10px;
             }
             .hero-content h1 {
                 font-size: 2rem; /* Reduz tamanho do título no mobile */
             }
             .hero-content p {
                 font-size: 1rem;
             }
             .programacao-item {
                 flex-direction: column;
             }
             .programacao-item .flex-shrink-0 {
                 text-align: start !important;
                 margin-bottom: 10px !important;
                 min-width: auto !important;
             }
             .programacao-item .border-start-md {
                 border-left: none !important;
                 padding-left: 0 !important;
                 border-top: 1px solid var(--dark-border);
                 padding-top: 10px;
             }
             .patrocinador-logo {
                 max-height: 60px; /* Logos menores no mobile */
                 margin: 15px 20px;
             }
              section {
                padding: 60px 0; /* Menos padding vertical no mobile */
            }
             section#home {
                padding-top: 100px;
             }

         }

         /* +++ ADICIONAR ESTE ESTILO CSS PARA O DESTAQUE +++ */
        .lote-atual-destaque {
            border: 3px solid var(--primary-color) !important; /* Borda mais grossa e colorida */
            box-shadow: 0 0 15px rgba(150, 134, 242, 0.7) !important; /* Um brilho sutil usando a cor primária com alfa */
            transform: scale(1.03); /* Opcional: levemente maior para chamar mais atenção */
            z-index: 10; /* Para garantir que fique por cima de outros elementos se houver sobreposição */
        }
        .lote-atual-destaque .card-header {
            background-color: var(--primary-color) !important;
            color: #ffffff !important; /* Garante que o texto do header seja branco e legível */
            font-weight: bold;
        }
        /* +++ FIM DO ESTILO CSS PARA DESTAQUE +++ */

    </style>
</head>

<body>
    <!-- Cabeçalho -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="home"><img src="src/images/logo.png" width="150" alt="SMDI 2025 Logo"></a>
            <div class="collapse navbar-collapse" id="navbarNavContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#palestrantes">Palestrantes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#programacao">Programação</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ingressos">Ingressos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#local">Local</a></li>
                    <li class="nav-item"><a class="nav-link" href="#patrocinio">Patrocínio</a></li>
                </ul>
                <div class="d-flex align-items-lg-center flex-column flex-lg-row mt-3 mt-lg-0">
                    <span class="navbar-text me-lg-3 mb-2 mb-lg-0"><b>Data:</b> 12/08/2025</span>
                    <a class="btn btn-cta" href="#ingressos">Garanta sua Vaga!</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Seção Hero -->
    <section id="home" class="hero-section" data-aos="fade-in">
        <div class="hero-overlay"></div>
        <div class="container hero-content d-flex flex-column justify-content-center align-items-center text-center px-3">
            <small>Dia 12/08/2025 às 13h30</small>
            <h1 class="display-4 fw-bold mb-3" data-aos="fade-up" data-aos-delay="200">Explorando novos caminhos</h1>
            <p class="fs-5 mb-5 mt-3" style="max-width: 800px;" data-aos="fade-up" data-aos-delay="400">A evolução do marketing e vendas na era digital.</p>
            <div data-aos="fade-up" data-aos-delay="600">
                <a href="#ingressos" class="btn btn-primary-cta btn-lg me-md-2 mb-2 mb-md-0">Ver Ingressos</a>
                <a href="#programacao" class="btn btn-secondary-cta btn-lg mb-2 mb-md-0">Ver Programação</a>
            </div>
        </div>
    </section>

    <!-- Seção Palestrantes -->
    <section id="palestrantes" class="py-5">
        <div class="container">
            <h2 class="text-center py-4 title" data-aos="fade-up">Conheça os Embaixadores</h2>
            <?php if ($palestrantesConfirmados && !empty($embaixadores)): ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                    <?php $aos_delay = 100; ?>
                    <?php foreach ($embaixadores as $embaixador): ?>
                        <div class="col" data-aos="fade-up" data-aos-delay="<?= $aos_delay ?>">
                            <div class="card h-100 text-center shadow-sm">
                                <div class="card-body d-flex flex-column align-items-center p-4">
                                    <img src="<?= htmlspecialchars($embaixador['foto']) ?>" class="card-img-top embaixador-img rounded-circle mb-3 w-50" alt="Foto de <?= htmlspecialchars($embaixador['nome']) ?>">
                                    <h5 class="card-title mb-1 fw-semibold"><?= htmlspecialchars($embaixador['nome']) ?></h5>
                                    <p class="text-muted mb-3"><small><?= htmlspecialchars($embaixador['titulo']) ?></small></p>
                                    <p class="card-text small mb-4"><?= htmlspecialchars($embaixador['bio']) ?></p>
                                    <?php if (!empty($embaixador['linkedin']) && $embaixador['linkedin'] !== '#'): ?>
                                        <a href="<?= htmlspecialchars($embaixador['linkedin']) ?>" target="_blank" class="btn btn-outline-primary btn-sm mt-auto">
                                            <i class="bi bi-linkedin"></i> LinkedIn
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php $aos_delay += 100; ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5" data-aos="fade-up">
                    <h3 class="laranja">Em breve, divulgaremos os palestrantes confirmados. Fique ligado!</h4>
                    <p>Já estamos em contato com grandes nomes do mercado...</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- Seção Palestrantes -->
    <section id="embaixadores" class="py-5">
        <div class="container">
            <h2 class="text-center py-4 title" data-aos="fade-up">Conheça os Especialistas</h2>
            <?php if ($palestrantesConfirmados && !empty($palestrantes)): ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                    <?php $aos_delay = 100; ?>
                    <?php foreach ($palestrantes as $palestrante): ?>
                        <div class="col" data-aos="fade-up" data-aos-delay="<?= $aos_delay ?>">
                            <div class="card h-100 text-center shadow-sm">
                                <div class="card-body d-flex flex-column align-items-center p-4">
                                    <img src="<?= htmlspecialchars($palestrante['foto']) ?>" class="card-img-top palestrante-img rounded-circle mb-3 w-50" alt="Foto de <?= htmlspecialchars($palestrante['nome']) ?>">
                                    <h5 class="card-title mb-1 fw-semibold"><?= htmlspecialchars($palestrante['nome']) ?></h5>
                                    <p class="text-muted mb-3"><small><?= htmlspecialchars($palestrante['titulo']) ?></small></p>
                                    <p class="card-text small mb-4"><?= htmlspecialchars($palestrante['bio']) ?></p>
                                    <?php if (!empty($palestrante['linkedin']) && $palestrante['linkedin'] !== '#'): ?>
                                        <a href="<?= htmlspecialchars($palestrante['linkedin']) ?>" target="_blank" class="btn btn-outline-primary btn-sm mt-auto">
                                            <i class="bi bi-linkedin"></i> LinkedIn
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php $aos_delay += 100; ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5" data-aos="fade-up">
                    <h3 class="laranja">Em breve, divulgaremos os palestrantes confirmados. Fique ligado!</h4>
                    <p>Já estamos em contato com grandes nomes do mercado...</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Seção Programação -->
    <section id="programacao" class="py-5">
        <div class="container">
            <h2 class="text-center py-4 title" data-aos="fade-up">Programação do Evento</h2>
            <?php if ($programacaoDefinida && !empty($programacao)): ?>
                <div class="row justify-content-center">
                    <div class="col-lg-9"> <!-- Mantido o aumento da largura -->
                         <?php $aos_delay = 100; ?>
                        <?php foreach ($programacao as $item): ?>
                            <div class="programacao-item d-flex flex-column flex-md-row pb-3" data-aos="fade-up" data-aos-delay="<?= $aos_delay ?>">
                                <div class="flex-shrink-0 me-md-4 mb-2 mb-md-0 text-md-end" style="min-width: 160px;"> <!-- Aumentei um pouco mais o espaço para o horário -->
                                    <span class="fw-bold fs-5"><?= htmlspecialchars($item['horario']) ?></span>
                                </div>
                                <div class="flex-grow-1 ps-md-3 border-start-md border-secondary">
                                    <h5 class="mb-1 fw-semibold"><?= htmlspecialchars($item['titulo']) ?></h5>
                                    <?php if (!empty($item['palestrante'])): ?> <p class="mb-1 text-muted"><i class="bi bi-person-fill me-1"></i> <?= htmlspecialchars($item['palestrante']) ?></p> <?php endif; ?>
                                    <?php if (!empty($item['descricao'])): ?> <p class="small mb-0"><?= htmlspecialchars($item['descricao']) ?></p> <?php endif; ?>
                                </div>
                            </div>
                            <?php $aos_delay += 50; // Delay menor para itens de lista ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-5" data-aos="fade-up">
                    <h3 class="laranja">A programação completa será divulgada em breve!</h4>
                    <p>Estamos preparando uma agenda incrível...</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Seção Ingressos -->
    <section id="ingressos" class="py-5">
        <div class="container">
            <h2 class="text-center py-4 title" data-aos="fade-up">Ingressos</h2>
            <?php if ($ingressosDisponiveis && !empty($lotes)): ?>
                <div class="row justify-content-center mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-8 text-center">
                        <p class="lead">Garanta sua participação no principal evento de Marketing e Vendas para a indústria.</p>
                        <p>Evento <strong>100% presencial</strong> Vagas limitadas!</p>
                        <p>Associados <strong>ABIMAQ</strong> possuem valor diferenciado que será verificado via CNPJ</p>
                    </div>
                </div>
                <!-- Substituir a tabela por cards -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center mb-4">
                    <?php
                    $aos_delay_lote = 100;
                    foreach ($lotes as $lote):
                        // +++ INÍCIO DA LÓGICA PARA DETERMINAR O LOTE ATUAL +++
                        $isLoteAtual = false;
                        $classeDestaqueLote = '';

                        // Tenta converter as datas do lote para objetos DateTime
                        // As datas devem estar no formato 'd/m/Y' como no seu array
                        $dataInicioLote = DateTime::createFromFormat('d/m/Y', $lote['inicio']);
                        if ($dataInicioLote) {
                            $dataInicioLote->setTime(0,0,0); // Normaliza para meia-noite
                        }

                        $dataFimLote = DateTime::createFromFormat('d/m/Y', $lote['fim']);
                        if ($dataFimLote) {
                            $dataFimLote->setTime(0,0,0); // Normaliza para meia-noite (o lote é válido ATÉ o final deste dia)
                                                       // Na comparação, usamos <= $dataFimLote
                        }

                        // Verifica se as datas foram convertidas corretamente e se o lote é o atual
                        if ($dataInicioLote && $dataFimLote) {
                            if ($hoje >= $dataInicioLote && $hoje <= $dataFimLote) {
                                $isLoteAtual = true;
                                $classeDestaqueLote = 'lote-atual-destaque'; // Define a classe CSS
                            }
                        }
                        // +++ FIM DA LÓGICA PARA DETERMINAR O LOTE ATUAL +++
                    ?>
                        <div class="col d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="<?= $aos_delay_lote ?>">
                            <div class="card card-lote h-100 shadow-sm <?= $classeDestaqueLote ?>">
                                <div class="card-header text-center fw-bold"><?= htmlspecialchars($lote['nome']) ?></div>
                                <div class="card-body d-flex flex-column text-center">
                                    <p class="card-text text-muted mb-2"><small><?= htmlspecialchars($lote['inicio']) ?> a <?= htmlspecialchars($lote['fim']) ?></small></p>
                                    <hr class="my-2 card-lote-divider">
                                    <div class="flex-grow-1 d-flex flex-column justify-content-center">
                                        <div class="mb-3">
                                            <p class="mb-1 fw-semibold">Associado ABIMAQ:</p>
                                            <h5 class="card-title text-success">R$ <?= number_format($lote['associado'], 2, ',', '.') ?></h5>
                                        </div>
                                        <div>
                                            <p class="mb-1 fw-semibold">Não Associado:</p>
                                            <h5 class="card-title text-primary">R$ <?= number_format($lote['nao_associado'], 2, ',', '.') ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $aos_delay_lote += 100; ?>
                    <?php endforeach; ?>
                </div>
                <!-- Fim dos Cards -->
                <div class="row justify-content-center mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="col-lg-8 text-center bg-light-alt p-4 rounded shadow-sm">
                        <h4 class="fw-semibold mb-3">Descontos Progressivos para Grupos!</h4>
                        <ul class="list-unstyled">
                            <li><p class="mb-1"><strong class="text-white">5% de desconto</strong> para 2 inscrições da mesma empresa.</p></li>
                            <li><p class="mb-1"><strong class="text-white">10% de desconto</strong> para 3 inscrições da mesma empresa.</p></li>
                            <li><p class="mb-1"><strong class="text-white">15% de desconto</strong> para 4 ou mais inscrições da mesma empresa.</p></li>
                        </ul>
                        <p><small>(O desconto é calculado automaticamente na página de inscrição ao adicionar participantes)</small></p>
                    </div>
                </div>
                <div class="text-center" data-aos="zoom-in" data-aos-delay="500">
                    <a href="<?= htmlspecialchars($linkInscricao) ?>" class="btn btn-cta-inscricao btn-lg shadow">Inscreva-se Agora!</a>
                </div>
            <?php else: ?>
                <div class="text-center py-5" data-aos="fade-up">
                    <h3 class="laranja">Inscrições em breve!</h3>
                    <p>Prepare-se para garantir sua vaga...</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Seção Local -->
    <section id="local" class="py-5">
        <div class="container">
            <h2 class="text-center py-4 title" data-aos="fade-up">Local do Evento</h2>
            <div class="row g-4 align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <h4 class="fw-semibold mb-3">Centro de Eventos ABIMAQ</h4>
                    <p class="text-light">Av. Jabaquara, 2925 - Mirandópolis<br>São Paulo - SP, 04045-004</p>
                    <p class="text-light">Próximo a estação São Judas do metrô</p>
                    <hr class="my-4"> <!-- Mais destaque na linha divisória -->
                    <p><strong>Estacionamento:</strong> Convênio com estacionamento pago no local.</p>
                    <br>
                    <a href="https://www.google.com/maps/place/Av.+Jabaquara,+2925+-+Mirand%C3%B3polis,+S%C3%A3o+Paulo+-+SP,+04045-004" target="_blank" class="btn btn-outline-light"> <i class="bi bi-geo-alt-fill"></i> Ver no Mapa </a> <!-- Botão outline claro -->
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="ratio ratio-16x9 shadow rounded overflow-hidden">
                         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3655.810350271934!2d-46.63889642380802!3d-23.610449864059233!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce5a042d048a69%3A0x7ef8b11a67888208!2sAv.%20Jabaquara%2C%202925%20-%20Mirand%C3%B3polis%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2004045-004!5e0!3m2!1spt-BR!2sbr!4v1715105461978!5m2!1spt-BR!2sbr" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Mapa Localização ABIMAQ"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção Patrocinadores (Logos) -->
    <section id="patrocinadores" class="py-5">
        <div class="container">
            <h2 class="text-center py-4 title" data-aos="fade-up">Nossos Patrocinadores</h2>
            <?php if ($patrocinadoresConfirmados): ?>
                <?php if (!empty($patrocinadoresRubi)): ?> <h4 class="text-center mb-4 sponsor-tier" data-aos="fade-up" data-aos-delay="100">Novos Caminhos</h4>
                    <div class="d-flex flex-wrap justify-content-center align-items-center mb-5" data-aos="fade-up" data-aos-delay="200"> <?php foreach ($patrocinadoresRubi as $patro): ?> <a href="<?= htmlspecialchars($patro['link']) ?>" target="_blank"> <img src="<?= htmlspecialchars($patro['logo']) ?>" alt="<?= htmlspecialchars($patro['nome']) ?>" class="patrocinador-logo" style="max-width: 210px;"> </a> <?php endforeach; ?> </div> <?php endif; ?>
                <?php if (!empty($patrocinadoresOuro)): ?> <h4 class="text-center mb-4 sponsor-tier" data-aos="fade-up" data-aos-delay="100">Desbravador</h4>
                    <div class="d-flex flex-wrap justify-content-center align-items-center mb-5" data-aos="fade-up" data-aos-delay="200"> <?php foreach ($patrocinadoresOuro as $patro): ?> <a href="<?= htmlspecialchars($patro['link']) ?>" target="_blank"> <img src="<?= htmlspecialchars($patro['logo']) ?>" alt="<?= htmlspecialchars($patro['nome']) ?>" class="patrocinador-logo" style="max-width: 200px;"> </a> <?php endforeach; ?> </div> <?php endif; ?>
                <?php if (!empty($patrocinadoresPrata)): ?> <h4 class="text-center m-4 sponsor-tier" data-aos="fade-up" data-aos-delay="300">Explorador</h4>
                    <div class="d-flex flex-wrap justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400"> <?php foreach ($patrocinadoresPrata as $patro): ?> <a href="<?= htmlspecialchars($patro['link']) ?>" target="_blank"> <img src="<?= htmlspecialchars($patro['logo']) ?>" alt="<?= htmlspecialchars($patro['nome']) ?>" class="patrocinador-logo" style="max-width: 180px;"> </a> <?php endforeach; ?> </div> <?php endif; ?>
                <?php if (!empty($patrocinadoresBronze)): ?> <h4 class="text-center m-4 sponsor-tier" data-aos="fade-up" data-aos-delay="300">Descobridor</h4>
                    <div class="d-flex flex-wrap justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400"> <?php foreach ($patrocinadoresBronze as $patro): ?> <a href="<?= htmlspecialchars($patro['link']) ?>" target="_blank"> <img src="<?= htmlspecialchars($patro['logo']) ?>" alt="<?= htmlspecialchars($patro['nome']) ?>" class="patrocinador-logo" style="max-width: 150px;"> </a> <?php endforeach; ?> </div> <?php endif; ?>
                <?php if (!empty($apoiador)): ?> <h4 class="text-center m-4 sponsor-tier" data-aos="fade-up" data-aos-delay="300">Apoio</h4>
                    <div class="d-flex flex-wrap justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400"> <?php foreach ($apoiador as $patro): ?> <a href="<?= htmlspecialchars($patro['link']) ?>" target="_blank"> <img src="<?= htmlspecialchars($patro['logo']) ?>" alt="<?= htmlspecialchars($patro['nome']) ?>" class="patrocinador-logo" style="max-width: 130px;"> </a> <?php endforeach; ?> </div> <?php endif; ?>
            <?php else: ?>
                <div class="text-center py-4" data-aos="fade-up">
                    <h3 class="laranja">As marcas que apoiam o futuro do marketing industrial estarão aqui.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3 mb-md-0 text-center text-md-start"> <img src="src/images/logo.png" width="120" alt="SMDI 2025 Logo Rodapé" style="filter: brightness(0) invert(1) opacity(0.8);"> </div>
                <div class="col-md-4 mb-3 mb-md-0 text-center">
                    <p class="mb-1">Entre em contato:</p> <a href="mailto:eventos@abimaq.org.br" class="link-footer">eventos@abimaq.org.br</a><br> <a href="tel:+551155826315" class="link-footer">(11) 5582-6315</a>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <p class="mb-2">Siga a ABIMAQ:</p>
                     <a href="https://www.linkedin.com/company/abimaqoficial/" target="_blank" class="link-social me-3"><i class="bi bi-linkedin"></i></a>
                     <a href="https://www.facebook.com/ABIMAQoficial/" target="_blank" class="link-social me-3"><i class="bi bi-facebook"></i></a>
                     <a href="https://www.instagram.com/abimaqoficial/" target="_blank" class="link-social me-3"><i class="bi bi-instagram"></i></a>
                     <a href="https://www.youtube.com/@abimaqoficial" target="_blank" class="link-social"><i class="bi bi-youtube"></i></a>
                     <!-- Substituir '#' pelos links reais das redes sociais -->
                </div>
            </div>
            <hr class="footer-divider my-4">
            <div class="text-center footer-copy small"> © <?= date('Y') ?> ABIMAQ - Associação Brasileira da Indústria de Máquinas e Equipamentos. Todos os direitos reservados. </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="src/js/bootstrap.bundle.min.js"></script>
    <!-- Script da biblioteca AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inicializa AOS
        AOS.init({
            duration: 800, // Duração da animação em ms
            once: true, // Anima apenas uma vez ao rolar para baixo
            mirror: false // Não anima de volta ao rolar para cima
        });

        // Script smooth scroll aprimorado
        document.querySelectorAll('a.nav-link[href^="#"], a.btn[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId.length > 1 && targetId.startsWith('#')) {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        e.preventDefault();
                        const navbarHeight = document.querySelector('.navbar.fixed-top')?.offsetHeight || 0;
                        // Ajusta o offset para o topo do elemento, considerando a navbar fixa
                        const offsetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 20; // Adiciona um pequeno padding extra no topo

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: "smooth"
                        });

                        // Fecha o navbar collapse no mobile após o clique
                        const navbarToggler = document.querySelector('.navbar-toggler');
                        const collapseElement = document.querySelector('.navbar-collapse.collapse.show');
                        if (navbarToggler && !navbarToggler.classList.contains('collapsed') && collapseElement) {
                            const bsCollapse = new bootstrap.Collapse(collapseElement, {
                                toggle: false
                            });
                            bsCollapse.hide();
                        }
                    }
                }
            });
        });

        // Adiciona classe 'scrolled' à navbar ao rolar
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) { // Adiciona a classe após rolar 50px
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>