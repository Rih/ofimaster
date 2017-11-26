<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Strong Passwd Mgmt • <?php if(isset($page_title)) echo $page_title; ?></title>
    <meta name="robots" content="noindex, nofollow">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>/favicon.ico?nocache=">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>/favicon.ico?nocache=" />

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url();?>template/theme/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <!-- <link href="<?php echo base_url();?>template/theme/css/font-awesome.min.css" rel="stylesheet"> -->
        <link href="<?php echo base_url();?>template/theme/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- ionicons -->
        <link href="<?php echo base_url();?>template/theme/css/ionicons.min.css" rel="stylesheet">
        
        <!-- Morris -->
        <link href="<?php echo base_url();?>template/theme/css/morris.css" rel="stylesheet"/>   

        <!-- Datepicker -->
        <link href="<?php echo base_url();?>template/theme/css/datepicker.css" rel="stylesheet"/>   

        <!-- Animate -->
        <link href="<?php echo base_url();?>template/theme/css/animate.min.css" rel="stylesheet">

        <!-- Owl Carousel -->
        <link href="<?php echo base_url();?>template/theme/css/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>template/theme/css/owl.theme.default.min.css" rel="stylesheet">

        <!-- datatable -->
        <link href="<?php echo base_url();?>template/theme/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- Simplify -->
        <link href="<?php echo base_url();?>template/theme/css/simplify.min.css" rel="stylesheet">

        <?php $pages = array("registered_users",
                        "services",
                        "approvalservices",
                        "myservices"
            );
            $pageforms = array("requestservice",
                    "createservice",
                    "vinculateservice"
                );
        if (in_array($page_name,$pages)){
        ?>
        <!-- Page styles -->
        <link type='text/css' href='<?php echo base_url();?>template/css/demo.css' rel='stylesheet' media='screen' />
    
        <!-- Confirm CSS files -->
        <link type='text/css' href='<?php echo base_url();?>template/css/confirm.css' rel='stylesheet' media='screen' />
        <?php }
        ?>

    
    </head>

    <body class="overflow-hidden">

        <div class="wrapper preload">
            <?php include 'sidebar_right.php'; ?>

            <?php include 'header.php'; ?>
        
            <?php include 'menu.php';   ?>
            
            

            <?php include $this->session->userdata('login_type').'/'.$page_name.'.php';?>
           
            <?php include 'footer.php'; ?>
            
        </div><!-- /wrapper -->

        <a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>

        
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        
        <!-- Jquery -->
        <script src="<?php echo base_url();?>template/theme/js/jquery-1.11.3.min.js"></script>
        
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>template/theme/bootstrap/js/bootstrap.min.js"></script>
      
        <?php         
        if (in_array($page_name,$pages)){
        ?>
              <!-- Datatable -->
            
            <script src='<?php echo base_url();?>template/theme/js/jquery.dataTables.min.js'></script>
            <script src='<?php echo base_url();?>template/theme/js/uncompressed/dataTables.bootstrap.js'></script>


        <?php   }  ?>

        <?php if($page_name =='myservices'): ?>

            <input type="hidden" name="token"></input>
            <script type="text/javascript">
            
            $(document).ready(function($) {
                 

                 //allowing ajax request via csrf token permission
                //START SETUP
                /*$.ajaxSetup({data: {token: CFG.token}});
                $(document).ajaxSuccess(function(e,x) {
                    var result = $.parseJSON(x.responseText);
                    $('input:hidden[name="token"]').val(result.token);
                    $.ajaxSetup({data: {token: result.token}});
                });*/
                //END SETUP

                });
            </script>
            <script id="source" language="javascript" type="text/javascript">
              /*function viewpassword(id) 
              {
                //-----------------------------------------------------------------------
                // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
                //-----------------------------------------------------------------------
                var servid = id;
                console.log("starting ajax request");
                 $.ajax({                       
                    url: "<?php echo base_url();?>index.php/user/viewpassword",                  //the script to call to get data          
                    data: "serv_id=" + servid,                        //you can insert url argumnets here to pass to api.php
                                                   //for example "id=5&parent=6"
                    dataType: 'json',                //data format      
                    success: function(data)          //on recieve of reply
                    {
                        var pass = data[0];              //get id       
                        var obj = jQuery.parseJSON(json); 
                        //--------------------------------------------------------------------
                        // 3) Update html content
                        //--------------------------------------------------------------------
                        $('#output').html("<b>id: </b>"+pass); //Set output element html
                        
                        //recommend reading up on jquery selectors they are awesome 
                        // http://api.jquery.com/category/selectors/
                    } 
                }).done(function() {
                    alert( "success" );
                  }); 
                
                $.post('<?php echo base_url()?>index.php/ajax/foo',function(data) {
                    console.log(data);
                    alert("SUCCESS?");
                }, 'json');
                
                $.ajax({
                type:"post",
                url: CFG.url+"index.php/user/viewpassword", 
                data: 'serv_id=' + servid, //name1 is the name of the parameter that send, something similar to name1=val1&name2=val2
                dataType: "json",
                success: function(data){   
                        try{                            
                            alert("success??");
                            $.each(data.items, function(i,item){
                                alert("value: "+item.value+" name: "+item.name); //item.value e item.name because in the data object the information is set in this way: [{value:name},{value:name}...]
                            });
                        }catch(e) { alert('Exception while request..'); }       
                    },
                    error: function(){ alert('Error while request..'); }
                 });
              }; */
            </script>
        <?php endif; ?>

       
        <!-- Flot -->
        <script src='<?php echo base_url();?>template/theme/js/jquery.flot.min.js'></script>

        <!-- Slimscroll -->
        <script src='<?php echo base_url();?>template/theme/js/jquery.slimscroll.min.js'></script>
        
        <!-- Morris -->
        <script src='<?php echo base_url();?>template/theme/js/rapheal.min.js'></script>    
        
        <script src='<?php echo base_url();?>template/theme/js/morris.min.js'></script> 

        <!-- Datepicker -->
        <script src='<?php echo base_url();?>template/theme/js/uncompressed/datepicker.js'></script>

        <!-- Sparkline -->
        <script src='<?php echo base_url();?>template/theme/js/sparkline.min.js'></script>

        <!-- Skycons -->
        <script src='<?php echo base_url();?>template/theme/js/uncompressed/skycons.js'></script>
        
        <!-- Popup Overlay -->
        <script src='<?php echo base_url();?>template/theme/js/jquery.popupoverlay.min.js'></script>

        <!-- Easy Pie Chart -->
        <script src='<?php echo base_url();?>template/theme/js/jquery.easypiechart.min.js'></script>

        <!-- Sortable -->
        <script src='<?php echo base_url();?>template/theme/js/uncompressed/jquery.sortable.js'></script>

      
        <!-- Owl Carousel -->
        <script src='<?php echo base_url();?>template/theme/js/owl.carousel.min.js'></script>

        <!-- Modernizr -->
        <script src='<?php echo base_url();?>template/theme/js/modernizr.min.js'></script>
        
        <!-- Simplify -->
        <script src="<?php echo base_url();?>template/theme/js/simplify/simplify.js"></script>
        
        <script src="<?php echo base_url();?>template/theme/js/simplify/simplify_dashboard.js"></script>

        <?php 
            if(in_array($page_name,$pageforms)){

        ?>
        <!-- Confirm -->        
        <script src='<?php echo base_url();?>template/js/jquery.simplemodal.js' type='text/javascript'></script>
        <script src='<?php echo base_url();?>template/js/confirm.js' type='text/javascript'></script>

        <script src="<?php echo base_url();?>template/theme/js/parsley.min.js"></script>
        
        <script language="javascript" type="text/javascript">

            $(function()    {
                

                //Delete Widget Confirmation
                $('#deleteWidgetConfirm').popup({
                    vertical: 'top',
                    pagecontainer: '.container',
                    transition: 'all 0.3s'
                });

                //Form Validation
                $('#basic-constraint').parsley( { listeners: {
                    onFormSubmit: function ( isFormValid, event ) {
                        if(isFormValid) {
                            return false;
                        }
                    }
                }}); 
                
                $('#type-constraint').parsley( { listeners: {
                    onFormSubmit: function ( isFormValid, event ) {
                        if(isFormValid) {
                            return false;
                        }
                    }
                }}); 
                 
                $('#formValidate1').parsley( { listeners: {
                    onFormSubmit: function ( isFormValid, event ) {
                        if(isFormValid) {
                            alert('Registration Complete');
                            return false;
                        }
                    }
                }}); 
                
                $('#formValidate2').parsley( { listeners: {
                    onFieldValidate: function ( elem ) {
                        // if field is not visible, do not apply Parsley validation!
                        if ( !$( elem ).is( ':visible' ) ) {
                            return true;
                        }

                        return false;
                    },
                    onFormSubmit: function ( isFormValid, event ) {
                        if(isFormValid) {
                            alert('Your message has been sent');
                            return false;
                        }
                    }
                }}); 
            }); 
            $('#btnpwd').click(function(){
                var type = $('#pwd').attr('type');
                //alert(type);
                if(type == 'password'){
                    $('#pwd').attr('type','text');
                    $('#iconeye').attr('class','fa fa-eye-slash');
                }else{
                    $('#pwd').attr('type','password');
                    $('#iconeye').attr('class','fa fa-eye');
                }
            });  
        </script>

        <?php }  ?>
        
        <script language="javascript" type="text/javascript">
           
           $(function(){
                //Owl Carousel
                $('.custom-carousel2').owlCarousel({
                    items:1,
                    loop:true,
                    autoplay:true,
                    autoplayTimeout:2000,
                    autoplayHoverPause:true,
                    stagePadding:0,
                    smartSpeed:450,
                    dots: false
                });

                $('.custom-carousel3').owlCarousel({
                    animateOut: 'fadeOut',
                    animateIn: 'fadeInDown',
                    items:1,
                    loop:true,
                    autoplay:true,
                    autoplayTimeout:2000,
                    autoplayHoverPause:true,
                    stagePadding:0,
                    smartSpeed:450
                });

           });
           
            $(document).ready(function(){
                $('.chart').easyPieChart({
                    easing: 'easeOutBounce',
                    size: '140',
                    lineWidth: '7',
                    barColor: '#7266ba',
                    onStep: function(from, to, percent) {
                        $(this.el).find('.percent').text(Math.round(percent));
                    }
                });

                $('.sortable-list').sortable();

                
            });

           
            
        </script>


    </body>

<!-- Mirrored from minetheme.com/simplify1.0/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Jan 2015 22:35:13 GMT -->
</html>


      
