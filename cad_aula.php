<?php

include 'config.php';
include 'cabecalho.php';

$iniciado;

if(!isset($_SESSION['admin_name'])){
   header('location:./');
}

if(isset($_POST['submit'])){
    $nome_aula = $_POST['nome'];
    $cat = $_POST['categoria'];
    $img = $_POST['image'];
    $desc = $_POST['descricao'];
    $prof = $_POST['professor'];
    $vid = $_POST['linkVideo'];
    $nota = $_POST['nota'];
    if($cat == 'Aula1'){
        $cat = 'Aula 1';
        $referencia = 'ass_aula_1';
    }
    if($cat == 'Aula2'){
        $cat = 'Aula 2';
        $referencia = 'ass_aula_2';
    }
    if($cat == 'Aula3'){
        $cat = 'Aula 3';
        $referencia = 'ass_aula_3';
    }
    if($cat == 'Aula4'){
        $cat = 'Aula 4';
        $referencia = 'ass_aula_4';
    }
    if($cat == '2019' || '2020' || '2021'){
        $referencia = 'ed_anterior';
    }
    
    $select = " SELECT * FROM user ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $insert = "INSERT INTO aulas(nome_aula, categoria, image, descrição, professor, video, nota, referencia) VALUES('$nome_aula', '$cat', '$img', '$desc', '$prof', '$vid', '$nota', '$referencia')";
        mysqli_query($conn, $insert);
        $correct[] = 'Aula cadastrada!';
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
        <h3>Cadastrar Aula</h3>
    </div>

    <div>
        <form id="cadastroAulaSMDI" class="formcad" action="" method="post">
            <label for="nome"> Nome da Aula</label>
            <input required type="text" id="nome" name="nome" placeholder="Ex: Tema principal - Subtema">
            <label for="categoria">Categoria</label>
            <select required name="categoria" id="categoria">
                <option value="">Selecione</option>
                <option value="Aula1">Aula 1</option>
                <option value="Aula2">Aula 2</option>
                <option value="Aula3">Aula 3</option>
                <option value="Aula4">Aula 4</option>
                <option value="2019">Edição 2019</option>
                <option value="2020">Edição 2020</option>
                <option value="2021">Edição 2021</option>
            </select>
            <label for="image">Link da imagem</label>
            <input required type="text" name="image" id="image" placeholder="Ex: http://www.example.com/images/...jpg">
            <label for="descricao">Descrição da aula</label>
            <textarea required name="descricao" id="descricao" placeholder="Limite máximo: 100 caracteres." rows="4" Maxlength="100"></textarea>
            <label for="professor">Selecione o Professor</label>
            <select required name="professor" id="professor">
                <option value="">Selecione</option>
            <?php 
                $sql = 'SELECT * FROM professores';
                if($res=mysqli_query($conn, $sql)){
                    $nome = array();
                    $status = array();
                    $i = 0;
                    while ($reg = mysqli_fetch_assoc($res)) {
                        $nome[$i] = $reg['nome'];
                        $status[$i] = $reg['status'];
                        if($status[$i] == 'ativo'){
            ?>    
            
                <option value="<?php echo $nome[$i]; ?>"><?php echo $nome[$i]; ?></option>
            <?php }}} ?>
            </select>
            <label for="linkVideo">Código de embed do vídeo</label>
            <input required type="text" name="linkVideo" id="linkVideo" placeholder="Embed do vídeo">
            <label for="nota">Selecione a nota do curso</label>
            <select required name="nota" id="nota">
                <option value="">Selecione</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <input type="submit" name="submit" value="submit">
        </form>
    </div>

</section>
</body>
</html>