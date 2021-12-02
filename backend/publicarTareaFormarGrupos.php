<?php
include("conexionBD.php");
session_start(); 
$detalle=$_POST['descripcion'];
$fechaLimite=$_POST['fechaLimite'];
$horaLimite=$_POST['horaLimite'];
$codClase=$_SESSION['COD_CLASE'];
$fechaSubida=date("Y-m-d");

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