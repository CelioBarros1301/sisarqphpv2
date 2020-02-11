<?php  

	# Incluindo os arquivos necessários
	include_once 'model/config.php';
	include_once 'controller/validate.php';


	# inicia a sessao
	session_start();
	if(!isset($_SESSION['user'])){
		header("location:  $project_index/?error=access_denied");
	}
	
	# Recuperando os dados da sessão
	$user = $_SESSION['user'];
    

	# Criando a função de gerenciamento
	transacao();
	function page_content(){
		validate_options();
	}

	# Incluindo o arquivo de layout
	include_once 'view/template2.html';

?>