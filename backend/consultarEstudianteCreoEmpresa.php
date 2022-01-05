<?php
//@param conexionBD:se importa la base de datos
//@param codigoEstudiante:el codigo sis del alumno
include("conexionBD.php");
//recuperar la sesion
session_start(); 
$codigoEstudiante=$_SESSION['CODIGO_SIS'];

//funcion para saber si el alumno ya creo o pertenece a una empresa
//consultando la tabla ESTUDIANTE Y GRUPO_EMPRESA
//retorna el codigo de la empresa a la que pertence
//si no none
function estudianteCreoEmpresa($conexionBD,$codigoEstudiante){
$consultaSQL="SELECT * FROM ESTUDIANTE as e,GRUPO_EMPRESA as g WHERE  e.NOMBRE_CORTO=g.NOMBRE_CORTO and CODIGO_SIS='$codigoEstudiante'";
$resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
$filaResultado=mysqli_fetch_array($resultadoConsulta);

if(isset($filaResultado['CODIGO_UNION']))
{echo json_encode($filaResultado['CODIGO_UNION']);}
else
{echo json_encode("none");}

}
estudianteCreoEmpresa($conexionBD,$codigoEstudiante);


