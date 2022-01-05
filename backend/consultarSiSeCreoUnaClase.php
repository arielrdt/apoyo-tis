<?php
//@param conexionBD:se importa la base de datos
//@param semestre_actual:se calcula el semetre en base al mes y año actuales 
//@param mes=mes actual
//@param anio=año actual
include("conexionBD.php");
//se recupera la sesion actual iniciada
session_start();
$semestreActual;
$mes=date("m");
$anio=date("Y");

if($mes<7){$semestreActual='1-'.$anio;}
else{$semestreActual='2-'.$anio;}


//funcion para verificar si se creo una clase para el semestre actual
//@param semestre_actual:el semestre actual
function verificarCodigosRegistrados($conexionBD,$semestreActual){
    //consulta para verificar si se creo una clase para el semestre actual
    $consultaSQL='SELECT * FROM docente,clase WHERE 
    docente.NUMERO_CARNET_IDENTIDAD_DOCENTE=clase.NUMERO_CARNET_IDENTIDAD_DOCENTE 
    and clase.NUMERO_CARNET_IDENTIDAD_DOCENTE="'.$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'].'"
    and clase.SEMESTRE="'.$semestreActual.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);

    //si hay una clase,retornar su codigo
    if(isset($filaResultado['COD_CLASE']) && $filaResultado['NUMERO_CARNET_IDENTIDAD_DOCENTE']==$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE']){
        $_SESSION['COD_CLASE']=$filaResultado['COD_CLASE'];
        echo json_encode($filaResultado['COD_CLASE']);
    }
    //sino null
    else{ echo json_encode(null);}
    }  
    verificarCodigosRegistrados($conexionBD,$semestreActual)
?>