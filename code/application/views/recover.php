<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFIMASTER(CL) | Recuperacion Cuenta</title>

    <link href="<?php echo base_url();?>template/theme_inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg" style="background: url('<?php echo base_url();?>template/theme_inspinia/img/background-footer.png') top center no-repeat #e05337;">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div class="div">
            <div class="div">
                <h1 class="logo-name"><img src="<?php echo base_url();?>template/theme_inspinia/img/logo.png"></h1>
                <h3 class="h3-1" style="margin-top:-20px">Recupere su Contraseña</h3>
            </div>

            <div class="div sign-up-form">
                <?php if(isset($token_stage)) { ?>
                <?php echo form_open('?Login/recuperar/reset/'.$idacc.'/'.$token,array('id' => 'formValidate2'));?>
                    <div class="form-group">
                        <label class="control-label" for="password">Contraseña</label>
                        <input type="password" data-parsley-required="true" title="Please enter your new password" placeholder="*********" required="" value="" name="password" id="password" class="form-control ch">
                        <span class="help-block small" style="color:#FFF">Ingrese una nueva contraseña para su cuenta</span>
                    </div>
                    <div>
                        <button class="btn btn-accent" style="color:#f6a821;">Renovar</button>
                    </div>
                <?php echo form_close();?>
                
                <?php } else if(isset($email_stage)){ ?>
                <?php echo form_open('?Login/recuperar/send',array('id' => 'formValidate2'));?>
                    
                    <div class="form-group">
                        <label class="control-label" for="password">Correo Electrónico</label>
                        <input type="email" data-parsley-required="true" title="Please enter your new email" placeholder="correo@correo.cl" required="" value="" name="username" id="username" class="form-control ch">
                        <span class="help-block small" style="color:#FFF">Ingrese el correo electrónico con que registró su cuenta</span>
                    </div>
                    <div>
                        <button class="btn btn-primary block full-width">Aceptar</button>
                    </div>
                <?php echo form_close();?>
            <?php } ?>
            <p class="m-t" style="margin-top: 40px;">
                Si tiene problemas para ingresar o no recuerda la contraseña de su cuenta, podrá recuperarla solo ingresando su correo electrónico y configurar una nueva, el cambio es automático y de manera inmediata.
            </p>
            <a class="btn btn-register" href="<?php echo base_url()."?Login" ?>" data-toggle="modal">Ingresar</a>

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



