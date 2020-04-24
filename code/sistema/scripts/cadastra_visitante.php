<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

//recebe variaveis
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$idMil = $_POST['idMil'];
$rg = $_POST['rg'];
$fone = $_POST['fone'];
$omOrigem = $_POST['omOrigem'];
$idMilResp = $_POST['idMilResp'];
$nomeMilRespRes = $_POST['nomeMilRespRes'];
$dn = $_POST['dn'];
$img = $_POST['foto'];
$sexo = $_POST['sexo'];

$visitante = new visitante();
$t = $visitante->novoVisitante($nome, $cpf, $sexo, $idMil, $rg, $dn, $fone, $img, $omOrigem, $idMilResp, $nomeMilRespRes);
  
if($t){
    header("Location: ../interfaces/operador.php?msg=3&c=$cpf");
}else{
    header("Location: ../interfaces/operador.php?msg=1");
}








