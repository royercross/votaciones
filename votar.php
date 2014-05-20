<?php
include_once "FIMAZConfig.php";
include_once "Votos.php";

$votos = new Votos();


if(!$votos->checarVoto(1,2)){

	$demo = $votos->sumarVoto($id_votante,$id_votante,$sexo);
	print_r($demo);

}else{
	
	echo "No votes";

}