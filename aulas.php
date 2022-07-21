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
    <title>SMDI | Aulas</title>

    <?php echo $headLinks ?>
</head>
<body>

<?php echo $header; ?>

<section class="courses" id="aulas">

    <div class="heading">
        <span>Assista</span>
        <h3>Aulas gravadas</h3>
    </div>

    <div class="box-container">

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
        $img = array();
        $ref = array();
        $i = 0;
        $it = 0;
        $ia = 0;
        while ($reg = mysqli_fetch_assoc($res)) {
            $id[$i] = $reg['id'];
            $nome[$i] = $reg['nome_aula'];
            $cat[$i] = $reg['categoria'];
            $prof[$i] = $reg['professor'];
            $desc[$i] = $reg['descrição'];
            $nota[$i] = $reg['nota'];
            $status[$i] = $reg['status'];
            $img[$i] = $reg['image'];
            $ref[$i] = $reg['referencia'];
            if($status[$i] == 'ativo'){
            if($ref[$i] == 'ed_anterior'){}else{
    ?>

        <div class="box">
            <div class="image">
                <i class="space"></i>
                <img src="<?php echo $img[$i]; ?>" alt="">
                <h3><?php echo $nome[$i]; ?></h3>
            </div>
            <div class="content">
                <!-- <div class="stars">
                    <?php 
                    if($nota[$i] == '1'){
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                    }elseif($nota[$i] == '2'){
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                    }elseif($nota[$i] == '3'){
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                    }elseif($nota[$i] == '4'){
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="far fa-star"></i>';
                    }elseif($nota[$i] == '5'){
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                    }
                    ?>
                </div> -->
                <h3><?php echo $nome[$i]; ?></h3>
                <p><?php echo $desc[$i]; ?></p>
                <p>Professor: <?php echo $prof[$i]; ?></p>
                <a href="./aula?id=<?php echo $id[$i]; ?>&aula=<?php echo $ref[$i]; ?>" class="btn">Acessar Aula</a>
            </div>
        </div>
<?php }}elseif($status[$i] == 'block'){
    if($ref[$i] == 'ed_anterior'){}else{
    ?>
    <div class="box">
            <div class="image">
                <i class="fas fa-lock"></i>
                <img src="<?php echo $img[$i]; ?>" alt="">
                <h3><?php echo $nome[$i]; ?></h3>
            </div>
            <div class="content">
                <h3><?php echo $nome[$i]; ?></h3>
                <p><?php echo $desc[$i]; ?></p>
                <p>Professor: <?php echo $prof[$i]; ?></p>
                <span class="btn btn-d">Aula bloqueada</span>
                <p><small style="text-transform: none;">A aula será liberada conforme o cronograma</small></p>
            </div>
        </div>
    <?php }}}} ?>

    </div>

</section>

<?php mysqli_close($conn); ?>

</body>
</html>