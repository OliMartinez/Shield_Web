<?php

class ControladorCategoriasColecciones
{
	/*=============================================
	GUARDAR
	=============================================*/

	public static function ctrGuardar()
	{
		if (isset($_POST["tipoguardar"]) && isset($_POST["ID"])) {
			$tabla = $_POST["tabla"];
			$clasificacion = null;
			if ($tabla == "categorias") {
				$clasificacion = "categoría";
			} else {
				$clasificacion = "colección";
			}

				$ruta = ""; 
				
				if(isset($_POST["fotoActual"]) && !empty($_POST["fotoActual"])){
					$ruta = $_POST["fotoActual"];
				};

				if (isset($_FILES["Foto"]["tmp_name"]) && !empty($_FILES["Foto"]["tmp_name"])) {

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/clasificaciones/" . $tabla . "/" . $_POST["ID"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["fotoActual"])) {

						unlink($_POST["fotoActual"]);

						if ($_POST["IDant"] != $_POST["ID"]) {
							rmdir("vistas/img/clasificaciones/" . $tabla . "/" . $_POST["IDant"]);
							mkdir($directorio, 0755);
						}
					} else {

						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/


					if ($_FILES["Foto"]["type"] == "image/jpeg") {

						$ruta = $directorio . "/" . $_FILES["Foto"]["name"];

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$foto = imagecreatefromjpeg($_FILES["Foto"]["tmp_name"]);

						imagejpeg($foto, $ruta);
					}

					if ($_FILES["Foto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$foto = imagecreatefrompng($_FILES["Foto"]["tmp_name"]);

						imagepng($foto, $ruta);
					}
				}
				$datos = array(
					"ID" => $_POST["ID"],
					"IDant" => $_POST["IDant"],
					"descripcion" => $_POST["Descripcion"],
					"imagen" => $ruta
				);

				$tipo = $_POST["tipoguardar"];
				$respuesta = ModeloCategoriasColecciones::mdlGuardar($tabla, $datos, $tipo);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "La ' . $clasificacion . ' ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "'  . $_SERVER["REQUEST_URI"] . '";

									}
								})

					</script>';
				}
		}
	}

	/*=============================================
	ELIMINAR
	=============================================*/

	public static function ctrEliminar()
	{

		if (isset($_GET["idCategoria"]) || isset($_GET["idColeccion"])) {

			$tabla = $_GET["tabla"];
			$datos = null;
			$clasificacion = null;

			if ($tabla = "categorias") {
				$datos = $_GET["idCategoria"];
				$clasificacion = "categoría";
			} else {
				$datos = $_GET["idColeccion"];
				$clasificacion = "colección";
			}

			$respuesta = ModeloGeneral::mdlEliminar($tabla, null, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					swal({
						  type: "success",
						  title: "La ' . $clasificacion . ' ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result
									if (result.value) {

									window.location = "' . $tabla . '";

									}
								})

					</script>';
			}
		}
	}
}
