<?php
require_once("Conexao_Class.php");

class EmpresaPDO
{

     
     public  function __construct(){}
  
    public function busca($codigo)
    {
            $result=array();
            $conexao=Conexao::getConnection();
            $sql="SELECT cod_empresa Codigo,";
            $sql.="des_empresa Empresa ";
            $sql.=" FROM tb_empresas ";
            $sql.=" WHERE cod_empresa=?";
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codigo);
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    public function insert($codigo,$descricao)
    {
        /*
        * Objeto: Incluir Empresa
        * Parametros:   $codigo->Codigo da Empesa
        *               $descricao->nome da empresa             
        * Nota: Se o codigo da empresa for igual a 000, sistema deve gerar automaticamente o proximo codigo
        */
        $conexao=Conexao::getConnection();
        $sql='INSERT INTO tb_empresas(`cod_empresa`,`des_empresa`) ';
        $sql.= 'VALUES ( ';
        if ($codigo=="000")
        {
            $sql.='(SELECT ifnull(right(concat("00",max(empresa.cod_empresa)+1),3),"001") from tb_empresas empresa),';
            $sql.='?)';
        }
        else
        {
            $sql.='?,?)';
        }

        $smtm=$conexao->prepare($sql);
        if ($codigo=="000")
        {
                $smtm->bindValue(1,$descricao);
        }
        else
        {
            $smtm->bindValue(1,$codigo);
            $smtm->bindValue(2,$descricao);
        }
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }


    public function update($codigo,$descricao)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_empresas SET des_empresa=?";
        $sql.= " WHERE cod_empresa=?";
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$descricao);
        $smtm->bindValue(2,$codigo);
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codigo)
    {
        $conexao=null;
        try{
            $conexao=Conexao::getConnection();
            $sql="DELETE  FROM  tb_empresas ";
            $sql.= " WHERE cod_empresa=?";
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codigo);
            $result= $smtm->execute();
            $conexao=null;
        }
        catch (PDOExecption $e  )
        {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            $conexao=null;
            var_dump($mensagem);
            throw new Exception($mensagem);
        }
        
        return $result;
    }


    public function lista($filtro)
    {
        $result=array();
        $conexao=Conexao::getConnection();
        $sql="SELECT cod_empresa Codigo,des_empresa Empresa FROM tb_empresas ";
        if (isset($filtro) && $filtro!="")
        {
            $sql .= " WHERE cod_empresa= ? ";
        }
        $smtm=$conexao->prepare($sql);
        if (isset($filtro) && $filtro!="" )
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