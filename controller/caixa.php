<?php
    #
    # Regras de Negocio para a Processo de Prateleira  #
    
    # Incluindo as classes necessárias
    include_once dirname(__DIR__).'/model/config.php';

    include_once $GLOBALS['project_path'].'/dao/caixaPDO.php';
    include_once $GLOBALS['project_path'].'/model/class/Caixa.class.php';
    include_once $GLOBALS['project_path'].'/dao/setorPDO.php';
    include_once $GLOBALS['project_path'].'/dao/empresaPDO.php';


    # Configuracao do Impressao usando DOMPDF
    include_once $GLOBALS['project_path'].'model/class/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    #instanciando o dompdf
    $dompdf = new Dompdf();
    
    # Instaciando as classes necessarias
    $caixaPDO = new CaixaPDO();
    $caixa    = new Caixa();
 
    
    $setorPDO  = new SetorPDO();
    $empresaPDO=new EmpresaPDO();
            
    
    # Array para guarda os nome das Colunas doa DataTable
    $dataTableColunas = array(); 
    $registro=array();
    $filtroEmpresa="";


    # Preencher Formulario com os dados 
      
        
    if (isset($_GET['status'] ))
    {
        $acao=$_GET['status'];

        $codEmpresa  = isset($_GET['codEmp'])?$_GET['codEmp']:"";
        $codSetor    = isset($_GET['codSet'])?$_GET['codSet']:"";
        $codCaixa    = isset($_GET['codCai'])?$_GET['codCai']:"";
        if ($acao=="i" ) 
        { 
            $tabelaEmpresa=$empresaPDO->lista("");
            $tabelaSetor  =$setorPDO->listaSetor($codEmpresa,"");
        }
        else
        {
            $tabelaEmpresa=$empresaPDO->lista($codEmpresa);
            $tabelaSetor  =$setorPDO->listaSetor($codEmpresa,$codSetor);
            
        }
        $registro=$caixaPDO->busca($codEmpresa,$codSetor,$codCaixa);
        
    }
    else if( !isset($_GET['status']))
    {
        # Preencher o DataTable
        $filtroEmpresa= (isset($_GET['filtroEmp']) && $_GET['filtroEmp']!="" )?$_GET['filtroEmp']:""; 
        $tabelaEmpresa=$empresaPDO->lista("");
            
        $dataTable=$caixaPDO->lista($filtroEmpresa);
        if ( $dataTable ) 
        {
            $dataTableColunas = array_keys($dataTable[0]);
        }
     
    }
    
    # Verificar operacoes de Banco
    if ( isset($_POST['operacao']))
    {
        $operacao=$_POST['operacao'];
        
        $codEmpresa=$_POST['codEmp'];
        $codSetor  =$_POST['codSet'];
        $codCaixa  =$_POST['codCai'];
        
        
        # Gerando as informacoes do Objeto
        $caixa->setCodigoEmpresa($_POST['codEmp']);
        $caixa->setCodigoSetor($_POST['codSet']);
        $caixa->setCodigoCaixa($_POST['codCai']);
        $caixa->setDescricao($_POST['desCai']);
        
       
        switch ($operacao)
        {
            case 'a':
                $registro=$caixaPDO->update($caixa);
            break;
            case 'i':
                try 
                {
                    $conexao=Conexao::getConnection();
                    $registro=$caixaPDO->insert($caixa);
                    $conexao=null;
                }
                catch (PDOExecption $e  )
                {
                    $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
                    $mensagem .= "\nErro: " . $e->getMessage();
                    $conexao=null;
                    throw new Exception($mensagem);
                    
                }
               
            break;
            case 'e':
                try
                {
                   $error=0; 
                    $registro=$caixaPDO->delete($codEmpresa,$codSetor,$codCaixa);
                }
                catch(Exception  $e)
                {
                    $error=1;
                }

            break;
            case 'r':
                $html='<table border=2 cellpadding=3 style="max-width: 300px">';
                $html.='<tr>';
                    $html.='<th  colspan="2"> Localizacao</th>';
                    $html.='</tr>';
                    $html.='<tr>';
                        $html.='<td style="width:30%">Arquivo:</td>';
                        $html.='<td style="width:70%">Sala de Contabildade</td>';
                        $html.='</tr>';
                        $html.='<tr>';
                            $html.='<td style="width:30%">Corredor:</td>';
                            $html.='<td style="width:70%">Informatica</td>';
                            $html.='</tr>';
                            $html.='<tr>';
                                $html.='<td style="width:30%">Estante:</td>';
                                $html.='<td style="width:70%">Informatica</td>';
                                $html.='</tr>';
                                $html.='<tr>';
                                    $html.='<td style="width:30%">Prateleira:</td>';
                                    $html.='<td style="width:70%">Fornecedores</td>';
                                    $html.='</tr>';
                                    $html.='<tr>';
                                        $html.='<td style="width:30%">Caixa:</td>';
                                        $html.='<td style="width:70%" >0001</td>';
                                        $html.='</tr>';
                                        $html.='</table>';
                                        $html.='<hr>';
                                        $html.='<table border=2 cellpadding=2 style="max-width: 500px">';
                                            $html.='<tr>';
                                                $html.='<th>Tipo Documentor</th>';
                                                $html.='<th rowspan=2>Numero Documento</th>';
                                                $html.='<th>Data Documento</th>';
                                                $html.='<th rowspan=2>Data Destruicao</th>';
                                                $html.='</tr>';
                                                $html.='<tr>';
                                                    $html.='<th>Setor</th>';
                                                    $html.='<th>Ano Base/Exer</th>';
                                                    $html.='</tr>';
                                                    $html.='<tr>';
                                                        $html.='<td style="width:70%" >Notas Fiscais de Fornecedores</td>';
                                                        $html.='<td style="width:10%">123456789  123456789</td>';
                                                        $html.='<td style="width:10%">01/01/2020  31/12/2020</td>';
                                                        $html.='<td style="width:10%">31/01/2020</td>';
                                                        $html.='</tr>';
                                                        $html.='<tr>';
                                                            $html.='<td colspan=2>Desenvolvimento de Sistema de Automaçao Industrial</td>';
                                                            $html.='<td>1990/2010</td>';
                                                            $html.='</tr>';
                                                            $html.='<tr>';
                                                                $html.='<th colspan=4>Observacao</th>';
                                                                $html.='</tr>';
                                                                $html.='<tr>';
                                                                    $html.='<td colspan=4 style="width:100%" >Relacao de Notas Fiscais de Fornecedores:IBYTE,Nagem,Cecomil</td>';
                                                                    $html.='</tr>';
            
                                                                    $html.='</table>';
            
                    
                                                                    $dompdf->loadHtml($html);
            
            //Definindo o tipo de fonte padrão
            ob_start();
            require_once 'modeloCaixa.html';
            $pdf=ob_get_clean();
            
            ##$dompdf->set_option('defaultFont', 'Times New Roman’');
            $dompdf->loadhtml($pdf);
            
            // Definindo o papel e a orientação
            
            $dompdf->setPaper('A4', 'portrait');
            
            // Renderizando o HTML como PDF
            
            $dompdf->render();
            
            // Enviando o PDF para o browser
            
            $dompdf->stream("teste.pdf");

        
            break;
            
        }

        header("location:".$GLOBALS['project_index']."sisarq.php?option=caixa&filtroEmp=$codEmpresa&error=$error");
 
       
    }
     
?>