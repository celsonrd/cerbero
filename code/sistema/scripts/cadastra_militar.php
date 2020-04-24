<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/militar.php';

//recebe variaveis
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$grd = $_POST['grd'];


$militar = new militar();
$t = $militar->inseriMilitar($grd, $cpf, $nome);

  
if($t){
    header("Location: ../interfaces/militares.php?msg=2");
}else{
    header("Location: ../interfaces/militares.php?msg=1");
}








