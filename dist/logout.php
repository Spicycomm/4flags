<?php 
	 
	error_reporting(E_ALL ^ E_NOTICE);
	date_default_timezone_set('America/Sao_Paulo');
	ob_start();  

	  function logout() {
		unset($_SESSION["usuario_logado"]);
		session_destroy();
		session_start();
	};
	  logout();
	  $_SESSION["deslogado"]= "Usuário deslogado com sucesso";
	  header("location: admin");