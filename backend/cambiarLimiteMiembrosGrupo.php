<?php
include("conexionBD.php");
session_start(); 
$grupo=$_POST['nombreGrupo'];
$nuevaCantidad=$_POST['nuevaCantidad'];
function cambioValido($conexionBD,$grupo,$nuevaCantidad){
    $query="SELECT COUNT(distinct NOMBRE) AS NUM_INTEGRANTES,GRUPO_EMPRESA.limiteMiembros
    FROM ESTUDIANTE,GRUPO_EMPRESA 
    WHERE ESTUDIANTE.NOMBRE_CORTO=GRUPO_EMPRESA.NOMBRE_CORTO
    AND grupo_empresa.NOMBRE_CORTO='$grupo'";
    $result=mysqli_query($conexionBD,$query); 
    $fila=mysqli_fetch_array($result);
    if(  
      ((int)$fila['NUM_INTEGRANTES'])<=((int)$nuevaCantidad) 
      ){
        return true;
    }
    else{return false;}

}

function cambiarRolAlumno($conexionBD,$grupo,$nuevaCantidad){
       if(cambioValido($conexionBD,$grupo,$nuevaCantidad)){
                        $query="UPDATE grupo_empresa
                            SET limiteMiembros='$nuevaCantidad'
                            WHERE NOMBRE_CORTO='$grupo'";

                        $result=mysqli_query($conexionBD,$query);
                        echo json_encode("cambio exitoso");
}
else{
    echo json_encode(null);
}

}

cambiarRolAlumno($conexionBD,$grupo,$nuevaCantidad);
?>