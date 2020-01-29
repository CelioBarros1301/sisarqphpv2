<?php
  
/*
* Regras de Negocio para a Processo de Manutencao do Corredor
*  Objetos envolvidos: Arquivo
*  Regra: 
*/
    
    require("caixaPDO.php");
    require("Caixa_Class.php");

    require("setorPDO.php");
    require("empresaPDO.php");
    
   
    $caixaPDO = new CaixaPDO();
    $caixa    = new Caixa();
    
    
    $setorPDO  = new SetorPDO();
    $empresaPDO=new EmpresaPDO();
               
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $filtroEmpresa="";
    
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codEmpresa=$_GET['codEmp'];
        $codSetor  =$_GET['codSet'];
        $codCaixa  =$_GET['codCai'];
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
       header("location:sisarq.php?option=caixa&filtroEmp=$filtroEmpresa");
    }
     
?>