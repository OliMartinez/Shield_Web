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
	
								window.location ="' . str_replace('_','-',$tabla) . '";
	
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

	public static function ctrSubirComp(){
		if(isset($_POST["subir_comp"])){
			if ($_SESSION["tipo"] == "Distribuidor") {
				$tabla = 'pedidos_dists';
			} else {
				$tabla = 'pedidos_mayoristas';
			}	
			$respuesta = ModeloGeneral::mdlActualizar($tabla, 'comp_pago', $_POST["subir_comp"], 'ID', $_POST["IdPedido"]);
			
			if ($respuesta == "ok") {
				echo '<script>
	
			swal({
					type: "success",
					title: "Se ha cargado el comprobante de pago",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result) {
							if (result.value) {
	
								window.location ="' . $_SERVER["REQUEST_URI"] .'";
	
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
	
								window.location ="' . $_SERVER["REQUEST_URI"] . '";
	
							}
						})
	
			</script>';
			}
		}
	}
}
