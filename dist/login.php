<?php 
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Sao_Paulo'); 
ob_start(); 
session_start();

include("conecta.php"); 
require_once("banco-usuario.php");

$usuario = buscaUsuario($conexao, $_POST["email"], $_POST["senha"]);

if($usuario == null) {
	$_SESSION["falha_ao_logar"] = "Usuário ou senha inválidos";
	header("location: admin");
	die();
} else {
	$_SESSION["usuario_logado"] = $_POST["email"];
	header("location: painel-admin.php");
}

die();

