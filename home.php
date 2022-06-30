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
    <title>SMDI | Página Inicial</title>

<?php echo $headLinks ?>

</head>
<body>
    
<?php echo $header; ?>

<span class="aviso">
        <?php
            if($_SESSION['type'] == 'pre'){
                echo 'Você está cadastrado como um participante presencial';
            }elseif($_SESSION['type'] == 'admin'){
                echo 'Você é um administrador';
            }elseif($_SESSION['type'] == 'user'){
                echo 'Você está cadastrado como um participante online';
            }
        ?>
</span>

<section class="home" id="home">

    <div class="image">
        <img src="images/home.svg" alt="">
    </div>

    <div class="content">
        <span>Evento Híbrido</span>
        <h3>Seminário de Marketing Digital na Indústria. <br><a>SMDI 2022</a></h3>
        <p>Esse ano a ABIMAQ proporciona uma experiência inovadora em marketing digital. Um evento presencial e online, totalmente prático, para profissionais que querem se aprimorar e tornar seus negócios em referências de mercado.</p>
        <a href="#pricing" class="btn">Conheça as modalidades de participação</a>
    </div>
    <div class="heading">
        <h3>O que é o SMDI?</h3>
        <p>O SMDI começou em 2019 com o objetivo de oferecer aos nossos associados uma experiência diferenciada que realmente traga resultados para os departamento de marketing das empresas no segmento industrial.</p>
        <p>Depois de 2 anos fazendo o Seminário totalmente online, vamos voltar em formato híbrido, possibilitando o networking entre os participantes, com o grande diferencial deste ano: foco no Hands On!</p>
        <p>Vamos trazer palestrantes com conteúdo mão na massa, e os participantes devem trazer os seus notebooks para acompanhar o passo a passo.<br> <b>Atenção:</b> as vagas presenciais são limitadas!</p>
    </div>
    <div class="image">
        <img src="images/home2.svg" alt="">
    </div>
    <div class="heading">
        <h3>Quando vai acontecer?</h3>
        <p>Dia 18 de agosto de 2022, quinta-feira<br>Das 9h às 18h</p>
    </div>
</section>
<!-- category section starts  -->

<section class="category" id="category">

    <div class="box-container">

        <div class="box">
            <i class="fas fa-chart-line"></i>
            <h3>Porque participar?</h3>
            <p>É uma oportunidade única de estar em um evento híbrido, com a possibilidade de fazer networking e também de acessar um tipo de conteúdo prático que não se encontra em qualquer lugar da internet.<br><br>Você vai poder acompanhar passo a passo como implementar estratégias que comprovadamente trazem resultados e o melhor, trazer suas dúvidas e obter respostas ao vivo, com palestrantes de renome no marketing digital!</p>
        </div>

        <div class="box">
            <i class="fas fa-users"></i>
            <h3>Quem participa?</h3>
            <p>Indicado para todos os profissionais e estudantes que desejam aprender mais sobre marketing voltado para negócios, de uma forma fácil e prática!<br><br>Se você trabalha ou quer trabalhar com marketing e está na indústria, então aqui é o seu lugar!</p>
        </div>

    </div>

</section>

<!-- category section ends -->

<section class="pricing" id="pricing">

    <div class="heading">
        <h3>Modalidades de participação</h3>
    </div>

    <div class="box-container">

        <div class="box">
            <h3>Presencial | <small>Vagas limitadas</small></h3>
            <img src="images/price-3.svg" alt="">
            <div class="list">
                <p> <i class="fas fa-check"></i> Acesso as edições anteriores </p>
                <p> <i class="fas fa-check"></i> Acesso a materiais complementares das edições anteriores </p>
                <p> <i class="fas fa-check"></i> Aulas ao vivo da edição de 2022 </p>
                <p> <i class="fas fa-check"></i> Materiais complementares de 2022 </p>
                <p> <i class="fas fa-check"></i> Aula prática presencial </p>
            </div>
        </div>

        <div class="box">
            <h3>Ao vivo para sócios</h3>
            <img src="images/price-2.svg" alt="">
            <div class="list">
                <p> <i class="fas fa-check"></i> Acesso as edições anteriores </p>
                <p> <i class="fas fa-check"></i> Acesso a materiais complementares das edições anteriores </p>
                <p> <i class="fas fa-check"></i> Aulas ao vivo da edição de 2022 </p>
                <p> <i class="fas fa-check"></i> Materiais complementares de 2022 </p>
                <p> <i class="fas fa-times"></i> Aula prática presencial </p>
            </div>
        </div>

        <div class="box">
            <h3>Gravado para não sócios</h3>
            <img src="images/price-1.svg" alt="">
            <div class="list">
                <p> <i class="fas fa-check"></i> Acesso as edições anteriores </p>
                <p> <i class="fas fa-check"></i> Acesso a materiais complementares das edições anteriores </p>
                <p> <i class="fas fa-times"></i> Aulas ao vivo da edição de 2022 </p>
                <p> <i class="fas fa-times"></i> Materiais complementares de 2022 </p>
                <p> <i class="fas fa-times"></i> Aula prática presencial </p>
            </div>
        </div>  
    </div>
