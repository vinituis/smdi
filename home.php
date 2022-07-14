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
        <p>Dia 18 de agosto de 2022, quinta-feira<br>Das 9h às 18h<br>
            <?php 
                if($_SESSION['type'] == 'pre'){
                    echo 'Endereço: Av. Jabaquara, 2925 - São Paulo/SP';
                }
            ?>
        </p>
    </div>
</section>

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

<section id="prog" class="prog">
    <div class="box-container">
        <h3>Programação</h3>
        <table width="100%" class="table">
            <tr>
                <td class="destaque">Horário</td>
                <td class="destaque">Palestra</td>
                <td class="destaque" colspan="6">Professor</td>
            </tr>
            <tr>
                <td class="destaque">09h00</td>
                <td>Recepção e Credenciamento</td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td class="destaque">09h30</td>
                <td>Comunicação Estratégica pelo WhatsApp</td>
                <td colspan="6">JP do WhatsApp</td>
            </tr>
            <tr>
                <td class="destaque">10h30</td>
                <td>Como criar conteúdo relevante e atrativo para as redes sociais</td>
                <td colspan="6">Priscila Santos</td>
            </tr>
            <tr>
                <td class="destaque">11h15</td>
                <td>Planejamento: Do Zero à Ação</td>
                <td colspan="6"><a href="professor?id=21">Cris Marroig</a></td>
            </tr>
            <tr>
                <td class="destaque">12h30</td>
                <td>Pausa - Comes e bebes</td>
                <td colspan="6"></td>    
            </tr>
            <tr>
                <td class="destaque">13h00</td>
                <td>Marketing de Comunidade</td>
                <td colspan="6">À definir</td>
            </tr>
            <tr>
                <td class="destaque">13h30</td>
                <td>Dicas de SEO para o seu negócio, com foco em Copywriting</td>
                <td colspan="6">Ludy Amano</td>
            </tr>
            <tr>
                <td class="destaque">15h00</td>
                <td>Analytics e como identificar pontos de converção no seu site</td>
                <td colspan="6"><a href="professor?id=15">Eleonora diniz</a></td>
            </tr>
            <tr>
                <td class="destaque" rowspan="2">16h30</td>
                <td rowspan="2">Podcast Ao Vivo</td>
                <td class="destaque center"><b>Moderador:</b></td>
                <td class="destaque center" colspan="3"><b>Convidados:</b></td>
                
            </tr>
            <tr>
                <td class="center">Lucas Lima</td>
                <td class="center">Birmind</td>
                <td class="center">John Deere</td>
                <td class="center">Staubli</td>    
            </tr>
        </table>
    </div>

</section>

<section>
    <div class="partners" id="partners">
        <h3>Patrocinador</h3>
        <div class="patrocinador">
            <a href="https://www.hydac.com/pt-br/"><img src="./images/partner/hydac.jpg" alt="Logo Hydac"></a>
        </div>
        <h3>Apoio</h3>
        <div class="apoio">
            <img src="./images/partner/actuel.jpg" alt="Logo Actuel">
            <img src="./images/partner/liberprint.jpg" alt="Logo Liberprint">
            <img src="./images/partner/interbusiness.jpg" alt="Logo Interbusiness">
        </div>
    </div>
</section>

</body>
</html>