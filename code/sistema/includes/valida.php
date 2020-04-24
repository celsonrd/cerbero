<?php
session_start();
include '../classes/usuario.php';


//var_dump($_POST);

$login = $_POST['login'];
$senha = md5($_POST['senha']);

$user = new usuario();


if($login != "" and $senha != ""){

    $user->setLogin($login);
    $user->setSenha($senha);

    $t = $user->valida();

    if($t){
        
        $_SESSION['id'] = $t['id'];
        $_SESSION['nome'] = $t['nome'];
        $_SESSION['email'] = $t['email'];
        $_SESSION['funcao'] = $t['funcao'];
        
        header("Location: ../interfaces/visitas.php");
        
    }else{
        header("Location: ../../index.php?msg=1");
    }
}
