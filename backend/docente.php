<?php
include("conexionBD.php");
function crearDocente($conexionBD){
$contrasena='123456';
$cifrado=password_hash($contrasena,PASSWORD_DEFAULT,['cost'=>10]);
$query="INSERT INTO docente
(NUMERO_CARNET_IDENTIDAD_DOCENTE,NOMBRE
,APELLIDO_PATERNO,APELLIDO_MATERNO
,TELEFONO,CORREO_ELECTRONICO,CONTRASENA_DOCENTE)
VALUES('7654321',
       'Fernanda',
       'Cabrera',
        'Fernandez',
        '65656565',
        'docente4@gmail.com',
        '$cifrado')";
       $result=mysqli_query($conexionBD,$query);
       echo json_encode($result);
    }

crearDocente($conexionBD);
 ?>


