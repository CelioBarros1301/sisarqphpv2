<?php
  
/*
* Regras de Negocio para a Processo de Manutencoa Arquivo
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("tipodocumentoPDO.php");
    require("TipoDocumento_Class.php");
    require("empresaPDO.php");
    
    $tipodocumentoPDO= new TipoDocumentoPDO();
    $tipodocumento   = new TipoDocumento();
    $empresaPDO      = new EmpresaPDO();

        
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 

        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codEmpresa=$_GET['codEmp'];
        $codDocumento=$_GET['codDoc'];
        
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa=$empresaPDO->lista("");
        }
        else
        {
            $tabelaEmpresa=$empresaPDO->lista($codEmpresa);
        }
        $registro=$tipodocumentoPDO->busca($codEmpresa,$codDocumento);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $dataTable=$tipodocumentoPDO->lista("");
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
        header("location:sisarq.php?option=tipodocumento");
    }
     
?>