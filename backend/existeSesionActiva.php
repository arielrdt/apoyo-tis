<?php
//@param conexionBD:se importa la base de datos
include("conexionBD.php");
//se recupera la sesion actual iniciada
session_start();

//retornar true si hay una sesion iniciada, ya sea con rol docente o estudiante
//sino false
echo json_encode(isset($_SESSION['ROL_CURSO']));
?>