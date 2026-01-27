<?php
$nonce = base64_encode(random_bytes(16));
// Configura o cookie de sessão do PHP (PHPSESSID) para segurança máxima
// Isso mitiga o roubo de sessão via XSS[cite: 572, 574].
ini_set('session.cookie_httponly', 1);
// Isso mitiga o ataque CSRF[cite: 593].
// 'Lax' é o valor recomendado para compatibilidade.
ini_set('session.cookie_samesite', 'Lax');

session_start();
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
// phpinfo();
date_default_timezone_set("America/Sao_Paulo");

// --- CABEÇALHOS DE SEGURANÇA ---
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");

$default_src = "'self' ";
$font_src = "'self' https://fonts.gstatic.com https://cdn.jsdelivr.net";
$img_src = "'self' data:";
$connect_src = "'self' https://www.google-analytics.com https://cdn.jsdelivr.net";
$frame_src = "'self' https://www.google.com/";
$script_src = "'self' " . 
              "https://www.googletagmanager.com " . 
              "https://cdn.jsdelivr.net " . 
              "https://unpkg.com " . 
              "'nonce-$nonce'";

$style_src = "'self' " . 
            "https://fonts.googleapis.com " .
            "https://cdn.jsdelivr.net " .
            "https://unpkg.com " . 
            "'unsafe-inline'";

$csp_policy = "default-src $default_src; " .
              "font-src $font_src; " .
              "style-src $style_src; " .
              "script-src $script_src; " .
              "img-src $img_src; " .
              "connect-src $connect_src; " .
              "frame-src $frame_src;";

header("Content-Security-Policy: " . $csp_policy);
// --- FIM CABEÇALHOS DE SEGURANÇA ---

$projeto = 'smdi2025';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$domain = $_SERVER['HTTP_HOST'];
// echo "AAAA";
// var_dump($_GET['path']);

if (isset($_GET['path'])) {
    $path = explode("/", $_GET['path']);
    $caminho = $path[0];
} else { 
    $caminho = 'home';
}


include_once "./model/db.class.php";
include_once "./routes/routes.php";