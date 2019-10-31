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
	$pdf->SetX(5);
	$pdf->Cell(15,10,"Fecha:");
	$pdf->SetFont("Arial","",9);

	$pdf->SetY(20);
	$pdf->SetX(17);
	$pdf->Cell(15,10,"$fecha");

	$pdf->SetFillColor(175,175,175);
	$pdf->SetFont("Arial","B",9);

	$pdf->SetY(30);
	$pdf->SetX(5);
	$pdf->Cell(10,8,"Cod",1,0,'C',True);

	$pdf->SetY(30);
	$pdf->SetX(15);
	$pdf->Cell(25,8,"#Habitaciones",1,0,'C',True);

	$pdf->SetY(30);
	$pdf->SetX(40);
	$pdf->Cell(20,8,"#Personas",1,0,'C',True);

	$pdf->SetY(30);
	$pdf->SetX(60);
	$pdf->Cell(15,8,"Precio",1,0,'C',True);

	$pdf->SetY(30);
	$pdf->SetX(75);
	$pdf->Cell(80,8,"Descripcion",1,0,'C',True);

	$pdf->SetY(30);
	$pdf->SetX(155);
	$pdf->Cell(25,8,"Tipo",1,0,'C',True);

	$pdf->SetY(30);
	$pdf->SetX(180);
	$pdf->Cell(25,8,"Estado",1,0,'C',True);

	$y = 38;
	$pdf->SetFont("Arial","",8);

	while ($row = mysqli_fetch_array($habitaciones))
	{
	    $habCod = $row['Hab_Cod'];
	    $habNum = $row['Hab_Numero'];
	    $habCant = $row['Hab_Cantidad'];
	    $habPre = number_format((float)$row['Hab_Precio'], 2, '.', '');
	    $habDes = $row['Hab_Descripcion'];
	    $habEst = $row['Hab_Estado'];
	    $habTip = $row['Tip_Descripcion'];


	    $pdf->SetY($y);
		$pdf->SetX(5);
		$pdf->Cell(10,7,$habCod,1);

		$pdf->SetY($y);
		$pdf->SetX(15);
		$pdf->Cell(25,7,$habNum,1);

		$pdf->SetY($y);
		$pdf->SetX(40);
		$pdf->Cell(20,7,$habCant,1);

		$pdf->SetY($y);
		$pdf->SetX(60);
		$pdf->Cell(15,7,$habPre,1);

		$pdf->SetY($y);
		$pdf->SetX(75);
		$pdf->Cell(80,7,$habDes,1);

		$pdf->SetY($y);
		$pdf->SetX(155);
		$pdf->Cell(25,7,$habTip,1);

		$pdf->SetY($y);
		$pdf->SetX(180);
		$pdf->Cell(25,7,$habEst,1);

		$y = $y + 7;
		
	}
	$pdf->output(); 

?>