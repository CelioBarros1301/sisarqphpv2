<?php

# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $GLOBALS['project_path']."model/class/Conexao.class.php";

class EstantePDO
{

    public function __construct(){}
  
    public function busca($codEmpresa,$codArquivo,$codCorredor,$codEstante)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_estantes ";
            $sql.=" WHERE cod_empresa=? and ";
            $sql.="       cod_arquivo=? and ";
            $sql.="       cod_corredor=? and  ";
            $sql.="       cod_estante=?   ";
            
                       
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            $smtm->bindValue(3,$codCorredor);
            $smtm->bindValue(4,$codEstante);
            
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($estante)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Estante               
        * Nota: 
        */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_estantes ( ';
            $sql.='`cod_empresa`,';
            $sql.='`cod_arquivo`,';
            $sql.='`cod_corredor`,';
            $sql.='`cod_estante`,';
            $sql.='`des_estante`,';
            $sql.='`sig_estante`)';
            
            $sql.=' VALUES ( ';
            if ($estante->getCodigoEstante()=="000")
            {
                $sql.='?,';
                $sql.='?,';
                $sql.='?,';
                
                $sql.='(SELECT ifnull(right(concat("000",max(estante.cod_estante)+1),3),"001") from tb_estantes estante';
                $sql.=' where estante.cod_empresa =' . "'". $estante->getCodigoEmpresa()  . "' AND ";
                $sql.='       estante.cod_arquivo =' . "'". $estante->getCodigoArquivo()  . "' AND ";
                $sql.='       estante.cod_corredor=' . "'". $estante->getCodigoCorredor() . "'   ),";
                
                $sql.='?,?)';
              
            }
            else
            {
                $sql.='?,?,?,?,?,?)';
            }
            
            $smtm=$conexao->prepare($sql);
            if ($estante->getCodigoEstante()=="000")
            { 
                $smtm->bindValue(1,$estante->getCodigoEmpresa());
                $smtm->bindValue(2,$estante->getCodigoArquivo());
                $smtm->bindValue(3,$estante->getCodigoCorredor());
                $smtm->bindValue(4,$estante->getDescricao());
                $smtm->bindValue(5,$estante->getSigla());
            }
            else
            {
                $smtm->bindValue(1,$estante->getCodigoEmpresa());
                $smtm->bindValue(2,$estante->getCodigoArquivo());
                $smtm->bindValue(3,$estante->getCodigoCorredor());
                $smtm->bindValue(4,$estante->getCodigoEstante());
                $smtm->bindValue(5,$estante->getDescricao());
                $smtm->bindValue(6,$estante->getSigla());
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


    public function update($estante)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_estantes SET ";
        $sql.='`des_estante`=? ,';
        $sql.='`sig_estante`=? ';
        
       
        $sql.= " WHERE cod_empresa=? and ";
        $sql.= "       cod_arquivo=? and ";
        $sql.= "       cod_corredor=? and ";
        $sql.= "       cod_estante=?  ";
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$estante->getDescricao());
        $smtm->bindValue(2,$estante->getSigla());
        

        $smtm->bindValue(3,$estante->getCodigoEmpresa());
        $smtm->bindValue(4,$estante->getCodigoArquivo());
        $smtm->bindValue(5,$estante->getCodigoCorredor());
        $smtm->bindValue(6,$estante->getCodigoEstante());
       
        
       
        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codEmpresa,$codArquivo,$codCorredor,$codEstante)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_estantes ";
        $sql.= " WHERE cod_empresa =? and ";
        $sql.= "       cod_arquivo =? and ";
        $sql.= "       cod_corredor=? and ";
        $sql.= "       cod_estante =?     ";
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$codEmpresa);
        $smtm->bindValue(2,$codArquivo);
        $smtm->bindValue(3,$codCorredor);
        $smtm->bindValue(4,$codEstante);
       
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();

        $sql="SELECT    empresa.cod_empresa    CodEmpresa ,des_empresa  Empresa , ";
        $sql.="         arquivo.cod_arquivo    CodArquivo ,des_arquivo  Arquivo , ";
        $sql.="         corredor.cod_corredor  CodCorredor,des_corredor Corredor, ";
        $sql.="         cod_estante            CodEstante ,des_estante  Estante , ";
        $sql.="         sig_estante Sigla ";
        
        $sql.="FROM tb_estantes estante "; 
             
        $sql.="     inner join tb_corredores corredor on ";
        $sql.="          estante.cod_empresa =corredor.cod_empresa and ";
        $sql.="          estante.cod_arquivo =corredor.cod_arquivo and ";
        $sql.="          estante.cod_corredor=corredor.cod_corredor  ";
        
        $sql.="     inner join tb_arquivos arquivo on ";
        $sql.="          estante.cod_empresa=arquivo.cod_empresa and ";
        $sql.="          estante.cod_arquivo=arquivo.cod_arquivo ";
      
        $sql.="     inner join tb_empresas empresa on ";
        $sql.="          estante.cod_empresa=empresa.cod_empresa ";
        
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

    public function listaEstante($codEmpresa,$codArquivo,$codCorredor,$codEstante)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT  cod_estante   CodEstante ,des_estante  Estante ";
        $sql.="       FROM tb_estantes ";
        
        $smtm=$conexao -> prepare($sql);
        
        if ($codEstante != "" )
        {
            $sql.= " WHERE cod_empresa =?  AND ";
            $sql.= "       cod_arquivo =?  AND ";
            $sql.= "       cod_corredor=?  AND ";
            $sql.= "       cod_estante =?      ";
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            $smtm->bindValue(3,$codCorredor);
            $smtm->bindValue(4,$codEstante);
            
            
        }
        else if  ($codCorredor != "" )
        {
            $sql.= " WHERE cod_empresa =?  AND ";
            $sql.= "       cod_arquivo =?  AND ";
            $sql.= "       cod_corredor=?      ";
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            $smtm->bindValue(3,$codCorredor);
            
            
        }
        else if ($codArquivo != "" )
        {
        
            $sql.= " WHERE cod_empresa =?  AND ";
            $sql.= "       cod_arquivo =?      ";
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            
            
        } 
        else
        {
            $result[0]["CodEstante"]="0";
            $result[0]["Estante"]="=>Selecionar Estante<=";
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