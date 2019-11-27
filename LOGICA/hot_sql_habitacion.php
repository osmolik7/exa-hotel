<?php
/**
 * Retorna consulta sql a ejecutarse
 * 
 * @author Alejandro Camacho
 * @version 1.0
 * 
 * 
 * @package hotel.LOGICA
 */
require_once('../../Librerias/ChromePhp.php');

function sentencias_cli($id,$Par_Sql)
{
	switch($id)
	{
		//Guardar habitacion 
		case 1:
			$sql= "INSERT INTO habitacion (Hab_Numero, Hab_Cantidad, Hab_Descripcion, Hab_Estado, Hab_Detalle, Tip_Cod, Emp_Cod, Hab_Precio) VALUES('$Par_Sql[Hab_Numero]', $Par_Sql[Hab_Cantidad] ,'$Par_Sql[Hab_Descripcion]','$Par_Sql[Hab_Estado]','$Par_Sql[Hab_Detalle]', $Par_Sql[Tip_Cod], $Par_Sql[Emp_Cod], $Par_Sql[Hab_Precio])";
		return $sql;
		break;


		//Guardar tipo habitacion
		case 2:
			$sql=  $sql= "INSERT INTO habitacion_tipo (Tip_Descripcion, Tip_Detalle, Tip_Estado, Emp_Cod) VALUES('$Par_Sql[Tip_Descripcion]','$Par_Sql[Tip_Detalle]','A', $Par_Sql[Emp_Cod])";
		return $sql;
		break;


		//Cargar tipos de habitacion
		case 3:
			$sql= "SELECT Tip_Cod as id, Tip_Descripcion as de, Tip_Detalle as det FROM habitacion_tipo WHERE Emp_Cod = $Par_Sql[Emp_Cod]";
		return $sql;
		break;
		
		
	}
}
?>