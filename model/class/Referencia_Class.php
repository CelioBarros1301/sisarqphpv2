<?php
/*
* Classe: Prateleira
* Funçao: Acesso as informacoes da Prateleira
* Regras: 
* Tabela: tb_referencia
*/
Class Referencia
{

    private $codEmpresa;
    private $idDocumento;
    
    
    public function setIdDocumento($codigo)
    {
        $this->idDocumento=$codigo;
    }
    public function getIdDocumento()
    {
        return $this->idDocumento;
    }

    public function setCodigoEmpresa($codigo)
    {
        $this->codEmpresa=$codigo;
    }
    public function getCodigoEmpresa()
    {
        return $this->codEmpresa;
    }

   
    
}

?>