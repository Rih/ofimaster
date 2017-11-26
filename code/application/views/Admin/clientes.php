
<?php
	$usr = $this->session->userdata('login_type');
	$uriadd = "?".$usr."/".$page_name."/add";

?>
<script type="text/javascript">
	<?= 'title_add = "'.$modal_title_add.'";' ?>
	<?= 'title_text_add = "'.$modal_title_text_add.'";' ?>
	<?= 'title_upd = "'.$modal_title_upd.'";' ?>;
	<?= 'title_text_upd = "'.$modal_title_text_upd.'";' ?>
	<?= 'nameform = "tablename_cu";' ?>

</script>
 <script type="text/javascript">
 	<?= 'usr = "'.$usr.'";' ?>
	<?= 'page_name = "'.$page_name.'";' ?>
	<?= 'base_url = "'.base_url().'";' ?>
</script>
<script type="text/javascript">
	//debe ser generado por vista!!
 	function llenarTabla(tabla){

		tabla.forEach( function(currVal, index, arr) {
			console.log(currVal);
			console.log(index);
			console.log(arr);
			var idrow = currVal.idaccount;
			var usernamerow = currVal.username;
			var usertyperow = currVal.usertype;
			var enabledrow = currVal.enabled;
			var namelegalreprow = currVal.name_legal_rep;
			var rutlegalreprow = currVal.RUT_legal_rep;
			var positionrow = currVal.position;
			//var contactmailrow = currVal.contact_mail;
			var businessnamerow = currVal.business_name;
			var companynamerow = currVal.company_name;
			var rutrow = currVal.RUT;
			var contactphonerow = currVal.contact_phone;
			var citystaterow = currVal.city_state;



			var uriupd = base_url + "?" + usr + "/" + page_name + "/upd/" +idrow + "/commit";
			var uridel = base_url + "?" + usr + "/" + page_name + "/del/" +idrow;
			var urihab = base_url + "?" + usr + "/" + page_name + "/hab/" +idrow;

			var html = '<tr>';
			html 	+= '<div class="container">';
			html 	+='<td>'+(1+index)+'</td>';
			html 	+='<td style="text-transform: lowercase">'+usernamerow+'</td>';
			//var html_user = (usertyperow==1)?'Empresa':'Administrador';
			//html 	+='<td>' + html_user + '</td>';
			html 	+='<td>'+namelegalreprow+'</td>';
			html 	+='<td>'+rutlegalreprow+'</td>';
			html 	+='<td>'+positionrow+'</td>';

			html 	+='<td>'+businessnamerow+'</td>';
			html 	+='<td>'+companynamerow+'</td>';
			html 	+='<td>'+rutrow+'</td>';
			html 	+='<td>'+contactphonerow+'</td>';
			html 	+='<td>'+citystaterow+'</td>';

			//html 	+='<td>'+contactmailrow+'</td>';

			html 	+='</div>';
			html 	+='</tr>';
			$(document).find("table[name='tablaGRID'").find("tbody").append(html);
              //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
        });

	}

</script>
<?php if (isset($cuentas_info) && $cuentas_info != false){ ?>

 <script type="text/javascript">
 	datos_tabla = [];
   	datos_tabla = <?=json_encode($cuentas_info)?>;
   	//console.log(datos_tabla);
</script>

 <?php
 		$uriadd = "?".ADMIN."/hab_cuentas/add";
 } ?>

 			<div class="row wrapper border-bottom white-bg page-heading animated fadeInDown">
                <div class="col-lg-9">
                    <h2>Gestion Clientes</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li>
                            <a>Usuarios</a>
                        </li>
                        <li class="active">
                            <strong style="font-weight: 600; color: #dd3d1d;">Gestion Clientes</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-3">


                </div>
            </div>


            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
	                <div class="col-md-12">
	                    <div class="ibox float-e-margins">
	                        <div class="ibox-title">
		                        <h5>Tabla de Registros de Clientes</h5>
		                        <div class="ibox-tools">
		                            <a class="collapse-link">
		                                <i class="fa fa-chevron-up"></i>
		                            </a>
		                            <a class="close-link">
		                                <i class="fa fa-times"></i>
		                            </a>
		                        </div>
		                    </div>
	                        <div class="ibox-content">
								<div class="table-responsive">
                    				<table class="table table-striped table-bordered table-hover dataTables-example" name="tablaGRID">
	                                    <thead>
	                                    <tr>
	                                    	<th style="width:20px;">No.</th>
											<th>Usuario</th>
											<th>Rep. Legal</th>
											<th style="width:60px;">RUN</th>
											<th>Cargo</th>
											<th>Razon Social</th>
											<th>Nombre Fantasia</th>
											<th style="width:60px;">RUT</th>
											<th style="width:70px;">Telefono</th>
											<th>Comuna</th>
										</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	         </div>








