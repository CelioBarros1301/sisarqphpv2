<?php

Class Usuario
{

    private $codigo;
    private $nome;
    private $login;
    private $senha;
    private $status;
    private $perfil;
    private $liberado;


    public function setCodigo($codigo)
    {
        $this->codigo=$codigo;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setNome($nome)
    {
        $this->nome=$nome;
    }
    public function getNome()
    {
        return $this->nome;
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
   
    public function setLiberado($liberado)
    {
        $this->liberado=$liberado;
    }
    public function getLiberado()
    {
        return $this->liberado;
    }

   
}

?>