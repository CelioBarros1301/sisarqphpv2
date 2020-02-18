<?php
  
    #
    # Regras de Negocio para a Processo de Autorizaos
    #
   
    # Incluindo as classes necessárias
    include_once 'model/config.php';
    
    include_once $GLOBALS['project_path'].'/dao/usuarioPDO.php';
   
    
    # Instaciando as classes necessarias
   
    $usuarioPDO= new UsuarioPDO();
  
    # Array para guarda os nome das Colunas doa DataTable
    $registro=array();

    $registro=$usuarioPDO->libera("");
        
    
         
?>