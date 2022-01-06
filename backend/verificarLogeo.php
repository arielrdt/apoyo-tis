<?php
//@param conexionBD:se importa la base de datos
include("conexionBD.php");
//se recupera la sesion actual iniciada
session_start(); 

//si hay una sesion con rol de curso de docente o estudiante
///regresar el rol del curso sino none
if(isset($_SESSION['ROL_CURSO'])){
    echo json_encode($_SESSION['ROL_CURSO']);
}
else{echo json_encode('none');}

?>