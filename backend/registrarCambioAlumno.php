<?php
//@param conexionB:se importa la base de datos
//se recupera la sesion actual iniciada
//@param codigoAlumno:codigo sis del alumgno
//@param rol: nuevo rol del alumno

include("conexionBD.php");
session_start(); 
$codigoAlumno=$_POST['codigoSis'];
$rol=$_POST['rol'];

//funcion para cambiar el rol del alumno en la base de datos
function cambiarRolAlumno($conexionBD,$rol,$codigoAlumno){
    $query="UPDATE estudiante
            SET ROL='$rol' 
            WHERE CODIGO_SIS='$codigoAlumno'";

    $result=mysqli_query($conexionBD,$query);
    echo json_encode("Rol cambiadocon exito");
}

cambiarRolAlumno($conexionBD,$rol,$codigoAlumno);
?>