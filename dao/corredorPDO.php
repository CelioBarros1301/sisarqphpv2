<?php

require_once("Conexao_Class.php");

class CorredorPDO
{

    public function __construct(){}
  
    public function busca($codEmpresa,$codArquivo,$codCorredor)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_corredores ";
            $sql.=" WHERE cod_empresa =? and ";
            $sql.="       cod_arquivo =? and ";
            $sql.="       cod_corredor=?  ";
            
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            $smtm->bindValue(3,$codCorredor);
            
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($corredor)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Corredoro               
        * Nota: 
        */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_corredores ( ';
            $sql.='`cod_empresa`,';
            $sql.='`cod_arquivo`,';
            $sql.='`cod_corredor`,';
            $sql.='`des_corredor`,';
            $sql.='`sig_corredor`)';
            
            $sql.=' VALUES ( ';
            if ($corredor->getCodigoCorredor()=="000")
            {
                $sql.='?,';
                $sql.='?,';
                
                $sql.='(SELECT ifnull(right(concat("000",max(corredor.cod_corredor)+1),3),"001") from tb_corredores corredor';
                $sql.=' where corredor.cod_empresa=' . "'". $corredor->getCodigoEmpresa() ."' AND ";
                $sql.='       corredor.cod_arquivo=' . "'". $corredor->getCodigoArquivo() ."'    ),";
                $sql.='?,?)';
              
            }
            else
            {
                $sql.='?,?,?,?,?)';
            }
            
            $smtm=$conexao->prepare($sql);
            if ($corredor->getCodigoCorredor()=="000")
            { 
                $smtm->bindValue(1,$corredor->getCodigoEmpresa());
                $smtm->bindValue(2,$corredor->getCodigoArquivo());
                $smtm->bindValue(3,$corredor->getDescricao());
                $smtm->bindValue(4,$corredor->getSigla());
            }
            else
            {
                $smtm->bindValue(1,$corredor->getCodigoEmpresa());
                $smtm->bindValue(2,$corredor->getCodigoArquivo());
                $smtm->bindValue(3,$corredor->getCodigoCorredor());
                $smtm->bindValue(4,$corredor->getDescricao());
                $smtm->bindValue(5,$corredor->getSigla());
               
             
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


    public function update($corredor)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_corredores SET ";
        $sql.='`des_corredor`=? ,';
        $sql.='`sig_corredor`=? ';
        
       
        $sql.= " WHERE cod_empresa =? and ";
        $sql.= "       cod_arquivo =? and ";
        $sql.= "       cod_corredor=? ";
        
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$corredor->getDescricao());
        $smtm->bindValue(2,$corredor->getSigla());
       
        $smtm->bindValue(3,$corredor->getCodigoEmpresa());
        $smtm->bindValue(4,$corredor->getCodigoArquivo());
        $smtm->bindValue(5,$corredor->getCodigoCorredor());
        

        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codEmpresa,$codArquivo,$codCorredor)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_corredores ";
        $sql.= " WHERE cod_empresa =? and ";
        $sql.= "       cod_arquivo =? and  ";
        $sql.= "       cod_corredor=?  ";
        
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codEmpresa);
        $smtm->bindValue(2,$codArquivo);
        $smtm->bindValue(3,$codCorredor);
        
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();

        $sql="SELECT    empresa.cod_empresa CodEmpresa ,des_empresa  Empresa,";
        $sql.="         arquivo.cod_arquivo CodArquivo ,des_arquivo  Descricao,";
        $sql.="         cod_corredor        CodCorredor,des_corredor Corredor, ";
        $sql.="         sig_corredor Sigla ";
        
        $sql.="FROM tb_corredores corredor "; 
             
        $sql.="     inner join tb_arquivos arquivo on ";
        $sql.="          corredor.cod_empresa=arquivo.cod_empresa and ";
        $sql.="          corredor.cod_arquivo=arquivo.cod_arquivo ";
        $sql.="     inner join tb_empresas empresa on ";
        $sql.="          corredor.cod_empresa=empresa.cod_empresa ";
        
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


    public function listaCorredor($codEmpresa,$codArquivo,$codCorredor)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT cod_corredor  CodCorredor,des_corredor Corredor ";
        $sql.=" FROM tb_corredores ";
        
        
        if ($codCorredor != "" )
        {
            $sql.= " WHERE cod_empresa =?  AND ";
            $sql.= "       cod_arquivo =?  AND ";
            $sql.= "       cod_corredor=?  ";
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            $smtm->bindValue(3,$codCorredor);
            
        }
        else if($codArquivo!="")
        {
        
            $sql.= " WHERE cod_empresa=?  AND ";
            $sql.= "       cod_arquivo=?      ";
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
           
        }
        else
        {
            $result[0]["CodCorredor"]="0";
            $result[0]["Corredor"]="=>Selecionar Corredor<=";
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