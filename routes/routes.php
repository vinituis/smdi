<?php

header('Cache-Control: no-cache, no-store, private');

switch ($caminho) {
    case 'home':
    case 'page':
        require "view/Page.php";
        break;
    case 'colaborador':
        if (isset($_POST['geral'])) {
            require "controller/Colaborador.php";
        } else {
            require "view/Colaborador.php";
        }
        break;

    case 'anamid':
    case 'informa':
    case 'tipo':
    case 'asta':
    case 'tmd':
    case 'noara':
    case 'programasom':
    case 'jp':
    case 'deea':
    case 'estefania':
    case 'ello':
    case 'aps':
    case 'magma':
    case 'tecnoaco':
    case 'injetaq':
    case 'cgitaim':
    case 'clm':
    case 'tele':
    case 'bidone':
    case 'rdigital':
        if (isset($_POST['geral'])) {
            require "controller/Cortesia.php";
        } else {
            require "view/Parceiro.php";
        }
        break;

    case 'individual':
        require "view/Individual.php";
        break;
    case 'limite':
        require "view/Limite.php";
        break;
    case 'convite':
        require "routes/Convite.php";
        break;

    case 'obrigado':
        require "view/Obrigado.php";
        break;
    ////////////////////////////////////////////////////////////////////////

    case 'api':
        require "controller/Api.php";
        break;

    case 'cep':
        require "controller/ApiCep.php";
        break;

    case 'razao':
        require "controller/ApiRazao.php";
        break;
}
