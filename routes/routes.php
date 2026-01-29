<?php

header('Cache-Control: no-cache, no-store, private');

switch ($caminho) {
    case 'home':
        require "view/Main.php";
        break;
    case 'obrigado-interesse':
        require "view/ObrigadoInteresse.php";
        break;
}

if (isset($_POST) && !empty($_POST)) {
    switch ($caminho) {
        case 'home':
            require "controller/EnvioRD.php";
            break;
    }
}