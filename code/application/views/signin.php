<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>OFIMASTER(CL) | Panel de Control</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   
    <link rel="stylesheet" href="<?php echo base_url();?>template/theme_inspinia/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/theme_inspinia/css/animate.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/theme_inspinia/css/style.css"/> 
</head>
<body class="gray-bg" style="background: url('<?php echo base_url();?>template/theme_inspinia/img/background-footer.png') top center no-repeat #e05337;">
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div class="div">
        <div class="div">
            <h1 class="logo-name"><img src="<?php echo base_url();?>template/theme_inspinia/img/logo.png"></h1>
            <h3 class="h3-1" style="margin-top:-45px">Bienvenido a Ofimaster</h3>
        </div>
        
        <?php include 'page_info.php'; ?>
        <?php echo form_open('?Login',array('id' => 'formValidate2'));?>
        <div class="form-group">
            <label class="control-label" for="username">Correo Electrónico</label>
            <input type="email" data-parsley-required="true" placeholder="correo@correo.cl" title="Please enter you username" required="" value="" name="email" id="username" class="form-control ch" style="margin-top: 5px;">
        </div>
        <div class="form-group">
            <label class="control-label" for="password">Contraseña</label>
            <input type="password" data-parsley-required="true" title="Please enter your password" placeholder="*********" required="" value="" name="password" id="password" class="form-control ch" style="margin-top: 5px;">
        </div>
        <div class="form-group">
            <button  class="btn btn-primary block full-width">Ingresar</button>
        </div>
        <?php echo form_close();?>
        <div class="div" style="margin-top: 30px;">
            <a class="btn btn-recover" href="<?php echo base_url()."?Login/recuperar" ?>" data-toggle="modal"><i class="fa fa-lock" aria-hidden="true"></i> Recuperar Contraseña</a>
        </div>

        <div class="div">
            <p class="max-title-sub" style="text-align: center; font-size: 24px; letter-spacing: -0.4px;">REGÍSTRESE CON OFIMASTER</p>
            <p class="max-title-sub" style="text-align: center; margin-top: 0px; letter-spacing: -0.2px;">TENGA ACCESO A NUESTRO CATÁLOGO DE PRODUCTOS</p>
            <p class="m-t" style="margin-top: 5px;">Regístrese y estará creando una cuenta de usuario para su empresa o como persona natural en nuestra plataforma. Tendrá acceso completo a nuestro catálogo de productos y a diferentes funcionalidades que le permitirán trabajar de mejor manera con nosotros. ¡Solo toma 30 Segundos!</p>
            <a class="btn btn-register" href="<?php echo base_url()."?Login/registrar" ?>" data-toggle="modal">Registrarse</a>
        </div>
    </div>
</div>


<!-- Vendor scripts -->

<script src="<?php echo base_url();?>template/codemakers/theme_inspinia/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url();?>template/codemakers/theme_inspinia/js/bootstrap.min.js"></script>




</body>
</html>