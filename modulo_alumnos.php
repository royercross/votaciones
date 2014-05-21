<?php require_once("check.php"); ?>
<?php require_once("acciones_modulo_alumnos.php"); ?>     
<?php require_once("encabezado_interior.php"); ?>
<?php require_once("menu.php"); ?>

  <?php $sidebar_selected=1; ?>
  <section class="row fullwidth">
    <!--
    <section class="large-2 columns">
      <?php /*include("sidebar.php");**/ ?>
    </section>
    -->
    <section class="large-12 columns instrucciones">
      <div class="alert-box info">      
        Recuerda que solo puedes seleccionar un candido Masculino y Femenino.<br /><br />
      <?php
        require_once("php/mysqlpdo.php");  
        $mysql = new DBMannager();    
        $mysql->connect();    
        $query="SELECT b.* FROM votos a INNER JOIN alumnos b ON a.id_votado=b.id_alumno WHERE a.id_alumno=?";   
        $mysql->execute($query,array($_SESSION['id_alumno']));
        $cont=0;
        if($mysql->count() > 0){    
            while($row=$mysql->getRow()){
              $nombre_completo=$row['nombre']." ".$row['apellido_paterno']." ".$row['apellido_materno'];
      ?> 
            <strong>Candidato <?=$row['sexo'];?>:</strong><?=$nombre_completo;?><br />
      <?php
        $cont++;
          }
        }else{
      ?>
        <strong>No haz seleccionado ningun candidato</strong>
      <?php
        }
      ?>
      </div>
    </section>
    <?php if($cont<2){ ?>
    <section class="large-12 columns">
      <?php        
        $query="SELECT a.* FROM alumnos a WHERE a.status=1 AND (a.id_carrera=1 OR a.id_carrera=2) ORDER BY a.id_alumno";   
        $mysql->execute($query);      
        if($mysql->count() < 1){    
      ?>      
        <div class="contenido">    

          <?php if(isset($_SESSION['mensaje'])){?>
          <div class="alert-box success alert-hide"><?=$_SESSION['mensaje'];?></div>       
          <?php unset($_SESSION['mensaje']);} ?>
          <div class="alert alert-error" >No se encontraron alumnos.</div>                    
        </div>
      <?php
      }else{
    ?>
      <div class="contenido">
        <?php if(isset($_SESSION['mensaje'])){?>
        <div class="alert-box success alert-hide"><?=$_SESSION['mensaje'];?></div>       
        <?php unset($_SESSION['mensaje']);}
          else
          if(isset($_SESSION['error'])){
        ?>
        <div class="alert-box alert alert-hide"><?=$_SESSION['error'];?></div>       
        <?php
          }
        ?>              
      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tabla">    
            <thead>
                <tr>                      
                      <th>Nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Opciones</th>
                  </tr>
              </thead>
              <tbody>
                <?php while($alumno=$mysql->getRow()){ ?>
                <tr>                      
                      <td><?=$alumno['nombre'];?></td>
                      <td><?=$alumno['apellido_paterno'];?></td>
                      <td class="tabla-acciones">
                       <!--<a href="#" class="icon-edit" onclick="ver(<?=$alumno['id_alumno'];?>);return false;" style="margin-right:10px;"></a>-->
                        <a href="#" class="" onclick="votar(<?=$alumno['id_alumno'];?>);return false;" >VOTAR</a>
                        <form style="display:none;" name="form<?=$alumno['id_alumno'];?>" id="form<?=$alumno['id_alumno'];?>" method="post">
                          <input type="hidden" name="id_alumno" value="<?=$alumno['id_alumno'];?>" />
                          <input type="hidden" name="accion" value="votar" />                            
                        </form>
                    </td>
                  </tr> 
                  <?php } ?>
              </tbody>
          </table>
      </div>    
      <?php } ?>            
    </section>
    <?php } ?>
  </section>

  <div id="modal-wrapper" class="reveal-modal" data-reveal></div>
</div>
<?php $loadScripts=false; ?>
<script src="<?=$ruta;?>lib/jquery.js"></script>
<script src="<?=$ruta;?>lib/foundation.min.js"></script>
<script src="<?=$ruta;?>lib/foundation.abide.js"></script>
<script src="<?=$ruta;?>lib/foundation.alert.js"></script>
<script src="<?=$ruta;?>lib/jquery.dataTables.min.js"></script>
<script src="<?=$ruta;?>lib/dataTables.foundation.js"></script>
<script type="text/javascript" src="https://cdn.firebase.com/js/client/1.0.11/firebase.js"></script>
<script type="text/javascript" src="https://cdn.firebase.com/js/simple-login/1.3.2/firebase-simple-login.js"></script>
    
<script>
	$(document).ready(function(){
    $("#tabla").dataTable({
      "oLanguage": {
        "sUrl": "lib/languages/es_MX.txt"
      },
      iDisplayLength: 10,
      aaSorting:[]
    });	
	});

  function votar(id){    
    if(confirm("¿Seguro que deseas votar por ??? ?")){    
        $('#form'+id).submit();
    }   
  }
</script>
<?php include("piepagina.php"); ?>