<?php
/*
* Classe: Prateleira
* Funçao: Acesso as informacoes da Prateleira
* Regras: 
* Tabela: tb_corredores
*/
Class Prateleira
{

    private $codEmpresa;
    private $codArquivo;
    private $codCorredor;
    private $codEstante;
    private $codPrateleira;
    
    private $desPrateleira;
    private $sigPrateleira;
    
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
    
    public function setCodigoPrateleira($codigo)
    {
        $this->codPrateleira=$codigo;
    }
    public function getCodigoPrateleira()
    {
        return $this->codPrateleira;
    }


    public function setDescricao($descricao)
    {
        $this->desPrateleira=$descricao;
    }
    public function getDescricao()
    {
        return $this->desPrateleira;
    }

    public function setSigla($sigla)
    {
        $this->sigPrateleira=$sigla;
    }
    public function getSigla()
    {
        return $this->sigPrateleira;
    }

    
}

?>