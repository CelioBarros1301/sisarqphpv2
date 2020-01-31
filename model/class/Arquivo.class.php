<?php


Class Arquivo
{

    private $codEmpresa;
    private $codArquivo;
    private $desArquivo;
    
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

    public function setDescricao($descricao)
    {
        $this->desArquivo=$descricao;
    }
    public function getDescricao()
    {
        return $this->desArquivo;
    }

    
}

?>