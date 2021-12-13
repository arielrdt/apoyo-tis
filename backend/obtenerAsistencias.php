<?php
include("conexionBD.php");
session_start(); 
$clase=$_SESSION['COD_CLASE'];

function obtenerAsistencia($codSis,$tipoAsistencia,$conexionBD){
    $cantidad=0;
    $consulta="SELECT estudiante.CODIGO_SIS,
    TIPO_ASISTENCIA,
    COUNT(TIPO_ASISTENCIA) as CANTIDAD
    from estudiante,asistencia
    WHERE estudiante.CODIGO_SIS=asistencia.CODIGO_SIS
    AND estudiante.CODIGO_SIS='$codSis'
    and TIPO_ASISTENCIA='$tipoAsistencia'
    group by(TIPO_ASISTENCIA)";
    
    $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
    $fila=mysqli_fetch_array($ejecucionConsulta);
    if(isset($fila['CANTIDAD'])){
    $cantidad=$fila['CANTIDAD'];}

    return $cantidad;
}


function obtenerAsistenciasSemanales($clase,$conexionBD){
$respuesta=array();

$consulta="SELECT *
from estudiante
where cod_clase='$clase'";
$ejecucionConsulta=mysqli_query($conexionBD,$consulta);
$i=0;

while($filaTabla=mysqli_fetch_array($ejecucionConsulta))
{ 
    $codigo=$filaTabla['CODIGO_SIS'];
    $nombre=$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'];
    $empresa=$filaTabla['NOMBRE_CORTO'];

    $presentes=obtenerAsistencia($codigo,'P',$conexionBD);
    $tardes=obtenerAsistencia($codigo,'T',$conexionBD);
    $ausentes=obtenerAsistencia($codigo,'A',$conexionBD);
         $infoEstudiante=array(
          'cod_sis'=>$codigo,
          'nombre'=>$nombre,
          'grupo'=>$empresa,
          'presentes'=>$presentes,
          'tardes'=>$tardes,
          'ausentes'=>$ausentes,
        );

$respuesta=array_merge(($respuesta),array($infoEstudiante));

}  


echo json_encode($respuesta);
}

obtenerAsistenciasSemanales($clase,$conexionBD);

?>