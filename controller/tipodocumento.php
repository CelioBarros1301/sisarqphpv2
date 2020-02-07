<?php
  
    #
    # Regras de Negocio para a Processo de Tipo de Documento
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/tipodocumentoPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/TipoDocumento.class.php';
    include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';
  
    # Instaciando as classes necessarias
    $tipodocumentoPDO = new TipoDocumentoPDO();
    $tipodocumento    = new TipoDocumento();
    $empresaPDO       = new EmpresaPDO();
 
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=array();


    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];

        $codEmpresa   = isset($_GET['codEmp'])?$_GET['codEmp']:"";
        $codDocumento = isset($_GET['codDoc'])?$_GET['codDoc']:"";

        
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa=$empresaPDO->lista("");
        }
        else
        {
            $tabelaEmpresa=$empresaPDO->lista($codEmpresa);
            $registro     =$tipodocumentoPDO->busca($codEmpresa,$codDocumento);
        }
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        # Preencher o DataTable
        $filtroEmpresa= (isset($_GET['filtroEmp']) && $_GET['filtroEmp']!="" )?$_GET['filtroEmp']:""; 
        $tabelaEmpresa=$empresaPDO->lista("");
            
        $dataTable=$tipodocumentoPDO->lista($filtroEmpresa);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
       
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codEmpresa  =$_POST['codEmp'];
        $codDocumento=$_POST['codDoc'];
        
        
        # Gerando as informacoes do Objeto
        $tipodocumento->setCodigoEmpresa($_POST['codEmp']);
        $tipodocumento->setCodigoDocumento($_POST['codDoc']);
        $tipodocumento->setDescricao($_POST['desDoc']);
        $tipodocumento->setSigla($_POST['sigDoc']);
        
        
        switch ($operacao)
        {
            case 'a':
                $registro=$tipodocumentoPDO->update($tipodocumento);
            break;
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$tipodocumentoPDO->insert($tipodocumento);
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
                $registro=$tipodocumentoPDO->delete($codEmpresa,$codDocumento);
            break;
        }
        header("location:".$GLOBALS['project_index']."sisarq.php?option=tipodocumento&filtroEmp=$codEmpresa");
 
    }
     
?>