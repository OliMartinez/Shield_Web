 <header class="main-header">

 	<!--=====================================
	LOGOTIPO
	======================================-->
 	<a href="inicio" class="logo" style="background-color: #222d32;">

 		<!-- logo mini -->
 		<span class="logo-mini">

 			<img src="vistas/img/plantilla/icon.png" class="img-responsive" style="padding:10px">

 		</span>

 		<!-- logo normal -->

 		<span class="logo-lg">

 			<img src="vistas/img/plantilla/icon.png" class="img-responsive" style="padding:10px 0px">

 		</span>

 	</a>

 	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
 	<nav class="navbar navbar-static-top" role="navigation" style="background-color: #222d32;">

 		<!-- Botón de navegación -->

 		<a class="sidebar-toggle" data-toggle="push-menu" role="button" style="background-color: #222d32;">

 			<span class="sr-only">Toggle navigation</span>

 		</a>
 		<?php
			if ((isset($_GET["ruta"]) && $_GET["ruta"] == "catalogo") || ($_SESSION["tipo"] == "Distribuidor" && !isset($_GET["ruta"]))) {
				echo '<form class="navbar-nav navbar-form" action="catalogo-busqueda" method="GET" style="margin-left:27%; width:35%">
 				<div class="input-group input-group-sm" style="width:125%">
 					<input type="search" class="form-control form-control-navbar" placeholder="Buscar" name="Buscar" id="Buscar">
 					<div class="input-group-btn">
 						<button class="btn btn-default" type="submit">
 							<span class="fa fa-search"></span>
 						</button>
 					</div>
 				</div>
 			</form>';
			}
			?>

 		<!-- tipo de usuario -->

 		<div class="navbar-custom-menu">

 			<ul class="nav navbar-nav">

 				<?php

					if ($_SESSION["tipo"] == "Mayorista" || $_SESSION["tipo"] == "Distribuidor") {
						$tabla = null;
						$tabla1 = null;
						$tipo_user = null;
						$pagpedidos = null;
						if ($_SESSION["tipo"] == "Mayorista") {
							$tabla = "carritos_mayoristas";
							$tabla1 = "pedidos_mayoristas";
							$tipo_user = "mayorista";
							$pagpedidos = "pedidos-mayoristas";
						} else {
							$tabla = "carritos_dists";
							$tabla1 = "pedidos_dists";
							$tipo_user = "dist";
							$pagpedidos = "pedidos-dists";
						}
						$totalpedidos = ControladorGeneral::ctrContFilas($tabla1, $tipo_user, $_SESSION["ID"]);
						$totalproductos = ControladorGeneral::ctrContFilas($tabla, "ID_user", $_SESSION["ID"]);
						echo '
						<li>								
							<a href="' . $pagpedidos . '" class="nav-link" title="Mis Pedidos">

								<span class="fa fa-truck" role="button"></span>
								<span class="badge badge-warning navbar-badge">' . $totalpedidos . '</span>

							</a>
						</li>
						<li>
								
							<a href="carrito" class="nav-link" title="Carrito">

								<span class="fa fa-shopping-cart" role="button"></span>
								<span class="badge badge-warning navbar-badge">' . $totalproductos . '</span>

							</a>
						</li>';
					}

					?>

 				<li class="dropdown user user-menu">

 					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

 						<?php

							if ($_SESSION["foto"] != "") {

								echo '<img src="' . $_SESSION["foto"] . '" class="user-image">';
							} else {


								echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
							}


							?>

 						<span class="hidden-xs"><?php echo $_SESSION["ID"]; ?></span>

 					</a>

 					<!-- Dropdown-toggle -->

 					<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


 						<a class="dropdown-item" href="info-cuenta" style="color:#646364;">Información de cuenta</a>

 						<div class="dropdown-divider"></div>

 						<a class="dropdown-item" href="salir" style="color:#646364;">Salir</a>

 					</ul>

 				</li>

 			</ul>

 		</div>
 		<?php
			if ($_SESSION["tipo"] != "Solicitante") {
				echo '	<div class="navbar-custom-menu">
										
							<ul class="nav navbar-nav">
					
								<li class="dropdown user user-menu">
									
									<!-- Dropdown-toggle -->

									<ul class="dropdown-menu">
										
										<li class="user-body">

										</li>

									</ul>				
								</li>
							
							</ul>
						
						</div>	';
			} ?>

 	</nav>

 </header>