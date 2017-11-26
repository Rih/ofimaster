<script type="text/javascript">


function dv(T){
		var M=0,S=1;
		for(;T;T=Math.floor(T/10))
				S=(S+T%10*(9-M++%6))%11;
		return S?S-1:'k';
};

function validacion (rutCompleto) {
		if (!/^[0-9]+-[0-9kK]{1}$/.test( rutCompleto ))
				return false;
		var tmp     = rutCompleto.split('-');
		var digv    = tmp[1];
		var rut     = tmp[0];
		if ( digv == 'K' ) digv = 'k' ;
		return (dv(rut) == digv );
};



function validarRut(selector, msg_error, button){
	if (validacion( $(selector).val() )){
			$("#"+msg_error).text("");
			$("#"+button).prop("disabled",false);
	} else {
			$(selector).val("");
			$("#"+button).prop("disabled",true);
			$("#"+msg_error).text("El RUT no es válido ingrese nuevamente.");
	}
}
</script>

				<?php
					$usr = $this->session->userdata('login_type');
					$uri = "?".$usr."/misdatos";
				?>

				<div class="row wrapper border-bottom white-bg page-heading animated fadeInDown">
	                <div class="col-lg-12">
	                    <h2>Perfil de Usuario</h2>
	                    <ol class="breadcrumb">
	                        <li>
	                            <a href="#">Dashboard</a>
	                        </li>
	                        <li>
	                            <a>Cuenta</a>
	                        </li>
	                        <li class="active">
	                            <strong style="font-weight: 600; color: #dd3d1d;">Perfil de Usuario</strong>
	                        </li>
	                    </ol>
	                </div>
	            </div>

                <div class="wrapper wrapper-content animated fadeInRight" style="padding: 20px 10px 0px;">
                	<div class="row">
		                <div class="col-md-12">
	                    	<div class="panel panel-filled" style="background:#e05337;">
	                        	<div class="panel-body">
	                            	<div class="row">
		                                <!-- Item -->
		                                <div class="col-md-4">
		                                    <div class="panel-body h-200 list">
					                            <div class="stats-title pull-left">
			                                        <h4 style="font-size: 30px;">
			                                            <i class="fa fa-street-view" aria-hidden="true"></i> <?php if(isset($mis_datos[0]["name_legal_rep"])) echo $mis_datos[0]["name_legal_rep"]; ?>
			                                        </h4>
		                                        </div>
	                                        	<table class="table small m-t-sm tbl">
						                            <tbody>
				                                        <tr>
								                            <td>Rut:</td>
								                            <td><?php if(isset($mis_datos[0]["RUT_legal_rep"])) echo $mis_datos[0]["RUT_legal_rep"]; ?></td>
								                        </tr>
								                        <tr>
								                            <td>Correo Electrónico:</td>
								                            <td><?php if(isset($mis_datos[0]["contact_mail"])) echo $mis_datos[0]["contact_mail"]; ?></td>
								                        </tr>
								                        <tr>
						                                    <td>Ciudad:</td>
						                                    <td><?php if(isset($mis_datos[0]["address_legal_rep"])) echo $mis_datos[0]["address_legal_rep"]; ?></td>
						                                </tr>
								                    </tbody>
					                        	</table>
	                                    	</div>
	                                	</div>

		                                <!-- Item -->
		                                <div class="col-md-4 m-t-sm">
		                                	<div class="panel-body h-200 list">
					                            <div class="stats-title pull-left">
					                                <h4><?php if(isset($mis_datos[0]["business_name"])) echo $mis_datos[0]["business_name"]; ?></h4>
					                            </div>

					                            <div class="m-t-xl">
					                                <table class="table small m-t-sm tbl">
						                                <tbody>
						                                	<tr>
							                                    <td>Giro:</td>
							                                    <td><?php if(isset($mis_datos[0]["line_of_business"])) echo $mis_datos[0]["line_of_business"]; ?></td>
							                                </tr>
							                                <tr>
							                                    <td>Rut:</td>
							                                    <td><?php if(isset($mis_datos[0]["RUT"])) echo $mis_datos[0]["RUT"]; ?></td>
							                                </tr>
							                                <tr>
									                            <td>Teléfono de Contacto:</td>
									                            <td><?php if(isset($mis_datos[0]["contact_phone"])) echo $mis_datos[0]["contact_phone"]; ?></td>
									                        </tr>
									                        <tr>
									                            <td>Ciudad:</td>
									                            <td><?php if(isset($mis_datos[0]["city_state"])) echo $mis_datos[0]["city_state"]; ?></td>
									                        </tr>
						                                </tbody>
						                            </table>
					                            </div>
					                            <!--
					                            <div class="btn-group m-t-sm" style="width:100%;">
			                                        <a href="#" class="btn btn-default btn-sm" style="width:50%;"><i class="fa fa-envelope"></i> Contactar</a>
			                                        <a href="<?= $mis_datos[0]['pag_web']; ?>" target="_blank" class="btn btn-default btn-sm" style="width:50%;"><i class="fa fa-plus-circle"></i> Website</a>
			                                    </div>
			                                	-->
		                                    </div>
		                                </div>

				                    	<!-- Item -->
					                    <div class="col-md-4">
					                        <div class="panel-body h-200 list">
					                            <div class="stats-title pull-left">
					                                <h4>Sobre <?php if(isset($mis_datos[0]["company_name"])) echo $mis_datos[0]["company_name"]; ?></h4>
					                            </div>
					                            <div class="m-t-xl">
						                            <p style="text-align: justify; font-size: 11px; line-height: 12px; color:#FFF;">
						                            	<?php if(isset($mis_datos[0]["comments"])) echo $mis_datos[0]["comments"]; ?>
			                                        </p>
		                                        </div>
					                        </div>
					                    </div>
	                            	</div>
	                        	</div>
	                    	</div>
	                	</div>
            		</div>
            	</div>


				<div class="wrapper wrapper-content animated fadeInRight">
					<div class="row">
						<div class="col-md-2">
							<div class="panel panel-b-accent" style="position:relative; height: 530px; background:#e05337;">
	                            <div class="pull-right" style="margin-right: 15px;margin-top: 15px;">
	                                <a href="#" class="btn btn-default btn-xs" style="color: #fff; border-color: #FFF; padding: 5px; background:none !important;">Publicidad</a>
	                            </div>
	                        </div>
						</div>

	                    <div class="col-md-5">
					        <div class="ibox float-e-margins">
		                        <div class="ibox-title">
			                        <h5>Formulario Datos Corporativos</h5>
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
			                        <div class="clear-form">
						                <p style="margin-top: 5px; padding-bottom: 15px; border-bottom: 1px dashed #CECECE; margin-bottom: 15px;">
						                	<i class="fa fa-lock" aria-hidden="true"></i> <strong>Aviso:</strong> Para una buena función de la cuenta dentro de la plataforma de Ofimaster es importante ingresar correctamente los datos de la <code>empresa</code> a la cual representa. La información aquí registrada es responsabilidad del usuario.
						                </p>

			                            <?php
											$usr = $this->session->userdata('login_type');
											$uri1 = "?".$usr."/misdatos/upd/emp";
											echo form_open($uri1,array("id" => "datos_empresa","onsubmit" => "return false;"));
										?>
										<?php
											echo '<div class="form-group">';
											echo '<label for="exampleInputEmail1">Razón Social</label>';
											echo '<input id="misdatosemp" name="business_name" maxlength="150" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["business_name"].'"/>';
			                                echo '</div>';

			                                echo '<div class="form-group">';
			                                echo '<label for="exampleInputEmail1">Giro</label>';
			                                echo '<input id="misdatosemp" name="line_of_business" maxlength="70" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["line_of_business"].'"/>';
			                                echo '</div>';

			                                echo '<div class="form-group">';
			                                echo '<label for="exampleInputEmail1">R.U.T</label>';
			                                echo '<input onblur="validarRut(this,\'rut1\',\'btnmodificar1\')" name="rut" maxlength="15" placeholder="Ej: 11111111-1" data-parsley-required="true" class="form-control" maxlength="15" type="text" value="'.$mis_datos[0]["RUT"].'"/>';
																			echo '<p id="rut1" style="font-size:1.2em; color:red"></p>';
			                                echo '</div>';


			                                echo '<div class="form-group">';
			                                echo '<label for="exampleInputEmail1">Nombre Empresa</label>';
			                                echo '<input id="misdatosemp" name="company_name" maxlength="60" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["company_name"].'"/>';
			                                echo '</div>';

			                                echo '<div class="form-group">';
			                                echo '<label for="exampleInputEmail1">Fono Contacto Empresa</label>';
			                                echo '<input id="misdatosemp" name="contact_phone" maxlength="15" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["contact_phone"].'"/>';
			                                echo '</div>';

			                                echo '<div class="form-group">';
			                                echo '<label for="exampleInputEmail1">Comuna</label>';
			                                echo '<input id="misdatosemp" name="city_state" maxlength="50" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["city_state"].'"/>';
			                                echo '</div>';

			                                echo '<div class="form-group">';
			                                echo '<label for="exampleInputEmail1">Cargo en Empresa</label>';
			                                echo '<input id="misdatosemp" name="position" maxlength="50" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["position"].'"/>';
			                                echo '</div>';


			                                echo '<div class="form-group">';
			                                echo '<label for="exampleInputEmail1">Sobre su Empresa</label>';
											echo '<textarea name="comments" cols="50" rows="5" maxlength="540" class="form-control" style="resize: vertical; line-height: 15px;" value="">'.$mis_datos[0]["comments"].'</textarea>';
			                                echo '</div>';
			                                echo '<button id="btnmodificar1" type="button" onClick="saveEmpresa(0);" class="btn btn-accent inline-block" style="width:100%; color:#f6a821; padding: 8px;"><i class="fa fa-check"></i> Modificar</button>';
			                                ?>
			                            <?php echo form_close(); ?>
			                            <div id="info_empresa" style="display:none">
												            	<center>
													            	<small id="text_empresa" class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs" style="margin: 0px 0px 13px; width: 100%; border: 1px dashed rgb(246, 168, 33); border-radius: 2px; padding: 7px; background-color: rgba(0, 0, 0, 0.12);">
														            </small>
													        	</center>
													        </div>
								    						</div>
	                        	</div>
	                    	</div>
	                	</div>

	                	<div class="col-md-5">
	                		<div class="ibox float-e-margins">
	                			<div class="ibox-title">
			                        <h5>Formulario Datos de Usuario</h5>
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
			                        <div class="clear-form">
						                <p style="margin-top: 5px; padding-bottom: 15px; border-bottom: 1px dashed #CECECE; margin-bottom: 15px;">
						                	<i class="fa fa-lock" aria-hidden="true"></i> <strong>Aviso:</strong> Para una buena función de la cuenta dentro de la plataforma de Ofimaster es importante ingresar correctamente los datos de contacto <code>personales</code> actuales. La información aquí registrada es responsabilidad del usuario.
						                </p>

						                <?php
											$usr = $this->session->userdata('login_type');
											$uri2 = "?".$usr."/misdatos/upd/rep";
											echo form_open($uri2,array("id" => "datos_rep_legal","onsubmit" => "return false;"));
										?>
										<?php
											echo '<div class="form-group">';
											echo '<label for="exampleInputEmail1">Nombre Contacto</label>';
											echo '<input name="name_legal_rep" data-parsley-required="true" maxlength="150" class="form-control" type="text" value="'.$mis_datos[0]["name_legal_rep"].'"/>';
			                                echo '</div>';

			                                echo '<div class="form-group" >';
																			echo '<label for="exampleInputEmail1">R.U.N</label>';
																			echo '<input onblur="validarRut(this,\'rut2\',\'btnmodificar2\')" name="RUT_legal_rep" data-parsley-required="true" maxlength="15" class="form-control" type="text" value="'.$mis_datos[0]["RUT_legal_rep"].'"/>';
																			echo '<p id="rut2" style="font-size:1.2em; color:red"></p>';
			                                echo '</div>';


			                                echo '<div class="form-group">';
											echo '<label for="exampleInputEmail1">Correo Electrónico</label>';
											echo '<input name="contact_mail" data-parsley-required="true" disabled class="form-control" type="email" value="'.$mis_datos[0]["contact_mail"].'"/>';
			                                echo '</div>';

			                                echo '<div class="form-group">';
			                                echo '<label for="exampleInputEmail1">Dirección Principal</label>';
			                                echo '<input name="address_legal_rep" maxlength="150" data-parsley-required="true" class="form-control" type="text" value="'.$mis_datos[0]["address_legal_rep"].'"/>';
			                                echo '</div>';

			                            //  echo '<div class="form-group">';
			                            //  echo '<label for="exampleInputEmail1">Sobre el Representante</label>';
										//	echo '<textarea name="comments_legal_rep" cols="50" rows="5" maxlength="200" class="form-control" style="resize: vertical; line-height: 15px;" value="">	.$mis_datos[0]["comments_legal_rep"].'</textarea>';
			                            //  echo '</div>';

			                                echo '<button type="button" id="btnmodificar2" onClick="saveEmpresa(1);" class="btn btn-accent inline-block" style="width:100%; color:#f6a821; padding: 8px;"><i class="fa fa-check"></i> Modificar</button>';
										?>
										<?php echo form_close(); ?>

										<div id="info_rep_legal" style="display:none">
							            	<center>
							            	<small id="text_rep_legal" class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs" style="margin: 0px 0px 13px; width: 100%; border: 1px dashed rgb(246, 168, 33); border-radius: 2px; padding: 7px; background-color: rgba(0, 0, 0, 0.12);">
								            </small>
								        	</center>
								        </div>
				            		</div>
				        		</div>
				    		</div>
                		</div>
                	</div>
                </div>

	<?php $usr = $this->session->userdata('login_type'); ?>

	<script type="text/javascript">

        <?php echo 'usrtype = "'.$usr.'";'; ?>
		function saveEmpresa(rep_legal){
			var uri = '/misdatos/upd/emp';
			var selector = "#datos_empresa";
			var text_callback = "#text_empresa";
			var idShow = "#info_empresa";
			if (rep_legal === 1){
				uri = '/misdatos/upd/rep';
				selector = "#datos_rep_legal";
				text_callback = "#text_rep_legal";
				idShow = "#info_rep_legal";
			}
			var datos = $(selector).serialize();
			console.log(datos);
			  $.ajax({
                  url: window.location.pathname+'?'+usrtype.toString()+uri,                  //the script to call to get data
                  data: datos,                        //you can insert url argumnets here to pass to api.php
                                                   //for example "id=5&parent=6"
                  method:"POST",
                  dataType: 'json',                //data format
                  success: function(data)          //on recieve of reply
                  {

                    //--------------------------------------------------------------------
                    // 3) Update html content
                    //--------------------------------------------------------------------
                      $(idShow).show();
                      $(text_callback).text(data.msg);
                      $(idShow).hide(2000);
                      //console.log(data.msg);
                      //console.log(data);


                  },
                  fail:function(data) {
                  		$(idShow).show();
                      $(text_callback).text(data.msg);
                  }
                });
		}



	</script>
