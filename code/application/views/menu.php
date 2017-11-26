    <?php
                    $adm = $this->session->userdata('admin_login');
                    $usr = $this->session->userdata('user_login');
                    $type = $this->session->userdata('login_type');
                    $enabled = $this->session->userdata('enabled');
    ?>
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <a href="<?php echo  base_url()."?".$type;?>/dashboard">
                                <img alt="image" class="img-circle" src="<?php echo base_url();?>template/theme_inspinia/img/logo-min.png" />
                            </a>
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs header-name">
                                <?= $nombre_rep_legal ?>
                                </span>
                                <span class="text-muted text-xs block" style="color:#FFF;">
                                <?= $nombre_empresa ?> <b class="caret"></b>
                                </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs perfil-menu">
                            <li><a href="<?php echo base_url().'?'.$type;?>/misdatos"><i class="fa fa-user" aria-hidden="true"></i> Perfil de Usuario</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= base_url().'?Login/logout' ?>"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Desconectarse</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <img alt="image" class="img-circle" src="<?php echo base_url();?>template/theme_inspinia/img/logo-min.png" />
                    </div>
                </li>



                <?php if ($adm  == 1){ ?>

                <li>
                    <a href="<?php echo  base_url()."?".$type;?>/dashboard"><i class="fa fa-home" aria-hidden="true"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> <span class="nav-label">Usuarios</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo  base_url().'?'.$type;?>/hab_cuentas" class="dest-item-menu">
                                <span class="badge circle-badge pull-right" id="num_dsb"><?php if(isset($num_cuentas_deshabilitadas)) echo $num_cuentas_deshabilitadas; ?></span> Habilitar Cuentas
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo  base_url().'?'.$type;?>/cuentas">
                                Lista de Usuarios
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo  base_url().'?'.$type;?>/clientes">
                                Gestion de Clientes
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cloud-download" aria-hidden="true"></i> <span class="nav-label">Digitales</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo  base_url().'?'.$type;?>/archivos">
                                <!-- <span class="badge pull-right"><?php if(isset($num_archivos)) echo $num_archivos; ?></span> -->
                                <span class="badge circle-badge pull-right" id="num_ctg"><?php if(isset($num_catalogos)) echo $num_catalogos; ?></span> Gestión de Archivos
                            </a>
                        </li>
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
                    </ul>
                </li>
                <li>
                    <a href="<?php echo  base_url().'?'.$type;?>/reportes"><i class="fa fa-table" aria-hidden="true"></i> <span class="nav-label">Reportes e Informes</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">
                                Resumen General
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Reporte de Usuarios
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Reporte de Descargas
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- ============================
                .2 MENU TRANSPORTISTA
                ============================= -->

                <?php }else if($usr == 1){
                    if($type == EMPRESA){
                ?>

                <li>
                    <a href="<?php echo  base_url()."?".$type;?>/dashboard"><i class="fa fa-home" aria-hidden="true"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                  <? if($enabled == 1){ ?>
                    <li>
                        <a href="#"><i class="fa fa-archive" aria-hidden="true"></i> <span class="nav-label">Productos</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="<?php echo  base_url().'?'.$type;?>/catalogos">
                                    <span class="badge circle-badge pull-right" id="num_ctg"><?php if(isset($num_catalogos)) echo $num_catalogos; ?></span> Catálogos Descargables
                                </a>
                            </li>
                        </ul>
                    </li>
                  <?php } ?>
                <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </nav>
