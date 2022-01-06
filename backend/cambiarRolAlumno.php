<?php
//@param conexionBD:se importa la base de datos
//@param codigoAlumno:el codigo sis del alumno
//@param rol:el nuevo rol
include("conexionBD.php");
//recuperar la sesion
session_start(); 
$codigoAlumno=$_POST['codigoSis'];
$rol=$_POST['nuevoRol'];

//ejecucion de la consulta para cambiar el rol del alumno
function cambiarRolAlumno($conexionBD,$codigoAlumno,$rol){
    $query="UPDATE estudiante
            SET ROL='$rol'
            WHERE CODIGO_SIS='$codigoAlumno'";

    $result=mysqli_query($conexionBD,$query);
    echo json_encode("cambio de rol exitoso");
}

cambiarRolAlumno($conexionBD,$codigoAlumno,$rol);
?>