<?php
  
/*
* Regras de Negocio para a Processo de Manutencoa Arquivo
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("arquivoPDO.php");
    require("Arquivo_Class.php");
    require("empresaPDO.php");
    
    $arquivoPDO= new ArquivoPDO();
    $arquivo=new Arquivo();
    $empresaPDO=new EmpresaPDO();

        
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 

        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codEmpresa=$_GET['codEmp'];
        $codArquivo=$_GET['codArq'];
        
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa=$empresaPDO->lista("");
        }
        else
        {
            $tabelaEmpresa=$empresaPDO->lista($codEmpresa);
        }
        $registro=$arquivoPDO->busca($codEmpresa,$codArquivo);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $dataTable=$arquivoPDO->lista("");
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
        $codArquivo=$_POST['codArq'];
        
        
        # Gerando as informacoes do Objeto
        $arquivo->setCodigoEmpresa($_POST['codEmp']);
        $arquivo->setCodigoArquivo($_POST['codArq']);
        $arquivo->setDescricao($_POST['desArq']);
        
        switch ($operacao)
        {
            case 'a':
                $registro=$arquivoPDO->update($arquivo);
            break;
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$arquivoPDO->insert($arquivo);
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
                $registro=$arquivoPDO->delete($codEmpresa,$codArquivo);
            break;
        }
        header("location:sisarq.php?option=arquivo");
    }
     
?>