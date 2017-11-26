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



			<script type="text/javascript">




			window.onload = function(){

			(function(){
			  <?php if(isset($currenttimeFormat) && isset($currenttimeSeconds)) {

			  	//$timeout = strtotime(date("H:i:s",strtotime($currenttime) ) ) - strtotime(date("H:i:s",0) );
			  	echo 'var counter = '.$currenttimeSeconds.';';
			  	echo 'var counterstr = "'.$currenttimeFormat.'";';
			  	}else{
			  		echo 'var counter = 900;';
			  		echo 'var counterstr = "00:15:00";';
			  	}
			  ?>
			  setInterval(function() {
			    counter--;
			    if (counter >= 0) {
			      span = document.getElementById("count");
			      span.innerHTML = counterstr;

				    $.ajax({
				      url: window.location.pathname+'?Ajax/changeCountdown/'+counter,                  //the script to call to get data
				      data: "",                        //you can insert url argumnets here to pass to api.php
				                                       //for example "id=5&parent=6"
				      dataType: 'json',                //data format
				      success: function(data)          //on recieve of reply
				      {

				        //--------------------------------------------------------------------
				        // 3) Update html content
				        //--------------------------------------------------------------------

				        // $('#pwd'+id).html(pwd); //Set output element html

				          $('#count').html(data.currenttimeFormat); //Set output element html
				          //var aux = data.split(":");
				          //if (aux[0][0]==="0") aux[0] = aux[0][1];
				          //if (aux[1][0]==="0") aux[1] = aux[1][1];
				          //if (aux[2][0]==="0") aux[2] = aux[2][1];
				          counter = parseInt(data.currenttimeSeconds);
				          counterstr = data.currenttimeFormat;
				          //console.log("success");
				          //alert(data);
				          //alert("LALALALA");
				        //}

				        //recommend reading up on jquery selectors they are awesome
				        // http://api.jquery.com/category/selectors/
				      },
				      error: function (xhr, ajaxOptions, thrownError) {
				           //alert(xhr.status);
				           //alert(xhr.responseText);
				           //alert(thrownError);
				        }
			    	});
			    }
			    // Display 'counter' wherever you want to display it.
			    if (counter === 0) {

			        window.location = window.location.pathname + "?Questions/finalreport";
			        clearInterval(counter);
			    }


			  }, 1000);

			})();

			}

			</script>


		<div class="wrapper no-navigation preload">
			<div class="sign-in-wrapper">
				<div class="login-brand text-center">
					<h2 style="text-align:center;color:gray"><?php if (isset($page_title)) echo $page_title; ?></h2> <br>
					<p style="color:white; padding-left:400px; color:gray;padding-right:400px; 	">Tiempo restante <span id="count"><?php if(isset($currenttimeFormat) ) echo $currenttimeFormat; ?></span> </p>

				</div>

						<div class="sign-in-inner">
							<div class="login-brand text-center">

							</div>
							<?php include 'page_info.php'; ?>

							<?php echo form_open('?Questions/next_question/'.(++$current_question),array('id' => 'formValidate2', 'class' => 'login'));?>
								<p  style="color:white; font-size:130%">Pregunta actual: <?php echo ($current_question - 1); ?> </p>
								<label value="Porfavor selecciona dificultad" style="color:white">Por favor reproduzca el audio y determine a que tono corresponde: </label>
									<!-- Toy reproduciendo... <?php if(isset($questions) && $questions != false) echo $questions['silab'].$questions['correct_tone']?>.wav  -->

								 <audio controls autoplay>
								  <source src="<?php echo base_url();?>template/audio/<?php echo $questions['silab'].$questions['correct_tone']?>.wav" type="audio/wav" preload>

									Your browser does not support the audio element.
								</audio>

								<div class="row">
								  	<div class="col-sm-6">
										<input type="radio" data-parsley-required="true" name="tonos" value="1">Tono 1

								  	</div> <!-- end col-sm -->
								  	<div class="col-sm-6">
										<div id="btnquestion1" class="btn" style="font-size:120%" >
											<i id ="iconeye" class="fa fa-question-circle"></i>
										</div>
								  	</div> <!-- end col-sm -->
								</div> <!-- end row -->

								<div class="row">
								  	<div class="col-sm-6">
										<input type="radio" data-parsley-required="true" name="tonos" value="2" >Tono 2
								  	</div> <!-- end col-sm -->
								  	<div class="col-sm-6">
										<div id="btnquestion2" class="btn" style="font-size:120%" >
											<i id ="iconeye" class="fa fa-question-circle"></i>
										</div>
								  	</div> <!-- end col-sm -->
								</div> <!-- end row -->

								<div class="row">
								  	<div class="col-sm-6">
										<input type="radio" data-parsley-required="true" name="tonos" value="3" >Tono 3
								  	</div> <!-- end col-sm -->
								  	<div class="col-sm-6">
										<div id="btnquestion3" class="btn" style="font-size:120%" >
											<i id ="iconeye" class="fa fa-question-circle"></i>
										</div>
								  	</div> <!-- end col-sm -->
								</div> <!-- end row -->

								<div class="row">
								  	<div class="col-sm-6">
										<input type="radio" data-parsley-required="true" name="tonos" value="4" >Tono 4
								  	</div> <!-- end col-sm -->
								  	<div class="col-sm-6">
										<div id="btnquestion4" class="btn" style="font-size:120%" >
											<i id ="iconeye" class="fa fa-question-circle"></i>
										</div>
								  	</div> <!-- end col-sm -->
								</div> <!-- end row -->
								<div class="form-group">
									<input type="submit" class="btn btn-success block"  value="<?php if(isset($BtnNext)) echo $BtnNext; ?>" style="width:100%; font-size:10px;"/>
								</div>


								   <!-- <div class="col-sm-6">
										<div id="btnquestion1" class="btn" style="font-size:120%" data-toggle="tooltip" title="también llamado tono sostenido, la voz no sufre variaciones">
											<i id ="iconeye" class="fa fa-question-circle"></i>
										</div>
								  	</div> -->

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



			}


		</script>

		<script type="text/javascript">
				$(document).ready(function(){


				    $('[data-toggle="tooltip"]').tooltip({
				        placement : 'top'
				    });


					$("#btnquestion1").click(function(){
						openModal(1);
						$.ajax({
						      url: window.location.pathname+'?Ajax/updateHelp/'+1,                  //the script to call to get data
						      data: "",                        //you can insert url argumnets here to pass to api.php
						                                       //for example "id=5&parent=6"
						      dataType: 'json',                //data format
						      success: function(data)          //on recieve of reply
						      {

						        //--------------------------------------------------------------------
						        //recommend reading up on jquery selectors they are awesome
						        // http://api.jquery.com/category/selectors/
						      },
						      error: function (xhr, ajaxOptions, thrownError) {
						           alert(xhr.status);
						           //alert(xhr.responseText);
						           //alert(thrownError);
						        }
					    	});
						});
					$("#btnquestion2").click(function(){
						openModal(2);
						$.ajax({
						      url: window.location.pathname+'?Ajax/updateHelp/'+2,                  //the script to call to get data
						      data: "",                        //you can insert url argumnets here to pass to api.php
						                                       //for example "id=5&parent=6"
						      dataType: 'json',                //data format
						      success: function(data)          //on recieve of reply
						      {

						        //--------------------------------------------------------------------
						        // 3) Update html content

						        //recommend reading up on jquery selectors they are awesome
						        // http://api.jquery.com/category/selectors/
						      },
						      error: function (xhr, ajaxOptions, thrownError) {
						           alert(xhr.status);
						           //alert(xhr.responseText);
						           //alert(thrownError);
						        }
					    	});
						});
					$("#btnquestion3").click(function(){
						openModal(3);
						$.ajax({
						      url: window.location.pathname+'?Ajax/updateHelp/'+3,                  //the script to call to get data
						      data: "",                        //you can insert url argumnets here to pass to api.php
						                                       //for example "id=5&parent=6"
						      dataType: 'json',                //data format
						      success: function(data)          //on recieve of reply
						      {

						        //--------------------------------------------------------------------
						        // 3) Update html content

						        //recommend reading up on jquery selectors they are awesome
						        // http://api.jquery.com/category/selectors/
						      },
						      error: function (xhr, ajaxOptions, thrownError) {
						           alert(xhr.status);
						           //alert(xhr.responseText);
						           //alert(thrownError);
						        }
					    	});
						});
					$("#btnquestion4").click(function(){
						openModal(4);
						$.ajax({
						      url: window.location.pathname+'?Ajax/updateHelp/'+4,                  //the script to call to get data
						      data: "",                        //you can insert url argumnets here to pass to api.php
						                                       //for example "id=5&parent=6"
						      dataType: 'json',                //data format
						      success: function(data)          //on recieve of reply
						      {
						        //--------------------------------------------------------------------
						        // 3) Update html content

						        //recommend reading up on jquery selectors they are awesome
						        // http://api.jquery.com/category/selectors/
						      },
						      error: function (xhr, ajaxOptions, thrownError) {
						           alert(xhr.status);
						           //alert(xhr.responseText);
						           //alert(thrownError);
						        }
					    	});
						});
				});

            </script>

            <div id="dialogo" class="modal fade">
			  <div class="modal-dialog" style="top: 50px;">
			    <div id="contenido-dialogo" class="modal-content">
			    </div>
			  </div>
			</div>

			<script type="text/javascript">
				var tonoshelp = [];
				tonoshelp[0] = "también llamado tono sostenido, la voz no sufre variaciones";
				tonoshelp[1] = "también llamado tono ascendente, se asemeja al énfasis que damos a la pregunta ¿Qué? en español";
				tonoshelp[2] = "Este desciende levemente y luego asciende";
				tonoshelp[3] = "Desciende la voz";

				function openModal(tono){
					$('#contenido-dialogo').empty();
					$('#contenido-dialogo').append(tonoshelp[tono-1]);
					$('#dialogo').modal('toggle');
				}

			</script>

  	</body>

<!-- Mirrored from minetheme.com/simplify1.0/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:36:07 GMT -->
</html>
