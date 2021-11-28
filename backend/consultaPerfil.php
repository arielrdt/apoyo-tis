<?php
include("conexionBD.php");
session_start();
$htmlPerfil='<h5>Nombre:'.$_SESSION['NOMBRE'].' '.$_SESSION['APELLIDO_PATERNO'].' '.$_SESSION['APELLIDO_MATERNO'].'('.$_SESSION['ROL_CURSO'].')</h5>
<br>
<h5>Clase:'.$_SESSION['COD_CLASE'].'</h5>
'
;
echo json_encode($htmlPerfil);
?>