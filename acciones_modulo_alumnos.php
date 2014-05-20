<?php
/**@include("../../check.php");**/
if(isset($_POST['accion'])){

	$accion=$_POST['accion'];	
	$id_usuario=$_SESSION['id_usuario'];	

	require_once($rutaPHP."php/mysqlpdo.php");	
	$mysql = new DBMannager();		
	$mysql->connect();	
	
	
	if($accion=='votar'){		
		$id=$_POST['id_alumno'];
		//$query="UPDATE alumnos SET status=2,fecha_modificacion=NOW(),id_usuario_modificacion=? WHERE id_alumno=?";
		//echo $query;
		//$mysql->execute($query,array($id_usuario,$id));
		$_SESSION['mensaje']="Tu voto se ha realizado satisfactoriamente.";	
		//header('Location: modulo_historial_creditos.php');						
	}

	//exit;
}

?>