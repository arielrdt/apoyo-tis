<?php
include("conexionBD.php");
$titulo_documento=$_POST['titulo'];
$fecha_inicio=date("Y-m-d");
$fecha_limite=$_POST['fechaFin'];
$carnet_identidad_docente="1231321412";
$descripcion=$_POST['descripcion'];

$mes=(int)date("m");
$anio=(int)date("Y");
$semestre_anio='';
$codigo="1234567";

if($mes<6){
    $semestre_anio=('1-'. date("Y"));
}
else{
    $semestre_anio=('2-'. date("Y"));
}


function NoExisteUnaInviEnMismoSemestre($conexionBD,$semestre_anio){
$consultaSQL='SELECT * FROM INVITACION_PUBLICA WHERE SEMESTRE_ANIO="'.$semestre_anio.'"';
$resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
$filaResultado=mysqli_fetch_array($resultadoConsulta);
return !(isset($filaResultado['SEMESTRE_ANIO']));
}

function CamposNoLlenos($titulo_documento,$fecha_limite,$carnet_identidad_docente,$semestre_anio,$descripcion){
return($titulo_documento==='' || $fecha_limite==='' ||  
$descripcion==='');}

function ejecutarConsultaSubirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion){
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
    ('$fecha_inicio' ,
     '$fecha_limite' ,
    NULL ,
    NULL ,
    NULL ,
    NULL ,
    '$titulo_documento',
    '$semestre_anio',
    '$descripcion')";
    $result=mysqli_query($conexionBD,$query);
}

function subirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente){
    if(NoExisteUnaInviEnMismoSemestre($conexionBD,$semestre_anio)){
        if(CamposNoLlenos($titulo_documento,$fecha_limite,$carnet_identidad_docente,$semestre_anio,$descripcion))
         {echo json_encode('Debes llenar todos los campos');}
        else{
        $nomreOriginalArchivo=basename($_FILES['file']['name']);
        $extension=strtolower(pathinfo($nomreOriginalArchivo,PATHINFO_EXTENSION));
        $nombreNuevoArchivo=$semestre_anio.'.'.$extension;
        if($nomreOriginalArchivo!=''){
            if($extension=="pdf")
            {
             ejecutarConsultaSubirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion);
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
            WHERE SEMESTRE_ANIO='$semestre_anio'";

            $result=mysqli_query($conexionBD,$query);
            echo json_encode("invitacion actualizada");
    }
}
subirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente);

?>