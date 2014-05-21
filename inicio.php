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
    if($masvotados > 0){
        while($row=$mysql->getRow()){
            array_push($masVotadosH, array("sexo" => $row['sexo'], "total" => $row['total'], "nombre" => $row['nombre'], "apellido_paterno" => $row['apellido_paterno'], "apellido_materno" => $row['apellido_materno'], "fbid" => $row['fbid']));
        }
        
    }
    if($masvotados < 3){
        $faltantes=3-$masvotados;
    }    

    for ($i=0; $i < $faltantes; $i++) { 
        array_push($masVotados, array("total" => 0 , "nombre" => "?", "apellido_paterno" => "?", "apellido_materno" => "?"));
    }
    //print_r($masVotados);
?>

<?php include("encabezado_interior.php"); ?>
<?php include("menu.php"); ?>
<section class="columns votantes-wrapper">
    <h2 class="titulo">Los más votados</h2>
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