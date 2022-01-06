<?php
//@param conexionB:se importa la base de datos
//se recupera la sesion actual iniciada
//@param detalle: descripcion de la tarea
//@param fechaLimite:fecha limite de respuestas
//@param horaLimite:hora limite de respuestas
//@param codClase: clase del docente
//@param fechaSubida: fecha actual de subida
include("conexionBD.php");
session_start(); 
$detalle=$_POST['descripcion'];
$fechaLimite=$_POST['fechaLimite'];
$horaLimite=$_POST['horaLimite'];
$codClase=$_SESSION['COD_CLASE'];
$fechaSubida=date("Y-m-d");

//funcion para crear la tarea de tipo::"formacion grupos"
//en la tabla TAREA 
function crearTareaFormarGrupos($conexionBD,$detalle,$fechaLimite,$horaLimite,$fechaSubida,$codClase){
    $query="INSERT INTO TAREA
    (FECHA_SUBIDA,
     FECHA_MAXIMA,
     HORA_MAXIMA,
     COD_CLASE,
     TITULO_TAREA,
     DESCRIPCION_TAREA,
     VALORTAREA,
     TIPO_TAREA
    )VALUES(
     '$fechaSubida',
     '$fechaLimite',
     '$horaLimite',
     '$codClase',
     'Crear grupos', 
     '$detalle',
       '0',
      'Formacion Grupos'
    )";
    $result=mysqli_query($conexionBD,$query);
    echo json_encode("Tarea publicada con exito");
}

crearTareaFormarGrupos($conexionBD,$detalle,$fechaLimite,$horaLimite,$fechaSubida,$codClase);
?>