<?php
//se importa la base de datos
//se recupera la sesion actual iniciada
//se recupera el codigo sis del alumno guardado al iniciar sesion
include("conexionBD.php");
session_start(); 
$codigoEstudiante=$_SESSION['CODIGO_SIS'];

//se crea las variables de la empresa del estudiante y su rol
//si no tiene, se asigna null
if(isset($_SESSION['EMPRESA'])){
    $nombreCortoEmpresa=$_SESSION['EMPRESA'];
    $rolEstudiante=$_SESSION['ROL'];
}
else{
$nombreCortoEmpresa=null;
$rolEstudiante=null;
}

//funcion para consultar si el estudiante pertenece a un grupo empresa
function EstudianteInscrito($conexionBD,$codigoEstudiante){
    $consultaSQL="SELECT * FROM ESTUDIANTE as e,GRUPO_EMPRESA as g WHERE  e.NOMBRE_CORTO=g.NOMBRE_CORTO and CODIGO_SIS='$codigoEstudiante'";
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return(isset($filaResultado['NOMBRE_CORTO']));
}

//funcion para obtener todos los miembros del grupo al que pertenece el estudiante

function obtenerTablaMiembros($conexionBD,$nombreCortoEmpresa,$rolEstudiante){
//se arma una tabla con un string 
//con el codigo html a ser exportado al front end
$htmlMiembros='<table class="tabla-miembros">
<tr><td>Integrante</td><td>rol</td><td>opcion</td></tr>';

//cosulta de los integrantes del grupo y sus roles
$consultaSQL= $consultaSQL="SELECT distinct * 
                            FROM ESTUDIANTE as e,GRUPO_EMPRESA as g 
                            WHERE e.NOMBRE_CORTO=g.NOMBRE_CORTO 
                                and g.NOMBRE_CORTO='$nombreCortoEmpresa'";
$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
//por cada fila retornada se concatena a la tabla de miembros
//indicando el nombre completo y rol
//si es "representante legal" se agregara la opcion de cambiar el rol a sus compañeros
//sino no vera la opcion disponible

while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
      if($filaTabla['ROL']!='representante legal' && $rolEstudiante=='representante legal'){
                   $htmlMiembros.='<tr>   
                   <td>'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'</td> 
                   <td>'.$filaTabla['ROL'].'</td>
                   <td><button onclick="cargarDatosRol('.$filaTabla['CODIGO_SIS'].','.'`'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'`'.')">asignar rol</button></td>
                   </tr>';
                }
        else{
            $htmlMiembros.='<tr>   
            <td>'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'</td> 
            <td>'.$filaTabla['ROL'].'</td>
            <td></td>
            </tr>';
        }           


                }

$htmlMiembros.='</table>';

return($htmlMiembros);
}

//funcion para obtener el 
// nombre corto,largo,direccion,telefono,correo y codigo de union
// de la empresa de la que el estudiante es miembro
//
function obtenerDatosEmpresaEstudiante($conexionBD,$codigoEstudiante,$nombreCortoEmpresa,$rolEstudiante){
    if(EstudianteInscrito($conexionBD,$codigoEstudiante) && $nombreCortoEmpresa!=null )
    {
    //consulta de datos de la empresa
    $htmlDatosEmpresa='<h2>MI EMPRESA</h2> <br><br>';
    $consultaSQL= $consultaSQL="SELECT * 
                                FROM ESTUDIANTE as e,GRUPO_EMPRESA as g 
                                WHERE e.NOMBRE_CORTO=g.NOMBRE_CORTO 
                                     and CODIGO_SIS='$codigoEstudiante'";
    $ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaTabla=mysqli_fetch_array($ejecucionConsulta);

    //codigo html para ser exportado al front end
    $htmlDatosEmpresa.='<h4>Nombre Corto: <span>'.$filaTabla['NOMBRE_CORTO'].'<span></h4>
                        <h4>Nombre Largo: <span>'.$filaTabla['NOMBRE_LARGO'].'<span></h4>
                        <h4>Dirección: <span>'.$filaTabla['DIRECCION'].'<span></h4>
                        <h4>Teléfono: <span>'.$filaTabla['TELEFONO'].'<span></h4>
                        <h4>codigo de unión: <span>'.$filaTabla['CODIGO_UNION'].'<span></h4><br><br>
                        '; 
    $htmlDatosEmpresa.=obtenerTablaMiembros($conexionBD,$nombreCortoEmpresa,$rolEstudiante);
    echo json_encode ($htmlDatosEmpresa);

    }
    else{echo json_encode(false);}

}
    
obtenerDatosEmpresaEstudiante($conexionBD,$codigoEstudiante,$nombreCortoEmpresa,$rolEstudiante);


?>