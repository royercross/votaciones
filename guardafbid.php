<?php
include_once "check.php";
include_once "Votos.php";
$votos = new Votos();
$input = $_POST;
if(isset($input['fbid'])){
	$me = $votos->guardaFB($input['fbid']);	
	header("Location: inicio.php");
}else{
	echo "ERROR....";
}