<?php
	$error=false;
?>
<?php include("encabezado.php"); ?>
<section class="columns">	
      <form class="form-signin" method="post" action="">
    	<?php  if($error==1){ ?>
        	<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>El usuario o contraseña no es valido.</div>
        <?php } ?> 
    	<?php  if($error==2){ ?>
        	<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>El captcha introducido no es valido.</div>
        <?php } ?>               
        <h2 class="form-signin-heading">Acceso de Alumnos</h2>
        <!-- Text input-->
        <div class="control-group">
            <input name="txtUsuario" type="text" class="input-block-level" placeholder="usuario" data-validation-required-message="Usuario requerido." required>
            <p class="help-block"></p>
        </div>        
        <div class="control-group">
	        <input name="txtPassword" type="password" class="input-block-level" placeholder="contraseña" data-validation-required-message="Contraseña requerida."  required>
            <p class="help-block"></p>            
        </div>                
        <?php if($recapcha){ ?>
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <a id="recaptcha_image" href="#" class="thumbnail"></a>
                <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrecta intenta de nuevo.</div>
            </div>
        </div>
        <div class="control-group">
           <label class="recaptcha_only_if_image control-label">Ingresa las palabras de arriba:</label>
          <label class="recaptcha_only_if_audio control-label">Ingresa los numeros que escuches:</label>
        
          <div class="controls">
              <div class="input-append">
                  <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="input-recaptcha" required/>
                  <a class="btn" href="javascript:Recaptcha.reload()"><i class="icon-refresh"></i></a>
                  <a class="btn recaptcha_only_if_image" href="javascript:Recaptcha.switch_type('audio')"><i title="Get an audio CAPTCHA" class="icon-headphones"></i></a>
                  <a class="btn recaptcha_only_if_audio" href="javascript:Recaptcha.switch_type('image')"><i title="Get an image CAPTCHA" class="icon-picture"></i></a>
                <a class="btn" href="javascript:Recaptcha.showhelp()"><i class="icon-question-sign"></i></a>
              </div>
          </div>
        </div>  
        <?php } ?>
        <label class="checkbox">
          <!--<input name="chkRecordar" type="checkbox" value="remember-me"> Recordarme-->
        </label>
        <button class="btn btn-large btn-primary" type="submit">Entrar</button>
      </form>




		<form method="post" action="login.php">
			<input type="text" name="user">
			<input type="password" name="pass">
			<input type="submit">
		</form>	
</section>
<?php include("piepagina.php"); ?>