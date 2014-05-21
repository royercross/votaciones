<?php 
    $error=false; 
    include_once "check.php";

    require_once("php/mysqlpdo.php");   
    $mysql = new DBMannager();      
    $mysql->connect();  

    $query="SELECT count(id_voto) as total, b.nombre, b.apellido_paterno, b.apellido_materno,b.sexo FROM votos a INNER JOIN alumnos b ON a.id_votado=b.id_alumno GROUP BY id_votado ORDER BY total DESC";   
    $mysql->execute($query);
    $faltantes=0;
    $masvotados=$mysql->count();
    $masVotados=array();  
    if($masvotados > 0){
        while($row=$mysql->getRow()){
            array_push($masVotados, array("sexo" => $row['sexo'], "total" => $row['total'], "nombre" => $row['nombre'], "apellido_paterno" => $row['apellido_paterno'], "apellido_materno" => $row['apellido_materno']));
        }
        
    }
    if($masvotados < 6){
        $faltantes=6-$masvotados;
    }    

    for ($i=0; $i < $faltantes; $i++) { 
        array_push($masVotados, array("total" => 0 , "nombre" => "?", "apellido_paterno" => "?", "apellido_materno" => "?"));
    }
    //print_r($masVotados);
?>

<?php include("encabezado_interior.php"); ?>
<?php include("menu.php"); ?>
<section class="columns votantes-wrapper">
    <?php
        $cont=0;
        foreach($masVotados as $votante){
            $nombre_completo = $votante['nombre']." ".$votante['apellido_paterno']." ".$votante['apellido_materno'];
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