<?php

require_once("Conexao_Class.php");

class ReferenciaPDO
{

    public function __construct(){}
  
    public function busca($codEmpresa)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_referencia ";
            $sql.=" WHERE cod_empresa    =? ";
                       
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codEmpresa);
            
            
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($referencia)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Estante               
        * Nota: 
        */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_referencia ( ';
            $sql.='`cod_empresa`,';
            $sql.='`id_documento`)';
            
            $sql.=' VALUES ( ?,?)';
            $smtm=$conexao->prepare($sql);
          
            $smtm->bindValue(1,$referencia->getCodigoEmpresa());
            $smtm->bindValue(2,$referencia->getIdDocumento());
             
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


    public function update($referencia)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_referencia SET ";
        $sql.='`id_documento`=? ';
        
       
        $sql.= " WHERE cod_empresa   =? ";
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$referencia->getEmpresa());
        $smtm->bindValue(2,$referencia-> getIdDocumento());
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    
}

?>