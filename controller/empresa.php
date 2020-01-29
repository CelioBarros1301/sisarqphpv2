<?php
    
    require("empresaPDO.php");
    require("referenciaPDO.php");
    require("Referencia_Class.php");
    
    $empresaPDO = new EmpresaPDO();

    $nomeColunas = array();
        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codigo=$_GET['id'];
        $registro=$empresaPDO->busca($codigo);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $nomeColunas=array();
        $empresas=$empresaPDO->lista("");
        if ( $empresas ) 
        {
            $nomeColunas = array_keys($empresas[0]);
        }
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        $codigo=$_POST['id'];
        $descricao=$_POST['desEmp'];
        switch ($operacao)
        {
            case 'a':
                $registro=$empresaPDO->update($codigo,$descricao);
            break;
            case 'i':   
                $registro=$empresaPDO->insert($codigo,$descricao);
            break;
            case 'e':
                $registro=$empresaPDO->delete($codigo);
            break;
        }
        header("location:sisarq.php?option=empresa");
    }

?>