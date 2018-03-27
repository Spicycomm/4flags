<?php
session_start();

include("conecta.php");

$titulo = $_POST["titulo"];
$data = $_POST["data"];
$hora = $_POST["hora"];
$conteudo = $_POST["conteudo"];
$imagem = $_FILES["arquivo"];
$diretorio = "uploads/";

for($i = 0; $i < count($_FILES["arquivo"]["name"]); $i++) {
		move_uploaded_file($_FILES["arquivo"]["tmp_name"][$i], $diretorio.$_FILES["arquivo"]["name"][$i]);
	}

	$nameImages = implode(",", $_FILES["arquivo"]["name"]);

function registraArtigo($conexao, $titulo, $data, $hora, $conteudo, $nameImages) {
	
	$query = "insert into artigos (titulo, data, hora, conteudo, imagens) values ('{$titulo}', '{$data}', '{$hora}', '{$conteudo}', '{$nameImages}')";

	return mysqli_query($conexao, $query);
}




if(registraArtigo($conexao, $titulo, $data, $hora, $conteudo, $nameImages)) {
	$_SESSION["artigo_cadastrado"] = "Artigo Publicado com sucesso";
	header("location: cadastrar-artigo.php");
	die();
}


?>
	

