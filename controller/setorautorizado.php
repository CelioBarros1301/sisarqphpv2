<?php
  
/*
* Regras de Negocio para a Processo de Manutencoa Arquivo
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("setorautorizadoPDO.php");
    require("SetorAutorizado_Class.php");

    require("setorPDO.php");
    require("empresaPDO.php");
    require("autorizadoPDO.php");
    
    $setorautorizadoPDO = new SetorAutorizadoPDO();
    $setorautorizado    = new SetorAutorizado();
    
    $setorPDO           = new SetorPDO();
    $empresaPDO         = new EmpresaPDO();
    $autorizadoPDO      = new AutorizadoPDO();    

    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 

        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao           =$_GET['status'];
        $codId          =$_GET['codId'];
        $codAutorizado  =$_GET['codAut'];
        $codEmpresa     =$_GET['codEmp'];
        $codSetor       =$_GET['codSet'];
        
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
            
        }
        $registro=$setorautorizadoPDO->busca($codId);
        
    }
    else if( !isset($_GET['status']))
    {
    # Preencher o DataTable
        $filtroAutorizado="";
        if (isset($_GET['filtroAut']) ) 
        {
            $filtroAutorizado=$_GET['filtroAut'];
        }    
    
        $tabelaAutorizado=$autorizadoPDO->lista("");
        $dataTable=$setorautorizadoPDO->lista($filtroAutorizado);
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
        header("location:sisarq.php?option=setorautorizado");
    }
     
?>