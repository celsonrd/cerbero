<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/visitante.php';

//recebe variaveis
$idVis = $_POST['idVis'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$sexo = $_POST['sexo'];
$dn = $_POST['dn'];
$rg = $_POST['rg'];
$fone = $_POST['fone'];
$idtMil = $_POST['idtMil'];

$visitante = new visitante();

$visitante->editaVisitante($idVis, $nome, $cpf, $idtMil, $rg, $dn, $fone, $sexo);








