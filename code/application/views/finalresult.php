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
  	


	<div class="wrapper no-navigation preload">
	
		<div class="padding-md">
			<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
				<li><span class="primary-font"><i class="fa fa-home"></i></span> RESULTADOS</li>
				<li><?php if(isset($finalresult)){ 
					echo 'Estimad@ '.$finalresult['player_name']; 
					}?></li>	 
				
			</ul>
			
			<!-- <p style = "color:white;font-size:120%">El mejor tono fue: Tono <?php echo $best['tone']; ?> con un <?php echo $best['pct'];?> </p> -->
			<p style = "color:white;font-size:150%">El tono a mejorar es: Tono <?php echo $worst['tone']; ?> con un <?php echo $worst['pct'];?>% de error </p> <br><br>
			
			<table class="table" style="background-color:white;">
			

				<thead style = "background-color:white;">
					<tr>					
						<th style="width:30%;">Item</th>
						<th style="width:20%;">Resultados</th>
						<th style="width:20%;"></th>	
						<th style="width:20%;"></th>					
						<th style="width:5%;"></th>						

					</tr>
				</thead>
				<tbody>
					 <?php 		
					 	if(isset($finalresult)){
							
								$id = $finalresult['idOA'];							
								echo '<tr>';
								echo '<div class="container">';								
								echo  '<td>Dificultad</td>';
								echo  '<td>'.$finalresult['dificultad'].'</td>';
								echo  '<td></td>';
								echo  '<td></td>';
								echo  '<td></td>';
								echo '</div>';
								echo '</tr>';

								echo '<tr>';
								echo '<div class="container">';								
								echo  '<td>Tiempo utilizado</td>';
								echo  '<td>'.$finalresult['time_used'].'</td>';
								echo  '<td></td>';
								echo  '<td></td>';
								echo  '<td></td>';
								echo '</div>';
								echo '</tr>';
								
								echo '<tr>';
								echo '<div class="container">';								
								echo  '<td>Total correctas</td>';
								echo  '<td>'.$finalresult['hits'].'</td>';
								echo  '<td></td>';
								echo  '<td></td>';
								echo  '<td></td>';
								echo '</div>';
								echo '</tr>';
								
								echo '<tr>';
								echo '<div class="container">';								
								echo  '<td>Total fallidas</td>';
								echo  '<td>'.$finalresult['miss'].'</td>';
								echo  '<td></td>';
								echo  '<td></td>';
								echo  '<td></td>';
								echo '</div>';
								echo '</tr>';

								for($tono=1;$tono<=4;$tono++){
									echo '<tr>';
									echo '<div class="container">';								
									echo  '<td>% Tono '.$tono.'</td>';
									$str1 = ($result_percent[$tono]['percent_hits'] !="No aplica") ? " % aciertos":"";
									$str2 = ($result_percent[$tono]['percent_miss'] !="No aplica") ? " % errores":"";
									$str3 = " veces";
									echo  '<td>'.$result_percent[$tono]['percent_hits']. $str1.'</td>';
									echo  '<td>'.$result_percent[$tono]['percent_miss']. $str2.'</td>';
									echo  '<td></td>';
									echo  '<td></td>';
									echo '</div>';
									echo '</tr>';	
								}

						}
					?>
				</tbody>
			</table>
			<div class="form-group">
				<a class="btn btn-primary"  href="<?php echo base_url();?>?Questions/logout" value="Salir">Salir</a>
				<a class="btn btn-success"  href="<?php echo base_url();?>?Questions/send" value="Enviar Reporte">Enviar Reporte</a>
			</div>		
		</div><!-- ./padding-md -->
		
	</div><!-- /wrapper-container -->


		
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
