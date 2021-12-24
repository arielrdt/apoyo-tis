<?php
include("conexionBD.php");
session_start();
$mes=(int)date("m");
$anio=(int)date("Y");
$semestre_anio='';
if($mes<6){
    $semestre_anio=('1-'. date("Y"));
}
else{
    $semestre_anio=('2-'. date("Y"));
}

$consultaSQL="SELECT TITULO_DOCUMENTO,SEMESTRE_ANIO,DESCRIPCION,FECHA_LIMITE
from invitacion_publica
WHERE SEMESTRE_ANIO='$semestre_anio';
"

;

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
$fila=mysqli_fetch_array($ejecucionConsulta);
if(isset($fila['TITULO_DOCUMENTO'])){
     $JSONInvitacion=array(
      'titulo'=>$fila['TITULO_DOCUMENTO'],
      'semestre'=>$fila['SEMESTRE_ANIO'],
      'fecha'=>$fila['FECHA_LIMITE'],
      'descripcion'=>$fila['DESCRIPCION']
       );
       echo json_encode($JSONInvitacion);
     }
else{
     echo json_encode(null);
}

?>