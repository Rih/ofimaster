<?php
	$usr = $this->session->userdata('login_type');
	$uriadd = "?".$usr."/".$page_name."/add";

?>
<script type="text/javascript">
	<?= 'title_add = "'.$modal_title_add.'";' ?>;
	<?= 'title_text_add = "'.$modal_title_text_add.'";' ?>;
	<?= 'title_upd = "'.$modal_title_upd.'";' ?>;
	<?= 'title_text_upd = "'.$modal_title_text_upd.'";' ?>;
	<?= 'nameform = "tablename_cu";' ?>;
	<?= 'nameform2 = "otrotablename_cu";' ?>;

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
			var idrow = currVal.idfamily;
			var namerow = currVal.name;
			var uriupd = base_url  + "?" + usr +"/" +page_name 	+"/upd/"	+idrow;
			var uridel = base_url  + "?" + usr +"/"	+page_name 	+"/del/"	+idrow;
			var uridist = base_url + "?" + usr +"/"	+page_name 	+"/dist/"	+idrow;
			var html = '<tr>';
			html 	+= '<div class="container">';
			html 	+='<td>'+(1+index)+'</td>';
			html 	+='<td>'+namerow+'</td>';

			html 	+='<td>';

			title_upd = title_upd.replace(/\s/g,"_");
			title_text_upd = title_text_upd.replace(/\s/g,"_");
			html 	+='<div class="col-md-6">';
			html 	+='<button onClick=modalChange(0,\''+ uriupd+'\',\''+nameform+'\',\''+title_upd+'\',\''+title_text_upd+'\',' +idrow+',0) class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Editar</button>';
			html +='</div>';
			html 	+='<div class="col-md-6">';
			html 	+='<a type="button" href="#" onClick=deleteRow("'+uridel+'")  data-toggle="modal" data-target="#myModalRemove" class="btn btn-danger inline-block" style="width:100%"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
			html 	+='</div>';

			html 	+='</td>';
			html 	+='</div>';
			html 	+='</tr>';
			$(document).find("table[name='tablaGRID'").find("tbody").append(html);
              //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
        });

	}

</script>

<?php if (isset($result) && $result != false){ ?>
<script type="text/javascript">
	datos_tabla = [];
   	datos_tabla = <?=json_encode($result)?>;
</script>
 <?php } ?>

 			<div class="row wrapper border-bottom white-bg page-heading animated fadeInDown">
                <div class="col-lg-9">
                    <h2>Gestión de Familias</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li>
                            <a>Digitales</a>
                        </li>
                        <li class="active">
                            <strong style="font-weight: 600; color: #dd3d1d;">Gestión de Familias</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-3">
                	<?php
						include 'modal_upper.php';

						include 'familia_modal.php';

						include 'modal_lower.php';
					?>
                	<button onClick=modalChange(1,'<?php echo site_url().$uriadd ?>',nameform,title_add,title_text_add,0,0) class="btn btn-primary dim btn-large-dim" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-plus" aria-hidden="true"></i> Crear Familia
					</button>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
	                <div class="col-md-12">
	                    <div class="ibox float-e-margins">
	                        <div class="ibox-title">
		                        <h5>Tabla de Registros de Familias</h5>
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
												<th style="width:5%;">No.</th>
												<th>Nombre</th>
												<th style="width:300px;">Opciones</th>
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
                <p style="width:90%">
                	Para eliminar de forma permanente los datos del registro seleccionado, haga click en el boton Eliminar de la parte inferior de esta ventana.
                </p>
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
	                <button type="button" class="btn btn-default btn-cancelar" onClick="cleanDelete()"  data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
	                <button type="submit" class="btn btn-accent"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<script type="text/javascript">


	function llenarDatos(idrow){
		limpiarDatos();
		for (var i=0;i<datos_tabla.length;i++){
   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
   			if(datos_tabla[i].idfamily == idrow){

   				$("#name").val(datos_tabla[i].name);
   				//$("#region").find("option[value='"+datos_tabla[i].idregion_fk+"']").prop("selected", true);

   			}
   		}

	}

	function limpiarDatos(){
		$("#name").val("");

	}
	function deleteRow(url){
		$("#eliminarFila").attr("action",url);
	}
	function cleanDelete(){
		$("#eliminarFila").attr("action","#");
	}


</script>
