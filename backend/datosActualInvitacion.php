<?php
include("conexionBD.php");
session_start(); 

function obtenerAsistenciasSemanales($clase,$conexionBD){
    $consulta="SELECT *
    FROM INVITACION_PUBLICA";
    
    $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
    $fila=mysqli_fetch_array($ejecucionConsulta);
         $infoEstudiante=array(
          'cod_sis'=>$codigo,
          'nombre'=>$nombre,
          'grupo'=>$empresa,
          'presentes'=>$presentes,
          'tardes'=>$tardes,
          'ausentes'=>$ausentes,
        );

$respuesta=array_merge(($respuesta),array($infoEstudiante));


echo json_encode($respuesta);
}

obtenerAsistenciasSemanales($clase,$conexionBD);

?>