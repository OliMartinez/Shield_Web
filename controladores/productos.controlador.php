<?php

class ControladorProductos
{
	/*=============================================
	GUARDAR PRODUCTO
	=============================================*/

	public static function ctrGuardarProducto()
	{

		if (isset($_POST["guardar"])) {
			$tabla = $_POST["tabla"];
			$id = null;
			if ($_POST["tipoguardar"] == "crear") {
				$id = (ModeloGeneral::mdlMostrarItems("total_productos_pedidos", null, null, $tabla))[0][0];
				ModeloGeneral::mdlActualizar("total_productos_pedidos", $tabla, $id + 1, $tabla, $id);
			} else {
				$id = $_POST["ID"];
			}
			/*=============================================
            VALIDAR IMÁGENES
            =============================================*/

			$rutas = $_POST["ImagenesActuales"];
			$rutasActuales_array = explode('<br>', $rutas);

			if (isset($_FILES["SubirImagenes"]) && !empty($_FILES["SubirImagenes"])) {
				$rutas = "";
				/*=============================================
                CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LAS IMAGENES DEL PRODUCTO
                =============================================*/

				$subdirectorio = null;

				if ($tabla == "productos_fab") {
					$subdirectorio = "Fabricante";
				} else {
					$subdirectorio = "Mayorista/" . $_POST["Mayorista"];
				}

				$directorio = "vistas/img/productos/" . $subdirectorio . "/" . $id;
				if (!is_dir($directorio)) {
					mkdir($directorio, 0755);
				}
				if (isset($_POST["imagenActual"])) {
					$imagenes_guardadas = $_POST["imagenActual"];

					$rutas = implode('<br>', $imagenes_guardadas);

					foreach ($rutasActuales_array as $ruta_actual) {
						$eliminada = true;
						foreach ($imagenes_guardadas as $imagen_guardada) {
							if ($ruta_actual == $imagen_guardada) {
								$eliminada = false;
								break;
							}
						}
						if ($eliminada) {
							unlink($ruta_actual);
						}
					}
				}

				$imagenes_nuevas = $_POST["nuevaImagen"];
				$imagenes_subidas = $_FILES["SubirImagenes"];

				foreach ($imagenes_nuevas as $imagen_nueva) {
					for ($i = 0; $i < count($imagenes_subidas["name"]); $i++) {
						if ($imagenes_subidas["name"][$i] == $imagen_nueva) {
							/*=============================================
							DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
							=============================================*/

							$imagen = $imagenes_subidas["name"][$i];
							$rutaImagen = $directorio . "/" . $imagen;

							if ($imagenes_subidas["type"][$i] == "image/jpeg") {
								$archivo = imagecreatefromjpeg($imagenes_subidas["tmp_name"][$i]);
								imagejpeg($archivo, $rutaImagen);
							} elseif ($imagenes_subidas["type"][$i] == "image/png") {
								$archivo = imagecreatefrompng($imagenes_subidas["tmp_name"][$i]);
								imagepng($archivo, $rutaImagen);
							}

							// Convertimos el array de rutas en una cadena separada por comas
							if ($rutas != "") {
								$rutas = $rutas . "<br>" . $rutaImagen;
							} else {
								$rutas = $rutaImagen;
							}
							break;
						}
					}
				}
			}

			$categorias = array();
			$categoriasSeparadas = "";
			// Asegurarse de que $_POST['Categoria'] existe y es un arreglo
			if (isset($_POST['Categoria']) && is_array($_POST['Categoria'])) {
				$categorias = $_POST['Categoria'];

				// Unir los domicilios en una cadena separada por "<br>"
				$categoriasSeparadas = implode("<br>", $categorias);
			} else {
				// Manejar el caso en que $_POST['Categoria'] no existe o no es un arreglo
				$categoriasSeparadas = $_POST['Categoria'];
			}

			$datos = array(
				"ID" => $id,
				"nombre" => $_POST["Nombre"],
				"descripcion" => $_POST["Descripcion"],
				"caracteristicas" => $_POST["Caracteristicas"],
				"categorias" => $categoriasSeparadas,
				"coleccion" => $_POST["Coleccion"],
				"cantidad_min" => $_POST["Cant_min"],
				"envio" => $_POST["Envio"],
				"imagenes" => $rutas
			);

			if ($tabla == "productos_mayorista") {
				$datos["mayorista"] = $_POST["Mayorista"];
				$datos["stock"] = $_POST["Stock"];
				$datos["precio_mayorista"] = $_POST["PrecioCompra"];
				$datos["precio_dist"] = $_POST["PrecioVenta"];
			} else {
				$datos["precio_mayorista"] = $_POST["PrecioVenta"];
			}

			$tipo = $_POST["tipoguardar"];

			$respuesta = ModeloProductos::mdlGuardarProducto($tabla, $datos, $tipo);

			if ($respuesta == "ok") {

				echo '<script>

					swal({
							type: "success",
							title: "El producto ha sido guardado correctamente",
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
	ELIMINAR PRODUCTO
	=============================================*/
	public static function ctrEliminarProducto()
	{

		if (isset($_GET["idProducto"])) {

			$tabla = $_GET["tabla"];
			$datos = $_GET["idProducto"];

			if ($_GET["imagenes"] != "" && $_GET["imagenes"] != "vistas/img/productos/default/anonymous.png") {

				unlink($_GET["imagenes"]);
				rmdir('vistas/img/productos/' . $_GET["ID"]);
			}

			$respuesta = $respuesta = ModeloGeneral::mdlEliminar($tabla, null, $datos);

			$pag = "";

			if ($tabla == "productos_mayorista") {
				$pag = "productos-mayoristas";
			} else {
				$pag = "productos-fabs";
			}

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "' . $pag . '";

								}
							})

				</script>';
			}
		}
	}
}
