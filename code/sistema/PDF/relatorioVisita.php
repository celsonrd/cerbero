<?php
session_start();

date_default_timezone_set("America/Sao_Paulo"); //configura horario para o timestamp
require_once '../../vendor/autoload.php'; //inicia o autoload do mpdf
include("../includes/verifica.php");

//pega o array definido na sss�o pela pagina pesquisaVisitas.php
$l = $_SESSION['array_relatorio_visitas'];

// $html= "
// 	<div id='header'>
// 		<figure><img src='../images/logo-small.png' /></figure>
// 		<div id='header_content'>Hist&oacute;rico de Visitas</div>
//                 <hr>
// 	</div>
// ";


//$html0 = "<div id='text-align: center;'><img src='../../sistema/images/brasao.jpg' alt='brasao' width='82' height='86'/></div>";


//$html .= "<div id='header'>"


$header .= "<table id='header' class='header' align ='center'>"
        . "<tr>"
	. "<td align='center'><img src='../../sistema/images/brasao.jpg' alt='brasao' width='82' height='86'></td>"
	. "</tr>"
	. "<tr>"
	. "<td align='center'>MINIST&Eacute;RIO DA DEFESA</td>"
	. "</tr>"
	. "<tr>"
	. "<td align='center'>EX&Eacute;RCITO BRASILEIRO</td>"
	. "</tr>"
	. "<tr>"
        . "<td align='center'>10&#170; BRIGADA DE INFANTARIA MOTORIZADA</td>"
	. "</tr>"
	. "<tr>"
        . "<td align='center'>BRIGADA FRANCISCO BARRETO DE MENEZES</td>"
	. "</tr>"	
        . "</table>";


// $html .= "<div id='_header'>"
//         . "MINIST&Eacute;RIO DA DEFESA</p>"
//         . "EX&Eacute;RCITO BRASILEIRO</p>" 
//         . "CMNE &#45; 7&#170; RM</p>"
//         . "10&#170; BRIGADA DE INFANTARIA MOTORIZADA</p>"
//         . "(BRIGADA FRANCISCO BARRETO DE MENEZES)"
//         . "</div>";


$html.="<table class='table-border-1'>";
$html.="<tr>"
        . "<td class='subheader'>NOME</td>"
        . "<td class='subheader'>LOCAL</td>"
        . "<td class='subheader'>MODELO</td>"
        . "<td class='subheader'>COR</td>"
        . "<td class='subheader'>PLACA</td>"
        . "<td class='subheader'>DATA ENTRADA</td>"
        . "<td class='subheader'>DATA SA&Iacute;DA</td>"
        . "</tr>";
for($i=0;$i<count($l);$i++){
   
    $html.="<tr>"
        . "<td>".$l[$i]['nome']."</td>"    
        . "<td>".$l[$i]['local']."</td>"
        . "<td>".$l[$i]['modelo']."</td>"
        . "<td>".$l[$i]['cor']."</td>"
        . "<td>".$l[$i]['placa']."</td>"    
        . "<td>".date('d/m/Y H:i:s', $l[$i]['stamp_entrada'])."</td>"
        . "<td>".date('d/m/Y H:i:s', $l[$i]['stamp_saida'])."</td>"
        . "</tr>";
    
}

$html.="</table><br><br><br>";


$html.= '<div style="text-align: center;">Quartel em Recife-PE, ___ de __________ de 201_</div>';

$css = file_get_contents("../includes/css/pdf.css");

//$css;
//echo $html;
//echo $header;
//die();

$mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);

        $css = file_get_contents("../includes/css/pdf.css");
        
        
        $mpdf->charset_in = 'iso-8859-1';
        $mpdf->SetDisplayMode('fullpage');    
	
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($header, 2);
        $mpdf->WriteHTML($html, 3);
        $mpdf->Output('relatorio.pdf','I');
        