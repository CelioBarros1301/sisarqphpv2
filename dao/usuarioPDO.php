<?php

# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $project_path."/model/class/Conexao.class.php";



class UsuarioPDO
{

    public function __construct(){}

    public function busca($codigo)
    {
        
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT * ";
        $sql.=" FROM tb_usuarios ";
        $sql.=" WHERE id_usu=?   ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codigo);
        $smtm->execute();
        $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
        $conexao=null;
        return $resultSet ;      
        

    }
    public function buscaLogin($login)
    /*
    * Objetivo: Localizar o usuario pelo login
    * Parametro: $login -> login do usuario
    * Retorno: Objeto da classe usuario
    */
    {
        
        $usuario= null;
        $conexao= Conexao::getConnection();
        $result = array();
        
        $sql ="SELECT * ";
        $sql.=" FROM tb_usuarios   ";
        $sql.=" WHERE log_usuario=?";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$login);
        $smtm->execute();
        $resultset=$smtm->fetch(PDO::FETCH_ASSOC);
        $conexao=null;
        
        return $resultset ;      
        

    }
    public function insert($usuario)
    {
  
        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_usuarios ( ';
            $sql.='`log_usuario`,' ;
            $sql.='`sen_usuario`,' ;
            $sql.='`sta_usuario`,' ;
            $sql.='`per_usuario`) ';
            
            $sql.=' VALUES (?,?,?,?)';
            
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$usuario->getLogin());
            $smtm->bindValue(2,base64_encode($usuario->getSenha()));
            $smtm->bindValue(3,$usuario->getStatus());
            $smtm->bindValue(4,$usuario->getPerfil());
            
            
            $result=$smtm->execute();
            
            return $result;
        }
        catch (PDOExecption $e  )
        {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
        }
    }   


    public function update($usuario)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_usuarios SET ";
        $sql.='`sen_usuario`=?,';
        $sql.='`sta_usuario`=?,';
        $sql.='`per_usuario`=? ';

        $sql.= " WHERE id_usu=?";

        $smtm=$conexao->prepare($sql);

        $smtm->bindValue(1,base64_encode($usuario->getSenha()));
        $smtm->bindValue(2,$usuario->getStatus());
        $smtm->bindValue(3,$usuario->getPerfil());
        $smtm->bindValue(4,$usuario->getCodigo());

        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }

    public function delete($login)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_usuarios ";
        $sql.= " WHERE log_usuario   =? ";

        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$login);
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }

    public function libera($login)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_usuarios SET ";
        $sql.='`sta_usuario`=""';

        $sql.= " WHERE id_usu=?";

        $smtm=$conexao->prepare($sql);

        $smtm->bindValue(1,$login);

        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($codUsuario)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT id_usu Codigo,log_usuario Login , ";
        $sql.="CASE WHEN per_usuario ='1' THEN 'Administrador' ELSE 'Usuario Padrao' END as Perfil";
        $sql.=" FROM tb_usuarios ";

        if (isset($Usuario) && $codUsuario!="")
        {
            $sql.= " WHERE id_usu= ? ";
            $smtm=$conexao -> prepare($sql);
            $smtm->bindValue(1,$codUsuario);
        }
        else
        {
            $smtm=$conexao -> prepare($sql);
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

    public function listalibera($login)
    {
        $conexao=Conexao::getConnection();
        $result =array();
        
        $sql="SELECT id_usu Codigo,log_usuario Login ,";
        $sql.="CASE WHEN per_usuario ='1' THEN 'Administrador' ELSE 'Usuario Padrao' END as Perfil";
        $sql.=" FROM tb_usuarios ";
        $sql.= " WHERE sta_usuario != ? AND ";
        $sql.= "       id_usu      != ?     ";

        $smtm=$conexao -> prepare($sql);
        $smtm->bindValue(1,"");
        $smtm->bindValue(2,$login);
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

}

?>