<?php

	include "../../Librerias/fpdf/fpdf.php";
	require_once('../DATA/conexion.php');
	$empresa = $_SESSION['Ses_Emp_Cod'];

	$sqlSelectHabitaciones = "select habitacion.*, 
		CASE habitacion.Hab_Estado
		   WHEN 'I' THEN 'Inhabilitado'
		   WHEN 'M' THEN 'Mantenimiento'
		   WHEN 'O' THEN 'Ocupada'
		   ELSE 'Habilitada'
		END AS 'Hab_Estado',
		habitacion_tipo.Tip_Descripcion from habitacion, habitacion_tipo where habitacion.Emp_Cod = $empresa and habitacion_tipo.Tip_Cod = habitacion.Tip_Cod";

	$habitaciones = mysqli_query($conexionHotel, $sqlSelectHabitaciones);
	
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont("Arial","B",14);
	
	$pdf->SetY(10);
	$pdf->SetX(75);
	$pdf->Cell(40,10," Listado de Habitaciones ");

	$pdf->SetFont("Arial","B",10);
	$fecha = date('j-m-y');
	$pdf->SetY(20);
	$pdf->SetX(7);
	$pdf->Cell(15,10,"Fecha:");
	$pdf->SetFont("Arial","",9);

	$pdf->SetY(20);
	$pdf->SetX(19);
	$pdf->Cell(15,10,"$fecha");

//-------------------------------------------------------------------------------------
	$y = 38;
	$x = 5;
	$i = 1;

	while ($row = mysqli_fetch_array($habitaciones))
	{
	    $habCod = $row['Hab_Cod'];
	    $habNum = $row['Hab_Numero'];
	    $habCant = $row['Hab_Cantidad'];
	    $habPre = number_format((float)$row['Hab_Precio'], 2, '.', '');
	    $habDes = $row['Hab_Descripcion'];
	    $habEst = $row['Hab_Estado'];
	    $habTip = $row['Tip_Descripcion'];

	    if($habEst == 'Habilitada'){
	    	$pdf->SetFillColor(107,202,96);
	    }
	    elseif($habEst == 'Inhabilitado'){
	    	$pdf->SetFillColor(175,175,175);
	    }
	    elseif($habEst == 'Ocupada'){
	    	$pdf->SetFillColor(211,83,97);
	    }
	    else{
	    	$pdf->SetFillColor(212,187,47);
	    }

	    $pdf->SetY($y);
		$pdf->SetX($x);
		$pdf->Cell(40,40,"",1,0,'C',True);

		$pdf->SetFont("Arial","B",9);
		$pdf->SetY($y + 1);
		$pdf->SetX($x + 12);
	    $pdf->Cell(20,7,$habNum);

	    $pdf->SetFont("Arial","",8);
	    $pdf->SetY($y + 10);
		$pdf->SetX($x + 10);
		$pdf->Cell(20,7, '#Prs: ' . $habCant);

		$pdf->SetY($y + 17);
		$pdf->SetX($x + 10);
		$pdf->Cell(20,7,'#Tipo: ' . $habTip);

		$pdf->SetY($y + 25);
		$pdf->SetX($x + 10);
		$pdf->Cell(20,7,'Precio: $' . $habPre);


	    if($i%5 == 0){
	    	$y = $y + 40;
	    }
		if($i%5 != 0){
	    	$x = $x + 40;
	    }
	    else{
	    	$x = 5;
	    }
		
		$i++;
	}

	$pdf->SetY($y + 55);
	$pdf->SetX(5);
	$pdf->Cell(20,4,'Leyenda de estados');

	$pdf->SetFillColor(107,202,96);
	$pdf->SetY($y + 60);
	$pdf->SetX(5);
	$pdf->Cell(20,4,'Habilitada',1,0,'C',True);

	$pdf->SetFillColor(211,83,97);
	$pdf->SetY($y + 60);
	$pdf->SetX(25);
	$pdf->Cell(20,4,'Ocupada',1,0,'C',True);

	$pdf->SetFillColor(175,175,175);
	$pdf->SetY($y + 60);
	$pdf->SetX(45);
	$pdf->Cell(20,4,'Inhabilitado',1,0,'C',True);

	$pdf->SetFillColor(212,187,47);
	$pdf->SetY($y + 60);
	$pdf->SetX(65);
	$pdf->Cell(20,4,'Mantenimiento',1,0,'C',True);

	$pdf->output(); 

?>