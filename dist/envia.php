<?php
	header('Content-Type: text/html; charset=UTF-8');
	header('Content-Type: text/plain; charset=UTF-8');
	
	function pegaValor($valor) {
		return isset($_POST[$valor]) ? $_POST[$valor] :'';
	}

	$nome = pegaValor("nome");
	$telefone = pegaValor("telefone");
	$email = pegaValor("email");
	$mensagem = pegaValor("mensagem");
	
	
	
	
	$quebra_linha = "\n\n";

	$emailSender = "contato@4flags.com.br";
	$nomeRemetente = "4flags";
	$emailDestinatario = "contato@4flags.com.br, ever-tonlima@hotmail.com";
	$assunto = "Contato enviado pelo site 4flags.com.br";
	$msg= $quebra_linha;
	$msg .= "Nome: ".$nome.$quebra_linha;
	$msg .= "Email: ".$email.$quebra_linha;
	$msg .= "Telefone: ".$telefone.$quebra_linha;
	$msg .= "Assunto: ".$mensagem.$quebra_linha;
	
	
	$headers= "MIME-Version: 1.1".$quebra_linha;
	
	

	if(mail($emailDestinatario, $assunto, $msg, $headers, "-r".$emailSender)) {
		header("location: http://www.4flags.com.br/teste");
	} else {
		echo "Não foi possível enviar o email";
	}
?>
