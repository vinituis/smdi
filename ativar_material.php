<?php

include 'config.php';
include 'cabecalho.php';

$iniciado;

if(!isset($_SESSION['admin_name'])){
    header('location:./');
}

$id_page = $_GET['id'];

$sql = "UPDATE materiais SET status = 'ativo' WHERE id = '$id_page'";

if (mysqli_query($conn, $sql)) {
    $sucesso = "Material ativado!";
} else {
    $sucesso = "Houve um erro: " . mysqli_error($conn);
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sucesso?></title>
    <?php echo $headAdm; ?>

</head>
<body>
<?php 
    echo $headerAdm;
?>
<section>
    <div class="heading">
        <p><h3><?php echo $sucesso?></h3></p>
        <a href="./admin_material"><button class="btn">Voltar</button></a>
    </div>
</section>
    
</body>
</html>