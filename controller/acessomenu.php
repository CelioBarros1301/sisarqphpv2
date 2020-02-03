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


    # Preencher Formulario com os dados 
        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codAcesso=isset($_GET['codAce'])?$_GET['codAce']:"";
        $codUsuario=isset($_GET['codUsu'])?$_GET['codUsu']:"";
        
        if ($acao=="i" ) 
        { 
            $tabelaUsuario =$usuarioPDO->lista("");
            $tabelaMenu  =$acessoPDO->listaMenu($codUsuario);
        }
        else
        {
            #$registro=$acessoPDO->busca($codAcesso);
            $codUsuario    = $registro['id_usu'];
            $tabelaUsuario = $usuarioPDO->lista($codUsuario);
            $tabelaMenu    = $menuPDO->menu($codAcesso);
        }
        $registro      = $acessoPDO->busca($codAcesso);
        
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
    
        $user=$_SESSION['user'];
    
        $filtroUsuario=$user['id_usu'];
        $filtroUsuario=isset($_GET['filtroUsu'])?$_GET['filtroUsu']: $filtroUsuario;
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
        $operacao=$_POST['operacao'];
        
        
        # Gerando as informacoes do Objeto
            
        $acesso->setIdMenu($_POST['codMenu']);
        $acesso->setIdUsuario($_POST['codUsu']);
        $acesso->setStatusMenu($_POST['statMenu']);
        $acesso->setStatusIncluir($_POST['statInc']);
        $acesso->setStatusAlterar($_POST['statAlt']);
        $acesso->setStatusExcluir($_POST['statExc']);
        $acesso->setStatusConsultar($_POST['statCon']);
        $acesso->setStatusRelatorio($_POST['statRel']);
      
        

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
        header("location:".$GLOBALS['project_index']."sisarq.php?option=acesso");
       
    }
     
?>