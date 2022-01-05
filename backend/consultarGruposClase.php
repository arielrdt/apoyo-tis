<?php
//se importa la base de datos
//se recupera la sesion actual iniciada
//se recupera el carnet del docente, de su sesion iniciada
//se recupera el semestre de su sesion iniciada
//se recupera la fecha actual
include("conexionBD.php");
session_start();
$carnetDocente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
$semestre=$_SESSION['SEMESTRE'];
$fechaActual=date("Y-m-d");

//se recupera los alumnos, por grupo empresa
//@param conexionBD la conexion a base de datos
//@param carnetDocente el carnet String
//@param fechaActual la fecha actual String

function obtenerAlumnos($conexionBD,$carnetDocente,$semestre, $fechaActual){
//se arma la tabla html con los alumnos(listaAlumnos) 
//como string para ser exportado al front end
$listaAlumnos='<h1 style="padding:10px; display: flex; justify-content: center;">Grupos de la clase</h1> <div style="padding:10px; display: flex; justify-content: center;"> La fecha de hoy es: '.$fechaActual.'</div>
<table class="tabla-estudiantes">
<tr class="titulo">  
<td>Nombre del alumno</td>
<td>Codigo SIS</td>
<td>Grupo-Empresa</td>
<td>Rol</td>

<td>Editar Rol</td>
</tr>
';

//consulta de los alumnos del docente
$consultaSQL="SELECT * 
              from estudiante,grupo_empresa,clase 
              where estudiante.COD_CLASE=clase.COD_CLASE
              and estudiante.NOMBRE_CORTO=grupo_empresa.NOMBRE_CORTO
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);

//por cada fila de resultado retornada de la BD 
//se concatena una fila a la ListaAlumnos con el nombre,rol y la empresa
//a la que pertenece el alumno
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
$listaAlumnos.='
<tr>  
<td>'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'</td>
<td>'.$filaTabla['CODIGO_SIS'].'</td>
<td>'.$filaTabla['NOMBRE_LARGO'].'('.$filaTabla['NOMBRE_CORTO'].')</td>

<td>'.$filaTabla['ROL'].'</td>

<td><button class="GFG" onclick="editarDatos('.$filaTabla['CODIGO_SIS'].','.'`'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].''.$filaTabla['ROL'].'`'.')">Editar</button></td>

'
;
$listaAlumnos.='
</tr>';
}
$listaAlumnos.='</table>';

echo json_encode($listaAlumnos);
}
obtenerAlumnos($conexionBD,$carnetDocente,$semestre,$fechaActual);

?>