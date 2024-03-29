<?php

    #
    # Regras de Negocio para a Processo de Manutencoa Setor
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/setorPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/Setor.class.php';
    include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';


    # Instaciando as classes necessarias
    $setorPDO   = new SetorPDO();
    $setor      = new Setor();
    $empresaPDO = new EmpresaPDO();

    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=array();

    # Preencher Formulario com os dados 

    if (isset($_GET['status'] ))
    {
        $acao      = $_GET['status'];
        $codEmpresa= isset($_GET['codEmp'])?$_GET['codEmp']:"";
        $codSetor  = isset($_GET['codSet'])?$_GET['codSet']:"";

        if ( $acao=="i" ) 
        { 
            $tabelaEmpresa=$empresaPDO->lista("");
        }
        else
        {
            $tabelaEmpresa= $empresaPDO->lista($codEmpresa);
            $registro     = $setorPDO->busca($codEmpresa,$codSetor);

        }
     
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
       # Preencher o DataTable
       $filtroEmpresa= (isset($_GET['filtroEmp']) && $_GET['filtroEmp']!="" )?$_GET['filtroEmp']:""; 
       $tabelaEmpresa=$empresaPDO->lista("");
           
       $dataTable=$setorPDO->lista($filtroEmpresa);
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


        # Gerando as informacoes do Objeto
        $setor->setCodigoEmpresa($_POST['codEmp']);
        $setor->setCodigoSetor($_POST['codSet']);
        $setor->setDescricao($_POST['desSet']);

        switch ($operacao)
        {
            case 'a':
                $registro=$setorPDO->update($setor);
            break;

            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$setorPDO->insert($setor);
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
                try
                {
                    $registro=$setorPDO->delete($codEmpresa,$codSetor);
                    $error=0;
                }
                catch(Exception  $e)
                {
                    $error=1;
                }
            break;
        }
        header("location:".$GLOBALS['project_index']."sisarq.php?option=setor&filtroEmp=$codEmpresa");
    }

?>