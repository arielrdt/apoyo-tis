<?php
include("conexionBD.php");
$nombre_corto=$_POST['nombreCortoEmpresa'];
$nombre_largo=$_POST['nombreLargoEmpresa'];
$sociedad=$_POST['sociedad'];
$direacion=$_POST['direccionEmpresa'];
$telefono=$_POST['telefonoEmpresa'];
$correo=$_POST['correoEmpresa'];
$fecha_inicio=date("Y-m-d");
$codigo="1234asd";

function estudianteCreoEmpresa($conexionBD,$semestre_anio){
$consultaSQL='SELECT * FROM INVITACION_PUBLICA WHERE SEMESTRE_ANIO="'.$semestre_anio.'"';
$resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
$filaResultado=mysqli_fetch_array($resultadoConsulta);
return (true);
}

function CamposNoLlenos($titulo_documento,$fecha_limite,$carnet_identidad_docente,$semestre_anio,$descripcion){
return($titulo_documento==='' || $fecha_limite==='' ||  
$descripcion==='' || $semestre_anio==='');}

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
        $rutaFinal='../archivos/inv_publicas/'.$nombreNuevoArchivo;
      
        if($nomreOriginalArchivo!=''){
            if($extension=="pdf")
            {
             move_uploaded_file($_FILES["file"]["tmp_name"],$rutaFinal);
             ejecutarConsultaSubirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion);
             echo json_encode("La convocatoria ha sido publicada exitosamente");
            }
           else
           {echo json_encode("el documento debe estar en formato pdf");}
        }
           else{echo json_encode("debe adjuntar un documento");}
        }
    }
    else{echo json_encode("ya se publico una invitacion publica para el semestre ingresado");}
}
subirDatos($conexionBD,$fecha_inicio,$fecha_limite,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente);

?>