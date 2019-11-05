<?php
require_once('../../administrador/LOGICA/seguridad.php');
require_once($APP_REAL_PATH."/Librerias/ChromePhp.php");
require_once('../DATA/conexion.php');
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
            <div class="panel-heading exa-header"><h3 class="panel-title">&raquo;Registrar Habitaciones</h3></div>
            <div class="panel-body ui-widget-content ui-corner-bottom exa-body">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-md-6 col-sm-8">

                        <form class="form-horizontal normal" id="formHabitacion" name="formHabitacion"  onsubmit="return guardarHabitacion()">

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
                                            <input id="hab_detalle" name="hab_detalle" type="text" class="form-control input-xs" />
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
                                            <?php include ('../LOGICA/log_con_habtipo.php'); ?>
                                        </select>

                                        <button class="btn btn-success btn-xs" title="Agregar tipo" id="myBtn"><span class="glyphicon glyphicon-plus"></span></button>

                                    </div>
                                </div>

                            </fieldset>

                            <div class="center">
                                <button type="submit" class="btn btn-sm btn-primary no"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                            </div>
                        </form>


                    
                    <div id="myModal" class="modal">
                      <div class="modal-content">
                        <div class="modal-header">
                          <span class="close">&times;</span>
                          <p>Registrar tipo</p>
                        </div>

                         <form class="form-horizontal normal" id="formHabitacionTipo" name="formHabitacionTipo" onsubmit="return guardarTipo()">

                            <div class="form-group">
                                <label class="col-xs-3 control-label label-xs required">Descripción:</label>
                                <div class="col-xs-9" >
                                    <div class="input-group input-group-xs">
                                        <input id="Tip_Descripcion" name="Tip_Descripcion" type="text" class="form-control input-xs" required="" />
                                        <span class="input-group-addon validate" ><i></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label class="col-xs-3 control-label label-xs required">Detalle:</label>
                                <div class="col-xs-9" >
                                    <div class="input-group input-group-xs">
                                        <input id="Tip_Detalle" name="Tip_Detalle" type="text" class="form-control input-xs" required="" />
                                        <span class="input-group-addon validate" ><i></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="center" style="margin-bottom:10px;">
                                <button type="submit" class="btn btn-sm btn-primary no"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                            </div>
                        </form>
                      </div>
                    </div>



                    </div>
                </div>
            </div>
        </div>


        <script>            

            // Get the modal
            var modal = document.getElementById("myModal");
            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            // When the user clicks the button, open the modal 
            btn.onclick = function() {
              modal.style.display = "block";
            }
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
              modal.style.display = "none";
            }
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
              if (event.target == modal) {
                modal.style.display = "none";
              }
            }
            
            //PARA GUARDAR LA HABITACION Y ACTUALICE EL COMBO
            function guardarHabitacion(){
                var num = document.getElementById('Hab_Numero').value;
                var cant = document.getElementById('Hab_Cantidad').value;
                var des = document.getElementById('Hab_Descripcion').value;
                var est = document.getElementById('Hab_Estado').value;
                var pre = document.getElementById('Hab_Precio').value;
                var det = document.getElementById('hab_detalle').value;
                var tipcod = document.getElementById('Tip_Cod').value;

                var xhttp = new XMLHttpRequest();              
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) 
                    {
                      document.getElementById('Tip_Cod').innerHTML = this.responseText;
                    }
                  };

                xhttp.open("POST","../LOGICA/log_alt_habitacion.php", true);
                xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                xhttp.send("num="+num+"&cant="+cant+"&des="+des+"&est="+est+"&pre="+pre+"&det="+det+"&tipcod="+tipcod);
            }


            //PARA GUARDAR EL TIPO Y ACTUALICE EL COMBO
            function guardarTipo(){
                var descripcion = document.getElementById('Tip_Descripcion').value;
                var detalle = document.getElementById('Tip_Detalle').value;
                var xhttp = new XMLHttpRequest();              
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) 
                    {
                      document.getElementById('Tip_Cod').innerHTML = this.responseText;
                    }
                  };

                xhttp.open("POST","../LOGICA/log_alt_habtipo.php", true);
                xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                xhttp.send("descripcion="+descripcion+"&detalle="+detalle);
            }

        </script>


    </BODY>
</HTML>