<!--
##############################
   MODAL ALERTA ELIMINAR
##############################
-->
<div id="myModalRemove" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <strong><i class="glyphicon glyphicon-trash"></i> Eliminar un Registro:</strong></br>
                <p style="width:90%">Para eliminar el registro seleccionado, haga click en el boton Eliminar de la parte inferior de esta ventana.
                Recuerde que eliminará de manera permanente los datos guardados.</p>
            </div>

            <form class="form-horizontal" method="post"  id ="eliminarFila" action="#">
	            <div class="modal-body">
	                <div class="alert alert-danger">
	                	<p><strong><i class="fa fa-warning"></i> ¡Cuidado!</strong></br>
	                    Está apunto de Eliminar de manera permanente información, la cual podría ser de importancia para su empresa, asegúrese de verificar
	                    los datos antes eliminar un registro. Al ejecutar está acción está tomando la total responsabilidad del acto.</br></br>
					 </div>
	            </div>

	            <div class="modal-footer">
	                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
	                <button type="button" class="btn btn-default" onClick="cleanDelete()"  data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!--
##############################
   MODAL ALERTA HABILITAR
##############################
-->
<div id="myModalHabilitar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <strong><i class="glyphicon fa fa-unlock-alt"></i> Habilitar un Registro:</strong></br>
                <p style="width:90%">Para habilitar el registro seleccionado, haga click en el boton Habilitar de la parte inferior de esta ventana.
                </p>
            </div>
            <div id="info_callback" style="display:none">
	            <center>
	                <small id="text_callback" class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs" style="margin: 0px 0px 13px; width: 100%; border: 1px dashed rgb(246, 168, 33); border-radius: 2px; padding: 7px; background-color: rgba(0, 0, 0, 0.12);">
	            </small>
	            </center>
	        </div>
            <?php echo form_open($uriadd,array('id' => 'habilitarFila', 'class' =>'form-horizontal','name' => 'tablename_cu', 'onsubmit' => 'return false;'));?>
            <!-- <form class="form-horizontal" method="post"  id ="habilitarFila" action="#"> -->
	            <div class="modal-body">
	                <div class="alert alert-danger">
	                	<p><strong><i class="fa fa-unlock-alt"></i> Alerta!</strong></br>
	                    Está apunto de Habilitar una cuenta creada.
	                    Al ejecutar está acción está tomando la total responsabilidad del acto.</br></br>
					 </div>
	            </div>

	            <div class="modal-footer">
	                <input id="saveModalInput" class="btn btn-danger" value="Habilitar"><i class="glyphicon fa fa-unlock-alt"></i></input>
	                <button type="button" class="btn btn-default" onClick="cleanHabilitado()"  data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">

		//console.log(datos_tabla);
		function llenarDatos(idrow){
			limpiarDatos();
			for (var i=0;i<datos_tabla.length;i++){
	   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
	   			if(datos_tabla[i].idaccount == idrow){

	   				//var fdisp = datos_tabla[i].fecha_disponibilidad;
	   				//var fdisp = (datos_tabla[i].fecha_disponibilidad).replace(/-/g,"/");
	   				//$(document).find("[name='fecha_disponibilidad']").val(fdisp);
	   				//$(document).find("[name='detalles']").val(datos_tabla[i].detalle);
	   				//$("#idcamion").find("option[cod='"+datos_tabla[i].patente+"']").prop("selected", true);
	   				$("#username").val(datos_tabla[i].username);
	   				//$("#tipo").find("option[value='"+datos_tabla[i].usertype+"']").prop("selected", true);

	   			}
	   		}

		}
		function limpiarDatos(){
			//$(document).find("[name='fecha_disponibilidad']").val("");
			//$(document).find("[name='detalles']").val("");
			$("#username").val("");
			$("#tipo").find("option[value='-1']").prop("selected", true);


		}
		function deleteRow(url){
			$("#eliminarFila").attr("action",url);
		}
		function cleanDelete(){
			$("#eliminarFila").attr("action","#");
		}

		function habilitar(url){
			$("#habilitarFila").attr("action",url);
		}

		function cleanHabilitado(){
			$("#habilitarFila").attr("action","#");
		}

	</script>
