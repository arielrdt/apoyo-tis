<?php
include("conexionBD.php");
session_start(); 
$codigoAlumno=$_POST['codigoSis'];
$rol=$_POST['nuevoRol'];

function cambiarRolAlumno($conexionBD,$codigoAlumno,$rol){
    $query="UPDATE estudiante
            SET ROL='$rol'
            WHERE CODIGO_SIS='$codigoAlumno'";

    $result=mysqli_query($conexionBD,$query);
    echo json_encode("cambio de rol exitoso");
}

cambiarRolAlumno($conexionBD,$codigoAlumno,$rol);
?>