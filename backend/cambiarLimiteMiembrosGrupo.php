<?php
//@param conexionBD:se importa la base de datos
//@param grupo:se recibe el grupo que desea cambiarse desde el formulario
//@param nuevaCantidad:se recibe la cantidad de miembros a cambiar desde el formulario
include("conexionBD.php");
//se recupera la sesion actual iniciada
session_start(); 
$grupo=$_POST['nombreGrupo'];
$nuevaCantidad=$_POST['nuevaCantidad'];

//funcion para comprobar que el cambio es valido si la cantidad de miembros nueva 
//para el grupo ingresado es mayor o  igual al numero de miembros
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
//funcion para cambiar el numero de miembros del grupo
//solo si el nuevo numero de integrantes es mayor o igual a la cantidad actual
function cambiarNumeroIntegrantes($conexionBD,$grupo,$nuevaCantidad){
       if(cambioValido($conexionBD,$grupo,$nuevaCantidad)){
                        $query="UPDATE grupo_empresa
                            SET limiteMiembros='$nuevaCantidad'
                            WHERE NOMBRE_CORTO='$grupo'";

                        $result=mysqli_query($conexionBD,$query);
                        echo json_encode("cambios exitoso");
}
else{
    echo json_encode(null);
}

}

cambiarNumeroIntegrantes($conexionBD,$grupo,$nuevaCantidad);
?>