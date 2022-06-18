<?php

if(isset($_SESSION['user_name'])){
    
}elseif(isset($_SESSION['admin_name'])){
    
}else{
    header('location:./');
}
?>

<div class="event-detail">
    <img src="http://localhost/smdi/images/certificado_SMDI.png">
	<div class="content">
		<h1>Certificado de participação</h1>
		<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga quia sint voluptatem quam quae ab error suscipit assumenda doloribus impedit.</p>
		<h2><?php echo $_SESSION['user_name']; ?></h2>
		<div class="ass">
			<p>Assinatura 1</p>
			<p>Assinatura 2</p>
		</div>
	</div>
</div>