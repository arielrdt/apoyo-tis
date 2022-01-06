<?php
//@param conexionB:se importa la base de datos
//se recupera la sesion actual iniciada
//@param cod_clase:clase del docente
//@param titulo_documento:titulo del documento
//@param fecha_inicio: fecha de inicio
//@param fecha_limite: fecha limite de respuestas
//@param descripcion: descripcion de la invitacion
//@param semestre_anio: semestre de la invitacion


include("conexionBD.php");
session_start(); 
$cod_clase=$_SESSION['COD_CLASE'];
$titulo_documento=$_POST['titulo'];
$fecha_inicio=date("Y-m-d");
$fecha_limite=$_POST['fechaFin'];
$descripcion=$_POST['descripcion'];
$mes=(int)date("m");
$anio=(int)date("Y"); 
$semestre_anio='';

if($mes<6){
    $semestre_anio=('1-'. date("Y"));
}
else{
    $semestre_anio=('2-'. date("Y"));
}

//funcion para verificar que no exista una invitacion para el mismo semestre 
function NoExisteUnaInviEnMismoSemestre($conexionBD,$semestre_anio,$cod_clase){
$consultaSQL="SELECT * 
              FROM INVITACION_PUBLICA 
              WHERE SEMESTRE_ANIO='$semestre_anio' 
              AND  COD_CLASE='$cod_clase' ";

$resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
$filaResultado=mysqli_fetch_array($resultadoConsulta);
return !(isset($filaResultado['SEMESTRE_ANIO']));
}

//funcion para comprobar que todos los campos del formulario esten llenos
function CamposNoLlenos($titulo_documento,$fecha_limite,$carnet_identidad_docente,$semestre_anio,$descripcion){
return($titulo_documento==='' || $fecha_limite==='' ||  
$descripcion==='');}

//funcion para publicar la invitacion publica en la base de datos
function ejecutarConsultaSubirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion,$cod_clase){
    $query="INSERT INTO invitacion_publica
    (FECHA_INICIO ,
    FECHA_LIMITE ,
    COD_CLASE ,
    FECHA_PUBLICACION ,
    SEMSTRE_ANIO ,
    HORA_LIMITE ,
    TITULO_DOCUMENTO ,
    SEMESTRE_ANIO ,
    DESCRIPCION) 
    VALUES 
    ('$fecha_inicio',
     '$fecha_limite',
    '$cod_clase',
    NULL ,
    NULL ,
    NULL ,
    '$titulo_documento',
    '$semestre_anio',
    '$descripcion')";
    $result=mysqli_query($conexionBD,$query);
}

//funcion para crear la invitacion
// si no existe una ya publicada, en caso de haber alguna
//se actualizara la invitacion previamente publicada
//si se llenaron todos los campos
//y el documento adjuto es un pdf

function subirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente,$cod_clase){
    if(NoExisteUnaInviEnMismoSemestre($conexionBD,$semestre_anio,$cod_clase)){
        if(CamposNoLlenos($titulo_documento,$fecha_limite,$carnet_identidad_docente,$semestre_anio,$descripcion))
         {echo json_encode('Debes llenar todos los campos');}
        else{
        $nomreOriginalArchivo=basename($_FILES['file']['name']);
        $extension=strtolower(pathinfo($nomreOriginalArchivo,PATHINFO_EXTENSION));
        $nombreNuevoArchivo=$semestre_anio.'.'.$extension;
        if($nomreOriginalArchivo!=''){
            if($extension=="pdf")
            {
             ejecutarConsultaSubirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion,$cod_clase);
             echo json_encode("subida son exito");
            }
           else
           {echo json_encode("el documento debe estar en formato pdf");}
        }
           else{echo json_encode("debe adjuntar un documento");}
        }
    }
    else{
        $query="UPDATE invitacion_publica
            SET
            FECHA_INICIO='$fecha_inicio',
            FECHA_LIMITE='$fecha_limite',
            TITULO_DOCUMENTO='$titulo_documento',
            DESCRIPCION='$descripcion'
            WHERE SEMESTRE_ANIO='$semestre_anio'
            AND COD_CLASE='$cod_clase'
            ";

            $result=mysqli_query($conexionBD,$query);
            echo json_encode("invitacion actualizada");
    }
}
subirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente,$cod_clase);

?>