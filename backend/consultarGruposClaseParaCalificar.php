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

//funcion para obtener los alumnos de la clase del docente
//@ param conexionBD conexion a la base de datos
//@ param carnetDocente carnet del docente con sesion iniciada
//@ param  semestre semestre actual
//@ param fechaActual fecha actual

function obtenerAlumnos($conexionBD,$carnetDocente,$semestre, $fechaActual){
//se arma la tabla html con los alumnos(listaAlumnos) 
//como string para ser exportado al front end
$listaAlumnos='<h1 style="padding:10px; display: flex; justify-content: center;">Asignar calificación semanal</h1> <div style="padding:10px; display: flex; justify-content: center;"> La fecha de hoy es: '.$fechaActual.'</div>
<table class="tabla-estudiantes">
<tr class="titulo">  
<td>Nombre del alumno</td>
<td>Codigo SIS</td>
<td>Grupo-Empresa</td>
<!--<td>Presente</td>
<td>Retraso</td>
<td>Falta</td>
<td>Nota</td>-->
<td>Opcion</td>

</tr>
';
//consulta de los alumnos de la clase del docente correspondienetes 
//al semestre actual
$consultaSQL="SELECT * 
              from estudiante,grupo_empresa,clase 
              where estudiante.COD_CLASE=clase.COD_CLASE
              and clase.SEMESTRE='$semestre'
              and estudiante.NOMBRE_CORTO=grupo_empresa.NOMBRE_CORTO
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
//de cada alumno se obtiene su nombre,cod sis y empresa a la que pertenece
//y un boton para calificarlo
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
$listaAlumnos.='
<tr>  
<td>'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'</td>
<td>'.$filaTabla['CODIGO_SIS'].'</td>

<td>'.$filaTabla['NOMBRE_LARGO'].'</td>
<!--
<td><input class="input" name="asistencia" id="asistencia" value="P" type="checkbox"></td>
<td><input class="input" name="asistencia" id="asistencia" value="T" type="checkbox"></td>
<td><input class="input" name="asistencia" id="asistencia" value="A" type="checkbox"></td>
<td><input class="input" name="notaParticipacion" id="notaParticipacion" type="number"></td>-->'
;
$listaAlumnos.='
<td><button class="GFG" onclick="datosSemanal('.$filaTabla['CODIGO_SIS'].','.'`'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'`'.')">Calificar</button></td>
</tr>';
}
$listaAlumnos.='</table>';

echo json_encode($listaAlumnos);
}
obtenerAlumnos($conexionBD,$carnetDocente,$semestre,$fechaActual);

?>