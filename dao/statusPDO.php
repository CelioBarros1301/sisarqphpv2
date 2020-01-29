<?php

require_once("Conexao_Class.php");

class StatusPDO
{

    public function __construct(){}
  
    public function busca($codStatus)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_status ";
            $sql.=" WHERE cod_status=?  ";
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codStatus);
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($status)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Usuario               
        * Nota: Se o codigo do Usuario e autoincremento
                */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_status ( ';
            $sql.='`cod_status`,';
            $sql.='`des_status`,';
            $sql.='`tip_status`)';
            
            $sql.=' VALUES ( ';
            if ($arquivo->getCodigoStatus()=="00")
            {
                $sql.='?,';
                $sql.='(SELECT ifnull(right(concat("00",max(status.cod_status)+1),2),"01") from tb_status status ),';
                $sql.='?)';
              
            }
            else
            {
                $sql.='?,?,?)';
            }
            
            $smtm=$conexao->prepare($sql);
            if ($arquivo->getCodigoStatus()=="00")
            { 
                $smtm->bindValue(1,$status->getDescricao());
                $smtm->bindValue(2,$status->getTipoStatus());
            }
            else
            {
                $smtm->bindValue(1,$status->getCodigoStatus());
                $smtm->bindValue(2,$status->getDescricao());
                $smtm->bindValue(3,$status->getTipoStatus());
            }
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


    public function update($status)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_status SET ";
        $sql.='`des_status`=? ,';
        $sql.='`tip_status`=? ';
        
       
        $sql.= " WHERE cod_status=? ";
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$status->getCodigoStatus());
        $smtm->bindValue(2,$status->getDescricao());
        $smtm->bindValue(3,$status->getTipoStatus());
        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codStatus)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_status ";
        $sql.= " WHERE cod_status=?  ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codStatus);
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT status.cod_status CodStatus,status.des_status Status," ;  
        $sql.="      status.tip_status Tipo ";
        $sql.=" FROM tb_status status ";
        
        if ($filtro!="")
        { 
            $sql.= " WHERE status.cod_status=?";
        }
        $smtm=$conexao -> prepare($sql);
        
        if ($filtro!="")
        {
            $smtm->bindValue(1,$filtro);
        }

        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

    
}

?>