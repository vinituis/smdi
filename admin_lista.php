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
    <title>SMDI | Administração de Usuários Presencial</title>

<?php echo $headAdm; ?>

</head>
<body>
    
<?php echo $headerAdm; ?>

<section class='courses' id='palestrantes'>
    <div class='heading'>
        <h3>Lista de Palestrantes e convidados presenciais</h3>
        <?php 
            $palestrante = 'SELECT * FROM user';

            if ($result=mysqli_query($conn, $palestrante)){
                $i=0;
                $ia=0;
                $ip=0;
                while ($registro = mysqli_fetch_array($result)){
                   $type = $registro['user_type'];
                   
                    if($type == 'conv'){
                        $ip= $ip + 1;
                    }
                }
                
                mysqli_num_rows($result);
                    echo "<h2 class='n-usu'>" . $ip . " usuários presenciais </h2>";
            }
        ?>
    </div>
    <table>
        <tr>
            <td>id</td>
            <td>nome</td>
            <td>email</td>
            <td>Acesso</td>
            <td>Ação</td>
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
                    if($user_type[$i] == 'conv'){
        ?>

        <tr>
            <td><?php echo $id[$i]; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $email[$i]; ?></td>
            <td>
                <?php if($user_type[$i] == 'conv'){
                    echo 'Convidado';
                } ?>
            </td>
            <td>
            <?php if($user_type[$i] == 'conv'){
                    echo '<a href="./trocar_pre?id='.$id[$i].'">Tornar presencial</a>';
                } ?>
            </td>
            
        </tr>

        <?php }}} ?>
    </table>

</section>

<section class='courses' id='usuarios'>
    <div class='heading'>
        <h3>Lista dos inscritos presenciais</h3>
        <a href="./download_pre" class="btn">Baixar em Excel</a>
        <?php 
            $usu = 'SELECT * FROM user';

            if ($result=mysqli_query($conn, $usu)){
                $lesp=0;
                $ip=0;
                while ($registro = mysqli_fetch_array($result)){
                   $type = $registro['user_type'];
                   
                    if($type == 'pre'){
                        $ip= $ip + 1;
                    }
                    if($type == 'user_pre'){
                        $lesp= $lesp + 1;
                    }
                }
                
                mysqli_num_rows($result);
                    echo "<h2 class='n-usu'>" . $ip . " usuários presenciais e " . $lesp . " na lista de espera</h2>";
            }
        ?>
    </div>
    <table>
        <tr>
            <td>id</td>
            <td>nome</td>
            <td>email</td>
            <td>Acesso</td>
            <td colspan="2">Ação</td>
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
                    if($user_type[$i] == 'pre'){
        ?>

        <tr>
            <td><?php echo $id[$i]; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $email[$i]; ?></td>
            <td>
                <?php if($user_type[$i] == 'pre'){
                    echo 'presencial';
                } ?>
            </td>
            <?php if($user_type[$i] == 'pre'){
                echo '<td><a href="./desbloqueio_user?id='.$id[$i].'">Tornar online</a></td>
                <td><a href="./convidado?id='.$id[$i].'">Tornar convidado</a></td>
                ';
            } ?>            
        </tr>

        <?php }}} ?>
    </table>

</section>

<section class='courses' id='espera'>
    <div class='heading'>
        <h3>Lista de espera presencial</h3>
        <?php 
            $usu = 'SELECT * FROM user';

            if ($result=mysqli_query($conn, $usu)){
                $i=0;
                $ia=0;
                $ip=0;
                while ($registro = mysqli_fetch_array($result)){
                   $type = $registro['user_type'];
                   
                    if($type == 'user_pre'){
                        $ip= $ip + 1;
                    }
                }
                
                mysqli_num_rows($result);
                    echo "<h2 class='n-usu'>" . $ip . " usuários presenciais </h2>";
            }
        ?>
    </div>
    <table>
        <tr>
            <td>id</td>
            <td>nome</td>
            <td>email</td>
            <td>Acesso</td>
            <td>Ação</td>
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
                    if($user_type[$i] == 'user_pre'){
        ?>

        <tr>
            <td><?php echo $id[$i]; ?></td>
            <td><?php echo $nome[$i]; ?></td>
            <td><?php echo $email[$i]; ?></td>
            <td>
                <?php if($user_type[$i] == 'user_pre'){
                    echo 'Online na lista de espera';
                } ?>
            </td>
            <td>
                <?php if($user_type[$i] == 'user_pre'){
                    echo '<a href="./trocar_pre?id='.$id[$i].'">Tornar presencial</a>';
                } ?>
            </td>
            
        </tr>

        <?php }}} ?>
    </table>

</section>

<?php mysqli_close($conn); ?>

</body>
</html>