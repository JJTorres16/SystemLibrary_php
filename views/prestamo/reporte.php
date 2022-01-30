
<?php

    require_once 'controllers/Prestamo.php';

    if(isset($_GET['tipo']))
        $tipoPrestamo = $_GET['tipo'];
    else
        $tipoPrestamo = '';
    
    $objDateTime = new DateTime();
    $fechaActual = $objDateTime->format('Y-m-d');

    ob_start ();
    require_once 'models/ModelFPDF.php';

    // Creación del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('helvetica','B',22);
    
    //Título del reporte:
    $pdf->setXY(10,15);
    $pdf->SetTextColor(0, 128, 128);
    //(Ancho, alto, texto, bordes sí-no, )
    $pdf->Cell(100,8,utf8_decode('Reporte de préstamos a '.$tipoPrestamo), 0, 0, 'L', 0); 

    //Fecha y usuario:
    $pdf->SetFont('helvetica','',12);

    $pdf->setXY(10,27);
    $pdf->Cell(40,5,utf8_decode('Usuario: Torres Velásquez Jesús Julián'), 0, 0, 'L', 0);
    $pdf->setXY(10,33);
    $pdf->Cell(40,5,utf8_decode('Fecha de reporte: '.$fechaActual), 0, 0, 'L', 0);

    // Trazado de línea
    $pdf->Line(10, 40, 190, 40);

    //Empezar trazado de tabla:
    $pdf->SetXY(10,55);
    $pdf->SetFont('helvetica','B',10);
    $pdf->SetTextColor(0, 128, 128);
    $pdf->Cell(10,6, utf8_decode('ID'),0,0,'C',0);
    $pdf->Cell(35,6, utf8_decode('ISBN'),0,0,'C',0);
    $pdf->Cell(30,6, utf8_decode('Alumno'),0,0,'C',0);
    $pdf->Cell(25,6, utf8_decode('Inicio'),0,0,'C',0);
    $pdf->Cell(25,6, utf8_decode('Devolución'),0,0,'C',0);
    $pdf->Cell(40,6, utf8_decode('Estado'),0,0,'C',0);
    $pdf->Cell(15,6, utf8_decode('Refrendos'),0,0,'C',0);

    $pdf->SetDrawColor(0, 128, 128);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10, 62, 190, 62);

    //Se empieza a rellenar la lista:
    $controllerPrestamo = new Prestamo();
    $listaPrestamo = $controllerPrestamo->reportePrestamo();
    $posFila = 66;

    foreach($listaPrestamo as $prestamo){

        if($prestamo['retraso'] == 1 && $prestamo['estado'] == 'Finalizado')
            $estado = 'Finalizado con retraso';
        else
            $estado = $prestamo['estado'];

        $pdf->SetXY(10,$posFila); // Aumenta de 6 en 6
        $pdf->SetFillColor(229, 232, 232 );

        $pdf->SetFont('helvetica','',9);
        $pdf->SetTextColor(0,0,0);

        $pdf->Cell(10,6, $prestamo['idprestamo'] ,0,0,'C',1);
        $pdf->Cell(35,6,$prestamo['isbn'],0,0,'C',1);
        $pdf->Cell(30,6,$prestamo['alumnonocontrol'],0,0,'C',1);
        $pdf->Cell(25,6, $prestamo['fecinit'],0,0,'C',1);
        $pdf->Cell(25,6, $prestamo['fecfin'],0,0,'C',1);
        $pdf->Cell(40,6, $estado,0,0,'C',1);
        $pdf->Cell(15,6, $prestamo['norefrendo'],0,0,'C',1);
        
        //Aumentamos el valor de la posición de la nueva fila:
        $posFila += 8;
    }
    
    $pdf->Output();
    ob_end_flush();

?>
