<?php

@include 'config.php';
@include 'cabecalho.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Usuário já existe!';

   }else{

      if($pass != $cpass){
         $error[] = 'Os CPFs não combinam!';
      }else{
         $insert = "INSERT INTO user(name, email, password) VALUES('$name','$email','$pass')";
         mysqli_query($conn, $insert);
         $correct[] = 'Usuário cadastrado!';
      }
   }

};


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMDI | Registro</title>
    <meta name="description" content="<?php echo $descRegistro; ?>">
    <?php
        echo $registroCss;
        echo $GA4;
        echo $favicon;
    ?>
</head>
<body>
    <div class="form-container">

      <form id="registroSMDI" action="" method="post">
         <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };

         if(isset($correct)){
            foreach($correct as $correct){
               echo '<span class="correct-msg">'.$correct.'</span>';
            };
         };
         ?>
         <h3>Cadastre-se</h3>
         <input type="text" name="name" required placeholder="Digite seu nome">
         <input type="email" name="email" required placeholder="Digite seu email">
         <input type="password" name="password" required placeholder="Digite seu CPF">
         <input type="password" name="cpassword" required placeholder="Repita seu CPF">
         <div class="aceite">
            <input type="checkbox" name="aceite" id="aceite" required>
            <label for="aceite">Eu aceito receber comunicações da ABIMAQ e de seus parceiros</label>
         </div>
         <input type="submit" name="submit" value="Cadastrar" class="form-btn">
         <br><br>
         <p>Já tem cadastro? <a href="./">Faça login aqui!</a></p>
      </form>

    </div>
    <script>
        var formR = document.getElementById('registroSMDI');

        formR.addEventListener('mousemove', (e) =>{
            var x = (window.innerWidth / 2 - e.pageX) / 30;
            var y = (window.innerHeight / 2 - e.pageY) / 30;

            formR.style.transform = 'rotateX(' + x + 'deg) rotateY(' + y + 'deg)';
        });

        formR.addEventListener('mouseleave', function(){
            formR.style.transform = 'rotateX(0deg) rotateY(0deg)';
        });
    </script>

<?php mysqli_close($conn); ?>

</body>
</html>