<?php
  
/*
* Regras de Negocio para a Processo de Manutencao do Corredor
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("estantePDO.php");
    require("Estante_Class.php");

    require("corredorPDO.php");
    require("arquivoPDO.php");
    require("empresaPDO.php");
    
   
    $estantePDO  = new EstantePDO();
    $estante     = new Estante();
    
    $corredorPDO = new CorredorPDO();
    $arquivoPDO  = new ArquivoPDO();
    $empresaPDO  = new EmpresaPDO();
               
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $filtroEmpresa="";
    
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codEmpresa  =$_GET['codEmp'];
        $codArquivo  =$_GET['codArq'];
        $codCorredor =$_GET['codCor'];
        $codEstante  =$_GET['codEst'];
  
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa =$empresaPDO->lista("");
            $tabelaArquivo =$arquivoPDO->listaArquivo($codEmpresa,"");
            $tabelaCorredor=$corredorPDO->listaCorredor($codEmpresa,$codArquivo,"");
            
        }
        else
        {
            $tabelaEmpresa =$empresaPDO->lista($codEmpresa);
            $tabelaArquivo =$arquivoPDO->listaArquivo($codEmpresa,$codArquivo);
            $tabelaCorredor=$corredorPDO->listaCorredor($codEmpresa,$codArquivo,$codCorredor);
            
        }
        $registro=$estantePDO->busca($codEmpresa,$codArquivo,$codCorredor,$codEstante);
        
        
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
            
        $dataTable=$estantePDO->lista($filtroEmpresa);
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
        $codEstante =$_POST['codEst'];
        
        
        # Gerando as informacoes do Objeto
        $estante->setCodigoEmpresa($_POST['codEmp']);
        $estante->setCodigoArquivo($_POST['codArq']);
        $estante->setCodigoCorredor($_POST['codCor']);
        $estante->setCodigoEstante($_POST['codEst']);
        $estante->setDescricao($_POST['desEst']);
        $estante->setSigla($_POST['sigEst']);
        
        
        switch ($operacao)
        {
            case 'a':
                $registro=$estantePDO->update($estante);
            break;
            case 'i':
                try 
                {
                    $conexao =Conexao::getConnection();
                    $registro=$estantePDO->insert($estante);
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
             
                $registro=$estantePDO->delete($codEmpresa,$codArquivo,$codCorredor,$codEstante);
            break;
        }
        header("location:sisarq.php?option=estante&filtroEmp=$filtroEmpresa");
    }
     
?>