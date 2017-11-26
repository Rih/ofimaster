<?php

    $tbls = json_decode(_TABLES);
    $tbl = json_decode(_TABLE);


?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>OFIMASTER (CL) • <?php if(isset($page_title)) echo $page_title; ?></title>


    <link href="<?php echo base_url();?>template/theme_inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="<?php echo base_url();?>template/theme_inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>template/theme_inspinia/css/style.css" rel="stylesheet">


    <!-- App styles -->
    <!-- For Datepicker -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/jquery-ui-1.12.0/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>template/datepicker/css/datepicker.css"/>


    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>/favicon.ico?nocache=">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>/favicon.ico?nocache=" />
    <!-- JQUERY LIBRARY -->
    <script src="<?php echo base_url();?>template/theme_inspinia/js/jquery-2.1.1.js"></script>

    <!-- BORDEAR INPUT DE VALIDACION DE CAMPOS -->
    <style type="text/css">
        .valid_error{
            box-shadow: 0 0 4px #CC0000; margin: 3px;
            border: 2px solid;
            border-color: red;

        }
    </style>


    <?php $usr = $this->session->userdata('login_type'); ?>
    <script type="text/javascript">

        <?php echo 'usertype = "'.$usr.'";'; ?>
        function saveData(mode, name, uri, classnamevalidation, idclass){//mode = 1 add , 0 upd

            var text_callback = "#text_callback";
            var idShow = "#info_callback";
            var text_callback2 = ".text_callback";
            var idShow2 = ".info_callback";
            var datos = $(document).find("form[name='"+name+"']").serialize();
            //console.log(datos);

            if(validateFields(classnamevalidation,idclass)){
                $("#saveModalInput").prop("disabled",true);
                $.ajax({
                    url: uri,                  //the script to call to get data
                    data: datos,                        //you can insert url argumnets here to pass to api.php
                                                   //for example "id=5&parent=6"
                    method:"POST",
                    dataType: 'json',                //data format
                    success: function(data)          //on recieve of reply
                    {

                    //--------------------------------------------------------------------
                    // 3) Update html content
                    //--------------------------------------------------------------------
                        var num_ctg = data.num_catalogos;
                        var num_dsb = data.num_disabled_accs;
                        $(idShow).show();
                        $(idShow2).show();
                        $(text_callback).text(data.msg);
                        $(text_callback2).text(data.msg);
                        console.log(data.msg);
                        //console.log(data);
                        if(mode == 1){  clearFields();// limpia grilla si esta agregando
                        }
                        $(document).find("table[name='tablaGRID']").find("tbody").children().remove();
                        datos_tabla = data.tabla;
                        llenarTabla(data.tabla); //llena grilla
                        //$(document).find("input[name='distancia']").val(data);
                        $(".clear").first().focus();
                        $(idShow).hide(2000);
                        $(idShow2).hide(2000);
                        if (num_ctg > -1) $("#num_ctg").text(num_ctg);
                        if(num_dsb > -1) $("#num_dsb").text(num_dsb);
                        //$.each( data, function( id, val ) {
                          //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
                        //});

                        //$('#output').html(items.join("")); //Set output element html
                    //}
                      $("#saveModalInput").prop("disabled",false);
                    },
                    fail:function(data) {
                        $(idShow).show();
                        $(text_callback).text(data.msg);
                        $(idShow2).show();
                        $(text_callback2).text(data.msg);
                        $("#saveModalInput").prop("disabled",false);
                    }
                });

            }else{
                $(idShow).show();
                 $(text_callback).text("Llene los campos solicitados");
                 $(idShow2).show();
                  $(text_callback2).text("Llene los campos solicitados");
                 $("#saveModalInput").prop("enabled",true);
                 $(idShow).hide(3000);
                  $(idShow2).hide(3000);

            }
        }


        function modalChange(mode, url, nameform, data_title, data_text, idrow, idclass)
        { // mode = upd: 0, add: 1, del:-1
            var form = $(document).find("form[name='"+nameform+"']");
            data_title = data_title.replace(/\_/g," ");
            data_text = data_text.replace(/\_/g," ");
            $("#modal_text").text(data_text);
            $("#modal_title").text(data_title);
            form.attr("action",url);
            //alert("doc: "+document.chofer_cu.action);
            var idShow = "#info_callback";
            $(idShow).hide();
            if(mode == 2) //lleno perfil upd
            {
              limpiarDatosPerfil();
              if( idrow > 0 ) llenarDatosPerfil(idrow);
            }else
            {
              limpiarDatos();
              if( idrow > 0 ) llenarDatos(idrow);
            }



            //$("#saveModalInput2").attr("onclick","saveData("+mode+",'"+nameform+"','"+url+"')"); // habilitar
            if(mode == 2 ) $("#saveModalInput3").attr("onclick","saveData("+mode+",'"+nameform+"','"+url+"','validation',"+idclass+")"); //perfil
            else $("#saveModalInput").attr("onclick","saveData("+mode+",'"+nameform+"','"+url+"','validation',"+idclass+")"); // editar/guardar
        }
    </script>

