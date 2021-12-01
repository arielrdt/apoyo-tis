<?php
include("conexionBD.php");
session_start(); 
$codigoAlumno=$_POST['codigoSis'];
$nota=$_POST['nota'];

function subirNotaFinalAlumno($conexionBD,$nota,$codigoAlumno){
    $query="UPDATE estudiante
            SET NOTA_EXAMEN_FINAL='$nota' 
            WHERE CODIGO_SIS='$codigoAlumno'";

    $result=mysqli_query($conexionBD,$query);
    echo json_encode("Nota publicada con exito");
}

subirNotaFinalAlumno($conexionBD,$nota,$codigoAlumno);
?>