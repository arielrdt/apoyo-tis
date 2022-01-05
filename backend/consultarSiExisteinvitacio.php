<?php
//se importa la base de datos
//se recupera la sesion actual iniciada
//@param cod_clase:se recupera el codigo de la clase en la que ingreso el docente
//@param semestre_anio:se calcula el semestre en base al mes y año actuales
include("conexionBD.php");
session_start();
$cod_clase=$_SESSION['COD_CLASE'];
$mes=(int)date("m");
$anio=(int)date("Y");
$semestre_anio='';
if($mes<6){
    $semestre_anio=('1-'. date("Y"));
}
else{
    $semestre_anio=('2-'. date("Y"));
}
//conuslta para recuperar las invitaciones publicas del semestre actual
//y clase correspondiente
$consultaSQL="SELECT TITULO_DOCUMENTO,SEMESTRE_ANIO,DESCRIPCION,FECHA_LIMITE
from invitacion_publica
WHERE SEMESTRE_ANIO='$semestre_anio'
AND COD_CLASE='$cod_clase'";
$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
$fila=mysqli_fetch_array($ejecucionConsulta);

//si existe una  invitacion ,retornar sus datos en formato JSON
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
    //sino retornar null
     echo json_encode(null);
}

?>