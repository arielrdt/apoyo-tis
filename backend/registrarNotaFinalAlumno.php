<?php
//@param conexionBD:se importa la base de datos
//se recupera la sesion actual iniciada
//@param codigoAlumno:codigo sis del estudiante
//@param nota:nota final

include("conexionBD.php");
session_start(); 
$codigoAlumno=$_POST['codigoSis'];
$nota=$_POST['nota'];

//funcion para registrar la nota final del alumno en la base de datos
//actulizando el campo NOTA_EXAMEN_FINAL de la tabla ESTUDIANTE
function subirNotaFinalAlumno($conexionBD,$nota,$codigoAlumno){
    $query="UPDATE estudiante
            SET NOTA_EXAMEN_FINAL='$nota' 
            WHERE CODIGO_SIS='$codigoAlumno'";

    $result=mysqli_query($conexionBD,$query);
    echo json_encode("Nota publicada con exito");
}

subirNotaFinalAlumno($conexionBD,$nota,$codigoAlumno);
?>