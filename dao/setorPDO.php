<?php

require_once("Conexao_Class.php");

class SetorPDO
{

    public function __construct(){}
  
    public function busca($codEmpresa,$codSetor)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_setores ";
            $sql.=" WHERE cod_empresa=? and ";
            $sql.="       cod_setor  =?  ";
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codSetor);
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($setor)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Usuario               
        * Nota: Se o codigo do Usuario e autoincremento
                */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_setores ( ';
            $sql.='`cod_empresa`,';
            $sql.='`cod_setor`,';
            $sql.='`des_setor`)';
            
            $sql.=' VALUES ( ';
            if ($setor->getCodigoSetor()=="000")
            {
                $sql.='?,';
                $sql.='(SELECT ifnull(right(concat("000",max(setor.cod_setor)+1),3),"001") from tb_setores setor where setor.cod_empresa=' . "'". $setor->getCodigoEmpresa() ."'),";
                $sql.='?)';
              
            }
            else
            {
                $sql.='?,?,?)';
            }
            
            $smtm=$conexao->prepare($sql);
            if ($setor->getCodigoSetor()=="000")
            { 
                $smtm->bindValue(1,$setor->getCodigoEmpresa());
                $smtm->bindValue(2,$setor->getDescricao());
            }
            else
            {
                $smtm->bindValue(1,$setor->getCodigoEmpresa());
                $smtm->bindValue(2,$setor->getCodigoSetor());
                $smtm->bindValue(3,$setor->getDescricao());
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


    public function update($setor)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_setores SET ";
        $sql.='`des_setor`=? ';
       
        $sql.= " WHERE cod_empresa=? and ";
        $sql.= "       cod_setor  =?     ";
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$setor->getDescricao());
        $smtm->bindValue(2,$setor->getcodigoEmpresa());
        $smtm->bindValue(3,$setor->getcodigoSetor());
        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codEmpresa,$codSetor)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_setores ";
        $sql.= " WHERE cod_empresa=? and ";
        $sql.= "       cod_setor  =?     ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codEmpresa);
        $smtm->bindValue(2,$codSetor);
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT empresa.cod_empresa CodEmpresa,des_empresa Empresa,";
        $sql.="cod_setor CodSetor,des_setor Setor ";
        $sql.=" FROM tb_setores setor ";
        $sql.="     inner join tb_empresas empresa on";
        $sql.="           setor.cod_empresa=empresa.cod_empresa ";
        $smtm=$conexao -> prepare($sql);
        
        if (isset($filtro))
        {
            $sql.= " WHERE ?";
            $smtm->bindValue(1,$filtro);
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

    public function listaSetor($codEmpresa,$codSetor)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT cod_setor CodSetor,des_setor Setor ";
        $sql.=" FROM tb_setores ";
        
        $smtm=$conexao -> prepare($sql);
        
        if ($codSetor != "" )
        {
            $sql.= " WHERE cod_empresa=? AND ";
            $sql.= "       cod_setor  =?     ";
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codSetor);
        }
        elseif ($codEmpresa != "" )
        {
            
            $sql.= " WHERE cod_empresa=?  ";
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
        }
        else
        {
            $result[0]["CodSetor"]="0";
            $result[0]["Setor"]="=>Selecionar Setor<=";
            $conexao=null;
            return $result;
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

}

?>