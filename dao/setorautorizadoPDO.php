<?php

# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $GLOBALS['project_path']."model/class/Conexao.class.php";

class SetorAutorizadoPDO
{

    public function __construct(){}
  
    public function busca($id_setaut)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_setores_autorizados ";
            $sql.=" WHERE id_setaut=?  ";
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$id_setaut);
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($setorautorizado)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Usuario               
        * Nota: Se o codigo do Usuario e autoincremento
                */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_setores_autorizados ( ';
            $sql.='`cod_autorizado`,';
            $sql.='`cod_empresa`   ,';
            $sql.='`cod_setor`     )';
            
            $sql.=' VALUES ( ';
            $sql.='?,?,?)';
           
            $smtm=$conexao->prepare($sql);
       
            $smtm->bindValue(1,$setorautorizado->getCodigoAutorizado());
            $smtm->bindValue(2,$setorautorizado->getCodigoEmpresa());
            $smtm->bindValue(3,$setorautorizado->getCodigoSetor());
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


    
    public function delete($id)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_setores_autorizados ";
        $sql.= " WHERE id_setaut=? ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$id);
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT id_setaut CodId,";
        $sql.="      autorizado.cod_autorizado CodAutorizado,nom_autorizado Autorizado,";
        $sql.="      empresa.cod_empresa       CodEmpresa   ,des_empresa    Empresa,   ";
        $sql.="      setor.cod_setor           CodSetor     ,des_setor      Setor      ";
        $sql.=" FROM tb_setores_autorizados setorautorizado ";
        
        $sql.="     inner join tb_empresas empresa on";
        $sql.="           setorautorizado.cod_empresa=empresa.cod_empresa ";
      
        $sql.="     inner join tb_autorizados autorizado on";
        $sql.="           setorautorizado.cod_autorizado=autorizado.cod_autorizado ";
      
        $sql.="     inner join tb_setores    setor on";
        $sql.="           setorautorizado.cod_empresa=setor.cod_empresa AND  ";
        $sql.="           setorautorizado.cod_setor  =setor.cod_setor        ";
        
        
        if (isset($filtro) && $filtro!="")
        {
            $sql.= "and  setorautorizado.cod_autorizado=?";
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

    public function listaEmpresa($autorizado)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT DISTINCT ";
        $sql.="      empresa.cod_empresa       CodEmpresa   ,des_empresa    Empresa   ";
        $sql.=" FROM tb_setores_autorizados setorautorizado ";
        
        $sql.="     inner join tb_empresas empresa on";
        $sql.="           setorautorizado.cod_empresa=empresa.cod_empresa ";
       
        
        if ($autorizado!="")
        {
            $sql.= " WHERE cod_autorizado=?";
            $smtm=$conexao -> prepare($sql);
  
            $smtm->bindValue(1,$autorizado);
      
        }

        else
        {
            $result[0]["CodEmpresa"]="0";
            $result[0]["Empresa"]="=>Selecionar Empresa<=";
            $conexao=null;
            return $result;
        }
    
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }

    public function listaSetor($autorizado,$empresa)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT DISTINCT ";
        $sql.="      setor.cod_setor       CodSetor   ,des_setor    Setor   ";
        $sql.=" FROM tb_setores_autorizados setorautorizado ";
        
        $sql.="     inner join tb_setores setor on";
        $sql.="           setorautorizado.cod_empresa=setor.cod_empresa AND ";
        $sql.="           setorautorizado.cod_setor  =setor.cod_setor        ";
        
       
        
        if ($empresa!="")
        {
            $sql.= " WHERE setorautorizado.cod_autorizado=? AND ";
            $sql.= "       setorautorizado.cod_empresa   =?     ";
            
            $smtm=$conexao -> prepare($sql);
  
            $smtm->bindValue(1,$autorizado);
            $smtm->bindValue(2,$empresa);
      
        }
        else if ($autorizado!="")
        {
            $sql.= " WHERE setorautorizado.cod_autorizado=?";
            $smtm=$conexao -> prepare($sql);
  
            $smtm->bindValue(1,$autorizado);
      
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