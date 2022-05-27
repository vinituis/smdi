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

<section class='courses' id='aulas'>
    <div class='heading'>
        <h3>Aulas cadastradas</h3>
    </div>
    <table>
        <tr>
            <td>id</td>
            <td>nome</td>
            <td>categoria</td>
            <td>professor</td>
            <td>descrição</td>
            <td>nota</td>
            <td>status</td>
            <td>ação</td>
        </tr>
        <?php 
            $sql = 'SELECT * FROM aulas';
            if($res=mysqli_query($conn, $sql)){
                $id = array();
                $nome = array();
                $cat = array();
                $prof = array();
                $desc = array();
                $nota = array();
                $status = array();
                $i = 0;
                while ($reg = mysqli_fetch_assoc($res)) {
                    $id[$i] = $reg['id'];
                    $nome[$i] = $reg['nome_aula'];
                    $cat[$i] = $reg['categoria'];
                    $prof[$i] = $reg['professor'];
                    $desc[$i] = $reg['descrição'];
                    $nota[$i] = $reg['nota'];
                    $status[$i] = $reg['status'];
        ?>

        <tr>
            <td><?php echo $id[$i]; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $cat[$i]; ?></td>
            <td><?php echo $prof[$i]; ?></td>
            <td><?php echo $desc[$i]; ?></td>
            <td><?php echo $nota[$i]; ?></td>
            <td><?php echo $status[$i]; ?></td>
            <?php
                if($status[$i] == 'ativo'){
                    echo '<td><a href="./desativar_aula?id='.$id[$i].'">Desativar</a><a style="margin-left: 1rem;" href="./bloqueio_aula?id='.$id[$i].'">Bloquear</a></td>';
                }elseif($status[$i] == 'inativo'){
                    echo '<td><a href="./ativar_aula?id='.$id[$i].'">Ativar</a><a style="margin-left: 1rem;" href="./bloqueio_aula?id='.$id[$i].'">Ativar bloqueado</a></td>';
                }elseif($status[$i] == 'block'){
                    echo '<td><a href="./ativar_aula?id='.$id[$i].'">Ativar</a><a style="margin-left: 1rem;" href="./desativar_aula?id='.$id[$i].'">Desativar</a></td>';
                }
            ?>
        </tr>

        <?php }} ?>
    </table>
    
    <div>
        <form id="cadastroAulaSMDI" class="formcad" action="" method="post">
            <h3>Cadastro de aula</h3>
            <label for="nome"> Nome da Aula</label>
            <input type="text" id="nome" name="nome" placeholder="Ex: Tema principal - Subtema">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria">
                <option value="">Selecione</option>
                <option value="Aula1">Aula 1</option>
                <option value="Aula2">Aula 2</option>
                <option value="Aula3">Aula 3</option>
                <option value="Aula4">Aula 4</option>
            </select>
            <label for="image">Link da imagem</label>
            <input type="text" name="image" id="image" placeholder="Ex: http://www.example.com/images/...jpg">
            <label for="descricao">Descrição da aula</label>
            <textarea name="descricao" id="descricao" placeholder="Limite máximo: 100 caracteres." rows="4" Maxlength="100"></textarea>
            <label for="professor">Selecione o Professor</label>
            <select name="professor" id="professor">
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
            <input type="text" name="linkVideo" id="linkVideo" placeholder="Embed do vídeo">
            <label for="nota">Selecione a nota do curso</label>
            <select name="nota" id="nota">
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