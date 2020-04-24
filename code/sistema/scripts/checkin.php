<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

//recebe variaveis
$idVisitante = $_POST['idVisitante'];
$idLocal = $_POST['idLocal'];
$cor = $_POST['cor'];
$modelo = $_POST['modelo'];
$placa = $_POST['placa'];


$visitante = new visitante();
$t = $visitante->checkin($idVisitante, $idLocal, $modelo, $cor, $placa);
  
if($t){
    header("Location: ../interfaces/visitas.php");
}else{
    header("Location: ../interfaces/visitas.php?msg=1");
}








