<?php

$iniciado = session_start();

//link

$GA4 = '<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9DC39DW0VW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config", "G-9DC39DW0VW");
</script>';

$fontawesome = '<script src="https://kit.fontawesome.com/77f6bd1ed5.js" crossorigin="anonymous" defer></script>';

$loginCss = '<link rel="stylesheet" href="css/login.css">';

$registroCss = '<link rel="stylesheet" href="css/registro.css">';

$cssGlobal = '<link rel="stylesheet" href="css/style.css">';
    
$jsGlobal = '<script src="js/script.js" defer></script>';

$noIndex = '<meta name="robots" content="noindex">';

$favicon = '<link rel="icon" type="image/x-icon" href="./images/favicon.png">';

$headLinks = $fontawesome . $cssGlobal . $jsGlobal . $favicon . $noIndex . $GA4;

//Globais

$descLogin = ' ';

$descRegistro = 'Tenha acesso a plataforma do SMDI, que é um evento marketing para a indústria. Conteúdo prático e simples para você aprender marketing fazendo!';

$sair = '<br><a href="./sair"> <i class="fas fa-angle-right"></i> Sair </a>';

$autor = '';

$credit = '<p class="credit"> Criado por <span>' . $autor . '</span> | Todos os direitos reservados!</p>';

$linkLogo = './';

$iconName = './images/favicon.png';

$name = 'SMDI';

//user

$semContent = '
    <div class="heading">
        <br><br>
        <span>Ainda estamos trabalhando nesses conteúdos...</span>
    </div>';

// para ativar as AULAS e AO_VIVO, retorne o 'href="./aulas"' e 'href="./ao_vivo"' na tag de 'a', retirando a classe 'btn-d' e troque a classe 'fa-lock' por 'fa-angle-right' na tag 'i' //

// certificado = href="./certificado?certificado=yes"

$nav = '
<nav class="navbar">
    <a class="btn-d"> <i class="fas fa-lock"></i> Transmissão </a>
    <a class="btn-d"> <i class="fas fa-lock"></i> Aulas </a>
    <a class="btn-d"> <i class="fas fa-lock"></i> Certificado </a> <br>
    <a href="./home"> <i class="fas fa-angle-right"></i> Página Inicial </a>
    <a href="./ed"> <i class="fas fa-angle-right"></i> Edições Anteriores </a>
    <a href="./materiais"> <i class="fas fa-angle-right"></i> Materiais </a>
    <a href="./professores"> <i class="fas fa-angle-right"></i> Professores </a>
    '.$sair.'
</nav>';

$navAula = '
<nav class="navbar">
    <a href="./aulas"> <i class="fas fa-angle-left"></i> Voltar para Aulas </a>
</nav>';

$navProf = '
<nav class="navbar">
    <a href="./professores"> <i class="fas fa-angle-left"></i> Voltar </a>
</nav>';

$redes = '
<div class="share">
    <a href="https://www.facebook.com/ABIMAQoficial" class="fab fa-facebook-f"></a>
    <a href="https://instagram.com/abimaq_oficial" class="fab fa-instagram"></a>
    <a href="https://www.youtube.com/tvabimaq" class="fab fa-youtube"></a>
    <a href="https://www.linkedin.com/company/abimaqoficial/" class="fab fa-linkedin"></a>
</div>';

$header = '
<div id="menu-btn" class="fas fa-bars"></div>
<header class="header">
<a href="'.$linkLogo.'" class="logo"> <img src="'.$iconName.'"> '.$name.' </a>
'. $nav . $redes . $credit .'

</header>';

$headerAula = '
<div id="menu-btn" class="fas fa-bars"></div>
<header class="header">
<a href="'.$linkLogo.'" class="logo"> <img src="'.$iconName.'"> '.$name.' </a>
'. $navAula . $redes . $credit .'
</header>';

$headerProf = '
<div id="menu-btn" class="fas fa-bars"></div>
<header class="header">
<a href="'.$linkLogo.'" class="logo"> <img src="'.$iconName.'"> '.$name.' </a>
'. $navProf . $redes . $credit .'
</header>';

$AoVivo = $semContent;

$iframeAoVivo = '<section class="courses" id="aula">
<div class="heading">
    <h3>Transmissão ao vivo</h3>
</div>
<div class="iframe-aula">
    '.$AoVivo.'
</div>
</section>';

//adm

$navAdm = '
<nav class="navbar">
    <a href="./"> <i class="fas fa-angle-right"></i> Página Inicial </a>
    <a href="./admin_aula"> <i class="fas fa-angle-right"></i> Aulas </a>
    <a href="./admin_prof"> <i class="fas fa-angle-right"></i> Professores </a>
    <a href="./admin_user"> <i class="fas fa-angle-right"></i> Usuários </a>
    <a href="./admin_lista"> <i class="fas fa-angle-right"></i> Lista presencial </a>
    <a href="./admin_material"> <i class="fas fa-angle-right"></i> Materiais </a>
    <a href="./admin_ed"> <i class="fas fa-angle-right"></i> Edições anteriores </a>
    <br> <a href="./home"> <i class="fas fa-angle-right"></i> Vista do usuário </a>'
    .$sair.'
</nav>';

$headerAdm = '
<div id="menu-btn" class="fas fa-bars"></div>
<header class="header">
<a href="'.$linkLogo.'" class="logo"> <img src="'.$iconName.'"> '.$name.' </a>
'. $navAdm . $credit .'

</header>';

$admCss = '<link rel="stylesheet" href="css/adm.css">';

$headAdm = $headLinks . $admCss;

?>