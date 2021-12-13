<?php
include("conexionBD.php");
session_start();
$carnetDocente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
$semestre=$_SESSION['SEMESTRE'];
$fechaActual=date("Y-m-d");

function obtenerAlumnos($conexionBD,$carnetDocente,$semestre, $fechaActual){
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
$consultaSQL="SELECT * 
              from estudiante,grupo_empresa,clase 
              where estudiante.COD_CLASE=clase.COD_CLASE
              and clase.SEMESTRE='$semestre'
              and estudiante.NOMBRE_CORTO=grupo_empresa.NOMBRE_CORTO
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
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