<?php 

include 'cabecalho.php';

if(isset($_SESSION['user_name'])){
    
}elseif(isset($_SESSION['admin_name'])){

}else{
    header('location:./');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI | Transmissão ao vivo</title>
    <?php echo $headLinks; ?>
</head>
<body>
    <?php 
    echo $header; 
    echo $iframeAoVivo;
    ?>
    
</body>
</html>