<?php
    
#
    # Regras de Negocio para a Processo de Empresar
    #
   
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';
    
    # Instaciando as classes necessarias
    $empresaPDO = new EmpresaPDO();
           
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=array();

        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codigo=isset($_GET['id'])?$_GET['id']:"";
        $registro=$empresaPDO->busca($codigo);
        
    }
    else if( !isset($_GET['status']))
    {
        $dataTable=$empresaPDO->lista("");
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
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
        header("location:".$GLOBALS['project_index']."sisarq.php?option=empresa");
    }

?>