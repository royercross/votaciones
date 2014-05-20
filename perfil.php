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
    <p id="fblogin">Subir Fotografia desde Facebook</p>
</div>
<?php include("piepagina.php"); ?>