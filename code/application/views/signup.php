<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>OFIMASTER(CL) | Panel de Control</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url();?>template/theme_inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg" style="background: url('<?php echo base_url();?>template/theme_inspinia/img/background-footer.png') top center no-repeat #e05337;">
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

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div class="div">
            <div class="div">
                <h1 class="logo-name"><img src="<?php echo base_url();?>template/theme_inspinia/img/logo.png"></h1>
                <h3 class="h3-1" style="margin-top: -20px;">¡Regístrese con Nosotros!</h3>
            </div>

            <div class="bs-example" style="margin-bottom:15px;">
                <div class="m-t-xs footer-text">
                    <p class="m-t" style="margin-top: 5px;">Para una buena funcionalidad de su cuenta de usuario dentro de la plataforma de Ofimaster, es de importancia ingresar correctamente los datos de que se solicitan en este formulario. Cualquier uso fraudulento o datos no verídicos resultará en una desactivación inmediata de la cuenta. La información registrada en esta plataforma es de su total responsabilidad.</p>
                </div>
            </div>

             <div class="div sign-up-form">
            <?php  if(isset($info)) echo $info; ?>
            <?php include 'page_info.php'; ?>
            <?php echo form_open('?Login/registrar/add',array('class' => 'm-t','id' => 'formValidate2'));?>

                <h3>DATOS DE REPRESENTANTE</h3>
                <div class="form-group m-bottom-md">
                    <input type="text" maxlength="150" data-parsley-required="true" name="name_legal_rep" class="form-control ch" placeholder="Nombre Representante Legal" autocomplete="on" required/>
                </div>

                <div class="form-group m-bottom-md">
                    <input type="text" maxlength="15" data-parsley-required="true" name="rut_legal_rep" onblur="validarRut(this,'rut1','btnsubmit')" class="form-control ch" placeholder="Rut Representante Legal (Ej: 11111111-1)" autocomplete="on" required/>
                    <p id="rut1" style="font-size:1.2em; color:white"></p>
                </div>
                <!--
                <div class="form-group m-bottom-md">
                    <input type="text" data-parsley-required="true" name="fono" class="form-control" placeholder="Teléfono Personal" pattern="^(\d+)$" autocomplete="on" required/>
                </div> -->
                <div class="form-group m-bottom-md">
                    <input type="text" maxlength="45" data-parsley-required="true" name="username" class="form-control ch" placeholder="Correo Electrónico" autocomplete="on" required/>
                </div>
                <div class="form-group m-bottom-md">
                    <input type="password" data-parsley-required="true" name="password" class="form-control ch" placeholder="Contraseña" autocomplete="off" required/>
                </div>
                <div class="form-group m-bottom-md" style="padding-bottom:20px;">
                    <input type="password" data-parsley-required="true" name="password_again" class="form-control ch" placeholder="Repita Contraseña" autocomplete="off" required/>
                </div>

                <h3 style="font-size: 13px; font-weight: bold;">DATOS DE LA EMPRESA</h3>
                <div class="form-group m-bottom-md">
                    <input type="text" maxlength="150" data-parsley-required="true" name="business_name" class="form-control ch" placeholder="Razon Social" autocomplete="on" required/>
                </div>
                <div class="form-group m-bottom-md">
                    <input type="text" maxlength="15" data-parsley-required="true" name="rut" onblur="validarRut(this,'rut2','btnsubmit')"  class="form-control ch" placeholder="RUT Empresa  (Ej: 11111111-1)" autocomplete="on" required/>
                    <p id="rut2" style="font-size:1.2em; color:white"></p>
                </div>
                <div class="form-group m-bottom-md">
                    <input type="text" maxlength="60" data-parsley-required="true" name="company_name" class="form-control ch" placeholder="Nombre Empresa" autocomplete="on" required/>
                </div>

                <div class="form-group m-bottom-md">
                    <input type="text" maxlength="70" data-parsley-required="true" name="line_of_business" class="form-control ch" placeholder="Giro" autocomplete="on" required/>
                </div>
                <div class="form-group m-bottom-md">
                        <input type="text" maxlength="15" data-parsley-required="true" name="contact_phone" class="form-control ch" placeholder="Fono Contacto" autocomplete="on" required/>
                </div>
                <div class="form-group m-bottom-md">
                    <input type="text" maxlength="50" data-parsley-required="true" name="city_state" class="form-control ch" placeholder="Ciudad" autocomplete="on" required/>
                </div>
                <div class="form-group m-bottom-md">
                    <input type="text" maxlength="50" data-parsley-required="true" name="position" class="form-control ch" placeholder="Su Cargo en la Empresa" autocomplete="on" required/>
                </div>

                <!--
                <div class="bs-example" style="margin-bottom:15px;">
                    <div class="m-t-xs footer-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                </div>
                -->

                <div class="form-group">
                    <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Estoy de acuerdo con los Términos y Políticas de Uso.</label></div>
                </div>

                <button id="btnsubmit" type="submit" class="btn btn-primary block full-width m-b">Registrarse</button>
                <?php echo form_close();?>
            </div>

            <div class="div" style="margin-top:40px; padding-bottom:70px;">
                <p class="max-title-sub" style="text-align: center; font-size: 24px; letter-spacing: -1.4px;">Si ya posee una cuenta aquí</p>
                <p class="max-title-sub" style="text-align: center; margin-top: 0px; letter-spacing: 0px;">ENTONCES PUEDE HACER INGRESO A LA PLATAFORMA</p>
                <p class="m-t" style="margin-top: 5px;">Si ya se encuentra registrado, tiene acceso a nuestra plataforma de usuario. Puede hacer click en el boton inferior de "Ingresar" y complete con los datos correspondiente que se le solicitan allí.</p>
                <a class="btn btn-register" href="<?php echo base_url()."?Login" ?>" data-toggle="modal">Ingresar</a>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url();?>template/theme_inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url();?>template/theme_inspinia/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>template/theme_inspinia/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.1/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Sep 2016 15:56:14 GMT -->
</html>
