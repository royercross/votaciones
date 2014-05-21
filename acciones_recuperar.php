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
		$completado=1;
		//Enviar correo
		//This should be done in your php.ini, but this is how to do it if you don't have access to that
		date_default_timezone_set('America/Mazatlan');

		//if(valida_email($email)){
			require 'php/PHPMailer/PHPMailerAutoload.php';
			
			//Create a new PHPMailer instance
			$mail = new PHPMailer();
			$mail->CharSet = 'UTF-8';
			//$mail->isSMTP();
			//$mail->SMTPSecure = 'ssl';
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			//$mail->SMTPDebug = 1;
			//Ask for HTML-friendly debug output
			//$mail->Debugoutput = 'html';
			//$mail->Host = "smtp.live.com";
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = "noreply@informaticamazatlan.mx";
			$mail->Password = "uas123uas";
			$email="rogelio.norisc@gmail.com";
			$mail->setFrom('noreply@informaticamazatlan.mx', 'Facultad de Informática Mazatlán');
			$mail->addAddress($email, $nombre.' '.$apellido_paterno);
			$mail->Subject = 'Recuperar contraseña del Sistema de Alumnos FIMAZ';

			//Read an HTML message body from an external file, convert referenced images to embedded,							
			$html="Para recuperar tu contraseña debes hacer click en el siguiente enlace o copiarlo en tu navegador:";
			$html.="<br /><br />";
			$html.="Usuario: ".$row['usuario'];
			$html.="link";
			$mail->msgHTML($html);
			//Replace the plain text body with one created manually
			//$mail->AltBody = 'This is a plain-text message body';
			//Attach an image file
			//$mail->addAttachment('images/phpmailer_mini.gif');
			
			//send the message, check for errors
			if (!$mail->send()) {
				/**echo "Mailer Error: " . $mail->ErrorInfo;**/
				$_SESSION['mensaje_tipo']='error';
				$_SESSION['mensaje']="Haz quedado registrado correctamente en las actividades de la Semana Nacional de Ciencia y Tecnología. Sin embargo no hemos podido enviarte un correo electrónico a la dirección proporcionada: ".$email."  , Si tu correo electrónico no es correcto, te agradeceríamos que lo actualizaras haciendo clic en el menú Mi Cuenta > Actualizar Datos.";					
			} else {
				$_SESSION['mensaje']="Haz quedado registrado correctamente en las actividades de la Semana Nacional de Ciencia y Tecnología. Hemos enviado un correo de confirmación a la siguiente cuenta: ".$email." Recuerda revisar el correo no deseado.";
			}		
		/*}else{
				$_SESSION['mensaje_tipo']='error';
				$_SESSION['mensaje']="Haz quedado registrado correctamente en las actividades de la Semana Nacional de Ciencia y Tecnología. Sin embargo no hemos podido enviarte un correo electrónico a la dirección proporcionada: ".$email."  , Si tu correo electrónico no es correcto, te agradeceríamos que lo actualizaras haciendo clic en el menú Mi Cuenta > Actualizar Datos.";								
		}*/
	
	}else{
		$error=1;
	}
}