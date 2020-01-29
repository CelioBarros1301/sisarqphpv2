<?php
/*
* Classe: Arquivo
* Funçao: Acesso as informacoes do Corredores 
* Regras: 
* Tabela: tb_corredores
*/
Class Corredor
{

    private $codEmpresa;
    private $codArquivo;
    private $codCorredor;
    private $desCorredor;
    private $sigCorredor;
    
    public function setCodigoEmpresa($codigo)
    {
        $this->codEmpresa=$codigo;
    }
    public function getCodigoEmpresa()
    {
        return $this->codEmpresa;
    }

    public function setCodigoArquivo($codigo)
    {
        $this->codArquivo=$codigo;
    }
    public function getCodigoArquivo()
    {
        return $this->codArquivo;
    }

    public function setCodigoCorredor($codigo)
    {
        $this->codCorredor=$codigo;
    }
    public function getCodigoCorredor()
    {
        return $this->codCorredor;
    }

    public function setDescricao($descricao)
    {
        $this->desCorredor=$descricao;
    }
    public function getDescricao()
    {
        return $this->desCorredor;
    }

    public function setSigla($sigla)
    {
        $this->sigCorredor=$sigla;
    }
    public function getSigla()
    {
        return $this->sigCorredor;
    }

    
}

?>