<?php $error=false; ?>
<?php include("login.php") ?>
<?php include("encabezado.php"); echo $error;?>
<div class="login panel">	
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
            <input name="user" type="text" class="input-block-level" placeholder="usuario" data-validation-required-message="Usuario requerido." required>
            <p class="help-block"></p>
        </div>        
        <div class="control-group">
	        <input name="pass" type="password" class="input-block-level" placeholder="contraseña" data-validation-required-message="Contraseña requerida."  required>
            <p class="help-block"></p>            
        </div>                       
        <label class="checkbox">
          <!--<input name="chkRecordar" type="checkbox" value="remember-me"> Recordarme-->
        </label>
        <button class="btn btn-large btn-primary" type="submit">Entrar</button>
      </form>
</div>
<?php include("piepagina.php"); ?>