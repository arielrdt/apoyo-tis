<?php
//importar la base de datos
//iniciar la sesion
//se recibe el codigo sis del alumno y el nuevo rol que tendra
include("conexionBD.php");
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