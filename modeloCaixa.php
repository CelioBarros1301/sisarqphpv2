<?php



require_once 'model/class/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// instanciando o dompdf

$dompdf = new Dompdf();


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

$dompdf->stream();
// File

?>