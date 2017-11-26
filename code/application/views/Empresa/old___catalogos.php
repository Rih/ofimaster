
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
					function download(value){
						if(value != "-1"){
							$("#downloadFile").prop("onsubmit",true);
							$("#downloadFile").submit();
						}
						else{
							$("#downloadFile").prop("onsubmit",false);
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
							include 'archivo_modal.php';
							//}
							include 'modal_lower.php';
						?>
                    </div>
                </div>


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
                        <p style="margin-bottom: 25px;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
                        </p>



                    </div>
                </div>
            </div>

				<div class="row">
					<?= form_open("?".$usr."/download_name", array("id"=> "downloadFile","onsubmit" => "return false;")); ?>

						<div class="col-md-4 col-xs-4 text-center">
                            <select class="form-control" name="family_name" onchange="catalogo_familia(this.value,'categoria');" data-parsley-required="true" onchange ="changeFilter(this.value)">
                            <option value="-1">Elija Familia</option>
                            <?php
                                if(isset($familias)){
                                     foreach($familias as $s => $v):
                                        echo '<option value="'.$v["idfamily"].'"';
                                        echo '>';
                                        echo $v["name"];
                                        echo '</option>';

                                    endforeach;
                                }
                            ?>
                            </select>
                        </div>

                        <div class="col-md-4 col-xs-4 text-center">
                            <select class="form-control" name="name" id="categoria" disabled onchange="download(this.value);" data-parsley-required="true" onchange ="changeFilter(this.value)">
                            <option value="-1" cod="-1">Elija Categoria</option>
                            <?php
                                if(isset($categorias)){
                                     foreach($categorias as $s => $v):
                                        echo '<option value="'.$v["name"].'" cod="'.$v["idfamily_fk"].'"';
                                        echo '>';
                                        echo $v["name"];
                                        echo '</option>';

                                    endforeach;
                                }
                            ?>
                            </select>
                        </div>


                     <?= form_close(); ?>
				</div>


				<?php if(isset($success)) echo 'alert($success);'; ?>

				<?php


					if(isset($result) && $result != false){
						$num = 0;
						echo '<div class="row">';
						foreach($result as $s => $v){
						$id = $v["idcatalog"];
						$idcategory = $v["idcategory"];
						$idfamily = "";
						$urlimg = '\''.base_url().'template/images/generaPDF.png\'';
						
						foreach($categorias as $ss => $vv){
							if($vv["idcategory"] == $idcategory) $idfamily = $vv["idfamily_fk"];
						}
						$uridownload = "?".$usr."/download/".$idcategory."/".$id;

						if ($num % 4 == 0 && $num > 0){ echo '</div><div class="row">';  }

						echo '<a href="'.$uridownload.'" class="catalogo" cod="'.$idfamily.'" >';
						//echo '<img src="'.base_url().'template/images/generaPDF.png" class="img-thumbnail" alt=" plantilla PDF" />'
						echo '<div class="col-lg-2 col-xs-3">';
	                        echo '<div class="panel panel-filled" style="background: url('.$urlimg.') no-repeat center;background-size: cover; opacity:0.5;">';
	                            echo '<div class="panel-body">';
	                                echo '<h2 class="m-b-none">';
	                                    echo '<span class="pe-7s-users"></span>  <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span>';
	                                echo '</h2>';
	                                echo '<h6>'.$v["name"].'</h6>';
	                                echo '<div class="small mrgn-tp1">'.$v["title"].'</div>';
	                                echo '<div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Tamaño: <span class="c-white">'.$v["size"].' bytes</span>  </div>';
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                    echo '</a>';
		                $num++;
		                }

		                echo '</div>';
		            }


				?>

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
												<th style="font-size: 12.5px;">Titulo</th>
												<th style="font-size: 12.5px;">Descripcion</th>
												<th style="font-size: 12.5px;">Categoria</th>
												<th style="font-size: 12.5px;">Tamaño</th>
												<th style="font-size: 12.5px;">Opciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if(isset($result) && $result != false){
												$num = 1;
												foreach($result as $s => $v){

												$id = $v["idcatalog"];
												$idcategory = $v["idcategory"];
												$uridownload = "?".$usr."/download/".$idcategory."/".$id;
												echo '<tr>';
												echo '<div class="container">';
												echo  '<td>'.($num++).'</td>';


												echo  '<td>';
												echo $v["title"];
												echo '</td>';


												echo  '<td>';
												echo $v["description"];
												echo '</td>';

												echo  '<td>';
												echo $v["name"];
												echo '</td>';


												echo  '<td>';
												echo $v["size"]. ' bytes';
												echo '</td>';

												echo  '<td>';

												echo '<div class="col-md-6">';
												echo '<a href="'.site_url($uridownload).'" class="btn btn-w-md btn-default" style="width:100%"><i class="fa fa-file-text-o" aria-hidden="true"></i> Descargar</a>';
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


    function hideAll(){
        $("#categoria").find("option").each(function(){ $(this).hide(); });
        $("#categoria").find("option[cod='-1']").show();
    }


    $(function(){
        hideAll();
    });

	function catalogo_familia(value, categoria)
        {

            $("#" + categoria).prop("disabled",false);
            if(value.toString()  == "-1"){
                $("#" + categoria).prop("disabled",true);
                $("#" + categoria).find("option").each(function(){
                    $(this).hide();
                });
                $(".catalogo").each(function(){
                	$(this).show();
                });
                //

            }else{

                $("#" + categoria).find("option").each(function(){
                    $(this).hide();
                });

                $("#" + categoria).find("option[cod='"+value+"']").each(function(){
                    $(this).show();
                });

             	$(".catalogo").each(function(){
                	$(this).hide();
                });
             	$(document).find("a[cod='"+value+"']").show();
            }
            $("#" + categoria).find("option[value='-1']").show();
            $("#"+categoria).find("option[value='-1']").prop('selected',true);


        }

	</script>
