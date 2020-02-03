<?php
  
 
  #
  # Regras de Negocio para a Processo de Prateleira  #
 
  # Incluindo as classes necessárias
  include_once dirname(__DIR__).'/model/config.php';

  include_once $GLOBALS['project_path'].'/dao/prateleiraPDO.php';
  include_once $GLOBALS['project_path'].'/model/class/Prateleira.class.php';
  
  include_once $GLOBALS['project_path'].'/dao/estantePDO.php';
  include_once $GLOBALS['project_path'].'/dao/corredorPDO.php';
  include_once $GLOBALS['project_path'].'/dao/arquivoPDO.php';
  include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';

 
  
  # Instaciando as classes necessarias
  $prateleiraPDO  = new PrateleiraPDO();
  $prateleira     = new Prateleira();
  
  $estantePDO  = new EstantePDO();
  $corredorPDO = new CorredorPDO();
  $arquivoPDO  = new ArquivoPDO();
  $empresaPDO  = new EmpresaPDO();
             
  
  # Array para guarda os nome das Colunas doa DataTable
  $dataTableColunas = array(); 
  $registro=array();
  $filtroEmpresa="";


  # Preencher Formulario com os dados 
      
      
  if (isset($_GET['status'] ))
  {
      $acao=$_GET['status'];
      $codEmpresa   = isset($_GET['codEmp'])?$_GET['codEmp']:"";
      $codArquivo   = isset($_GET['codArq'])?$_GET['codArq']:"";
      $codCorredor  = isset($_GET['codCor'])?$_GET['codCor']:"";
      $codEstante   = isset($_GET['codEst'])?$_GET['codEst']:"";
      $codPrateleira =isset($_GET['codPra'])?$_GET['codPra']:"";

        
  
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa =$empresaPDO->lista("");
            
            $tabelaArquivo =$arquivoPDO->listaArquivo($codEmpresa,"");
            $tabelaCorredor=$corredorPDO->listaCorredor($codEmpresa,$codArquivo,"");
            $tabelaEstante =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,"");
            
        }
        else
        {
            $tabelaEmpresa =$empresaPDO->lista($codEmpresa);
            $tabelaArquivo =$arquivoPDO->listaArquivo($codEmpresa,$codArquivo);
            $tabelaCorredor=$corredorPDO->listaCorredor($codEmpresa,$codArquivo,$codCorredor);
            $tabelaEstante =$estantePDO->listaEstante($codEmpresa,$codArquivo,$codCorredor,$codEstante);
            $registro=$prateleiraPDO->busca($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
            
        }
        
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $filtroEmpresa = isset($_GET['filtroEmp'])?$_GET['filtroEmp']:""; 
        $tabelaEmpresa = $empresaPDO->lista("");
        $dataTable     = $prateleiraPDO->lista($filtroEmpresa);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codEmpresa    =$_POST['codEmp'];
        $codArquivo    =$_POST['codArq'];
        $codCorredor   =$_POST['codCor'];
        $codEstante    =$_POST['codEst'];
        $codPrateleira =$_POST['codPra'];
        
        # Gerando as informacoes do Objeto
        $prateleira->setCodigoEmpresa($_POST['codEmp']);
        $prateleira->setCodigoArquivo($_POST['codArq']);
        $prateleira->setCodigoCorredor($_POST['codCor']);
        $prateleira->setCodigoEstante($_POST['codEst']);
        $prateleira->setCodigoPrateleira($_POST['codPra']);
        $prateleira->setDescricao($_POST['desPra']);
        $prateleira->setSigla($_POST['sigPra']);
        
        
        switch ($operacao)
        {
            case 'a':
                $registro=$prateleiraPDO->update($prateleira);
            break;
            case 'i':
                try 
                {
                    $conexao =Conexao::getConnection();
                    $registro=$prateleiraPDO->insert($prateleira);
                    $conexao =null;
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
                
                $registro=$prateleiraPDO->delete($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira);
            break;
        }
        header("location:".$GLOBALS['project_index']."sisarq.php?option=prateleira&filtroEmp=$filtroEmpresa");
    }
     
?>