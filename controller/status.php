<?php
  
/*
* Regras de Negocio para a Processo de Manutencoa Arquivo
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("statusPDO.php");
    require("Status_Class.php");
    
    $statusPDO= new StatusPDO();
    $status   = new Status();
        
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 

        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codStatus=$_GET['codSta'];
        $desStatus=$_GET['desSta'];
        $tipStatus=$_GET['tipSta'];
        
        
        if ($acao=="i" ) 
        { 
            $tabelaStatus=$statusPDO->lista("");
        }
        else
        {
            $tabelaStatus=$statusPDO->lista($codStatus);
        }
        $registro=$statusPDO->busca($codStatus);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $dataTable=$statusPDO->lista("");
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codStatus=$_POST['codSta'];
        $desStatus=$_POST['desSta'];
        $tipStatus=$_POST['tipSta'];
        
        
        # Gerando as informacoes do Objeto
        $status->setCodigoStatus($_POST['codSta']);
        $status->setDescricao($_POST['desSta']);
        $status->setTipoStatus($_POST['tipSta']);
        
        switch ($operacao)
        {
            case 'a':
                $registro=$statusPDO->update($status);
            break;
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$statusPDO->insert($status);
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
                $registro=$stausPDO->delete($codStatus);
            break;
        }
        header("location:sisarq.php?option=status");
    }
     
?>