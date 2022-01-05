<?php
//@param conexionB:se importa la base de datos
//se recupera la sesion actual iniciada
//@param clase: clase que visita el docente que inicio sesion
include("conexionBD.php");
session_start(); 
$clase=$_SESSION['COD_CLASE'];

//funcion para obtener los apuntes de los grupo-empresas
//de la clase que le pertenece al docente
//que inicio sesion previsamente
function obtenerApuntes($conexionBD,$clase)
{
//@param htmlApuntes:tabla con los apunte de los grupo empresas
//que estan registrados en la clase del docente, que sera exportado al 
//front end
$htmlApuntes='<div class="apuntes">';
//consulta de los apuntes de los grupo empresas de la clase
$consulta="SELECT grupo_empresa.NOMBRE_CORTO,grupo_empresa.NOMBRE_LARGO,apunte.fecha_apunte,apunte.seVio,apunte.veremos
from apunte,grupo_empresa,estudiante
where apunte.CODIGO_SIS=estudiante.CODIGO_SIS
and grupo_empresa.NOMBRE_CORTO=estudiante.NOMBRE_CORTO 
and COD_CLASE='$clase'";

$ejecucionConsulta=mysqli_query($conexionBD,$consulta);

while($filaTabla=mysqli_fetch_array($ejecucionConsulta))
{ 
//de cada apunte se recupera el nombre corto,largo de la empresa,
//la fecha del apunete, lo que se vio y se verá    
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