<?php

Class Caixa
{

    private $codEmpresa;
    private $codSetor;
    private $codCaixa;
    private $desCaixa;
    
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

    public function setCodigoCaixa($codigo)
    {
        $this->codCaixa=$codigo;
    }
    public function getCodigoCaixa()
    {
        return $this->codCaixa;
    }

    public function setDescricao($descricao)
    {
        $this->desCaixa=$descricao;
    }
    public function getDescricao()
    {
        return $this->desCaixa;
    }

    

    
}

?>