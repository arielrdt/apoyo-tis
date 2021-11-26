<?php
include("conexionBD.php");
session_start(); 
$codigo=$_POST['codigo'];
$codigo_sis=$_SESSION['CODIGO_SIS'];
//$semestre

function ExisteEmpresa($codigo,$conexionBD){
$consultaSQL="SELECT * FROM GRUPO_EMPRESA WHERE CODIGO_UNION='$codigo'";
$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
$resultado=mysqli_fetch_array($ejecucionConsulta);
return(isset($resultado['CODIGO_UNION']));
}

function hayEspacio($codigo,$conexionBD){
    $consultaSQL="SELECT COUNT(distinct NOMBRE) AS NUM_INTEGRANTES
    FROM ESTUDIANTE,GRUPO_EMPRESA 
    WHERE ESTUDIANTE.NOMBRE_CORTO=GRUPO_EMPRESA.NOMBRE_CORTO
    AND CODIGO_UNION='$codigo'";
    $ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
    $resultado=mysqli_fetch_array($ejecucionConsulta);
    return($resultado['NUM_INTEGRANTES']<5 && $resultado['NUM_INTEGRANTES']>0 );
}

function agregarEstudianteEmpresa($codigo,$conexionBD){
if(ExisteEmpresa($codigo,$conexionBD)){
    if (hayEspacio($codigo,$conexionBD)){
        $consulta="SELECT * FROM GRUPO_EMPRESA WHERE CODIGO_UNION='$codigo'";
        $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
        $resultado=mysqli_fetch_array($ejecucionConsulta);
        $nuevoNombreC=$resultado['NOMBRE_CORTO'];
        $nuevoNombreL=$resultado['NOMBRE_LARGO'];

        $consultaActualizacion="UPDATE ESTUDIANTE 
        SET NOMBRE_CORTO='$nombre_corto',NOMBRE_LARGO='$nombre_largo',ROL='estudiante' 
        WHERE CODIGO_SIS='$codigoEstudiante'";
        
        echo json_encode("registro exitoso");
    }
    else {echo json_encode("el grupo esta lleno");}
}
else {echo json_encode("el codigo introducido no pertenece a ningun grupo-empresa");}
}

agregarEstudianteEmpresa($codigo,$conexionBD);

?>