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
				<h2>Publicar Artigo</h2>
			</div>
			
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
				<form action="banco-artigos.php" method="post" enctype="multipart/form-data">
					<label for="titulo">Título:</label>
					<input id="titulo" type="text" name="titulo" class="title-event" required>

					<label for="data">Data:</label>
					<input id="data" type="text" name="data" class="data-event" placeholder="dd/mm/yyyy" pattern="^\d{2}\/\d{2}\/\d{4}$" required>

					<label for="hour">Hora:</label>
					<input id="hour" type="time" name="hora" class="hour-event" placeholder="24h" required>
					
					<label for="description-event">Descrição do Evento:</label>
					<textarea class="description-event" name="conteudo" required></textarea>
					
					<input type="file" multiple  name="arquivo[]" required>
					
					<?php if(isset($_SESSION["artigo_cadastrado"])): ?>
						<p class="evento-cadastrado"><?=$_SESSION["artigo_cadastrado"]; ?></p>
						<?php unset($_SESSION["artigo_cadastrado"]); ?>
					<?php endif; ?>
					
					<?php if(isset($_SESSION["artigo_alterado"])): ?>
						<p class="evento-cadastrado"><?=$_SESSION["artigo_alterado"]; ?></p>
					<?php unset($_SESSION["artigo_alterado"]); ?>
				<?php endif; ?>
					<input type="submit" class="submit-event" value="Cadastrar">
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