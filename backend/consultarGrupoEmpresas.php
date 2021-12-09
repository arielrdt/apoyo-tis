<?php
include("conexionBD.php");

$query="SELECT * FROM grupo_empresa";
$result=mysqli_query($conexionBD, $query);

$salida='';
while ($filaGrupo=mysqli_fetch_array($result)) {

    $salida.='

        <a class="main-clase-card" href="./detalleGrupoEmpresa.html">
            <img src="https://i.postimg.cc/D0qqChkv/linux-avatar.jpg" alt="">
            <p class="main-card-name">'.$filaGrupo['NOMBRE_LARGO'].'</p>
        </a>

    ';

}

echo json_encode('   
    <h2 class="main-section-title-group">Flores Villarroel Corina</h2>
    <div class="main-section-group">
        '.$salida.'
    </div>
');