<?php

@include 'config.php';
@include 'cabecalho.php';

if(isset($_POST['submit'])){

   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
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
    <title>SMDI 2022 - Seminário de Marketing Digital na Indústria | Registro para o evento</title>
    <meta name="description" content="<?php echo $descRegistro; ?>">
    <?php
        echo $registroCss;
        echo $GA4;
        echo $favicon;
        echo $fontawesome;
    ?>
</head>
<body id="topo">
    <div class="form-container">
      <div class="text">
         <h1>SMDI</h1>
         <p>No dia 18/08 você será nosso convidado para um evento de marketing digital, voltado para profissionais que querem se aprimorar e tornar seus negócios em referências de mercado.</p>
         <p>O grande diferencial deste ano: <b>conteúdo mão na massa e prático!</b></p>
         <p>Será com participação online.</p>
         <button><a href="#registroSMDI">Realize seu cadastro <i class="fas fa-long-arrow-alt-right"></i></a></button>
      </div>
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
         <h3>Registre-se</h3>
         <input type="text" name="name" required placeholder="Digite seu nome completo">
         <input type="email" name="email" required placeholder="Digite seu email">
         <input type="password" name="password" required placeholder="Digite seu CPF">
         <input type="password" name="cpassword" required placeholder="Repita seu CPF">
         <div class="aceite">
            <input type="checkbox" name="aceite" id="aceite" required>
            <label for="aceite">Você concorda em receber as comunicações da ABIMAQ e dos parceiros que apoiam o SMDI 2022.</label>
         </div>
         <input type="submit" name="submit" value="Cadastrar" class="form-btn">
         <br><br>
         <p>Já tem cadastro? <a href="./">Faça login aqui!</a></p>
      </form>

    </div>

    <div class="conteudos">
      <div class="title">
         <h1>SMDI | Seminário de Marketing Digital na Indústria</h1>
         <h3>Nosso negócio é fazer você multiplicar seus negócios!</h3>
      </div>
      <p>
         Neste ano de 2022, nosso evento de marketing digital para a indústria está diferente, em formato híbrido e com as edições anteriores para você assistir agora mesmo.
         <br><br>
         São mais de 17 horas de aulas gravadas de puro conhecimento prático e aplicável para sua empresa.
         <br><br>
         Não perca tempo! Registre-se agora mesmo e tenha acesso a todas as aulas.
      </p>

      <div class="title">
         <h2>As aulas de 2022</h2>
      </div>
      <p class="aulas">No dia 18 de agosto de 2022, teremos aulas ao vivo sobre:
         <br><br>
         <ul>
            <li>Comunicação estratégica pelo WhatsApp;</li>
            <li>Como criar conteúdo relevante e atrativo para as redes sociais da sua indústria e conversar com o seu público comprador;</li>
            <li>Planejamento do zero à otimização;</li>
            <li>Marketing de Comunidade;</li>
            <li>Dicas de SEO para o seu negócio, com foco em Copywriting;</li>
            <li>Analytics e como identificar pontos de conversão no seu site;</li>
            <li>E muito mais...</li>
         </ul>
         <a href="#topo" class="btn">Registre-se agora mesmo</a>
      </p>
    </div>

<script>
   var formR = document.getElementById('registroSMDI');

   formR.addEventListener('mousemove', (e) =>{
      var x = (window.innerWidth / 2 - e.pageX) / 60;
      var y = (window.innerHeight / 2 - e.pageY) / 60;

      formR.style.transform = 'rotateX(' + x + 'deg) rotateY(' + y + 'deg)';
   });

   formR.addEventListener('mouseleave', function(){
      formR.style.transform = 'rotateX(0deg) rotateY(0deg)';
        });
</script>

<?php mysqli_close($conn); ?>

</body>
</html>