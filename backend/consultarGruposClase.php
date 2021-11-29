<?php
include("conexionBD.php");
session_start(); 
$carnetDocente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];

function obtenerDatosIntegrantes($datosUnIntegrante){
$htmlTablaIntegrantes='<table class="tabla-miembros">
<tr>
<td>Integrante</td>
<td>rol</td>
<td>editar rol</td>
<td>eliminar del grupo</td>
</tr>';

$htmlTablaIntegrantes.='<tr>
<td>'.$datosUnIntegrante['NOMBRE'].' '.$datosUnIntegrante['APELLIDO_PATERNO'].' '.$datosUnIntegrante['APELLIDO_PATERNO'].'</td> 
<td><span>'.$datosUnIntegrante['ROL'].'</span></td>
<td><button>editar</button></td>
<td><button>eliminar</button></td>
</tr>'; 

$htmlTablaIntegrantes.='</table>';

return($htmlTablaIntegrantes);
}



function obtenerDatosGrupos($conexionBD,$carnetDocente){
$consultaSQL="SELECT * 
              from estudiante,grupo_empresa,clase 
              where estudiante.NOMBRE_CORTO=grupo_empresa.NOMBRE_CORTO 
              and estudiante.COD_CLASE=clase.COD_CLASE
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);

$htmlGrupos='<h1>Revisar grupo-empresas</h1><div class="contenedor-tarjeta">';
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){

    $htmlGrupos.='<div class="tarjeta-grupo">
                    <h3>'.$filaTabla['NOMBRE_CORTO'].'</h3>
                    <span>'.$filaTabla['NOMBRE_LARGO'].'</span> 
                     
                    <div id="ventana-modal">
                    <div class="contenido-modal">'.obtenerDatosIntegrantes($filaTabla).'</div>  
                    </div>
                </div>';
}
$htmlGrupos.='</div>';



echo json_encode($htmlGrupos);
}
obtenerDatosGrupos($conexionBD,$carnetDocente);
?>