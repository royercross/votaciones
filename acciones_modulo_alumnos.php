<?php
@include("check.php");
if(isset($_POST['accion'])){

	$accion=$_POST['accion'];	
	$id_alumno=$_SESSION['id_alumno'];	
	
	if($accion=='votar'){		

		$id=$_POST['id_alumno'];
		$query="SELECT nombre,apellido_paterno,apellido_materno,sexo FROM alumnos WHERE id_alumno=?";
		$mysql->execute($query,array($id));

		if($row=$mysql->getRow()){
			$sexo=$row['sexo'];				
			$query="SELECT * FROM votos WHERE id_alumno=? AND sexo=?";
			$mysql->execute($query,array($id_alumno,$sexo));			
			if($mysql->count()==0){
				$query="INSERT votos(id_alumno, id_votado, sexo) VALUES (?,?,?)";
				$mysql->execute($query,array($id_alumno,$id,$sexo));			
				$nombre_completo=$row['nombre']." ".$row['apellido_paterno']." ".$row['apellido_materno'];				
				$_SESSION['mensaje']="Tu voto para el candidato de sexo '".$sexo."' se ha realizado a '".$nombre_completo."'";
			}else{
				$_SESSION['error']="Ya haz realizado tu voto para el candidato de sexo '".$sexo."'";			
			}

		}else{
			$_SESSION['mensaje']="ERROR......";		
		}
	}

	//exit;
}

?>