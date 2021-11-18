<?php
include("conexionBD.php");
session_start(); 
echo json_encode($_SESSION['ROL_CURSO'].'-'.$_SESSION['COD_CLASE']);
?>