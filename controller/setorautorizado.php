<?php
  
 #
    # Regras de Negocio para a Processo de Autorizaos Setor para Autorizados
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/setorautorizadoPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/SetorAutorizado.class.php';
    include_once $GLOBALS['project_path'].'/dao/setorPDO.php';
    include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';
    include_once $GLOBALS['project_path'].'/dao/autorizadoPDO.php';

    
    # Instaciando as classes necessarias
    $setorautorizadoPDO = new SetorAutorizadoPDO();
    $setorautorizado    = new SetorAutorizado();
    
    $setorPDO           = new SetorPDO();
    $empresaPDO         = new EmpresaPDO();
    $autorizadoPDO      = new AutorizadoPDO();    

    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=array();


    # Preencher Formulario com os dados 
       
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao           =$_GET['status'];
        $codId          =isset($_GET['codId'])?$_GET['codId']:"";
        $codAutorizado  =isset($_GET['codAut'])?$_GET['codAut']:"";
        $codEmpresa     =isset($_GET['codEmp'])?$_GET['codEmp']:"";
        $codSetor       =isset($_GET['codSet'])?$_GET['codSet']:"";
        
        if ($acao=="i" ) 
      
        { 
            $tabelaAutorizado =$autorizadoPDO->lista("");
            $tabelaEmpresa    =$empresaPDO->lista("");
            $tabelaSetor      =$setorPDO->listaSetor($codEmpresa,"");
        }
        else
        {
            $tabelaAutorizado =$autorizadoPDO->lista($codAutorizado);
            $tabelaEmpresa    =$empresaPDO->lista($codEmpresa);
            $tabelaSetor      =$setorPDO->listaSetor($codEmpresa,$codSetor);
            $registro=$setorautorizadoPDO->busca($codId);
            
      
        }
        
    }
    else if( !isset($_GET['status']))
    {
    # Preencher o DataTable
        $filtroAutorizado= isset($_GET['filtroAut'])?$_GET['filtroAut']:""; 
        
        $tabelaAutorizado=$autorizadoPDO->lista("");
        $dataTable       =$setorautorizadoPDO->lista($filtroAutorizado);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codId        =$_POST['codId'];
        $codAutorizado=$_POST['codAut'];
        $codEmpresa   =$_POST['codEmp'];
        $codSetor     =$_POST['codSet'];
        
        
        # Gerando as informacoes do Objeto
        $setorautorizado->setCodigoEmpresa($_POST['codEmp']);
        $setorautorizado->setCodigoSetor($_POST['codSet']);
        $setorautorizado->setCodigoAutorizado($_POST['codAut']);
        
        switch ($operacao)
        {
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$setorautorizadoPDO->insert($setorautorizado);
                    $conexao=null;
                }
                catch (PDOExecption $e  )
                {
                    $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
                    $mensagem .= "\nErro: " . $e->getMessage();
                    $conexao=null;
                    throw new Exception($mensagem);
                    
                }
               
            break;
            case 'e':
                $registro=$setorautorizadoPDO->delete($codId);
            break;
        }
        header("location:".$GLOBALS['project_index']."sisarq.php?option=setorautorizado");
    }
     
?>