<?php

# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $GLOBALS['project_path']."model/class/Conexao.class.php";

class PrateleiraPDO
{

    public function __construct(){}
  
    public function busca($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_prateleiras ";
            $sql.=" WHERE cod_empresa    =? and ";
            $sql.="       cod_arquivo    =? and ";
            $sql.="       cod_corredor   =? and ";
            $sql.="       cod_estante    =? and ";
            $sql.="       cod_prateleira =?   ";
            
                       
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            $smtm->bindValue(3,$codCorredor);
            $smtm->bindValue(4,$codEstante);
            $smtm->bindValue(5,$codPrateleira);
            
            
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($prateleira)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Estante               
        * Nota: 
        */

        try
        {
            $conexao=Conexao::getConnection();
            $sql ='INSERT INTO tb_prateleiras ( ';
            $sql.='`cod_empresa`,';
            $sql.='`cod_arquivo`,';
            $sql.='`cod_corredor`,';
            $sql.='`cod_estante`,';
            $sql.='`cod_prateleira`,';
            
            $sql.='`des_prateleira`,';
            $sql.='`sig_prateleira`)';
            
            $sql.=' VALUES ( ';
            if ($prateleira->getCodigoPrateleira()=="00")
            {
                $sql.='?,';
                $sql.='?,';
                $sql.='?,';
                $sql.='?,';
                
                $sql.='(SELECT ifnull(right(concat("00",max(prateleira.cod_prateleira)+1),2),"01") from tb_prateleiras prateleira ';
                $sql.=' where prateleira.cod_empresa=' . "'". $prateleira->getCodigoEmpresa()  ."' AND ";
                $sql.='     prateleira.cod_arquivo  =' . "'". $prateleira->getCodigoArquivo()  ."' AND ";
                $sql.='     prateleira.cod_corredor =' . "'". $prateleira->getCodigoCorredor() ."' AND ";
                $sql.='     prateleira.cod_estante  =' . "'". $prateleira->getCodigoEstante()  ."' ),  ";
                
                $sql.='?,?)';
              
            }
            else
            {
                $sql.='?,?,?,?,?,?,?)';
            }
            
            $smtm=$conexao->prepare($sql);
            if ($prateleira->getCodigoPrateleira()=="00")
            { 
                $smtm->bindValue(1,$prateleira->getCodigoEmpresa());
                $smtm->bindValue(2,$prateleira->getCodigoArquivo());
                $smtm->bindValue(3,$prateleira->getCodigoCorredor());
                $smtm->bindValue(4,$prateleira->getCodigoEstante());
                $smtm->bindValue(5,$prateleira->getDescricao());
                $smtm->bindValue(6,$prateleira->getSigla());
            }
            else
            {
                $smtm->bindValue(1,$estante->getCodigoEmpresa());
                $smtm->bindValue(2,$estante->getCodigoArquivo());
                $smtm->bindValue(3,$estante->getCodigoCorredor());
                $smtm->bindValue(4,$estante->getCodigoEstante());
                $smtm->bindValue(5,$estante->getCodigoPrateleira());
                $smtm->bindValue(6,$estante->getDescricao());
                $smtm->bindValue(7,$arquivo->getSigla());
            }  
             
            $result=$smtm->execute();
            
            return $result;
        }
        catch (PDOExecption $e  )
        {
            $mensagem  = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
        }
    }


    public function update($prateleira)
    {
        $conexao=Conexao::getConnection();
        $sql ="UPDATE  tb_prateleiras SET ";
        $sql.='`des_prateleira`=? ,';
        $sql.='`sig_prateleira`=? ';
        
       
        $sql.= " WHERE cod_empresa   =? and ";
        $sql.= "       cod_arquivo   =? and ";
        $sql.= "       cod_corredor  =? and ";
        $sql.= "       cod_estante   =? and ";
        $sql.= "       cod_prateleira=?     ";
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$prateleira->getDescricao());
        $smtm->bindValue(2,$prateleira->getSigla());
        

