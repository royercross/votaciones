<?php 
    $error=false; 
    include_once "check.php";
    include_once "Votos.php";
    $votos = new Votos();
    $masVotados = $votos->masVotados();
    $faltantes=0;
    if(count($masVotados) < 6){
        $faltantes=6-count($masVotados);        
    }

    for ($i=0; $i < $faltantes; $i++) { 
        array_push($masVotados, (Object) array("total" => 0 , "nombre" => "?", "apellido_paterno" => "?", "apellido_materno" => "?"));
    }
    //print_r($masVotados);
?>

<?php include("encabezado_interior.php"); ?>
<?php include("menu.php"); ?>
<section class="columns votantes-wrapper">
    <?php
        $cont=0;
        foreach($masVotados as $votante){
            $nombre_completo = $votante->nombre." ".$votante->apellido_paterno." ".$votante->apellido_materno;
            if($cont%2==0){
    ?>
            <section class="large-12 rows lugares">
    <?php
            }
    ?>
        <div class="ganador">
            <img src="imagenes/facebook.jpg" alt="" />
            <span class="nombre"><?=$nombre_completo;?></span>
        </div>
    <?php
            if($cont%2==1){
    ?>
        </section>
    <?php
            }
            $cont++;
        }
    ?>
    
</section>
<?php include("piepagina.php"); ?>