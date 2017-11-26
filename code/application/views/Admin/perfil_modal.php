		<?php
			$usr = $this->session->userdata('login_type');
			$uriadd = "?".$usr."/".$page_name."/add";
		?>
		<?php echo form_open($uriadd,array('id' => 'formValidate1', 'name' => 'tablename_cu', 'onsubmit' => 'return false;'));?>

			<div class="modal-body">
                <div class="row">
                    <p class="m-u" style="margin-top: 5px;"><i class="fa fa-lock" aria-hidden="true"></i> <strong>Importante:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>

				<div class="row">
					<h3 style="font-size: 13px; font-weight: bold; color:#FFF;">DATOS DE REPRESENTANTE</h3>
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true"  name="name_legal_rep" maxlength="150" class="form-control validation3 clear" id="name_legal_rep" placeholder="Nombre Representante Legal" autocomplete="on" />
					</div>
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true"  name="rut_legal_rep" maxlength="15" class="form-control validation3 clear" id="rut_legal_rep" placeholder="Rut Representante Legal" autocomplete="on" />
					</div>
					<div class="form-group m-bottom-md">
                    <input type="text"   data-parsley-required="true" name="position" maxlength="50" class="form-control validation3 clear" id="position" placeholder="Su Cargo en la Empresa" autocomplete="on" required/>
                	</div>
				</div>

				<div class="row">
					<h3 style="font-size: 13px; font-weight: bold; color:#FFF;">DATOS DE LA EMPRESA</h3>
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true"  name="business_name" maxlength="150" class="form-control validation3 clear" id="business_name" placeholder="Razon Social" autocomplete="on" />
					</div>
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true"  name="rut" maxlength="15" class="form-control validation3 clear" id="rut" placeholder="RUT Empresa" autocomplete="on" />
					</div>
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true"  name="company_name" maxlength="60" class="form-control validation3 clear" id="company_name" placeholder="Nombre Empresa" autocomplete="on" />
					</div>
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true"  name="line_of_business"  maxlength="70" class="form-control validation3 clear" id="line_of_business" placeholder="Giro" autocomplete="on" />
					</div>
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true"  name="contact_phone" maxlength="15" class="form-control validation3 clear" id="contact_phone" placeholder="Fono Contacto" autocomplete="on" />
					</div>
					<div class="form-group m-bottom-md">
						<input type="text" data-parsley-required="true" name="city_state" maxlength="50" class="form-control validation3 clear" id="city_state" placeholder="Ciudad" autocomplete="on" />
					</div>
				</div>
			</div>
			<div class="info_callback" style="display:none">
				<center>
					<small class="text_callback badge badge-success badge-square bounceIn animation-delay5 m-left-xs" style="margin: 0px 0px 13px; width: 100%; border: 1px dashed rgb(246, 168, 33); border-radius: 2px; padding: 7px; background-color: rgba(0, 0, 0, 0.12);">
					</small>
				</center>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-cancelar" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                <input  id="saveModalInput3" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>
