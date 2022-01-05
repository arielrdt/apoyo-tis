<?php
include("conexionBD.php");
//@param conexionBD:se importa la base de datos
//@param correoElectronico:correo del docente o estudiante
//@param contrasena: contraseña 
//@param semestre: se calcula mediante el mes y año actual
//@param mes: mes actual
//@param anio: año actual
//se recupera la sesion actual iniciada
session_start();
$correoElectronico = $_POST['correo'];
$contrasena = $_POST['password']; 
$semestre;
$mes=date("m");
$anio=date("Y");
if($mes<7){$semestre='1-'.$anio;}
else{$semestre='2-'.$anio;}

//funcion para consultar a la base de datos si el correo electronico
//es de un estudiante
function esUnEstudiante($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM estudiante WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
     return(isset($filaResultado['CI']));}

//funcion para consultar a la base de datos si el correo electronico
//es de un docente
function esUnDocente($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM docente WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return(isset($filaResultado['NUMERO_CARNET_IDENTIDAD_DOCENTE']));
}

//funcion para obtener la contaraseña encriptada del estudiante
function obtenerContrasenaEstudiante($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM ESTUDIANTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
     return $filaResultado['CONTRASENA_ESTUDIANTE'];
    }
//funcion para obtener la contaraseña encriptada del docente
function obtenerContrasenaDocente($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM DOCENTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return $filaResultado['CONTRASENA_DOCENTE'];
}

//funcion para iniciar sesion si  la contraseña es correcta
function iniciarSesion($correoElectronico,$conexionBD,$contrasena,$semestre){
$contraseñaEncriptada;
//verificar si el correo esta registrado en el sistema
if(esUnEstudiante($correoElectronico,$conexionBD))
{   $contrasenaEncriptada=obtenerContrasenaEstudiante($correoElectronico,$conexionBD); 
    //comparacion de la contraseña encriptada con la ingresada
    if(password_verify($contrasena,$contrasenaEncriptada)){
        //si coinciden se inicia sesion del estudiante
        iniciarSesionEstudiante($correoElectronico,$conexionBD,$semestre);
        echo json_encode("contrasena de estudiante correcta");
    }//sino se indica que no es la correcta
    else{echo json_encode("contrasena de estudiante incorrecta"); }
}
else
{
    if(esUnDocente($correoElectronico,$conexionBD)){
    $contrasenaEncriptada=obtenerContrasenaDocente($correoElectronico,$conexionBD);
       //comparacion de la contraseña encriptada con la ingresada
     if(password_verify($contrasena,$contrasenaEncriptada)){
         //si coinciden se inicia sesion del docente
            iniciarSesionDocente($correoElectronico,$conexionBD,$semestre);
            echo json_encode("contrasena de docente correcta");}
        //sino se indica que no es la correcta
        else{echo json_encode("contrasena de docente incorrecta");}

     }
     //sino el correo no esta regristrado
     else{echo json_encode("correo no registrado en el sistema");}
}
}
//funcion para iniciar la sesion del estudiante en el sistema
//@param $_SESSION['SEMESTRE']: se guarda el semestre en la sesion activa
//@param $_SESSION['CODIGO_SIS']:se guarda el codigo sis en la sesion activa
//@param $_SESSION['COD_CLASE']:se guarda el codigo de la clase en la sesion activa
//@param $_SESSION['CI']:se guarda el numero de carnet en la sesion activa
//@param $_SESSION['NOMBRE']: se guarda el nombre en la sesion activa
//@param $_SESSION['APELLIDO_PATERNO']: se guarda el apellido paterno en la sesion activa
//@param $_SESSION['APELLIDO_MATERNO']: se guarda el apellido materno en la sesion activa
//@param $_SESSION['CARRERA']: se guarda la carrera del estudiante en la sesion activa
//@param $_SESSION['CORREO_ELECTRONICO']: se guarda el correo en la sesion activa
//@param $_SESSION['ROL']:se guarda el rol de estudiante
function iniciarSesionEstudiante($correoElectronico,$conexionBD,$semestre){
    $consultaSQL='SELECT * FROM ESTUDIANTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    $_SESSION['SEMESTRE']=$semestre;
    $_SESSION['CODIGO_SIS']=$filaResultado['CODIGO_SIS'];
    $_SESSION['COD_CLASE']=$filaResultado['COD_CLASE'];
    $_SESSION['CI']=$filaResultado['CI'];
    $_SESSION['NOMBRE']=$filaResultado['NOMBRE'];
    $_SESSION['APELLIDO_PATERNO']=$filaResultado['APELLIDO_PATERNO'];
    $_SESSION['APELLIDO_MATERNO']=$filaResultado['APELLIDO_MATERNO'];
    $_SESSION['CARRERA']=$filaResultado['CARRERA'];
    $_SESSION['CORREO_ELECTRONICO']=$filaResultado['CORREO_ELECTRONICO'];
    $_SESSION['ROL']=$filaResultado['ROL'];
    if(isset($filaResultado['NOMBRE_CORTO'])){
    $_SESSION['EMPRESA']=$filaResultado['NOMBRE_CORTO'];
                                             }
    $_SESSION['ROL_CURSO']='estudiante';
}
  
//funcion para iniciar la sesion del docente en el sistema
//@param $_SESSION['SEMESTRE']: se guarda el semestre en la sesion activa
//@param $_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE']:se guarda el numero de carnet en la sesion activa
//@param $_SESSION['NOMBRE']: se guarda el nombre en la sesion activa
//@param $_SESSION['APELLIDO_PATERNO']: se guarda el apellido paterno en la sesion activa
//@param $_SESSION['APELLIDO_MATERNO']: se guarda el apellido materno en la sesion activa
//@param $_SESSION['TELEFONO']: se guarda el numero de telefono en la sesion activa
//@param $_SESSION['ROL']:se guarda el rol de docente

function iniciarSesionDocente($correoElectronico,$conexionBD,$semestre){
    $consultaSQL='SELECT * FROM DOCENTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    $_SESSION['SEMESTRE']=$semestre;
    $_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE']=$filaResultado['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
    $_SESSION['NOMBRE']=$filaResultado['NOMBRE'];
    $_SESSION['APELLIDO_PATERNO']=$filaResultado['APELLIDO_PATERNO'];
    $_SESSION['APELLIDO_MATERNO']=$filaResultado['APELLIDO_MATERNO'];
    $_SESSION['CORREO_ELECTRONICO']=$filaResultado['CORREO_ELECTRONICO'];
    $_SESSION['TELEFONO']=$filaResultado['TELEFONO'];
    $_SESSION['ROL_CURSO']='Docente';
}

iniciarSesion($correoElectronico,$conexionBD,$contrasena,$semestre);



?>