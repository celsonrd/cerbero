<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/usuario.php';

$id = (int)$_GET['id'];
$status = (int)$_GET['status'];

if($id > 0){
    
    $user = new usuario();
    
    $user->mudaStatus($id, $status);
    
    header("Location: ../interfaces/usuarios.php?msg=2");
   
}else{
    
    header("Location: ../interfaces/usuarios.php?msg=1");
}




