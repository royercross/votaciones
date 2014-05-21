<?php 
    $error=false; 
    include_once "check.php";

    require_once("php/mysqlpdo.php");   
    $mysql = new DBMannager();      
    $mysql->connect();  

    $query="SELECT count(id_voto) as total, b.nombre, b.apellido_paterno, b.apellido_materno,b.sexo,b.fbid FROM votos a INNER JOIN alumnos b ON a.id_votado=b.id_alumno WHERE b.sexo='Masculino' GROUP BY id_votado ORDER BY total DESC";   
    $mysql->execute($query);
    $faltantes=0;
    $masvotadosH=$mysql->count();
    $masVotadosH=array();  
    if($masvotadosH > 0){
        while($row=$mysql->getRow()){
            array_push($masVotadosH, array("sexo" => $row['sexo'], "total" => $row['total'], "nombre" => $row['nombre'], "apellido_paterno" => $row['apellido_paterno'], "apellido_materno" => $row['apellido_materno'], "fbid" => $row['fbid']));
        }
        
    }
    if($masvotadosH < 3){
        $faltantes=3-$masvotadosH;
    }    

    for ($i=0; $i < $faltantes; $i++) { 
        array_push($masVotadosH, array("total" => 0 , "nombre" => "?", "apellido_paterno" => "?", "apellido_materno" => "?"));
    }

    $query="SELECT count(id_voto) as total, b.nombre, b.apellido_paterno, b.apellido_materno,b.sexo,b.fbid FROM votos a INNER JOIN alumnos b ON a.id_votado=b.id_alumno WHERE b.sexo='Femenino' GROUP BY id_votado ORDER BY total DESC";   
    $mysql->execute($query);
    $faltantes=0;
    $masvotadosM=$mysql->count();
    $masVotadosM=array();  
    if($masvotadosM > 0){
        while($row=$mysql->getRow()){
            array_push($masVotadosM, array("sexo" => $row['sexo'], "total" => $row['total'], "nombre" => $row['nombre'], "apellido_paterno" => $row['apellido_paterno'], "apellido_materno" => $row['apellido_materno'], "fbid" => $row['fbid']));
        }
        
    }
    if($masvotadosM < 3){
        $faltantes=3-$masvotadosM;
    }    

    for ($i=0; $i < $faltantes; $i++) { 
        array_push($masVotadosM, array("total" => 0 , "nombre" => "?", "apellido_paterno" => "?", "apellido_materno" => "?"));
    }    
    //print_r($masVotados);
?>

<?php include("encabezado_interior.php"); ?>
<?php include("menu.php"); ?>
<section class="columns votantes-wrapper">
        <section class="large-12 rows lugares">
            <h2 class="titulo">Los más votados</h2>            
        </section>
        <section class="large-12 rows lugares">
            <h2 class="titulo-l">Hombres</h2>            
            <h2 class="titulo-r">Mujeres</h2>            
        </section>        
    <?php        
        shuffle($masVotadosH);
        shuffle($masVotadosM);
        for($i=0; $i < 3; $i++){
        //foreach($masVotadosH as $votante){
            $votante=$masVotadosH[$i];
            $nombre_completo = $votante['nombre']." ".$votante['apellido_paterno']." ".$votante['apellido_materno'];
    ?>
        <section class="large-12 rows lugares">
        <div class="ganador">
            <?php 
                if(isset($votante['fbid']) && strlen($votante['fbid']) > 4){
            ?>
                <img src="https://graph.facebook.com/v2.0/<?=$votante['fbid'];?>/picture?type=large" alt="" />
            <?php
                }else{
            ?>
            <img src="imagenes/facebook.jpg" alt="" />
            <?php
                }
            ?>
            <span class="nombre"><?=$nombre_completo;?></span>
        </div>
    <?php
        $votante=$masVotadosM[$i];
        $nombre_completo = $votante['nombre']." ".$votante['apellido_paterno']." ".$votante['apellido_materno'];
    ?>
        <div class="ganador">
            <?php 
                if(isset($votante['fbid']) && strlen($votante['fbid']) > 4){
            ?>
                <img src="https://graph.facebook.com/v2.0/<?=$votante['fbid'];?>/picture?type=large" alt="" />
            <?php
                }else{
            ?>
            <img src="imagenes/facebook.jpg" alt="" />
            <?php
                }
            ?>
            <span class="nombre"><?=$nombre_completo;?></span>
        </div>        
        </section>
    <?php            
        }
    ?>
    
</section>
<?php include("piepagina.php"); ?>