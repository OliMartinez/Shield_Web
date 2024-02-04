<?php

class ControladorPedidos
{

	public static function ctrGuardarPedido()
	{
		if (isset($_POST["CrearPedido"])) {
			$tipo_usuario = null;
			$tabla = null;
			if ($_SESSION["tipo"] == "Distribuidor") {
				$tabla = 'pedidos_dists';
				$tipo_usuario = "dist";
			} else {
				$tabla = 'pedidos_mayoristas';
				$tipo_usuario = "mayorista";
			}
			$nuevoid = (ModeloGeneral::mdlMostrarItems("total_productos_pedidos", null, null, $tabla))[0][0];
			ModeloGeneral::mdlActualizar("total_productos_pedidos", $tabla, $nuevoid + 1, $tabla, $nuevoid);
			$motivo = "Pedido " . $nuevoid . " " . $_SESSION["ID"];

			$datos = array(
				"ID" => $nuevoid + 1,
				$tipo_usuario => $_SESSION["ID"],
				"tipo" => "En espera de pago",
				"productos" => $_POST["Productos"],
				"precio" => $_POST["A_pagar"],
				//"envio" => $_POST['Envio'],
				"total" => $_POST["A_pagar"],
				"motivo_pago" => $motivo,
				"domicilio" => $_POST["Domicilio"]
			);

			$respuesta = ModeloPedidos::mdlCrearPedido($tabla, $datos);

			if ($respuesta == "ok") {
				echo '<script>
	
			swal({
					type: "success",
					title: "El pedido se ha creado con éxito con Concepto/Motivo de pago: ' . $motivo . '",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result) {
							if (result.value) {
	
								window.location ="' . str_replace('_', '-', $tabla) . '";
	
							}
						})
	
			</script>';
			} else {
				echo '<script>
	
			swal({
					type: "error",
					title: "El pedido no se pudo crear",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result) {
							if (result.value) {
	
								window.location ="' . $_SERVER["REQUEST_URI"] . '";
	
							}
						})
	
			</script>';
			}
		}
	}

	public static function ctrSubirComp()
	{
		if (isset($_POST["mandar_comp"])) {
			if ($_FILES["subir_comp"]["type"] == "image/jpeg" || $_FILES["subir_comp"]["type"] == "application/pdf") {
				$tabla = '';
				if ($_SESSION["tipo"] == "Distribuidor") {
					$tabla = 'pedidos_dists';
				} else {
					$tabla = 'pedidos_mayoristas';
				}
				$dir_comp = "vistas/docs/" . $tabla . "/" . $_SESSION['ID'] . "/" . $_POST['idPedido'] . "/ComprobantePago";

				// Crea los directorios de forma recursiva
				mkdir($dir_comp, 0755, true);

				// Eliminar archivos existentes en la carpeta destino
				$archivos_en_carpeta = glob($dir_comp . "*");
				foreach ($archivos_en_carpeta as $archivo_existente) {
					unlink($archivo_existente);
				}

				$comp = $dir_comp . '/' . $_FILES["subir_comp"]["name"];

				// Mover el archivo a la ubicación deseada
				move_uploaded_file($_FILES["subir_comp"]["tmp_name"], $comp);

				$respuesta = ModeloGeneral::mdlActualizar($tabla, 'comp_pago', $comp, 'ID', $_POST["idPedido"]);

				if ($respuesta == "ok") {
					echo '<script>
	
					swal({
							type: "success",
							title: "Se ha cargado el comprobante de pago:' . $_FILES["subir_comp"]["name"] . ' ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result) {
									if (result.value) {
			
										//window.location ="' . $_SERVER["REQUEST_URI"] . '";
			
									}
								})
			
					</script>';
				} else {
					echo '<script>
	
					swal({
							type: "error",
							title: "No se pudo subir el comprobante de pago",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result) {
									if (result.value) {
			
										//window.location ="' . $_SERVER["REQUEST_URI"] . '";
			
									}
								})
			
					</script>';
				}
			} else {
				echo '<script>
	
				swal({
						type: "error",
						title: "¡Sólo están permitidos los archivos JPG o PDF!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result) {
								if (result.value) {
		
									window.location ="' . $_SERVER["REQUEST_URI"] . '";
		
								}
							})
		
				</script>';
			}
		}
	}

	/*=============================================
	ACCION PEDIDO
	=============================================*/

	public static function ctrAccionPedido()
	{
		if (isset($_GET["idPedido"])) {

			$pag = $_GET["ruta"];
			$tabla = str_replace('-', '_', $pag);
			$datos = $_GET["idPedido"];
			$accion = $_GET["accion"];

			if($accion == 'confirmar como pagado'){
				$respuesta = ModeloGeneral::mdlActualizar($tabla, 'tipo', 'Pago Confirmado', 'ID', $datos);
				$respuesta1 = ModeloGeneral::mdlActualizar($tabla, 'fecha_pago', date("Y-m-d"), 'ID', $datos);
			}
			else if($accion == 'marcar como entregado'){
				$respuesta = ModeloGeneral::mdlActualizar($tabla, 'tipo', 'Entregado', 'ID', $datos);
				$respuesta1 = ModeloGeneral::mdlActualizar($tabla, 'fecha_llegada', date("Y-m-d"), 'ID', $datos);
			}			
			if($accion == 'finalizar'){
				$respuesta = ModeloGeneral::mdlActualizar($tabla, 'tipo', 'Finalizado', 'ID', $datos);
				$respuesta1 = 'ok';
			}
			else if($accion == 'cancelar'){
				$respuesta = ModeloGeneral::mdlActualizar($tabla, 'tipo', 'Cancelado', 'ID', $datos);
				$respuesta1 = 'ok';
			}
			else if ($accion == 'eliminar') {
				/*if ($_GET["comppago"] != "") {

				unlink($_GET["comppago"]);
				rmdir('vistas/img/usuarios/' . $_GET["comppago"]);
			}*/
				$respuesta = $respuesta = ModeloGeneral::mdlEliminar($tabla, null, $datos);
				$respuesta1 = 'ok';
			}

			if ($respuesta == "ok" && $respuesta1 == "ok") {
				echo '<script>

				swal({
					  type: "success",
					  title: "¡El Pedido se pudo ' . $accion . ' exitosamente!",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {
									
									window.location = "' . $pag . '";

								}
							})

				</script>';
			} else {
				echo '<script>

				swal({
					  type: "error",
					  title: "¡El Pedido no se pudo ' . $accion . '!",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

									window.location = "' . $pag . '";

								}
							})

				</script>';
			}
		}
	}
}
