<?php
  
    #
    # Regras de Negocio para a Processo de Corredor
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/corredorPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/Corredor.class.php';
    include_once $GLOBALS['project_path'].'/dao/arquivoPDO.php';
    include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';
  
    # Instaciando as classes necessarias
    $corredorPDO= new CorredorPDO();
    $corredor=new Corredor();
    
    $arquivoPDO= new ArquivoPDO();
    $empresaPDO= new EmpresaPDO();
               
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=array();


    # Preencher Formulario com os dados 
        
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codEmpresa   = isset($_GET['codEmp'])?$_GET['codEmp']:"";
        $codArquivo   = isset($_GET['codArq'])?$_GET['codArq']:"";
        $codCorredor  = isset($_GET['codCor'])?$_GET['codCor']:"";
   
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa=$empresaPDO->lista("");
            $tabelaArquivo=$arquivoPDO->listaArquivo($codEmpresa,"");
            
        }
        else
        {
            $tabelaEmpresa=$empresaPDO->lista($codEmpresa);
            $tabelaArquivo=$arquivoPDO->listaArquivo($codEmpresa,$codArquivo);
            $registro=$corredorPDO->busca($codEmpresa,$codArquivo,$codCorredor);
            
        }
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $filtroEmpresa="";
        if (isset($_GET['filtroEmp']) ) 
        {
            $filtroEmpresa=$_GET['filtroEmp'];
        }    
       
        $tabelaEmpresa=$empresaPDO->lista("");
            
        $dataTable=$corredorPDO->lista($filtroEmpresa);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codEmpresa =$_POST['codEmp'];
        $codArquivo =$_POST['codArq'];
        $codCorredor=$_POST['codCor'];
        
        # Gerando as informacoes do Objeto
        $corredor->setCodigoEmpresa($_POST['codEmp']);
        $corredor->setCodigoArquivo($_POST['codArq']);
        $corredor->setCodigoCorredor($_POST['codCor']);
        $corredor->setDescricao($_POST['desCor']);
        $corredor->setSigla($_POST['sigCor']);
        
        switch ($operacao)
        {
            case 'a':
                $registro=$corredorPDO->update($corredor);
            break;
            case 'i':
                try 
                {
                    $conexao =Conexao::getConnection();
                    $registro=$corredorPDO->insert($corredor);
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
                $registro=$corredorPDO->delete($codEmpresa,$codArquivo,$codCorredor);
            break;
        }
    
        header("location:".$GLOBALS['project_index']."sisarq.php?option=corredor&filtroEmp=$filtroEmpresa");
    }
     
?>