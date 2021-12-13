<?php
include("conexionBD.php");
session_start(); 
$codigoSis=$_POST['codigoSis'];
$asistencia=$_POST['asistencia'];
$notaParticipacion=$_POST['nota'];

$fechaActual=date("Y-m-d");

function registrarEvaluacionSemanal($conexionBD,$codigoSis,$asistencia,$fechaActual,$notaParticipacion){

$consultaAsistencia="INSERT INTO asistencia(FECHA_ASISTENCIA,CODIGO_SIS,TIPO_ASISTENCIA) 
VALUES('".$fechaActual."','".$codigoSis."','".$asistencia."')";
$ejecucionConsultaAsistencia=mysqli_query($conexionBD,$consultaAsistencia);

$consultaParticipacion="INSERT INTO participacion(FECHA_PARTICIPACION,CODIGO_SIS,NOTA_PARTICIPACION) 
values('$fechaActual','$codigoSis','$notaParticipacion')";
$ejecucionConsultaParticipacion=mysqli_query($conexionBD,$consultaParticipacion);

/*
$consultaObservacion="INSERT INTO observacion(FECHA_OBSERVACION,MOTIVO_OBSERVACION,CODIGO_SIS) 
values('$fechaActual','$observacion','$codigoSis')";
$ejecucionConsultaObservacion=mysqli_query($conexionBD,$consultaObservacion);*/
echo json_encode("exito");

}

registrarEvaluacionSemanal($conexionBD,$codigoSis,$asistencia,$fechaActual,$notaParticipacion);

?>