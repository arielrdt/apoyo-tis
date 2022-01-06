<?php
//@param conexionBD:se importa la base de datos
//se recupera la sesion actual iniciada
//@param asistencia:el tipo de asistencia a registrar
//@param codigoSis:codigo sis del estudiante
//@param notaParticipacion:nota de la participacion semanal
//@param fechaActual:fecha actual

include("conexionBD.php");
session_start(); 
$codigoSis=$_POST['codigoSis'];
$asistencia=$_POST['asistencia'];
$notaParticipacion=$_POST['nota'];
$fechaActual=date("Y-m-d");

//funcion para registrar la evaluacion del estudiante en la base de datos
//en la tabla de ASISTENCIA y PARTICIPACION
function registrarEvaluacionSemanal($conexionBD,$codigoSis,$asistencia,$fechaActual,$notaParticipacion){

$consultaAsistencia="INSERT INTO asistencia(FECHA_ASISTENCIA,CODIGO_SIS,TIPO_ASISTENCIA) 
VALUES('".$fechaActual."','".$codigoSis."','".$asistencia."')";
$ejecucionConsultaAsistencia=mysqli_query($conexionBD,$consultaAsistencia);

$consultaParticipacion="INSERT INTO participacion(FECHA_PARTICIPACION,CODIGO_SIS,NOTA_PARTICIPACION) 
values('$fechaActual','$codigoSis','$notaParticipacion')";
$ejecucionConsultaParticipacion=mysqli_query($conexionBD,$consultaParticipacion);



echo json_encode("exito");

}

registrarEvaluacionSemanal($conexionBD,$codigoSis,$asistencia,$fechaActual,$notaParticipacion);

?>