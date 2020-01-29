<?php
/*
* Classe: Prateleira
* Funçao: Acesso as informacoes da Prateleira
* Regras: 
* Tabela: tb_corredores
*/
Class AcessoMenu
{

    private $idAcesso       ;
    
    private $idMenu         ;
    private $idUsuario      ;
    private $statusMenu     ;
    private $statusIncluir  ;
    private $statusAlterar  ;
    private $statusConsultar;
    private $statusExcluir  ;
    private $statusRelatorio;
    
    
    
    public function setIdAcesso($codigo)
    {
        $this->idAcesso=$codigo;
    }
    public function getIdAcesso()
    {
        return $this->idAcesso;
    }

    public function setIdMenu($codigo)
    {
        $this->idMenu=$codigo;
    }
    public function getIdMenu()
    {
        return $this->idMenu;
    }

    public function setIdUsuario($codigo)
    {
        $this->idUsuario=$codigo;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setStatusMenu($codigo)
    {
        $this->statusMenu=$codigo;
    }
    public function getStatusMenu()
    {
        return $this->statusMenu;
    }

    public function setStatusIncluir($codigo)
    {
        $this->statusIncluir=$codigo;
    }
    public function getStatusIncluir()
    {
        return $this->statusIncluir;
    }

    public function setStatusAlterar($codigo)
    {
        $this->statusAlterar=$codigo;
    }
    public function getStatusAlterar()
    {
        return $this->statusAlterar;
    }


    public function setStatusConsultar($codigo)
    {
        $this->statusConsultar=$codigo;
    }
    public function getStatusConsultar()
    {
        return $this->statusConsultar;
    }


    public function setStatusExcluir($codigo)
    {
        $this->statusExcluir=$codigo;
    }
    public function getStatusExcluir()
    {
        return $this->statusExcluir;
    }

    public function setStatusRelatorio($codigo)
    {
        $this->statusRelatorio=$codigo;
    }
    public function getStatusRelatorio()
    {
        return $this->statusRelatorio;
    }


    
}

?>