<?php
include("conexionBD.php");
session_start(); 
$cod_estudiante=$_SESSION['CODIGO_SIS'];
$se_vio=$_POST['sevio'];
$se_vera=$_POST['veremos'];
$fechaSubida=date("Y-m-d");
function registrarApunte($conexionBD,$cod_estudiante,$se_vio,$se_vera,$fechaSubida){
    $query="INSERT INTO APUNTE
    (fecha_apunte,
     CODIGO_SIS,
     seVio,
     Veremos,
     enlace
    )VALUES(
     '$fechaSubida',
     '$cod_estudiante',
     '$se_vio',
     '$se_vera',
      null 
      )";
    $result=mysqli_query($conexionBD,$query);
    echo json_encode("¡Apunte registrado!".$result);
}

registrarApunte($conexionBD,$cod_estudiante,$se_vio,$se_vera,$fechaSubida);
?>