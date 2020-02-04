<?php
  

    #
    # Regras de Negocio para a Processo de Autorizaos
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/autorizadoPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/Autorizado.class.php';
    include_once $GLOBALS['project_path'].'/dao/usuarioPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/Usuario.class.php';
  
    
    
    # Instaciando as classes necessarias
    $autorizadoPDO= new AutorizadoPDO();
    $autorizado=new Autorizado();

    $usuarioPDO= new UsuarioPDO();
    $usuario=new Usuario();

    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=array();


    # Preencher Formulario com os dados 
       
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codigo=isset($_GET['id'])?$_GET['id']:"";
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
        
        $usuario->setLogin($_POST['emailAut']);
        $usuario->setNome($_POST['nomeAut']);
        $usuario->setSenha($_POST['senAut']);
        $usuario->setStatus("");
        $usuario->setPerfil("0");
        
        switch ($operacao)
        {
            case 'a':

                $registro=$autorizadoPDO->update($autorizado);
                var_dump($registro);
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
                    echo $mensagem;
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
        header("location:".$GLOBALS['project_index']."sisarq.php?option=autorizado");
        
    }
     
?>