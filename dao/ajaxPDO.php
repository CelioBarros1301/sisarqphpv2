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
        $sql ="SELECT '0' CodSetor,'=>Selecionar Setor<='  Setor ";
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

            if ( $key=='0' )
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
        
        var_dump($sql);
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

}
?>
    