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
<html>
<head lang="pt-br">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMDI | Gerar certificado</title>
  <link rel="stylesheet" href="css/certificado.css">
  <?php echo $noIndex; ?>
</head>
<body>
	<div id="container">
		<div class="link-container">
			<button class="btn-generate" onclick="convertHTMLToPDF()">Caso o download não funcione, clique aqui</button><a href="./home">Retornar para a Página Inicial</a>
		</div>
		<div id="html-template">
		<?php require_once __DIR__ . '/Template/html-template.php'; ?>
	</div>
	</div>
</body>
<!-- Includes js PDF JavaScript files into the HTML -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>function convertHTMLToPDF() {
	const { jsPDF } = window.jspdf;

	var doc = new jsPDF('l', 'px', [800, 580]);
	var pdfjs = document.querySelector('#html-template');

	doc.html(pdfjs, {
		callback: function(doc) {
			doc.save("certificado.pdf");
		},
		x: 0,
		y: 0
	})
}
convertHTMLToPDF();
</script>
</html>