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
        <style type="text/css">
            div.table-responsive{
                overflow: scroll; height: 300px;
            }
            table.table-bordered > thead > tr > th{
              border:1px solid #789;
            }
            table.table-bordered > tbody > tr > td{
              border:1px solid #789;
            }
            table th:first-child{
              border-radius:10px 0px 0px 0px;
            }
            table th:last-child{
              border-radius:0px 10px 0 0px;
            }
            table{
                font-family:Lucida Grande,Lucida Sans,Arial,sans-serif; 
                font-size: 9px; 
                border-color: black;
            }

            a{
                text-decoration: none;
            }
             a:visited {
                color:#ffffff;
            }
        </style>
    </HEAD> 


    <BODY>
        <div class="panel panel-main">
           <div class="panel-heading exa-header"><h3 class="panel-title">&raquo;  Consultar Habitaciones</h3></div>
            <div class="panel-body ui-widget-content ui-corner-bottom exa-body">
                
              <div class="row">

                <div class="col-sm-12">
                    <div id="tabsUser" class="ui-tab-fix ui-tabs noPaddingH">
                      <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" >
                        <form id="frm_bus" name="frm_bus" class="form-horizontal normal" action="javascript:">
                            <fieldset class="exa-fieldset">
                                <legend class="Titulos2">B&uacute;squeda de habitaciones</legend>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label label-xs">Filtrar por:</label>
                                    <div class="col-sm-5 radioset" style="margin-right: 0px; padding-right: 0px;">
                                        <input id="rad_ba1" name="op_opciones" type="radio" value="h" checked="" onclick="setfocus(this.form.search)"/>
                                        <label for="rad_ba1">&nbsp;&nbsp;#Habitacion&nbsp;&nbsp;</label>

                                        <input id="rad_ba2" name="op_opciones" type="radio" value="p" onclick="setfocus(this.form.search)"/><label for="rad_ba2">&nbsp;&nbsp;Precio&nbsp;&nbsp;</label>

                                        <input id="rad_ba3" name="op_opciones" type="radio" value="c" onclick="setfocus(this.form.search)"/><label for="rad_ba3">&nbsp;&nbsp;#Personas&nbsp;&nbsp;</label>

                                        <input id="rad_ba4" name="op_opciones" type="radio" value="t" onclick="setfocus(this.form.search)"/><label for="rad_ba4">&nbsp;&nbsp;Tipo&nbsp;&nbsp;</label>

                                        <div class="col-xs-3 col-sm-3" style="margin-left: 0px;  padding-left: 0px;" >
                                            <select id="Hab_Estado" name="Hab_Estado" class="form-control input-xs" onchange="buscarHabitacion('')">
                                                <option value = "T" >Todos</option>
                                                <option value = "H" selected>Habilitado</option>
                                                <option value = "I" >Inhabilitada</option>
                                                <option value = "M" >Mantenimiento</option>
                                                <option value = "O" >Ocupada</option>
                                            </select>
                                        </div>

                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label label-xs">B&uacute;squeda:</label>
                                    <div class="col-sm-10">
                                        <div class="col-xs-10 col-sm-6 input-group">
                                            <input type="text" id="search" name="search" class="form-control input-xs" placeholder="Ingrese &iacute;ndice de b&uacute;squeda" autofocus="" onkeyup="buscarHabitacion(this.value)">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                  </div>
                </div>               

                  <div class="col-xs-12" >
                    <div class="table-responsive">
                      <table id="tableResult" class="table table-hover table-fixed table-bordered small"><?php include("../LOGICA/log_con_habitacion.php") ?></table>
                    </div>
                    <div>
                        <button class="btn btn-xs btn-success"> <a href="../REPORTES/rep_habitaciones.php" target="_blank"> <span class="glyphicon glyphicon-print"></span> Reporte</a></button>
                    </div>
                  </div>

              </div>


            </div>
        </div>


        <script>              
            function buscarHabitacion(datoBusqueda){
                var xhttp = new XMLHttpRequest();  
                var ele = document.getElementsByName('op_opciones');
                var opcion = ''; 
                var estado = document.getElementById("Hab_Estado").value;

                for(i = 0; i < ele.length; i++) { 
                    if(ele[i].checked) {
                      opcion = ele[i].value; 
                    }   
                } 

                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status ==200) 
                  {
                    document.getElementById('tableResult').innerHTML = this.responseText;
                  }
                };
                xhttp.open("GET", "../LOGICA/log_con_habitacion.php?q="+datoBusqueda+"&o="+opcion+"&e="+estado, true);
                xhttp.send();
            }

            function anularHabitacion(codigo){
                var xhttp = new XMLHttpRequest();  
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status ==200) 
                  {
                    buscarHabitacion(document.getElementById('search').value);
                  }
                };
                xhttp.open("GET", "../LOGICA/log_anu_habitacion.php?c="+codigo, true);
                xhttp.send();
            }
        </script>

    </BODY>
</HTML>

