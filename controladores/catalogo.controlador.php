<?php

class ControladorCatalogo
{
	/*=============================================
	AÑADIR AL CARRITO
	=============================================*/
	public static function ctrAgregarAlCarrito()
	{

		if (isset($_POST['submit'])) {

			$tabla = null;
		
			if ($_SESSION["tipo"] == "Distribuidor") {
				$tabla = "carritos_dists";
			} else {
				$tabla = "carritos_mayoristas";
			}

			$ID = ModeloGeneral::mdlContFilas($tabla,null,null);

			$datos = array(
				"ID" => $ID,
				"ID_user" => $_SESSION["ID"],
				"ID_product" => $_POST["ID"],
				"categoria" => $_POST["categoria"],
				"cantidad" => $_POST["cantidad"],
				"precioxcantidad" => $_POST["precioxcantidad"]
			);

			$respuesta = ModeloCatalogo::mdlAgregarAlCarrito($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
	
			swal({
					type: "success",
					title: "El producto se ha agregado al carrito",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result) {
							if (result.value) {
	
								window.location ="catalogo";
	
							}
						})
	
			</script>';
			} else {
				echo '<script>
	
			swal({
					type: "error",
					title: "El producto no se pudo agregar al carrito",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result) {
							if (result.value) {
	
								window.location ="catalogo";
	
							}
						})
	
			</script>';
			}
		}
		
	}
}
?>