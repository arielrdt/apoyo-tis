<?php
//@param conexionB:se importa la base de datos
//se recupera la sesion actual iniciada

include("conexionBD.php");
session_start();

//retornar true si hay una sesion iniciada, ya sea con rol docente o estudiante
//sino false
echo json_encode(isset($_SESSION['ROL_CURSO']));
?>