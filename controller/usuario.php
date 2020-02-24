<?php
  
   #
    # Regras de Negocio para a Processo de Usuario
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/usuarioPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/Usuario.class.php';
    

    # Instaciando as classes necessarias
    $usuarioPDO= new UsuarioPDO();
    $usuario=new Usuario();
   
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro         = array();


    # Preencher Formulario com os dados 
        
      
    if (isset($_GET['status'] ))
    {
        $acao    = $_GET['status'];
        $codigo  = isset($_GET['codUsu'])?$_GET['codUsu']:"";
        $registro= $usuarioPDO->busca($codigo);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $dataTable=$usuarioPDO->lista("");
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codigo=$_POST['codUsu'];
        
        
        # Gerando as informacoes do Objeto
        $usuario->setCodigo($_POST['codUsu']);
        $usuario->setNome($_POST['nomUsu']);
        $usuario->setLogin($_POST['logUsu']);
        $usuario->setSenha($_POST['senUsu']);
        
        if (isset($_POST['perfUsu']))
        {
            $usuario->setPerfil($_POST['perfUsu']);
        }
        else
        {
            $usuario->setPerfil('0');
        }
        if (isset($_POST['libUsu']))
        {
            $usuario->setLiberado($_POST['libUsu']);
        }
        else
        {
            $usuario->setLiberado('0');
        }
        $usuario->setStatus("");
        
        switch ($operacao)
        {
            case 'a':
                $registro=$usuarioPDO->update($usuario);
            break;
            case 'i':
                try 
                {
                    $conexao = Conexao::getConnection();
                    $registro= $usuarioPDO->insert($usuario);
                    $conexao = null;
                }
                catch (PDOExecption $e  )
                {
                    $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
                    $mensagem.= "\nErro: " . $e->getMessage();
                    $conexao  =null;
                    throw new Exception($mensagem);
                    
                }
                /*finally
                {
                    $conexao=null; 
                }*/
            break;
            case 'e':
                $registro=$usuarioPDO->delete($codigo);
            break;
        }
        header("location:".$GLOBALS['project_index']."sisarq.php?option=usuario");
    }
     
?>