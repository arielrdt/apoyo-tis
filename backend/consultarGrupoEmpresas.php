<?php
//se importa la base de datos
include("conexionBD.php");
// consulta de todos los grupo empresas
$query="SELECT * FROM grupo_empresa";
$result=mysqli_query($conexionBD, $query);

$salida='';

//de cada nombre corto en una fila retornada de la base de datos
//se recupera los integrantes de la misma
while ($filaGrupo=mysqli_fetch_array($result)) {
    //consulta para recuperar los miembros de la empresa
    $queryEst='SELECT * FROM estudiante WHERE NOMBRE_CORTO="'.$filaGrupo['NOMBRE_CORTO'].'" ';
    $resultEst=mysqli_query($conexionBD, $queryEst);
    

    $salidaEst='';
    //se crea la tabla de miebros en un html almacenado en el string salidaEST
    //que sera esportado al front end
    //de cada miembro, se agregan los datos a la tabla de miembros
    //de la empresa a la que pertenece

    while ($filaEst=mysqli_fetch_array($resultEst)) {
        if(isset($filaEst['NOMBRE_CORTO'])){
            //si hay miembros se indica sus nombres completos y roles
            $salidaEst.='
                <li class="student-content">
                    <div class="student-content-photo-and-name">
                        <img class="student-content-img" src="https://i.postimg.cc/D0qqChkv/linux-avatar.jpg" alt="">
                        <p class="student-content-name">'.$filaEst['NOMBRE'].' '.$filaEst['APELLIDO_PATERNO'].' '.$filaEst['APELLIDO_MATERNO'].'</p>
                    </div>
                    <p class="student-content-rol">'.$filaEst['ROL'].'</p>
                </li> 
            ';
        } else {
            //si la empresa no tiene miembros se indica que no se registraron estudiantes
            $salidaEst.='
                <li class="student-content">
                    <p class="student-content-rol">No se registraron estudiantes en esta grupo empresa</p>
                </li>
            ';
        }
    }
    if ($salidaEst == '') {
        $salidaEst='
            <li class="student-content">
                <p class="student-content-rol">No se registraron estudiantes en esta grupo empresa</p>
            </li>
        ';
    }


    //de cada empresa se recupera el nombre corto,largo, el codigo y el numero de integrantes 
    //se arma en un codigo html guardado en el string salida para ser esportado al front end
    $salida.='
        <div class="main-clase-card">
            <div class="main-card-title">
                <img class="main-card-image" src="https://i.postimg.cc/D0qqChkv/linux-avatar.jpg" alt="">
                <p class="main-card-name">'.$filaGrupo['NOMBRE_CORTO'].'-'.$filaGrupo['NOMBRE_LARGO'].' Codigo: '.$filaGrupo['CODIGO_UNION'].'
                </p>

            </div>
           <h5>Número máximo de itegrantes:'.$filaGrupo['limiteMiembros'].'</h5>
            <div class="main-card-list activo">
                <h3>Integrantes</h3>
                <ul id="main-section-list" class="main-section-list">
                    '.$salidaEst.'
                </ul>
            </div>
        </div>
    ';

}

echo json_encode('   
    <h2 class="main-section-title-group"></h2>
    <div class="main-section-group">
        '.$salida.'
    </div>
');