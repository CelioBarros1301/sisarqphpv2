<?php  

	# Exibicão de erros
	ini_set("display_errors", 1);
	error_reporting(E_ALL | E_WARNING);
	
	# Rotas 

	# Nome do Projeto
	$project_name = "/sisarqphpv2/";

	# Url do Caminho do servidor na rede
	$project_index = "http://".$_SERVER['SERVER_NAME'].$project_name;
	
	# Url do caminho do servidor na raiz
	$project_path = $_SERVER['DOCUMENT_ROOT'].$project_name;

	# ROTAS GLOBAIS
	$GLOBALS['project_index'] = $project_index;
	$GLOBALS['project_path'] = $project_path;




?>