<?php


# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $GLOBALS['project_path']."model/class/Conexao.class.php";


class ajaxPDO
{

    public function __construct(){}

    # Ajax Preencher como de Setor
    public function listaSetor($codEmpresa,$codSetor)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql ="SELECT '' CodSetor,'=>Selecionar Setor<='  Setor ";
        $sql.="UNION ALL ";
    
        $sql.="SELECT cod_setor CodSetor,des_setor Setor ";
        $sql.=" FROM tb_setores ";
        $smtm=$conexao -> prepare($sql);

        if ($codSetor != "" )
        {
            $sql.= " WHERE cod_empresa=? AND ";
            $sql.= "       cod_setor  =?     ";
            $sql.="ORDER BY Setor";
     
            $smtm=$conexao->prepare($sql);

            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codSetor);
        }
        elseif ($codEmpresa != "" )
        {

            $sql.= " WHERE cod_empresa=?  ";
            $sql.="ORDER BY Setor";
            $smtm=$conexao->prepare($sql);

            $smtm->bindValue(1,$codEmpresa);
        }
        $smtm->execute();
      
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;

        $html="";
        foreach ($result as $key=>$coluna){

            if ( $key=='' )
            {
                $html.='<option  disabled selected value="'. $coluna["CodSetor"] .'">' .$coluna["Setor"] ."</option>";                     
            }
            else
            {
                $html.='<option  value="'. $coluna["CodSetor"] .'">' .$coluna["Setor"] ."</option>";                     
            }
        }
        return $html;
    }

    # Ajax Preencher como de Setor
    public function listaMenu($codUsuario)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql ="SELECT acesso.id_menu_usuario CodAcesso , ";
        $sql.="       menu.id_menu          CodMenu    , ";
        
        $sql.="       menu.seq_menu          Sequencia , " ;
        $sql.="       nome_menu              Opcao     , " ;
        $sql.="       acesso.sta_menu        Menu      , " ;
        $sql.="       acesso.sta_inc         Incluir   , " ;
        $sql.="       acesso.sta_alt         Alterar   , " ;
        $sql.="       acesso.sta_con         Consultar , " ;
        $sql.="       acesso.sta_exc         Excluir   , " ;
        $sql.="       acesso.sta_rel         Relatorio  "  ;
        
        $sql.=" FROM tb_menus menu   ";
        
        $sql.="      left join tb_menu_usuarios acesso on ";
        $sql.="            menu.id_menu  = acesso.id_menu ";
        $sql.="            and  acesso.id_usu=?";

        $sql.=" WHERE acesso.id_menu_usuario IS NULL ";
        
        $smtm=$conexao->prepare($sql);
        $smtm->bindValue(1,$codUsuario);
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
   
        $html="";
        foreach ($result as $key=>$coluna)
        {

            $html.='<option   value="'. $coluna["CodMenu"] .'">' .$coluna["Sequencia"]."-".$coluna["Opcao"] ."</option>";                     
        }
   
         return $html;
   
    }


    # Ajax Preencher combo de Arquivo
   
    public function listaArquivo($codEmpresa,$codArquivo)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql ="SELECT '' CodArquivo,'=>Selecionar Arquivo<='  Arquivo ";
        $sql.="UNION ALL ";
    
        $sql.="SELECT    cod_arquivo CodArquivo,des_arquivo Arquivo ";
        $sql.=" FROM tb_arquivos arquivo ";
        
        
        if ($codArquivo!="")
        { 
            $sql.= " WHERE arquivo.cod_empresa=? and ";
            $sql.= "       arquivo.cod_arquivo=?     ";
            $sql.= " ORDER BY Arquivo";
            
        }
        else if($codEmpresa!="")
        {
            $sql.= " WHERE arquivo.cod_empresa=?  ";
            $sql.= " ORDER BY Arquivo";
                   
        }
        var_dump($sql);        
        $smtm=$conexao -> prepare($sql);
        
        if ($codArquivo!="")
        {
            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codArquivo);
            
        }
        else
        {
            $smtm->bindValue(1,$codEmpresa);
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
       
        $conexao=null;
        $html="";
        foreach ($result as $key=>$coluna){

            if ( $key=='' )
            {
                $html.='<option  disabled selected value="'. $coluna["CodArquivo"] .'">' .$coluna["Arquivo"] ."</option>";                     
            }
            else
            {
                $html.='<option  value="'. $coluna["CodArquivo"] .'">' .$coluna["Arquivo"] ."</option>";                     
            }
        }
        return $html;

    }


    # Ajax Preencher combo de Corredor
   

    public function listaCorredor($codEmpresa,$codArquivo,$codCorredor)
    {
        $conexao=Conexao::getConnection();
        $result=array();
   
        $sql ="SELECT '' CodCorredor,'=>Selecionar Corredor<='  Corredor ";
        $sql.="UNION ALL ";
        
        $sql.="SELECT cod_corredor  CodCorredor,des_corredor Corredor ";
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
       
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;

        $html="";
        foreach ($result as $key=>$coluna){

            if ( $key=='' )
            {
                $html.='<option  disabled selected value="'. $coluna["CodCorredor"] .'">' .$coluna["Corredor"] ."</option>";                     
            }
            else
            {
                $html.='<option  value="'. $coluna["CodCorredor"] .'">' .$coluna["Corredor"] ."</option>";                     
            }
        }
        return $html;

    }

    # Ajax Preencher combo de Estante
   

    public function listaEstante($codEmpresa,$codArquivo,$codCorredor,$codEstante)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql ="SELECT '' CodEstante,'=>Selecionar Estante<='  Estante ";
        $sql.="UNION ALL ";
        
         
        $sql.="SELECT  cod_estante   CodEstante ,des_estante  Estante ";
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
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        $html="";
        foreach ($result as $key=>$coluna){

            if ( $key=='' )
            {
                $html.='<option  disabled selected value="'. $coluna["CodEstante"] .'">' .$coluna["Estante"] ."</option>";                     
            }
            else
            {
                $html.='<option  value="'. $coluna["CodEstante"] .'">' .$coluna["Estante"] ."</option>";                     
            }
        }
        return $html;
    }

    # Ajax Preencher combo de Estante
    
    public function listaEmpresa($autorizado,$empresa)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql ="SELECT '' CodEmpresa,'=>Selecionar Empresa<='  Empresa ";
        $sql.="UNION ALL ";
       
        $sql.="SELECT DISTINCT ";
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
        elseif ($codEmpresa != "" )
        {
            $sql.= " WHERE cod_autorizado=? AND ";
            $sql.= "       cod_empresa =?";
            
            $smtm=$conexao -> prepare($sql);
  
            $smtm->bindValue(1,$autorizado);
            $smtm->bindValue(2,$empresa);
            
       }
    
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;

        $html="";
        foreach ($result as $key=>$coluna){

            if ( $key=='' )
            {
                $html.='<option  disabled selected value="'. $coluna["CodEmpresa"] .'">' .$coluna["Empresa"] ."</option>";                     
            }
            else
            {
                $html.='<option  value="'. $coluna["CodEmpresa"] .'">' .$coluna["Empresa"] ."</option>";                     
            }
        }
        return $html;

    }


    # Ajax Preencher combo de Prateleira
   

    public function listaPrateleira($codEmpresa,$codArquivo,$codCorredor,$codEstante,$codPrateleira)
    {
       
        $conexao=Conexao::getConnection();
        $result=array();
        $sql ="SELECT '' CodPrateleira,'=>Selecionar Prateleira<='  Prateleira ";
        $sql.="UNION ALL ";
       
        $sql.="SELECT cod_prateleira CodPrateleira,des_prateleira Prateleira ";
        $sql.=" FROM tb_prateleiras ";
        
        
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
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;

        $html="";
        foreach ($result as $key=>$coluna){

            if ( $key=='' )
            {
                $html.='<option  disabled selected value="'. $coluna["CodPrateleira"] .'">' .$coluna["Prateleira"] ."</option>";                     
            }
            else
            {
                $html.='<option  value="'. $coluna["CodPrateleira"] .'">' .$coluna["Prateleira"] ."</option>";                     
            }
        }
        return $html;

    }


    # Ajax Preencher combo de Caixa
  

    public function listaCaixa($codEmpresa,$codSetor,$codCaixa)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        
        $sql ="SELECT '' CodCaixa,'=>Selecionar Caixa<='  Caixa ";
        $sql.="UNION ALL ";
       
        $sql.="SELECT  cod_caixa  CodCaixa   ,des_caixa  Caixa  ";
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
     
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;

        $html="";
        foreach ($result as $key=>$coluna){

            if ( $key=='' )
            {
                $html.='<option  disabled selected value="'. $coluna["CodCaixa"] .'">' .$coluna["Caixa"] ."</option>";                     
            }
            else
            {
                $html.='<option  value="'. $coluna["CodCaixa"] .'">' .$coluna["Caixa"] ."</option>";                     
            }
        }
        return $html;
    }


    # Ajax Preencher combo de Tipo Documento
  
    public function listaTipoDocumento($codEmpresa,$codDocumento)
    {
        $conexao=Conexao::getConnection();
        $result =array();
        $sql ="SELECT '' CodTipo,'=>Selecionar Tipo<='  Tipo ";
        $sql.="UNION ALL ";
        $sql.="SELECT    cod_documento CodTipo,des_documento Tipo ";
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
        $result =$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        $html="";
        foreach ($result as $key=>$coluna){

            if ( $key=='' )
            {
                $html.='<option  disabled selected value="'. $coluna["CodTipo"] .'">' .$coluna["Tipo"] ."</option>";                     
            }
            else
            {
                $html.='<option  value="'. $coluna["CodTipo"] .'">' .$coluna["Tipo"] ."</option>";                     
            }
        }
        return $html;
    }


}
?>
    