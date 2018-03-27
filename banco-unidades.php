<?php
session_start();

include("conecta.php");

$nome = $_POST["nome"];
$endereco = $_POST["endereco"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];
$imagemDestaque = $_FILES["imagem-destaque"];
$galeria = $_FILES["arquivo"];
$diretorio = "uploads/unidades/";

// Transformando o nome em slug
$slugNome = str_replace(" ", "-", $nome);

// Imagem de destaque

$nomeImagemDestaque =  "img-destaque".time().$imagemDestaque["name"];

move_uploaded_file($imagemDestaque["tmp_name"], $diretorio.$nomeImagemDestaque);


// Galeria de imagens
$galeriaDeImagens = array();

for($i = 0; $i < count($galeria["name"]); $i++) {
		$nomeImagemGaleria = $galeria["name"];
		move_uploaded_file($galeria["tmp_name"][$i], $diretorio.time().$nomeImagemGaleria[$i]);
		array_push($galeriaDeImagens, time().$nomeImagemGaleria[$i]);
	}

	$nomeGaleria = implode(",", $galeriaDeImagens);

	

function registraUnidade($conexao, $slugNome, $endereco, $telefone, $email, $nomeImagemDestaque, $nomeGaleria) {
	
	$query = "insert into unidades (nome, endereco, telefone, email, imagemDestaque, fotos) values ('{$slugNome}', '{$endereco}', '{$telefone}', '{$email}' , '{$nomeImagemDestaque}', '{$nomeGaleria}')";

	return mysqli_query($conexao, $query);
}




if(registraUnidade($conexao, $slugNome, $endereco, $telefone, $email, $nomeImagemDestaque, $nomeGaleria)) {
	$_SESSION["unidade_cadastrada"] = "Unidade cadastrada com sucesso";
	header("location: cadastrar-unidade.php");
	die();
} else {
	echo "Não foi possível inserir as imagens";
}


?>
	

