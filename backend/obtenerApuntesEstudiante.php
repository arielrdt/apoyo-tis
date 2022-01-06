<?php
include("conexionBD.php");
//@param conexionDB:se importa la base de datos
//@param clase:clase a la que pertenece el estudiante
//@param cod_estudiante:codigo sis del estudiante 
//@param rolEstudiante: rol del estudiante en la empresa
//se recupera la sesion actual iniciada
session_start(); 
$clase=$_SESSION['COD_CLASE'];
$cod_estudiante=$_SESSION['CODIGO_SIS'];
$rolEstudiante=$_SESSION['EMPRESA'];

//funcion para obtener los apuntes del estudiante
function obtenerApuntes($conexionBD,$clase,$cod_estudiante,$rolEstudiante,$grupo_empresa)
{
//tabla de apuntes en codigo html
//almacenado en la variable de tipo String htmlApuntes
//que contendra los apuntes del grupo empresa del alumno que inicio sesion
//sera exportado al front end
$htmlApuntes='<div class="apuntes">';

//solo si el estudiante es documentador, podra usar el boton de subir apuntes
if($rolEstudiante=='documentador'){
    $htmlApuntes.='<div class="boton-crear-apunte">
    <a href="./crearApunte.html">subir un nuevo apunte</a>
    </div>';}

//consulta de apuntes del grupo empresa
$consulta="SELECT estudiante.CODIGO_SIS,apunte.fecha_apunte,apunte.seVio,apunte.veremos 
from apunte,estudiante
where estudiante.CODIGO_SIS=apunte.CODIGO_SIS
and estudiante.COD_CLASE='$clase'
and estudiante.NOMBRE_CORTO='$grupo_empresa'";

$ejecucionConsulta=mysqli_query($conexionBD,$consulta);

//recorrido de cada fila retornada
//para obtener los apuntes por fecha,que se vio y vera
while($filaTabla=mysqli_fetch_array($ejecucionConsulta))
{ 
$htmlApuntes.='<div class="contenido-apunte">
<h2>Fecha:'.$filaTabla['fecha_apunte'].'</h2>
<h3>Esta semana se vio:</h3>
<span>'.$filaTabla['seVio'].'</span>
<h3>para la proxima semana:</h3>
<span>'.$filaTabla['veremos'].'</span>
</div>';
}  
$htmlApuntes.='</div>';
echo json_encode($htmlApuntes);
}

obtenerApuntes($conexionBD,$clase,$cod_estudiante,$rolEstudiante,$grupo_empresa);
?>