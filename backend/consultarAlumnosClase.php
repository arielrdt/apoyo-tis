<?php
//@param conexionBD:se importa la base de datos
//@param carnetDocente:el numero de carnet del docente
//@param semestre:el semestre actual
include("conexionBD.php");
//recuperar la sesion
session_start();
$carnetDocente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
$semestre=$_SESSION['SEMESTRE'];

//se obtiene los alumnos del docente con sesion iniciada
function obtenerAlumnos($conexionBD,$carnetDocente,$semestre){
//se arma la tabla que contendra los alumnos como codigo html en u
//string que sera exportado al front end
$listaAlumnos='<h3>LISTA DE ALUMNOS</h3><table class="tabla-estudiantes">
<tr class="titulo">  
<td>Nombre del alumno</td>
<td>Codigo SIS</td>
<td>Calificación</td>
<td>Opción</td>
</tr>
';

//ejecucion de la consulta para obtener los alumnos inscritos a la clase
//del docente
$consultaSQL="SELECT * 
              from estudiante,clase 
              where estudiante.COD_CLASE=clase.COD_CLASE
              and clase.SEMESTRE='$semestre'
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'";


$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);

//se recorre las filas de la tabla de resultados
//se
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
//por cada resultado se arma una fila con el nombre completo
//codigo sis y nota final si existe, del alumno
//tambien se agrega el boton de calificar    
$listaAlumnos.='
<tr>  
<td>'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'</td>
<td>'.$filaTabla['CODIGO_SIS'].'</td>';
if(isset($filaTabla['NOTA_EXAMEN_FINAL'])){
$listaAlumnos.='<td>'.$filaTabla['NOTA_EXAMEN_FINAL'].'</td>'; 
}
else{$listaAlumnos.='<td>no calificado</td>';}
$listaAlumnos.='
<td><button class="GFG" onclick="cargarDatos('.$filaTabla['CODIGO_SIS'].','.'`'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'`'.')">asignar nota final</button></td>
</tr>';
}
$listaAlumnos.='</table>';

echo json_encode($listaAlumnos);
}
obtenerAlumnos($conexionBD,$carnetDocente,$semestre);

?>