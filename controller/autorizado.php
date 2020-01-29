<?php
  
/*
* Regras de Negocio para a Processo de Autorizados para acesso as Documentos cadastrados no sistema
*  Objetos envolvidos: Autorizados,Usuario
*  Regra: Quando do cadastro de um Autorizado e for informar o Login, sistema deverá 
*         incluir as informacoes na tabela de Usuario que e responsavel pela liberaçao de
*         acesso ao sistema
*/
    require("autorizadoPDO.php");
    require("Autorizado_Class.php");
 

    require("usuarioPDO.php");
    require("Usuario_Class.php");

    
    $autorizadoPDO= new AutorizadoPDO();
    $autorizado=new Autorizado();

    $usuarioPDO= new UsuarioPDO();
    $usuario=new Usuario();


    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 

        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codigo=$_GET['id'];
        $registro=$autorizadoPDO->busca($codigo);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $dataTable=$autorizadoPDO->lista("");
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
        
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codigo=$_POST['id'];

        # Gerando as informacoes do Objeto
        $autorizado->setCodigo($_POST['id']);
        $autorizado->setNome($_POST['nomeAut']);
        $autorizado->setEmpresa($_POST['empAut']);
        $autorizado->setSetor($_POST['setAut']);
        $autorizado->setFuncao($_POST['funAut']);
        $autorizado->setEmail($_POST['emailAut']);
        $autorizado->setCelular($_POST['celAut']);
        $autorizado->setTelefone($_POST['telAut']);
        $autorizado->setLogin($_POST['logAut']);
        
        $usuario->setLogin($_POST['logAut']);
        $usuario->setSenha($_POST['senAut']);
        $usuario->setStatus("");
        $usuario->setPerfil("0");
        
        switch ($operacao)
        {
            case 'a':
                $registro=$autorizadoPDO->update($autorizado);
            break;
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    ##self::$connection->beginTransaction();
                    $conexao->beginTransaction();
                    $registro=$autorizadoPDO->insert($autorizado);
                    $registro=$usuarioPDO->insert($usuario);
                    $conexao->commit();
                    $conexao=null;
                }
                catch (PDOExecption $e  )
                {
                    $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
                    $mensagem .= "\nErro: " . $e->getMessage();
                    $conexao->rollback();
                    $conexao=null;
                    throw new Exception($mensagem);
                    
                }
                /*finally
                {
                    $conexao=null; 
                }*/
            break;
            case 'e':
                $registro=$autorizadoPDO->delete($codigo);
            break;
        }
        header("location:sisarq.php?option=autorizado");
    }
     
?>