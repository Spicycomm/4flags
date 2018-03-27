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
		
		<section class="admin-container">
			<div class="form-admin-container">
				<a href="http://www.4flags.com.br"><img src="images/logo-rodape.png"></a>
				<?php if(isset($_SESSION["falha_ao_logar"])): ?>
					<p class="usuario-invalido"><?= $_SESSION["falha_ao_logar"]; ?></p>
					<?php
						unset($_SESSION["falha_ao_logar"]);
					?>
				<?php endif; ?>

				<?php if(isset($_SESSION["deslogado"])): ?>
					<p class="deslogado">Usuário deslogado</p>
				<?php
					unset($_SESSION["deslogado"]);
					unset($_SESSION["usuario_logado"]);
					endif;
				?>
				<?php
					if(isset($_SESSION["usuario_logado"])):
				?>
				<p class="usuario-ja-logado">Usuário já está logado</p>

				<?php else: ?>
				<form action="login.php" method="post">
					<input type="email" name="email" id="email" class="admin-email" required>
					<label for="email">Email:</label>

					<input type="password" name="senha" id="senha" class="admin-senha" required>
					<label for="senha">Senha:</label>

					<input type="submit" value="Entrar" class="btn btn-admin">
				</form>
				<?php endif; ?>
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
		
		var input = document.querySelectorAll("input"),
			textos = document.querySelectorAll("label");

		input.forEach(box => {
			box.addEventListener("focus", function() {
				this.nextElementSibling.style.top = "-90px";
		  	});

			box.addEventListener("blur", function() {
				if(!this.value) {
					this.nextElementSibling.style.top = "-55px";
					console.log(this.value.length)
				}
		  })
		})
		
		</script>
	</body>
</html>