<?php
session_start();

include("conecta.php");
include("functions.php");

$titulo = $_POST["titulo"];
$data = $_POST["data"];
$hora = $_POST["hora"];
$conteudo = $_POST["conteudo"];
$imagem = $_FILES["arquivo"];
$diretorio = "uploads/";
$link = $titulo.$data;
$url = noRepeatHifen($link);

$listaNomeImagem = array();

for($i = 0; $i < count($imagem["name"]); $i++) {
		$nomeImagem = $imagem["name"];
		move_uploaded_file($imagem["tmp_name"][$i], $diretorio."img-artigos".time().$nomeImagem[$i]);
		array_push($listaNomeImagem, "img-artigos".time().$nomeImagem[$i]);
	}

	$nameImages = implode(",", $listaNomeImagem);

function registraArtigo($conexao, $titulo, $data, $hora, $conteudo, $nameImages, $url) {
	
	$query = "insert into artigos (titulo, data, hora, conteudo, imagens, url) values ('{$titulo}', '{$data}', '{$hora}', '{$conteudo}', '{$nameImages}', '{$url}')";

	return mysqli_query($conexao, $query);
}




if(registraArtigo($conexao, $titulo, $data, $hora, $conteudo, $nameImages, $url)) {
	$_SESSION["artigo_cadastrado"] = "Artigo Publicado com sucesso";
	header("location: cadastrar-artigo.php");
	die();
}