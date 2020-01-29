<?php

require_once("Conexao_Class.php");

class CaixaPDO
{

    public function __construct(){}
  
    public function busca($codEmpresa,$codSetor,$codCaixa)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_caixas ";
            $sql.=" WHERE cod_empresa =? and ";
            $sql.="       cod_setor   =? and ";
            $sql.="       cod_caixa   =?  ";
            
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codSetor);
            $smtm->bindValue(3,$codCaixa);
            
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }
    
    public function insert($caixa)
    {
        /*
        * Objeto: Incluir Usuario
        * Parametros: $usuario-> Objeto Corredoro               
        * Nota: 
        */

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_caixas ( ';
            $sql.='`cod_empresa`,';
            $sql.='`cod_setor`,';
            $sql.='`cod_caixa`,';
            $sql.='`des_caixa`)';
            
            $sql.=' VALUES ( ';
            if ($caixa->getCodigoCaixa()=="00000")
            {
                $sql.='?,';
                $sql.='?,';
                
                $sql.='(SELECT ifnull(right(concat("00000",max(caixa.cod_caixa)+1),5),"00001") from tb_caixas caixa';
                $sql.=' where caixa.cod_empresa=' . "'". $caixa->getCodigoEmpresa() ."' AND ";
                $sql.='       caixa.cod_setor  =' . "'". $caixa->getCodigoSetor()   ."'   ),";
                
                $sql.='?)';
              
            }
            else
            {
                $sql.='?,?,?,?)';
            }
            
            $smtm=$conexao->prepare($sql);
            if ($caixa->getCodigoCaixa()=="00000")
            { 
                $smtm->bindValue(1,$caixa->getCodigoEmpresa());
                $smtm->bindValue(2,$caixa->getCodigoSetor());
                $smtm->bindValue(3,$caixa->getDescricao());
            }
            else
            {
                $smtm->bindValue(1,$caixa->getCodigoEmpresa());
                $smtm->bindValue(2,$caixa->getCodigoSetor());
                $smtm->bindValue(3,$caixa->getCodigoCaixa());
                $smtm->bindValue(4,$caixa->getDescricao());
               
            
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


    public function update($caixa)
    {
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_caixas SET ";
        $sql.='`des_caixa`=? ';
        
       
        $sql.= " WHERE cod_empresa =? and ";
        $sql.= "       cod_setor   =? and ";
        $sql.= "       cod_caixa   =?     ";
        
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$caixa->getDescricao());
       
        $smtm->bindValue(2,$caixa->getCodigoEmpresa());
        $smtm->bindValue(3,$caixa->getCodigoSetor());
        $smtm->bindValue(4,$caixa->getCodigoCaixa());
        

        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codEmpresa,$codSetor,$codCaixa)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_caixas ";
        $sql.= " WHERE cod_empresa =? and ";
        $sql.= "       cod_setor   =? and ";
        $sql.= "       cod_caixa   =?     ";
        
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codEmpresa);
        $smtm->bindValue(2,$codSetor);
        $smtm->bindValue(3,$codCaixa);
        
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();

        $sql="SELECT    empresa.cod_empresa CodEmpresa ,des_empresa  Empresa  ,";
        $sql.="         setor.cod_setor     CodSetor   ,des_setor    Setor    ,";
        $sql.="         cod_caixa           CodCaixa   ,des_caixa    Caixa    ";
        
        $sql.="FROM tb_caixas caixa "; 
             
        $sql.="     inner join tb_setores setor on ";
        $sql.="          caixa.cod_empresa =setor.cod_empresa and ";
        $sql.="          caixa.cod_setor   =setor.cod_setor ";
        $sql.="     inner join tb_empresas empresa on ";
        $sql.="          caixa.cod_empresa=empresa.cod_empresa ";
        
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


    public function listaCaixa($codEmpresa,$codSetor,$codCaixa)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT  cod_caixa  CodCaixa   ,des_caixa  Caixa  ";
        $sql.=" FROM tb_caixas ";
        
        $smtm=$conexao -> prepare($sql);
        
        if ($codCaixa != "" )
        {
            $sql.= " WHERE cod_empresa =?  AND ";
            $sql.= "       cod_setor   =?  AND ";
            $sql.= "       cod_caixa   =?      ";
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codSetor);
            $smtm->bindValue(3,$codCaixa);
            
        }
        elseif ($codSetor != "" )
        {
        
            $sql.= " WHERE cod_empresa=? AND ";
            $sql.= "       cod_setor  =?     ";
            
            $smtm=$conexao->prepare($sql);
            
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codSetor);
            
        }
        else
        {
            $result[0]["CodCaixa"]="0";
            $result[0]["Caixa"]="=>Selecionar Caixa<=";
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