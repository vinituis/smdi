<?php
// var_dump($path[1]);
if($method === 'GET'){
    switch ($caminho){
        case 'convite':
            if(isset($path[1])){
                switch ($path[1]) {
                    case '':
                        require "view/Convite.php";
                    break;
                }
            }else{
                require "view/Home.php";
            }
        break;

    }
}

?>