<?php
//@param conexionBD:se importa la base de datos
//@param cod_clase:se recupera el codigo de la clase en la que ingreso el docente
//@param semestre_anio:se calcula el semestre en base al mes y año actuales
include("conexionBD.php");
//se recupera la sesion actual iniciada
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

//consulta la tabla de PLIEGO_ESPESCIFICACIONES para recuperar los pliegos
//del semestre actual y clase correspondiente
$consultaSQL="SELECT *
FROM pliego_especificaciones
WHERE SEMSTRE_ANIO='$semestre_anio'
AND COD_CLASE='$cod_clase_actual'";
$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
$fila=mysqli_fetch_array($ejecucionConsulta);
//si existe un pliego ,retornar sus datos en formato JSON
if(isset($fila['TITULO_PLIEGO'])){
     $JSONInvitacion=array(
      'titulo'=>$fila['TITULO_PLIEGO'],
      'semestre'=>$fila['SEMSTRE_ANIO'],
      'descripcion'=>$fila['DESCRIPCION']
       );
       echo json_encode($JSONInvitacion);
     }
else{
    //sino retornar null
     echo json_encode(null);
}

?>