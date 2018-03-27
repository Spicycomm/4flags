<?php
session_start();

include("conecta.php");

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$data = $_POST["data"];
$hora = $_POST["hora"];
$conteudo = $_POST["conteudo"];
$diretorio = "uploads/";


for($i = 0; $i < count($_FILES["arquivo"]["name"]); $i++){
	
	move_uploaded_file($_FILES["arquivo"]["tmp_name"][$i], $diretorio.$_FILES["arquivo"]["name"][$i]);
}

$nameImages = implode(",", $_FILES["arquivo"]["name"]);


function alteraArtigo($conexao, $id, $titulo, $data, $hora, $descricao, $nameImages) {
	$query = "update  artigos set titulo= '{$titulo}', data = '{$data}', hora = '{$hora}', conteudo = '{$conteudo}', imagens = '{$nameImages}' where id = '{$id}'";

	return mysqli_query($conexao, $query);
}



if(alteraArtigo($conexao, $id, $titulo, $data, $hora, $conteudo, $nameImages)) {
	$_SESSION["artigo_alterado"] = "Artigo Alterado com Sucesso";
	header("location: cadastrar-artigo.php");
	die();
}
