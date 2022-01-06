<?php
//@param conexionDB:se importa la base de datos
//se recupera la sesion actual iniciada
//@param clase:codigo de clase a la que pertenece el estudiante
include("conexionBD.php");
session_start(); 
$clase=$_SESSION['COD_CLASE'];

//funcion para recupeara cantidad de asistencias de un estudiante de la clase

//que pertence al docente
//@param codSis: el codigo sis del alumno 
//@param tipoAsistencia:indica que tipo de asistencia consultara del estudiante
function obtenerAsistencia($codSis,$tipoAsistencia,$conexionBD){
    $cantidad=0;
//consulta de la asistencia del alumno
    $consulta="SELECT estudiante.CODIGO_SIS,
    TIPO_ASISTENCIA,
    COUNT(TIPO_ASISTENCIA) as CANTIDAD
    from estudiante,asistencia
    WHERE estudiante.CODIGO_SIS=asistencia.CODIGO_SIS
    AND estudiante.CODIGO_SIS='$codSis'
    and TIPO_ASISTENCIA='$tipoAsistencia'
    group by(TIPO_ASISTENCIA)";
    
    $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
    $fila=mysqli_fetch_array($ejecucionConsulta);
    if(isset($fila['CANTIDAD'])){
    $cantidad=$fila['CANTIDAD'];}

    return $cantidad;
}

//funcion para obtener las asistencia semanales de todos
//los alumnos de la clase del docente
function obtenerAsistenciasSemanales($clase,$conexionBD){
$respuesta=array();
//consulta de alumnos de la clase del docente
$consulta="SELECT *
from estudiante
where cod_clase='$clase'";
$ejecucionConsulta=mysqli_query($conexionBD,$consulta);
$i=0;

//de cada estudiante se obtiene su nombre,codigo sis y empresa a la que pertenece
// tambien la cantida de presentes,tardes y asutenes
//se retornara un archivo JSON al front end
//@param presentes:cantidad de presentes del alumno 
//@param tardes:cantidad de tardes del alumno 
//@param ausentes:cantidad de ausentes del alumno 
while($filaTabla=mysqli_fetch_array($ejecucionConsulta))
{ 
    $codigo=$filaTabla['CODIGO_SIS'];
    $nombre=$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'];
    $empresa=$filaTabla['NOMBRE_CORTO'];

    $presentes=obtenerAsistencia($codigo,'P',$conexionBD);
    $tardes=obtenerAsistencia($codigo,'T',$conexionBD);
    $ausentes=obtenerAsistencia($codigo,'A',$conexionBD);
         $infoEstudiante=array(
          'cod_sis'=>$codigo,
          'nombre'=>$nombre,
          'grupo'=>$empresa,
          'presentes'=>$presentes,
          'tardes'=>$tardes,
          'ausentes'=>$ausentes,
        );

$respuesta=array_merge(($respuesta),array($infoEstudiante));

}  


echo json_encode($respuesta);
}

obtenerAsistenciasSemanales($clase,$conexionBD);

?>