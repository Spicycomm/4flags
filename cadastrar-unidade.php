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
				<h2>Adicionar unidade</h2>
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
				<form action="banco-unidades.php" method="post" enctype="multipart/form-data">
					<label for="nome">Nome</label>
					<input id="nome" type="text" name="nome" class="name-unit" required>

					<label for="endereco">Endereço</label>
					<input id="endereco" type="text" name="endereco" class="address-unit" required>

					<label for="telefone">Telefone</label>
					<input id="telefone" type="tel" name="telefone" class="tel-unit" required>
					
					<label for="email">Email</label>
					<input id="email" type="email" name="email" class="email-unit" required>

					<label>Imagem de Destaque</label>
					
					<input type="file" name="imagem-destaque" required>

					<label>Galeria de imagens</label>
					<input type="file" multiple  name="arquivo[]" required>
					
					<?php if(isset($_SESSION["unidade_cadastrada"])): ?>
						<p class="evento-cadastrado"><?=$_SESSION["unidade_cadastrada"]; ?></p>
						<?php unset($_SESSION["unidade_cadastrada"]); ?>
					<?php endif; ?>
					
					<?php if(isset($_SESSION["unidade_alterada"])): ?>
						<p class="evento-cadastrado"><?=$_SESSION["unidade_alterada"]; ?></p>
					<?php unset($_SESSION["unidade_alterada"]); ?>
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
		var eventoCadastrado = document.querySelector(".evento-cadastrado");

		if(eventoCadastrado != null) {
			window.setTimeout(function() {
			eventoCadastrado.style.display = "none";
			}, 2000);
		}
		
		</script>
	</body>
</html>