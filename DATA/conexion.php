<?php
require_once("../../administrador/LOGICA/seguridad.php");
require_once($APP_REAL_PATH."/Librerias/ChromePhp.php");


	$servidor = "127.0.0.1";
	$usuario = "root";
	$contra = "rootpass";  
	$basedatos = "exa_master";

	$conn = new mysqli($servidor, $usuario, $contra, $basedatos);
	$sqlSelectDB = "SELECT Dat_Dis as db FROM data where Emp_Cod = " . $_SESSION['Ses_Emp_Cod'];
	$result = mysqli_query($conn, $sqlSelectDB);
    while ($row = mysqli_fetch_array($result)){
        $db = $row['db'];
    }

    $conexionHotel = mysqli_connect($servidor, $usuario, $contra, $db); 


?>