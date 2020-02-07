<?php
    #
    # Regras de Negocio para a Processo de Prateleira  #
    
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/ajaxPDO.php';
    


    
    # Instaciando as classes necessarias
    $ajaxPDO  = new AjaxPDO();

    # Lendo os parametros do filtro
    $combo              = isset($_GET['combo'])?$_GET['combo']:"";
    $codEmpresa         = isset($_GET['codEmp'])?$_GET['codEmp']:"";
    $codSetor           = isset($_GET['codSet'])?$_GET['codSet']:"";
    $codArquivo         = isset($_GET['codArq'])?$_GET['codArq']:"";
    $codCorredor        = isset($_GET['codCor'])?$_GET['codCor']:"";
    $codEstante         = isset($_GET['codEst'])?$_GET['codEst']:"";
    $codPrateleira      = isset($_GET['codPra'])?$_GET['codPra']:"";
    $codTipoDocumento   = isset($_GET['codTipo'])?$_GET['codTipo']:"";
    $codAutorizado      = isset($_GET['codAut'])?$_GET['codAut']:"";
    $codUsuario         = isset($_GET['codUsu'])?$_GET['codUsu']:"";

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
        case "arquivo":				
            $html  =$ajaxPDO->listaArquivo($codEmpresa,$codArquivo);
        break;
        case "corredor":				
            $html  =$ajaxPDO->listaCorredor($codEmpresa,$codArquivo,$codCorredor);
        break;
        case "estante":				
            $html  =$ajaxPDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,$codEstante);
        break;
        case "prateleira":				
            $html  =$ajaxPDO->listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
        break;
        case "empresa":				
            $html  =$ajaxPDO->listaEmpresa($codAutorizado,$codEmpresa);
        break;
        case "caixa":				
            $html  =$ajaxPDO->listaCaixa($codEmpresa,$codSetor,$codCaixa);
        break;
        case "tipodocumento":				
            $html  =$ajaxPDO->listaTipoDocumento($codEmpresa,$codTipoDocumento);
        break;

        




    }
    echo $html; 
?>