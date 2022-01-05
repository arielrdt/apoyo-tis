<?php
//@param conexionB:se importa la base de datos
//se recupera la sesion actual iniciada
//@param nombre_corto:nombre corto de la nueva empresa
//@param nombre_largo: nombre largo de la nueva empresa
//@param sociedad: tipo de sociedad de la nueva empresa
//@param direccion: direccion de la empresa
//@param telefono: telefono de la empresa
//@param correo: correo de la empresa
//@param fecha: fecha de creacion de la empresa
include("conexionBD.php");
session_start(); 
$nombre_corto=$_POST['nombreCortoEmpresa'];
$nombre_largo=$_POST['nombreLargoEmpresa'];
$sociedad=$_POST['sociedad'];
$direccion=$_POST['direccionEmpresa'];
$telefono=$_POST['telefonoEmpresa'];
$correo=$_POST['correoEmpresa'];
$fecha=date("Y-m-d");

//funcion para generar un codigo de union de la empresa con formato
// de 6 digitos
function generarCodigo(){return(rand(20,35)."".rand(100,125)."".rand(1,11));}

//funcion para validar que el nombre de la empresa no se repita
function empresaNoRepetida($conexionBD,$nombre_corto){
  $consulta="SELECT NOMBRE_CORTO FROM GRUPO_EMPRESA WHERE NOMBRE_CORTO='$nombre_corto'";
  $ejecucionConsulta=mysqli_query($conexionBD,$consulta);
  $resultado=mysqli_fetch_array($ejecucionConsulta);
  return(!isset($resultado['NOMBRE_CORTO']));
}

//funcion para crear la nueva empresa si el nombre no se repite 
function subirDatos($conexionBD,$nombre_corto,$nombre_largo,$sociedad,$fecha,$telefono,$direccion,$correo){
      if(empresaNoRepetida($conexionBD,$nombre_corto)){
            $codigoUnion=generarCodigo();   
//conuslta para crear la nueva empresa 
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