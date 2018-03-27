<?php
session_start();

include("conecta.php");
include("functions.php")
;
$id = $_POST["id"];
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

function alteraArtigo($conexao, $id, $titulo, $data, $hora, $conteudo, $nameImages, $url) {
	$query = "update  artigos set titulo= '{$titulo}', data = '{$data}', hora = '{$hora}', conteudo = '{$conteudo}', imagens = '{$nameImages}', url = '{$url}' where id = '{$id}'";

	return mysqli_query($conexao, $query);
}



if(alteraArtigo($conexao, $id, $titulo, $data, $hora, $conteudo, $nameImages, $url)) {
	$_SESSION["artigo_alterado"] = "Artigo Alterado com Sucesso";
	header("location: cadastrar-artigo.php");
	die();
}
