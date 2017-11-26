			<?php
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/catalogo/add";
			?>
			<style type="text/css">

            .fa-spin-custom, .glyphicon-spin {
                -webkit-animation: spin 1000ms infinite linear;
                animation: spin 1000ms infinite linear;
            }
            @-webkit-keyframes spin {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(359deg);
                    transform: rotate(359deg);
                }
            }
            @keyframes spin {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(359deg);
                    transform: rotate(359deg);
                }
            }
            </style>
            <?php echo form_open_multipart($uriadd, array("id" => "uploadFile","name" => "tablename_cu","onsubmit" => "return false;")); ?>

			<div class="modal-body">

                <script src="<?php echo base_url();?>template/js/angular.min.js"></script>
                <script src="<?php echo base_url();?>template/js/app.js"></script>

                <div class="row">
                    <p class="m-u" style="margin-top: 5px;">
                        <i class="fa fa-lock" aria-hidden="true"></i> <strong>Importante:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
                <div class="row">
                    <div id="loader" class="text-center" style="display:none">
                        <label>Cargando archivo... Esto puede tardar varios minutos, espere por favor.</label><br>
                        <span class="glyphicon glyphicon-refresh glyphicon-spin"></span>
                    </div>
                    <div id="info_callback" style="display:none">
                                <center>
                                <small id="text_callback" class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs" style="margin: 0px 0px 13px; width: 100%; border: 1px dashed rgb(246, 168, 33); border-radius: 2px; padding: 7px; background-color: rgba(0, 0, 0, 0.12);">
                                </small>
                                </center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-6 text-center" style="padding-left: 0;">
                        <input class="form-control validation1 clear input_validation" id="title" name="title" value="" data-parsley-required="true"  placeholder="Título" type="text">
                    </div>
                    <div class="col-md-6 col-xs-6 text-center" style="padding-right: 0;">
                        <select class="form-control validation1 clear input_validation" id="category" name="category" data-parsley-required="true">
                        <option value="-1">Seleccione Categoría</option>
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
                    echo '<div class="col-md-12 col-xs-12 text-center" style="padding:0; margin-top:10px;">';
                    echo form_textarea(
                        array(
                            'name'        => 'description',
                            'id'          => 'description',
                            'maxlength'   => '200',
                            'rows'        => '6',
                            'cols'        => '50',
                            'class'       => 'form-control validation1 clear',
                            'value'       => '',
                            //'size'        => '35',
                            'style'       => 'resize: vertical; height:150px',
                            'placeholder' => 'Descripción'
                            )
                        );
                    echo '</div>';
                ?>
                </div>
                <div class="row">
                    <p class="m-u" style="margin-top: 5px;">
                        <i class="fa fa-lock" aria-hidden="true"></i> <strong>Importante:</strong> 
                        Por Favor, adjunte archivos (RAR/PDF) asociado(s) al catálogo a crear, éstos 
                        se renombrarán con el nombre de la categoría seleccionada. <br> 
                        (Soporte de un archivo de cada formato. Tamaño máximo: 150Mb por archivo)
                     </p>
                </div>
                <div class="row">
                    <input type="hidden" name="size_catalog" id="size_catalog" value="10" />
                    <input type="hidden" name="size_rar_catalog" id="size_rar_catalog" value="20" />
                    <input type="hidden" name="all_products" id="all_products" />

                    <!-- 
                    <div id="files" class="col-md-12 col-xs-12 text-center" style="padding:0; margin-top:10px;">
                        <?= $error; ?>
                        <input type="file" class="validation1 clear" name="userfile" id="userfile" size="30" accept="application/pdf,application/rar" onchange="showFileSize();" style="color:#FFF" />
                        <p id="msg_files"></p>
                    </div> -->
                </div>




                    <!-- <div class="row text-center">
                        <button onclick="guardar();" class="btn btn-w-md btn-accent" style="width: 100%;"><i class="fa fa-check" aria-hidden="true"></i> Guardar</button>
                    </div>
                    -->

                <div id="filelist" class="row">Tu navegador no tiene soporte Flash, Silverlight o HTML5.</div>
                <br />

                <div id="container" class="selector_files" style="display:none">
                    <a id="pickfiles" href="javascript:;" class="btn btn-w-md dim btn-default">Examinar...</a> 
                    <a id="uploadfiles" href="javascript:;" class="btn btn-primary dim" style="display:none;float:right">Comenzar</a>
                    <br />
                <p id="console"></p>
                </div>

                



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-cancelar" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                <!--<button id="saveModalInputFiles" value="Guardar" class="btn btn-accent" >Aplicar</button> -->
                <!-- <button onclick="guardar();"  value="Guardar" class="btn btn-accent" ><i class="fa fa-check" aria-hidden="true"></i> Guardar</button>
                -->
            </div>
            <?= form_close(); ?>

<script type="text/javascript">
	$(".input_validation").blur(function(){
		var valid = true;
		$(".input_validation").each(function(){
			if($(this).is("SELECT")){
				if($(this).val() == "-1") valid=false;
			}
			else if($(this).is("INPUT"))
			{
				if($(this).val() == "") valid=false;
			}
			
		});
		if(valid)
			$(".selector_files").show();
		else
			$(".selector_files").hide();
		
	});
 


</script>
