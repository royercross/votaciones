<?php
include_once "FIMAZConfig.php";

if(isset($_POST['email'])){
	require_once("php/mysqlpdo.php");	
	$mysql = new DBMannager();		
	$mysql->connect();	
	
	$cambios=0;
	$email=$_POST['email'];
	$query="SELECT * FROM alumnos WHERE email=?";	
	$mysql->execute($query,array($email));			
	if($mysql->count() > 0){
		$row=$mysql->getRow();

		/*** Verifica cuantas veces ha solicitado la contraseña hoy **/
		$query="SELECT id_alumno, count(*) as solicitudes FROM recuperar_cuentas WHERE id_alumno=? GROUP BY DATE(fecha_registro)";	
		$mysql->execute($query,array($row['id_alumno']));

		if($solicitudes=$mysql->getRow()){
			$solicitudes = $solicitudes['solicitudes'];
		}else{
			$solicitudes = 0;
		}
		if($solicitudes >= 2){
			$error=1;
			$mensaje_error="Haz excedido el numero de recuperaciones diarias, intenta de nuevo mañana.";
		}else{

			/*** Crea el link para recuperar cuenta **/
			$key=hash('sha256', $row['id_alumno'].time());
			$query="INSERT INTO recuperar_cuentas (id_alumno, rkey) VALUES (?,?)";	
			$mysql->execute($query,array($row['id_alumno'], $key));			

			$completado=1;
			//Enviar correo
			//This should be done in your php.ini, but this is how to do it if you don't have access to that
			date_default_timezone_set('America/Mazatlan');

		//if(valida_email($email)){
			require 'php/PHPMailer/PHPMailerAutoload.php';
			
			//Create a new PHPMailer instance
			$mail = new PHPMailer();
			$mail->CharSet = 'UTF-8';
			$mail->isSMTP();
			$mail->SMTPSecure = 'ssl';
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			//$mail->SMTPDebug = 1;
			//Ask for HTML-friendly debug output
			//$mail->Debugoutput = 'html';
			$mail->Host = "smtp.sendgrid.com";
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = "aramirez92";
			$mail->Password = "uas123uas";
			//$email="rogelio.norisc@gmail.com";
			$mail->setFrom('noreply@dahuster.com', 'Facultad de Informática Mazatlán');
			$mail->addAddress($email, $row['nombre'].' '.$row['apellido_paterno']);
			$mail->Subject = 'Recuperar contraseña del Sistema de Alumnos FIMAZ';

			//Read an HTML message body from an external file, convert referenced images to embedded,							
			$html="<strong>Usuario:</strong> ".$row['usuario']."<br/><br/>";
			$html.="Para recuperar tu contraseña debes hacer click en el siguiente enlace o copiarlo en tu navegador:";
			$html.="<br /><br />";			
			$html.="<a href='https://fimazvotaciones.azurewebsites.net/recuperar_password.php?k=".$key."'>https://fimazvotaciones.azurewebsites.net/recuperar_password.php?k=".$key."</a>";
			$mail->msgHTML($html);
			//Replace the plain text body with one created manually
			//$mail->AltBody = 'This is a plain-text message body';
			//Attach an image file
			//$mail->addAttachment('images/phpmailer_mini.gif');
			
			//send the message, check for errors
			if (!$mail->send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
				$error=1;
				$mensaje_error="Error al enviar el correo, intenta de nuevo mas tarde";
			} else {
				$completado=1;
				$mensaje_completado="Se ha enviado un correo con las instrucciones para recuperación a la dirección: ".$email;
			}		
		}
	}else{
		$error=1;
		$mensaje_error="Tu correo electronico, no esta registrado, acude con Lety.";
	}
}
if(isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['rkey'])){
	require_once("php/mysqlpdo.php");	
	$mysql = new DBMannager();		
	$mysql->connect();	
	
	$cambios=0;
	$pass1=$_POST['pass1'];
	$pass2=$_POST['pass2'];
	$rkey=$_POST['rkey'];
	if($pass1 != $pass2){
		$error=1;
		$mensaje_error="Las contraseñas no coinciden.";
	}else{
		$query="SELECT * FROM recuperar_cuentas WHERE rkey=? and status=1";
		$mysql->execute($query,array($rkey));			
		if($mysql->count() > 0){
			$row=$mysql->getRow();
			$id_alumno=$row['id_alumno'];			
			$query="UPDATE recuperar_cuentas SET status=2 WHERE rkey=?";
			$mysql->execute($query,array($rkey));			
			$query="UPDATE alumnos SET password=? WHERE id_alumno=?";
			$mysql->execute($query,array(hash('sha256',$pass1),$id_alumno));			
			$completado=1;
			$mensaje_completado="Tu contraseña se ha cambiado correctamente. Haz clic en regresar al inicio.";
		}else{
			$error=1;
		}

	}
	
}