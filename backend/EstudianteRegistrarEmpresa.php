<?php
//@param conexionB:se importa la base de datos
//se recupera la sesion actual iniciada
//@param nombre_corto:nombre corto de la nueva empresa
//@param nombre_largo: nombre largo de la nueva empresa
//@param sociedad: tipo de sociedad de la nueva empresa
//@param direccion: direccion de la empresa
//@param telefono: telefono de la empresa
//@param correo: correo de la empresa
//@param fecha: fecha de creacion de la empresa
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
//funcion para generar un codigo de union de la empresa con formato
// de 6 digitos
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
        CODIGO_UNION,
        limiteMiembros)
      VALUES 
     ('$nombre_corto',
     '$nombre_largo',
     '$sociedad',
     '$fecha',
     '$telefono',
     '$direccion',
     '$correo',
     '$codigoUnion',
      '5'
     )";
     $result=mysqli_query($conexionBD,$query);
}
//funcion para que el estudiante que creo la empresa, tenga el rol
//representante legal
function actualizarDatosEstudiante($conexionBD,$codigoEstudiante,$nombre_corto,$nombre_largo)
{
$consulta="UPDATE ESTUDIANTE SET NOMBRE_CORTO='$nombre_corto',NOMBRE_LARGO='$nombre_largo',ROL='representante legal' WHERE CODIGO_SIS='$codigoEstudiante'";
$resultadoConsulta=mysqli_query($conexionBD,$consulta);

}
//funcion para validar que el nombre de la empresa no se repita
function empresaNoRepetida($conexionBD,$nombre_corto){
  $consulta="SELECT NOMBRE_CORTO FROM GRUPO_EMPRESA WHERE NOMBRE_CORTO='$nombre_corto'";
  $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
  $resultado=mysqli_fetch_array($ejecucionConsulta);
  return(!isset($resultado['NOMBRE_CORTO']));
}

//funcion para actualizar la empresa a la que pertenece el estudiante
//si no pertenece a ninguna
function agregarEmpresaALaSesionDelEstudiante($nombre_corto){
  $_SESSION['EMPRESA']=$nombre_corto;
}

//funcion para crear la empresa
//si el nombre no esta repetido
//y actualizar la empresa a la que pertenece el estudiante y su rol
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