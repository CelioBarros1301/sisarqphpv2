<?php
    #
    # Regras de Negocio para a Processo de Prateleira  #
    
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/caixaPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/Caixa.class.php';
    include_once $GLOBALS['project_path'].'/dao/setorPDO.php';
    include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';



    
    # Instaciando as classes necessarias
    $caixaPDO = new CaixaPDO();
    $caixa    = new Caixa();
    
    
    $setorPDO  = new SetorPDO();
    $empresaPDO=new EmpresaPDO();
            
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=array();
    $filtroEmpresa="";


    # Preencher Formulario com os dados 
      
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];

        $codEmpresa  = isset($_GET['codEmp'])?$_GET['codEmp']:"";
        $codSetor    = isset($_GET['codSet'])?$_GET['codSet']:"";
        $codCaixa    = isset($_GET['codCai'])?$_GET['codCai']:"";
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa=$empresaPDO->lista("");
            $tabelaSetor  =$setorPDO->listaSetor($codEmpresa,"");
        }
        else
        {
            $tabelaEmpresa=$empresaPDO->lista($codEmpresa);
            $tabelaSetor  =$setorPDO->listaSetor($codEmpresa,$codSetor);
            
        }
        $registro=$caixaPDO->busca($codEmpresa,$codSetor,$codCaixa);
        
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
            
        $dataTable=$caixaPDO->lista($filtroEmpresa);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codEmpresa=$_POST['codEmp'];
        $codSetor  =$_POST['codSet'];
        $codCaixa  =$_POST['codCai'];
        
        
        # Gerando as informacoes do Objeto
        $caixa->setCodigoEmpresa($_POST['codEmp']);
        $caixa->setCodigoSetor($_POST['codSet']);
        $caixa->setCodigoCaixa($_POST['codCai']);
        $caixa->setDescricao($_POST['desCai']);
        
       
        switch ($operacao)
        {
            case 'a':
                $registro=$caixaPDO->update($caixa);
            break;
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$caixaPDO->insert($caixa);
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
                $registro=$caixaPDO->delete($codEmpresa,$codSetor,$codCaixa);
            break;
        }

        header("location:".$GLOBALS['project_index']."sisarq.php?option=caixa&filtroEmp=$filtroEmpresa");
 
       
    }
     
?>