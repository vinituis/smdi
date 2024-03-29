<?php

include 'config.php';
include 'cabecalho.php';

if(isset($_SESSION['user_name'])){
    
}elseif(isset($_SESSION['admin_name'])){

}else{
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
    <title>SMDI | Professores</title>

    <?php echo $headLinks ?>
</head>
<body>

<?php echo $header; ?>

<section class="reviews" id="professores">

    <div class="heading">
        <span>Conheça</span>
        <h3>Os professores</h3>
    </div>

    <div class="box-container">
    <?php
    $sql = 'SELECT * FROM professores ORDER BY nome ASC';
    if($res=mysqli_query($conn, $sql)){
        $id = array();
        $nome = array();
        $img = array();
        $cargo = array();
        $status = array();
        $atual = array();
        $i = 0;
        while ($reg = mysqli_fetch_assoc($res)) {
            $id[$i] = $reg['id'];
            $nome[$i] = $reg['nome'];
            $img[$i] = $reg['img'];
            $cargo[$i] = $reg['cargo'];
            $status[$i] = $reg['status'];
            $atual[$i] = $reg['atual'];
            if($status[$i] == 'ativo'){
    ?>
        <div class="box">
            <?php 
            if($atual[$i] == 's'){
                $atual[$i] = '<span class="tag p">Professor da edição atual</span>';
            }else{
                $atual[$i] = '<span class="tag n">Professor da edição anterior</span>';
            }
            
            ?>
            <a href="./professor?id=<?php echo $id[$i]; ?>">    
                <img src="<?php echo $img[$i]; ?>" alt="">
                <h3><?php echo $nome[$i]; ?></h3>
            </a>
            <?php echo $atual[$i]; ?>
            <p><?php echo $cargo[$i]; ?></p>
        </div>
    <?php }}
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