<?php

require_once("Conexao_Class.php");

class TipoDocumentoPDO
{

    public function __construct(){}
  
    public function busca($codEmpresa,$codDocumento)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_tipo_documentos   ";
            $sql.=" WHERE cod_empresa  =? and ";
            $sql.="       cod_documento=?     ";
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codDocumento);
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($tipodocumento)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Usuario               
        * Nota: Se o codigo do Usuario e autoincremento
                */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_tipo_documentos ( ';
            $sql.='`cod_empresa`,  ';
            $sql.='`cod_documento`,';
            $sql.='`des_documento`,';
            $sql.='`sig_documento`)';
            
            $sql.=' VALUES ( ';
            if ($tipodocumento->getCodigoDocumento()=="0000")
            {
                $sql.='?,';
                $sql.='(SELECT ifnull(right(concat("0000",max(documento.cod_documento)+1),4),"0001") from tb_tipo_documentos documento ';
                $sql.='where documento.cod_empresa=' . "'". $tipodocumento->getCodigoEmpresa() ."'),";
                $sql.='?,?)';
              
            }
            else
            {
                $sql.='?,?,?,?)';
            }
            
            $smtm=$conexao->prepare($sql);
            if ($tipodocumento->getCodigoDocumento()=="0000")
            { 
                $smtm->bindValue(1,$tipodocumento->getCodigoEmpresa());
                $smtm->bindValue(2,$tipodocumento->getDescricao());
                $smtm->bindValue(3,$tipodocumento->getSigla());
                
            }
            else
            {
                $smtm->bindValue(1,$tipodocumento->getCodigoEmpresa());
                $smtm->bindValue(2,$tipodocumento->getCodigoDocumento());
                $smtm->bindValue(3,$tipodocumento->getDescricao());
                $smtm->bindValue(4,$tipodocumento->getSigla());
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


    public function update($tipodocumento)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_tipo_documentos SET ";
        $sql.='`des_documento`=? ,';
        $sql.='`sig_documento`=? ';

       
        $sql.= " WHERE cod_empresa  =? and ";
        $sql.= "       cod_documento=? ";
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$tipodocumento->getDescricao());
        $smtm->bindValue(2,$tipodocumento->getSigla());
     
        $smtm->bindValue(3,$tipodocumento->getCodigoEmpresa());
        $smtm->bindValue(4,$tipodocumento->getCodigoDocumento());
     
$result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codEmpresa,$codDocumento)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_tipo_documentos ";
        $sql.= " WHERE cod_empresa  =? and ";
        $sql.= "       cod_documento=?  ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codEmpresa);
        $smtm->bindValue(2,$codDocumento);
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT empresa.cod_empresa CodEmpresa,des_empresa Empresa," ;  
        $sql.="     cod_documento CodDocumento,des_documento    Documento, ";
        $sql.="     sig_documento Sigla ";
        
        $sql.=" FROM tb_tipo_documentos documento ";
        $sql.="     inner join tb_empresas empresa on ";
        $sql.="          documento.cod_empresa=empresa.cod_empresa ";
        
        
        if ($filtro!="")
        { 
            $sql.= " WHERE empresa.cod_empresa=?";
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

    public function listaTipoDocumento($codEmpresa,$codDocumento)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT    cod_documento CodTipo,des_documento Tipo ";
        $sql.=" FROM tb_tipo_documentos documento ";
        
        
        if ($codDocumento!="")
        { 
            $sql.= " WHERE documento.cod_empresa  =? and ";
            $sql.= "       documento.cod_documento=?     ";
            
        }
        else
        {
            $sql.= " WHERE documento.cod_empresa=?  ";
            
        }
        $smtm=$conexao -> prepare($sql);
        
        if ($codDocumento!="")
        {
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codDocumento);
            
        }
        else
        {
            $smtm->bindValue(1,$codEmpresa);
            
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }
}

?>