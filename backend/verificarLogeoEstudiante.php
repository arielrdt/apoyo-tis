<?php
include("conexionBD.php");
session_start(); 

echo json_encode(isset($_SESSION['ROL_CURSO'])  && ($_SESSION['ROL_CURSO']=='estudiante')    );
?>