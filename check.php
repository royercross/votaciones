<?php
	include_once("FIMAZConfig.php");
	define('MAX_IDLE_TIME',60*10);	
	session_start();
	$sesion_valida=true;
	if(!isset($_SESSION["REMOTE_IP"]) || $_SESSION["REMOTE_IP"]!=$_SERVER['REMOTE_ADDR'] || $_SESSION["TOKEN"]!="38f24e6d23cd0ba120f905151e91c20769f0c9e5149c111591f666f1503212e6")
		$sesion_valida=false;
	
	if(!isset($_SESSION['timeout_idle']))
		$_SESSION['timeout_idle'] = time() + MAX_IDLE_TIME;
	else 
		if ($_SESSION['timeout_idle'] > time())
			$_SESSION['timeout_idle'] = time() + MAX_IDLE_TIME;	
		else
			$sesion_valida=false;		
		
	if(!$sesion_valida)
		header("Location: ".$ruta."logout.php");
?>