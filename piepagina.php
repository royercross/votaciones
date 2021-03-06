
    <?php if(!isset($loadScripts) || $loadScripts){ ?>
    <script src="<?=$ruta;?>lib/jquery.js"></script>
    <script type="text/javascript" src="https://cdn.firebase.com/js/client/1.0.11/firebase.js"></script>
    <script type="text/javascript" src="https://cdn.firebase.com/js/simple-login/1.3.2/firebase-simple-login.js"></script>
    <script src="<?=$ruta;?>lib/foundation.min.js"></script>
    <script src="<?=$ruta;?>lib/foundation.abide.js"></script>
    <script src="<?=$ruta;?>lib/foundation.alert.js"></script>
    <script src="<?=$ruta;?>lib/foundation.tab.js"></script>
    <?php } ?>
    <script>
      $(document).foundation();
      $(document).ready(function(){
        if($('.alert-hide').length){$('.alert-hide').fadeIn(3000);setTimeout(function(){$('.alert-hide').fadeOut(1000);},3000);}
      });

      var loginRef = new Firebase('https://fimazestudiantes.firebaseIO.com');
      var auth = new FirebaseSimpleLogin(loginRef, function(error, user) {
        if(error){
            console.log(error);
            aler('Ocurrio un error inesperado.');
        }else if(user) {
            $.ajax({
              type: "POST",
              url: "guardafbid.php",
              data: "fbid="+user.id,
              success: function(data){
                $('#fblogin').hide();
              },
              dataType: "json"
            });
        }else{
            console.log('El usuario no esta iniciado');
        }
      });

     $('#btnLogout').bind('click', function(){
      auth.logout();
      window.location.href = 'https://fimazvotaciones.azurewebsites.net/logout.php';
     });

     $('#fblogin').bind('click', function(){
        auth.login('facebook', {
          rememberMe: true
        });
      });
    </script>
  </body>
</html>