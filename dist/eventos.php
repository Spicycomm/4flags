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
				<h2>Eventos cadastrados</h2>
			</div>

			<div class="container-all-events">
				<table class="all-events">
					<tr>
						<th>Alterar</th>
						<th>Remover</th>
						<th>Título</th>
						<th>Data</th>
						<th>Hora</th>
						<th>Descrição</th>
						<th>Imagens</th>
					</tr>
					<?php
						function listaEventos($conexao) {
							$eventos = array();
							$resultado = mysqli_query($conexao, "select * from eventos order by  `id` desc");

							while($evento = mysqli_fetch_assoc($resultado)){
								array_push($eventos, $evento);
							}
							return $eventos;
						}

						$eventos = listaEventos($conexao);


						foreach ($eventos as $evento):
					?>
						
						<tr>
							<td>
								<a class="btn btn-altera" href="altera-evento.php?id=<?= $evento['id']; ?>">
									Alterar
								</a>
							</td>
							<td>
								<form action="remove-eventos.php" method="post">
									<input type="hidden" name="id" value="<?=$evento['id']; ?>">
									<button class="btn btn-remove">Remover</button>
								</form>
							</td>
							<td><?= $evento["titulo"]; ?></td>
							<td><?= $evento["data"]; ?></td>
							<td><?= $evento["hora"]; ?></td>
							<td><?= $evento["descricao"]; ?></td>
							<td class="td-images">
							<?php 
								  $imagens = explode(",", $evento["imagens"]); 
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
		<?php if(isset($_SESSION["remove-evento"])): ?>
		   <p id="evento-removido" class="msg-removido"><?=$_SESSION["remove-evento"]; ?></p>
		   <?php unset($_SESSION["remove-evento"]); ?>
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