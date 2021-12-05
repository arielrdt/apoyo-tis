<?php
include("conexionBD.php");
session_start(); 
$clase=$_SESSION['COD_CLASE'];

function obtenerPromediosSemanales($clase,$conexionBD){
$respuesta=array();

$consulta="SELECT estudiante.CODIGO_SIS, NOMBRE,APELLIDO_PATERNO,APELLIDO_MATERNO,NOMBRE_CORTO,avg(nota_participacion) as promedio
from estudiante,participacion
where estudiante.CODIGO_SIS=participacion.CODIGO_SIS
and COD_CLASE='$clase'
order by(estudiante.CODIGO_SIS)";
$ejecucionConsulta=mysqli_query($conexionBD,$consulta);

while($filaTabla=mysqli_fetch_array($ejecucionConsulta))
{ 
    $codigo=$filaTabla['CODIGO_SIS'];
    $nombre=$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'];
    $empresa=$filaTabla['NOMBRE_CORTO'];
    $promedioNotas=$filaTabla['promedio'];
         $infoEstudiante=array(
          'cod_sis'=>$codigo,
          'nombre'=>$nombre,
          'grupo'=>$empresa,
          'promedioNotas'=>$promedioNotas,
           );

$respuesta=array_merge(($respuesta),array($infoEstudiante));

}  

echo json_encode($respuesta);
}


obtenerPromediosSemanales($clase,$conexionBD);

?>