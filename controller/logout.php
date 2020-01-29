<?php  
     include_once "Conexao_Class.php";
	 include_once("usuarioPDO.php");
	 include_once("Usuario_Class.php");
 
	 
	 $usuarioPDO= new UsuarioPDO();
	 $usuario=new Usuario();
	

	# Abrir a sessão
	session_start();

	$registro=$_SESSION['user'];
	
	$usuario->setCodigo($registro['id_usu']);
	$usuario->setLogin($registro['log_usuario']);
	$usuario->setSenha(base64_decode($registro['sen_usuario']));
	$usuario->setPerfil($registro['per_usuario']);
	$usuario->setStatus("");
	##$registro=$usuarioPDO->update($usuario);


	# Destruindo a sessão
	session_destroy();

	# Redirecionamento
	$conexao=Conexao::getConnection();
	$conecao=null;

	header("location: index.php?error=session_ending");
   

?>