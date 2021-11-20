<?php
include("conexionBD.php");
session_start(); 
$codigoEstudiante=$_SESSION['CODIGO_SIS'];
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