</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=532314906786860";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Wrapper-->
<div id="wrapper">

    <?php include 'menu.php';   ?>

    <div id="page-wrapper" class="gray-bg">
        <?php include 'header.php'; ?>


    <!-- Main content-->
    <div class="row">
            <div class="container-fluid">

                <?php include $this->session->userdata('login_type').'/'.$page_name.'.php';?>
            </div>
    </div>
    <!-- End main content-->

    <?php include 'footer.php'; ?>

     </div> <!-- page-wrapper -->
</div>
<!-- End wrapper-->


<!-- Mainly scripts -->
<script src="<?php echo base_url();?>template/theme_inspinia/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>template/theme_inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>template/theme_inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>template/theme_inspinia/js/valida.Rut.min.js"></script>
<script src="<?php echo base_url();?>template/theme_inspinia/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url();?>template/theme_inspinia/js/inspinia.js"></script>
<script src="<?php echo base_url();?>template/theme_inspinia/js/plugins/pace/pace.min.js"></script>

<!-- iCheck -->
<script src="<?php echo base_url();?>template/theme_inspinia/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>


<!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){


        });

    </script>


<!-- Scripts -->
<script>
    $(document).ready(function () {

        llenarTabla(datos_tabla);

        /*$('#tableExample1').DataTable({
            "dom": 't'
        });

        $('#tableExample2').DataTable({
            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "lengthMenu": [ [6, 25, 50, -1], [6, 25, 50, "All"] ],
            "iDisplayLength": 6,
        });

        $('#tableExample3').DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
                {extend: 'copy',className: 'btn-sm'},
                {extend: 'csv',title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print',className: 'btn-sm'}
            ]
        });
        */

        $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
    });

</script>





<script>
    //SET DATEPICKER
    $(function() {


        $( "#datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true,
            numberOfMonths: 1,
            minDate: '0'  //deshabilitar fechas anteriores
         }).datepicker("setDate", "0"); //fecha actual

        $( "#datepicker_2" ).datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true,
            numberOfMonths: 1,
            minDate: '0'  //deshabilitar fechas anteriores
         }).datepicker("setDate", "0"); //fecha actual

         $.datepicker.regional['es'] = {

            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
              'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'],
            dayNamesShort: ['lu', 'ma', 'mi', 'ju', 'vi', 'sa', 'do'],
            dayNamesMin: ['lu', 'ma', 'mi', 'ju', 'vi', 'sa', 'do'],
            dateFormat: 'yy/mm/dd',
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);

    });



    //LIMPIEZA CAMPOS
    function clearFields(){
        $(".clear").each(function(){
            valid = clearField(this);
            //alert($(this).attr("name") + "--> "+$(this).val());
        });
    }
    function clearField(selector){
        var valid = true;
        if ($(selector).is("SELECT")){
            $(selector).find("option[value='-1']").prop("selected",true);
            //alert("is select!");
        }else if($(selector).is("INPUT")){
            $(selector).val("");
        }else if($(selector).is("TEXTAREA")){
            $(selector).val("");
        }

        return valid;
    }


    // VALIDACION DE CAMPOS
    function validateField(selector){
        var valid = true;
        if ($(selector).is("SELECT")){
            if($(selector).val() == -1){
                valid = false;
                $(selector).addClass("valid_error");
            }else{
                $(selector).removeClass("valid_error");
            }
            //alert("is select!");
        }else if($(selector).is("INPUT")){
            if($(selector).val() == ""){
                valid = false;
                $(selector).addClass("valid_error");
            }else{
                $(selector).removeClass("valid_error");
            }
        }else if($(selector).is("TEXTAREA")){
            if($(selector).val() == ""){
                valid = false;
                $(selector).addClass("valid_error");
            }else{
                $(selector).removeClass("valid_error");
            }
        }

        return valid;
    }


    function validateFields(classname, idclass){
        var valid = true;
        var validAcc = true;

        idcls = (idclass === undefined)?"":idclass.toString();

        $("." + classname + idcls).each(function(){
            valid = validateField(this);
            //alert($(this).attr("name") + "--> "+$(this).val());
        });

        if(valid){
            $("#form_data").submit();
            $("#error_msg").hide();
        }
        else{
            $("#error_msg").show();
        }
        return valid;
    }


</script>




</body>
</html>
