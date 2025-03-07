<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
// phpinfo();
date_default_timezone_set("America/Sao_Paulo");

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