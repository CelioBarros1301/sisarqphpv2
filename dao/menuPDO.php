<?php

# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $project_path."/model/class/Conexao.class.php";


class MenuPDO
{

    public function __construct(){}
  
   

    public function menu($codMenu)
    {
        $conexao=Conexao::getConnection();
        $result=array();

        $sql = "SELECT   id_menu   CodMenu  , ";
        $sql.= "         seq_menu  Sequencia, ";
        $sql.= "         nome_menu Opcao      ";
        
        $sql.= "FROM tb_menus menu ";
        if ($codMenu!="")
        {
            $sql.= " WHERE  id_menu=?";
        }
        $sql.=" ORDER BY seq_menu,tipo_menu ";
        $smtm=$conexao->prepare($sql);
        if ($codMenu!="")
        {
          $smtm->bindValue(1,$codMenu);
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);

        $conexao=null;
        return  $result;
    }
    
    
    public function lista($usuario)
    {
        $conexao=Conexao::getConnection();
        $result=array();

        $sql = "SELECT    menu.* ,usuario.*";
        $sql.= "FROM tb_menus menu ";
        $sql.= "  INNER JOIN tb_menu_usuarios usuario ";
        $sql.= "        ON menu.id_menu=usuario.id_menu ";
        $sql.= "  WHERE id_usu=?"; 
        $sql.=" ORDER BY seq_menu,tipo_menu ";
      
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$usuario);
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

    public function listamenu($usuario,$menu)
    {
        $conexao=Conexao::getConnection();
        $result=array();

        $sql = "SELECT    menu.* ,usuario.*";
        $sql.= "FROM tb_menus menu ";
        $sql.= "  INNER JOIN tb_menu_usuarios usuario ";
        $sql.= "        ON menu.id_menu=usuario.id_menu ";
        $sql.= "  WHERE id_usu   =? AND ";
        $sql.= "        nome_menu=?  ";
         
        $sql.=" ORDER BY seq_menu,tipo_menu ";
      
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$usuario);
        $smtm->bindValue(2,$menu);
        
        $smtm->execute();
        $result=$smtm->fetch(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

     
}
?>