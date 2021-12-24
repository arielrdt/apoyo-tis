<?php
include("conexionBD.php");
session_start();
$mes=(int)date("m");
$anio=(int)date("Y");
$semestre_anio='';
if($mes<6){
    $semestre_anio=('1-'.$anio);
}
else{
    $semestre_anio=('2-'.$anio);
}

$consultaSQL="SELECT TITULO_DOCUMENTO,SEMSTRE_ANIO,DESCRIPCION 
from pliego_especificaciones
WHERE SEMSTRE_ANIO='$semestre_anio'";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
$fila=mysqli_fetch_array($ejecucionConsulta);
if(isset($fila['TITULO_DOCUMENTO'])){
     $JSONInvitacion=array(
      'titulo'=>$fila['TITULO_DOCUMENTO'],
      'semestre'=>$fila['SEMSTRE_ANIO'],
      'descripcion'=>$fila['DESCRIPCION']
       );
       echo json_encode($JSONInvitacion);
     }
else{
     echo json_encode(null);
}

?>