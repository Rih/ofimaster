    <!-- Header-->
    <?php 
     $usr = $this->session->userdata('login_type'); 
    ?>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <div id="mobile-menu">
                    <div class="left-nav-toggle">
                        <a href="#">
                            <i class="stroke-hamburgermenu"></i>
                        </a>
                    </div>
                </div>
                <a class="navbar-brand" href="<?php echo  base_url()?>?transportista/dashboard">
                    <img src="<?php echo base_url();?>template/codemakers/images/logo.png">
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div class="left-nav-toggle">
                    <a href="#">
                        <i class="stroke-hamburgermenu"></i>
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" style="background: rgb(246, 168, 33) !important; color: #FFF !important;">
                            <i class="fa fa-circle-o" aria-hidden="true" style="padding-right:5px;"></i> 
                            <?php if($usr == "Transportista") echo "Transportista";
                                else if($usr == "GeneradorCarga") echo "Generador de Carga";
                                else  echo "Administrador";
                             ?>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#">Website</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" style="border-right:1px dotted #c5c5c5;">Planes</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" ><i class="fa fa-envelope" aria-hidden="true" style="font-size: 13px !important;"></i>
                            <span class="label label-warning pull-right">2</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" style="border-right:1px dotted #c5c5c5;padding-left: 0;">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo base_url().'?'.$usr.'/misdatos'; ?>">Perfil</a>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo base_url().'?'.$usr.'/logout'; ?>">Logout</a>
                    </li>
                </ul>
               
                <!--
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#">Portal
                        </a>
                    </li>
                    <li class="dropdown">
                    	<a href="#">
							<i class="fa fa-expand" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" ><i class="fa fa-envelope" aria-hidden="true"></i>
                            <span class="label label-warning pull-right">2</span>
                        </a>
                    </li>
                </ul>
                -->
            </div>
        </div>
    </nav>
    <!-- End header-->