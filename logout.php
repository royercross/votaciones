<?php
	include("FIMAZConfig.php");
	session_start();
	session_destroy();
	header("Location: ".$ruta."");
?>