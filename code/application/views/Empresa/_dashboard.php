
                <div class="wrapper wrapper-content">
                  <?php if($enabled == 0){ ?>
                    <div class="row">
                        <div class="ibox float-e-margins">
                          <div class="ibox-title">
                              <h5><i class="fa fa-file-text" aria-hidden="true"></i> Información</h5>
                          </div>
                          <div class="ibox-content">
                              <h1 class="no-margins">Su cuenta esta deshabilitada, debe esperar que sea habilitada por un administrador para acceder a nuestros Catálogos.</h1>

                          </div>
                        </div>
                    </div>
                  <?php } ?>
                    <div class="row">

                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                  <?php if($enabled == 1){ ?>
                                  <a href="<?php echo  base_url().'?'.$type;?>/archivos"><span class="label label-primary pull-right">Módulo</span></a>
                                  <?php } ?>
                                    <h5><i class="fa fa-file-text" aria-hidden="true"></i> Descargables</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?= $num_catalogos ?></h1>
                                    <div class="stat-percent font-bold text-primary">0% <i class="fa fa-level-up"></i></div>
                                    <small>Total Archivos Disponibles</small>
                                    
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

                                          echo '        <div class="col-xs-4">';
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
                                    <small>Total de Descargas Realizadas</small>
                                </div>
                                <div class="ibox-title">
                                    <h5>Mis Últimos Archivos Descargados</h5>
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


                        <div class="col-lg-4" style="opacity: 0.5;">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <a href="#"><span class="label label-primary pull-right">Módulo Desactivado</span></a>
                                    <h5><i class="fa fa-money" aria-hidden="true"></i> Cotizaciones</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">$0</h1>
                                    <div class="stat-percent font-bold text-primary">0% <i class="fa fa-level-up"></i></div>
                                    <small>Total Cotizado</small>
                                </div>
                                <div class="ibox-title">
                                    <h5>Últimas Cotizaciones Realizadas</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <small class="stats-label">#ID. Orden</small>
                                            <h4>Desactivado</h4>
                                        </div>

                                        <div class="col-xs-6">
                                            <small class="stats-label">Monto</small>
                                            <h4>$000.000</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <small class="stats-label">#ID. Orden</small>
                                            <h4>Desactivado</h4>
                                        </div>

                                        <div class="col-xs-6">
                                            <small class="stats-label">Monto</small>
                                            <h4>$000.000</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <small class="stats-label">#ID. Orden</small>
                                            <h4>Desactivado</h4>
                                        </div>

                                        <div class="col-xs-6">
                                            <small class="stats-label">Monto</small>
                                            <h4>$000.000</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <small class="stats-label">#ID. Orden</small>
                                            <h4>Desactivado</h4>
                                        </div>

                                        <div class="col-xs-6">
                                            <small class="stats-label">Monto</small>
                                            <h4>$000.000</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <small class="stats-label">#ID. Orden</small>
                                            <h4>Desactivado</h4>
                                        </div>

                                        <div class="col-xs-6">
                                            <small class="stats-label">Monto</small>
                                            <h4>$000.000</h4>
                                        </div>
                                    </div>
                                </div>
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
                                    <h3 style="margin-bottom: 0px;">Últimos Comunicados</h3>
                                    <small>Comunicados publicados por la Administración de Ofimaster</small>
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
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Últimas Noticias</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content ibox-heading" style="text-align:center;">
                                    <h3 style="margin-bottom: 0px;">DESDE NUESTRO BLOG</h3>
                                    <small>Noticias y Actualidad desde nuestro Sitio Web</small>
                                </div>
                                <div class="ibox-content inspinia-timeline">

                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <a href="http://www.ofimaster.cl/page/alianza-se-formalizo-evento-realizado-grupo-santa-victoria/" target="_blank">
                                                    <i class="fa fa-briefcase" style="color:#e05337;"></i>
                                                </a>
                                                Sep. 27 2016
                                                <br/>
                                                <a href="http://www.ofimaster.cl/page/alianza-se-formalizo-evento-realizado-grupo-santa-victoria/" target="_blank">
                                                    <small class="text-navy" style="color:#e05337;">Ofimaster</small>
                                                </a>
                                            </div>
                                            <div class="col-xs-7 content no-top-border">
                                                <p class="m-b-xs">
                                                    <a href="http://www.ofimaster.cl/page/alianza-se-formalizo-evento-realizado-grupo-santa-victoria/" target="_blank">
                                                        <strong style="color:#e05337;">Alianza se formalizó en Evento Realizado con...</strong>
                                                    </a>
                                                </p>
                                                <p>Grupo Santa Victoria exclusiva distribuidora que introdujo en Chile el concepto del café espresso de calidad.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <a href="http://www.ofimaster.cl/page/nueva-alianza-ofimaster-sucitesa/" target="_blank">
                                                    <i class="fa fa-briefcase" style="color:#e05337;"></i>
                                                </a>
                                                May. 24 2016
                                                <br/>
                                                <a href="http://www.ofimaster.cl/page/nueva-alianza-ofimaster-sucitesa/" target="_blank">
                                                    <small class="text-navy" style="color:#e05337;">Ofimaster</small>
                                                </a>
                                            </div>
                                            <div class="col-xs-7 content no-top-border">
                                                <p class="m-b-xs">
                                                    <a href="http://www.ofimaster.cl/page/nueva-alianza-ofimaster-sucitesa/" target="_blank">
                                                        <strong style="color:#e05337;">Se conforma una nueva alianza entre Ofimaster y Sucitesa</strong>
                                                    </a>
                                                </p>
                                                <p>Ofimaster se enorgullece en informar que recientemente ha firmado una alianza con destacada empresa española.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <a href="http://www.ofimaster.cl/page/ofimaster-amplia-sus-bodegas-llegando-a-los-1-000-mts2/" target="_blank">
                                                    <i class="fa fa-file-text" style="color:#e05337;"></i>
                                                </a>
                                                Dic. 12 2015
                                                <br/>
                                                <a href="http://www.ofimaster.cl/page/ofimaster-amplia-sus-bodegas-llegando-a-los-1-000-mts2/" target="_blank">
                                                    <small class="text-navy" style="color:#e05337;">Ofimaster</small>
                                                </a>
                                            </div>
                                            <div class="col-xs-7 content no-top-border">
                                                <p class="m-b-xs">
                                                    <a href="http://www.ofimaster.cl/page/ofimaster-amplia-sus-bodegas-llegando-a-los-1-000-mts2/" target="_blank">
                                                        <strong style="color:#e05337;">Ofimaster amplía sus Bodegas llegando a...</strong>
                                                    </a>
                                                </p>
                                                <p>Apuntando siempre a ofrecer un mejor servicio e ir creciendo como empresa, es que Ofimaster recientemente ha ampliado sus Bodegas.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>¡Síguenos en Facebook!</h5>
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
                                    <div class="fb-page" data-width="490" data-href="https://www.facebook.com/Ofimaster-255970944414220/?fref=ts" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Ofimaster-255970944414220/?fref=ts" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Ofimaster-255970944414220/?fref=ts">Ofimaster</a></blockquote></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- close wrapper -->
