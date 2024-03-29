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
            if(isset($usu)){
            if($usu->atual == 'n'){
                $atual = 'Professor da edição passada';
            }else if($usu->atual == 's'){
                $atual = 'Professor da edição atual';
            }
            echo "
            <div class='prof'>
                <span class='aviso'>$atual</span>
                <img src='$usu->img' alt=''>
                <h3>$usu->nome</h3>
                <span>$usu->cargo</span>
                <p>$usu->descrição</p>
            ";

            if($usu->link !== ''){
                echo "<div class='share'>
                    <a href='$usu->link' class='fas fa-link'></a>
                </div>
                ";
            }

            echo "<div class='aulas'>";
            $name = $usu->nome;

            $sqla = "SELECT * FROM aulas";
            if($res = mysqli_query($conn, $sqla)){
                $id = array();
                $nome = array();
                $video = array();
                $i = 0;
                while ($reg = mysqli_fetch_assoc($res)) {
                    $id[$i] = $reg['id'];
                    $nome[$i] = $reg['professor'];
                    $video[$i] = $reg['video'];
                    
                    if($nome[$i] == $name){
                        echo "
                        <div class='iframe-prof'>
                            $video[$i]
                        </div>
                        ";
                    }
                }
            }
            echo "</div>";
            
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