<?php
session_start();
require_once '../includes/verifica.php';
require_once '../classes/usuario.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS); 
$funcao = (int)$_POST['funcao'];

if(strlen($nome) > 5 and $funcao > 0){    

    $user = new usuario();
    
    if($user->inseriUser($nome, $email, $funcao)){
        
        header("Location: ../interfaces/usuarios.php?msg=2");
        
    }else{
        
       header("Location: ../interfaces/usuarios.php?msg=1"); 
    }

}else{

   header("Location: ../interfaces/usuarios.php?msg=1");

}
