<?php 

session_start();

include("conecta.php");

$titulo = $_POST["titulo"];
$data = $_POST["data"];
$hora = $_POST["hora"];
$descricao = $_POST["descricao"];
$imagem = $_FILES["arquivo"];
$diretorio = "uploads/";


for($i = 0; $i < count($_FILES["arquivo"]["name"]); $i++){
	
	move_uploaded_file($_FILES["arquivo"]["tmp_name"][$i], $diretorio.$_FILES["arquivo"]["name"][$i]);
}

$nameImages = implode(",", $_FILES["arquivo"]["name"]);




$query = "insert into eventos (titulo, data, hora, descricao, imagens) values ('{$titulo}', '{$data}', '{$hora}', '{$descricao}', '{$nameImages}')";

if(mysqli_query($conexao, $query)): 
	$_SESSION["evento_cadastrado"] = "Evento Cadastrado com sucesso";
	header("location: cadastrar-evento");
	die();
?>
	
<?php endif; ?>
?>
	

