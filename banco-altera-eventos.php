<?php
session_start();

include("conecta.php");

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$data = $_POST["data"];
$hora = $_POST["hora"];
$descricao = $_POST["descricao"];
$imagem = $_FILES["arquivo"];
$diretorio = "uploads/";

$titulo = mysqli_real_escape_string($conexao, $titulo);
$descricao = mysqli_real_escape_string($conexao, $descricao);

$listaNomeImagem = array();

for($i = 0; $i < count($imagem["name"]); $i++) {
		$nomeImagem = $imagem["name"];
		move_uploaded_file($imagem["tmp_name"][$i], $diretorio."img-eventos".time().$nomeImagem[$i]);
		array_push($listaNomeImagem, "img-eventos".time().$nomeImagem[$i]);
	}

	$nameImages = implode(",", $listaNomeImagem);


function alteraEvento($conexao, $id, $titulo, $data, $hora, $descricao, $nameImages) {
	$query = "update eventos set titulo= '{$titulo}', data = '{$data}', hora = '{$hora}', descricao = '{$descricao}', imagens = '{$nameImages}' where id = '{$id}'";

	return mysqli_query($conexao, $query);
}



if(alteraEvento($conexao, $id, $titulo, $data, $hora, $descricao, $nameImages)) {
	$_SESSION["evento_alterado"] = "Evento Alterado com Sucesso";
	header("location: cadastrar-evento");
	die();
}
