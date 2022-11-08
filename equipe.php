<?php

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
    <title>SMDI | Nossa equipe</title>
    <link rel="stylesheet" href="./css/equipe.css">

<?php echo $headLinks ?>

</head>
<body>
    
<?php echo $header; ?>

<section class="courses" id="equipe">
    <div class="heading">
        <h3>Nossa Equipe</h3>
    </div>
    <div class="equipe">
        <div class="camila">
            <p>Camila Nora</p>
        </div>
        <div class="charles">
            <p>Charles Santana</p>
        </div>
        <div class="denise">
            <p>Denise Souza</p>
        </div>
        <div class="fernanda">
            <p>Fernanda Santos</p>
        </div>
        <div class="geraldo">
            <p>Geraldo Passos Jr.</p>
        </div>
        <div class="jefferson">
            <p>Jefferson Luis</p>
        </div>
        <div class="lariza">
            <p>Lariza Pio</p>
        </div>
        <div class="murilo">
            <p>Murilo Matos</p>
        </div>
        <div class="nelson">
            <p>Nelson Padilha</p>
        </div>
        <div class="sidney">
            <p>Sidney da Silva</p>
        </div>
        <div class="vilma">
            <p>Vilma Barros</p>
        </div>
        <div class="vinicius">
            <p>Vinicius Fernandes</p>
        </div>
    </div>
</section>

</body>
</html>