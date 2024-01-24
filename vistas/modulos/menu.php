<aside class="main-sidebar">

	<section class="sidebar">

		<ul class="sidebar-menu">

			<?php
			if ($_SESSION["tipo"] == "Administrador" || $_SESSION["tipo"] == "Fabricante" || $_SESSION["tipo"] == "Mayorista") {
				echo ' 
				<li class="active">

					<a href="inicio">

						<i class="fa fa-home"></i>
						<span>Inicio</span>

					</a>

				</li>';
			}
			if ($_SESSION["tipo"] == "Solicitante") {
				echo ' 
				<li class="active">

				<a href="info-cuenta">
			
					<i class="fa fa-address-card"></i>
					<span>Información de Cuenta</span>
			
				</a>
			s
			</li>';
			}
			if ($_SESSION["tipo"] == "Administrador") {

				echo '
				<li class="treeview">

					<a>
				
						<i class="fa fa-users"></i>
						<span>Usuarios</span>
				
						<span class="pull-right-container">
				
							<i class="fa fa-angle-left pull-right"></i>
				
						</span>
				
					</a>
				
					<ul class="treeview-menu">
				
						<li class="treeview">
				
							<a>
				
								<i class="fa fa-user-circle"></i>
				
								<span>Distribuidores</span>
				
								<span class="pull-right-container">
				
									<i class="fa fa-angle-left pull-right"></i>
				
								</span>
				
							</a>
				
							<ul class="treeview-menu">
				
								<li>
				
									<a href="dists">
				
										<i class="fa fa-circle-o"></i>
										<span>Administrar</span>
				
									</a>
				
								</li>
								<li>
				
									<a href="solicitantes">
				
										<i class="fa fa-circle-o"></i>
										<span>Solicitantes</span>
				
									</a>
								</li>
							</ul>
						</li>
				
						<li>
				
							<a href="agentes">
				
								<i class="fa fa-user-o"></i>
								<span>Agentes</span>
				
							</a>
				
						</li>
				
						<li>
				
							<a href="mayoristas">
				
								<i class="fa fa-user"></i>
								<span>Mayoristas</span>
				
							</a>
				
						</li>
				
						<li>
				
							<a href="AdminsYFabs">
				
								<i class="fa fa-user-circle-o"></i>
								<span>Admins y Fabricantes</span>
				
							</a>
				
						</li>
					</ul>
				</li>
				
				<li class="treeview">
				
					<a>
				
						<i class="fa fa-product-hunt"></i>
						<span>Productos</span>
				
						<span class="pull-right-container">
				
							<i class="fa fa-angle-left pull-right"></i>
				
						</span>
				
					</a>
				
					<ul class="treeview-menu">
				
						<li class="treeview">
				
							<a>
				
								<i class="fa fa-circle-o"></i>
								<span>De Fabricantes</span>
								<span class="pull-right-container">
				
									<i class="fa fa-angle-left pull-right"></i>
				
								</span>
				
							</a>
							<ul class="treeview-menu">
				
								<li>
				
									<a href="productos-fabs">
				
										<i class="fa fa-product-hunt"></i>
										<span>Administrar</span>
				
									</a>
				
								</li>
								<li>
				
									<a href="categorias">
				
										<i class="fa fa-table"></i>
										<span>Categorias</span>
				
									</a>
				
								</li>
								<li>
				
									<a href="colecciones">
				
										<i class="fa fa-list"></i>
										<span>Colecciones</span>
				
									</a>
				
								</li>
								<!--<li>
				
									<a href="catalogo">
										
										<i class="fa fa-shopping-bag"></i>
										<span>Catálogo</span>
				
									</a>
				
								</li>-->
							</ul>
						</li>
				
						<li class="treeview">
				
							<a>
				
								<i class="fa fa-circle-o"></i>
								<span>De Mayoristas</span>
								<span class="pull-right-container">
				
									<i class="fa fa-angle-left pull-right"></i>
				
								</span>
							</a>
							<ul class="treeview-menu">
								<li>
				
									<a href="productos-mayoristas">
				
										<i class="fa fa-product-hunt"></i>
										<span>Administrar</span>
				
									</a>
				
								</li>
								<!--<li>
				
									<a href="catalogo">
										
										<i class="fa fa-shopping-bag"></i>
										<span>Catálogo</span>
				
									</a>
				
								</li>-->
							</ul>
						</li>
					</ul>
				</li>
				
				<li class="treeview">
				
					<a>
				
						<i class="fa fa-truck"></i>
				
						<span>Pedidos</span>
				
						<span class="pull-right-container">
				
							<i class="fa fa-angle-left pull-right"></i>
				
						</span>
				
					</a>
				
					<ul class="treeview-menu">
				
						<li>
				
							<a href="pedidos-mayoristas">
				
								<i class="fa fa-truck"></i>
				
								<span>De Mayoristas</span>
				
							</a>
				
						</li>
				
						<li>
				
							<a href="pedidos-dists">
				
								<i class="fa fa-truck"></i>
				
								<span>De Distribuidores</span>
				
							</a>
				
						</li>
				
					</ul>
				</li>
				<li>
					<a href="cuenta-deposito">
				
						<i class="fa fa-credit-card"></i>
						<span>Información de Depósito</span>
				
					</a>
				
				</li>
				';
			} else if ($_SESSION["tipo"] == "Fabricante") {
				echo '
				<li>

					<a href="mayoristas">
				
						<i class="fa fa-users"></i>
						<span>Mayoristas</span>
				
					</a>
				
				</li>
				
				<li>
				
					<a href="dists">
				
						<i class="fa fa-user-circle"></i>
						<span>Distribuidores Directos</span>
				
					</a>
				
				</li>
				
				<li>
				
					<a href="agentes">
				
						<i class="fa fa-user-o"></i>
						<span>Agentes Directos</span>
				
					</a>
				
				</li>
				
				<li>
				
					<a href="productos-fabs">
				
						<i class="fa fa-product-hunt"></i>
						<span>Productos</span>
				
					</a>
				
				</li>
				
				<li>
				
					<a href="categorias">
				
						<i class="fa fa-table"></i>
						<span>Categorias</span>
				
					</a>
				
				</li>
				<li>
				
					<a href="colecciones">
				
						<i class="fa fa-list"></i>
						<span>Colecciones</span>
				
					</a>
				
				</li>
			<!-- <li>
				
					<a href="catalogo">
				
						<i class="fa fa-shopping-bag"></i>
						<span>Mi Catálogo</span>
				
					</a>
				
				</li> -->
				
				<li>
				
					<a href="pedidos-mayoristas">
				
						<i class="fa fa-truck"></i>
				
						<span>Pedidos</span>
				
					</a>
				
				</li>
				
				<li>
					<a href="cuenta-deposito">
				
						<i class="fa fa-credit-card"></i>
						<span>Información de Depósito</span>
				
					</a>
				
				</li>
			';
			} else if ($_SESSION["tipo"] == "Mayorista") {
				echo '
				<li>

					<a href="agentes">
				
						<i class="fa fa-user"></i>
						<span>Agentes</span>
				
					</a>
				
				</li>
				<li>
				
					<a href="dists">
				
						<i class="fa fa-user-o"></i>
						<span>Distribuidores</span>
				
					</a>
				
				</li>
				
				<li>
				
					<a href="catalogo">
				
						<i class="fa fa-shopping-basket"></i>
						<span>Catálogo</span>
				
					</a>
				
				</li>

				<li>
				
					<a href="productos-mayoristas">
				
						<i class="fa fa-product-hunt"></i>
						<span>Mis productos</span>
				
					</a>
				
				</li>
				
				<li>
				
					<a href="pedidos-dists">
				
						<i class="fa fa-truck"></i>
				
						<span>Pedidos Distribuidores</span>
				
					</a>
				
				</li>

				<li>
					<a href="zonas">
				
						<i class="fa fa-globe"></i>
						<span>Mis Zonas</span>
				
					</a>
				
				</li>

				<li>
					<a href="cuenta-deposito">
				
						<i class="fa fa-credit-card"></i>
						<span>Información de Depósito</span>
				
					</a>
				
				</li>
			';
			} else if ($_SESSION["tipo"] == "Agente") {
				echo '
				<li>
					<a href="dists">
				
						<i class="fa fa-user"></i>
						<span>Distribuidores</span>
				
					</a>
				
				</li>
				
				<li>
					<a href="solicitantes">
				
						<i class="fa fa-user-o"></i>
						<span>Aspirantes a distribuidor</span>
				
					</a>
				
				</li>
				
				<li>
				
					<a href="pedidos-dists">
				
						<i class="fa fa-truck"></i>
				
						<span>Pedidos</span>
				
					</a>
				
				</li>
			';
			} else if ($_SESSION["tipo"] == "Distribuidor") {
				echo '
				<li>
					
					<a href="catalogo">

						<i class="fa fa-shopping-basket"></i>
						<span>Catálogo</span>

					</a>

				</li>

			<!--<li>
					<a  href="credito">

						<i class="fa fa-credit-card"></i>
						<span>Credito</span>
						
					</a>

				</li>-->
			';
			}

			?>

		</ul>

	</section>

</aside>