<footer id="unidades" class="site-footer">
		<div class="logo-footer">
			<a href="4flags.com.br"><img src="images/logo-rodape.png"></a>
		</div>
		<div class="unit-footer">
			<h5 class="title-section-rodape">Unidades</h5>
			<?php 
				function listaUnidades($conexao) {
					$unidades = array();
					$resultado = mysqli_query($conexao, "select nome, imagemDestaque from unidades");
					while($unidade = mysqli_fetch_assoc($resultado)) {
						array_push($unidades, $unidade);
					}
					return $unidades;
				}

				$unidades = listaUnidades($conexao);
			?>
			<div class="all-units">
				<ul class="list-units">
					<?php foreach($unidades as $unidade): ?>
					<li class="item-unit">
						<a href="unidade.php?unidade=<?=$unidade['nome']; ?>" data-name="O nome é unidade 1" data-adress="Avenida pompéia">
							<figure>
								<img src="<?= 'uploads/unidades/'.$unidade['imagemDestaque'];?>">
								<figcaption><?= str_replace("-", " ",$unidade["nome"]);?></figcaption>
							</figure>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="center">
		<div class="section-footer about-footer">
			<h5 class="title-section-rodape">Sobre a gente</h5>
			<ul>
				<li class="show-page" data-target="#sobre"><a href="#sobre">Sobre</a></li>
				<li class="show-page" data-target="#missao"><a href="#missao">Missão</a></li>
				<li class="show-page" data-target="#visao"><a href="#visao">Visão</a></li>
				<li class="show-page" data-target="#valores"><a href="#valores">Valores</a></li>
			</ul>
		</div>

		<div class="section-footer methodology-footer">
			<h5 class="title-section-rodape">Metodologia</h5>
			<ul>
				<li class="show-page" data-target="#metodologia"><a href="javascript:void(0);">Conheça nosso<br>método</a></li>
			</ul>
		</div>

		<div class="section-footer courses-footer">
			<h5 class="title-section-rodape">Cursos</h5>
			<ul>
				<li class="show-page" data-target="#curso-de-ingles"><a href="javascript:void(0);">Inglês</a></li>
				<li class="show-page" data-target="#curso-de-espanhol"><a href="javascript:void(0);">Espanhol</a></li>
				<li class="show-page" data-target="#curso-de-frances"><a href="javascript:void(0);">Francês</a></li>
				<li class="show-page" data-target="#curso-de-portugues"><a href="javascript:void(0);">Português</a></li>
			</ul>
		</div>
		
		<div class="section-footer contact-footer">
			<h5 class="title-section-rodape">Contatos</h5>
				<a href="mailto:contato@4flags.com.br">contato@4flags.com.br</a>
				

			<div class="section-unity">
				<div class="unity-item">
					<span class="unidade-name">São Paulo - Unidade Vila Mascote</span>
					<span class="unidade-tel">5671-3030</span>
					<span class="unidade-address">Avenida Mascote, 461 Vila Mascote - SP</span>
				</div>

				<div class="unity-item">
					<span class="unidade-name">Unidade São Bernardo do Campo</span>
					<span class="unidade-tel">4335-0909</span>
					<span class="unidade-address">Rua João Pessoa, 681 - São bernardo do Campo</span>
				</div>

				<div class="unity-item">
					<span class="unidade-name">Unidade São Caetano</span>
					<span class="unidade-tel">4228-4046</span>
					<span class="unidade-address">Avenida Vital Brasil Filho, 266 - São caetano do sul</span>
				</div>
			</div>  
		</div>

		<div class="section-footer job-footer">
			<h5 class="title-section-rodape">Trabalhe conosco</h5>
			<ul>
				<li><a href="mailto:rh@4flags.com.br">rh@4flags.com.br</a></li>
			</ul>
		</div>
		</div>
	</footer>
<div id="fb-root" ></div>
		<script>(function(d, s, id) {
  			var js, fjs = d.getElementsByTagName(s)[0];
  			if (d.getElementById(id)) return;
  			js = d.createElement(s); js.id = id;
  			js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10";
  			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106736054-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());
 
  gtag('config', 'UA-106736054-1');
</script>
	</div>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="slick/slick.min.js"></script>
	<script src="js/lightbox.js"></script>
	<script src="js/main.js"></script>
</body>
</html>