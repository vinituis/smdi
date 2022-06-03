<?php

include 'config.php';
include 'cabecalho.php';

$iniciado;

if(!isset($_SESSION['admin_name'])){
   header('location:./');
}

if(isset($_POST['submit'])){
    $nome_material = $_POST['nome'];
    $image = $_POST['image'];
    $desc = $_POST['descricao'];
    
    $select = " SELECT * FROM professores";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) >= 0){
        $insert = "INSERT INTO professores(nome, img, descrição) VALUES('$nome_material', '$image', '$desc')";
        mysqli_query($conn, $insert);
        $correct[] = 'Professor cadastrado!';
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM page</title>

<?php echo $headAdm; ?>

</head>
<body>
    
<?php 
    echo $headerAdm; 
    if(isset($correct)){
        foreach($correct as $correct){
           echo '<span class="correct-msg">'.$correct.'</span>';
        };
     };
?>

<section class='courses' id='cadProf'>
    <div class='heading'>
        <h3>Cadastrar Professor</h3>
    </div>

    <div>
        <form id="cadastroAulaSMDI" class="formcad" action="" method="post">
            <label for="nome">Nome do Professor</label>
            <input required type="text" id="nome" name="nome" placeholder="Ex: João Silva">
            <label for="image">Foto do professor</label>
            <input required type="text" name="image" id="image" placeholder="Ex: http://www.example.com/images/...jpg">
            <label for="descricao">Descrição do Professor</label>
            <textarea required name="descricao" id="descricao" placeholder="Limite máximo: 100 caracteres." rows="4" Maxlength="100"></textarea>
            <input type="submit" name="submit" value="submit">
        </form>
    </div>

</section>
</body>
</html>