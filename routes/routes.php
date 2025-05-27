<?php

switch ($caminho){
    case 'home':
        require "view/Home.php";
    break;
    
    case 'page':
        require "view/Page.php";
    break;
    
    case 'individual':
        // var_dump($_POST);
        if(isset($_POST['geral'])){
            require "controller/Post.php";
        }else{
            require "view/Individual.php";
        }
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

?>