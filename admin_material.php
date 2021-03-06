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
    <title>SMDI | Administração de Materiais</title>

<?php echo $headAdm; ?>

</head>
<body>
    
<?php echo $headerAdm; ?>

<section class='courses' id='materiais'>
    <div class='heading'>
        <h3>Materiais cadastrados</h3>
    </div>
    <table>
        <tr>
            <td>id</td>
            <td>nome</td>
            <td>descrição</td>
            <td>data</td>
            <td>status</td>
            <td>material</td>
            <td colspan="2">ações</td>
        </tr>
        <?php 
            $sql = 'SELECT * FROM materiais';
            if($res=mysqli_query($conn, $sql)){
                $id = array();
                $nome = array();
                $img = array();
                $desc = array();
                $data = array();
                $url = array();
                $status = array();
                $i = 0;
                while ($reg = mysqli_fetch_assoc($res)) {
                    $id[$i] = $reg['id'];
                    $nome[$i] = $reg['nome'];
                    $img[$i] = $reg['img'];
                    $desc[$i] = $reg['descrição'];
                    $data[$i] = $reg['data'];
                    $url[$i] = $reg['url'];
                    $status[$i] = $reg['status'];
        ?>

        <tr>
            <td><?php echo $id[$i]; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $desc[$i]; ?></td>
            <td><?php echo $data[$i]; ?></td>
            <td><?php echo $status[$i]; ?></td>
            <td><a href="<?php echo $url[$i]; ?>">Acesse</a></td>
            <?php
                if($status[$i] == 'ativo'){
                    echo '<td width="12%"><a href="./desativar_material?id='.$id[$i].'"><i class="fas fa-pause"></i> Desativar</a></td>
                    <td width="12%"><a style="margin-left: 1rem;" href="./bloqueio_material?id='.$id[$i].'"><i class="fas fa-lock"></i> Bloquear</a></td>';
                }elseif($status[$i] == 'inativo'){
                    echo '<td width="12%"><a href="./ativar_material?id='.$id[$i].'"><i class="fas fa-play"></i> Ativar</a></td>
                    <td width="12%"><a style="margin-left: 1rem;" href="./bloqueio_material?id='.$id[$i].'"><i class="fas fa-lock"></i> Ativar bloqueado</a></td>';
                }elseif($status[$i] == 'block'){
                    echo '<td width="12%"><a href="./ativar_material?id='.$id[$i].'"><i class="fas fa-play"></i> Ativar</a></td>
                    <td width="12%"><a style="margin-left: 1rem;" href="./desativar_material?id='.$id[$i].'"><i class="fas fa-pause"></i> Desativar</a></td>';
                }
            ?>
        </tr>

        <?php }} ?>
    </table>
    <a href="./cad_material" class="btn">Cadastrar material</a>
</section>

<?php mysqli_close($conn); ?>

</body>
</html>