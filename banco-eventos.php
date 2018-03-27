<?php 

session_start();

include("conecta.php");

$titulo = $_POST["titulo"];
$data = $_POST["data"];
$hora = $_POST["hora"];
$descricao = $_POST["descricao"];
$imagem = $_FILES["arquivo"];
$diretorio = "uploads/";

$descricao = mysqli_real_escape_string($conexao, $descricao);
$titulo = mysqli_real_escape_string($conexao, $titulo);

$listaNomeImagem = array();

for($i = 0; $i < count($imagem["name"]); $i++) {
		$nomeImagem = $imagem["name"];
		move_uploaded_file($imagem["tmp_name"][$i], $diretorio."img-eventos".time().$nomeImagem[$i]);
		array_push($listaNomeImagem, "img-eventos".time().$nomeImagem[$i]);
	}

	$nameImages = implode(",", $listaNomeImagem);



$query = "insert into eventos (titulo, data, hora, descricao, imagens) values ('{$titulo}', '{$data}', '{$hora}', '{$descricao}', '{$nameImages}')";


if(mysqli_query($conexao, $query)){
	$_SESSION["evento_cadastrado"] = "Evento Cadastrado com sucesso";
	header("location: cadastrar-evento");
	die();
} else {
	echo mysqli_error($conexao);
}
	

