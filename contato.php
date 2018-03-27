<?php 
	require_once("conecta.php");
	require_once("head.php");
	require_once("header.php");
?>

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

<div class="contact-container">
	<div class="center">
		<div class="contact-bg">
			<img src="images/contato-garota.png" alt="">
		</div>

		<div class="contact-form">
			<div class="contact-title">
				<h2>Entre em contato<br>
				    conosco. Sua mensagem<br>
				    é muito importante<br>
				    para nós!
				</h2>
			</div>

			<div class="contact-form-item">
				<form action="envia-contato.php" method="post">
					<select name="unidades" placeholder="Unidades" required>
						<option value="">Unidades</option>
						<option value="contato@4flags.com.br">Vila mascote</option>
						<option value="saobernardo@4flags.com.br">São Bernardo do Campo</option>
						<option value="saocaetano@4flags.com.br">São Caetano</option>
					</select>

					<input type="text" name="nome" placeholder="Nome">
					<input type="email" name="email" placeholder="email">
					<input type="tel" name="telefone" placeholder="Telefone">

					<textarea placeholder="Digite sua mensagem" name="mensagem"></textarea>

					<input type="submit" value="Enviar">
				</form>
			</div>
		</div>
	</div>
</div>
<?php require_once("footer.php"); ?>