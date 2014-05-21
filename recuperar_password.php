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
          <div class="alert-box sucess"><?=$mensaje_completado;?><a href="#" class="close">&times;</a></div>
        <?php }else{ ?>             

        <?php 
          if(isset($_GET['k']) && strlen($_GET['k']) == 64){
              require_once("php/mysqlpdo.php"); 
              $mysql = new DBMannager();    
              $mysql->connect();  
              $query="SELECT * FROM recuperar_cuentas WHERE rkey=? and status=1";
              $mysql->execute($query,array($_GET['k'])); 
              if($mysql->count() > 0){
        ?>
            <fieldset>          
              <legend>Recuperacion de datos</legend>              
              <div class="alert-box info">Coloca la nueva contraseña dos veces.</div>
              <div class="input-wrapper">
                <input name="pass1" id="pass1" type="password" placeholder="Contraseña Nueva" required>
                <small class="error">Este campo es requerido.</small>
              </div>
              <div class="input-wrapper">
                <input name="pass2" type="password" placeholder="Repetir Contraseña" data-equalto="pass1" required>
                <small class="error">Las contraseñas no coinciden.</small>
              </div>
              <input type="hidden" name="rkey" value="<?=$_GET['k'];?>" />
               <button type="submit">Cambiar</button>
             </fieldset>        
        <?php
          }else{
        ?>
            <fieldset>          
              <legend>Recuperacion de datos</legend>              
              <div class="alert-box alert">Ya ha recuperado la cuenta con este enlace.</div>
             </fieldset>               
        <?php } ?>
        <?php
          }else{
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
         <?php }} ?>
     </form>
</div>
<?php include("piepagina.php"); ?>