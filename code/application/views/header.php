    <!-- Header-->
    <?php 
        $usr = $this->session->userdata('login_type'); 
    ?>
   <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <!--
                <form role="search" class="navbar-form-custom" action="#">
                    <div class="form-group">
                        <input type="text" placeholder="Buscar en la plataforma..." class="form-control" name="top-search" id="top-search">
                    </div>
                </form>
                -->
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i> <span class="label label-warning">0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <div class="media-body">
                                    <small class="pull-right">00 Hrs.</small>
                                    El sistema de <strong>comunicados</strong> se encuentra temporalmente <strong>desactivado</strong>.<br>
                                    <small class="text-muted">Hace 00 días atrás a las 00:00PM - 00.00.0000</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="#">
                                    <strong> Todos Los Comunicados</strong> <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary" style="background-color: #b03e27; margin-top:0px;">0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <div class="media-body">
                                    <small class="pull-right">00 Hrs.</small>
                                    Las <strong>alertas de registro</strong> se encuentran temporalmente <strong>desactivadas</strong>.<br>
                                    <small class="text-muted">Hace 00 días atrás a las 00:00PM - 00.00.0000</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="#">
                                    <strong> Todos Las Alertas</strong> <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="http://www.ofimaster.cl" target="_blank">
                        <i class="fa fa-globe" aria-hidden="true"></i> Website
                    </a>
                </li>

                <li>
                    <a href="<?= base_url().'?Login/logout' ?>">
                        <i class="fa fa-times-circle-o" aria-hidden="true"></i> Desconectarse
                    </a>
                </li>
            </ul>

        </nav>

    </div>
<!-- End header-->

