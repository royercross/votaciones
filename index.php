<?php $error=false; ?>
<?php include("login.php"); ?>
<?php include("encabezado.php"); ?>
<div class="login panel">	
    <form class="" method="post" action="" data-abide>
        <?php if($error==1){ ?>
          <div class="alert-box alert">El usuario o contraseña no es valido.<a href="#" class="close">&times;</a></div>
        <?php } ?>  
        <?php if($error==2){ ?>
          <div class="alert-box alert">El captcha introducido no es valido.<a href="#" class="close">&times;</a></div>
        <?php } ?>             
        <fieldset>          
          <legend>Acceso</legend>              
          <div class="input-wrapper">
            <input name="user" type="text" placeholder="usuario" required>
            <small class="error">El usuario es requerido.</small>
          </div>
          <div class="input-wrapper">
            <input name="pass" type="password" class="" placeholder="contraseña" required>
            <small class="error">La contraseña es requerida.</small>
          </div>
           <button type="submit">Entrar</button>
         </fieldset>

         <a href="recuperar_password.php">¿Olvidaste tu contraseña?</a>
     </form>
</div>
<?php include("piepagina.php"); ?>