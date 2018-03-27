<?php
session_start();

include("conecta.php");

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$data = $_POST["data"];
$hora = $_POST["hora"];
$descricao = $_POST["descricao"];
$diretorio = "uploads/";


for($i = 0; $i < count($_FILES["arquivo"]["name"]); $i++){
	
	move_uploaded_file($_FILES["arquivo"]["tmp_name"][$i], $diretorio.$_FILES["arquivo"]["name"][$i]);
}

$nameImages = implode(",", $_FILES["arquivo"]["name"]);


function alteraEvento($conexao, $id, $titulo, $data, $hora, $descricao, $nameImages) {
	$query = "update eventos set titulo= '{$titulo}', data = '{$data}', hora = '{$hora}', descricao = '{$descricao}', imagens = '{$nameImages}' where id = '{$id}'";

	return mysqli_query($conexao, $query);
}



if(alteraEvento($conexao, $id, $titulo, $data, $hora, $descricao, $nameImages)) {
	$_SESSION["evento_alterado"] = "Evento Alterado com Sucesso";
	header("location: cadastrar-evento");
	die();
}
