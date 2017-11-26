<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hyper Mega RihSlash  - Project • Panel de Control</title>
	<meta name="robots" content="noindex, nofollow">

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url();?>template/theme/bootstrap/css/bootstrap.min.css?nocache=" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!-- ionicons -->
	<link href="<?php echo base_url();?>template/theme/css/ionicons.min.css?nocache=" rel="stylesheet">
	<!-- Simplify -->
	<link href="<?php echo base_url();?>template/theme/css/simplify.min.css?nocache=" rel="stylesheet">
	<link href="<?php echo base_url();?>template/datepicker/css/datepicker.css?nocache=" rel="stylesheet">
  	</head>

  	<body class="overflow-hidden light-background">
  		<?php if($this->session->flashdata('flash_message') != ""):?>
        <script>
            $(document).ready(function() {
                Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:" "})
            });
        </script>
        <?php endif;?>

         <!--
		##############################
		           HEADER
		##############################
		-->
  		<header class="top-nav">
			<div class="top-nav-inner">
				<div class="nav-container">
					<div class="pull-right m-right-sm">
						<div class="user-block hidden-xs">
							<a href="#" id="userToggle" data-toggle="dropdown">
								<div class="user-detail inline-block" style="font-size:10px;"><i class="fa fa-bars"></i> BIENVENIDO <i class="fa fa-angle-down"></i></div>
							</a>
							<div class="panel border dropdown-menu user-panel">
								<div class="panel-body paddingTB-sm">
									<ul>
										<li style="font-size:10px;"><a href=""><i class="fa fa-edit fa-lg"  style="width:15px;"></i><span class="m-left-xs">REGISTRARSE</span></a></li>
										<li style="font-size:10px;"><a href=""><i class="fa fa-inbox fa-lg" style="width:15px;"></i><span class="m-left-xs">INGRESAR</span></a></li>
									</ul>
								</div>
							</div>
						</div>
						<ul class="nav-notification" style="padding-right:20px;">
							<!--
							<li>
								<a href="#" data-toggle="dropdown"><i class="fa fa-envelope fa-lg"></i></a>
								<div class="chat-alert">Contacto</div>				
							</li>
							<li>
								<a href="#" data-toggle="dropdown"><i class="fa fa-list fa-lg"></i></a>
								<div class="chat-alert">Bases</div>
							</li>
							-->
							<!--<li class="chat-notification">
								<a href="#" class="sidebarRight-toggle"><i class="fa fa-power-off fa-lg"></i></a>
								
								<div class="chat-alert">Salir</div>
								
							</li>
							-->
						</ul>
					</div>
				</div>
			</div>
		</header>

		<div class="wrapper no-navigation preload">
			<div class="sign-in-wrapper">
				<div class="sign-in-inner">
					<div class="login-brand text-center">
						<!-- <img src="<?php echo base_url();?>template/theme/img/logo-account.png"></br> -->
						
					</div>
					<?php include 'page_info.php'; ?>
					<?php echo form_open('?Login',array('id' => 'formValidate2'));?>
						
						<div class="form-group m-bottom-md">
							<input type="email" data-parsley-required="true" name="email" class="form-control input-sm" placeholder="Correo Electrónico">
						</div>
						<div class="form-group">
							<input type="password" data-parsley-required="true" name="password" class="form-control input-sm" placeholder="Contraseña">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-success block"  value="INGRESAR" style="width:100%; font-size:10px;"/>
						</div>

						<div class="m-top-md p-top-sm">
							<div class="font-12 text-center m-bottom-xs">
								<a href="<?php echo site_url('?account/recover');?>" class="font-12">¿Olvidaste tu contraseña ?</a>								
							</div>
							<div class="font-12 text-center m-bottom-xs">¿No tienes una cuenta?</div>
							<a href="<?php echo site_url('?account/create');?>" class="btn btn-default block" style="font-size:10px;"><i class="fa fa-pencil-square-o"></i> REGISTRARME</a>
						</div>

						<div class="m-top-md p-top-sm">
						<p style="color:#a4a4a4; font-size:11px; line-height:11px; text-align:justify;">
						©Todos los derechos reservados - 2015. Queda absolutamente prohibida la reproducción total o parcial de cualquier material, código 
						o información expuesta en esta plataforma de gestión. El material es de carácter privado y toda forma de utilización de nuestra información no autorizada será 
						perseguida con lo establecido a la ley chilena. Las acciones realizadas en este Sistema de Administración son de exclusiva responsabilidad del usuarios, 
						ingresado con su respectivo correo electrónico y contraseña elegida.</p>
						<!-- <p style="text-align:center;"><a href="http://www.codemakers.cl" target="_blank"><img src="<?php echo base_url();?>template/theme/img/codemakers.png"></a></p>-->
						</div>
					<?php echo form_close();?>
				</div><!-- ./sign-in-inner -->
			</div><!-- ./sign-in-wrapper -->
		</div><!-- /wrapper -->

		<a href="#" id="scroll-to-top" class="hidden-print"><i class="icon-chevron-up"></i></a>

	    <!-- Le javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
		
		<!-- Jquery -->
		<script src="<?php echo base_url();?>template/theme/js/jquery-1.11.1.min.js"></script>
		
		<!-- Bootstrap -->
	    <script src="<?php echo base_url();?>template/theme/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll -->
		<script src='<?php echo base_url();?>template/theme/js/jquery.slimscroll.min.js'></script>
		
		<!-- Popup Overlay -->
		<script src='<?php echo base_url();?>template/theme/js/jquery.popupoverlay.min.js'></script>

		<!-- Modernizr -->
		<script src='<?php echo base_url();?>template/theme/js/modernizr.min.js'></script>
		
		<!-- Simplify -->
		<script src="<?php echo base_url();?>template/theme/js/simplify/simplify.js"></script>
		
		<script src="<?php echo base_url();?>template/theme/js/parsley.min.js"></script>
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

<!-- Mirrored from minetheme.com/simplify1.0/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:36:07 GMT -->
</html>
