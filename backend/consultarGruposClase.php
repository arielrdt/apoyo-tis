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
<td>Rol</td>
<td>Editar Rol</td>
<td>Eliminar</td>

</tr>
';
$consultaSQL="SELECT * 
              from estudiante,grupo_empresa,clase 
              where estudiante.COD_CLASE=clase.COD_CLASE
              and estudiante.NOMBRE_CORTO=grupo_empresa.NOMBRE_CORTO
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
$listaAlumnos.='
<tr>  
<td>'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'</td>
<td>'.$filaTabla['CODIGO_SIS'].'</td>
<td>'.$filaTabla['NOMBRE_LARGO'].'</td>

<td>'.$filaTabla['ROL'].'</td>
<td><button class="GFG">Editar</button></td>
<td><button class="GFG">Eliminar</button></td>'
;
$listaAlumnos.='
</tr>';
}
$listaAlumnos.='</table>';

echo json_encode($listaAlumnos);
}
obtenerAlumnos($conexionBD,$carnetDocente,$semestre,$fechaActual);

?>