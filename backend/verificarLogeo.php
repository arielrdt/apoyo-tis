<?php
include("conexionBD.php");
session_start(); 
if(isset($_SESSION['ROL_CURSO'])){
    echo json_encode($_SESSION['ROL_CURSO']);
}
else{echo json_encode('none');}

?>