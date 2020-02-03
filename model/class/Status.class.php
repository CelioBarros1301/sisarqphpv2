<?php

Class Status
{

    private $codStatus;
    private $desStatus;
    private $tipStatus;
    
    public function setCodigoStatus($codigo)
    {
        $this->codStatus=$codigo;
    }
    public function getCodigoStatus()
    {
        return $this->codStatus;
    }

   
    public function setDescricao($descricao)
    {
        $this->desStatus=$descricao;
    }
    public function getDescricao()
    {
        return $this->desStatus;
    }


    public function setTipoStatus($codigo)
    {
        $this->tipStatus=$codigo;
    }
    public function getTipoStatus()
    {
        return $this->tipStatus;
    }
    
}

?>