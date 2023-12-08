<?php

class ControladorZonas
{

	/*=============================================
	GUARDAR ZONA
	=============================================*/
	public static function ctrGuardarZona()
	{
		if (isset($_POST["guardar"])) {
			$mayorista = '';
			if (isset($_POST["mayorista"])) {
				$mayorista = $_POST["mayorista"];
			} else {
				$mayorista = $_SESSION["ID"];
			}
			$estados = '';
			$n_estados = '';
			if(isset($_POST['Estado'])){
				$estados_array = $_POST['Estado'];
				$n_estados = sizeof($estados_array);
				// Unir los domicilios en una cadena separada por "<br>"
				$estados = implode(",", $estados_array);
			}
			$ciudades = '';
			for($i=0; $i<$n_estados; $i++){
					$ciudades_array = $_POST['Ciudad'.$i];

					// Unir los domicilios en una cadena separada por "<br>"
					$ciudades .= implode('-', $ciudades_array).',';

			}				
			$datos = array(
				"ID" => $_POST["Nombre"],
				"mayorista" => $mayorista,
				"estados" => $estados,
				"ciudades" => $ciudades
			);

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
	}
	/*=============================================
	ELIMINAR ZONA
	=============================================*/
	public static function ctrEliminarZona()
	{
		if (isset($_GET["idElimZona"])) {

			$datos = $_GET["idElimZona"];

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
