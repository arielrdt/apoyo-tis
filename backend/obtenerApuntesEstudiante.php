<?php
include("conexionBD.php");
session_start(); 
$clase=$_SESSION['COD_CLASE'];
$cod_estudiante=$_SESSION['CODIGO_SIS'];
$rolEstudiante=$_SESSION['ROL'];
$grupo_empresa=$_SESSION['EMPRESA'];

function obtenerApuntes($conexionBD,$clase,$cod_estudiante,$rolEstudiante,$grupo_empresa)
{
$htmlApuntes='<div class="apuntes">';

if($rolEstudiante=='documentador'){
    $htmlApuntes.='<div class="boton-crear-apunte">
    <a href="./crearApunte.html">subir un nuevo apunte</a>
    </div>';}

$consulta="SELECT estudiante.CODIGO_SIS,apunte.fecha_apunte,apunte.seVio,apunte.veremos 
from apunte,estudiante
where estudiante.CODIGO_SIS=apunte.CODIGO_SIS
and estudiante.COD_CLASE='$clase'
and estudiante.NOMBRE_CORTO='$grupo_empresa'";

$ejecucionConsulta=mysqli_query($conexionBD,$consulta);

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