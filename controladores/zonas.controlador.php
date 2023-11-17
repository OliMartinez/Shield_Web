<?php

class ControladorZonas
{

	/*=============================================
	GUARDAR ZONA
	=============================================*/
	public static function ctrGuardarZona()
	{
		if (isset($_POST["guardar"])) {
			$datos = array(
				"ID" => $_POST["Nombre"],

			);
		}
		$tipo = $_POST["tipoguardar"];
		$respuesta = ModeloZonas::mdlGuardarZona($datos, $tipo);

		if ($respuesta == "ok") {

			echo '<script>

				swal({
						type: "success",
						title: "La zona ha sido guardada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "' . $_SERVER["REQUEST_URI"] . '";

								}
							})

				</script>';
		}
	}
	/*=============================================
	ELIMINAR ZONA
	=============================================*/
	public static function ctrEliminarZona()
	{
		if (isset($_GET["idZona"])) {

			$datos = $_GET["idZona"];

			$respuesta = $respuesta = ModeloGeneral::mdlEliminar('zonas', null, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "La zona ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "zonas";

								}
							})

				</script>';
			}
		}
	}
}
