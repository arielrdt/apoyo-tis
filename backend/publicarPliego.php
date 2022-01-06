<?php
//@param conexionB:se importa la base de datos
//se recupera la sesion actual iniciada
//@param cod_clase:clase del docente
//@param titulo_documento:titulo del documento
//@param fecha_publicacion: fecha de inicio
//@param descripcion: descripcion de la invitacion
//@param semestre_anio: semestre de la invitacion

include("conexionBD.php");
session_start();
$cod_clase=$_SESSION['COD_CLASE'];
$titulo_documento=$_POST['titulo'];
$fecha_publicacion=date("Y-m-d");
$carnet_identidad_docente="1231321412";
$descripcion=$_POST['descripcion'];

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

//funcion para verificar que no exista un pliego para el mismo semestre 
function NoExisteUnPlieEnMismoSemestre($conexionBD,$semestre_anio,$cod_clase){
    $consultaSQL="SELECT * 
    FROM pliego_especificaciones
    WHERE SEMSTRE_ANIO='$semestre_anio'
    AND COD_CLASE='$cod_clase'";

    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return !(isset($filaResultado['SEMSTRE_ANIO']));
    }

//funcion para comprobar que todos los campos del formulario esten llenos

function camposNoLlenos($titulo_documento,$semestre_anio,$descripcion){
    return($titulo_documento===''||  $descripcion==='' || $semestre_anio==='');}

//funcion para publicar el pliego en la base de datos
function ejecutarConsultaSubirDatos($conexionBD,$titulo_documento,$semestre_anio,$descripcion,$fecha_publicacion,$cod_clase){
  $codPliego=$titulo_documento.$semestre_anio.$fecha_publicacion;
  $query="INSERT INTO pliego_especificaciones
    (SEMSTRE_ANIO,
    FECHA_PUBLICACION,
    TITULO_DOCUMENTO,
    DESCRIPCION,
    COD_CLASE,
    TITULO_PLIEGO
    ) VALUES 
    (
    '$semestre_anio',
    '$fecha_publicacion',

    '$codPliego',
    '$descripcion',
    '$cod_clase',
    '$titulo_documento'
     )";
    $result=mysqli_query($conexionBD,$query);
}
//funcion para crear el pliego
// si no existe un pliego, en caso de haber alguno
//se actualizara el pliego previamente publicado
//si se llenaron todos los campos
//y el documento adjuto es un pdf

function subirDatos($conexionBD,$fecha_publicacion,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente,$cod_clase){
    if(NoExisteUnPlieEnMismoSemestre($conexionBD,$semestre_anio,$cod_clase)){
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
        TITULO_PLIEGO='$titulo_documento',
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