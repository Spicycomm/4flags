<?php
session_start();

include("conecta.php");

$id = $_POST["id"];

function removeEvento($conexao, $id){
	$query = "delete from eventos where id = '{$id}'";

	return mysqli_query($conexao, $query);
}

if(removeEvento($conexao, $id)) {
	$_SESSION["remove-evento"] = "Evento removido com sucesso";
	header("location: eventos.php");
}