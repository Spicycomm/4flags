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
		

		<section class="container-register-event panel-admin">
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

			<h2>Painel de administração 4Flags</h2>

			<div class="admin-items">
				<a href="eventos.php" target="_blank">
				<div class="admin-item item-all-events">
					<h3>Ver eventos cadastrados</h3>
				</div>
				</a>

				<a href="cadastrar-evento.php" target="_blank">
				<div class="admin-item item-register-event">
					<h3>Cadastrar Evento</h3>
				</div>
				</a>
				
				<a href="artigos.php" target="_blank">
				<div class="admin-item item-all-articles">
					<h3>Ver artigos publicados</h3>
				</div>
				</a>
				
				<a href="cadastrar-artigo.php" target="_blank">
				<div class="admin-item item-register-article">
					<h3>Publicar artigo</h3>
				</div>
				</a>
				
				<a href="lista-unidades.php" target="_blank">
				<div class="admin-item item-all-units">
					<h3>Ver unidades cadastradas</h3>
				</div>
				</a>

				<a href="cadastrar-unidade.php" target="_blank">
				<div class="admin-item item-register-unit">
					<h3>Cadastrar unidades</h3>
				</div>
				</a>

				<a href="http://www.4flags.com.br" target="_blank">
				<div class="admin-item go-website">
					<h3>Visitar site</h3>
				</div>
				</a>

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