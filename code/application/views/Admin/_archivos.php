				
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
					        $("#msg_files").text("Tamaño" + " " + size + " MB de 10MB ");
					        $("#size_catalog").text(file.size);
					        $("#size_catalog").val(file.size);
					        if(size > 10){
					           	alert("Size exceded");
					        }
					    }
					}

					function guardar(){

						var productos = JSON.stringify(products);
						console.log(productos);
						$("#all_products").val(productos);
						$("#all_products").text(productos);
						var size = Math.round(($("#size_catalog").val()/(1024*1024))*10)/10;
						if( size < 10 ){
							$("#uploadFile").prop("onsubmit",true);
							$("#uploadFile").submit();	
						}else{
							$("#uploadFile").prop("onsubmit",false);
						}
						
					}
					</script>

				<?php
					$usr = $this->session->userdata('login_type');					
					$uri1 = "?".$usr."/buscarcarga/search/";
					$urioffer = "?".$usr."/ofrecercamion/";
					
				?>

				

				<div class="row">
                    <div class="col-lg-10">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="fa fa-cube" aria-hidden="true"></i>
                            </div>
                            <div class="header-title">
                                <h3 class="m-b-xs">Gestion Archivos</h3>
                                <small>Busca cargas disponibles en tiempo real.</small>
                            </div>
                        </div>
                         <script type="text/javascript">
	                    	
							title_add = '<?php echo $modal_title_add; ?>';
							title_text_add = '<?php echo $modal_title_text_add; ?>';
							title_upd = '<?php echo $modal_title_upd; ?>';
							title_text_upd = '<?php echo $modal_title_text_upd; ?>';
							nameform = 'masdetalle_cu';
							idr = 0;
						</script>
				
														
						<?php 
							include 'modal_upper.php'; 
							//if($option == "show"){
							include 'masdetalle_buscarcarga_modal.php'; 	
							//}
							include 'modal_lower.php'; 
						?>
                    </div>
                </div>


			




			<?php echo form_open('?Admin/download', array("id" => "downloadFile"));?>

			<input type="text" name="path" id="path" size="30"  />						

			<input type="submit" value="download" />
			<?= form_close(); ?>


			
				<?php if(isset($success)) echo 'alert($success);'; ?>

                <?php echo form_open_multipart('?Admin/archivos/upload', array("id" => "uploadFile","onsubmit" => "return false;")); ?>
                <div class="row">
	                <div class="col-md-12">
	                    <div class="panel panel-filled">
	                    	<div class="panel-heading">
	                            <div class="panel-tools">
	                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
	                                <a class="panel-close"><i class="fa fa-times"></i></a>
	                            </div>
	                            Gestion de Archivos
	                        </div>
	                        <script src="<?php echo base_url();?>template/js/angular.min.js"></script>
							<script src="<?php echo base_url();?>template/js/app.js"></script>

	                        <div class="panel-body"  ng-app="app">
	                        	<div class="row" ng-init="dato = 1">
	                        		
	                        		<div class="col-md-12 col-xs-12">
			                            <p style="margin-bottom: 25px;">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
										</p>
									</div>

	                        	</div>
	                        	<div class="col-md-6 col-xs-6 text-center" >

		                        	<div class="row">
		                            			                            	
		                                <div class="col-md-5 col-xs-6 text-center">
		                                <label for="exampleInputEmail1">Titulo</label>
										<input name="title" data-parsley-required="true" 										
											class="form-control validation" placeholder="Titulo..." type="text">
		                                </div>
		                                <div class="col-md-5 col-xs-6 text-center">
		                                <label for="exampleInputEmail1">Categoria</label>
		                                <select class="form-control" name="category" data-parsley-required="true" onchange ="changeFilter(this.value)">   
										<option value="-1">Elija Categoria</option>
										<?php
							                if(isset($categorias)){
							                     foreach($categorias as $s => $v):                      
							                        echo '<option value="'.$v["idcategory"].'"';						                        
							                        echo '>';
							                        echo $v["name"];
							                        echo '</option>';
							                    
							                    endforeach;
							                }                               
							            ?>
						    			</select>
		                                </div>


		                            </div>
		                            
		                            <div class="row">
		                            	
		                            	<?php

		                            	 echo '<div class="col-md-10 col-xs-6 text-center">';
		                               	echo '<label for="exampleInputEmail1">Descripcion</label>';
						                echo form_textarea(
											array(
												'name'        => 'description',								
												'maxlength'   => '200',
												'rows' 		  => '6',
												'cols' 		  => '50',
												'class'       => 'form-control',
												//'size'        => '35',
												'style'		  => 'resize: vertical'
											)
										);
					                
		                                echo '</div>';

		                              
		                                ?>
		                                


		                            </div>
		                             <div class="row">
		                            	<input type="text" name="size_catalog" id="size_catalog" />
		                            	<input type="text" name="all_products" id="all_products" />		                            	
		                                <div id="files" class="col-md-10 col-xs-6 text-center">
		                               	<?= $error; ?>
										<input type="file" name="userfile" id="userfile" size="30" accept="application/pdf" onchange="showFileSize();" />
										<p id="msg_files"></p>																		
		                                </div>
		                                
		                            </div>
	                            </div>

	                            
	                            <div class="col-md-6 col-xs-6 text-center" ng-controller="SetProductController as setCtrl" >                       		<div class="row">
	                        			 <div class="col-md-5 col-xs-6 text-center">
	                        			 	<label for="exampleInputEmail1">Nombre</label>
	                        			 	<input class="form-control" type="text"   ng-model="productname" placeholder="Nombre de producto...">
	                        			 </div>
	                        			<div class="col-md-5 col-xs-6 text-center">
	                        			  	<label for="exampleInputEmail1">Marca</label>
	                    		        	<input class="form-control" type="text"   ng-model="productmark" placeholder="Marca de producto...">
	                    		        	
	                    		        </div>
	    								<div class="col-md-2 col-xs-6">
    								 		<button class="btn btn-success" ng-click="addItem()"><i class="fa fa-plus" aria-hidden="true"></i></button>
    								 	</div>
    								 </div>

                        			<br><br>
                        				  
                        			<ul class="list-group">
                        			<li class="list-group-item active">      
                        			Vista previa:                		
                        				<b>Nombre:</b> {{productname }}      <b>Marca:</b> {{productmark }}
                        			</li>
                        			</ul>

                        			<br>
                        			<hr class="star">
									<br>
	                        		<ul class="list-group productos" ng-repeat="product in products">
	                        			<li class="list-group-item" value="{{product.name}}|{{product.mark}}">
	                        			<b>Nombre:</b> {{product.name }}      <b>Marca:</b> {{product.mark }} <a class="btn btn-danger" ng-click="deleteItem($index)" class="delete-item">X</a>
	                        			</li>
	                        		</ul>
	                        		                       			
                    		        
                        		</div>
	                            <div class="row text-center">
									<button onclick="guardar();" class="btn btn-w-md btn-accent" style="width: 100%;"><i class="fa fa-check" aria-hidden="true"></i> Guardar</button>
                                </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <?= form_close(); ?>

				
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
												<th style="font-size: 12.5px;">Reg. Origen</th>						
												<th style="font-size: 12.5px;">Reg. Destino</th>				
												<th style="font-size: 12.5px;">Fecha Carga</th>	
												<th style="font-size: 12.5px;">Precio</th>
												<th style="font-size: 12.5px;">Tipo Carga</th>
												<th style="width: 34px; font-size: 12.5px;">Cant.</th>
												<th style="font-size: 12.5px;">Matchs</th>	
												<th style="font-size: 12.5px;">Opciones</th>				
											</tr>
										</thead>
										<tbody>
											<?php
											if(isset($result) && $result != false){
												$num = 1;
												foreach($result as $s => $v){

											$id = $v["idofertacarga"];											
											$urirequest = "?".$usr."/resolver_solicitudes/show/oferta/0/".$v["idofertacarga"];

											echo '<tr>';
											echo '<div class="container">';					
											echo  '<td>'.($num++).'</td>';


											echo  '<td>';
											echo $v["nregion_origen"];
											echo '</td>';

											
											echo  '<td>';
											echo $v["nregion_destino"];
											echo '</td>';

											
											//echo  '<td>';
											$fdisp = $v["fecha_carga"];
											echo  '<td><i class="fa fa-calendar" aria-hidden="true"></i> '.$this->Crud_model->formateaFecha($fdisp).'</td>';
											//echo $v["fecha_carga"];
											//echo  '</td>';
											
											echo  '<td style="text-align:right">';
											$nbr = number_format($v["precio"],0,",",".");
											echo '$ '.$nbr;
											echo  '</td>';
																
											echo  '<td>';
											echo $v["tipo_carga"];
											echo '</td>';
											
											echo  '<td style="text-align:right">';
											echo $v["cantidad_carga"].' [Tn]';
											echo  '</td>';

											echo  '<td>';
											echo $v["solicitudes"];
											echo  '<span class="badge-quest" style="border-radius: 30px !important; padding: 4px 7px !important;"><i class="fa fa-question" aria-hidden="true"></i></span> </td>';

											echo  '<td>';						
											echo '<div class="col-md-6">';
											
											echo '<button onClick=modalChange("",nameform,title_upd,title_text_upd,'.$id.') class="btn btn-w-md btn-default" data-toggle="modal" data-target="#myModal" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Detalles</button>';

											echo '</div>';
											if($v["solicitudes"] > 0){
												echo '<div class="col-md-6">';
												echo '<a href="'.site_url($urirequest).'" class="btn btn-w-md btn-warning" style="width:100%; color:#f7af3e;"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Solicitar</a>';
												echo '</div>';	
											
											}else{
												//
											}
																	
											//echo '<div class="col-md-6">';
											//echo '<a type="button" href=".site_url($uridel)." class="btn btn-danger inline-block" style="width:100%"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Eliminar</a>';
											//echo '</div>';	
														
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
												//echo '</td>';ref="http://www.codemakers.cl/code/?Transp
												//echo 'Por el momento no hay información según los filtros utilizados, Ingrese su camión disponible para que las empresas que buscan CAMIONES se pongan en contacto con usted';
												//require_once('ConfigApp.php');
												//print_r($noData);
												//echo '</tr>';
											}
											?>
										
				
								
								
						</div>
					</div>
				</div><!-- /class="row" -->
				
			
	
	
	<script type="text/javascript">
		
				
					console.log(datos_tabla);
					function llenarDatos(idrow){
						limpiarDatos();
						for (var i=0;i<datos_tabla.length;i++){
				   			//lert(datos_tabla[i].idchofer + " - "+datos_tabla[i].nombre + " - "+datos_tabla[i].apellido + " - "+datos_tabla[i].RUT);
				   			if(datos_tabla[i].idofertacarga == idrow){
				   				$(document).find("td[id='idofertacarga']").append(datos_tabla[i].idofertacarga+"-000-TR");
				   				var fpub = (datos_tabla[i].fecha_publicacion).replace(/-/g,"/");
				   				var fdcarga = (datos_tabla[i].fecha_carga).replace(/-/g,"/");
				   				var fdescarga = (datos_tabla[i].fecha_descarga).replace(/-/g,"/");
				   				$(document).find("td[id='fecha_publicacion']").append(fpub);
				   				$(document).find("td[id='fecha_carga']").append(fdcarga);
				   				$(document).find("td[id='fecha_descarga']").append(fdescarga);
				   				$(document).find("td[id='nciudad_origen']").append(datos_tabla[i].nciudad_origen);
				   				$(document).find("td[id='origen_direccion']").append(datos_tabla[i].origen_direccion);
				   				$(document).find("td[id='nciudad_destino']").append(datos_tabla[i].nciudad_destino);
				   				$(document).find("td[id='destino_direccion']").append(datos_tabla[i].destino_direccion);
				   				$(document).find("td[id='cantidad_carga']").append(datos_tabla[i].cantidad_carga);
				   				$(document).find("td[id='tipo_carga']").append(datos_tabla[i].tipo_carga);
				   				$(document).find("td[id='precio']").append(datos_tabla[i].precio);
				   				$(document).find("td[id='detalle']").append(datos_tabla[i].detalle);
				   				$(document).find("td[id='estado']").append(datos_tabla[i].distancia);
				   				
				   				//$(document).find("[name='chofer']").find("option[value='"+datos_tabla[i].idchofer_fk+"']").prop("selected", true);
				   				
				   			}
				   		}
						
					}
					function limpiarDatos(){
						$(document).find("td[id='idofertacarga']").text("");
		   				$(document).find("td[id='fecha_publicacion']").text("");
		   				$(document).find("td[id='fecha_carga']").text("");
		   				$(document).find("td[id='fecha_descarga']").text("");
		   				$(document).find("td[id='nciudad_origen']").text("");
		   				$(document).find("td[id='nciudad_destino']").text("");
		   				$(document).find("td[id='origen_direccion']").text("");
		   				$(document).find("td[id='destino_direccion']").text("");
		   				$(document).find("td[id='cantidad_carga']").text("");
		   				$(document).find("td[id='tipo_carga']").text("");
		   				$(document).find("td[id='precio']").text("");
		   				$(document).find("td[id='detalle']").text("");
		   				$(document).find("td[id='estado']").text("");
		   				
		   				
					}
					function deleteRow(url){
						$("#eliminarFila").attr("action",url);
					}
					function cleanDelete(){
						$("#eliminarFila").attr("action","#");	
					}
				   
	</script>
	

	