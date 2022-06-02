<?php

include 'config.php';
include 'cabecalho.php';

$iniciado;

if(!isset($_SESSION['admin_name'])){
    header('location:./');
}

$id_page = $_GET['id'];

$sql = "UPDATE professores SET status = 'ativo' WHERE id = '$id_page'";

if (mysqli_query($conn, $sql)) {
    $sucesso = "Sucesso! Professor ativado";
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
    <div class='heading'>
        <h3><p><?php echo $sucesso?></p></h3><br>
        <a href="./admin_prof"><button class="btn">Voltar</button></a>
    </div>
</section>
    
</body>
</html>