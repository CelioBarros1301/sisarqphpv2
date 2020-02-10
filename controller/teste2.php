<?php
  
#
    # Regras de Negocio para a Processo de Documento
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/documentoPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/Documento.class.php';

    include_once $GLOBALS['project_path'].'/dao/caixaPDO.php';
    include_once $GLOBALS['project_path'].'/dao/prateleiraPDO.php';
    include_once $GLOBALS['project_path'].'/dao/estantePDO.php';
    include_once $GLOBALS['project_path'].'/dao/corredorPDO.php';
    include_once $GLOBALS['project_path'].'/dao/arquivoPDO.php';
    include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';
    include_once $GLOBALS['project_path'].'/dao/setorPDO.php';
    include_once $GLOBALS['project_path'].'/dao/setorautorizadoPDO.php';
    include_once $GLOBALS['project_path'].'/dao/autorizadoPDO.php';
    include_once $GLOBALS['project_path'].'/dao/tipodocumentoPDO.php';
    include_once $GLOBALS['project_path'].'/dao/statusPDO.php';
    
    $documentoPDO       = new DocumentoPDO();

   
            $registro=$documentoPDO->busca('02600000000000000001');
            var_dump($registro);
    
?>