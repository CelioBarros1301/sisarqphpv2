<?php
  
    #
    # Regras de Negocio para a Processo de Acesso Ao Sistema
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/acessomenuPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/AcessoMenu.class.php';
    include_once $GLOBALS['project_path'].'/dao/menuPDO.php';
    include_once $GLOBALS['project_path'].'/dao/usuarioPDO.php';
    
    
    # Instaciando as classes necessarias
    $acessoPDO  = new AcessoMenuPDO();
    $acesso     = new AcessoMenu();
    
    $usuarioPDO = new UsuarioPDO();
    $menuPDO    = new MenuPDO();

    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro         = array();
    
    # Lendo variavel de sessão
    $user=$_SESSION['user'];


        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codAcesso=isset($_GET['codAce'])?$_GET['codAce']:"";
        $codMenu=isset($_GET['codMenu'])?$_GET['codMenu']:"";
        $codUsuario=isset($_GET['codUsu'])?$_GET['codUsu']:"";
        
        if ($acao=="i" ) 
        { 
            $tabelaUsuario =$usuarioPDO->lista("");
            $tabelaMenu  =$acessoPDO->listaMenu($codUsuario);
        }
        else
        {
            #$registro=$acessoPDO->busca($codAcesso);
            $tabelaUsuario = $usuarioPDO->lista($codUsuario);
            $tabelaMenu    = $menuPDO->menu($codMenu);
        }
        $registro      = $acessoPDO->busca($codAcesso);
        
        
    }
    else if( !isset($_GET['status']))
    {
    
    
        # Preencher o DataTable
    
        $filtroUsuario=$user['id_usu'];
        $filtroUsuario=(isset($_GET['filtroUsu']) && $_GET['filtroUsu']!="0")?$_GET['filtroUsu']: $filtroUsuario;
        $tabelaUsuario=$usuarioPDO->lista("");
        $dataTable=$acessoPDO->listaAcesso($filtroUsuario);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao   = $_POST['operacao'];
        $codAcesso  = $_POST['codAce']=isset($_POST['codAce'])?$_POST['codAce']:"0";
        $codUsuario = $_POST['codUsu']=isset($_POST['codUsu'])?$_POST['codUsu']:"0";
       

        # Gerando as informacoes do Objeto
        $_POST['codAce']=isset($_POST['codAce'])?$_POST['codAce']:"0";
        $_POST['codMenu']=isset($_POST['codMenu'])?$_POST['codMenu']:"0";
        $_POST['statMenu']=isset($_POST['statMenu'])?$_POST['statMenu']:"0";
        $_POST['statInc']=isset($_POST['statInc'])?$_POST['statInc']:"0";
        $_POST['statAlt']=isset($_POST['statAlt'])?$_POST['statAlt']:"0";
        $_POST['statExc']=isset($_POST['statExc'])?$_POST['statExc']:"0";
        $_POST['statCon']=isset($_POST['statCon'])?$_POST['statCon']:"0";
        $_POST['statRel']=isset($_POST['statRel'])?$_POST['statRel']:"0";
       
        
        $acesso->setIdAcesso($_POST['codAce']);
        $acesso->setIdMenu($_POST['codMenu']);
        $acesso->setIdUsuario($_POST['codUsu']);
        $acesso->setStatusMenu($_POST['statMenu']);
        $acesso->setStatusIncluir($_POST['statInc']);
        $acesso->setStatusAlterar($_POST['statAlt']);
        $acesso->setStatusExcluir($_POST['statExc']);
        $acesso->setStatusConsultar($_POST['statCon']);
        $acesso->setStatusRelatorio($_POST['statRel']);
      
        var_dump($acesso);

        switch ($operacao)
        {
            case 'a':
                $registro=$acessoPDO->update($acesso);
            break;
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$acessoPDO->insert($acesso);
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
                $registro=$acessoPDO->delete($codAcesso);
            break;
        }
        header("location:".$GLOBALS['project_index']."sisarq.php?option=acesso&filtroUsu=$codUsuario");
       
    }
     
?>