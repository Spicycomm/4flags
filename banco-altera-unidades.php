<?php
session_start();

include("conecta.php");

$nome = $_POST["nome"];
$endereco = $_POST["endereco"]; 
$telefone = $_POST["telefone"];
$email = $_POST["email"];
$imagemDestaque = $_FILES["imagem-destaque"];
$galeria = $_FILES["arquivo"];
$id = $_POST["id"];
$diretorio = "uploads/unidades/";

// Transformando o nome em slug
$slugNome = str_replace(" ", "-", $nome);

// Imagem de destaque

$nomeImagemDestaque = "img-destaque".time().$imagemDestaque["name"];
move_uploaded_file($imagemDestaque["tmp_name"], $diretorio.$nomeImagemDestaque);


// Galeria de Imagens
$galeriaDeImagens = array();

for($i = 0; $i < count($galeria["name"]); $i++) {
	$nomeImagemGaleria = $galeria["name"];
	move_uploaded_file($galeria["tmp_name"][$i], $diretorio.time().$nomeImagemGaleria[$i]);
	array_push($galeriaDeImagens, time().$nomeImagemGaleria[$i]);
}

$nomeGaleria = implode(",", $galeriaDeImagens);

function alteraUnidade($conexao, $slugNome, $endereco, $telefone, $email, $nomeImagemDestaque, $nomeGaleria, $id) {
	$query = "update unidades set nome = '{$slugNome}', endereco = '{$endereco}', telefone= '{$telefone}', email = '{$email}', imagemDestaque = '{$nomeImagemDestaque}', fotos = '{$nomeGaleria}' where id= '{$id}'";

	return mysqli_query($conexao, $query);
}

$msg = mysqli_error($conexao);


if(alteraUnidade($conexao, $slugNome, $endereco, $telefone, $email, $nomeImagemDestaque, $nomeGaleria, $id)) {
	$_SESSION["unidade_alterada"] = "Unidade alterada com sucesso";
	header("location: cadastrar-unidade.php");
	die();
} else {
	echo "Não foi possível alterar a unidade";
	echo $msg;
}

