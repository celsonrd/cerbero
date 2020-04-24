<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/local.php';

//recebe variaveis
$local = addslashes($_POST['local']);
$responsavel = addslashes($_POST['resp']);
$idPai = (int)$_POST['idPai'];

$localObj = new local();
$t = $localObj->novoLocal($local, $responsavel, $idPai);
  
if($t){
    header("Location: ../interfaces/locais.php?msg=2");
}else{
    header("Location: ../interfaces/locais.php?msg=1");
}








