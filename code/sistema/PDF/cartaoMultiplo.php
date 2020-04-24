<?php
session_start();
date_default_timezone_set("America/Sao_Paulo"); //configura horario para o timestamp
require_once '../../vendor/autoload.php'; //inicia o autoload do mpdf
require_once 'geraBarras/barcode.inc.php'; //gera codigo de barras
include("../includes/verifica.php");
require_once '../classes/visitante.php';

if(isset($_POST['idCartao']) and count($_POST['idCartao']) > 0){
    
//recupera variaveis
$membrosGet = $_POST['idCartao'];
    
    for($i=0;$i<count($membrosGet);$i++){ //varre todos os membos informados gerando os crachás

        //pega informações do visitante selecionado
        $visitanteObj = new visitante();
        $visitanteObj->setAtributos($membrosGet[$i]);
        
        
        //define o float
        if($i%2 == 0){
            $float = "left";
        }else{
            $float = "right";
        }
        
        if($visitanteObj->getAcessoLivre()){//permite apenas impressão de cartão de quem tiver habilitado  
            
            $cpf = $visitanteObj->getCpf();
            $nomeFile = "geraBarras/".$cpf . ".png";
            new barCodeGenrator($cpf,1,$nomeFile,150,80,TRUE); //gera o codigo de barras
            
            //salva cpf em array que será usado na exclusão das imagens geradas pelo c barras
            $array_exclude = array(
                $i=> $cpf,
            );
            
            
            //informações de configuração
            
            $rodape = $visitanteObj->getTipoAcesso(); //nome do local de acesso
            $estilo = "background-color: #0B610B;  padding: 5px;";

            $html.="

            <div class='card ".$float."'>
                <div>
                    <div class='dadosPessoais'>
                        <div class='tipoInscricao' style='".$estilo."'>"
                        ."71 BIMtz <br>Cart&atilde;o de Acesso"
                        ."</div>" 
                        ."<div class='foto'>"
                        . "<img src='".$visitanteObj->getFoto()."'>"
                        . "</div>"
                    ."</div>"
                ."</div>";    

            $html.="
                <div class='nome'>
                    ".$visitanteObj->getNome()."         
                </div>
                <div class='dadosIgreja'>
                    <label>val: </label>".$visitanteObj->getValidade() ."&nbsp;&nbsp;&nbsp;
                    <label>RG: </label>".$visitanteObj->getRg() ."    
                </div>
                <div class='barcode'>

                    <img src='".$nomeFile."'>
                </div>
                <div class='tipoInscricao rodape' style='".$estilo."'>
                    ".$rodape."
                </div>
            </div>

            ";

        }
    }




    $mpdf = new \Mpdf\Mpdf(); 
    $mpdf->SetDisplayMode('fullpage');
    $css = file_get_contents("../includes/css/cracha.css");
    $mpdf->WriteHTML($css,1);
    $mpdf->WriteHTML($html,2);
    $mpdf->Output('relatorio.pdf','I');
	
       
    //apaga imagens usadas nas barras
    for($i=0;$i<count($array_exclude);$i++){

        $fileDel = "geraBarras/".$array_exclude[$i]. ".png";
        unlink($fileDel);
    }    
    exit;

}