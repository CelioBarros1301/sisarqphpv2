<?php
    # Limpando o cache
	ob_start();

	# Incluindo os arquivos Necessários
	include_once dirname(__DIR__)."/model/config.php";
    include_once $project_path."/model/class/Usuario.class.php";
    include_once $project_path."/dao/usuarioPDO.php";
    include_once $project_path."/dao/menuPDO.php";

	# Criando a sessão
    session_start();
    
    #liberar usuarios logados
    $usuarioPDO = new UsuarioPDO();
    $registro=$usuarioPDO->liberaUsuario();

       
    #Dados dos Formularios
    $email = $_POST['email'];
    $senha = base64_encode($_POST['senha']);
    
    #Localizar o usuario
    $registro   = $usuarioPDO->buscaLogin($email);

    #Verificar se Usuario Logado
    $logado = isset($_COOKIE['CookieAcesso']) ? $_COOKIE['CookieAcesso'] : '';

    # Ver Acessos Menu Permitidos
    $menuPDO = new MenuPDO();
    $menu    = $menuPDO->lista($registro['id_usu']);

    //Verificar usuario Cadastrado
    if (!$registro) 
    {
        header("location: $project_index?error=user_not_found");
    } 
    //Verificar senha usuario
    elseif (! ( $senha==$registro['sen_usuario'])) {
        header("location: $project_index?error=password_incorrect");  
    }
    // Verificar usuario logado em outra estacao
    elseif ($registro['sta_usuario']!=$logado && $registro['sta_usuario']!="" ){
        header("location: $project_index?error=user_log");
    }
    // Verificar usuario liberado
    elseif ($registro['lib_usuario']!='1'){
        header("location: $project_index?error=blocked access");
    }
    // Verificar usuario logado
    elseif ($registro['sta_usuario']==$logado && $registro['sta_usuario']!=""){

	    #  Criando a sessão
	    session_start();
        $_SESSION['user']=$registro;
        header("location: $project_index");
    }
    elseif (count($menu)==0) // Verificar Usuario tem permissao
    {
        header("location: $project_index?error=user_not_acess");   
    }
    else
    {
        
       # Criando a sessão
	    session_start();
       
        $_SESSION['user']=$registro;
        
        $login  =true;
        $usuario=new Usuario();
        
        # Gravando Cookie
        $expira = time() + 60*60*24*30; 
        $hora   = base64_encode(date('YmdHis'));
        setCookie('CookieAcesso', $hora, $expira);

        # Gravando a informação usuario logado
        $usuario->setCodigo($registro['id_usu']);
        $usuario->setLogin($registro['log_usuario']);
        $usuario->setNome($registro['nome_usuario']);
        $usuario->setSenha(base64_decode($registro['sen_usuario']));
        $usuario->setLiberado($registro['lib_usuario']);
        $usuario->setPerfil($registro['per_usuario']);
        $usuario->setStatus($hora);
        $registro=$usuarioPDO->update($usuario);
        
       
        header("location: $project_index");
    }
    
?>