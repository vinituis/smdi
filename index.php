<?php

@include 'config.php';
@include 'cabecalho.php';

if(isset($_SESSION['user_name'])){
    header('location:./home');
}
if(isset($_SESSION['admin_name'])){
    header('location:./admin_page');
}

// ini_set('display_errors', 0);
// ini_set('display_startup_erros', 0);

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

        $_SESSION['admin_name'] = $row['name'];
        header('location:admin_page');

      }elseif($row['user_type'] == 'user'){

        $_SESSION['user_name'] = $row['name'];
        header('location:home');

        $_SESSION['user_email'] = $row['email'];
        header('location:home');

        $_SESSION['user_id'] = $row['id'];
        header('location:home');

      }elseif($row['user_type'] == 'block'){
        $error[] = 'Seu usuario está bloqueado!';
      }
     
   }else{
      $error[] = 'Não identificamos seu registo';
   }

};
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI | Login</title>
    <meta name="description" content="<?php echo $descLogin; ?>">
    <?php
        echo $loginCss; 
        echo $fontawesome;
        echo $GA4;
        echo $favicon;

    ?>
</head>
<body>
    <div class="form-container">
        <form action="" method="post" id="loginSMDI">
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
            <h3>Acesse a plataforma</h3>
            <i class="fas fa-at"></i>
            <input name="email" type="email" placeholder="Digite seu email" />
            <i class="fas fa-lock"></i>
            <input name="password" type="password" placeholder="Digite seu CPF" />
            <input type="submit" name="submit" value="Acessar" />
            <a href="./registro">Faça seu registro!</a>
        </form>
    </div>
    
    <script>
        var formL = document.getElementById('loginSMDI');

        formL.addEventListener('mousemove', (e) =>{
            var x = (window.innerWidth / 2 - e.pageX) / 20;
            var y = (window.innerHeight / 2 - e.pageY) / 20;

            formL.style.transform = 'rotateX(' + x + 'deg) rotateY(' + y + 'deg)';
        });

        formL.addEventListener('mouseleave', function(){
            formL.style.transform = 'rotateX(0deg) rotateY(0deg)';
        });
    </script>

<?php mysqli_close($conn); ?>

</body>
</html>