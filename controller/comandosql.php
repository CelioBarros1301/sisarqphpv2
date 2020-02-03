<?php
    
      
    #
    # Regras de Negocio para a Processo de  Comandos SQL
    #
    
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/comandosqlPDO.php';
   
    
    $comandoPDO           = new ComandoSQLPDO();
               
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $dataTable        = array();
   



    if ( isset($_POST['status'])  && ( $_POST['status']=="g"  ) )
    {
 
            $comandoSql  =trim(isset($_POST['CmdSQL'])?$_POST['CmdSQL']:"");
    
            
            $acaoComando=strtoupper(substr($comandoSql,0,6));
        
            switch($acaoComando)
            {
			    case "INSERT":				
                    $registro=$comandoPDO->insert($comandoSql);
                break;
                case "SELECT":	
                    $dataTable=$comandoPDO->select($comandoSql);
                    if ( $dataTable ) 
                    {
                        $dataTableColunas = array_keys($dataTable[0]);
                    }
                break;
                default:
                    $comandoSql="";
            break;

            }
            
    }
?>