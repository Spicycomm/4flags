<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	date_default_timezone_set('America/Sao_Paulo');
	ob_start();  
?>
<?php include("conecta.php"); ?>
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
				<h2>Artigos Publicados</h2>
			</div>

			<div class="container-all-events">
				<table class="all-events">
					<tr>
						<th>Alterar</th>
						<th>Remover</th>
						<th>Título</th>
						<th>Data</th>
						<th>Hora</th>
						<th>Conteúdo</th>
						<th>Imagens</th>
					</tr>
					<?php
						function listaArtigos($conexao) {
							$artigos = array();
							$resultado = mysqli_query($conexao, "select * from artigos order by  `id` desc");

							while($artigo = mysqli_fetch_assoc($resultado)){
								array_push($artigos, $artigo);
							}
							return $artigos;
						}

						$artigos = listaArtigos($conexao);


						foreach ($artigos as $artigo):
					?>
						
						<tr>
							<td>
								<a class="btn btn-altera" href="altera-artigo.php?id=<?= $artigo['id']; ?>">
									Alterar
								</a>
							</td>
							<td>
								<form action="remove-artigos.php" method="post">
									<input type="hidden" name="id" value="<?=$artigo['id']; ?>">
									<button class="btn btn-remove">Remover</button>
								</form>
							</td>
							<td><?= $artigo["titulo"]; ?></td>
							<td><?= $artigo["data"]; ?></td>
							<td><?= $artigo["hora"]; ?></td>
							<td><?= $artigo["conteudo"]; ?></td>
							<td class="td-images">
							<?php 
								  $imagens = explode(",", $artigo["imagens"]); 
								  foreach ($imagens as $imagem):
								  ?>
							<img src="<?= 'uploads/'.$imagem?>">
							<?php endforeach; ?>
							</td>
						<?php endforeach; ?>
						</tr>
				</table>
			</div>
		</section>
		<?php if(isset($_SESSION["remove-artigo"])): ?>
		   <p id="evento-removido" class="msg-removido"><?=$_SESSION["remove-artigo"]; ?></p>
		   <?php unset($_SESSION["remove-artigo"]); ?>
	    <?php endif; ?>

				
		<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106736054-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());
 
  gtag('config', 'UA-106736054-1');
</script>
		<script>
		var eventoRemovido = document.querySelector("#evento-removido");

		if(eventoRemovido != null) {
			window.setTimeout(function() {
			eventoRemovido.style.display = "none";
			}, 2000);
		}
		</script>
	</body>
</html>