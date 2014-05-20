<?php
    include_once "FIMAZConfig.php";
    include_once "Votos.php";
	$error=false;
    $votos = new Votos();
    $me = $votos->me();
    echo ($me->nombre . ' ' . $me->apellido_paterno . $me->fbid);
?>
<?php include("encabezado.php"); ?>
<div class="perfil">
    <img src="imagenes/fblogin.png" id="fblogin" />
    <input type="text" id="fbid" />
</div>
<?php include("piepagina.php"); ?>