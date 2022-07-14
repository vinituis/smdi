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
    <title>SMDI | Administração de Usuários</title>

<?php echo $headAdm; ?>

</head>
<body>
    
<?php echo $headerAdm; ?>

<section class='courses' id='usuarios'>
    <div class='heading'>
        <h3>Gerenciar usuários</h3>
        <a href="./download_on" class="btn">Baixar em Excel</a>
        <?php 
            $usu = 'SELECT * FROM user';

            if ($result=mysqli_query($conn, $usu)){
                $i=0;
                $ia=0;
                $ip=0;
                while ($registro = mysqli_fetch_array($result)){
                   $type = $registro['user_type'];
                   
                    if($type == 'user'){
                        $i= $i + 1;
                    }
                    if($type == 'pre'){
                        $ip= $ip + 1;
                    }
                    if($type == 'admin'){
                        $ia= $ia + 1;
                    }
                   
                }
                
                mysqli_num_rows($result);
                    echo "<h2 class='n-usu'>" . $i . " usuários online, " . $ia . " administradores</h2>";
            }
        ?>
    </div>
    <table>
        <tr>
            <td rowspan="2">id</td>
            <td rowspan="2">nome</td>
            <td rowspan="2">email</td>
            <td rowspan="2">Acesso</td>
            <td colspan="4">Aulas</td>
            <td rowspan="2" colspan="2">Ação</td>
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
                    if($user_type[$i] !== 'pre'){
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
                }elseif($user_type[$i] == 'pre'){
                    echo 'presencial';
                } ?>
            </td>
            <td><?php echo $aula1[$i]; ?></td>
            <td><?php echo $aula2[$i]; ?></td>
            <td><?php echo $aula3[$i]; ?></td>
            <td><?php echo $aula4[$i]; ?></td>
            <?php
                if($user_type[$i] == 'block'){
                    echo '<td><a href="./desbloqueio_user?id='.$id[$i].'">Liberar</a></td>';
                }elseif($user_type[$i] == 'user'){
                    echo '<td><a href="./bloqueio_user?id='.$id[$i].'">Bloquear</a></td>
                    <td><a href="./trocar_pre?id='.$id[$i].'">Tornar presencial</a></td>';
                }elseif($user_type[$i] == 'admin'){
                    echo '<td></td><td></td>';
                }else{
                    echo '<td></td>';
                }
            ?>
            
        </tr>

        <?php }}} ?>
    </table>

</section>

<?php mysqli_close($conn); ?>

</body>
</html>