<?php
/*
* Classe: Arquivo
* Funçao: Acesso as informacoes do Arquivo 
* Regras: 
* Tabela: tb_arquivos
*/
Class Setor
{

    private $codEmpresa;
    private $codSetor;
    private $desSetor;
    
    public function setCodigoEmpresa($codigo)
    {
        $this->codEmpresa=$codigo;
    }
    public function getCodigoEmpresa()
    {
        return $this->codEmpresa;
    }

    public function setCodigoSetor($codigo)
    {
        $this->codSetor=$codigo;
    }
    public function getCodigoSetor()
    {
        return $this->codSetor;
    }

    public function setDescricao($descricao)
    {
        $this->desSetor=$descricao;
    }
    public function getDescricao()
    {
        return $this->desSetor;
    }

    
}

?>