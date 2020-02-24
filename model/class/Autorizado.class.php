<?php

Class Autorizado
{

    private $codigo;
    private $nome;
    private $empresa;
    private $setor;
    private $funcao;
    private $email;
    private $celular;
    private $telefone;
    private $login;
    private $liberado;
    
    
    private $descricao;

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


    public function setEmpresa($empresa)
    {
        $this->empresa=$empresa;
    }
    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function setSetor($setor)
    {
        $this->setor=$setor;
    }
    public function getSetor()
    {
        return $this->setor;
    }

    public function setFuncao($funcao)
    {
        $this->funcao=$funcao;
    }
    public function getFuncao()
    {
        return $this->funcao;
    }

    public function setEmail($email)
    {
        $this->email=$email;
    }
    public function getEmail()
    {
        return $this->email;
    }


    public function setCelular($celular)
    {
        $this->celular=$celular;
    }
    public function getCelular()
    {
        return $this->celular;
    }

    public function setTelefone($telefone)
    {
        $this->telefone=$telefone;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setLogin($login)
    {
        $this->login=$login;
    }
    public function getLogin()
    {
        return $this->login;
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