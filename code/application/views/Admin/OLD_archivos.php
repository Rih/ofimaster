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
				var idrow = currVal.idcatalog;
				var titlerow = currVal.title;
				var descriptionrow = currVal.description;
				var catenamerow = currVal.name;
				var sizerow = currVal.size;

				var idcategory = currVal.idcategory;
				var uriupd = base_url  + "?" + usr +"/" +page_name 	+"/upload/"	+idrow;
				var uridel = base_url  + "?" + usr +"/"	+page_name 	+"/del/"	+idrow;
				var uridownload_pdf = base_url +"?"+ usr +"/download/"+ idcategory+"/"+ idrow+"/pdf";
				var uridownload_rar = base_url +"?"+ usr +"/download/"+ idcategory+"/"+ idrow+"/rar";
				var html = '<tr>';
				html 	+= '<div class="container">';
				html 	+='<td>'+(1+index)+'</td>';
				html 	+='<td>'+titlerow+'</td>';
//				html 	+='<td>'+descriptionrow+'</td>';
				html 	+='<td>'+catenamerow+'</td>';
				html 	+='<td>'+sizerow+'  bytes</td>';


				html 	+='<td>';
				
				html_select = '<select class="form-control download-select" id="download" onchange="download_file(this.value)" name="download" data-parsley-required="true">';
				html_select += '<option value="-1">Seleccione</option>';
						html_select +='<option value="'+uridownload_pdf+'">Descargar en .PDF</option>';
						html_select +='<option value="'+uridownload_rar+'">Descargar en .RAR</option>';
				html_select +='</select>';
				
				uridownload_pdf = base_url + "uploads/"+catenamerow+".pdf";
				uridownload_rar = base_url + "uploads/"+catenamerow+".rar";
				html_div = '<div class="btn-group" style="margin:10px 0; width: 100%;">';
				html_div += '		<button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle btn-download" aria-expanded="false"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i> Descargar <span class="caret"></span></button>';
				html_div += '		<ul class="dropdown-menu">';
				html_div += '				<li><a href="'+uridownload_pdf+'" download="'+catenamerow+'.pdf" download>Descargar en .PDF</a></li>';
				html_div += '				<li><a href="'+uridownload_rar+'" download="'+catenamerow+'.rar" download>Descargar en .RAR</a></li>';
				html_div += '		</ul>';
				html_div += '</div>';
				html += html_div;
				//html += html_select;
				//html 	+='<a href="'+uridownload+'" class="btn btn-w-md btn-default" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Descargar</a>';
				html 	+='</td>';

				title_upd = title_upd.replace(/\s/g,"_");
				title_text_upd = title_text_upd.replace(/\s/g,"_");
				html 	+='<td>';
				html 	+='<div class="col-md-6">';
				html 	+='<button onClick=modalChangeFile(0,"'+ uriupd+'","'+nameform+'","'+title_upd+'","'+title_text_upd+'",' +idrow+',1) class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Editar</button>';
				html    +='</div>';
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

	 <script type="text/javascript">
	 	datos_tabla = [];
		<?php if (isset($result) && $result != false){ ?>
		   	datos_tabla = <?=json_encode($result)?>;
	 	<?php } ?>
	</script>



	<script type='text/javascript'>
		function showFileSize() {
		    var input, file;

		    // (Can't use `typeof FileReader === "function"` because apparently
		    // it comes back as "object" on some browsers. So just see if it's there
		    // at all.)
		    if (!window.FileReader) {
		        $("#msg_files").text("La API File no es soportada en este navegador aún.");
		        return;
		    }

		    input = document.getElementById('userfile');
		    if (!input) {
		        $("#msg_files").text("Um, no se puede encontrar el archivo.");
		    }
		    else if (!input.files) {
		        $("#msg_files").text("Este navegador al parecer no soporta la propiedad Files.");
		    }
		    else if (!input.files[0]) {
		        $("#msg_files").text("Favor, seleccione un archivo antes de cargar");
		    }
		    else {
		        file = input.files[0];
		        var size = Math.round((file.size/(1024*1024))*10)/10;
		        $("#msg_files").text("Tamaño" + " " + size + " MB de 150MB ");
		        $("#size_catalog").text(file.size);
		        $("#size_catalog").val(file.size);
		        if(size > 150){
		           	alert("Size exceded");
		        }
		    }
		}

		function guardar(idShow,text_callback){

			var productos = JSON.stringify(products);
			console.log(productos);
			$("#all_products").val(productos);
			$("#all_products").text(productos);
			var size = Math.round(($("#size_catalog").val()/(1024*1024))*10)/10;
			if( size < 150 ){
				//$("#uploadFile").prop("onsubmit",true);
				//$("#uploadFile").submit();
				return true;
			}else{
				$(idShow).show();
                $(text_callback).text("Tamaño excede el limite permitido.");
                $(idShow).hide(2000);
				return false;
				//$("#uploadFile").prop("onsubmit",false);
			}

		}
	</script>

			<div class="row wrapper border-bottom white-bg page-heading animated fadeInDown">
                <div class="col-lg-9">
                    <h2>Gestión de Archivos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li>
                            <a>Digitales</a>
                        </li>
                        <li class="active">
                            <strong style="font-weight: 600; color: #dd3d1d;">Gestión de Archivos</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-3">
                	<?php
						include 'modal_upper.php';
						//if($option == "show"){
						include 'archivo_modal.php';
						//}
						include 'modal_lower.php';
					?>
                	<button onClick=modalChangeFile(0,'<?php echo site_url().$uriadd ?>',nameform,title_add,title_text_add) class="btn btn-primary dim btn-large-dim" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-plus" aria-hidden="true"></i> Crear Registro
					</button>
                </div>
            </div>

			<?php if(isset($success)) echo 'alert($success);'; ?>

            <div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
		            <div class="col-md-12">
		                <div class="ibox float-e-margins">
	                        <div class="ibox-title">
		                        <h5>Tabla de Registros de Usuarios</h5>
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
												<th style="width: 260px;">Titulo</th>
												<th style="width: 130px;">Categoria</th>
												<th style="width: 90px;">Tamaño</th>
												<th style="width: 115px;">Descarga</th>
												<th style="width: 300px;">Opciones</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
							</div>


						</div>
					</div>
				</div><!-- /class="row" -->
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

	console.log(datos_tabla);


	function llenarDatos(idrow){
		limpiarDatos();
		for (var i=0;i<datos_tabla.length;i++){
   			if(datos_tabla[i].idcatalog == idrow){

   				$("#title").val(datos_tabla[i].title);
   				$("#category").find("option[value='"+datos_tabla[i].idcategory+"']").prop("selected", true);
   				$("#description").val(datos_tabla[i].description);

   			}
   		}

	}
	function limpiarDatos(){
		$("#title").val("");
		$("#description").val("");
		$("#category").find("option[value='-1']").prop("selected", true);
		$("#size_catalog").val("");
		$("#all_products").val("");
		$("#userfile").val("");
	}
	function deleteRow(url){
		$("#eliminarFila").attr("action",url);
	}
	function cleanDelete(){
		$("#eliminarFila").attr("action","#");
	}

	</script>



    <?php $usr = $this->session->userdata('login_type'); ?>
    <script type="text/javascript">

        <?php echo 'usertype = "'.$usr.'";'; ?>
        function saveDataFile(mode, name, uri, classnamevalidation, idclass){//mode = 1 add , 0 upd

            var text_callback = "#text_callback";
            var idShow = "#info_callback";

            var datos = $(document).find("form[name='"+name+"']").serialize();
            var formData = new FormData(document.getElementById("uploadFile"));
            //formData.append("datos",datos);
            //formData.append("file",$("#userfile")[0].files[0]);
            console.log(formData);

            if(validateFields(classnamevalidation, idclass) && guardar(idShow,text_callback)){
	            	$("#loader").show();
	                $.ajax({
	                    url: uri,                  //the script to call to get data
	                    data: formData,                        //you can insert url argumnets here to pass to api.php
	                                                   //for example "id=5&parent=6"
	                    method:"POST",
	                    dataType: 'json',                //data format
	                    cache: false,
	                    processData: false,
	                    contentType: false,
	                    success: function(data)          //on recieve of reply
	                    {

	                    //--------------------------------------------------------------------
	                    // 3) Update html content
	                    //--------------------------------------------------------------------
	                        $(idShow).show();
	                        $(text_callback).text(data.msg);
	                        console.log(data);
	                        //console.log(data);
	                        if(mode){  clearFields();// limpia grilla si esta agregando
	                        }
	                        $(document).find("table[name='tablaGRID']").find("tbody").children().remove();
	                        datos_tabla = data.tabla;
	                        llenarTabla(data.tabla); //llena grilla
	                        //$(document).find("input[name='distancia']").val(data);
	                        $(".clear").first().focus();
	                        $(idShow).hide(2000);
	                    	$("#loader").hide();
	                    },
	                    error: function(jqXHR, textStatus, errorThrown)
							        {
							            // Handle errors here
							            console.log('ERRORS: ' + textStatus +" errthrown: "+ errorThrown);
							            $(idShow).show();
				                  $(text_callback).text(textStatus);
													$("#loader").hide();
				                  $(idShow).hide(4000);
							        },
							        complete: function()
							        {
							            // STOP LOADING SPINNER

							        },
				              fail:function(data)
											{
				                    $(idShow).show();
				                    $(text_callback).text(data.msg);
														$(idShow).hide(8000);
				              }
                });
            }else{
                $(idShow).show();
                $(text_callback).text("Llene los campos solicitados");
                $(idShow).hide(2000);
            }
        }


        function modalChangeFile(mode, url, nameform, data_title, data_text, idrow, idclass)
        { // mode = upd: 0, add: 1, del:-1
            var form = $(document).find("form[name='"+nameform+"']");
            data_title = data_title.replace(/\_/g," ");
            data_text = data_text.replace(/\_/g," ");
            $("#modal_text").text(data_text);
            $("#modal_title").text(data_title);
            form.attr("action",url);
            //alert("doc: "+document.chofer_cu.action);
            var idShow = "#info_callback";
            $(idShow).hide();
            limpiarDatos();
            if( idrow > 0 ) llenarDatos(idrow);

            $("#saveModalInputFiles").attr("onclick","saveDataFile("+mode+",'"+nameform+"','"+url+"','validation',"+idclass+")");
        }
				function download_file(url){
					if(url != -1)
					{
						window.location.href = url;
					}

				}
    </script>
