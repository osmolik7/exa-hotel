<?php
require_once('../DATA/conexion.php');

$codigo = $_GET['c'];

$sqlAnular = "UPDATE habitacion SET Hab_Estado = 'I' WHERE Hab_Cod = $codigo";
mysqli_query($conexionHotel, $sqlAnular);

?>