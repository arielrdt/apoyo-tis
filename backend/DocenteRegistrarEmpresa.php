<?php
include("conexionBD.php");
session_start(); 
$nombre_corto=$_POST['nombreCortoEmpresa'];
$nombre_largo=$_POST['nombreLargoEmpresa'];
$sociedad=$_POST['sociedad'];
$direccion=$_POST['direccionEmpresa'];
$telefono=$_POST['telefonoEmpresa'];
$correo=$_POST['correoEmpresa'];
$fecha=date("Y-m-d");

function generarCodigo(){return(rand(20,35)."".rand(100,125)."".rand(1,11));}

function empresaNoRepetida($conexionBD,$nombre_corto){
  $consulta="SELECT NOMBRE_CORTO FROM GRUPO_EMPRESA WHERE NOMBRE_CORTO='$nombre_corto'";
  $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
  $resultado=mysqli_fetch_array($ejecucionConsulta);
  return(!isset($resultado['NOMBRE_CORTO']));
}


function subirDatos($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo){
      if(empresaNoRepetida($conexionBD,$nombre_corto)){
            $codigoUnion=generarCodigo();    
            $query="INSERT INTO grupo_empresa(
                  NOMBRE_CORTO,	
                  NOMBRE_LARGO,	
                  TIPO_SOCIEDAD,
                  FECHA_CREACION,
                  TELEFONO,
                  DIRECCION,	
                  CORREO_ELECTRONICO,	
                  CODIGO_UNION,
                  limiteMiembros
                  )
                  VALUES 
                ('$nombre_corto',
                '$nombre_largo',
                '$sociedad',
                '$fecha',
                '$telefono',
                '$direccion',
                '$correo',
                '$codigoUnion',
                '5'
                )";
                $result=mysqli_query($conexionBD,$query);
          echo json_encode('empresa registrada exitosamente, el codigo de unión es:'.$codigoUnion);
        }
       else{echo json_encode('el nombre de la empresa ya fue registrado');}
}


subirDatos($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo);

?>