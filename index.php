<?php
  
    # Classe de modelo do Usuário
    include_once 'model/class/Usuario.class.php';
    
    # Classe de modelo do Usuário
    include_once 'model/config.php';
    
    # inicia a sessao
    session_start();
    //testa se ja existe usuario logado
    if( isset($_SESSION['user']))
    {
        header("location: sisarq.php");
    }
    
 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/icone.png" type="image/x-icon">
    <link rel="icon" href="../images/icone.png" type="image/x-icon">
  <title>Area de Login - Sistema de Arquivo </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="view/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="view/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="view/assets/plugins/iCheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    body {
      background: url('imagem/imagembackground.jpg') !important;
      background-size: cover !important;
      overflow-y: hidden;
    }
    .text-white {
      color: #f6cc18 !important;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="imagem/documents.png" alt="logo" height="120" width="180">
   <!--  <a href="#" class="text-white"><b>Prefeitura de </b> Pacatuba</a> -->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Entre para inciciar uma sessão</p>
    <form action="controller/login.php" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php
            if (isset($_GET['error'])) {
                if ( $_GET['error']=="user_not_found" ){
                    echo '<span class="text-danger" >Usuário Não Encontrado</span>';
                }
                if ( $_GET['error']=="user_log" ){
                    echo '<span class="text-danger" >Usuário logado em outra estação</span>';
                }
                if ( $_GET['error']=="user_not_acess" ){
                    echo '<span class="text-danger" >Usuário Sem Permissão</span>';
                }
                if ( $_GET['error']=="blocked access" ){
                  echo '<span class="text-danger" >Usuário Bloqueado</span>';
                }
            }
        ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="senha" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php
            if (isset($_GET['error'])) {
                if ( $_GET['error']=="password_incorrect" ){
                    echo '<span class="text-danger">Senha Invalida!!!</span>';
                }
            }
        ?>
      </div>
      
      <div class="row">
        <div class="col-xs-8">
          <!--<div class="checkbox icheck">
            <label>
              <input type="checkbox"> Lembrar-me
            </label>
          </div>
          -->
        </div>
         
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- 
    <div class="social-auth-links text-center">
      <p>- Ou -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
     -->
    <hr />
    <!-- Comentado por nao implementado
    <a href="javascript:void(0);" data-toggle="modal" data-target="#fogot-pass" class="text-center">Esqueci minha senha</a><br>
    -->
    <a href="http://a4dev.com.br" target="_blank" class="text-center">SISARQ by Celio Barros &copy;</a>
    <!-- esqueci minha senha -->
    <div class="modal fade" id="fogot-pass" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Redefinição de senha</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="row">
              <div class="form-group col-md-9">
                <label>Seu Email</label>
                <input type="email" id="email" class="form-control" />
              </div>
              <div class="form-group col-md-3">
                <br />
                <button class="btn btn-primary" id="verify" type="button"><i class="fa fa-check-circle-o"></i> <b>verificar</b></button>
              </div>
            </div>
            <div class="response"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary"><i class="fa fa-check-square-o"></i> <b>Modificar Senha</b></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="view/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="view/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="view/assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
    $("#verify").click(function() {
      if( $("#email").val() != "" ){
        $.ajax({
          url: "controller/ajax.php",
          type: "post",
          dataType: "html",
          data: {
            method: "verify-user",
            user_email: $("#email").val()
          },
          success: function(ret) {
            if(ret == true){
              $(".response").html('<div class="alert alert-success">Um email de recuperação de senha foi enviado para o email <b>' + $("#email").val() + '</b>,caso você não possua mais acesso a este endereço de email,contate o administrador do sistema e solicite uma alteração na base de dados.</div>');
            }else{
              $(".response").html('<div class="alert alert-warning">Um email de recuperação de senha foi enviado para o email <b>' + $("#email").val() + '</b>,caso você não possua mais acesso a este endereço de email,contate o administrador do sistema e solicite uma alteração na base de dados.</div>');
            }
          }
        })
      }else{
        $("#email").val('Campo obrigatório!');
        setTimeout(function() {
          $("#email").val('').focus()
        },1000)
      }
    })
  });
</script>
</body>
</html>

