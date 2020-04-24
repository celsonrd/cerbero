<?php

if((!isset($_SESSION["id"]))){
	
	session_destroy();
	header("Location: ../includes/logoff.php");
}

?>