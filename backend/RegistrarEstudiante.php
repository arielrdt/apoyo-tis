<?php
//@param conexionBD:se importa la base de datos
//se recupera la sesion actual iniciada
//@param nombre:nombre del estudiante
//@param apellidoPaterno:apellido paterno del estudiante
//@param apellidoMaterno: apellido materno del estudiante
//@param carnetIdentidad:numero de carnet del estudiante
//@param codigoSis:codigo sis del estudiante
//@param correo: correo del estudiante
//@param carrera: carrera del estudiante
//@param contrasena: nueva contraseña del estudiante
//@param codigoClase: codigo de clase a la que se unira el estudiante
include("conexionBD.php");
$nombre=$_POST['nombreEstudiante'];
$apellidoPaterno=$_POST['apellidoPaternoEstudiante'];
$apellidoMaterno=$_POST['apellidoMaternoEstudiante'];
$carnetIdentidad=$_POST['carnetEstudiante'];
$codigoSis=$_POST['codigoSisEstudiante'];
$correo=$_POST['correoEstudiante'];
$carrera=$_POST['carrera'];
$contrasena=$_POST['contrasenaEstudiante'];
$codigoClase=$_POST['codigoClase'];

//funcion para consultar a la base de datos si el docente ya esta registrado
function estudianteRegistrado($conexionBD,$codigoSis){
    $consultaSQL='SELECT * FROM estudiante WHERE CODIGO_SIS="'.$codigoSis.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return (!isset($filaResultado['CI']));
    }

// funcion para verificar que el codigo de clase es valido
function codigoEsValido($conexionBD,$codigoClase){
    $consultaSQL='SELECT * FROM clase WHERE COD_CLASE="'.$codigoClase.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return (isset($filaResultado['SEMESTRE']));
}

//funcion para verificar que el correo no este repetido en la base de datos
function correoRegistrado($conexionBD,$correo){
    $consultaSQL='SELECT * FROM estudiante WHERE CORREO_ELECTRONICO="'.$correo.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return (isset($filaResultado['CI']));
    }

//funcion para registrar los datos del nuevo estudiante en la 
//base de datos
    function ejecutarConsultaSubirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase){
     //encriptacion de la contraseña
        $cifrado=password_hash($contrasena,PASSWORD_DEFAULT,['cost'=>10]);
       $query="INSERT INTO estudiante
        (CODIGO_SIS,
        COD_CLASE,
        NOMBRE_CORTO,
        NOMBRE_LARGO,
        CI,
        NOMBRE,
        APELLIDO_PATERNO,
        APELLIDO_MATERNO,
        CARRERA,
        CORREO_ELECTRONICO,
        CONTRASENA_ESTUDIANTE, 
        ROL,
        NOTA_1_PARCIAL,
        NOTA_2_PARCIAL,
        NOTA_EXAMEN_FINAL,
        NOTA_2_INSTANCIA
        )VALUES 
        ('$codigoSis',
        '$codigoClase',
        NULL,
        NULL,
        '$carnetIdentidad',  
        '$nombre',
        '$apellidoPaterno',
        '$apellidoMaterno',
        '$carrera',
        '$correo',
        '$cifrado',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL
        )";
        $result=mysqli_query($conexionBD,$query);}

//funcion para el proceso de registro del estudiante
//si no esta registrado
//si el codigo de clase es valido
//y el correo no fue registrado por otra persona
function subirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase){
        if(estudianteRegistrado($conexionBD,$codigoSis)){
        if(codigoEsValido($conexionBD,$codigoClase))
            {
                if(!correoRegistrado($conexionBD,$correo))
                {
                    ejecutarConsultaSubirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase) ; 
                    echo json_encode("Registro exitoso");
                }
                else
                {
                    echo json_encode("el correo ingresado ya registrado");
                }

            }
        else{
            echo json_encode("el codigo ingresado es incorrecto");
            }
        
        }
        else{echo json_encode("el estudiante ya fue registrado en el semestre actual");}
    }
    subirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase);
    


?>