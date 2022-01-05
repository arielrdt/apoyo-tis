<?php
//@param conexionBD:se importa la base de datos
//@param carnetDocente: se recupera el carnet del docente que inicio
//sesion
//@param semestre:se recupera el semestre actual
//@param fechaActual:se recupera la fecha actual
include("conexionBD.php");
//se recupera la sesion actual iniciada
session_start();
$carnetDocente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
$semestre=$_SESSION['SEMESTRE'];
$fechaActual=date("Y-m-d");
//funcion para obtener los alumnos de las empresas, en una tabla con 
//la opcion de cambiar el limite de miembros por grupo empresa
function obtenerAlumnos($conexionBD,$carnetDocente,$semestre, $fechaActual){
//tabla html guardada en el strign ListaAlumnos
//con el nombre,empresa a la que pertenece, el limite de miembros y 
//la opcion de cambiar el numero de integrantes permitidos 
$listaAlumnos='<h1 style="padding:10px; display: flex; justify-content: center;">Grupos de la clase</h1> <div style="padding:10px; display: flex; justify-content: center;"> La fecha de hoy es: '.$fechaActual.'</div>
<table class="tabla-estudiantes">
<tr class="titulo">  
<td>Grupo-Empresa</td>
<td>limite miembros</td>
<td>cambiar limite de miembros</td>
</tr>
';
//consulta para obtener las empresas que pertenescan a la clase del docente
$consultaSQL="SELECT distinct(grupo_empresa.NOMBRE_CORTO) ,grupo_empresa.NOMBRE_LARGO,grupo_empresa.limiteMiembros
              from estudiante,grupo_empresa,clase 
              where estudiante.COD_CLASE=clase.COD_CLASE
              and estudiante.NOMBRE_CORTO=grupo_empresa.NOMBRE_CORTO
              and NUMERO_CARNET_IDENTIDAD_DOCENTE='$carnetDocente'
              order by (grupo_empresa.NOMBRE_CORTO)
              ";

$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);

//de cada empresa se obtiene su nombre corto,largo y limite de miembros
//tambien el boton para cambiar el numero de miembros
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
$empresa=$filaTabla['NOMBRE_CORTO'];
$listaAlumnos.='
<tr>  
<td>'.$filaTabla['NOMBRE_LARGO'].'('.$filaTabla['NOMBRE_CORTO'].')</td>
<td>'.$filaTabla['limiteMiembros'].'</td>
<td><button class="GFG" onclick="editarDatos('.'`'.$empresa.'`'.')">Editar</button></td>
'
;
$listaAlumnos.='
</tr>';
}
$listaAlumnos.='</table>';

echo json_encode($listaAlumnos);
}
obtenerAlumnos($conexionBD,$carnetDocente,$semestre,$fechaActual);

?>