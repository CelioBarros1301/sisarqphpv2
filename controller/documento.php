<?php
  
    #
    # Regras de Negocio para a Processo de Documento
    #

    #Lendo variavel de sessao
    session_start();
    $user=$_SESSION['user'];
   
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
    

    # Instaciando as classes necessarias
    
   
    $caixaPDO           = new CaixaPDO();
    $prateleiraPDO      = new PrateleiraPDO();
    $estantePDO         = new EstantePDO();
    $corredorPDO        = new CorredorPDO();
    $arquivoPDO         = new ArquivoPDO();
    $setorautorizadoPDO = new SetorAutorizadoPDO();
    $autorizadoPDO      = new AutorizadoPDO();
    $tipodocumentoPDO   = new TipoDocumentoPDO();
    $statusPDO          = new StatusPDO();
    $documentoPDO       = new DocumentoPDO();
   
    $codAutorizado  ="";
    $codEmpresa     ="";
    $codSetor       ="";
    $codArquivo     ="";
    $codCorredor    ="";
    $codEstante     ="";
    $codPrateleira  ="";
    $codCaixa       ="";
    $codTipo        ="";
    $codStatus      ="";
    $codDocumento   ="";

               
    # Array para guarda os nome das Colunas doa DataTable
        
    $dataTableColunas = array(); 
    $dataTable        = array();
    $registro         = array();
    $debug=array();

   
    # Array dados do filtro - Tab de Filro
   
    if ( isset($_GET['status'])  && ( $_GET['status']=="f" ) )
    {
     
        $tabelaAutorizado =$autorizadoPDO->lista("");
        $tabelaStatus     =$statusPDO->lista("");
    }

    # Gerando a grid dos documentos conforme o filtro
    if ( isset($_GET['status'])  && $_GET['status']=="g"  )
    {
        $filtro=Array();
        $filtro['codAutorizado'] =isset($_GET['filCodAut'])?$_GET['filCodAut']:"";
        $filtro['codEmpresa']    =isset($_GET['filCodEmp'])?$_GET['filCodEmp']:"";
        $filtro['codSetor']      =isset($_GET['filCodSet'])?$_GET['filCodSet']:"";
        $filtro['codArquivo']    =isset($_GET['filCodArq'])?$_GET['filCodArq']:"";
        $filtro['codCorredor']   =isset($_GET['filCodCor'])?$_GET['filCodCor']:"";
        $filtro['codEstante']    =isset($_GET['filCodEst'])?$_GET['filCodEst']:"";
        $filtro['codPrateleira'] =isset($_GET['filCodPra'])?$_GET['filCodPra']:"";
        $filtro['codCaixa']      =isset($_GET['filCodCai'])?$_GET['filCodCai']:"";
        $filtro['codTipo']       =isset($_GET['filCodTip'])?$_GET['filCodTip']:"";
        $filtro['codStatus']     =isset($_GET['filCodSta'])?$_GET['filCodSta']:"";
        $filtro['numDocumento']  =isset($_GET['filNumDoc'])?$_GET['filNumDoc']:"";
        $filtro['emiDocumento']  =isset($_GET['filEmiDoc'])?$_GET['filEmiDoc']:"";
        $filtro['exeDocumento']  =isset($_GET['filAnoExe'])?$_GET['filAnoExe']:"";
        $filtro['calDocumento']  =isset($_GET['filAnoCal'])?$_GET['filAnoCal']:"";
        $filtro['texDocumento']  =isset($_GET['filTexDoc'])?$_GET['filTexDoc']:"";
        
        $dataTable=$documentoPDO->lista($filtro);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
        $_GET['filCodAut']="";
       # header("location:sisarq.php?option=documento");
   
    }

    # Preencher Formulario com os dados 
        
    if (isset($_GET['status']) && ( $_GET['status']=="i" || $_GET['status']=="a" || $_GET['status']=="e" || $_GET['status']=="v") )
    {
       
        $codDocumento   =isset($_GET['codDoc'])?$_GET['codDoc']:"";
        $empresaPDO    = new EmpresaPDO();
        $setorPDO      = new SetorPDO();
        
        # Localizar Registro Quando da Alteracao/Exclusao
        
        if ($_GET['status']!='i')
        {
            
            $registro       =$documentoPDO->busca($codDocumento);
            $codEmpresa     =$registro["cod_empresa"];
            $codSetor       =$registro['cod_setor'];
            $codArquivo     =$registro['cod_arquivo'];
            $codCorredor    =$registro['cod_corredor'];
            $codEstante     =$registro['cod_estante'];
            $codPrateleira  =$registro['cod_prateleira'];
            $codCaixa       =$registro['cod_caixa'];
            $codTipo        =$registro['tip_documento'];
        
        }
        else
        {
            $tabelaEmpresa    =$empresaPDO->lista("");
        }
        # Preenchimento dos Combobox so com o Dados do Documento
        if ( $_GET['status']=='e' || $_GET['status']=='v' )
        {
            $tabelaEmpresa    =$empresaPDO->lista($codEmpresa);
            $tabelaSetor      =$setorPDO->listaSetor  ($codEmpresa,$codSetor);
            $tabelaArquivo    =$arquivoPDO->listaArquivo($codEmpresa,$codArquivo);
            $tabelaCorredor   =$corredorPDO->listaCorredor($codEmpresa,$codArquivo,$codCorredor);
            $tabelaEstante    =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,$codEstante);
            $tabelaPrateleira =$prateleiraPDO->listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
            $tabelaCaixa      =$caixaPDO->listaCaixa($codEmpresa,$codSetor,$codCaixa);
            $tabelaTipo       =$tipodocumentoPDO->listaTipoDocumento($codEmpresa,$codTipo);
        }
        # Preenchimenton dos Combobox para selecionar com o dados do Documento
        
        elseif ($_GET['status']=='a' )
        {
            $tabelaEmpresa    =$empresaPDO->lista($codEmpresa);
            $tabelaSetor      =$setorPDO->listaSetor  ($codEmpresa,"");
            $tabelaArquivo    =$arquivoPDO->listaArquivo($codEmpresa,"");
            $tabelaCorredor   =$corredorPDO->listaCorredor($codEmpresa,$codArquivo,"");
            $tabelaEstante    =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,"");
            $tabelaPrateleira =$prateleiraPDO->listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,"");
            $tabelaCaixa      =$caixaPDO->listaCaixa($codEmpresa,$codSetor,"");
            $tabelaTipo       =$tipodocumentoPDO->listaTipoDocumento($codEmpresa,"");
            $tabelaStatus     =$statusPDO->lista("");

        }
           
    }
        # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao       = $_POST['operacao'];
        var_dump($_POST);
        
        $codDocumento   = $_POST['codDoc'];
        $codEmpresa     = $_POST['codEmp'];
        $codSetor       = $_POST['codSet'];
        $codArquivo     = $_POST['codArq'];
        $codCorredor    = $_POST['codCor'];
        $codEstante     = $_POST['codEst'];
        $codPrateleira  = $_POST['codPra'];
        $codCaixa       = $_POST['codCai'];
        $codTipo        = $_POST['codTip'];
        $numeroInicial  = $_POST['numIniDoc'];
        $numeroFinal    = $_POST['numFinDoc'];
        $anoExercicio   = $_POST['anoExe'];
        $anoCalendario  = $_POST['anoCal'];
        $emissaoInicial = $_POST['emiIniDoc'];
        $emissaoFinal   = $_POST['emiFinDoc'];
        $dataDestruicao = $_POST['desDoc'];
        $detalhe        = $_POST['texDoc'];

        $documento=new Documento();        
       
        # Gerando as informacoes do Objeto
        
        $documento->setIdDocumento($_POST['codDoc']);
        $documento->setCodigoEmpresa($_POST['codEmp']);
        $documento->setCodigoSetor($_POST['codSet']);
        $documento->setCodigoArquivo($_POST['codArq']);
        $documento->setCodigoCorredor($_POST['codCor']);
        $documento->setCodigoEstante($_POST['codEst']);
        $documento->setCodigoPrateleira($_POST['codPra']);
        $documento->setCodigoCaixa($_POST['codCai']);
        $documento->setTipoDocumento($_POST['codTip']);

        $documento->setNumeroInicial($_POST['numIniDoc']);
        $documento->setNumeroFinal($_POST['numFinDoc']);

        $documento->setDataInicial($_POST['emiIniDoc']);
        $documento->setDataFinal($_POST['emiFinDoc']);
        $documento->setDataDestruicao($_POST['desDoc']);
        $documento->setDescricao($_POST['texDoc']);

        $documento->setAnoExercicio($_POST['anoExe']);
        $documento->setAnoCalendario($_POST['anoCal']);
        $documento->setCodigoStatus('02');
        $documento->setIdUsuario($user['id_usu']);
        
        
        switch ($operacao)
        {
            case 'a':
                $registro=$documentoPDO->update($documento);
            break;
            case 'i':
                try 
                {
                    $registro=$documentoPDO->insert($documento);
                    $conexao=null;
                    }
                catch (PDOExecption $e  )
                {
                    $mensagem  = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
                    $mensagem .= "\nErro: " . $e->getMessage();
                    $conexao=null;
                    throw new Exception($mensagem);
                    
                }
               
            break;
            case 'e':
                $registro=$documentoPDO->delete($_POST['codDoc']);
            break;
        }
        header("location:".$GLOBALS['project_index']."sisarq.php?option=documento&status=f");
 
    }
 

?>