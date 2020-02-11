<?php
    
  
 
    ini_set("display_errors", 1);
	error_reporting(E_ALL | E_WARNING);
	
	# Rotas 

	# Nome do Projeto
	$project_name = "/sisarqphpv2/";

	# Url do Caminho do servidor na rede
	$project_index = "http://".$_SERVER['SERVER_NAME'].$project_name;
	
	# Url do caminho do servidor na raiz
    $project_path = dirname(__DIR__)."/".$project_name;
    #$_SERVER['DOCUMENT_ROOT'].$project_name;
    

	# ROTAS GLOBAIS
	$GLOBALS['project_index'] = $project_index;
	$GLOBALS['project_path'] = $project_path;
    
    
    $diretorio= dirname(__DIR__);

    include_once $GLOBALS['project_path'].'/dao/arquivoPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/Arquivo.class.php';
    include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';
  

    echo "server NAME=>".$_SERVER['SERVER_NAME']."</BR>";
    echo "DOCUMENT ROOTE=>".$_SERVER['DOCUMENT_ROOT']."</BR>";
    echo "diretorio>".dirname(__DIR__)."</BR>";

    echo "projetoindex=>".$project_index."</BR>";

    echo "projetopath=>".$project_path."</BR>";
    

    