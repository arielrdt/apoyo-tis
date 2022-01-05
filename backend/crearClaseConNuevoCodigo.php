<?php
//se importa la base de datos
//se recupera la sesion actual iniciada
//@param docente: se recupera el numero de carnetn del docente que inicio
//sesion
//@param semestre: se calcula el semestre en base a la fecha actual
include("conexionBD.php");
session_start(); 
$docente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
$semestre;
$mes=date("m");
$anio=date("Y");
if($mes<7){$semestre='1-'.$anio;}
else{$semestre='2-'.$anio;}
//@param letras: letras para formar un codigo de clase al azar
//mediante el uso de la funcion random: rand(minimo,maximo)
$letras=array('a','c','e','j','p','f','z');
$letra1=$letras[rand(0,6)];
$letra2=$letras[rand(0,6)];

//funcion para generar un cogido al azar con el semestre actual,
//2 numeros y 2 letras al azar
function generarCodigo($semestre,$letra1,$letra2){
return ($semestre."".rand(1,9)."".rand(3,8)."".$letra1."".$letra2);
}

//funcion para crear clase con el nuevo codigo 
//@param nuevoCodigo: codigo generado al azar
function crearClase($semestre,$conexionBD,$docente,$letra1,$letra2){
    $nuevoCodigo=generarCodigo($semestre,$letra1,$letra2);
//consulta para crear una nueva clase en la base de datos
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