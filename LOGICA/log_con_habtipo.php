<?php
require_once('../DATA/conexion.php');

$empresa = $_SESSION['Ses_Emp_Cod'];


$sqlSelectTipo = "SELECT Id as id, Tip_Descripcion as de FROM habitacion_tipo WHERE Emp_Cod = $empresa";

$tipos_habitacion = mysqli_query($conexionHotel, $sqlSelectTipo);
 ChromePhp::log($sqlSelectTipo);

while ($row = mysqli_fetch_array($tipos_habitacion))
{
    $idTipo = $row['id'];
    $deTipo = $row['de'];
	echo "<option value ='$idTipo'>$deTipo</option>";
} 

?>