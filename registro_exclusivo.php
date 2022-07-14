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
         if($insert){
            date_default_timezone_set('America/Sao_Paulo');
            $hora_envio = date('H:i:s');
            $data_envio = date('d/m/Y');
            if($user_type == "pre"){
               $user_type = "Presencial";
            }
            if($user_type == "user"){
               $user_type == "Online";
            }
            $arq = "<style type='text/css'>
                  body {
                     margin:0;
                     font-family: Verdana, sans-serif;
                     font-size: 12px;
                     color: #808080;
                  }
                  p {
                     font-size: 12px;
                  }
                  a {
                     color: #666;
                     font-size: 12px;
                  }
                  table {
                     margin: 25px;
                  }
                  a:hover {
                     color: #005;
                     text-decoration: none;
                  }
               </style>

               <html>
                  <table width='510' border='0' cellpadding='10' bgcolor='#fff'>
                     <tr>
                           <td>
                              <p>Olá $name</p>
                              <p>Agradecemos sua inscrição no Seminário de Marketing Digital na Indústria (SMDI).</p>
                              <p>O formato de participação que você escolheu é $user_type.</p>
                              <p>O evento acontecerá no dia <b>18 de agosto das 9h às 17h30</b>.</p>
                              <p>Para não perder essa oportunidade de aprendizado, aproveite para adicionar o evento no seu calendário!</p>
                              <a href='https://calndr.link/d/event/?service=apple&start=2022-08-1809:00&end=2022-08-1817:30&title=SMDI%20-%20Semin%C3%A1rio%20de%20Marketing%20Digital%20na%20Ind%C3%BAstria&description=O%20evento%20acontecer%C3%A1%20no%20dia%2018%20de%20agosto%20das%209h%20%C3%A0s%2017h30.%20%20Enquanto%20o%20evento%20n%C3%A3o%20chega,%20aproveite%20para%20acessar%20os%20conte%C3%BAdos%20dos%20anos%20anteriores%20e%20ir%20se%20preparando%20para%20o%20nosso%20encontro%20em%20agosto.%20%20D%C3%BAvidas?%20Entre%20em%20contato%20conosco%20no%20e-mail%20marketing@abimaq.org.br.'>Apple</a>
                              <a href='https://calndr.link/d/event/?service=google&start=2022-08-1809:00&end=2022-08-1817:30&title=SMDI%20-%20Semin%C3%A1rio%20de%20Marketing%20Digital%20na%20Ind%C3%BAstria&description=O%20evento%20acontecer%C3%A1%20no%20dia%2018%20de%20agosto%20das%209h%20%C3%A0s%2017h30.%20%20Enquanto%20o%20evento%20n%C3%A3o%20chega,%20aproveite%20para%20acessar%20os%20conte%C3%BAdos%20dos%20anos%20anteriores%20e%20ir%20se%20preparando%20para%20o%20nosso%20encontro%20em%20agosto.%20%20D%C3%BAvidas?%20Entre%20em%20contato%20conosco%20no%20e-mail%20marketing@abimaq.org.br.'>Google</a>
                              <a href='https://calndr.link/d/event/?service=outlook&start=2022-08-1809:00&end=2022-08-1817:30&title=SMDI%20-%20Semin%C3%A1rio%20de%20Marketing%20Digital%20na%20Ind%C3%BAstria&description=O%20evento%20acontecer%C3%A1%20no%20dia%2018%20de%20agosto%20das%209h%20%C3%A0s%2017h30.%20%20Enquanto%20o%20evento%20n%C3%A3o%20chega,%20aproveite%20para%20acessar%20os%20conte%C3%BAdos%20dos%20anos%20anteriores%20e%20ir%20se%20preparando%20para%20o%20nosso%20encontro%20em%20agosto.%20%20D%C3%BAvidas?%20Entre%20em%20contato%20conosco%20no%20e-mail%20marketing@abimaq.org.br.'>Outlook</a>
                              <p>Enquanto o evento não chega, aproveite para acessar os conteúdos dos anos anteriores e ir se preparando para o nosso encontro em agosto.</p>
                              <p>Dúvidas? Entre em contato conosco no e-mail <a href='mailto:marketing@abimaq.org.br'>marketing@abimaq.org.br</a>.</p>
                              <p>Até breve,</p>
                              <p>ABIMAQ - Associação Brasileira da Indústria de Máquinas e Equipamentos</p>
                           </td>
                     </tr>
                  </table>
               </html>";

            $emailenviar = 'marketing@abimaq.org.br';
            $destino = $email;
            $assunto = 'Confirmação para o SMDI 2022';

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: Eventos ABIMAQ <$email>';

            $enviaremail = mail($destino, $assunto, $arq, $headers);

            if($enviaremail){
               $mgm = '<span style="display: flex;width: 100%;align-items: center;justify-content: center;font-size: 1.2rem;padding: 1.5rem 0;color: #fff;">Confirmação enviada para o e-mail cadastrado</span>';
               echo $mgm;
            }else{
               $mgm = '<span style="display: flex;width: 100%;align-items: center;justify-content: center;font-size: 1.2rem;padding: 1.5rem 0;color: #fff;">Ops... Não conseguimos enviar o e-mail de confirmação</span>';
               echo $mgm;
            }
         }
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