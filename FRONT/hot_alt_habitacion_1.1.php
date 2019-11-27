<?php

	require_once('../../administrador/LOGICA/seguridad.php');
	require_once('../../Librerias/procedimientos/almacenados_standar.php');
	require_once('../LOGICA/hot_log_habitacion.php');
    require_once('../../Librerias/ChromePhp.php');

	/**
	* objeto para la conexion
	*/
	$obBD_conexion = new Class_Log_Conexion_Hab($Ses_Dat_Dis);

	/**
	* objeto para crud en bd
	*/
	$obBD_con1 =  new Class_Log_Datos_Hab;

	if(isset($guardarHabitacion)){

	    $data=$_POST;
	    $data['Emp_Cod']=$Ses_Emp_Cod;
	    $obBD_con1->inicio_transaccion($obBD_conexion);

	    $obBD_con1->operacionobBD(1,$data,$obBD_conexion);   

	    $obBD_con1->fin_transaccion_nomsn($obBD_conexion);

	    if ($obBD_con1->Error == 0) { 
	    	$responce['success'] = true; 
	    }
	    else{ 
	    	$responce['success'] = false; 
	    	$responce['message'] = "No se ha logrado realizar la Transaccion"; 
	    }
	    
	    $obBD_con1->echoJson($responce);
	}

    if(isset($guardarTipoHab)){

        $data=$_POST;
        $data['Emp_Cod']=$Ses_Emp_Cod;
        ChromePhp::log($data);
        $obBD_con1->inicio_transaccion($obBD_conexion);
        $obBD_con1->operacionobBD(2,$data,$obBD_conexion);   
        $obBD_con1->fin_transaccion_nomsn($obBD_conexion);

        if ($obBD_con1->Error == 0) { 
            $responce['success'] = true; 
        }
        else{ 
            $responce['success'] = false; 
            $responce['message'] = "No se ha logrado realizar la Transaccion"; 
        }
        
        $obBD_con1->echoJson($responce);
    }

	if(isset($getTipHab))
    {	
    	$getdata = $_GET;
    	$getdata['Emp_Cod']=$Ses_Emp_Cod;

        $data['tipHab'] = $obBD_con1->getArrayConsulta(3, $getdata, $obBD_conexion);

        if (count($data['tipHab']) > 0){
            $data['success'] = true;
        }
        else{$data['success'] = true;
        }

        $obBD_con1->echoJson($data);
    }
      $getdata['Emp_Cod']=$Ses_Emp_Cod;
      $tipHab = $obBD_con1->getArrayConsulta(3, $getdata, $obBD_conexion);
?>

