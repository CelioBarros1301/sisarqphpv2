<?php

# Limpando o cache
ob_start();

# Incluindo os arquivos Necessários
include_once dirname(__DIR__)."/model/config.php";
include_once $GLOBALS['project_path']."model/class/Conexao.class.php";

class ComandoSQLPDO
{

    public function __construct(){}
      

    public function insert($comando)
    {
        

        try
        {
            $conexao=Conexao::getConnection();
            $sql= $comando;
         
            $smtm=$conexao->prepare($sql);

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


    public function update($comando)
    {
        
        $conexao=Conexao::getConnection();
        $sql=$comando;
        $smtm=$conexao->prepare($sql);
        
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }

    public function delete($comando)
    {
        $conexao=Conexao::getConnection();
        $sql=$comando;
        $smtm=$conexao->prepare($sql);
        $result=$smtm->execute();
        $conexao=null;
        return $result;
    }


    public function select($comando)
    {
        $conexao=Conexao::getConnection();
        $sql=$comando;
        $smtm=$conexao -> prepare($sql);
    
        $smtm->execute();
        $result=$smtm->fetchAll(PDO::FETCH_ASSOC);
        $conexao=null;
        return  $result;
    }


}
?>