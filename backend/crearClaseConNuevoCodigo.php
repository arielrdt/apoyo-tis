<?php
include("conexionBD.php");
session_start(); 
$semestre;
$mes=date("m");
$anio=date("Y");

$docente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
if($mes<7){$semestre='1-'.$anio;}
else{$semestre='2-'.$anio;}

$letras=array('a','c','e','j','p','f','z');
$letra1=$letras[rand(0,6)];
$letra2=$letras[rand(0,6)];

function generarCodigo($semestre,$letra1,$letra2){
return ($semestre."".rand(1,9)."".rand(3,8)."".$letra1."".$letra2);
}


function crearClase($semestre,$conexionBD,$docente,$letra1,$letra2){
    $nuevoCodigo=generarCodigo($semestre,$letra1,$letra2);
    $query="INSERT INTO CLASE
    (COD_CLASE,
    SEMESTRE,
    NUMERO_CARNET_IDENTIDAD_DOCENTE
    )VALUES(
    '$nuevoCodigo',
    '$semestre',
    '$docente'
    )";
    $result=mysqli_query($conexionBD,$query);
    $_SESSION['CODIGO_SIS']=$nuevoCodigo;
    echo json_encode("clase creada con exito");
}
crearClase($semestre,$conexionBD,$docente,$letra1,$letra2);

?>