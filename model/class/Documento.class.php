<?php

Class Documento
{

    private $idDocumento;
    private $codEmpresa;
    private $codArquivo;
    private $codCorredor;
    private $codEstante;
    private $codPrateleira;
    private $codCaixa;
    private $codSetor;
    private $tipDocumento;
    private $numeroInicial;
    private $numeroFinal;
    private $dataInicial;
    private $dataFinal;
    private $dataDestruicao;
    private $codStatus;
    private $descricao;
    private $anoExercicio;
    private $anoCalendario;
    
    
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

    public function setCodigoArquivo($codigo)
    {
        $this->codArquivo=$codigo;
    }
    public function getCodigoArquivo()
    {
        return $this->codArquivo;
    }
    
    public function setCodigoCorredor($codigo)
    {
        $this->codCorredor=$codigo;
    }
    public function getCodigoCorredor()
    {
        return $this->codCorredor;
    }

    public function setCodigoEstante($codigo)
    {
        $this->codEstante=$codigo;
    }
    public function getCodigoEstante()
    {
        return $this->codEstante;
    }
    
    public function setCodigoPrateleira($codigo)
    {
        $this->codPrateleira=$codigo;
    }
    public function getCodigoPrateleira()
    {
        return $this->codPrateleira;
    }

    public function setCodigoCaixa($codigo)
    {
        $this->codCaixa=$codigo;
    }
    public function getCodigoCaixa()
    {
        return $this->codCaixa;
    }

    public function setCodigoSetor($codigo)
    {
        $this->codSetor=$codigo;
    }
    public function getCodigoSetor()
    {
        return $this->codSetor;
    }


    public function setTipoDocumento($codigo)
    {
        $this->tipDocumento=$codigo;
    }
    public function getTipoDocumento()
    {
        return $this->tipDocumento;
    }

    public function setNumeroInicial($codigo)
    {
        $this->numeroInicial=$codigo;
    }
    public function getNumeroInicial()
    {
        return $this->numeroInicial;
    }

    public function setNumeroFinal($codigo)
    {
        $this->numeroFinal=$codigo;
    }
    public function getNumeroFinal()
    {
        return $this->numeroFinal;
    }

    public function setDataInicial($codigo)
    {
        $this->dataInicial=$codigo;
    }
    public function getDataInicial()
    {
        return $this->dataInicial;
    }

    public function setDataFinal($codigo)
    {
        $this->dataFinal=$codigo;
    }
    public function getDataFinal()
    {
        return $this->dataFinal;
    }
   

    public function setDataDestruicao($codigo)
    {
        $this->dataDestruicao=$codigo;
    }
    public function getDataDestruicao()
    {
        return $this->dataDestruicao;
    }
    
    public function setCodigoStatus($codigo)
    {
        $this->codStatus=$codigo;
    }
    public function getCodigoStatus()
    {
        return $this->codStatus;
    }
    
  
    public function setDescricao($codigo)
    {
        $this->descricao=$codigo;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
  
   
    public function setAnoExercicio($codigo)
    {
        $this->anoExercicio=$codigo;
    }
    public function getAnoExercicio()
    {
        return $this->anoExercicio;
    }
   
    public function setAnoCalendario($codigo)
    {
        $this->anoCalendario=$codigo;
    }
    public function getAnoCalendario()
    {
        return $this->anoCalendario;
    }
   
    
}

?>