<?php
include_once "FIMAZConfig.php";
include_once "Votos.php";

$votos = new Votos();


$input = $_POST;

$me = $votos->me();


if(!$me){

	if(isset($input['user']) && isset($input['pass'])){

		if($votos->login($input['user'], $input['pass'])){
			$me = $votos->me();
			print_r($me);
		}

	}else{

		echo "Ingresa el usuario y la contraseña.";

	}

}else{
	
	echo $me->id_alumno . ' ' . $me->nombre . ' ' . $me->apellido_paterno . ' ' . $me->apellido_materno;

}