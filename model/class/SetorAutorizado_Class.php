<?php
/*
* Classe: Usuario
* Funçao: Realizar o controle de acesso ao sistema
* Regras: Não deve permiter Login duplicados
*         Codigo é um campo autoincremento no banco
* Tabela: tb_usuarios
*/
Class SetorAutorizado
{

    private $id;
    private $codigoAutorizado;
    private $codigoEmpresa;
    private $codigoSetor;
   
    public function setIdo($id)
    {
        $this->id=$id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setCodigoAutorizado($codigo)
    {
        $this->codigoAutorizado=$codigo;
    }
    public function getCodigoAutorizado()
    {
        return $this->codigoAutorizado;
    }

    public function setCodigoEmpresa($codigo)
    {
        $this->codigoEmpresa=$codigo;
    }
    public function getCodigoEmpresa()
    {
        return $this->codigoEmpresa;
    }

    public function setCodigoSetor($codigo)
    {
        $this->codigoSetor=$codigo;
    }
    public function getCodigoSetor()
    {
        return $this->codigoSetor;
    }

    
    
}

?>