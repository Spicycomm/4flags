<?php
session_start();

include("conecta.php");

$id = $_POST["id"];

function removeArtigo($conexao, $id){
	$query = "delete from artigos where id = '{$id}'";

	return mysqli_query($conexao, $query);
}

if(removeArtigo($conexao, $id)) {
	$_SESSION["remove-artigo"] = "Artigo removido com sucesso";
	header("location: artigos.php");
}