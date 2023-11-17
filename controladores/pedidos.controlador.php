<?php

class ControladorPedidos{


	public static function ctrGuardarPedido()
	{
		if (isset($_POST["CrearPedido"])) {
			$tabla = $_POST["tabla"];
			$nuevoid = (ModeloGeneral::mdlMostrarItems("total_productos_pedidos",null,null,$tabla))[0][0];
			ModeloGeneral::mdlActualizar("total_productos_pedidos", $tabla, $nuevoid+1, $tabla, $nuevoid);
			$motivo = "Pedido ".$nuevoid." ".$_SESSION["ID"];
			
            $tipo_usuario = null;
            $tabla = null;

            if($_SESSION["tipo"]=="Distribuidor"){
                $tipo_usuario = "Distribuidor";
            }
            else{
                $tipo_usuario = "Mayorista";
            }

			$datos = array(
				"ID" => $nuevoid,
				$tipo_usuario => $_SESSION["ID"],
				"tipo" => "En espera de pago",
				"productos" => $_POST["Productos"],
				"precio" => $_POST["A-pagar"],
				"motivo_pago" => $motivo,
				"domicilio" => $_POST["Domicilio"]
			);

			$respuesta = ModeloPedidos::mdlCrearPedido($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
	
			swal({
					type: "success",
					title: "El pedido se ha creado con éxito con Concepto/Motivo de pago: '.$motivo.'",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result) {
							if (result.value) {
	
								window.location ="pedidos-mayoristas";
	
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
	
								window.location ="pedidos-mayoristas";
	
							}
						})
	
			</script>';
			}
		}
	}



}