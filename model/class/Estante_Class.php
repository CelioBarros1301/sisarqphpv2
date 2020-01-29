<?php
/*
* Classe: Estante
* Funçao: Acesso as informacoes do Estantes
* Regras: 
* Tabela: tb_corredores
*/
Class Estante
{

    private $codEmpresa;
    private $codArquivo;
    private $codCorredor;
    private $codEstante;
    private $desEstante;
    private $sigEstante;
    
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

    public function setCodigoEstante($codigo)
    {
        $this->codEstante=$codigo;
    }
    public function getCodigoEstante()
    {
        return $this->codEstante;
    }
    
    public function setDescricao($descricao)
    {
        $this->desEstante=$descricao;
    }
    public function getDescricao()
    {
        return $this->desEstante;
    }

    public function setSigla($sigla)
    {
        $this->sigEstante=$sigla;
    }
    public function getSigla()
    {
        return $this->sigEstante;
    }

    
}

?>