<?php 

include 'config.php';
include 'cabecalho.php';

$iniciado;

$id_page = $_GET['id'];
$aula = $_GET['aula'];

$sql = mysqli_query($conn, "SELECT * FROM aulas WHERE id = '$id_page'");
$sql2 = mysqli_query($conn, "SELECT * FROM user");

if(isset($_SESSION['user_id'])){
    $id_user = $_SESSION['user_id'];
}
        
if(isset($_COOKIE['aula'.$id_page.''])){
    $cookie = $_COOKIE['aula'.$id_page.''];
}else {
    setcookie("aula".$id_page."", "s", time() + (86400 * 30));
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nome da Aula</title>
    <?php echo $headLinks; ?>
</head>
<body>
    <?php echo $headerAula; ?>
    <?php 
        $usu = mysqli_fetch_object($sql);
        $row = mysqli_fetch_object($sql2);
        if($usu == NULL){
            header('location:erro');
        }else if($usu !== NULL){
            echo "
            <section class='courses' id='aula'>
                <div class='heading'>
                    <span id='$usu->categoria'>$usu->categoria</span>
                    <h3>$usu->nome_aula</h3>
                    <p>Professor: $usu->professor</p>
                </div>
                <div class='iframe'>
                    $usu->video
                </div>
            </section>";
        }
         
        if(isset($cookie)){
            if(isset($_SESSION['user_id'])){
            if($cookie == 's'){
                if($aula == 'ass_aula_1'){
                    $sqlup = "UPDATE user SET ass_aula_1 = 's' WHERE id = '$id_user'";
                    if (mysqli_query($conn, $sqlup)) {
                        $sucesso = "Sucesso! Material desativado";
                    } else {
                        $sucesso = "Houve um erro: " . mysqli_error($conn);
                    }
                }elseif($aula == 'ass_aula_2'){
                    $sqlup = "UPDATE user SET ass_aula_2 = 's' WHERE id = '$id_user'";
                    if (mysqli_query($conn, $sqlup)) {
                        $sucesso = "Sucesso! Material desativado";
                    } else {
                        $sucesso = "Houve um erro: " . mysqli_error($conn);
                    }
                }elseif($aula == 'ass_aula_3'){
                    $sqlup = "UPDATE user SET ass_aula_3 = 's' WHERE id = '$id_user'";
                    if (mysqli_query($conn, $sqlup)) {
                        $sucesso = "Sucesso! Material desativado";
                    } else {
                        $sucesso = "Houve um erro: " . mysqli_error($conn);
                    }
                }elseif($aula == 'ass_aula_4'){
                    $sqlup = "UPDATE user SET ass_aula_4 = 's' WHERE id = '$id_user'";
                    if (mysqli_query($conn, $sqlup)) {
                        $sucesso = "Sucesso! Material desativado";
                    } else {
                        $sucesso = "Houve um erro: " . mysqli_error($conn);
                    }
                }}
                // echo $sucesso;
                mysqli_close($conn);
            }
        }

        ?>
</body>
</html>