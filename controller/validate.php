<?php  
	
	
	
function validate_options(){


	$_SESSION['transacao']="";
	if( !isset($_GET['option']) && !isset($_POST['option']) ){
		return false;
	}

	# Incluindo as classes necessárias
	include_once dirname(__DIR__).'/model/config.php';


	if (isset($_GET['option']))
	{
		$option=$_GET['option'];
	}
	if (isset($_POST['option']))
	{
		$option=$_POST['option'];
	}

	# Selecao da Opcao do Menu do Sistema
	switch($option)
	{

		case "painel":				
			include_once $GLOBALS['project_path'].'/view/painel.html';
		break;

	
		# Empresa
		case 'empresa':	
			include_once $GLOBALS['project_path'].'/view/empresa.html';			
		break;

		case 'cadempresa':
			include_once $GLOBALS['project_path'].'/view/forms/formempresa.html';
		break;

		# Autorizado
		case 'autorizado':	
			include_once $GLOBALS['project_path'].'/view/autorizado.html';			
		break;

		case 'cadautorizado':
			include_once $GLOBALS['project_path'].'/view/forms/formautorizado.html';
		break;


		# Acesso ao sistema
		case 'acesso':	
			include_once $GLOBALS['project_path'].'/view/acessomenu.html';			
		break;
		case 'cadacesso':	
			include_once $GLOBALS['project_path'].'/view/forms/formacesso.html';			
		break;



		# Setor Autorizado
		case 'setorautorizado':	
			include_once $GLOBALS['project_path'].'/view/setorautorizado.html';			
		break;

		case 'cadsetorautorizado':
			include_once $GLOBALS['project_path'].'/view/forms/formsetorautorizado.html';
		break;

		# usuario
		case 'usuario':	
			include_once $GLOBALS['project_path'].'/view/usuario.html';			
		break;

		case 'cadusuario':
			include_once $GLOBALS['project_path'].'/view/forms/formusuario.html';
		break;

		case 'liberausuario':
			include_once $GLOBALS['project_path'].'/view/liberausuario.html';
		break;

		#SQL
		case 'comandosql':
			include_once $GLOBALS['project_path'].'/view/comandosql.html';
		break;



		# arquivo
		case 'arquivo':	
			include_once $GLOBALS['project_path'].'/view/arquivo.html';			
		break;

		case 'cadarquivo':
			include_once $GLOBALS['project_path'].'/view/forms/formarquivo.html';
		break;

		# corredor
		case 'corredor':	
			include_once $GLOBALS['project_path'].'/view/corredor.html';			
		break;

		case 'cadcorredor':
			include_once $GLOBALS['project_path'].'/view/forms/formcorredor.html';
		break;

		# estante
		case 'estante':	
			include_once $GLOBALS['project_path'].'/view/estante.html';			
		break;

		case 'cadestante':
			include_once $GLOBALS['project_path'].'/view/forms/formestante.html';
		break;


		# prateleira
		case 'prateleira':	
			include_once $GLOBALS['project_path'].'/view/prateleira.html';			
		break;

		case 'cadprateleira':
			include_once $GLOBALS['project_path'].'/view/formsformprateleira.html';
		break;

		# caixa
		case 'caixa':	
			include_once $GLOBALS['project_path'].'/view/caixa.html';			
		break;

		case 'cadcaixa':
			include_once $GLOBALS['project_path'].'/view/forms/formcaixa.html';
		break;



		# setor
		case 'setor':	
			include_once $GLOBALS['project_path'].'/view/setor.html';			
		break;

		case 'cadsetor':
			include_once $GLOBALS['project_path'].'/view/forms/formsetor.html';
		break;


		# tipodocumento
		case 'tipodocumento':	
			include_once $GLOBALS['project_path'].'/view/tipodocumento.html';			
		break;

		case 'cadtipodoc':
			include_once $GLOBALS['project_path'].'/view/forms/formtipodocumento.html';
		break;

		# documento
		case 'documento':	
			include_once $GLOBALS['project_path'].'/view/documento.html';			
		break;

		case 'caddocumento':
			include_once $GLOBALS['project_path'].'/view/forms/formdocumento.html';
		break;


		default:
			echo "Erro: 404 - Pagina Não encontrada";
		break;




	}# End Switch
}#End Funtion validate_options


function transacao()
{

	$_SESSION['transacao']="";
	if(!isset($_GET['option']))
	{
		return false;
	}
	global $user;

	switch($_GET['option'])
	{

	# Empresa
	case 'empresa':	
		$_SESSION['transacao']="Empresas";
	break;

	case 'cadempresa':
		$_SESSION['transacao']="Empresas";
	break;

	# Autorizado
	case 'autorizado':	
		$_SESSION['transacao']="Autorizados";	
	break;

	case 'cadautorizado':
		$_SESSION['transacao']="Autorizados";
	break;

	# Setor Autorizado
	case 'setorautorizado':	
		$_SESSION['transacao']="Acesso a Empresas";
	break;

	case 'cadsetorautorizado':
		$_SESSION['transacao']="Acesso a Empresas";
	break;


	# Acesso ao sistema
	case 'acesso':	
		$_SESSION['transacao']="Acesso ao Sistama";			
	break;
	case 'cadacesso':	
		$_SESSION['transacao']="Acesso ao Sistama";			
	break;



	# arquivo
	case 'arquivo':	
		$_SESSION['transacao']="Arquivos";				
	break;

	case 'cadarquivo':
		$_SESSION['transacao']="Arquivos";	
	break;

	# corredor
	case 'corredor':	
		$_SESSION['transacao']="Corredores";				
	break;

	case 'cadcorredor':
		$_SESSION['transacao']="Corredores";	
	break;


	# estante
	case 'estante':	
		$_SESSION['transacao']="Estantes";				
	break;

	case 'cadestante':
		$_SESSION['transacao']="Estantes";	
	break;

	# prateleira
	case 'prateleira':	
		$_SESSION['transacao']="Prateleiras";				
	break;

	case 'cadprateleira':
		$_SESSION['transacao']="Prateleiras";	
	break;

	# caixa
	case 'caixa':	
		$_SESSION['transacao']="Caixas";				
	break;

	case 'cadcaixa':
		$_SESSION['transacao']="Caixas";	
	break;


	# setor
	case 'setor':	
		$_SESSION['transacao']="Setor";				
	break;

	case 'cadsetor':
		$_SESSION['transacao']="Setor";	
	break;


	# tipodocumento
	case 'tipodocumento':	
		$_SESSION['transacao']="Tipo de Documentos";	
	break;

	case 'cadtipodoc':
		$_SESSION['transacao']="Tipo de Documentos";	
	break;

	# documento
	case 'documento':	
		$_SESSION['transacao']="Documentos";			
	break;

	case 'caddocumento':
		$_SESSION['transacao']="Documentos";
	break;

	# usuario
	case 'usuario':	
		$_SESSION['transacao']="Usuarios";	
	break;

	case 'cadusuario':
		$_SESSION['transacao']="Usuarios";
	break;
			

	case 'manager_users':
		
		include_once 'manager_users.html';
	break;





	}# End Switch
}#End Funtion validate_options


?>