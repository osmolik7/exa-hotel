<?php
require_once('../DATA/conexion.php');

$datoBusqueda = $_GET['q'];
$filtroAdicional = $_GET['o'];
$sqlAdicional = '';
$empresa = $_SESSION['Ses_Emp_Cod'];

if($filtroAdicional == 'h'){
	$sqlAdicional = " and Hab_Num like '%$datoBusqueda%'";
}
elseif($filtroAdicional == 'c'){
	$sqlAdicional= " and Hab_Num_Prs like '%$datoBusqueda%'";
}
elseif($filtroAdicional == 'p'){
	$sqlAdicional= " and Hab_Precio like '%$datoBusqueda%'";
}
else{
	$sqlAdicional= " and habitacion_tipo.Tip_Descripcion like '%$datoBusqueda%'";
}

if($datoBusqueda <> ''){
	$sqlSelectHabitaciones = "select habitacion.*,
	CASE habitacion.Hab_Est
	   WHEN 'I' THEN 'Inhabilitado'
	   WHEN 'M' THEN 'Mantenimiento'
	   WHEN 'O' THEN 'Ocupada'
	   ELSE 'Habilitada'
	END AS 'Hab_Estado',
	 habitacion_tipo.Tip_Descripcion from habitacion, habitacion_tipo where habitacion.Emp_Cod = $empresa and habitacion_tipo.Id = habitacion.Tip_Hab_Cod" . $sqlAdicional; 
}
else{
	$sqlSelectHabitaciones = "select habitacion.*, 
	CASE habitacion.Hab_Est
	   WHEN 'I' THEN 'Inhabilitado'
	   WHEN 'M' THEN 'Mantenimiento'
	   WHEN 'O' THEN 'Ocupada'
	   ELSE 'Habilitada'
	END AS 'Hab_Estado',
	habitacion_tipo.Tip_Descripcion from habitacion, habitacion_tipo where habitacion.Emp_Cod = $empresa and habitacion_tipo.Id = habitacion.Tip_Hab_Cod";
}

echo "<thead class='thead-dark ui-th-column ui-th-ltr ui-state-default' >
		<tr style='border-radius: 10px;'>
			<th class='text-center' scope='col' >
			</th>
			<th class='text-center' scope='col'>
				Cod.
			</th>
			<th class='text-center' scope='col'>
				#Habitacion
			</th>
			<th class='text-center' scope='col'>
				#Personas
			</th>
			<th class='text-center' scope='col'>
				Precio
			</th>
			<th class='text-center' scope='col'>
				Descripcion
			</th>
			<th class='text-center' scope='col'>
				Tipo
			</th>
			<th class='text-center' scope='col'>
				Estado
			</th>
			<th class='text-center' scope='col'>
				
			</th>
		</tr>
	</thead>
	<tbody>";

$habitaciones = mysqli_query($conexionHotel, $sqlSelectHabitaciones);
$i=1;
while ($row = mysqli_fetch_array($habitaciones))
{
    $habCod = $row['Hab_Cod'];
    $habNum = $row['Hab_Num'];
    $habCant = $row['Hab_Num_Prs'];
    $habPre = number_format((float)$row['Hab_Precio'], 2, '.', '');
    $habDes = $row['Hab_Des'];
    $habEst = $row['Hab_Estado'];
    $habEstDet = $row['Hab_Est_Det'];
    $habTip = $row['Tip_Descripcion'];

	$colorEstado = '';
    if($habEst == 'Inhabilitado'){
    	$colorEstado = "label-default";
    }
    elseif($habEst == 'Habilitada'){
    	$colorEstado = "label-success";
    }
    elseif($habEst == 'Mantenimiento'){
    	$colorEstado = "label-warning";
    }
    else{
    	$colorEstado = "label-danger";
    }

    //#f3f7fc

	echo "<tr>
			<td role='gridcell' class='jqgrid-rownum ui-state-default' style='text-align:center;width: 30px;' title='$i' aria-describedby='tableResult_rn'>$i</td>
			<td style='text-align:center;width: 50px'> $habCod </td>
			<td class='col-md-1'> $habNum </td>
			<td style='text-align:center;width: 50px;'> $habCant </td>
			<td style='text-align:center;width: 50px;'> $habPre </td>
			<td class='col-md-6'> $habDes </td>
			<td class='col-md-1 style='width: 80px;''> $habTip </td>
			<td class='col-md-1' style='font-size:13px'> <span title='$habEstDet' class='label " . $colorEstado ."'> $habEst </span></td>
			<td class='col-md-1' style='width: 60px;'>

			<div role='group'>
				<form  method='POST' action='hot_mod_habitacion.php'>
				  <input type='hidden' id='HabCod' name='HabCod' value='$habCod'/>
				  <button type='submit' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-edit'> </span>
				  </button>
				  <button type='button' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-trash' onclick='anularHabitacion($habCod)'> </span>
				  </button>
				</form>
			</div>

			</td>
		</tr>";

	$i++;
} 
echo " </tbody>";

?>
