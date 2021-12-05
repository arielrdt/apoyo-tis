<?php
include("conexionBD.php");
session_start();
$carnetDocente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
$semestre=$_SESSION['SEMESTRE'];

function obtenerAlumnos($conexionBD,$carnetDocente,$semestre){
$listaAlumnos='<h3>LISTA DE ALUMNOS</h3><table class="tabla-estudiantes">
<tr class="titulo">  
<td>Nombre del alumno</td>
<td>Codigo SIS</td>
<td>Calificación</td>
<td>Opción</td>
</tr>
';
$consultaSQL="SELECT * 
              from estudiante,clase 
              where estudiante.COD_CLASE=clase.COD_CLASE
              and clase.SEMESTRE='$semestre'
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
$listaAlumnos.='
<tr>  
<td>'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'</td>
<td>'.$filaTabla['CODIGO_SIS'].'</td>';
if(isset($filaTabla['NOTA_EXAMEN_FINAL'])){
$listaAlumnos.='<td>'.$filaTabla['NOTA_EXAMEN_FINAL'].'</td>'; 
}
else{$listaAlumnos.='<td>no calificado</td>';}
$listaAlumnos.='
<td><button onclick="cargarDatos('.$filaTabla['CODIGO_SIS'].','.'`'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'`'.')">asignar nota final</button></td>
</tr>';
}
$listaAlumnos.='</table>';

echo json_encode($listaAlumnos);
}
obtenerAlumnos($conexionBD,$carnetDocente,$semestre);

?>