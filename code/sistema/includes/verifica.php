<?php

if((!isset($_SESSION['id']) || $_SESSION['funcao'] != "1")){
	
	session_destroy();
	header("Location: ../includes/logoff.php");
}

?>