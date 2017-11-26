<aside class="sidebar-menu fixed">
	<div class="sidebar-inner scrollable-sidebar">
		<div class="main-menu">
			<ul class="accordion">
				<li class="menu-header">
					Main Menu
				</li>
				
				<?php 
					$adm = $this->session->userdata('admin_login');
					$usr = $this->session->userdata('user_login');
					$type = $this->session->userdata('login_type');
				?>
				<?php if ($adm  == 1){
				?>
				<li class="bg-palette4 active">					
					<a href="<?php echo  base_url().$type."/dashboard"; ?>">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-home fa-lg"></i></span>
							<span class="text m-left-sm">Dashboard</span>
						</span>
					</a>
				</li>
				<li class="bg-palette4">					
					<a href="<?php echo  base_url().'?'.$type; ?>/services">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Services</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nservices)){ echo $nservices; } ?></small>	

						</span>
					</a>
				</li>
				
				<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type; ?>/users" class="brand">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block ion-person-add fa-lg"></i></span>
							<span class="text m-left-sm">Users</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"> <?php if(isset($nusers)){ echo $nusers; } ?> </small>							
						</span>
					</a>
				</li>				
				<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type; ?>/approval_services">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-money fa-lg"></i></span>
							<span class="text m-left-sm">Approve Services</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nservicesforapproval)){ echo $nservicesforapproval; } ?></small>	
						</span>
					</a>
				</li>				
				<li class="bg-palette4">
					<a href="<?php echo site_url('?Admin/backup'); ?>">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-ticket fa-lg"></i></span>
							<span class="text m-left-sm">Backup</span>							
						</span>
					</a>
				</li>
				
				<?php }else if($usr == 1){ 
						if($type == 'Transportista'){
				?>
				<li class="bg-palette4 active">					
					<a href="<?php echo  base_url().$type."/dashboard"; ?>">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-home fa-lg"></i></span>
							<span class="text m-left-sm">Dashboard</span>
						</span>
					</a>
				</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/equipos">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Equipos</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/choferes">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Choferes</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/misdatos">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Mis Datos</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/ofrecercamion">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Ofrecer Camión</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/buscarcarga">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Buscar Carga</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/misofertas">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Mis Ofertas</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>

				<?php }else if($type == 'GeneradorCarga'){
				?>
					<li class="bg-palette4 active">					
						<a href="<?php echo  base_url().$type."/dashboard"; ?>">
							<span class="menu-content block">
								<span class="menu-icon"><i class="block fa fa-home fa-lg"></i></span>
								<span class="text m-left-sm">Dashboard</span>
							</span>
						</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/sucursal">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Sucursal</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/contactosucursal">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Contacto Sucursal</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/misdatos">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Mis Datos</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/ofrecercarga">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Ofrecer Carga</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/buscarcamion">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Buscar Camión</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
					<li class="bg-palette4">
					<a href="<?php echo  base_url().'?'.$type;?>/misofertas">
						<span class="menu-content block">
							<span class="menu-icon"><i class="block fa fa-shopping-cart fa-lg"></i></span>
							<span class="text m-left-sm">Mis Ofertas</span>
							<small class="badge badge-success badge-square bounceIn animation-delay5 m-left-xs"><?php if(isset($nmyservices)){ echo $nmyservices; } ?></small>	
						</span>
					</a>
					</li>
				<?php } ?>
				
				<?php } ?>
			</ul>
		</div>	
		<div class="sidebar-fix-bottom clearfix">
			<div class="user-dropdown dropup pull-left">
				<p style="color:#273a48; font-size:8.5px; line-height:9px; text-align:justify;">
					La responsabilidad de la información manejada por el sistema recae en el usuario que las provee, además el sistema
					utiliza todas las herramientas disponibles para la protección de información sensible. El usuario es libre de dar de baja su subscripción
					cuya acción tiene como consecuencia eliminar cualquier rastro de éste en nuestra base de datos, garantizando en lo que respecta al anonimato y seguridad de sus servicios vinculados. Las acciones realizadas en este Sistema de Administración son de exclusiva responsabilidad del usuario, 
					ingresado con su respectivo correo electrónico y contraseña elegida.</p>
			</div>
		</div>
	</div><!-- sidebar-inner -->
</aside>