<?php
include_once "check.php";
include_once "Votos.php";
$votos = new Votos();
$input = $_POST;

if(isset($input['fbid'])){
	$me = $votos->guardaFB($input['fbid']);	
	$response = array('response' => true);
	echo json_encode($response);
}else{
	$response = array('response' => false);
	echo json_encode($response);
}