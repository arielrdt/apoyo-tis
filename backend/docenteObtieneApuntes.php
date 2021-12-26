<?php
include("conexionBD.php");
session_start(); 
$clase=$_SESSION['COD_CLASE'];

function obtenerApuntes($conexionBD,$clase)
{
$htmlApuntes='<div class="apuntes">';

$consulta="SELECT grupo_empresa.NOMBRE_CORTO,grupo_empresa.NOMBRE_LARGO,apunte.fecha_apunte,apunte.seVio,apunte.veremos
from apunte,grupo_empresa,estudiante
where apunte.CODIGO_SIS=estudiante.CODIGO_SIS
and grupo_empresa.NOMBRE_CORTO=estudiante.NOMBRE_CORTO 
and COD_CLASE='$clase'";

$ejecucionConsulta=mysqli_query($conexionBD,$consulta);

while($filaTabla=mysqli_fetch_array($ejecucionConsulta))
{ 
$htmlApuntes.='<div class="contenido-apunte">
<h2>GRUPO:'.$filaTabla['NOMBRE_LARGO'].' ('.$filaTabla['NOMBRE_CORTO'].') </h2>
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

obtenerApuntes($conexionBD,$clase);
?>