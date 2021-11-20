<?php
include("conexionBD.php");
session_start(); 
$codigoEstudiante=$_SESSION['CODIGO_SIS'];
$nombre_corto=$_POST['nombreCortoEmpresa'];
$nombre_largo=$_POST['nombreLargoEmpresa'];
$sociedad=$_POST['sociedad'];
$direccion=$_POST['direccionEmpresa'];
$telefono=$_POST['telefonoEmpresa'];
$correo=$_POST['correoEmpresa'];
$fecha=date("Y-m-d");

function generarCodigo(){return(rand(10,15)."".rand(1,9)."".rand(3,8)."".rand(33,39)."".rand(2,9));}

function crearEmpresa($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo,$codigoEstudiante){
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

function actualizarDatosEstudiante($conexionBD,$codigoEstudiante,$nombre_corto,$nombre_largo)
{
$consulta="UPDATE ESTUDIANTE SET NOMBRE_CORTO='$nombre_corto',NOMBRE_LARGO='$nombre_largo' WHERE CODIGO_SIS='$codigoEstudiante'";
$resultadoConsulta=mysqli_query($conexionBD,$consulta);
}

function subirDatos($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo,$codigoEstudiante){
      crearEmpresa($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo,$codigoEstudiante);
      actualizarDatosEstudiante($conexionBD,$codigoEstudiante,$nombre_corto,$nombre_largo);
      echo json_encode("Empresa creada con éxito");}


subirDatos($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo,$codigoEstudiante);

?>