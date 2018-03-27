<?php
	session_start();
	include("conecta.php");

	$id = $_POST["id"];

	function removeUnidade($conexao, $id) {
		$query = "delete from unidades where id = {$id}";
		return mysqli_query($conexao, $query);
	}

	if(removeUnidade($conexao, $id)) {
		$_SESSION["remove-unidade"] = "Unidade removida com sucesso";
		header("location: lista-unidades.php");
		die();
	}