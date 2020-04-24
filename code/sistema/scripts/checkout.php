<?php
session_start();
require_once '../includes/verifica3.php';
require_once '../classes/visitante.php';

//recebe variaveis
$idVisita = $_GET['id'];

$visitante = new visitante();
$visitante->checkout($idVisita);
  
header("Location: ../interfaces/visitas.php");








