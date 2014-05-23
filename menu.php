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
      <li><a href="<?=$ruta;?>index.php">Inicio</a></li>    
      <?php if($_SESSION['botonfacebook']){ ?><li><img src="imagenes/fblogin.png" id="fblogin" /></li><?php } ?>
    </ul>
    <ul class="right">
      <li><a href="#" id="btnLogout">Salir</a></li>
    </ul>
  </section>
</div>