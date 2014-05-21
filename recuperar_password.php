<?php $error=false;$completado=false; ?>
<?php include("acciones_recuperar.php"); ?>
<?php include("encabezado.php"); ?>
<div class="login panel">	
    <form class="" method="post" action="" data-abide>
        <a href="index.php">Regresar al inicio</a>
        <?php if($error==1){ ?>
          <div class="alert-box alert"><?=$mensaje_error;?><a href="#" class="close">&times;</a></div>
        <?php }else ?>  
        <?php if($completado==1){ ?>
          <div class="alert-box sucess">Se ha enviado un correo con las instrucciones para recuperación a la dirección: <?=$email;?><a href="#" class="close">&times;</a></div>
        <?php }else{ ?>             

        <?php 
          
        ?>
        <fieldset>          
          <legend>Recuperacion de datos</legend>              
          <div class="alert-box info">Coloca tu correo electronico para recuperar tus datos.</div>
          <div class="input-wrapper">
            <input name="email" type="text" placeholder="correo electronico" required>
            <small class="error">El email es requerido.</small>
          </div>
           <button type="submit">Recuperar</button>
         </fieldset>
         <?php } ?>
     </form>
</div>
<?php include("piepagina.php"); ?>