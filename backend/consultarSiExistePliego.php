<?php
include("conexionBD.php");
session_start();
$consultaSQL="SELECT TITULO_DOCUMENTO,SEMSTRE_ANIO,DESCRIPCION 
from pliego_especificaciones";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
$fila=mysqli_fetch_array($ejecucionConsulta);

     $JSONPliego=array(
      'titulo'=>$fila['TITULO_DOCUMENTO'],
      'semestre'=>$fila['SEMSTRE_ANIO'],
      'descripcion'=>$fila['DESCRIPCION']
       );

echo json_encode($JSONPliego);
?>