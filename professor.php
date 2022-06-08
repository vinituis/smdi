<?php 

include 'config.php';
include 'cabecalho.php';

if(isset($_SESSION['user_name'])){
    
}elseif(isset($_SESSION['admin_name'])){

}else{
    header('location:./');
}

$iniciado;

$id_page = $_GET['id'];

$sql = mysqli_query($conn, "SELECT * FROM professores WHERE id = '$id_page'");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI | Aula</title>
    <?php echo $headLinks; ?>
</head>
<body>
    <?php echo $headerProf; ?>
    <?php 
        $usu = mysqli_fetch_object($sql);
        if($usu == NULL){
            header('location:erro');
        }else if($usu !== NULL){
            if($usu->link !== ''){
            echo "
            <div class='prof'>
                <img src='$usu->img' alt=''>
                <h3>$usu->nome</h3>
                <span>$usu->cargo</span>
                <p>$usu->descrição</p>
                <div class='share'>
                    <a href='$usu->link' class='fas fa-link'></a>
                </div>
            </div>
            ";
        }else{
            echo "
            <div class='prof'>
                <img src='$usu->img' alt=''>
                <h3>$usu->nome</h3>
                <span>$usu->cargo</span>
                <p>$usu->descrição</p>
            </div>
            ";
        }}

        mysqli_close($conn);
        ?>
</body>
</html>