<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>OFIMASTER(CL) | Panel de Control</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    
    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/bootstrap/css/bootstrap.css"/>

    <!-- App styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/pe-icons/helper.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/stroke-icons/style.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/style.css">

</head>
<body class="blank">
  		<?php if($this->session->flashdata('flash_message') != ""):?>
        <script>
            $(document).ready(function() {
                Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:" "})
            });
        </script>
        <?php endif;?>

<!-- Wrapper-->
<div class="wrapper">

    <!-- Main content-->
    <section class="content">
    	<div class="container-center animated slideInDown">
    		<div class="view-header">
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-unlock"></i>
                </div>
                <div class="header-title">
                    <h3 style="letter-spacing: 1.5px;">Registro Nuevo</h3>
                    <small>Registro de Nueva Cuenta de Usuario</small>
                </div>
            </div>
             
            <div class="panel panel-filled">
                <div class="panel-body">
                    <?php  if(isset($info)) echo $info; ?>
                	<?php include 'page_info.php'; ?>
					<?php echo form_open('?Login/registrar/add',array('id' => 'formValidate2'));?>
                    <div class="bs-example" style="margin-bottom:15px;">
                        <div class="m-t-xs footer-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </div>
                    </div>
                    
                    <h3 style="font-size: 13px; font-weight: bold;">DATOS DE REPRESENTANTE</h3>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="name_legal_rep" class="form-control" placeholder="Nombre Representante Legal" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="rut_legal_rep" class="form-control" placeholder="Rut Representante Legal" autocomplete="on" required/>
                    </div>
                    <!-- <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="fono" class="form-control" placeholder="Teléfono Personal" pattern="^(\d+)$" autocomplete="on" required/>
                    </div> -->
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="username" class="form-control" placeholder="Correo Electrónico" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="password" data-parsley-required="true" name="password" class="form-control" placeholder="Contraseña..." autocomplete="off" required/>
                    </div>
                    <div class="form-group m-bottom-md" style="padding-bottom:20px;">
                        <input type="password" data-parsley-required="true" name="password_again" class="form-control" placeholder="Repita Contraseña..." autocomplete="off" required/>
                    </div>

                    <h3 style="font-size: 13px; font-weight: bold;">DATOS DE LA EMPRESA</h3>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="business_name" class="form-control" placeholder="Razon Social" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="rut" class="form-control" placeholder="RUT Empresa" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="company_name" class="form-control" placeholder="Nombre Empresa" autocomplete="on" required/>
                    </div>

                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="line_of_business" class="form-control" placeholder="Giro" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="contact_phone" class="form-control" placeholder="Fono Contacto" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="city_state" class="form-control" placeholder="Comuna" autocomplete="on" required/>
                    </div>
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="position" class="form-control" placeholder="Cargo en empresa" autocomplete="on" required/>
                    </div>

                    <div class="bs-example" style="margin-bottom:15px;">
                        <div class="m-t-xs footer-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                    </div>
                    
                    <div class="form-group m-bottom-md">
                        <button class="btn btn-accent" style="color:#f6a821; width:100%">Crear Cuenta</button>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
            <div class="m-t-xs footer-text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                <p style="text-align:center; padding-top:20px;"><img src="<?php echo base_url();?>template/codemakers/images/logo-949ba2.png"></p>
            </div>

        </div>
    </section>
    <!-- End main content-->

</div>
<!-- End wrapper-->

<!-- Vendor scripts -->
<script src="<?php echo base_url();?>template/codemakers/vendor/pacejs/pace.min.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- App scripts -->
<script src="<?php echo base_url();?>template/codemakers/scripts/luna.js"></script>

	<script>
		$(function()	{
			//Delete Widget Confirmation
			$('#deleteWidgetConfirm').popup({
					vertical: 'top',
					pagecontainer: '.container',
					transition: 'all 0.3s'
			});

			//Form Validation
			$('#basic-constraint').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							return false;
						}
			        }
			}}); 
				
			$('#type-constraint').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							return false;
						}
			        }
			}}); 
				 
			$('#formValidate2').parsley( { listeners: {
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Registration Complete');
							return false;
						}
			        }
			}}); 
				
			$('#formValidatex2').parsley( { listeners: {
					onFieldValidate: function ( elem ) {
						// if field is not visible, do not apply Parsley validation!
						if ( !$( elem ).is( ':visible' ) ) {
							return true;
						}

						return false;
					},
			        onFormSubmit: function ( isFormValid, event ) {
			            if(isFormValid)	{
							alert('Your message has been sent');
							return false;
						}
			        }
			}}); 
		});   
	</script>

</body>
</html>
