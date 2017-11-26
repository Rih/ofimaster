<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php if (isset($page_title)) echo $page_title; ?></title>
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


		<style type="text/css">
			.btnsize {
				margin: 0;
				weight: 100%;
				height: 550%;
				font-size: 150%;
				text-align: center;
				border-radius: 20%;

			}
			.btnsize:hover {
				background-color: yellow;
				cursor: pointer;

			}
			div:link:active, div:visited:active {
    			 color: red;
    			 text-decoration: underline;
			}
		</style>

	<!-- Login Form Style -->
	<link href="<?php echo base_url();?>template/login_form/login_style.css?nocache=" rel="stylesheet">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  	</head>

  	<body>
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
  		<header>
			<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Menu</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="<?php echo base_url();?>"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo base_url();?>">Inicio</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo base_url();?>#about">What is hsk?</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo base_url();?>#portfolio">Identifica Sonidos</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo base_url();?>?Startpage">Practica</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
		</header>

		<div class="wrapper no-navigation preload">
			<div class="sign-in-wrapper">
				<div class="login-brand text-center">
					<h2 style="text-align:center;color:gray"><?php if (isset($page_title)) echo $page_title; ?></h2> <br>
					<!-- <img src="<?php echo base_url();?>template/theme/img/account-text-create.png"></br> -->
					<center>
						<?php if(isset($flash_message)) {
			             echo '<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"> ';
			               echo $flash_message;
			            echo '</small>';
			            } ?>
			        </center>

				</div>

						<div class="sign-in-inner">
							<div class="login-brand text-center">
								<!-- <img src="<?php echo base_url();?>template/theme/img/account-text-login2.png"></br> -->

							</div>

							<?php echo form_open('?Startpage',array('id' => 'formValidate2', 'class' => 'login'));?>
								<label value="Porfavor selecciona dificultad" style="color:white">Por favor selecciona dificultad</label>

								<div class="row">
									<div class="col-sm-4" style="height:150%">
										<div href="#" id="facil" class="btnsize" name="facil"> Fácil</div>
									</div>
									<div class="col-sm-4" style="height:150%" >
										<div href="#" id="intermedio" class="btnsize" name="intermedio"> Intermedio</div>
									</div>
									<div class="col-sm-4" style="height:150%">
										<div href="#" id="dificil" class="btnsize" name="dificil"> Dificil</div>
									</div>
								</div>
								<div class="form-group">
									<input type="hidden" data-parsley-required="true" id="dificultad" name="dificultad" class="form-control input-sm">
								</div>
							    <div class="form-group">
									<input type="text" data-parsley-required="true" name="playername" class="form-control input-sm" placeholder="Ingresa Tu nombre .." autocomplete="off">
								</div>

								<div class="form-group">
									<input type="submit" class="btn btn-success block"  value="PLAY" style="width:100%; font-size:10px;"/>
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

		<!-- Point -->
		<script src="<?php echo base_url();?>template/js/Point.js"></script>

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

			$("#facil").click(function(){
				$(".btnsize").css("background-color","transparent");
				$(this).css("background-color","red");
				var dificultad = document.getElementById("dificultad");
           		dificultad.value = $(this).attr("name");
			});
			$("#intermedio").click(function(){
				$(".btnsize").css("background-color","transparent");
				$(this).css("background-color","red");
				var dificultad = document.getElementById("dificultad");
           		dificultad.value = $(this).attr("name");
			});
			$("#dificil").click(function(){
				$(".btnsize").css("background-color","transparent");
				$(this).css("background-color","red");
				var dificultad = document.getElementById("dificultad");
           		dificultad.value = $(this).attr("name");

			});
		</script>





  	</body>

<!-- Mirrored from minetheme.com/simplify1.0/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:36:07 GMT -->
</html>
