<?php
/*
* Classe: Prateleira
* Funçao: Acesso as informacoes da Prateleira
* Regras: 
* Tabela: tb_corredores
*/
Class Menu
{

    private $idMenu;
    private $seqMenu;
    private $nomeMenu;
    private $iconeMenu;
    private $hrefMenu;
    private $tipoMenu;
    private $statPro;
    
    
    
    public function setIdMenu($codigo)
    {
        $this->idMenu=$codigo;
    }
    public function getIdMenu()
    {
        return $this->idMenu;
    }


    public function setSeqMenu($codigo)
    {
        $this->seqMenu=$codigo;
    }
    public function getSeqMenu()
    {
        return $this->seqMenu;
    }
    

    public function setNomeMenu($codigo)
    {
        $this->nomeMenu=$codigo;
    }
    public function getNomeenu()
    {
        return $this->nomeMenu;
    }


    public function setIconeMenu($codigo)
    {
        $this->iconeMenu=$codigo;
    }
    public function getIconeMenu()
    {
        return $this->iconeMenu;
    }


    public function setHrefMenu($codigo)
    {
        $this->hrefMenu=$codigo;
    }
    public function getHrefMenu()
    {
        return $this->hrefMenu;
    }


    public function setTipoMenu($codigo)
    {
        $this->tipoMenu=$codigo;
    }
    public function getTipoMenu()
    {
        return $this->tipoMenu;
    }

  
    public function setStatPro($codigo)
    {
        $this->statPro=$codigo;
    }
    public function getStatPro()
    {
        return $this->statPro;
    }


}

?>