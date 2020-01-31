<?php

Class TipoDocumento
{

    private $codEmpresa;
    private $codDocumento;
    private $desDocumento;
    private $sigDocumento;

    public function setCodigoEmpresa($codigo)
    {
        $this->codEmpresa=$codigo;
    }
    public function getCodigoEmpresa()
    {
        return $this->codEmpresa;
    }

    public function setCodigoDocumento($codigo)
    {
        $this->codDocumento=$codigo;
    }
    public function getCodigoDocumento()
    {
        return $this->codDocumento;
    }

    public function setDescricao($descricao)
    {
        $this->desDocumento=$descricao;
    }
    public function getDescricao()
    {
        return $this->desDocumento;
    }

    public function setSigla($sigla)
    {
        $this->sigDocumento=$sigla;
    }
    public function getSigla()
    {
        return $this->sigDocumento;
    }

    
}

?>