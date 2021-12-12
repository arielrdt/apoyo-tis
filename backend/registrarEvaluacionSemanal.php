<?php
include("conexionBD.php");
session_start(); 
$codigoSis=$_SESSION['codigoSis'];
// $justificacion=$_SESSION['justificacion'];
$asistencia=$_SESSION['asistencia'];
//$observacion=$_SESSION['observacion'];
$notaParticipacion=$_SESSION['nota'];

$fechaActual=date("Y-m-d");

function registrarEvaluacionSemanal($conexionBD,$codigoSis,$asistencia,$fechaActual){

$consultaAsistencia="INSERT INTO ASISTENCIA(FECHA_ASISTENCIA,CODIGO_SIS,TIPO_ASISTENCIA) 
VALUES('".$fechaActual."','".$codigoSis."','".$asistencia."')";
$ejecucionConsultaAsistencia=mysqli_query($conexionBD,$consultaAsistencia);

/*$consultaParticipacion="INSERT INTO PARTICIPACION(FECHA_PARTICIPACION,NOTA_PARTICIPACION,CODIGO_SIS) 
values('$fechaActual','$notaParticipacion','$codigoSis')";
$ejecucionConsultaParticipacion=mysqli_query($conexionBD,$consultaParticipacion);


$consultaObservacion="INSERT INTO observacion(FECHA_OBSERVACION,MOTIVO_OBSERVACION,CODIGO_SIS) 
values('$fechaActual','$observacion','$codigoSis')";
$ejecucionConsultaObservacion=mysqli_query($conexionBD,$consultaObservacion);*/
echo json_encode("exito");

if($ejecucionConsultaAsistencia) {
    echo "Database Updated With: <br />Name: " .$fechaActual. " <br />Title: ".$codigoSis." <br />Description: ".$asistencia."";

    // REMEMBER TO INCLUDE THE .""; AT THE END OF YOUR STATEMENT
    // EVERY STATEMENT NEEDS TO CLOSE PROPERLY
    // YOUR ORIGINAL STATEMENT DOES NOT DO THIS

} else {
    echo "Something's not right.  Nothing was inserted";
}

}

registrarEvaluacionSemanal($conexionBD,$codigoSis,$asistencia,$fechaActual);

?>