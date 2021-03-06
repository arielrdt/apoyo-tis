<?php
//se importa la conexion con la base de datos y la libreria fpdt(para la generacion de reportes)
    require '../librerias/fpdf/fpdf.php';
    require '../backend/conexionBD.php';
    //consulta de los estudiante con nota final mayor a 51
    $sql = "SELECT CODIGO_SIS, NOMBRE_CORTO, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, CARRERA, NOTA_EXAMEN_FINAL 
            FROM estudiante WHERE NOTA_EXAMEN_FINAL>=51 ORDER BY NOMBRE_CORTO";
    $resultado = $conexionBD->query($sql);
    //creacion de la estructura del reporte
    $pdf = new FPDF("P", "mm", "LETTER");
    $pdf->AddPage();
    $pdf->SetFont("Arial", "", "10");
    $pdf->Cell(200, 10, "REPORTE ESTUDIANTES APROBADOS", 0, 1, "C");
    $pdf->Cell(20, 5, "Codigo SIS", 1, 0, "L");
    $pdf->Cell(30, 5, "Grupo", 1, 0, "L");
    $pdf->Cell(30, 5, "Nombre", 1, 0, "L");
    $pdf->Cell(30, 5, "Apellido Paterno", 1, 0, "L");
    $pdf->Cell(30, 5, "Apellido Matero", 1, 0, "L");
    $pdf->Cell(30, 5, "Carrera", 1, 0, "L");
    $pdf->Cell(10, 5, "Nota", 1, 1, "L");
    //llenado de las tabla de reporte 
    while($row = $resultado->fetch_assoc()){
        $pdf->Cell(20, 5, $row["CODIGO_SIS"], 1, 0, "L");
        $pdf->Cell(30, 5, $row["NOMBRE_CORTO"], 1, 0, "L");
        $pdf->Cell(30, 5, $row["NOMBRE"], 1, 0, "L");
        $pdf->Cell(30, 5, $row["APELLIDO_PATERNO"], 1, 0, "L");
        $pdf->Cell(30, 5, $row["APELLIDO_MATERNO"], 1, 0, "L");
        $pdf->Cell(30, 5, $row["CARRERA"], 1, 0, "L");
        $pdf->Cell(10, 5, $row["NOTA_EXAMEN_FINAL"], 1, 1, "L");
    }

    $pdf->Output();
?>