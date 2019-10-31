<?Php 
require_once('../DATA/conexion.php');

	$tip_descripcion = $_POST["descripcion"];
	$tip_detalle = $_POST["detalle"];
	$empresa = $_SESSION['Ses_Emp_Cod'];

  $sql= "INSERT INTO habitacion_tipo (Tip_Descripcion, Tip_Detalle, Tip_Estado, Emp_Cod) VALUES('$tip_descripcion','$tip_detalle','A', $empresa)";
	
	if (!$conexionHotel)
	{
	    ChromePhp::log("Error en la conexion " . mysqli_connect_error());
	}
	else
	{
	    if (mysqli_query($conexionHotel, $sql)){
	        ChromePhp::log("Se inserto correctamente");
	    } 
	    else {
	        ChromePhp::log("No se inserto correctamente");
	    }
	    mysqli_close($conexionHotel);
	}   

	include('../LOGICA/log_con_habtipo.php');

?>