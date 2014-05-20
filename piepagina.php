    
    <?php if(!isset($loadScripts) || $loadScripts){ ?>
    <script src="lib/jquery.js"></script>
    <script src="lib/foundation.min.js"></script>
    <script src="lib/foundation.abide.js"></script>
    <script src="lib/foundation.alert.js"></script>
    <script src="lib/foundation.tabs.js"></script>
    <?php } ?>
    <script>
      $(document).foundation();
      $(document).ready(function(){
        if($('.alert-hide').length){$('.alert-hide').fadeIn(1000);setTimeout(function(){$('.alert-hide').fadeOut(1000);},3000);}
      });
    </script>
  </body>
</html>