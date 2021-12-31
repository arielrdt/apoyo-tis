<?php
include("conexionBD.php");
session_start();
$cod_clase=$_SESSION['COD_CLASE'];
$titulo_documento=$_POST['titulo'];
$fecha_publicacion=date("Y-m-d");
$carnet_identidad_docente="1231321412";
$descripcion=$_POST['descripcion'];
$codigo="1234567";

$semestre_anio='';
$mes=(int)date("m");
$anio=(int)date("Y");
$semestre_anio='';
if($mes<6){
    $semestre_anio=('1-'. date("Y"));
}
else{
    $semestre_anio=('2-'. date("Y"));
}

 
function NoExisteUnaInviEnMismoSemestre($conexionBD,$semestre_anio,$cod_clase){
    $consultaSQL="SELECT * 
    FROM pliego_especificaciones
    WHERE SEMSTRE_ANIO='$semestre_anio'
    AND COD_CLASE='$cod_clase'";

    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return !(isset($filaResultado['SEMSTRE_ANIO']));
    }

function camposNoLlenos($titulo_documento,$semestre_anio,$descripcion){
    return($titulo_documento===''||  $descripcion==='' || $semestre_anio==='');}


function ejecutarConsultaSubirDatos($conexionBD,$titulo_documento,$semestre_anio,$descripcion,$fecha_publicacion,$cod_clase){
    $query="INSERT INTO pliego_especificaciones
    (SEMSTRE_ANIO,
    FECHA_PUBLICACION,

    TITULO_DOCUMENTO,
    DESCRIPCION,
    COD_CLASE
    ) VALUES 
    (
    '$semestre_anio',
    '$fecha_publicacion',

    '$titulo_documento',
    '$descripcion',
    '$cod_clase'
     )";
    $result=mysqli_query($conexionBD,$query);
}

function subirDatos($conexionBD,$fecha_publicacion,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente,$cod_clase){
    if(true){
        if(camposNoLlenos($titulo_documento,$semestre_anio,$descripcion))
         {echo json_encode('Debes llenar todos los campos');}
        else{
        $nomreOriginalArchivo=basename($_FILES['file']['name']);
        $extension=strtolower(pathinfo($nomreOriginalArchivo,PATHINFO_EXTENSION));
        $nombreNuevoArchivo=$semestre_anio.'.'.$extension;

        if($nomreOriginalArchivo!=''){
            if($extension=="pdf"){
                ejecutarConsultaSubirDatos($conexionBD,
                $titulo_documento,
                $semestre_anio,
                $descripcion,
                $fecha_publicacion,
                $cod_clase);
                echo json_encode("el pliego ha sido publicado exitosamente");

                                     }
              else
              {echo json_encode("el documento debe estar en formato pdf");}
        }
         else{
            echo json_encode("debe adjuntar un documento");}
        }
    }
    
    else{
        $query="UPDATE pliego_especificaciones
        SET
        FECHA_PUBLICACION='$fecha_publicacion',
        TITULO_DOCUMENTO='$titulo_documento',
        DESCRIPCION='$descripcion'
        WHERE SEMSTRE_ANIO='$semestre_anio'
        AND COD_CLASE='$cod_clase'
        ";

        $result=mysqli_query($conexionBD,$query);
        echo json_encode("pliego actualizado");
    }
}

subirDatos($conexionBD,$fecha_publicacion,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente,$cod_clase);

?>