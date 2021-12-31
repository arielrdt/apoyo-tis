<?php
include("conexionBD.php");
session_start();
$cod_clase_actual=$_SESSION['COD_CLASE'];
$mes=(int)date("m");
$anio=(int)date("Y");
$semestre_anio='';
if($mes<6){
    $semestre_anio=('1-'.$anio);
}
else{
    $semestre_anio=('2-'.$anio);
}

$consultaSQL="SELECT *
FROM pliego_especificaciones
WHERE SEMSTRE_ANIO='$semestre_anio'
AND COD_CLASE='$cod_clase_actual'";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
$fila=mysqli_fetch_array($ejecucionConsulta);
if(isset($fila['TITULO_PLIEGO'])){
     $JSONInvitacion=array(
      'titulo'=>$fila['TITULO_PLIEGO'],
      'semestre'=>$fila['SEMSTRE_ANIO'],
      'descripcion'=>$fila['DESCRIPCION']
       );
       echo json_encode($JSONInvitacion);
     }
else{
     echo json_encode(null);
}

?>