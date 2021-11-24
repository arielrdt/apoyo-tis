<?php
include("conexionBD.php");
session_start(); 
$cod_clase=$_SESSION['COD_CLASE'];

function tareasDeClase($cod_clase,$conexionBD){

$htmlTareas='';

$consultaSQL="SELECT * FROM TAREA WHERE COD_CLASE='$cod_clase'";
$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){
if($filaTabla['TIPO_TAREA']=="Formacion Grupos"){
    $htmlTareas.="
    <div class='section-card-tarea'>
         <p class='card-title'>Formar grupos</p>
            <div class='card-information'>
            <p>Titulo:<span>".$filaTabla['TITULO_TAREA']."</span></p>
            <p>Descripción:<span>".$filaTabla['DESCRIPCION_TAREA']."</span></p>
            <p>Fecha de entrega:<span>".$filaTabla['FECHA_MAXIMA']."</span></p>
            <p>hasta las :<span>".$filaTabla['HORA_MAXIMA']."</span></p>  
            </div>
        <a href='./crearGrupoEmpresa.html' class='boton-crear-grupos'>Crear grupo</a>
    </div>
    ";}

else{
    $htmlTareas.="
    <div class='section-card-tarea'>
         <p class='card-title'>Tarea</p>
            <div class='card-information'>
            <p>Titulo:<span>".$filaTabla['TITULO_TAREA']."</span></p>
            <p>Descripción:<span>".$filaTabla['DESCRIPCION_TAREA']."</span></p>
            <p>Fecha de entrega:<span>".$filaTabla['FECHA_MAXIMA']."</span></p>
            <p>hasta las :<span>".$filaTabla['HORA_MAXIMA']."</span></p>  
            </div>
        <button type='submit' id='boton-ver-tarea'>Ver Tarea</button>
    </div>
    ";}


}
echo json_encode($htmlTareas);
}

tareasDeClase($cod_clase,$conexionBD);



?>