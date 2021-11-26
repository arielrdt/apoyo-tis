<?php
include("conexionBD.php");
session_start(); 
$nombre_corto=$_POST['nombreCortoEmpresa'];
$nombre_largo=$_POST['nombreLargoEmpresa'];
$sociedad=$_POST['sociedad'];
$direccion=$_POST['direccionEmpresa'];
$telefono=$_POST['telefonoEmpresa'];
$correo=$_POST['correoEmpresa'];
$fecha=date("Y-m-d");

function generarCodigo(){return(rand(20,35)."".rand(100,125)."".rand(1,11)."".rand(5,9)."".rand(2,9));}

function crearEmpresa($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo){
    $codigoUnion=generarCodigo();    
    $query="INSERT INTO grupo_empresa(
        NOMBRE_CORTO,	
        NOMBRE_LARGO,	
        TIPO_SOCIEDAD,
        FECHA_CREACION,
        TELEFONO,
        DIRECCION,	
        CORREO_ELECTRONICO,	
        CODIGO_UNION)
      VALUES 
     ('$nombre_corto',
     '$nombre_largo',
     '$sociedad',
     '$fecha',
     '$telefono',
     '$direccion',
     '$correo',
     '$codigoUnion')";
     $result=mysqli_query($conexionBD,$query);
}

function empresaNoRepetida($conexionBD,$nombre_corto){
  $consulta="SELECT NOMBRE_CORTO FROM GRUPO_EMPRESA WHERE NOMBRE_CORTO='$nombre_corto'";
  $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
  $resultado=mysqli_fetch_array($ejecucionConsulta);
  return(!isset($resultado['NOMBRE_CORTO']));
}


function subirDatos($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo){
      if(empresaNoRepetida($conexionBD,$nombre_corto)){
        crearEmpresa($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo);
        echo json_encode(true);}
       else{echo json_encode(false);}
}


subirDatos($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo);

?>