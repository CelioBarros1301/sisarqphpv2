<?php
  
    #
    # Regras de Negocio para a Processo de Autorizaos
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/usuarioPDO.php';
   
    
    
    # Instaciando as classes necessarias
    $user = $_SESSION['user'];
   
    $usuarioPDO= new UsuarioPDO();
  
  
  
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=array();


    # Preencher Formulario com os dados 
       
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codigo=isset($_GET['id'])?$_GET['id']:"";
  
        $codigo=$_GET['id'];
        $registro=$usuarioPDO->libera($codigo);
        
    }
    
    # Preencher o DataTable
    $dataTable=$usuarioPDO->listalibera($user['id_usu']);
    if ( $dataTable ) 
    {
        $dataTableColunas = array_keys($dataTable[0]);
    }
    
         
?>