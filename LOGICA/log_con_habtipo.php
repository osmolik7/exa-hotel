<?php
	require_once('../DATA/conexion.php');

	$empresa = $_SESSION['Ses_Emp_Cod'];

	$sqlSelectTipo = "SELECT Tip_Cod as id, Tip_Descripcion as de, Tip_Detalle as det FROM habitacion_tipo WHERE Emp_Cod = $empresa";

	$tipos_habitacion = mysqli_query($conexionHotel, $sqlSelectTipo);
	while ($row = mysqli_fetch_array($tipos_habitacion))
	{
	    $idTipo = $row['id'];
	    $deTipo = $row['de'];
	    $detTipo = $row['det'];

		echo "<option title='$detTipo' value ='$idTipo'>$deTipo</option>";
	} 

?>