<?php

$iniciado = session_start();

//link

$fontawesome = '<script src="https://kit.fontawesome.com/77f6bd1ed5.js" crossorigin="anonymous" defer></script>';

$loginCss = '<link rel="stylesheet" href="css/login.css">';

$registroCss = '<link rel="stylesheet" href="css/registro.css">';

$cssGlobal = '<link rel="stylesheet" href="css/style.css">';
    
$jsGlobal = '<script src="js/script.js" defer></script>';

$noIndex = '<meta name="robots" content="noindex">';

$headLinks = $fontawesome . $cssGlobal . $jsGlobal . $noIndex;

//Globais

$sair = '<br><a href="./sair"> <i class="fas fa-angle-right"></i> Sair </a>';

$autor = '';

$credit = '<p class="credit"> Criado por <span>' . $autor . '</span> | Todos os direitos reservados!</p>';

$name = 'SMDI';

//user

$semContent = '
    <div class="heading">
        <br><br>
        <span>Ainda estamos trabalhando nesses conteúdos...</span>
    </div>';

$nav = '
<nav class="navbar">
    <a href="./"> <i class="fas fa-angle-right"></i> Página Inicial </a>
    <a href="./ed"> <i class="fas fa-angle-right"></i> Edições Anteriores </a>
    <a href="./aulas"> <i class="fas fa-angle-right"></i> Aulas </a>
    <a href="./materiais"> <i class="fas fa-angle-right"></i> Materiais </a>
    <a href="./professores"> <i class="fas fa-angle-right"></i> Professores </a>
    '.$sair.'
</nav>';

$navAula = '
<nav class="navbar">
    <a href="./aulas"> <i class="fas fa-angle-left"></i> Voltar para Aulas </a>
</nav>';

$redes = '
<div class="share">
    <a href="#" class="fab fa-facebook-f"></a>
    <a href="#" class="fab fa-twitter"></a>
    <a href="#" class="fab fa-instagram"></a>
    <a href="#" class="fab fa-linkedin"></a>
</div>';

$header = '
<div id="menu-btn" class="fas fa-bars"></div>
<header class="header">
<a href="#" class="logo"> <i class="fas fa-graduation-cap"></i> '.$name.' </a>
'. $nav . $redes . $credit .'

</header>';

$headerAula = '
<div id="menu-btn" class="fas fa-bars"></div>
<header class="header">
<a href="#" class="logo"> <i class="fas fa-graduation-cap"></i> '.$name.' </a>
'. $navAula . $redes . $credit .'
</header>';


//adm

$navAdm = '
<nav class="navbar">
    <a href="./"> <i class="fas fa-angle-right"></i> Página Inicial </a>
    <a href="./admin_aula"> <i class="fas fa-angle-right"></i> Aulas </a>
    <a href="./admin_prof"> <i class="fas fa-angle-right"></i> Professores </a>
    <a href="./admin_user"> <i class="fas fa-angle-right"></i> Usuários </a>
    <a href="./admin_material"> <i class="fas fa-angle-right"></i> Materiais </a>
    <a href="./admin_ed"> <i class="fas fa-angle-right"></i> Edições anteriores </a>'
    .$sair.'
</nav>';

$headerAdm = '
<div id="menu-btn" class="fas fa-bars"></div>
<header class="header">
<a href="#" class="logo"> <i class="fas fa-graduation-cap"></i> '.$name.' </a>
'. $navAdm . $credit .'

</header>';

$admCss = '<link rel="stylesheet" href="css/adm.css">';

$headAdm = $headLinks . $admCss;

?>