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
				<h2>Unidades Adicionadas</h2>
			</div>

			<div class="container-all-events">
				<table class="all-events">
					<tr>
						<th>Alterar</th>
						<th>Remover</th>
						<th>Nome</th>
						<th>Endereço</th>
						<th>Telefone</th>
						<th>Email</th>
						<th>Imagem Destaque</th>
						<th>Galeria</th>
					</tr>
					<?php
						function listaUnidades($conexao) {
							$unidades = array();
							$resultado = mysqli_query($conexao, "select * from unidades order by  `id` desc");

							while($unidade = mysqli_fetch_assoc($resultado)){
								array_push($unidades, $unidade);
							}
							return $unidades;
						}

						$unidades = listaUnidades($conexao);


						foreach ($unidades as $unidade):
					?>
						
						<tr>
							<td>
								<a class="btn btn-altera" href="altera-unidade.php?id=<?= $unidade['id']; ?>">
									Alterar
								</a>
							</td>
							<td>
								<form action="remove-unidade.php" method="post">
									<input type="hidden" name="id" value="<?=$unidade['id']; ?>">
									<button class="btn btn-remove">Remover</button>
								</form>
							</td>
							<td><?= str_replace("-", " ", $unidade["nome"]); ?></td>
							<td><?= $unidade["endereco"]; ?></td>
							<td><?= $unidade["telefone"]; ?></td>
							<td><?= $unidade["email"]; ?></td>
							<td><img src="<?='uploads/unidades/'.$unidade["imagemDestaque"]; ?>"></td>
							<td class="td-images">
							<?php 
								  $imagens = explode(",", $unidade["fotos"]); 
								  foreach ($imagens as $imagem):
								  ?>
							<img src="<?= 'uploads/unidades/'.$imagem?>">
							<?php endforeach; ?>
							</td>
						<?php endforeach; ?>
						</tr>
				</table>
			</div>
		</section>
		<?php if(isset($_SESSION["remove-unidade"])): ?>
		   <p id="evento-removido" class="msg-removido"><?=$_SESSION["remove-unidade"]; ?></p>
		   <?php unset($_SESSION["remove-unidade"]); ?>
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