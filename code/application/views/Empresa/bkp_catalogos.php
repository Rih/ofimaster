
				 <script type="text/javascript">
				 	datos_tabla = [];
					<?php if (isset($result) && $result != false){ ?>
					   	datos_tabla = <?=json_encode($result)?>;
				 	<?php } ?>
					function llenarTabla(tabla) {}
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
				?>



			<div class="row wrapper border-bottom white-bg page-heading animated fadeInDown">
	            <div class="col-lg-9">
	                <h2>Catálogos Descargables</h2>
	                <ol class="breadcrumb">
	                    <li>
	                        <a href="#">Dashboard</a>
	                    </li>
	                    <li>
	                        <a>Productos</a>
	                    </li>
	                    <li class="active">
	                        <strong style="font-weight: 600; color: #dd3d1d;">Catálogos Descargables</strong>
	                    </li>
	                </ol>
	            </div>
	        </div>

			<div class="wrapper wrapper-content animated fadeInRight" style="padding: 20px 10px 0px !important;"><!-- wrapper-content -->
                <div class="row">
	                <div class="col-md-12">
	                    <div class="ibox float-e-margins">
	                        <div class="ibox-title">
		                        <h5>Filtros de Descarga</h5>
		                        <div class="ibox-tools">
		                            <a class="collapse-link">
		                                <i class="fa fa-chevron-up"></i>
		                            </a>
		                            <a class="close-link">
		                                <i class="fa fa-times"></i>
		                            </a>
		                        </div>
		                    </div>
		                    <div class="ibox-content"><!-- ibox-content -->
		                    	<p style="margin-bottom: 25px;">
		                    		En este apartado podrá descargar archivos digitales que Ofimaster ha cargado a la plataforma. Podrá encontrar los archivos en diferentes formatos con la finalidad de optimizar el tiempo de descarga de estos. Las características y especificaciones de los productos o servicios publicados, están sujetos a cambios y/o modificaciones sin aviso previo, los que además están destinados al mercado nacional, la información suministrada es de carácter informativo sin constituir una oferta expresa. Para más información o para ser asistido por un vendedor contáctenos.
		                    	</p>
			                    <div class="row clear-form"><!-- row -->
									<div class="col-md-12" style="margin-bottom:10px;"><!-- col12 -->
										<p><strong>Formatos disponibles para la descarga:</strong></p>
										<div class="i-checks" style="width: 130px; float: left;"><label>
											<input type="radio" onchange="doExtension(this.value)" value="pdf" name="extension" checked> <i></i> Archivo .PDF </label>
										</div>
										<div class="i-checks"><label>
											<input type="radio" onchange="doExtension(this.value)" value="rar" name="extension"> <i></i> Archivo .RAR (Comprimido)</label>
										</div>
		  							</div><!-- col12 -->
								</div><!-- row -->
							</div><!-- ibox-content -->
						</div>
					</div>
				</div>
			</div><!-- wrapper-content -->

			<div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom:80px;"><!-- wrapper-content -->

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
						$has_pdf = $v["has_pdf"];
						$has_rar = $v["has_rar"];
						foreach($categorias as $ss => $vv){
							if($vv["idcategory"] == $idcategory) $idfamily = $vv["idfamily_fk"];
						}
						$uridownload_rar = base_url()."?".$usr."/download/".$idcategory."/".$id."/rar";
						$uridownload_pdf = base_url()."?".$usr."/download/".$idcategory."/".$id."/pdf";

						if ($num % 4 == 0 && $num > 0){ echo '</div><div class="row">';  }

						echo '<div class="col-lg-3 col-xs-3">';
						echo '<div class="ibox">';
						echo '	<div class="ibox-content product-box">';
						echo '			<div class="product-imitation" style="background: url('.$urlimg.') no-repeat center;background-size: cover;"></div>';
						echo '			<div class="product-desc">';
						echo '				<span class="product-price"> 110MB (PDF) / 29MB (RAR)</span>'; //agregar tamaño de size pa pdf y rar
						echo '				<small class="text-muted">'.$v["title"].'</small>';
						echo '				<div  class="product-name">';
						echo $v["name"];
						echo '				</div>';
						echo '				<div class="small m-t-xs">'.$v["description"].'</div>';
						echo '				<div class="btn-group" style="margin:10px 0; width: 100%;">';
						echo '												<button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle btn-download" aria-expanded="false"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i> Descargar <span class="caret"></span></button>';
						echo '												<ul class="dropdown-menu">';
						echo '														<li><a href="'.$uridownload_pdf.'">Descargar en .PDF</a></li>';
						echo '														<li><a href="'.$uridownload_rar.'">Descargar en .RAR</a></li>';
						echo '												</ul>';
						echo '										</div>';
						echo '			</div>';
						echo '		</div>';
						echo '	</div>';
						echo '</div>';


						$num++;
				}
				echo '</div>';
				}
				?>

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

		/*$('input:radio[name="extension"]').change(function(){
		    if($(this).val() === 'pdf'){
		        $(document).find("a[has_pdf='1']").show();
		    }
				if($(this).val() === 'rar'){
		      $(document).find("a[has_rar='1']").show();
		    }

		});*/
/*
		$('input:radio[name="extension"] :checked').live('change',function(){
alert('Something is checked.');
});
*/
//$(".catalogo").addEventListener('click',download_click,false);

/*
$(".catalogo").click(function(event){
	alert("lasdlas");
	var cod_family = $(this).attr("cod");
	var ext = $(document).find("input[name='extension']:checked").val();
	var url = $(this).attr("url");
	window.location.href = url + "/" + ext;

});
*/
function download_click(url)
{
	alert("asds");
	var ext = $(document).find("input[name='extension']:checked").val();
	//var url = $(this).attr("url");
	window.location.href = url + "/" + ext;
}

	function doExtension(value)
	{
		$(".catalogo").hide();
		if(value === 'pdf'){
				$(document).find("a[has_pdf='1']").show();
		}
		if(value === 'rar'){
			$(document).find("a[has_rar='1']").show();
		}

	}
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
							var ext = $(document).find("input[name='extension']:checked").val();
							//$(document).find("a[cod='"+value+"'][has_"+ext+"='1']").show();
							if(ext === "pdf") $(document).find("a[cod='"+value+"'][has_pdf='1']").show();
							if(ext === "rar") $(document).find("a[cod='"+value+"'][has_rar='1']").show();
            }
            $("#" + categoria).find("option[value='-1']").show();
            $("#"+categoria).find("option[value='-1']").prop('selected',true);


        }

	</script>
