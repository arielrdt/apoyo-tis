<?php
//@param conexionDB:se importa la base de datos
//se recupera la sesion actual iniciada
//@param clase:codigo de clase a la que pertenece el estudiante
include("conexionBD.php");
session_start(); 
$clase=$_SESSION['COD_CLASE'];

//funcion para obtener el promedio semanal de todos los alumnos
//de la clase del docente

function obtenerPromediosSemanales($clase,$conexionBD){
$respuesta=array();
//consulta para recuperar los alumnos de la clase del docente
$consulta="SELECT estudiante.CODIGO_SIS, NOMBRE,APELLIDO_PATERNO,APELLIDO_MATERNO,NOMBRE_CORTO,avg(nota_participacion) as promedio,NOTA_EXAMEN_FINAL
from estudiante,participacion
where estudiante.CODIGO_SIS=participacion.CODIGO_SIS
and COD_CLASE='$clase'
group by(participacion.CODIGO_SIS)";
$ejecucionConsulta=mysqli_query($conexionBD,$consulta);


//de cada estudiante se obtiene su nombre,codigo sis,empresa,promedio y nota final

while($filaTabla=mysqli_fetch_array($ejecucionConsulta))
{ 
    $codigo=$filaTabla['CODIGO_SIS'];
    $nombre=$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'];
    $empresa=$filaTabla['NOMBRE_CORTO'];
    $promedioNotas=$filaTabla['promedio'];
    $notaFinal=$filaTabla['NOTA_EXAMEN_FINAL'];
         $infoEstudiante=array(
          'cod_sis'=>$codigo,
          'nombre'=>$nombre,
          'grupo'=>$empresa,
          'promedioNotas'=>$promedioNotas,
          'notaFinal'=>$notaFinal
           );

$respuesta=array_merge(($respuesta),array($infoEstudiante));

}  
echo json_encode($respuesta);
}


obtenerPromediosSemanales($clase,$conexionBD);

?>