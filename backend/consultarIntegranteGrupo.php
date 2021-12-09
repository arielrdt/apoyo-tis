<?php
include("conexionBD.php");

// $query="SELECT * FROM grupo_empresa";
// $result=mysqli_query($conexionBD, $query);

$consultaIntegranteRespectivo='SELECT * FROM estudiante WHERE NOMBRE_CORTO = "totalSoft" ';
$resultadoConsulta=mysqli_query($conexionBD,$consultaIntegranteRespectivo);
// $filaIntegrante=mysqli_fetch_array($resultadoConsulta);

$salida='';
while ($filaIntegrante=mysqli_fetch_array($resultadoConsulta)) {

    

    $salida.='

        <li class="student-content">
            <div class="student-content-photo-and-name">
                <img class="student-content-img" src="https://i.postimg.cc/D0qqChkv/linux-avatar.jpg" alt="">
                <p class="student-content-name">'.$filaIntegrante['NOMBRE'].'</p>
            </div>
            <p class="student-content-rol">'.$filaIntegrante['ROL'].'</p>
        </li>

    ';

}

echo json_encode('
    '.$salida.'
');