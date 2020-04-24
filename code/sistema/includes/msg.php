<?php

if (!isset($_GET["msg"]))
	{
		$msg = 30;
	}else{
		$msg = $_GET["msg"];
	}


switch ($msg){

    case 1:
    $tipo = "danger";
    $conteudo = "Dados Incorretos: Repita a opera&ccedil;&atilde;o";
    break;

    case 2:
    $tipo = "success";
    $conteudo = "Opera&ccedil;&atilde;o Realizada com Sucesso!";
    break;

    case 3:
    $tipo = "success";
    $conteudo = "Visitante Cadastrado! <a href='visitas.php?ids=$_GET[c]'><button class='btn btn-warning' style='margin-left: 10px;' ><i class='fa fa-sign-in'></i> Check-in</button></a> <button class='btn btn-danger' style='margin-left: 10px;' ><i class='fa fa-address-card'></i> Acesso Livre</button>";
    break;
    
    default:
    $titulo = "";
    $conteudo = "";
    break;
	
}
	//echo "".$titulo."<br>".$conteudo."<br>";
?>