        $smtm->bindValue(3,$prateleira->getCodigoEmpresa());
        $smtm->bindValue(4,$prateleira->getCodigoArquivo());
        $smtm->bindValue(5,$prateleira->getCodigoCorredor());
        $smtm->bindValue(6,$prateleira->getCodigoEstante());
        $smtm->bindValue(7,$prateleira->getCodigoPrateleira());
       
        
       
        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira)
    {
        $conexao=Conexao::getConnection();
        $sql = "DELETE  FROM  tb_prateleiras ";
        $sql.= " WHERE cod_empresa    =? and ";
        $sql.= "       cod_arquivo    =? and ";
        $sql.= "       cod_corredor   =? and ";
        $sql.= "       cod_estante    =? and ";
        $sql.= "       cod_prateleira =?     ";
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$codEmpresa);
        $smtm->bindValue(2,$codArquivo);
        $smtm->bindValue(3,$codCorredor);
        $smtm->bindValue(4,$codEstante);
        $smtm->bindValue(5,$codPrateleira);
        
       
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();

        $sql ="SELECT   empresa.cod_empresa    CodEmpresa    ,des_empresa     Empresa   ,";
        $sql.="         arquivo.cod_arquivo    CodArquivo    ,des_arquivo     Arquivo   ,";
        $sql.="         corredor.cod_corredor  CodCorredor   ,des_corredor    Corredor  ,";
        $sql.="         estante.cod_estante    CodEstante    ,des_estante     Estante   ,";
        $sql.="         cod_prateleira         CodPrateleira ,des_prateleira  Prateleira,";
        $sql.="         sig_prateleira Sigla ";
        
        $sql.="FROM tb_prateleiras prateleira "; 
             
       
        $sql.="     inner join tb_estantes estante on ";
        $sql.="          prateleira.cod_empresa =estante.cod_empresa  and ";
        $sql.="          prateleira.cod_arquivo =estante.cod_arquivo  and ";
        $sql.="          prateleira.cod_corredor=estante.cod_corredor and ";
        $sql.="          prateleira.cod_estante =estante.cod_estante      ";
       
 
        $sql.="     inner join tb_corredores corredor on ";
        $sql.="          prateleira.cod_empresa =corredor.cod_empresa and ";
        $sql.="          prateleira.cod_arquivo =corredor.cod_arquivo and ";
        $sql.="          prateleira.cod_corredor=corredor.cod_corredor    ";
        
        $sql.="     inner join tb_arquivos arquivo on ";
        $sql.="          prateleira.cod_empresa=arquivo.cod_empresa and ";
        $sql.="          prateleira.cod_arquivo=arquivo.cod_arquivo     ";
      
        $sql.="     inner join tb_empresas empresa on ";
        $sql.="          prateleira.cod_empresa=empresa.cod_empresa ";
        
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


    public function listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql ="SELECT cod_prateleira CodPrateleira,des_prateleira Prateleira ";
        $sql.=" FROM tb_prateleiras ";
        
        $smtm=$conexao -> prepare($sql);
        
        if ($codPrateleira != "" )
        {
            $sql.= " WHERE cod_empresa   =? AND ";
            $sql.= "       cod_arquivo   =? AND ";
            $sql.= "       cod_corredor  =? AND ";
            $sql.= "       cod_estante   =? AND ";
            $sql.= "       cod_prateleira=?     ";
            
            
            $smtm=$conexao->prepare($sql);           
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            $smtm->bindValue(3,$codCorredor);
            $smtm->bindValue(4,$codEstante);
            $smtm->bindValue(5,$codPrateleira);

        }
        elseif ($codEstante != "" )
        {
            
            $sql.= " WHERE cod_empresa   =? AND ";
            $sql.= "       cod_arquivo   =? AND ";
            $sql.= "       cod_corredor  =? AND ";
            $sql.= "       cod_estante   =?     ";
            
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            $smtm->bindValue(3,$codCorredor);
            $smtm->bindValue(4,$codEstante);
        }
        else
        {
            $result[0]["CodPrateleira"]="0";
            $result[0]["Prateleira"]="=>Selecionar Prateleira<=";
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