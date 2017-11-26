
    
        <div class="wrapper no-navigation preload">
            <div class="error-wrapper">
                <div class="error-inner">
                    
                    <!-- <div class="error-type">404</div> -->
                    <h1  style="color:gray;font-size:850%;" >
                        404
                    </h1>
                    <h1>Página No Encontrada</h1>
                    <p>Al parecer la página que estás solicitando ya no existe.
                        Intenta escribir en la URL la dirección otra vez o comienza nuevamente desde la página del inicio.</p>
                    <div class="m-top-md">
                        <a href="<?php echo base_url().'?Questions/curr_question/'.$current_question;?>" class="btn btn-default btn-lg text-upper">Volver a la página correcta</a>
                    </div>
                </div><!-- ./error-inner -->
            </div><!-- ./error-wrapper -->
        </div><!-- /wrapper -->

        <a href="#" id="scroll-to-top" class="hidden-print"><i class="icon-chevron-up"></i></a>

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        
        <!-- Jquery -->

        <script>
            $(document).ready(function()    {
                $(function()    {
                    setTimeout(function() {
                        $('.error-type').addClass('animated');
                    },100);
                });   
            });

            
        </script>
  
