<div class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">FIMAZ</a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
    <ul class="left">
      <li><a href="<?=$ruta;?>inicio.php">Inicio</a></li>    
      <li><a href="<?=$ruta;?>modulo_alumnos.php">Votar</a></li>                  
      <li><img src="imagenes/fblogin.png" id="fblogin" /><form id="fbidform" action="guardafbid.php" method="post"><input type="hidden" id="fbid" /></form></li>    
</div>
    </ul>
    <ul class="right">
      <li><a href="<?=$ruta;?>logout.php">Salir</a></li>
    </ul>
  </section>
</div>