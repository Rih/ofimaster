	<!-- Navigation-->
    <aside class="navigation">
        <nav>
            <ul class="nav luna-nav">
                
                <?php 
					$adm = $this->session->userdata('admin_login');
					$usr = $this->session->userdata('user_login');
					$type = $this->session->userdata('login_type');
                    $enabled = $this->session->userdata('enabled');
				?>
                
                <?php if ($adm  == 1){
                ?>


                <li class="active">
                    <a href="<?php echo  base_url()."?".$type;?>/dashboard">Dashboard <i class="fa fa-home" aria-hidden="true"></i></a>
                </li>
                <li class="nav-category">Registros de Usuarios</li>
                <!-- <li><a href="<?php echo  base_url().'?'.$type;?>/misdatos">Mi Perfil</a></li>  -->
                <li>
                    <a href="#" class="dest-item-menu">
                        <span class="badge pull-right">0</span> Cuentas por Habilitar
                    </a>
                </li> 
                <li style="border-bottom: 1px dashed rgb(75, 75, 75); padding-bottom: 10px;">
                    <a href="<?php echo  base_url().'?'.$type;?>/cuentas">
                        <span class="badge pull-right"><?php if(isset($num_cuentas)) echo $num_cuentas; ?></span> Cuentas de Usuarios
                    </a>
                </li>  



                <li class="nav-category">Administrar Opciones</li>    

                <li>
                    <a href="<?php echo  base_url().'?'.$type;?>/familias">
                        <!-- <span class="badge pull-right"><?php if(isset($num_archivos)) echo $num_archivos; ?></span> --> 
                        Familias
                    </a>
                </li>

                <li>
                    <a href="<?php echo  base_url().'?'.$type;?>/categorias">
                        <!-- <span class="badge pull-right"><?php if(isset($num_archivos)) echo $num_archivos; ?></span> --> 
                        Categorias
                    </a>
                </li>                                      
                <li>
                    <a href="<?php echo  base_url().'?'.$type;?>/archivos">
                        <!-- <span class="badge pull-right"><?php if(isset($num_archivos)) echo $num_archivos; ?></span> --> 
                        Archivos
                    </a>
                </li>
                 <li>
                    <a href="<?php echo  base_url().'?'.$type;?>/ciudades">
                        <!-- <span class="badge pull-right"><?php if(isset($num_ciudades)) echo $num_ciudades; ?></span> -->
                        Reportes
                    </a>
                </li>
               
               <li class="nav-category">Mi Cuenta</li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/misdatos">Perfil de Usuario</a></li>

                <li class="nav-info">
                    <i class="pe pe-7s-shield text-accent"></i>
                    <div class="m-t-xs footer-text">
                        © Todos Derechos Reservados a Ofimaster - 2016. Queda absolutamente prohibida la reproducción total o parcial de cualquier material, código o información expuesta en esta plataforma de gestión. Todas las acciones realizadas en la plataforma, son de exclusiva responsabilidad del propio usuario, el cual hace ingreso con su respectivo correo electrónico y contraseña.
                    </div>
                    <p style="text-align:left; margin-top:5px;">
                        <a href="http://www.ofimaster.cl" target="_blank">
                            <img src="http://www.ofimaster.cl/static/codemakersf6a821.png">
                        </a>
                    </p>
                </li>


                <!-- ============================
                .2 MENU TRANSPORTISTA 
                ============================= -->

				<?php }else if($usr == 1){ 
					if($type == TRANSPORTISTA){
				?>

                <li class="active"><a href="<?php echo  base_url()."?".$type;?>/dashboard">Principal <i class="fa fa-home" aria-hidden="true"></i></a></li>

               
                
                <li class="nav-category">Panel de Control</li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/catalogos" class="dest-item-menu" style="border-bottom: 1px dashed #fff;">Catalogo Productos <i class="fa fa-calendar" aria-hidden="true"></i></a></li>
                
                <li class="nav-category">Mi Cuenta</li>
                <li><a href="<?php echo  base_url().'?'.$type;?>/misdatos">Perfil de Usuario</a></li>
                

                <li class="nav-info">
                    <i class="pe pe-7s-shield text-accent"></i>
                    <div class="m-t-xs footer-text">
                    © Todos Derechos Reservados a Ofimaster - 2016. Queda absolutamente prohibida la reproducción total o parcial de cualquier material, código o información expuesta en esta plataforma de gestión. Todas las acciones realizadas en la plataforma, son de exclusiva responsabilidad del propio usuario, el cual hace ingreso con su respectivo correo electrónico y contraseña.
                    </div>
                    <p style="text-align:left; margin-top:5px;"><a href="http://www.ofimaster.cl" target="_blank"><img src="http://www.ofimaster.cl/static/codemakersf6a821.png"></a></p>
                </li>

                <?php } ?>
                <?php } ?>
            </ul>
        </nav>
    </aside>
    <!-- End navigation-->


























