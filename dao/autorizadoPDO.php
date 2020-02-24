<?php

# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $GLOBALS['project_path']."model/class/Conexao.class.php";


class AutorizadoPDO
{

    public function __construct(){}
  
    public function busca($codigo)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_autorizados ";
            $sql.=" WHERE cod_autorizado=?";
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codigo);
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    public function insert($autorizado)
    {
        /*
        * Objeto: Incluir Autorizadoa
        * Parametros: $Autorizado-> Objeto Autorizado               
        * Nota: Se o codigo do Autorizado  for igual a 0000, sistema deve gerar automaticamente o proximo codigo
        */

        $conexao=Conexao::getConnection();;
        $codigo=$autorizado->getCodigo();
              
        $sql='INSERT INTO tb_autorizados (`cod_autorizado`,';
        $sql.='`nom_autorizado`,';
        $sql.='`emp_autorizado`,';
        $sql.='`set_autorizado`,';
        $sql.='`fun_autorizado`,';
        $sql.='`email_autorizado`,';
        $sql.='`cel_autorizado`,';
        $sql.='`tel_autorizado`,';
        $sql.='`lib_autorizado`,';
        $sql.='`log_autorizado`)';
        
        $sql.=' VALUES ( ';
        
        if ($codigo=="0000")

        {
            $sql.='(SELECT ifnull(right(concat("0000",max(autorizado.cod_autorizado)+1),4),"0001") from tb_autorizados autorizado),';
            $sql.='?,?,?,?,?,?,?,?,?)';
        }
        else
        {
            $sql.='?,?,?,?,?,?,?,?,?,?)';
        }
        $smtm=$conexao->prepare($sql);
        if ($codigo=="0000")
        {
                $smtm->bindValue(1,$autorizado->getNome());
                $smtm->bindValue(2,$autorizado->getEmpresa());
                $smtm->bindValue(3,$autorizado->getSetor());
                $smtm->bindValue(4,$autorizado->getFuncao());
                $smtm->bindValue(5,$autorizado->getEmail());
                $smtm->bindValue(6,$autorizado->getCelular());
                $smtm->bindValue(7,$autorizado->getTelefone());
                $smtm->bindValue(8,$autorizado->getLiberado());
                $smtm->bindValue(9,$autorizado->getLogin());
                
        }
        else
        {
            $smtm->bindValue(1,$autorizado->getCodigo());
            $smtm->bindValue(2,$autorizado->getNome());
            $smtm->bindValue(3,$autorizado->getEmpresa());
            $smtm->bindValue(4,$autorizado->getSetor());
            $smtm->bindValue(5,$autorizado->getFuncao());
            $smtm->bindValue(6,$autorizado->getEmail());
            $smtm->bindValue(7,$autorizado->getCelular());
            $smtm->bindValue(8,$autorizado->getTelefone());
            $smtm->bindValue(9,$autorizado->getLiberado());
            $smtm->bindValue(10,$autorizado->getLogin());
          
        }
        $result=$smtm->execute();
        return $result;
    }


    public function update($autorizado)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_autorizados SET ";
        $sql.='`nom_autorizado`  =?,';
        $sql.='`emp_autorizado`  =?,';
        $sql.='`set_autorizado`  =?,';
        $sql.='`fun_autorizado`  =?,';
        $sql.='`email_autorizado`=?,';
        $sql.='`cel_autorizado`  =?,';
        $sql.='`tel_autorizado`  =?,';
        $sql.='`log_autorizado`  =?,';
        $sql.='`lib_autorizado`  =?';
       
        $sql.= " WHERE cod_autorizado=?";
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$autorizado->getNome());
        $smtm->bindValue(2,$autorizado->getEmpresa());
        $smtm->bindValue(3,$autorizado->getSetor());
        $smtm->bindValue(4,$autorizado->getFuncao());
        $smtm->bindValue(5,$autorizado->getEmail());
        $smtm->bindValue(6,$autorizado->getCelular());
        $smtm->bindValue(7,$autorizado->getTelefone());
        $smtm->bindValue(8,$autorizado->getLogin());
        $smtm->bindValue(9,$autorizado->getLiberado());
        $smtm->bindValue(10,$autorizado->getCodigo());
        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codigo)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_autorizados ";
        $sql.= " WHERE cod_autorizado=? ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codigo);
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT cod_autorizado CodAutorizado,";
        $sql.="      nom_autorizado Autorizado   ,";
        $sql.="      emp_autorizado Empresa      ,";
        $sql.="      cel_autorizado Celular      , ";
        $sql.="CASE WHEN lib_autorizado ='1' THEN 'Liberado' ELSE 'Bloqueado' END as Status";
     
        $sql.=" FROM tb_autorizados ";
        
        if ( isset($filtro) && $filtro!="" )
        {
            $sql.= " WHERE cod_autorizado=?";
            $smtm=$conexao -> prepare($sql);
            $smtm->bindValue(1,$filtro);
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



    

}
?>