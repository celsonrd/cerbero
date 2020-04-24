<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/usuario.php';

$id = (int)$_GET['id'];

if($id > 0){
    
    $user = new usuario();
    
    $user->resetaSenha($id);
    
    header("Location: ../interfaces/usuarios.php?msg=2");
   
}else{
    
    header("Location: ../interfaces/usuarios.php?msg=1");
}




