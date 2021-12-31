<?php
include("conexionBD.php");
session_start(); 
$cod_clase=$_SESSION['COD_CLASE'];
$query="SELECT * FROM invitacion_publica WHERE COD_CLASE='$cod_clase'";
$result=mysqli_query($conexionBD,$query);
$salida='';
while ($filaInvitacion=mysqli_fetch_array($result)){
$consultaPliegoRespectivo="SELECT * 
FROM PLIEGO_ESPECIFICACIONES 
WHERE COD_CLASE='$cod_clase'";

$resultadoConsulta=mysqli_query($conexionBD,$consultaPliegoRespectivo);
$filaPliego=mysqli_fetch_array($resultadoConsulta);


$salida.='
    <div class="card">
            
        <div class="card-sa"> 
                             <p> '.$filaInvitacion['SEMESTRE_ANIO'].'</p>
            <div class="card-dates">
                            <p>Fecha de publicación: '.$filaInvitacion['FECHA_INICIO'].'</p>
                            <p>Fecha límite: '.$filaInvitacion['FECHA_LIMITE'].'</p>
            </div>
        </div>


        <div class="main-section-post-info">
                            <div class="main-section-post-info-photo">
                            <img src="../img/profile.png">
                            </div>
            <div class="main-section-post-info-content">
                <div class="main-section-post-info-content-convocatoria">
                    <h3>Invitacion pública</h3>
                    <div class="card-title">
                        <h4> Título: '.$filaInvitacion['TITULO_DOCUMENTO'].'</h4>
                    </div>
                    <p class="card-description">'.$filaInvitacion['DESCRIPCION'].'</p>

                    <a target="_blank" href="https://firebasestorage.googleapis.com/v0/b/tis2021.appspot.com/o/invitaciones%2F'.$filaInvitacion['SEMESTRE_ANIO'].'/'.$filaInvitacion['TITULO_DOCUMENTO'].'.pdf?alt=media&token=75b1d469-3233-47ff-8e43-8cb087c55a74"> ver PDF de la invitacion publica</a>
                    
                    <br>
                    <hr>
                </div>
            
        


                ';
    if(isset($filaPliego['SEMSTRE_ANIO'])){
    $salida.='
    <div class="main-section-post-info-content-pliego">
        <h3>Pliego de especificaciones</h3>
        <div class="card-title">
            <h4> Título: '.$filaPliego['TITULO_DOCUMENTO'].'</h4>
        </div>
        <p class="card-description">'.$filaPliego['DESCRIPCION'].'</p>
        <a target="_blank" href="https://firebasestorage.googleapis.com/v0/b/tis2021.appspot.com/o/pliegos%2F'.$filaPliego['SEMSTRE_ANIO'].'/'.$filaPliego['TITULO_PLIEGO'].'.pdf?alt=media&token=46543fa2-b51e-406a-a4d4-0e63290e2e40 
      ">ver PDF pliego de especificaciones</a>
    </div>
    </div>
    </div>
    </div>
     ';
     } 
    else{
    $salida.='<div class="mensaje-pliego-no-publicado main-section-post-info-content-pliego">
                <h3>Pliego aun no publicado</h3>      
              </div>
              </div>
    </div>
    </div>';



    }




}

echo json_encode('<h1>Lista de convocatorias</h1>
                 <div class="cards">'.$salida.'</div>');

?>