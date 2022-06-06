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
    <title>SMDI - Aulas</title>

    <?php echo $headLinks ?>
</head>
<body>

<?php echo $header; ?>

<section class="blogs" id="materiais">

    <div class="heading">
        <span>acesse</span>
        <h3>Materiais complementares</h3>
    </div>

    <div class="box-container">
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
            if($status[$i] == 'ativo'){
    ?>
        <div class="box">
            <div class="image">
                <i class="space"></i>
            </div>
            <img src="<?php echo $img[$i]; ?>" alt="">
            <a href="<?php echo $url[$i];?>" class="title"><?php echo $nome[$i];?></a>
            <p class="blog-description"><?php echo $desc[$i];?></p>
            <div class="icons">
                <p><i class="fas fa-calendar"></i> <?php echo $data[$i];?></p>
                <a href="<?php echo $url[$i];?>">Acessar</a>
            </div>
        </div>
    <?php }elseif($status[$i] == 'block'){?>
        <div class="box">
            <div class="image">
                <i class="fas fa-lock"></i>
            </div>
            <img src="<?php echo $img[$i]; ?>" alt="">
            <a href="" class="title btn-d"><?php echo $nome[$i];?></a>
            <p class="blog-description"><?php echo $desc[$i];?></p>
            <div class="icons">
                <p><i class="fas fa-calendar"></i> <?php echo $data[$i];?></p>
                <a class="btn-d">Acessar</a>
            </div>
        </div>
    <?php }}
    if($result=mysqli_query($conn, $sql)){
        $rowcount=mysqli_num_rows($result);
        if($rowcount == '0'){
            echo $semContent;
        }else if($rowcount >= '0' & $status[$i] == 'inativo'){
            echo $semContent;
        }
    }} ?>

    </div>
    
</section>

<?php mysqli_close($conn); ?>

</body>
</html>