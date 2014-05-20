<?php
include_once "FIMAZConfig.php";
include_once "Votos.php";
$votos = new Votos();
$input = $_POST;
if(isset($input['fbid'])){
	$me = $votos->guardaFB($input['fbid']);	
}else{

}