<?php
session_start();
date_default_timezone_set("America/Sao_Paulo"); //configura horario para o timestamp
require_once '../../vendor/autoload.php'; //inicia o autoload do mpdf
include("../includes/verifica.php");
require_once '../includes/conexao.php';
require_once '../classes/visitante.php';

//recebe variavei GET
$idVisitante = (int)$_GET['v'];

$visitante = new visitante();
$visitante->setAtributos($idVisitante);


$h = $visitante->historicoVisitante($idVisitante);

$html.= "
	<div id='header'>
		<figure><img src='../images/logo-small.png' /></figure>
		<div id='header_content'>Hist&oacute;rico de  ".$visitante->getNome()."</div>
                <hr>
	</div>
";

$html.="<table class='table-border-1'>";
$html.="<tr>"
        . "<td>LOCAL</td>"
        . "<td>DATA ENTRADA</td>"
        . "<td>DATA SA&Iacute;DA</td>"
        . "<td>VE&Iacute;CULO</td>"
        . "</tr>";
for($i=0;$i<count($h);$i++){
   
    $html.="<tr>"
        . "<td>".$h[$i]['local']."</td>"
        . "<td>".date('d/m/Y H:i:s', $h[$i]['stamp_entrada'])."</td>"
        . "<td>".date('d/m/Y H:i:s', $h[$i]['stamp_saida'])."</td>"
        . "<td>".$h[$i]['placa']."</td>"
        . "</tr>";
    
}

$html.="</table>";



$mpdf = new \Mpdf\Mpdf();
 
	$mpdf->SetDisplayMode('fullpage');
	$css = file_get_contents("../includes/css/pdf.css");
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html,2);
	$mpdf->Output('relatorio.pdf','I');
	exit;
