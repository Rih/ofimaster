			<?php
				$usr = $this->session->userdata('login_type');
				$uriadd = "?".$usr."/cuentas/add";
			?>
			<?php echo form_open($uriadd,array('id' => 'formValidate1', 'name' => 'tablename_cu','onsubmit' => 'return false;'));?>

			<div class="modal-body">
                <div class="row">
                    <p class="m-u" style="margin-top: 5px;"><i class="fa fa-lock" aria-hidden="true"></i> <strong>Importante:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
								<div class="info_callback" style="display:none">
										<center>
												<small class="text_callback badge badge-success badge-square bounceIn animation-delay5 m-left-xs" style="margin: 0px 0px 13px; width: 100%; border: 1px dashed rgb(246, 168, 33); border-radius: 2px; padding: 7px; background-color: rgba(0, 0, 0, 0.12);">
										</small>
										</center>
								</div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" id="username"  name="username" class="form-control validation1 clear" placeholder="Correo Electrónico" autocomplete="on" required >
                    </div>
                </div>
                <div class="row">
                    <div class="form-group m-bottom-md">
                        <input type="password" data-parsley-required="true" min="6" max="30"  name="password" class="form-control validation1 clear" placeholder="Contraseña" data-length="6" autocomplete="off" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-cancelar" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                <input  id="saveModalInput" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>
