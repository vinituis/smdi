<?php

include 'config.php';
include 'cabecalho.php';
$iniciado;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>complete responsive online education website design tutorial</title>

<?php echo $headLinks ?>

</head>
<body>

<?php echo $header; ?>

<section class="courses" id="ed2019">

    <div class="heading">
        <span>Assista</span>
        <h3>Aulas gravadas 2019</h3>
    </div>

    <div class="box-container">
    <?php
    $sql = 'SELECT * FROM aulas';
    if($res=mysqli_query($conn, $sql)){
        $id = array();
        $nome = array();
        $cat = array();
        $prof = array();
        $status = array();
        $video = array();
        $ref = array();
        $i = 0;
        while ($reg = mysqli_fetch_assoc($res)) {
            $id[$i] = $reg['id'];
            $nome[$i] = $reg['nome_aula'];
            $cat[$i] = $reg['categoria'];
            $prof[$i] = $reg['professor'];
            $status[$i] = $reg['status'];
            $video[$i] = $reg['video'];
            $ref[$i] = $reg['referencia'];
            if($status[$i] == 'ativo'){
                if($cat[$i] == '2019'){
    ?>
    <div class="box">
        <div class="image">
            <h3><?php echo $nome[$i]; ?></h3>
            <p class="prof-name">Professor: <?php echo $prof[$i]; ?></p>
            <div class="iframe">
                <?php echo $video[$i]; ?>
            </div>
        </div>
    </div> 

    <?php
                }
            }
        }
        if($result=mysqli_query($conn, $sql)){
            $rowcount=mysqli_num_rows($result);
            if($rowcount == '0'){
                echo $semContent;
            }
        }} ?>

</section>
<section class="courses" id="ed2020">
    <div class="heading">
        <span>Assista</span>
        <h3>Aulas gravadas 2020</h3>
    </div>
    <div class="box-container">
        
    <?php
    $sql = 'SELECT * FROM aulas';
    if($res=mysqli_query($conn, $sql)){
        $id = array();
        $nome = array();
        $cat = array();
        $prof = array();
        $status = array();
        $video = array();
        $ref = array();
        $i = 0;
        while ($reg = mysqli_fetch_assoc($res)) {
            $id[$i] = $reg['id'];
            $nome[$i] = $reg['nome_aula'];
            $cat[$i] = $reg['categoria'];
            $prof[$i] = $reg['professor'];
            $status[$i] = $reg['status'];
            $video[$i] = $reg['video'];
            $ref[$i] = $reg['referencia'];
            if($status[$i] == 'ativo'){
                if($cat[$i] == '2020'){
    ?>
    
        <div class="box">
            <div class="image">
                <h3><?php echo $nome[$i]; ?></h3>
                <p class="prof-name">Professor: <?php echo $prof[$i]; ?></p>
                <div class="iframe">
                    <?php echo $video[$i]; ?>
                </div>
            </div>
        </div>

        <?php }}}
        if($result=mysqli_query($conn, $sql)){
            $rowcount=mysqli_num_rows($result);
            if($rowcount == '0'){
                echo $semContent;
            }
        }} ?>
    </div>
</section>
<section class="courses" id="ed2021">
    <div class="heading">
        <span>Assista</span>
        <h3>Aulas gravadas 2021</h3>
    </div>
    <div class="box-container">
        
    <?php
    $sql = 'SELECT * FROM aulas';
    if($res=mysqli_query($conn, $sql)){
        $id = array();
        $nome = array();
        $cat = array();
        $prof = array();
        $status = array();
        $video = array();
        $ref = array();
        $i = 0;
        while ($reg = mysqli_fetch_assoc($res)) {
            $id[$i] = $reg['id'];
            $nome[$i] = $reg['nome_aula'];
            $cat[$i] = $reg['categoria'];
            $prof[$i] = $reg['professor'];
            $status[$i] = $reg['status'];
            $video[$i] = $reg['video'];
            $ref[$i] = $reg['referencia'];
            if($status[$i] == 'ativo'){
                if($cat[$i] == '2021'){
    ?>
    
        <div class="box">
            <div class="image">
                <h3><?php echo $nome[$i]; ?></h3>
                <p class="prof-name">Professor: <?php echo $prof[$i]; ?></p>
                <div class="iframe">
                    <?php echo $video[$i]; ?>
                </div>
            </div>
        </div>

        <?php }}}
    if($result=mysqli_query($conn, $sql)){
        $rowcount=mysqli_num_rows($result);
        if($rowcount == '0'){
            echo $semContent;
        }
    }} ?>
    </div>
</section>

<?php mysqli_close($conn); ?>

</body>
</html>
    