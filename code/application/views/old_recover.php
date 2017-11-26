<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
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
                    <h3>Ingreso Login</h3>
                    <small>
                        Sistema de busqueda de carga y transporte 
                    </small>
                </div>
            </div>
             
            <div class="panel panel-filled">
                <div class="panel-body">
                	<?php if(isset($token_stage)) { ?>
                	
					<?php echo form_open('?Login/recuperar/reset/'.$idacc.'/'.$token,array('id' => 'formValidate2'));?>
                        
                        <div class="form-group">
                            <label class="control-label" for="password">Contraseña</label>
                            <input type="password" data-parsley-required="true" title="Please enter your new password" placeholder="*********" required="" value="" name="password" id="password" class="form-control">
                            <span class="help-block small">Ingresa la nueva contraseña de tu cuenta</span>
                        </div>
                        <div>
                            <button class="btn btn-accent" style="color:#f6a821;">Renovar</button>
                            
                            
                        </div>
                    <?php echo form_close();?>
                    
                    <?php } else if(isset($email_stage)){ ?>
                              <?php echo form_open('?Login/recuperar/send',array('id' => 'formValidate2'));?>
                        
                        <div class="form-group">
                            <label class="control-label" for="password">Correo</label>
                            <input type="email" data-parsley-required="true" title="Please enter your new email" placeholder="a@b.cl" required="" value="" name="username" id="username" class="form-control">
                            <span class="help-block small">Ingresa el correo para recuperar cuenta</span>
                        </div>
                        <div>
                            <button class="btn btn-accent" style="color:#f6a821;">Recuperar</button>
                            
                            
                        </div>
                    <?php echo form_close();?>
                    <?php } ?>
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
