<?php
    #
    # Regras de Negocio para a Processo de Prateleira  #
    
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/ajaxPDO.php';
    


    
    # Instaciando as classes necessarias
    $ajaxPDO  = new AjaxPDO();

    # Lendo os parametros do filtro
    $combo       = isset($_GET['combo'])?$_GET['combo']:"";
    $codEmpresa  = isset($_GET['codEmp'])?$_GET['codEmp']:"";
    $codSetor    = isset($_GET['codSet'])?$_GET['codSet']:"";
    $codUsuario  = isset($_GET['codUsu'])?$_GET['codUsu']:"";

    # Selecionar a opcao de combo
    $html="";
    switch($combo)
    {
        case "setor":				
            $html  =$ajaxPDO->listaSetor($codEmpresa,$codSetor);
        break;
        case "menu":				
            $html  =$ajaxPDO->listaMenu($codUsuario);
        break;


    }
    echo $html; 
?>