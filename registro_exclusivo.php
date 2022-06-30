<?php

@include 'config.php';
@include 'cabecalho.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Usuário já existe!';

   }else{

      if($pass != $cpass){
         $error[] = 'Os CPFs não combinam!';
      }else{
         $insert = "INSERT INTO user(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         $correct[] = 'Registro realizado!';
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
        echo $fontawesome;
        echo $noIndex;
    ?>
</head>
<body>
    <div class="form-container">
      <div class="text">
         <h2>SMDI</h2>
         <p>No dia 18/08 você será nosso convidado para um evento totalmente prático.</p>
         <p>Será presencial na ABIMAQ São Paulo, com participação online.</p>
         <span>Endereço</span>
         <small>Av. Jabaquara, 2925 - São Paulo/SP</small>
         <span class="aviso">As vagas presenciais são limitadas</span>
         <button><a href="#registroSMDIPresencial">Realize seu cadastro <i class="fas fa-long-arrow-alt-right"></i></a></button>
      </div>
      <form id="registroSMDIPresencial" action="" method="post">
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
         <input type="text" name="name" required placeholder="Digite seu nome completo">
         <input type="email" name="email" required placeholder="Digite seu email">
         <input type="password" name="password" required placeholder="Digite seu CPF">
         <input type="password" name="cpassword" required placeholder="Repita seu CPF">
         <select name="user_type" id="user_type" required>
            <option value="">Selecione sua participação</option>
            <option value="pre">Presencial</option>
            <option value="user">Online</option>
         </select>
         
         <div class="aceite">
            <input type="checkbox" name="aceite" id="aceite" required>
            <label for="aceite">Você concorda em receber as comunicações da ABIMAQ e dos parceiros que apoiam o SMDI 2022.</label>
         </div>
         <input type="submit" name="submit" value="Cadastrar" class="form-btn">
         <br><br>
         <p>Já tem cadastro? <a href="./">Faça login aqui!</a></p>
      </form>

    </div>

<?php mysqli_close($conn); ?>

</body>
</html>