<?php
require_once('../DATA/conexion.php');

	$hab_numero = test_input($_POST['num']);
    $hab_cantidad = test_input($_POST['cant']);
    $hab_descripcion = $_POST['des'];
    $hab_estado = test_input($_POST['est']);
    $hab_precio = test_input($_POST['pre']);
    $hab_detalle = test_input($_POST['det']);
    $tip_cod = test_input($_POST['tipcod']);
    $empresa = $_SESSION['Ses_Emp_Cod'];

    saveRoom($conexionHotel, $hab_numero, $hab_cantidad, $hab_descripcion, $hab_estado, $hab_detalle, $tip_cod, $empresa, $hab_precio);

	function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    function saveRoom($conn, $hab_numero, $hab_cantidad, $hab_descripcion, $hab_estado, $hab_detalle, $tip_cod, $empresa, $hab_precio)
    {
        $sql= "INSERT INTO habitacion (Hab_Numero, Hab_Cantidad, Hab_Descripcion, Hab_Estado, Hab_Detalle, Tip_Cod, Emp_Cod, Hab_Precio) VALUES('$hab_numero', $hab_cantidad ,'$hab_descripcion','$hab_estado','$hab_detalle', $tip_cod, $empresa, $hab_precio)";

        if (!$conn)
        {
            echo "Problema en conexion a la base de datos!";
        }
        else
        {
            if (mysqli_query($conn, $sql)){

            	echo "Se guardo correctamente!";
            } 
            else {

                echo "No se logro guardar!";
            }
            mysqli_close($conn);
        } 
    }
?>