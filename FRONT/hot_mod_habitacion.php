<?php
require_once('../../administrador/LOGICA/seguridad.php');
require_once($APP_REAL_PATH."/Librerias/ChromePhp.php");
require_once('../DATA/conexion.php');
	
	$codigoHab = $_POST['HabCod'];
	$sqlDatosModificar = 'SELECT * FROM habitacion WHERE Hab_Cod = ' . $codigoHab;

	$datos = mysqli_query($conexionHotel, $sqlDatosModificar);
	while ($row = mysqli_fetch_array($datos))
	{
	    $numHabitacion = $row['Hab_Numero'];
	    $numPersonas = $row['Hab_Cantidad'];
	    $descripcion = $row['Hab_Descripcion'];
	    $precio = $row['Hab_Precio'];
	    $estado = $row['Hab_Estado'];
      $detalle = $row['Hab_Detalle'];
	    $tipo = $row['Tip_Cod'];
	}

    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['Hab_Numero'])) {
        	$hab_codigo= test_input($_POST['Hab_Cod']);
            $hab_numero = test_input($_POST['Hab_Numero']);
            $hab_cantidad = test_input($_POST['Hab_Cantidad']);
            $hab_descripcion = $_POST['Hab_Descripcion'];
            $hab_estado = test_input($_POST['Hab_Estado']);
            $hab_precio = test_input($_POST['Hab_Precio']);
            $hab_detalle = test_input($_POST['hab_detalle']);
            $tip_cod = test_input($_POST['Tip_Cod']);

            updateRoom($conexionHotel, $hab_numero, $hab_cantidad, $hab_descripcion, $hab_estado, $hab_detalle, $tip_cod, $hab_precio, $hab_codigo);
        }

    }

    function updateRoom($conn, $hab_numero, $hab_cantidad, $hab_descripcion, $hab_estado, $hab_detalle, $tip_cod, $hab_precio, $codigoHab)
    {
      
        $sql= "UPDATE habitacion SET Hab_Numero = '$hab_numero', Hab_Cantidad = $hab_cantidad, Hab_Descripcion = '$hab_descripcion', Hab_Estado = '$hab_estado', Hab_Detalle = '$hab_detalle', Tip_Cod = $tip_cod, Hab_Precio = $hab_precio WHERE Hab_Cod = " . $codigoHab;

        ChromePhp::log("Modificar: " . $sql);

        if (!$conn)
        {
            ChromePhp::log("Error en la conexion " . mysqli_connect_error());
        }
        else
        {
            ChromePhp::log("Conexion exitosa");
            if (mysqli_query($conn, $sql)){
                ChromePhp::log("Se modifico correctamente");
                header("Location:hot_con_habitacion.php");
            } 
            else {
                ChromePhp::log("No se modifico correctamente");
            }
            mysqli_close($conn);
        }   
    }

?>


