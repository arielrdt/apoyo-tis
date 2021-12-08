<?php
include("conexionBD.php");
session_start();
$semestreActual;
$mes=date("m");
$anio=date("Y");

if($mes<7){$semestreActual='1-'.$anio;}
else{$semestreActual='2-'.$anio;}

function verificarCodigosRegistrados($conexionBD,$semestreActual){
    $consultaSQL='SELECT * FROM docente,clase WHERE 
    docente.NUMERO_CARNET_IDENTIDAD_DOCENTE=clase.NUMERO_CARNET_IDENTIDAD_DOCENTE 
    and clase.NUMERO_CARNET_IDENTIDAD_DOCENTE="'.$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'].'"
    and clase.SEMESTRE="'.$semestreActual.'"';


    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    if(isset($filaResultado['COD_CLASE']) && $filaResultado['NUMERO_CARNET_IDENTIDAD_DOCENTE']==$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE']){
        $_SESSION['COD_CLASE']=$filaResultado['COD_CLASE'];
        echo json_encode($filaResultado['COD_CLASE']);
    }
    else{ echo json_encode(null);}
    }  
    verificarCodigosRegistrados($conexionBD,$semestreActual)
?>