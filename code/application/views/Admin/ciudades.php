<?php if (isset($ciudades) && $ciudades != false){ ?>
				
 <script type="text/javascript">
 	datos_tabla = [];
   	datos_tabla = <?=json_encode($ciudades)?>;

</script>

 <?php } ?>



<div class="main-container">
	
	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?User/dashboard'); ?>"> DASHBOARD</a></li>
			<li>CIUDADES</li>	 
			
			<?php
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/ciudades/add";
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
			Agregar Ciudad</button>
			
			 
			
			<?php 
			include 'modal_upper.php'; 
			//if($option == "show"){
			include 'ciudad_modal.php'; 	
			//}
			include 'modal_lower.php'; 
			?>

			<?php 
			include 'modal2_upper.php'; 
			//if($option == "show"){
			include 'otraciudad_modal.php'; 	
			//}
			include 'modal_lower.php'; 
			?>

			

		</div>
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
		<table class="table table-striped" id="dataTable1">
			
			<thead>
				<tr>
					<th style="width:5%">No.</th>									
					<th style="width:20%;">Nombre</th>
					<th style="width:6%;">Latitud</th>
					<th style="width:6%;">Longitud</th>					
					<th style="width:20%;">Region</th>
					<th style="width:2%;">Definir Distancias</th>
					<th style="width:10%;">Resolver</th>
					<th style="width:20%;">Opción</th>
				</tr>
			</thead>
			<tbody>
				<?php

					if(isset($ciudades) && $ciudades != false){		
						$cont = 1;
						foreach($ciudades as $s => $v){							
							
							$id = $v["idciudad"];
							$uriupd = "?".$usr."/ciudades/upd/".$id."/commit";
							$uridel = "?".$usr."/ciudades/del/".$id;
							$uridist = "?".$usr."/ciudades/dist/".$id;
							$nombreActual = $v["nombre"];
							echo '<tr>';
							echo '<div class="container">';
							echo  '<td>'.($cont++).'</td>';
							echo  '<td>'.$v["nombre"].'</td>';
							echo  '<td>'.$v["latitud"].'</td>';
							echo  '<td>'.$v["longitud"].'</td>';
							echo  '<td>'.$this->Admin_model->get_name_by_id('region',$v["idregion_fk"],'nombre').'</td>';
							echo  '<td>'.$v["resolver_distancia"].'</td>';
							echo  '<td>';
							
							if(intval($v["resolver_distancia"]) > 0){
								echo '<div class="col-md-6">';
								echo '<button onClick=llenarCiudades("'.$uridist.'",nameform2,title_upd,title_text_upd,'.$id.') class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal2" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Resolver</button>';
								echo '</div>';					
								
							}else{
								echo "<h3> Sin novedad </h3>";
							}
								
							echo '</td>';

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

					}

					
				?>
				
			</tbody>
		</table>
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
   			if(datos_tabla[i].idciudad == idrow){
   				
   				//var fdisp = datos_tabla[i].fecha_disponibilidad;
   				//var fdisp = (datos_tabla[i].fecha_disponibilidad).replace(/-/g,"/");
   				//$(document).find("[name='fecha_disponibilidad']").val(fdisp);
   				//$(document).find("[name='detalles']").val(datos_tabla[i].detalle);
   				//$("#idcamion").find("option[cod='"+datos_tabla[i].patente+"']").prop("selected", true);   	   				
   				$("#nombre").val(datos_tabla[i].nombre);   				
   				$("#latitud").val(datos_tabla[i].Latitud);
   				$("#longitud").val(datos_tabla[i].longitud);
   				$("#region").find("option[value='"+datos_tabla[i].idregion_fk+"']").prop("selected", true);   
   				
   			}
   		}
		
	}
	function limpiarDatos(){
		$("#nombre").val("");		
		$("#latitud").val("");
		$("#longitud").val("");
		$("#region").find("option[value='-1']").prop("selected", true);   
			
	}
	function deleteRow(url){
		$("#eliminarFila").attr("action",url);
	}
	function cleanDelete(){
		$("#eliminarFila").attr("action","#");	
	}
			   
</script>
