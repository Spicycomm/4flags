<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
	<link rel="stylesheet" href="css/lightbox.css">
	<link rel="stylesheet" href="css/style.css">
	<title></title>
</head>
<body>
	<?php require_once("conecta.php"); ?>
	<?php require_once("header.php"); ?>

	<?php
		$url = $_GET["dica"];

		function buscaDica($conexao, $url) {
			$query = "select * from artigos where url = '{$url}'";
			$result = mysqli_query($conexao, $query);

			return mysqli_fetch_assoc($result);
		}

		$dica = buscaDica($conexao, $url);

		$imagens = explode(",", $dica["imagens"]);
	?>

	<section class="container-units">
		<div class="center">
			<article class="tip-container">
				<h2 class="tip-title"><?= $dica["titulo"]; ?></h2>
				
				<div class="tip-content">
					<div class="tip-content-text">
						<p><?= $dica["conteudo"]; ?></p>
					</div>

					<div class="tip-image">
						<?php 
						foreach($imagens as $imagem):
						?>
						<img src="<?= 'uploads/'.$imagem?>">
					<?php endforeach; ?>
					</div>
				</div>
			</article>
		</div>
	</section>
	<?php require_once("footer.php"); ?>