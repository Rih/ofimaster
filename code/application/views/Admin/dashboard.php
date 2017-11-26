<script type="text/javascript">
	datos_tabla = [];
	function llenarTabla(tabla){}
</script>

				<div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <a href="<?php echo  base_url().'?'.$type;?>/cuentas"><span class="label label-primary pull-right">Módulo</span></a>
                                    <h5><i class="fa fa-street-view" aria-hidden="true"></i> Usuarios</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?= $num_cuentas ?></h1>
                                    <div class="stat-percent font-bold text-primary">0% <i class="fa fa-level-up"></i></div>
                                    <small>Total Registrados</small>
                                </div>
                                <div class="ibox-title">
                                    <h5>Últimos Registrados</h5>
                                </div>
																<?php if(isset($ultimos_registrados) && $ultimos_registrados != false){

																			foreach($ultimos_registrados as $key => $vcat)
																			{

																					echo '<div class="ibox-content">';
					                                echo '    <div class="row">';
					                                echo '        <div class="col-xs-6">';
					                                echo '            <small class="stats-label">Nombre Rep.</small>';
					                                echo '            <h4>'.$vcat["name_legal_rep"].'</h4>';
					                                echo '        </div>';

					                                echo '        <div class="col-xs-6">';
					                                echo '            <small class="stats-label">Correo Electrónico</small>';
					                                echo '            <h4>'.$vcat["contact_mail"].'</h4>';
					                                echo '        </div>';
					                                echo '    </div>';
					                                echo '</div>';
																			}

																} ?>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <a href="<?php echo  base_url().'?'.$type;?>/archivos"><span class="label label-primary pull-right">Módulo</span></a>
                                    <h5><i class="fa fa-file-text" aria-hidden="true"></i> Digitales</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?= $num_catalogos ?></h1>
                                    <div class="stat-percent font-bold text-primary">0% <i class="fa fa-level-up"></i></div>
                                    <small>Total Archivos</small>
                                </div>
                                <div class="ibox-title">
                                    <h5>Últimos Archivos Cargados</h5>
                                </div>
																<?php if(isset($ultimos_catalogos) && $ultimos_catalogos != false){

                                      foreach($ultimos_catalogos as $key => $vcat)
                                      {

                                          echo '<div class="ibox-content">';
                                          echo '    <div class="row">';
                                          echo '        <div class="col-xs-7">';
                                          echo '            <small class="stats-label">Título</small>';
                                          echo '            <h4>'.$vcat["title"].'</h4>';
                                          echo '        </div>';

                                          echo '        <div class="col-xs-5">';
                                          echo '            <small class="stats-label">Categoría</small>';
                                          echo '            <h4>'.$vcat["name"].'</h4>';
                                          echo '        </div>';
                                          echo '    </div>';
                                          echo '</div>';
                                      }

                                } ?>


                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <a href="#"><span class="label label-primary pull-right">Módulo</span></a>
                                    <h5><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i> Descargas</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?= $num_descargas ?></h1>
                                    <div class="stat-percent font-bold text-primary">0% <i class="fa fa-level-up"></i></div>
                                    <small>Total Descargas</small>
                                </div>
                                <div class="ibox-title">
                                    <h5>Últimos Archivos Descargados</h5>
                                </div>
																<?php if(isset($catalogos_descargados) && $catalogos_descargados != false){

                                      foreach($catalogos_descargados as $key => $vcat)
                                      {

                                          echo '<div class="ibox-content">';
                                          echo '    <div class="row">';
                                          echo '        <div class="col-xs-6">';
                                          echo '            <small class="stats-label">Título</small>';
                                          echo '            <h4>'.$vcat["title"].'</h4>';
                                          echo '        </div>';

                                          echo '        <div class="col-xs-6">';
                                          echo '            <small class="stats-label">Categoría</small>';
                                          echo '            <h4>'.$vcat["name"].'</h4>';
                                          echo '        </div>';
                                          echo '    </div>';
                                          echo '</div>';
                                      }

                                } ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Comunicados</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content ibox-heading" style="text-align:center;">
                                    <h2 style="margin-bottom: 0px; font-size: 20px;"><i class="fa fa-envelope-o"></i> Últimos Comunicados</h2>
                                    <small><i class="fa fa-tim"></i> Comunicados publicados por la Administración de Ofimaster</small>
                                </div>
                                <div class="ibox-content">
                                    <div class="feed-activity-list">
                                        <div class="feed-element">
                                            <div>
                                                <small class="pull-right">00 Hrs. Atrás</small>
                                                <strong style="color:#e05337;">Ofimaster</strong>
                                                <div>El sistema de <strong>comunicados</strong> se encuentra temporalmente <strong>desactivado</strong>.</div>
                                                <small class="text-muted">Hace 00 días atrás a las 00:00PM - 00.00.0000</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content" style="border: none !important;">
                                    <a type="button" href="#" class="btn btn-warning inline-block destacado-btn" style="width:100%">
                                        Crear Comunicado
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Comunicados</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <iframe src="https://www.seethestats.com/stats/18246/Visitors_2e34a0f55_ifr.html" style="width:100%;height:250px;border:none;" scrolling="no" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>



                </div><!-- close wrapper -->
