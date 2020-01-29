<?php
/*
* Classe: Usuario
* Regras: Não deve permiter Login duplicados
*         Codigo é um campo autoincremento no banco
* Tabela: tb_usuarios
*/
Class Usuario
{

    private $codigo;
    private $login;
    private $senha;
    private $status;
    private $perfil;

    public function setCodigo($codigo)
    {
        $this->codigo=$codigo;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setLogin($login)
    {
        $this->login=$login;
    }
    public function getLogin()
    {
        return $this->login;
    }

    public function setSenha($senha)
    {
        $this->senha=$senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    public function setStatus($status)
    {
        $this->status=$status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setPerfil($perfil)
    {
        $this->perfil=$perfil;
    }
    public function getPerfil()
    {
        return $this->perfil;
    }
   
}

?>