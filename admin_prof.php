<?php

include 'config.php';
include 'cabecalho.php';

if(!isset($_SESSION['admin_name'])){
    header('location:./');
}

$iniciado;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI | Administração de professores</title>

<?php echo $headAdm; ?>

</head>
<body>
    
<?php echo $headerAdm; ?>

<section class='courses' id='professores'>
    <div class='heading'>
        <h3>Professores cadastrados</h3>
    </div>
    <table>
        <tr>
            <td>id</td>
            <td>nome</td>
            <td>descrição</td>
            <td>status</td>
            <td>ações</td>
        </tr>
        <?php 
            $sql = 'SELECT * FROM professores';
            if($res=mysqli_query($conn, $sql)){
                $id = array();
                $nome = array();
                $img = array();
                $desc = array();
                $status = array();
                $i = 0;
                while ($reg = mysqli_fetch_assoc($res)) {
                    $id[$i] = $reg['id'];
                    $nome[$i] = $reg['nome'];
                    $img[$i] = $reg['img'];
                    $desc[$i] = $reg['descrição'];
                    $status[$i] = $reg['status'];
        ?>

        <tr>
            <td><?php echo $id[$i]; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $desc[$i]; ?></td>
            <td><?php echo $status[$i]; ?></td>
            <?php
                if($status[$i] == 'ativo'){
                    echo '<td><a href="desativar_prof?id='.$id[$i].'"><i class="fas fa-pause"></i> Desativar</a></td>';
                }elseif($status[$i] == 'inativo'){
                    echo '<td><a href="ativar_prof?id='.$id[$i].'"><i class="fas fa-play"></i> Ativar</a></td>';
                }
            ?>
        </tr>

        <?php }} ?>
    </table>
    <a href="./cad_prof" class="btn">Cadastrar Professor</a>
</section>

<?php mysqli_close($conn); ?>

</body>
</html>