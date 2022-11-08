<?php

include 'config.php';
include 'cabecalho.php';

if(!isset($_SESSION['admin_name'])){
    header('location:./');
}

$iniciado;

$sql = 'SELECT * from user';

$arquivo = 'lista_Online.xls';
$data = gmdate("d-m-y_H-i-s");
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexecel");
header ("Content-Disposition: attachment; filename={$arquivo}");
header ("Content-Description: Lista baixada em ".$data."");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI | Download Lista Online</title>
    <?php
        echo $noIndex;
    ?>
</head>
<body>
    <div>
        <table border="1">
            <tr>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Acesso</td>
            </tr>
            <?php 
                if($res=mysqli_query($conn, $sql)){
                    $name = array();
                    $email = array();
                    $user_type = array();
                    $i = 0;
                    while($reg = mysqli_fetch_assoc($res)){
                        $name[$i] = $reg['name'];
                        $email[$i] = $reg['email'];
                        $user_type[$i] = $reg['user_type'];
                        if($user_type[$i] == 'user' ){
                            echo "<tr>";
                            echo "<td>" . $name[$i] . "</td>";
                            echo "<td>" . $email[$i] . "</td>";
                            echo "<td>" . $user_type[$i] . "</td>";
                            echo "</tr>";
                        }

                        if($user_type[$i] == 'admin' ){
                            echo "<tr>";
                            echo "<td>" . $name[$i] . "</td>";
                            echo "<td>" . $email[$i] . "</td>";
                            echo "<td>" . $user_type[$i] . "</td>";
                            echo "</tr>";
                        }
                    }
                }

            ?>
        </table>
    </div>
    
</body>
</html>