<?php

if(isset($_SESSION['user_name'])){
    
}elseif(isset($_SESSION['admin_name'])){
    
}else{
    header('location:./');
}
?>
<head>
	<style>
		.event-detail {
			font-family: 'Montserrat', sans-serif;
		}
		.event-detail img{
			width: 100%;
			max-width: 800px;
			height: auto;
			overflow: hidden;
		}
		.content {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			margin: 0; padding: 0;
			width: 800px;
			position: absolute;
			top:5rem;
			z-index: 1;
		}

		.content h1 {
			margin-top: 5rem;
		}
		.content h2 {
			margin-bottom: 0;
			margin-top: 3rem;
		}
		.content p {
			padding: 0 5rem;
			text-align: center;
		}
		.ass {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			margin-top: 2rem;
		}
		.ass img {
			width: 8rem;
		}
		.ass hr {
			width: 100%;
			max-width: 18rem;
			height: 1px;
			background-color: #000;
			margin-top: -1rem;
			z-index: -1;
		}
		.ass p {
			margin: 0.5rem;
		}
	</style>
</head>

<div class="event-detail">
    <img src="./images/certificado_SMDI.png">
	<div class="content">
		<h1>Certificado de participação</h1>
		<h2><?php 
		
		if(isset($_SESSION['user_name'])){
			echo $_SESSION['user_name']; 
		}elseif(isset($_SESSION['admin_name'])){
			echo $_SESSION['admin_name'];
		}
		
		?></h2>
		<p>participou no evento Seminário de Marketing Digital na Indústria 2022, com carga horária equivalente a 8 horas.</p>
		<div class="ass">
			<img src="./images/ass.png">
			<hr>
			<p>Lariza Pio<br>Gerente de Marketing da ABIMAQ</p>
		</div>
	</div>
</div>