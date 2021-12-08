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
    <a href="./crearApunte">subir un nuevo apunte</a>
    </div>';}

$consulta="SELECT estudiante.CODIGO_SIS,apunte.fecha_apunte,apunte.seVio,apunte.veremos 
from apunte,estudiante
where estudiante.CODIGO_SIS=apunte.CODIGO_SIS
and estudiante.CODIGO_SIS='$cod_estudiante'
and estudiante.COD_CLASE='$clase'
and estudiante.NOMBRE_CORTO='$grupo_empresa'";

$ejecucionConsulta=mysqli_query($conexionBD,$consulta);

while($filaTabla=mysqli_fetch_array($ejecucionConsulta))
{ 
$htmlApuntes.='<div class="contenido-apunte">
<h3>Fecha:'.$filaTabla['fecha_apunte'].'</h3>
<h5>Esta semana se vio:</h5>
<span>'.$filaTabla['seVio'].'</span>
<h5>para la proxima semana:</h5>
<span>'.$filaTabla['veremos'].'</span>
</div>';
}  
$htmlApuntes.='</div>';
echo json_encode($htmlApuntes);
}

obtenerApuntes($conexionBD,$clase,$cod_estudiante,$rolEstudiante,$grupo_empresa);
?>