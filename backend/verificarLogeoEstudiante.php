<?php
//@param conexionBD:se importa la base de datos
include("conexionBD.php");
//se recupera la sesion actual iniciada
session_start(); 
// regresar true si el rol del curso del usuario que inicio sesion sea 
//de estudiante sino false
echo json_encode(isset($_SESSION['ROL_CURSO']) 
 && ($_SESSION['ROL_CURSO']=='estudiante')    );
?>