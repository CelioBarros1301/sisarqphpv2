<?php
    #
    # Regras de Negocio para a Processo de Prateleira  #
    
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/ajaxPDO.php';
    


    
    # Instaciando as classes necessarias
    $ajaxPDO  = new AjaxPDO();
    $codEmpresa  = isset($_GET['codEmp'])?$_GET['codEmp']:"";
    $codSetor    = isset($_GET['codSet'])?$_GET['codSet']:"";
    $codCaixa    = isset($_GET['codCai'])?$_GET['codCai']:"";
    
    $html  =$ajaxPDO->listaSetor($codEmpresa,$codSetor);
    echo $html; 
?>