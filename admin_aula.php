<?php

include 'config.php';
include 'cabecalho.php';

$iniciado;

if(!isset($_SESSION['admin_name'])){
   header('location:./');
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
            <td colspan="2">ação</td>
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
                    echo '<td width="12%"><a href="./desativar_aula?id='.$id[$i].'"><i class="fas fa-pause"></i> Desativar</a></td>
                    <td width="12%"><a href="./bloqueio_aula?id='.$id[$i].'"><i class="fas fa-lock"></i> Bloquear</a></td>';
                }elseif($status[$i] == 'inativo'){
                    echo '<td width="12%"><a href="./ativar_aula?id='.$id[$i].'"><i class="fas fa-play"></i> Ativar</a></td>
                    <td width="12%"><a href="./bloqueio_aula?id='.$id[$i].'"><i class="fas fa-lock"></i> Ativar bloqueado</a></td>';
                }elseif($status[$i] == 'block'){
                    echo '<td width="12%"><a href="./ativar_aula?id='.$id[$i].'"><i class="fas fa-play"></i> Ativar</a></td>
                    <td width="12%"><a href="./desativar_aula?id='.$id[$i].'"><i class="fas fa-pause"></i> Desativar</a></td>';
                }
            ?>
        </tr>

        <?php }} ?>
    </table>

    <a href="./cad_aula" class="btn">Cadastrar aula</a>
</section>
</body>
</html>