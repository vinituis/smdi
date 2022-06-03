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
    $data = $_POST['data'];
    $url = $_POST['url'];
    
    $select = " SELECT * FROM materiais ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) >= 0){
        $insert = "INSERT INTO materiais(nome, img, descrição, data, url) VALUES('$nome_material', '$image', '$desc', '$data', '$url')";
        mysqli_query($conn, $insert);
        $correct[] = 'Material cadastrado!';
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

<section class='courses' id='cadAulas'>
    <div class='heading'>
        <h3>Cadastrar Material</h3>
    </div>

    <div>
        <form id="cadastroAulaSMDI" class="formcad" action="" method="post">
            <label for="nome">Nome do Material</label>
            <input required type="text" id="nome" name="nome" placeholder="Ex: Tema principal - Subtema">
            <label for="image">Link da imagem</label>
            <input required type="text" name="image" id="image" placeholder="Ex: http://www.example.com/images/...jpg">
            <label for="descricao">Descrição do material</label>
            <textarea required name="descricao" id="descricao" placeholder="Limite máximo: 100 caracteres." rows="4" Maxlength="100"></textarea>
            <label for="data">Data</label>
            <input type="date" name="data" id="data">
            <label for="url">Url do Material</label>
            <input type="text" name="url" id="url" placeholder="Ex: http://www.example.com/docs/...pdf">
            <input type="submit" name="submit" value="submit">
        </form>
    </div>

</section>
</body>
</html>