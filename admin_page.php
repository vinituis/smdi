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
    
<?php echo $headerAdm; ?>

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
                $i = 0;
                while ($reg = mysqli_fetch_assoc($res)) {
                    $id[$i] = $reg['id'];
                    $nome[$i] = $reg['nome_aula'];
                    $cat[$i] = $reg['categoria'];
                    $prof[$i] = $reg['professor'];
                    $desc[$i] = $reg['descrição'];
                    $nota[$i] = $reg['nota'];
        ?>

        <tr>
            <td><?php echo $id[$i]; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $cat[$i]; ?></td>
            <td><?php echo $prof[$i]; ?></td>
            <td><?php echo $desc[$i]; ?></td>
            <td><?php echo $nota[$i]; ?></td>
        </tr>

        <?php }} ?>
    </table>

    <a href="./admin_aula" class="btn">Gerenciar aulas</a>
</section>

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
                    echo '<td><a href="desativar_prof?id='.$id[$i].'">Desativar</a></td>';
                }elseif($status[$i] == 'inativo'){
                    echo '<td><a href="ativar_prof?id='.$id[$i].'">Ativar</a></td>';
                }
            ?>
        </tr>

        <?php }} ?>
    </table>
    <a href="./admin_prof" class="btn">Gerenciar professores</a>
</section>


<section class='courses' id='usuarios'>
    <div class='heading'>
        <h3>Usuários cadastrados</h3>
    </div>
    <table>
        <tr>
            <td rowspan="2">id</td>
            <td rowspan="2">nome</td>
            <td rowspan="2">email</td>
            <td rowspan="2">Acesso</td>
            <td colspan="4">Aulas</td>
        </tr>
        <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
        </tr>
        <?php 
            $sql = 'SELECT * FROM user';
            if($res=mysqli_query($conn, $sql)){
                $id = array();
                $nome = array();
                $email = array();
                $user_type = array();
                $aula1 = array();
                $i = 0;
                while ($reg = mysqli_fetch_assoc($res)) {
                    $id[$i] = $reg['id'];
                    $nome[$i] = $reg['name'];
                    $email[$i] = $reg['email'];
                    $user_type[$i] = $reg['user_type'];
                    $aula1[$i] = $reg['ass_aula_1'];
                    $aula2[$i] = $reg['ass_aula_2'];
                    $aula3[$i] = $reg['ass_aula_3'];
                    $aula4[$i] = $reg['ass_aula_4'];
        ?>

        <tr>
            <td><?php echo $id[$i]; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $email[$i]; ?></td>
            <td>
                <?php if($user_type[$i] == 'admin'){
                    echo 'administrador';
                }elseif($user_type[$i] == 'user'){
                    echo 'usuário ativo';
                }elseif($user_type[$i] == 'block'){
                    echo 'usuário bloqueado';
                } ?>
            </td>
            <td><?php echo $aula1[$i]; ?></td>
            <td><?php echo $aula2[$i]; ?></td>
            <td><?php echo $aula3[$i]; ?></td>
            <td><?php echo $aula4[$i]; ?></td>
        </tr>

        <?php }} ?>
    </table>

    <a href="./admin_user" class="btn">Gerenciar usuários</a>

</section>

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
            <td>ações</td>
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
                    echo '<td><a href="./desativar_material?id='.$id[$i].'">Desativar</a><a style="margin-left: 1rem;" href="./bloqueio_material?id='.$id[$i].'">Bloquear</a></td>';
                }elseif($status[$i] == 'inativo'){
                    echo '<td><a href="./ativar_material?id='.$id[$i].'">Ativar</a><a style="margin-left: 1rem;" href="./bloqueio_material?id='.$id[$i].'">Ativar bloqueado</a></td>';
                }elseif($status[$i] == 'block'){
                    echo '<td><a href="./ativar_material?id='.$id[$i].'">Ativar</a><a style="margin-left: 1rem;" href="./desativar_material?id='.$id[$i].'">Desativar</a></td>';
                }
            ?>
        </tr>

        <?php }} ?>
    </table>

    <a href="./admin_material" class="btn">Gerenciar materiais</a>
</section>
</body>
</html>