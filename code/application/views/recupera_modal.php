    <?php 
        
        $uriadd = "?Login/recuperar";
    ?>
    <?php echo form_open($uriadd,array('id' => 'formValidate1','name' => 'cuenta_cu'));?>   

            <div class="modal-body">
                <div class="row">           
                    <div class="form-group m-bottom-md">
                        <input type="text" data-parsley-required="true" name="Muser" class="form-control" placeholder="Correo..." autocomplete="off"/>
                    </div>
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                
                <input type="submit" value="Aplicar" class="btn btn-accent" />
            </div>
            <?php echo form_close();?>
        

        <script type="text/javascript">
            
            function set_visibility(value, id_div){

                var div = "gps_txt";
                alert("asdf");
                var div_txt = (id_div == 1)? "gps_txt":((id_div == 2)?"seg_carga_txt":"");
                //alert(div_txt);
                var input = $(document).find("input[id='"+div_txt+"']");

                if(value.checked){  
                    console.log($(input));
                    console.log($(input).val());
                    alert("akiiii   "+typeof(input) + ' - '+$(input));      
                    //div_txt.style.visibility = "visible";
                    //div_txt.style.display = "in-line";
                    $(input).show();
                }
                else{           
                    alert("akaaaaa   " + $(input).attr("name"));        
                    //div_txt.style.visibility = "hidden";
                    //div_txt.style.display = "none";
                    $(input).hide();
                }
            }


        </script>