<?php
//@param conexionBD:se importa la base de datos
//se recupera la sesion actual iniciada
//@param codigo: codigo de la clase del estudiante
//@param codigoSis:codigo sis del estudiante

include("conexionBD.php");
session_start(); 
$codigo=$_POST['codigo'];
$codigo_sis=$_SESSION['CODIGO_SIS'];

//funcion para comprabar que la empresa existe en la base de datos
function ExisteEmpresa($codigo,$conexionBD){
$consultaSQL="SELECT * FROM GRUPO_EMPRESA WHERE CODIGO_UNION='$codigo'";
$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
$resultado=mysqli_fetch_array($ejecucionConsulta);
return(isset($resultado['CODIGO_UNION']));
}
//funcion para comprobar que haya espacion en el grupo,
//haciendo la consulta a los datos del grupo en la base de datos
function hayEspacio($codigo,$conexionBD){
    $consultaSQL="SELECT COUNT(distinct NOMBRE) AS NUM_INTEGRANTES,GRUPO_EMPRESA.limiteMiembros
    FROM ESTUDIANTE,GRUPO_EMPRESA 
    WHERE ESTUDIANTE.NOMBRE_CORTO=GRUPO_EMPRESA.NOMBRE_CORTO
    AND CODIGO_UNION='$codigo'";
    $ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
    $resultado=mysqli_fetch_array($ejecucionConsulta);
    if($resultado['NUM_INTEGRANTES']==0){return true;}
    else{
    return ($resultado['NUM_INTEGRANTES']<$resultado['limiteMiembros'] && $resultado['NUM_INTEGRANTES']>=0);}
}

//funcion con el proceso para agregar al estudiante a la empresa
//si hay espacio y la empresa existe
function agregarEstudianteEmpresa($codigo,$conexionBD,$codigo_sis){
if(ExisteEmpresa($codigo,$conexionBD)){
    if (hayEspacio($codigo,$conexionBD)){
        $consulta="SELECT * FROM GRUPO_EMPRESA WHERE CODIGO_UNION='$codigo'";
        $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
        $resultado=mysqli_fetch_array($ejecucionConsulta);
        $nuevoNombreC=$resultado['NOMBRE_CORTO'];
        $nuevoNombreL=$resultado['NOMBRE_LARGO'];
        $nuevoRol='estudiante';
        $consultaActualizacion="UPDATE ESTUDIANTE 
        SET NOMBRE_CORTO='$nuevoNombreC',NOMBRE_LARGO='$nuevoNombreL',ROL='$nuevoRol'
        WHERE CODIGO_SIS='$codigo_sis'";
        $ejecuconsultaActualizacion=mysqli_query($conexionBD,$consultaActualizacion);
        $_SESSION['EMPRESA']=$nuevoNombreC;
    
        echo json_encode("registro exitoso");
    }
    else {echo json_encode("el grupo esta lleno");}
}
else {echo json_encode("el codigo introducido no pertenece a ningun grupo-empresa");}
}

agregarEstudianteEmpresa($codigo,$conexionBD,$codigo_sis);

?>