<!DOCTYPE html>
<HTML>

    <HEAD>
        <TITLE><?Php echo $Ses_Sys_Nom; ?></TITLE>
        <?Php require_once("../../mascaras/model1/estilos/jqgrid5.php") ?>

        <style>
            /* The Modal (background) */
            .modal {
              display: none; /* Hidden by default */
              position: fixed; /* Stay in place */
              z-index: 1; /* Sit on top */
              padding-top: 100px; /* Location of the box */
              left: 0;
              top: 0;
              width: 100%; /* Full width */
              height: 100%; /* Full height */
              overflow: auto; /* Enable scroll if needed */
              background-color: rgb(0,0,0); /* Fallback color */
              background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
              position: relative;
              background-color: #fefefe;
              margin: auto;
              padding: 0;
              border: 1px solid #888;
              width: 25%;
              box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
              -webkit-animation-name: animatetop;
              -webkit-animation-duration: 0.4s;
              animation-name: animatetop;
              animation-duration: 0.4s
            }

            /* Add Animation */
            @-webkit-keyframes animatetop {
              from {top:-300px; opacity:0} 
              to {top:0; opacity:1}
            }

            @keyframes animatetop {
              from {top:-300px; opacity:0}
              to {top:0; opacity:1}
            }

            /* The Close Button */
            .close {
              color: white;
              float: right;
              font-size: 28px;
              font-weight: bold;
            }

            .close:hover,
            .close:focus {
              color: #000;
              text-decoration: none;
              cursor: pointer;
            }

            .modal-header {
              padding: 2px 16px;
              background-color: #16293b;
              color: white;
              margin-bottom: 10px;
            }

            .modal-body {padding: 2px 16px;}

            </style>

    </HEAD>

    <BODY>
        <div class="panel panel-main">
            <div class="panel-heading exa-header"><h3 class="panel-title">&raquo;Modificar Habitaciones</h3></div>
            <div class="panel-body ui-widget-content ui-corner-bottom exa-body">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-md-6 col-sm-8">

                        <form class="form-horizontal normal" id="formHabitacion" name="formHabitacion" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                            <fieldset class="exa-fieldset" >
                                <legend class="Titulos2">Datos de la habitación</legend>
                                <div class="form-group Titulos2">
                                    <div class="col-sm-12"><b>NOTA:</b> Los campos que se encuentran marcados con un asterisco (  <span class="required"></span> ) son campos obligatorios.<hr/></div>
                                </div>

                                <input name="Hab_Cod" type="text" class="hidden" value="<?php echo $codigoHab ?>" />

                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required">Nº de Habitación:</label>
                                    <div class="col-xs-6" >
                                        <div class="input-group input-group-xs">
                                            <input id="Hab_Numero" name="Hab_Numero" type="text" class="form-control input-xs" required="" value="<?php echo $numHabitacion ?>" />
                                            <span class="input-group-addon validate" ><i></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required">Nº de personas:</label>
                                    <div class="col-xs-6" >
                                        <div class="input-group input-group-xs">
                                            <input id="Hab_Cantidad" name="Hab_Cantidad" type="text" class="form-control input-xs"  required="" value="<?php echo $numPersonas ?>" />
                                            <span class="input-group-addon validate" ><i></i></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required">Estado:</label>
                                    <div class="col-xs-6" >
                                        <select id="Hab_Estado" name="Hab_Estado" class="form-control input-xs" required="">
                                            <option <?php if($estado=='H') {echo 'selected';} ?> value = "H" >Habilitado</option>
                                            <option <?php if($estado=='I') {echo 'selected';} ?> value = "I" >Inhabilitada</option>
                                            <option <?php if($estado=='M') {echo 'selected';} ?> value = "M" >Mantenimiento</option>
                                            <option <?php if($estado=='O') {echo 'selected';} ?> value = "O" >Ocupada</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs">Detalle:</label>
                                    <div class="col-xs-6" >
                                        <div class="input-group input-group-xs">
                                            <input id="hab_detalle" name="hab_detalle" type="text" class="form-control input-xs" value="<?php echo $detalle ?>" />
                                            <span class="input-group-addon validate" ><i></i></span>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required"><span class='natural'>Descripción:</span></label>
                                    <div class="col-xs-6" ><input id="Hab_Descripcion" name="Hab_Descripcion" type="text" class="form-control input-xs" required="" value="<?php echo $descripcion ?>"/></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required">Precio:</label>
                                    <div class="col-xs-3" >
                                        <div class="input-group input-group-xs">
                                            <input type="number" min="0.00" max="10000.00" step="0.01" id="Hab_Precio" name="Hab_Precio" class="form-control input-xs" required="" value="<?php echo $precio ?>"/>
                                            <span class="input-group-addon validate" ><i></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group natural">
                                    <label class="col-xs-3 control-label label-xs required">Tipo:</label>
                                    <div class="col-xs-6 form-inline">
                                        <select id="Tip_Cod" name="Tip_Cod" class="form-control input-xs">
                                            <?php include ('../LOGICA/log_con_habtipo.php'); ?>
                                        </select>
                                    </div>
                                </div>

                            </fieldset>

                            <div class="center">
                                <button type="submit" class="btn btn-sm btn-primary no"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <script>            
            //Setea el tipo de acuerdo a la habitacion a editar
            document.getElementById("Tip_Cod").value =  "<?php echo $tipo; ?>";
        </script>


    </BODY>
</HTML>

