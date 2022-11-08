<?php

include 'config.php';
include 'cabecalho.php';

if(!isset($_SESSION['admin_name'])){
    header('location:./');
 }

$iniciado;

if(isset($_POST['submit'])){
    $nome = $_POST['nome'];
    $image = $_POST['image'];
    $cargo = $_POST['cargo'];
    $desc = $_POST['descricao'];
    $link = $_POST['link'];
    
    $select = " SELECT * FROM professores";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) >= 0){
        $insert = "INSERT INTO professores(nome, img, cargo, descrição, link) VALUES('$nome', '$image', '$cargo', '$desc', '$link')";
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
    <title>SMDI | Cadastro de professores</title>

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
            <label for="cargo">Cargo do Professor</label>
            <input required type="text" name="cargo" id="cargo" placeholder="Ex: Palestrante">
            <label for="descricao">Descrição do Professor</label>
            <textarea required name="descricao" id="descricao" placeholder="Para pular linha utilize a tag <br> 2 vezes." rows="4" Maxlength="9000"></textarea>
            <label for="link">Link (opcional)</label>
            <input type="text" name="link" id="link" placeholder="Ex: http://site-do-palestrante.com">
            <input type="submit" name="submit" value="submit">
        </form>
    </div>

</section>

<?php mysqli_close($conn); ?>

</body>
</html>