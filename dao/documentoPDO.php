<?php


# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $GLOBALS['project_path']."model/class/Conexao.class.php";
include_once $GLOBALS['project_path']."controller/utilitarios.php";


class DocumentoPDO
{

    public function __construct(){}
  
    public function busca($idDocumento)
    {
            
            $conexao=Conexao::getConnection();
            $result=array();
            $sql="SELECT * ";
            $sql.=" FROM tb_documentos ";
            $sql.=" WHERE cod_documento=?  ";
            
            
            $smtm=$conexao->prepare($sql);
            $smtm->bindValue(1,$idDocumento);
            
            $smtm->execute();
            $resultSet=$smtm->fetch(PDO::FETCH_ASSOC);
            $conexao=null;
            return $resultSet ;      
            

    }

    public function insert($documento)
    {
        

        try
        {
            $conexao=Conexao::getConnection();
            $sql='INSERT INTO tb_documentos ( ';
         
            $sql.='`cod_documento`    ,';
            $sql.='`cod_empresa`      ,';
            $sql.='`cod_arquivo`      ,';
            $sql.='`cod_corredor`     ,';
            $sql.='`cod_estante`      ,';
            $sql.='`cod_prateleira`   ,';
            $sql.='`cod_caixa`        ,';
            $sql.='`cod_setor`        ,';
            $sql.='`tip_documento`    ,';
            $sql.='`no_ini_documento` ,';
            $sql.='`no_fin_documento` ,';
            $sql.='`dt_ini_documento` ,';
            $sql.='`dt_fin_documento` ,';
            $sql.='`dt_des_documento` ,';
            $sql.='`cod_status`       ,';
            $sql.='`des_documento`    ,';
            $sql.='`ref_exe_documento`,';
            $sql.='`ref_cal_documento`,';
            $sql.='`id_usu`           ,';
            $sql.='`cod_status_ant`)'   ;
            $sql.=' VALUES ('            ;
            
         
            if ($documento->getIdDocumento()=="00000000000000000")
            {
                $sql.='(SELECT CONCAT("' .$documento->getCodigoEmpresa().'"'. ', ifnull(right(concat("00000000000000000000",CAST(max(documento.cod_documento) AS UNSIGNED)+1),17),"00000000000000001")) from tb_documentos documento where documento.cod_empresa="'.$documento->getCodigoEmpresa().'"),';
                $sql.='?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
                
                $smtm=$conexao->prepare($sql);

                $smtm->bindValue(1,$documento->getCodigoEmpresa());
                $smtm->bindValue(2,$documento->getCodigoArquivo());
                $smtm->bindValue(3,$documento->getCodigoCorredor());
                $smtm->bindValue(4,$documento->getCodigoEstante());
                $smtm->bindValue(5,$documento->getCodigoPrateleira());
                $smtm->bindValue(6,$documento->getCodigoCaixa());
                $smtm->bindValue(7,$documento->getCodigoSetor());
            
                $smtm->bindValue(8,$documento->getTipoDocumento());

                $smtm->bindValue(9,$documento->getNumeroInicial());
                $smtm->bindValue(10,$documento->getNumeroFinal());

                $smtm->bindValue(11,$documento->getDataInicial());
                $smtm->bindValue(12,$documento->getDataFinal());
                $smtm->bindValue(13,$documento->getDataDestruicao());
                $smtm->bindValue(14,$documento->getCodigoStatus());
                $smtm->bindValue(15,$documento->getDescricao());
            

                $smtm->bindValue(16,$documento->getAnoExercicio());
                $smtm->bindValue(17,$documento->getAnoCalendario());
                $smtm->bindValue(18,$documento->getIdUsuario());
                $smtm->bindValue(19,$documento->getCodigoStatus());

            }
            else
            {

                $sql.=' (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
                $smtm=$conexao->prepare($sql);

                $smtm->bindValue(1,$documento->getIdDocumento());
                $smtm->bindValue(2,$documento->getCodigoEmpresa());
                $smtm->bindValue(3,$documento->getCodigoArquivo());
                $smtm->bindValue(4,$documento->getCodigoCorredor());
                $smtm->bindValue(5,$documento->getCodigoEstante());
                $smtm->bindValue(6,$documento->getCodigoPrateleira());
                $smtm->bindValue(7,$documento->getCodigoCaixa());
                $smtm->bindValue(8,$documento->getCodigoSetor());
            
                $smtm->bindValue(9,$documento->getTipoDocumento());

                $smtm->bindValue(10,$documento->getNumeroInicial());
                $smtm->bindValue(11,$documento->getNumeroFinal());

                $smtm->bindValue(12,DateToUsa($documento->getDataInicial()));
                $smtm->bindValue(13,DateToUsa($documento->getDataFinal()));
                $smtm->bindValue(14,DateToUsa($documento->getDataDestruicao()));
                $smtm->bindValue(15,$documento->setCodigoStatus());
                $smtm->bindValue(16,$documento->getDescricao());
            

                $smtm->bindValue(17,$documento->getAnoExercicio());
                $smtm->bindValue(18,$documento->getAnoCalendario());
                $smtm->bindValue(19,$documento->getIdUsuario());
                $smtm->bindValue(20,$documento->getCodigoStatus());
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


    public function update($documento)
    {
        
        $conexao=Conexao::getConnection();
        $sql="UPDATE  tb_documentos SET ";
        $sql.='`cod_empresa`      =?,';
        $sql.='`cod_arquivo`      =?,';
        $sql.='`cod_corredor`     =?,';
        $sql.='`cod_estante`      =?,';
        $sql.='`cod_prateleira`   =?,';
        $sql.='`cod_caixa`        =?,';
        $sql.='`cod_setor`        =?,';
        $sql.='`tip_documento`    =?,';
        $sql.='`no_ini_documento` =?,';
        $sql.='`no_fin_documento` =?,';
        $sql.='`dt_ini_documento` =?,';
        $sql.='`dt_fin_documento` =?,';
        $sql.='`dt_des_documento` =?,';
        $sql.='`des_documento`    =?,';
        $sql.='`ref_exe_documento`=?,';
        $sql.='`ref_cal_documento`=?' ;
               
        $sql.= " WHERE cod_documento=? ";
        
        
        $smtm=$conexao->prepare($sql);
        
        $smtm->bindValue(1,$documento->getCodigoEmpresa());
        $smtm->bindValue(2,$documento->getCodigoArquivo());
        $smtm->bindValue(3,$documento->getCodigoCorredor());
        $smtm->bindValue(4,$documento->getCodigoEstante());
        $smtm->bindValue(5,$documento->getCodigoPrateleira());
        $smtm->bindValue(6,$documento->getCodigoCaixa());
        $smtm->bindValue(7,$documento->getCodigoSetor());
       
        $smtm->bindValue(8,$documento->getTipoDocumento());

        $smtm->bindValue(9,$documento->getNumeroInicial());
        $smtm->bindValue(10,$documento->getNumeroFinal());

        $smtm->bindValue(11,DateToUsa($documento->getDataInicial()));
        $smtm->bindValue(12,DateToUsa($documento->getDataFinal()));
        $smtm->bindValue(13,DateToUsa($documento->getDataDestruicao()));
        $smtm->bindValue(14,$documento->getDescricao());
       

        $smtm->bindValue(15,$documento->getAnoExercicio());
        $smtm->bindValue(16,$documento->getAnoCalendario());
       
        $smtm->bindValue(17,$documento->getIdDocumento());
       
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($codDocumento)
    {
        $conexao=Conexao::getConnection();
        $sql="DELETE  FROM  tb_documentos   ";
        $sql.= "      WHERE cod_documento=? ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codDocumento);
        $result=$smtm->execute();
        ##$conexao->commit();
        $conexao=null;
        return $result;
    }


    public function lista($filtro)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT * " ;  
        $sql.=" FROM view_documentos documento ";
        
        $sql.="WHERE codempresa=?";
        
        if ($filtro['codArquivo']!="")
        {
            $sql.=' AND  codArquivo="'.$filtro['codArquivo'].'"';
        }        

        if ($filtro['codCorredor']!="")
        {
            $sql.=' AND  codCorredor="'.$filtro['codCorredor'].'"';
        }        

        if ($filtro['codEstante']!="")
        {
            $sql.=' AND  codEstante="'.$filtro['codEstante'].'"';
        }        
        
        if ($filtro['codPrateleira']!="")
        {
            $sql.=' AND  codPrateleira="'.$filtro['codPrateleira'].'"';
        }

        if ($filtro['codSetor']!="")
        {
            $sql.=' AND  codSetor="'.$filtro['codSetor'].'"';
        }

        if ($filtro['codCaixa']!="")
        {
            $sql.=' AND  codCaixa="'.$filtro['codCaixa'].'"';
        }

        if ($filtro['exeDocumento']!="")
        {
            $sql.=' AND  AnoExercicio="'.$filtro['exeDocumento'].'"';
        }


        if ($filtro['calDocumento']!="")
        {
            $sql.=' AND  AnoCalendario="'.$filtro['calDocumento'].'"';
        }
        
        if ($filtro['codTipo']!="")
        {
            $sql.=' AND  CodTipo="'.$filtro['codTipo'].'"';
        }

        if ($filtro['codStatus']!="")
        {
            $sql.=' AND  CodStatus="'.$filtro['codStatus'].'"';
        }

        if ($filtro['numDocumento']!="")
        {
            $sql.=' AND ("' . $filtro['numDocumento'] .' " >= NumeroInicialDoc And ';
            $sql.= $filtro['numDocumento'] .' "<= NumeroFinalDoc )' ;
        }

        if ($filtro['emiDocumento']!="")
        {
            $sql.=' AND ("' . $filtro['emiDocumento'] .' " >= DataInicialDoc And ';
            $sql.= $filtro['emoDocumento'] .' "<= DataFinalDoc )' ;
        }

        if ($filtro['texDocumento']!="")
        {
            $sql.= ' AND DescricaoDocumento like "*' . $filtro['texDocumento'] . '"*' ;
        }

        $sql.= " ORDER BY CodCaixa" ;

        $smtm=$conexao -> prepare($sql);

        $smtm->bindValue(1,$filtro['codEmpresa']);
        
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }


}

?>