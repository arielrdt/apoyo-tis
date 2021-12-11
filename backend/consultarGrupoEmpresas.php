<?php
include("conexionBD.php");

$query="SELECT * FROM grupo_empresa";
$result=mysqli_query($conexionBD, $query);

$salida='';
while ($filaGrupo=mysqli_fetch_array($result)) {

    $queryEst='SELECT * FROM estudiante WHERE NOMBRE_CORTO="'.$filaGrupo['NOMBRE_CORTO'].'" ';
    $resultEst=mysqli_query($conexionBD, $queryEst);
    $filaEst=mysqli_fetch_array($resultEst);

    $salida.='

        <div class="main-clase-card">
            <div class="main-card-title">
                <img class="main-card-image" src="https://i.postimg.cc/D0qqChkv/linux-avatar.jpg" alt="">
                <p class="main-card-name">'.$filaGrupo['NOMBRE_LARGO'].'</p>
            </div>
            <div class="main-card-list activo">
                <h3>Integrantes</h3>
                <ul id="main-section-list" class="main-section-list">
    ';
    if(isset($filaEst['NOMBRE_CORTO'])){
                $salida.='
                    <li class="student-content">
                        <div class="student-content-photo-and-name">
                            <img class="student-content-img" src="https://i.postimg.cc/D0qqChkv/linux-avatar.jpg" alt="">
                            <p class="student-content-name">'.$filaEst['NOMBRE'].' '.$filaEst['APELLIDO_PATERNO'].' '.$filaEst['APELLIDO_MATERNO'].'</p>
                        </div>
                        <p class="student-content-rol">'.$filaEst['ROL'].'</p>
                    </li>
                </ul>
            </div>
        </div>

    ';
    } else {
                $salida.='
                    <li class="student-content">
                        <p class="student-content-rol">No se registraron estudiantes en esta grupo empresa</p>
                    </li>
                </ul>
            </div>
        </div> 
    ';
    }

}

echo json_encode('   
    <h2 class="main-section-title-group">Flores Villarroel Corina</h2>
    <div class="main-section-group">
        '.$salida.'
    </div>
');