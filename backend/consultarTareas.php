<?php
//@param conexionBD:se importa la base de datos
//@param cod_clase: se recupera el codigo de la clase en la que
//el alumno esta registrado
include("conexionBD.php");
//se recupera la sesion actual iniciada
session_start(); 
$cod_clase=$_SESSION['COD_CLASE'];
//funcion para retornar las tareas de la clase en la que esta inscrito
//el elumno
function tareasDeClase($cod_clase,$conexionBD){
//html guardado en la variable de tipo string htmlTareas
//que contendra las tareas en orden:
// titulo,descripcion,fecha limite,hora limite 
$htmlTareas='';

//consulta de tareas de la clase
$consultaSQL="SELECT * FROM TAREA WHERE COD_CLASE='$cod_clase'";
$ejecucionConsulta=mysqli_query($conexionBD,$consultaSQL);
while($filaTabla=mysqli_fetch_array($ejecucionConsulta)){

//si es una tarea de formar grupos se agregara un boton para formar grupos
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

    //sino es una tarea de formar grupo,se agregara el boton para ver y responder la tarea
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