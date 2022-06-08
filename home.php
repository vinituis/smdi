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

<section class="home" id="home">

    <div class="image">
        <img src="images/home-img.svg" alt="">
    </div>

    <div class="content">
        <span>online education</span>
        <h3>A better learning future starts here. <a href="#">get started</a></h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, itaque beatae laboriosam nulla odio voluptatibus molestias vero pariatur laborum molestiae.</p>
        <a href="#courses" class="btn">our courses</a>
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