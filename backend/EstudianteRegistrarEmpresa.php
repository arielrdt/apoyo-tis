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
$consulta="UPDATE ESTUDIANTE SET NOMBRE_CORTO='$nombre_corto',NOMBRE_LARGO='$nombre_largo',ROL='representante legal' WHERE CODIGO_SIS='$codigoEstudiante'";
$resultadoConsulta=mysqli_query($conexionBD,$consulta);

}

function empresaNoRepetida($conexionBD,$nombre_corto){
  $consulta="SELECT NOMBRE_CORTO FROM GRUPO_EMPRESA WHERE NOMBRE_CORTO='$nombre_corto'";
  $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
  $resultado=mysqli_fetch_array($ejecucionConsulta);
  return(!isset($resultado['NOMBRE_CORTO']));
}

function agregarEmpresaALaSesionDelEstudiante($nombre_corto){
  $_SESSION['EMPRESA']=$nombre_corto;
}


function subirDatos($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo,$codigoEstudiante){
      if(empresaNoRepetida($conexionBD,$nombre_corto)){
        crearEmpresa($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo,$codigoEstudiante);
        actualizarDatosEstudiante($conexionBD,$codigoEstudiante,$nombre_corto,$nombre_largo);
        agregarEmpresaALaSesionDelEstudiante($nombre_corto);
        echo json_encode(true);}
       else{echo json_encode(false);}
}


subirDatos($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo,$codigoEstudiante);

?>