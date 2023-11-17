<?php

class ControladorCarrito
{

	/*=============================================
	GUARDAR PRODUCTO
	=============================================*/

	public static function ctrGuardarProducto()
	{

		if (isset($_POST["GuardarProducto"])) {

			/*=============================================
            VALIDAR IMÁGENES
            =============================================*/

			$tabla = $_POST["tabla"];

			$datos = array(
				"ID" => $_POST["ID"],
				"categoria" => $_POST["Categoria"],
				"cantidad" => $_POST["Cantidad"],
				"precioxcantidad" => $_POST["Precioxcantidad"],
			);

			$respuesta = ModeloCarrito::mdlGuardarProducto($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					swal({
							type: "success",
							title: "El producto ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
									if (result.value) {

									window.location = "carrito";

									}
								})

					</script>';
			}
			else{
				echo '<script>

				swal({
						type: "error",
						title: "El producto no se pudo guardar",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "carrito";

								}
							})

				</script>';				
			}
		}
	}

	/*=============================================
	ELIMINAR PRODUCTO
	=============================================*/
	public static function ctrEliminarProducto()
	{

		if (isset($_GET["id"])) {

			$tabla = $_GET["tabla"];
			$datos = $_GET["id"];

			$respuesta = $respuesta = ModeloGeneral::mdlEliminar($tabla, null, $datos);

			if ($respuesta == "ok") {

				echo '<script>
				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "carrito";

								}
							})

				</script>';
			}
			else{
				echo '<script>
				swal({
					  type: "error",
					  title: "El producto no se pudo eliminar",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "carrito";

								}
							})

				</script>';	
			}
		}
	}

	public static function ctrEliminarCarrito(){
		if(isset($_POST["CrearPedido"])){
			$idUser = $_SESSION["ID"];
			$tabla = null;
			if($_SESSION["tipo"] == "Distribuidor"){
				$tabla = "carritos_dists";
			}
			else{
				$tabla = "carritos_mayoristas";
			}
			ModeloCarrito::mdlEliminarCarrito($tabla, $idUser);
		}
	}

}