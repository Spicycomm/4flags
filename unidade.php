
<?php include("head.php"); ?>
<?php include("header.php"); ?>
	<?php include("pages/sobre.php"); ?>
	<?php include("pages/missao.php"); ?>
	<?php include("pages/visao.php"); ?>
	<?php include("pages/valores.php"); ?>
	<?php include("pages/metodologia.php"); ?>
	<?php include("pages/cursos.php"); ?> 
	<?php include("pages/courses/curso-ingles.php"); ?>
	<?php include("pages/courses/curso-espanhol.php"); ?> 
	<?php include("pages/courses/curso-frances.php"); ?> 
	<?php include("pages/courses/curso-portugues.php"); ?> 
	<?php include("pages/garantia.php"); ?>
	<?php include("conecta.php"); ?>

	<section class="container-units">
		<div class="center">
			<?php
				$nome = $_GET["unidade"];

				function listarUnidade($conexao, $nome) {
					$query = "select * from unidades where nome = '{$nome}'";
					$resultado = mysqli_query($conexao, $query);

					return mysqli_fetch_assoc($resultado);
				}

				$unidade = listarUnidade($conexao, $nome);
			?>
			
			<div class="container-info">
				<div class="destaque-info">
					<div class="title-unit">
						<h2><?=str_replace("-", " ", $unidade["nome"]); ?></h2>
					</div>

					<div class="unit-image-destaque">
						<img src="<?='uploads/unidades/'.$unidade['imagemDestaque']?>" alt="">
					</div>
				</div>

				<div class="aditional-info">
					<p class="unit-address-title">Endereço:</p>
					<p class="unit-address"><?=$unidade["endereco"];?></p>
					<p class="unit-tel-title">Telefone:</p>
					<p class="unit-tel"><?=$unidade["telefone"];?></p>
					<p class="unit-email-title"><strong>Email:</strong></p>
					<p class="unit-email"><?=$unidade["email"];?></p>
				</div>
			</div>
			<div class="gallery-image-units">
				<h3>Galeria</h3>
				<ul>
					<?php 
						$galeria = explode(",", $unidade["fotos"]);

						foreach($galeria as $imagemGaleria):
					?>
					<li>
						<a href="<?='uploads/unidades/'.$imagemGaleria;?>" 
						   data-lightbox="<?=$unidade["nome"];?>">
							<img src="<?='uploads/unidades/'.$imagemGaleria?>"  alt="">
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>
<?php include("footer.php"); ?>
