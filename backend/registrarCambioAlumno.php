<?php
include("conexionBD.php");
session_start(); 
$codigoAlumno=$_POST['codigoSis'];
$rol=$_POST['rol'];

function subirNotaFinalAlumno($conexionBD,$rol,$codigoAlumno){
    $query="UPDATE estudiante
            SET ROL='$rol' 
            WHERE CODIGO_SIS='$codigoAlumno'";

    $result=mysqli_query($conexionBD,$query);
    echo json_encode("Rol cambiadocon exito");
}

subirNotaFinalAlumno($conexionBD,$rol,$codigoAlumno);
?>