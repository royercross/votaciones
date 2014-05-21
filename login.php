<?php
session_start();
include_once "FIMAZConfig.php";
include_once "Votos.php";


if(isset($_POST['user'])){	

	$votos = new Votos();

	$input = $_POST;

	$me = $votos->me();

	if(isset($input['user']) && isset($input['pass'])){

		if($votos->login($input['user'], $input['pass'])){
			$me = $votos->me();
			//print_r($me);						
			$_SESSION['botonfacebook']=true;	
			if(strlen($me->fbid) > 3){
				$_SESSION['botonfacebook']=false;	
			}
			$_SESSION['TOKEN']="38f24e6d23cd0ba120f905151e91c20769f0c9e5149c111591f666f1503212e6";
			$_SESSION['REMOTE_IP']=$_SERVER['REMOTE_ADDR'];			
			$_SESSION['id_alumno']=$me->id_alumno;
			//header("Location: inicio.php");
		}else{
			$error=1;
		}

	}else{
		$error=1;
	}
}