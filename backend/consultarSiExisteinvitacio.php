<?php
include("conexionBD.php");
session_start();
$consultaSQL="SELECT TITULO_DOCUMENTO,SEMESTRE_ANIO,DESCRIPCION,FECHA_LIMITE
from invitacion_publica";

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