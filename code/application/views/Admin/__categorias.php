

<?php if (isset($result) && $result != false){ ?>
				
 <script type="text/javascript">
 	datos_tabla = [];
   	datos_tabla = <?=json_encode($result)?>;

</script>

 <?php } ?>



<div class="main-container">
	
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?User/dashboard'); ?>"> DASHBOARD</a></li>
			<li>CATEGORIAS</li>	 
			
			<?php
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/".$page_name."/add";
			?>
			<li style="float:right;"><a href="<?php echo site_url($uriadd);?>"><i class="fa fa-plus"></i></a></li>
		</ul>
		<div id="output">
			<script type="text/javascript">
				title_add = '<?php echo $modal_title_add; ?>';
				title_text_add = '<?php echo $modal_title_text_add; ?>';
				title_upd = '<?php echo $modal_title_upd; ?>';
				title_text_upd = '<?php echo $modal_title_text_upd; ?>';
				nameform = 'tablename_cu';
				nameform2 = 'otrotablename_cu';
			</script>
			
			<button
			onClick=modalChange('<?php echo site_url().$uriadd ?>',nameform,title_add,title_text_add)  
			class="btn btn-default btn-sm destacado-btn" 
			style="margin-top:5px;" data-toggle="modal" data-target="#myModal">
			Agregar Categoria</button>
			
			 
			
			<?php 
			include 'modal_upper.php'; 
			//if($option == "show"){
			include 'categoria_modal.php'; 	
			//}
			include 'modal_lower.php'; 
			?>

			
			

		</div>
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="tableExample3">
							<!--
							<table class="table table-striped table-hover" id="dataTable1">
							-->
								<thead>
									<tr>
										<th style="width:5%; font-size: 12.5px;">No.</th>									
										<th style="font-size: 12.5px;">Familia</th>
										<th style="font-size: 12.5px;">Categoria</th>
										<th style="font-size: 12.5px;">Opciones</th>				
									</tr>
								</thead>
								<tbody>
									<?php

										if(isset($result) && $result != false){		
											$cont = 1;
											foreach($result as $s => $v){							
												
												$id = $v["idcategory"];
												$uriupd = "?".$usr."/".$page_name."/upd/".$id;
												$uridel = "?".$usr."/".$page_name."/del/".$id;
												$uridist = "?".$usr."/".$page_name."/dist/".$id;
												
												echo '<tr>';
												echo '<div class="container">';
												echo  '<td>'.($cont++).'</td>';
												echo  '<td>'.$v["family_name"].'</td>';							
												echo  '<td>'.$v["category_name"].'</td>';							
											
												echo  '<td>';
																										
												echo '<div class="col-md-6">';
												echo '<button onClick=modalChange("'.$uriupd.'",nameform,title_upd,title_text_upd,'.$id.') class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Editar</button>';
												echo '</div>';					
											
												echo '<div class="col-md-6">';
												echo '<a type="button" href="#" onClick=deleteRow("'.$uridel.'")  data-toggle="modal" data-target="#myModalRemove" class="btn btn-danger inline-block" style="width:100%"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
												echo '</div>';						
																						
													
												echo '</td>';
												echo '</div>';
												echo '</tr>';
												
											}

	
								echo '</tbody>';
								echo '</table>';
								echo '</div>';
								echo '</div>';

							}else{
								//echo '<tr>';	
								//echo '<td colspan="100%">';
								echo '<div class="alert alert-danger" style="border: 1px dashed rgb(255, 151, 151);"><strong><i class="fa fa-warning"></i> ¡Lo sentimos! </strong>'.INFO_NO_DATA.'<br><br>
								<a href="'.site_url($urioffer).'" class="btn btn-w-md btn-default" style="font-weight: bold; width: 100%; border: 1px solid rgb(171, 61, 56) !important; color: rgb(255, 255, 255) !important; background: rgb(189, 68, 62) none repeat scroll 0% 0%;">Ofrecer Camión</a></div>';
								
							}

							?>
						

				</div>
			</div>
		</div><!-- /class="row" -->
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
		
	</div><!-- ./padding-md -->
	
	

</div><!-- /main-container -->




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


<script type="text/javascript">
		
	console.log(datos_tabla);
	 function llenarCiudades(url, nameform, data_title, data_text, idrow){
       
        var form = $(document).find("form[name='"+nameform+"']");
        $("#modal_text2").text(data_text);
        $("#modal_title2").text(data_title);
        form.attr("action",url);
        //alert("doc: "+document.chofer_cu.action);
        if( idrow > 0 ) llenarDatos(idrow);
        if (idrow == '0') limpiarDatos();

        $.ajax({                                      
          url: window.location.pathname+'?Admin/fetch_otras_ciudades/'+idrow,                  //the script to call to get data          
          data: "",                        //you can insert url argumnets here to pass to api.php
                                           //for example "id=5&parent=6"
          dataType: 'json',                //data format      
          success: function(resp)          //on recieve of reply
          {
            
            //--------------------------------------------------------------------
            // 3) Update html content
            //--------------------------------------------------------------------
               console.log(resp);              
               
               if (resp.total > 0){
               		var datos = resp.data;
               		var nombreCity = '';
               		for(var j=0;j<datos_tabla.length && nombreCity=='';j++){
               			if(datos_tabla[j].idciudad == idrow) nombreCity = datos_tabla[j].nombre;
               		}
               		
               		$("#nombre2").val(nombreCity);               		
               		$("#idciudad2").empty();
               	
               		$("#idciudad2").append("<option value='-1' cod='-1'>Seleccione Ciudad </option> ");
               		for(var i=0;i<datos.length;i++){
               			var idcity = datos[i].idciudad;
               			var nombre = datos[i].nombre;
               			$("#idciudad2").append("<option value='"+idcity+"' cod='"+idcity+"'> " + nombre + " </option> ");               			
               			//alert(idcity + " -- " + nombre);
               		}
               }else{
               		alert("No tiene ninguna accion pendiente aqui ..");
               }
              
            //recommend reading up on jquery selectors they are awesome 
            // http://api.jquery.com/category/selectors/
          } 
        });
    }

	function llenarDatos(idrow){
		limpiarDatos();
		for (var i=0;i<datos_tabla.length;i++){
   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
   			if(datos_tabla[i].idcategory == idrow){   				
   				   				
   				$("#name").val(datos_tabla[i].name);   				   				
   				$("#family").find("option[value='"+datos_tabla[i].idfamily_fk+"']").prop("selected", true);   
   				
   			}
   		}
		
	}
	function limpiarDatos(){
		$("#name").val("");		
		$("#family").find("option[value='-1']").prop("selected", true);   
			
	}
	function deleteRow(url){
		$("#eliminarFila").attr("action",url);
	}
	function cleanDelete(){
		$("#eliminarFila").attr("action","#");	
	}
			   
</script>
