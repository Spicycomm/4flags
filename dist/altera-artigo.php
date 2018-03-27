<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	date_default_timezone_set('America/Sao_Paulo');
	ob_start();  
?>

<html>
	<head>
		<meta charset="UTF-8">
		<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
		<link rel="stylesheet" href="css/admin.css">
	</head>
	<body>
		<?php session_start(); ?>
		

		<section class="container-register-event">
			<?php 
				if(isset($_SESSION["usuario_logado"])):
			?>
		 <div class="container-logado">
			<p class="usuario-logado">Usuário logado como <em><?= $_SESSION["usuario_logado"]; ?></em></p>
			<a href="logout.php">Sair</a>
		</div>
		
		<?php else: ?>
			<?php header("location: index.php"); ?>
		<?php endif; ?>
		
			<div class="section-title">
				<h2>Alterar Artigo</h2>
			</div>
			
			<?php include("conecta.php"); ?>

			<?php 

			$id = $_GET["id"];

			function buscaEventos($conexao, $id) {
				$query= "select * from artigos where id= {$id}"; 
				$resultado= mysqli_query($conexao, $query);
				return mysqli_fetch_assoc($resultado);
			}

			$evento = buscaEventos($conexao, $id);
			
			
			?>
			<div class="container-form-events">
				<div class="container-other-info">
					<div class="container-see-all-events">
						<a href="eventos.php">Ver todos os eventos cadastrados</a>
					</div>
					<div class="container-see-all-events">
						<a href="http://www.4flags.com.br">Visitar site</a>
					</div>
				</div>
			<div class="container-form-register-event">
				<form action="banco-altera-artigos.php" method="post" enctype="multipart/form-data">
					<input type="hidden" value="<?=$evento['id']; ?>" name="id">
					<label for="titulo">Título:</label>
					<input id="titulo" type="text" name="titulo" class="title-event" value="<?=$evento['titulo']; ?>" required>

					<label for="data">Data:</label>
					<input id="data" type="text" name="data" class="data-event" value="<?=$evento['data']; ?>" placeholder="dd/mm/yyyy" pattern="^\d{2}\/\d{2}\/\d{4}$" required>

					<label for="hour">Hora:</label>
					<input id="hour" type="time" name="hora" class="hour-event" value="<?=$evento['hora']; ?>" placeholder="24h" required>
					
					<label for="description-event">Descrição do Evento:</label>
					<textarea class="description-event" name="conteudo" required><?=$evento['conteudo']; ?></textarea>
					
					<div class="alter-photos">
						<?php
							$imagens = explode(",", $evento['imagens']);

							foreach($imagens as $imagem):
						?>
						<img src="<?= 'uploads/'.$imagem?>">
					<?php endforeach; ?>
					</div>
					<input type="file" multiple  name="arquivo[]" required>

					<input type="submit" class="submit-event" value="Alterar">

				</form>
			</div>
			</div>
		</section>
		<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106736054-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());
 
  gtag('config', 'UA-106736054-1');
</script>
		<script>
		var eventoCadastrado = document.querySelector(".evento-cadastrado"),
			inputDate = document.querySelector("#data");

		// Formata o campo date

		inputDate.addEventListener("input", function(evt) {
  			this.value = this.value.replace(/\D/, "");
  			this.value = this.value.replace(/(\d{2})(\d{2})(\d{4})/, "$1/$2/$3");
  			this.value = this.value.substring(0, 10);
		});

		if(eventoCadastrado != null) {
			window.setTimeout(function() {
			eventoCadastrado.style.display = "none";
			}, 2000);
		}
		
		</script>
	</body>
</html>