</section>
<!--
<section class="about" id="about">

    <div class="image">
        <img src="images/about-img.svg" alt="">
    </div>

    <div class="content">
        <span>about us</span>
        <h3>best online platform for e-learning.</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi beatae aperiam iusto officia illo porro. Magni, impedit quam saepe iste, vel perspiciatis eum libero magnam doloribus quisquam sint voluptatibus rem.</p>
        <a href="#" class="btn">read more</a>
    </div>

</section>

<section class="pricing" id="pricing">

    <div class="heading">
        <span>choose a plan</span>
        <h3>affordable plans</h3>
    </div>

    <div class="box-container">

        <div class="box">
            <h3>basic plan</h3>
            <img src="images/price-1.svg" alt="">
            <div class="amount"> <span>$</span>30<span>/mo</span> </div>
            <div class="list">
                <p> <i class="fas fa-check"></i> full courses </p>
                <p> <i class="fas fa-check"></i> online exams </p>
                <p> <i class="fas fa-check"></i> certificate </p>
                <p> <i class="fas fa-times"></i> full modules </p>
                <p> <i class="fas fa-times"></i> 24/7 support </p>
            </div>
            <a href="#" class="btn">choose plan</a>
        </div>

        <div class="box">
            <h3>standard plan</h3>
            <img src="images/price-2.svg" alt="">
            <div class="amount"> <span>$</span>50<span>/mo</span> </div>
            <div class="list">
                <p> <i class="fas fa-check"></i> full courses </p>
                <p> <i class="fas fa-check"></i> online exams </p>
                <p> <i class="fas fa-check"></i> certificate </p>
                <p> <i class="fas fa-check"></i> full modules </p>
                <p> <i class="fas fa-times"></i> 24/7 support </p>
            </div>
            <a href="#" class="btn">choose plan</a>
        </div>

        <div class="box">
            <h3>premium plan</h3>
            <img src="images/price-3.svg" alt="">
            <div class="amount"> <span>$</span>90<span>/mo</span> </div>
            <div class="list">
                <p> <i class="fas fa-check"></i> full courses </p>
                <p> <i class="fas fa-check"></i> online exams </p>
                <p> <i class="fas fa-check"></i> certificate </p>
                <p> <i class="fas fa-check"></i> full modules </p>
                <p> <i class="fas fa-check"></i> 24/7 support </p>
            </div>
            <a href="#" class="btn">choose plan</a>
        </div>

    </div>

</section>

<section class="contact" id="contact">

    <div class="heading">
        <span>contact us</span>
        <h3>get in touch</h3>
    </div>

    <div class="row">

        <div class="contact-info-container">

            <div class="box">
                <i class="fas fa-phone"></i>
                <div class="info">
                    <h3>phone :</h3>
                    <p>+123-456-7890</p>
                    <p>+111-222-3333</p>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-envelope"></i>
                <div class="info">
                    <h3>email :</h3>
                    <p>shaikhanas@gmail.com</p>
                    <p>anasbhai@gmail.com</p>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-map"></i>
                <div class="info">
                    <h3>address :</h3>
                    <p>mumbai, india - 400104</p>
                </div>
            </div>

            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            
        </div>

        <form action="">
            <div class="inputBox">
                <input type="text" placeholder="name" name="" id="">
                <input type="email" placeholder="email" name="" id="">
            </div>
            <div class="inputBox">
                <input type="number" placeholder="phone" name="" id="">
                <input type="text" placeholder="subject" name="" id="">
            </div>
            <textarea name="" placeholder="message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" class="btn">
        </form>

    </div>

</section>
-->
</body>
</html>