<?php
//recuperar la conexion con la base de datos
//recupera la sesion actual activa
// destruccion de los datos de la sesion activa
include("conexionBD.php");
session_start(); 
session_destroy();
?>