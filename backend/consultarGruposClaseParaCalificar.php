<?php
include("conexionBD.php");
session_start(); 
$carnetDocente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
$fechaActual=date("Y-m-d");

// function yaSeEvaluo($nombreGrupo,$fecha){
// //si ya se evaluo a todos los integrantes no mostrar en la lista
// }


function obtenerDatosIntegrantes($datosUnIntegrante,$i){
$htmlTablaIntegrantes='<table class="tabla-miembros">
<tr>
<td>Integrante</td>
<td>rol</td>
<td>codigo sis</td>
<td>asistencia</td>
<td>observación</td>
<td>nota participación</td>
<td>registrar evaluación</td>
</tr>';

$htmlTablaIntegrantes.='<tr>
<form id="formulario-evaluacion-estudiante'.$i.'">
<td>'.$datosUnIntegrante['NOMBRE'].' '.$datosUnIntegrante['APELLIDO_PATERNO'].' '.$datosUnIntegrante['APELLIDO_PATERNO'].'</td> 
<td><span>'.$datosUnIntegrante['ROL'].'</span></td>
<td><input class="input" name="codigoSis" type="text" value="'.$datosUnIntegrante['CODIGO_SIS'].'"></td>
<td><input class="input" name="asistencia" type="text"></td>

<td><input class="input" name="observacion" type="text"></td>
<td><input class="input" name="notaParticipacion" type="text"></td>
<td><button type="button"  data-toggle="modal" data-target="#myModal" name="botonFormulario">registrar</button>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registro Semanal Grupal</h4>
      </div>
      <div class="modal-body">
        <p>Grupo:</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</td>

</form>
</tr>'; 

$htmlTablaIntegrantes.='</table>';
return($htmlTablaIntegrantes);
}

function obtenerDatosGrupos($conexionBD,$carnetDocente,$fechaActual){
$htmlGrupos='<div class="contenedor-tarjeta">';
$consultaSQL="SELECT * 
              from estudiante,grupo_empresa,clase 
              where estudiante.NOMBRE_CORTO=grupo_empresa.NOMBRE_CORTO 
              and estudiante.COD_CLASE=clase.COD_CLASE
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'";
$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
   $i=0;
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){

    $htmlGrupos.='<div class="tarjeta-grupo">
                    <h3>'.$filaTabla['NOMBRE_CORTO'].'</h3>
                    <span>'.$filaTabla['NOMBRE_LARGO'].'</span> 
                    <button id="boton-abrir-modal">editar Informacion</button>
                    <div id="ventana-modal">
                    <div class="contenido-modal">'.obtenerDatosIntegrantes($filaTabla,$i).'</div>  
                    </div>
                </div>';
                $i++;
}
$htmlGrupos.='</div>';


$htmlSalida='<div> la fecha de hoy es: '.$fechaActual.'</div>'.$htmlGrupos;
echo json_encode($htmlSalida);
}
obtenerDatosGrupos($conexionBD,$carnetDocente,$fechaActual);
?>