<?php
include("conexionBD.php");
session_start(); 
$codigoEstudiante=$_SESSION['CODIGO_SIS'];

if(isset($_SESSION['EMPRESA'])){
    $nombreCortoEmpresa=$_SESSION['EMPRESA'];
    $rolEstudiante=$_SESSION['ROL'];
}
else{
$nombreCortoEmpresa=null;
$rolEstudiante=null;
}

function EstudianteInscrito($conexionBD,$codigoEstudiante){
    $consultaSQL="SELECT * FROM ESTUDIANTE as e,GRUPO_EMPRESA as g WHERE  e.NOMBRE_CORTO=g.NOMBRE_CORTO and CODIGO_SIS='$codigoEstudiante'";
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return(isset($filaResultado['NOMBRE_CORTO']));
}

function obtenerTablaMiembros($conexionBD,$nombreCortoEmpresa,$rolEstudiante){
$htmlMiembros='<table class="tabla-miembros">
<tr><td>Integrante</td><td>rol</td><td>opcion</td></tr>';
$consultaSQL= $consultaSQL="SELECT distinct * 
                            FROM ESTUDIANTE as e,GRUPO_EMPRESA as g 
                            WHERE e.NOMBRE_CORTO=g.NOMBRE_CORTO 
                                and g.NOMBRE_CORTO='$nombreCortoEmpresa'";
$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
      if($filaTabla['ROL']!='representante legal' && $rolEstudiante=='representante legal'){
                   $htmlMiembros.='<tr>   
                   <td>'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'</td> 
                   <td>'.$filaTabla['ROL'].'</td>
                   <td><button onclick="cargarDatosRol('.$filaTabla['CODIGO_SIS'].','.'`'.$filaTabla['NOMBRE'].' '.$filaTabla['APELLIDO_PATERNO'].' '.$filaTabla['APELLIDO_MATERNO'].'`'.')">asignar nota final</button></td>
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




function obtenerDatosEmpresaEstudiante($conexionBD,$codigoEstudiante,$nombreCortoEmpresa,$rolEstudiante){
    if(EstudianteInscrito($conexionBD,$codigoEstudiante) && $nombreCortoEmpresa!=null )
    {

    $htmlDatosEmpresa='<h2>MI EMPRESA</h2> <br><br>';
    $consultaSQL= $consultaSQL="SELECT * 
                                FROM ESTUDIANTE as e,GRUPO_EMPRESA as g 
                                WHERE e.NOMBRE_CORTO=g.NOMBRE_CORTO 
                                     and CODIGO_SIS='$codigoEstudiante'";
    $ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaTabla=mysqli_fetch_array($ejecucionConsulta);
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