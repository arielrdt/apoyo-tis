<?php
include("conexionBD.php");
session_start();
$semestre;
$mes=date("m");
$anio=date("Y");

if($mes<7){$semestre='1-'.$anio;}
else{$semestre='2-'.$anio;}

function verificarCodigosRegistrados($conexionBD,$semestre){
    $consultaSQL='SELECT * FROM docente,clase WHERE 
    docente.NUMERO_CARNET_IDENTIDAD_DOCENTE=clase.NUMERO_CARNET_IDENTIDAD_DOCENTE 
    and clase.SEMESTRE="'.$semestre.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    if(isset($filaResultado['COD_CLASE']) && $filaResultado['NUMERO_CARNET_IDENTIDAD_DOCENTE']==$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE']){
        $_SESSION['COD_CLASE']=$filaResultado['COD_CLASE'];
        echo json_encode($filaResultado['COD_CLASE']);
    }
    else{ echo json_encode(null);}
    }  
    verificarCodigosRegistrados($conexionBD,$semestre)
?>