<!DOCTYPE html>
<HTML>
    <HEAD>
        <TITLE><?Php echo $Ses_Sys_Nom; ?></TITLE>
        <link rel="stylesheet" type="text/css" media="screen" href="../../framework/jquery/chosen/chosen-1.4.2/chosen.min.css" />
        <?Php require_once("../../mascaras/model1/estilos/jqgrid5.php") ?>
        <script type="text/javascript" src="../../framework/jquery/chosen/chosen-1.4.2/chosen.min.js"></script>
        <script type="text/javascript" src="../../framework/jquery/chosen/chosenDesc/chosenDesc.js"></script>
    </HEAD>
    <BODY>
        <div class="panel panel-main">
            <div class="panel-heading exa-header"><h3 class="panel-title">&raquo;  Registrar Habitacion</h3></div>
            <div class="panel-body ui-widget-content ui-corner-bottom exa-body">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-md-6 col-sm-8">
                        
                        <form class="form-horizontal normal" id="formHabitacion" name="formHabitacion" action="javascript:guardarHabitacion();">

                            <fieldset class="exa-fieldset" >
                                <legend class="Titulos2">Datos de la habitación</legend>
                                <div class="form-group Titulos2">
                                    <div class="col-sm-12"><b>NOTA:</b> Los campos que se encuentran marcados con un asterisco (  <span class="required"></span> ) son campos obligatorios.<hr/></div>
                                </div>


                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required">Nº de Habitación:</label>
                                    <div class="col-xs-6" >
                                        <div class="input-group input-group-xs">
                                            <input id="Hab_Numero" name="Hab_Numero" type="text" class="form-control input-xs" required="" />
                                            <span class="input-group-addon validate" ><i></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required">Nº de personas:</label>
                                    <div class="col-xs-6" >
                                        <div class="input-group input-group-xs">
                                            <input id="Hab_Cantidad" name="Hab_Cantidad" type="text" class="form-control input-xs"  required="" />
                                            <span class="input-group-addon validate" ><i></i></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required">Estado:</label>
                                    <div class="col-xs-6" >
                                        <select id="Hab_Estado" name="Hab_Estado" class="form-control input-xs" required="">
                                            <option value = "H" >Habilitado</option>
                                            <option value = "I" >Inhabilitada</option>
                                            <option value = "M" >Mantenimiento</option>
                                            <option value = "O" >Ocupada</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs">Detalle:</label>
                                    <div class="col-xs-6" >
                                        <div class="input-group input-group-xs">
                                            <input id="Hab_Detalle" name="Hab_Detalle" type="text" class="form-control input-xs" />
                                            <span class="input-group-addon validate" ><i></i></span>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required"><span class='natural'>Descripción:</span></label>
                                    <div class="col-xs-6" ><input id="Hab_Descripcion" name="Hab_Descripcion" type="text" class="form-control input-xs" required="" /></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-3 control-label label-xs required">Precio:</label>
                                    <div class="col-xs-3" >
                                        <div class="input-group input-group-xs">
                                            <input type="number" min="0.00" max="10000.00" step="0.01" id="Hab_Precio" name="Hab_Precio" class="form-control input-xs" required="" />
                                            <span class="input-group-addon validate" ><i></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group natural">
                                    <label class="col-xs-3 control-label label-xs required">Tipo:</label>
                                    <div class="col-xs-6 form-inline">
                                        <select id="Tip_Cod" name="Tip_Cod" class="form-control input-xs">

                                           <?php
                                           foreach ($tipHab as $tipo) {
                                                echo "<option value='{$tipo['id']}'>{$tipo['de']}</option>";
                                           }
                                           ?>

                                        </select>

                                        <a class="btn btn-success btn-xs" title="Agregar tipo" id="myBtn"><span class="glyphicon glyphicon-plus"></span></a>

                                    </div>
                                </div>

                            </fieldset>

                            <div class="center">
                                <button type="button" onclick="$(this.form).formSubmit();" class="btn btn-sm btn-primary no"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                            </div>
                        </form>


                        <div id="editDialog" title="">
	                        <form id ="formDialog" name="formDialog" class="form-horizontal" autocomplete="off">
				                <fieldset>
				                <div class="form-group Titulos2">
				                    <div class="col-sm-12"><b>NOTA:</b> Los campos que se encuentran marcados con un asterisco (  <span class="required"></span> ) son campos obligatorios.<hr/></div>
				                </div>

				                <div class="form-group">
				                  <label class="col-md-4 control-label label-xs required" for="Tip_Descripcion">Nombre:</label>  
				                  <div class="col-md-6">
				                      <input id="Tip_Descripcion" name="Tip_Descripcion" type="text" class="form-control input-xs" required="">
				                  </div>
				                </div>

				                <div class="form-group">
				                  <label class="col-md-4 control-label label-xs required" for="Tip_Detalle">Detalle:</label>  
				                  <div class="col-md-6">
				                      <input id="Tip_Detalle" name="Tip_Detalle" type="text" class="form-control input-xs" required="">
				                  </div>
				                </div>

				                <!-- Buttons -->
				                <div class="form-group">
				                  <div class="center">
				                      <button ype="button" id="btnAccion" onclick="$(this.form).formSubmit();" name="btnAccion" class="btn btn-sm btn-primary"></button>
				                  </div>
				                </div>

				                </fieldset>
				            </form>
				        </div>


                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">

        	function inicio()
		    {
		        $( "#editDialog" ).createDialog({width:400,height:180,icon:'pencil'});
		    }	

   			window.onload = inicio();

        	$('#myBtn').on("click", function(e){
		        $('#editDialog').dialog("option","title","Nuevo Tipo");      
		        $('#btnAccion').html("<i class='glyphicon glyphicon-floppy-disk'></i>   Guardar");
		        $('#editDialog').dialog('open');
		        $("#formDialog")[0].reset();
		   });

        	 function clear(){
                $('#Hab_Numero').val('').focus();
                $('#Hab_Cantidad').val('');
                $('#Hab_Estado').val('');
                $('#Hab_Detalle').val('');
                $('#Hab_Descripcion').val('');
                $('#Hab_Precio').val('');
                $('#Hab_Estado').prop('selectedIndex',0);
                $('#Tip_Cod').prop('selectedIndex',0);
            }

            function guardarHabitacion(){
                $.saveDataJson("",$('#formHabitacion').getData('guardarHabitacion'), function( resp ){ 
                	clear();
                 });
            }

             $('#btnAccion').on("click", function(e){

              $.saveDataJson("",$('#formDialog').getData('guardarTipoHab'), function( resp ){ 
                     $('#editDialog').dialog('close');
                 });
                    
                $.getDataJson("",{getTipHab:true, Tip_Descripcion: $('#Tip_Descripcion').val(), Tip_Detalle: $('#Tip_Detalle').val()},function(res){

                    var data = "";       
                    $.each(res.tipHab, function(i,item){
                        data += "<option value="+item.id+">"+item.de+"</option>";
                    });
                    $('#Tip_Cod').html(data);
                },function(nr){});
                           
              });

  
        </script>

    </BODY>
</HTML>

