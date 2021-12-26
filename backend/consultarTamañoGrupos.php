<?php
include("conexionBD.php");
session_start();
$carnetDocente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
$semestre=$_SESSION['SEMESTRE'];
$fechaActual=date("Y-m-d");

function obtenerAlumnos($conexionBD,$carnetDocente,$semestre, $fechaActual){
$listaAlumnos='<h1 style="padding:10px; display: flex; justify-content: center;">Grupos de la clase</h1> <div style="padding:10px; display: flex; justify-content: center;"> La fecha de hoy es: '.$fechaActual.'</div>
<table class="tabla-estudiantes">
<tr class="titulo">  
<td>Grupo-Empresa</td>
<td>limite miembros</td>
<td>cambiar limite de miembros</td>
</tr>
';
$consultaSQL="SELECT distinct(grupo_empresa.NOMBRE_CORTO) ,grupo_empresa.NOMBRE_LARGO,grupo_empresa.limiteMiembros
              from estudiante,grupo_empresa,clase 
              where estudiante.COD_CLASE=clase.COD_CLASE
              and estudiante.NOMBRE_CORTO=grupo_empresa.NOMBRE_CORTO
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'
              order by (grupo_empresa.NOMBRE_CORTO)
              ";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
$empresa=$filaTabla['NOMBRE_CORTO'];
$listaAlumnos.='
<tr>  
<td>'.$filaTabla['NOMBRE_LARGO'].'('.$filaTabla['NOMBRE_CORTO'].')</td>
<td>'.$filaTabla['limiteMiembros'].'</td>
<td><button class="GFG" onclick="editarDatos('.'`'.$empresa.'`'.')">Editar</button></td>
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