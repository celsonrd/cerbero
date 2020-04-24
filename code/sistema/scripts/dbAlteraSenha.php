<?php
session_start();
require_once '../includes/verifica3.php';
require_once '../classes/usuario.php';

$user = new usuario();



if($user->alteraSenha($_SESSION['id'], $_POST['senhaatual'], $_POST['senhanew'], $_POST['senhanew2'])){
    
    header("Location: ../interfaces/operador.php?msg=2");
}else{
    header("Location: ../interfaces/operador.php?msg=1");
}
