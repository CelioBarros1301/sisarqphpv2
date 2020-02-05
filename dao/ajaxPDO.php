<?php


# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $GLOBALS['project_path']."model/class/Conexao.class.php";


class ajaxPDO
{

    public function __construct(){}

    
    public function listaSetor($codEmpresa,$codSetor)
    {
        $conexao=Conexao::getConnection();
        $result=array();
        $sql="SELECT cod_setor CodSetor,des_setor Setor ";
        $sql.=" FROM tb_setores ";

        $smtm=$conexao -> prepare($sql);

        if ($codSetor != "" )
        {
            $sql.= " WHERE cod_empresa=? AND ";
            $sql.= "       cod_setor  =?     ";
            $smtm=$conexao->prepare($sql);

            $smtm->bindValue(1,$codEmpresa);
            $smtm->bindValue(2,$codSetor);
        }
        elseif ($codEmpresa != "" )
        {

            $sql.= " WHERE cod_empresa=?  ";
            $smtm=$conexao->prepare($sql);

            $smtm->bindValue(1,$codEmpresa);
        }
        else
        {
            $result[0]["CodSetor"]="0";
            $result[0]["Setor"]   ="=>Selecionar Setor<=";
            $conexao=null;
            return $result;
        }
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;

        $html="";
        foreach ($result as $coluna){
            $html.='<option  value="'. $coluna["CodSetor"] .'">' .$coluna["Setor"] ."</option>";                     
        
        }
        return $html;
    }

}
?>
    