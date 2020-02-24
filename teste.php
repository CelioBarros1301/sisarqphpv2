<?php
    
  
 
    ini_set("display_errors", 1);
	error_reporting(E_ALL | E_WARNING);
	
    include_once '/model/config.php';

    include_once '/dao/acessomenuPDO.php';
    $acessoPDO  = new AcessoMenuPDO();
    $codUsuario=1;
   
    $tabelaMenu  =$acessoPDO->listaMenu($codUsuario);

    #var_dump($tabelaMenu);
    foreach ($tabelaMenu  as  $valor){
     #   echo $valor['Opcao']."<br/>";
    }
   
    include_once "/model/class/Usuario.class.php";
    include_once "/dao/usuarioPDO.php";
    include_once "/dao/menuPDO.php";

	# Criando a sessão
    session_start();
    
    #liberar usuarios logados
    $usuarioPDO = new UsuarioPDO();
    $registro=$usuarioPDO->liberaUsuario();

      
?>

