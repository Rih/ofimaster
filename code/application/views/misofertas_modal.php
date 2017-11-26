			<?php
                $usr = $this->session->userdata("login_type");
                $uriadd = "?".$usr."/".$page_name."/add";
             ?>
			

			<div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-condensed" id="dataTable1">
                                <thead>
                                    <tr>
                                        <th style="width:5%">No.</th>                   
                                        <th style="width:40%">Variable</th>                     
                                        <th style="width:55%">Detalle</th>  
                                    </tr>
                                </thead>
                                <tbody>
                               
                                    <tr>
                                    <td>1</td>
                                    <td >Código Oferta</td>
                                    <td id="idofertacarga">
                                    </td>
                                    </tr>
                                    
                                    <tr>
                                    <td>2</td>
                                    <td>Publicación del Anuncio</td>                       
                                    <td id="fecha_publicacion"><i class="fa fa-calendar" aria-hidden="true"></i> 
                                    
                                    </td>
                                    </tr>                   

                                    <tr>
                                    <td>3</td>
                                    <td>Fecha para Cargar</td>                     
                                    <td id="fecha_carga"><i class="fa fa-calendar" aria-hidden="true"></i> 
                                   
                                    </td>
                                    </tr>

                                    <tr>    
                                    <td>4</td>
                                    <td>Fecha de Entrega</td>                      
                                    <td id="fecha_descarga"><i class="fa fa-calendar" aria-hidden="true"></i>                                
                                    </td>                   
                                    </tr>

                                    <tr>
                                    <td>5</td>
                                    <td>Ciudad Origen</td>                     
                                   <td id="nciudad_origen"></td>
                                    </tr>

                                    <tr>
                                    <td>6</td>
                                    <td>Ciudad destino</td>                        
                                    <td id="nciudad_destino"></td>                 
                                    </tr>

                                    <tr>
                                    <td>7</td>
                                    <td>Dirección Origen</td>                      
                                    <td id="origen_direccion"></td>
                                    </tr>

                                    <tr>
                                    <td>8</td>
                                    <td>Dirección Destino</td>                     
                                    <td id="destino_direccion"></td>                  
                                    </tr>

                                    <tr>
                                    <td>9</td>
                                    <td>Cantidad de Carga</td>                     
                                    <td id="cantidad_carga"></td>
                                    </tr>

                                    <tr>
                                    <td>10</td>
                                    <td>Tipo Carga</td>                        
                                    <td id="tipo_carga"></td>            
                                    </tr>

                                    <tr>
                                    <td>11</td>
                                    <td>Precio</td>                        
                                    <td id="precio"></td>
                                    </tr>

                                   

                                    <tr>
                                    <td>12</td>
                                    <td>Detalle</td>                       
                                    <td id="detalle"></td>
                                    </tr>

                                    <tr>
                                    <td>13</td>
                                    <td>Estado</td>                        
                                    <td id="descripcion_estado"></td>
                                    </tr>

                                   
                                    <tr>
                                    <td>14</td>
                                    <td>Distancia</td>                      
                                    <td id="distancia"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                </div>
                <div class="row">
                    <div class="alert alert-warning">
                        <p><strong><i class="fa fa-warning"></i> ¡Recuerda!</strong><br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco<br><br>
                        </p>
                    </div>        
                </div>            
            </div>
            <div class="modal-footer">           
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
            </div>
           
