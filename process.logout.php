<?php
	
	session_name("Satori");
	session_start();
	session_destroy();

	header("Location: index.php");
	exit;
	
?>