<?php
  
/*
* Regras de Negocio para a Processo de Manutencoa de Usuario
*  Objetos envolvidos: Usuario
*  Regra: 
*/
    
    require("usuarioPDO.php");
   
     # Recuperando os dados da sessão
     $user = $_SESSION['user'];
   
    $usuarioPDO= new UsuarioPDO();
   
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 

        
    # Preencher Formulario com os dados 
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];
        $codigo=$_GET['id'];
        $registro=$usuarioPDO->libera($codigo);
        
    }
    
    # Preencher o DataTable
    $dataTable=$usuarioPDO->listalibera($user['id_usu']);
    if ( $dataTable ) 
    {
        $dataTableColunas = array_keys($dataTable[0]);
    }
    
   ## header("location:sisarq.php");
         
?>