<?php
//@param conexionBD:se importa la base de datos

//se obtiene el nombre completo y el codigo de clase del alumno o docente
//se arma un string con el codigo html que sera importado al front end
include("conexionBD.php");
//se recupera la sesion actual iniciada
session_start();
$htmlPerfil='<h5>Nombre:'.$_SESSION['NOMBRE'].' '.$_SESSION['APELLIDO_PATERNO'].' '.$_SESSION['APELLIDO_MATERNO'].'('.$_SESSION['ROL_CURSO'].')</h5>
<br>
<h5>Clase:'.$_SESSION['COD_CLASE'].'</h5>
'
;
echo json_encode($htmlPerfil);
?>