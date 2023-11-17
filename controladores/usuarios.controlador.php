<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	public static function ctrIngresoUsuario()
	{

		if (isset($_POST["username"])) {

			$ip = $_SERVER["REMOTE_ADDR"];
			$captcha = $_POST['g-recaptcha-response'];
			$secretKey = '6LfDyOskAAAAAOTxW3Rew22w8VPukzDa3PLfOwH7';

			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip={$ip}");

			$atributos = json_decode($response, TRUE);

			if (!$atributos['success']) {
				echo '<br><div class="alert alert-danger" style="margin: 0 auto;">Verifica el captcha</div>';
			} else {

				$encriptar = crypt($_POST["pass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "ID";
				$valor = $_POST["username"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios(null, $item, $valor);

				if (is_array($respuesta) && $respuesta["ID"] == $_POST["username"] && $respuesta["contrasena"] == $encriptar) {

					if ($respuesta["estatus"] == 1) {

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["ID"] = $respuesta["ID"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["tipo"] = $respuesta["tipo"];

						date_default_timezone_set('America/Mexico_City');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha . ' ' . $hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "ID";
						$valor2 = $respuesta["ID"];

						$ultimoLogin = ModeloGeneral::mdlActualizar($tabla, $item1, $valor1, $item2, $valor2);

						if ($ultimoLogin == "ok") {

							if ($_SESSION["tipo"] == "Administrador" || $_SESSION["tipo"] == "Fabricante" || $_SESSION["tipo"] == "Mayorista") {
								echo '<script>

								window.location = "inicio";

							</script>';
							} else if ($_SESSION["tipo"] == "Solicitante") {
								echo '<script>

								window.location = "info-cuenta";

							</script>';
							} else if ($_SESSION["tipo"] == "Agente") {
								echo '<script>

								window.location = "solicitantes";

							</script>';
							} else if ($_SESSION["tipo"] == "Distribuidor") {
								echo '<script>

								window.location = "catalogo";

							</script>';
							}
						}
					} else {

						echo '<br>
							<div class="alert alert-danger" style="margin: 0 auto;">El usuario aún no está activado</div>';
					}
				} else {

					echo '<br><div class="alert alert-danger" style="margin: 0 auto;">Error al ingresar, vuelve a intentarlo</div>';
				}
			}
		}
	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	public static function ctrMostrarUsuarios($item, $valor, $tabla2)
	{

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla2, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	ELIMINAR USUARIO
	=============================================*/

	public static function ctrEliminarUsuario()
	{

		if (isset($_GET["idUsuario"])) {

			$tabla = "usuarios";
			$tabla2 = $_GET["tabla"];
			$datos = $_GET["idUsuario"];

			if ($_GET["fotoUsuario"] != "") {

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/' . $_GET["idUsuario"]);
			}

			$respuesta = $respuesta = ModeloGeneral::mdlEliminar($tabla, $tabla2, $datos);

			$pag = "";
			if ($tabla2 != "") {
				$pag = $tabla2;
			} else {
				$pag = "AdminsYFabs";
			}

			if ($respuesta == "ok") {
				if ($_SESSION["ID"] == $datos) {
					$pag = "salir";
				}
				echo '<script>

				swal({
					  type: "success",
					  title: "El Usuario ha sido borrado correctamente",
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
					  title: "El Usuario no se pudo eliminar",
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

	public static function GuardarUsuario()
	{

		$tabla2 = $_POST["tabla"];

		$tipo = $_POST["tipoguardar"];

		$data = $_POST;
		$errors = ControladorUsuarios::validateForm($data);

		if (!empty($errors)) {
			$errorTypes = implode(', ', $errors);
			$errorTitle = "¡Error: El Usuario no se pudo guardar, ingresa correctamente los siguientes campos obligatorios: $errorTypes!";

			echo '<script>
		swal({
			type: "error",
			title: "' . $errorTitle . '",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"
		}).then(function(result) {
			if (result.value) {
				window.location = "' . $_SERVER["REQUEST_URI"] . '";
			}
		});
	</script>';
		} else {
			$ruta = $_POST["fotoActual"];
			$NomLegal_o_RS = "";

			if (isset($_FILES["Foto"]["tmp_name"]) && !empty($_FILES["Foto"]["tmp_name"])) {

				list($ancho, $alto) = getimagesize($_FILES["Foto"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*=============================================
			CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
			=============================================*/

				$directorio = "vistas/img/usuarios/" . $_POST["ID"];

				/*=============================================
			PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
			=============================================*/

				if (!empty($_POST["fotoActual"])) {

					unlink($_POST["fotoActual"]);

					if ($_POST["IDant"] != $_POST["ID"]) {
						rmdir("vistas/img/usuarios/" . $_POST["IDant"]);
						mkdir($directorio, 0755);
					}
				} else {

					mkdir($directorio, 0755);
				}

				/*=============================================
			DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			=============================================*/

				if ($_FILES["Foto"]["type"] == "image/jpeg") {

					/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

					$aleatorio = mt_rand(100, 999);

					$ruta = $directorio . "/" . $aleatorio . ".jpg";

					$origen = imagecreatefromjpeg($_FILES["Foto"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);
				}

				if ($_FILES["Foto"]["type"] == "image/png") {

					/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

					$aleatorio = mt_rand(100, 999);

					$ruta = $directorio . "/" . $aleatorio . ".png";

					$origen = imagecreatefrompng($_FILES["Foto"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);
				}
			}

			$encriptar = "";

			if (isset($_POST["Password"]) && !empty($_POST["Password"])) {
				if (!isset($_POST["ConfirmPassword"]) || $_POST["Password"] == $_POST["ConfirmPassword"]) {
					$encriptar = crypt($_POST["Password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				}
			} else {

				$encriptar = $_POST["PasswordActual"];
			}

			$sf = "";
			$ac = "";
			$ide = "";
			$compdom = "";
			if ($tabla2 != "") {
				$NomLegal_o_RS = $_POST["NomLegal_o_RS"];
			}
			if ($tabla2 != "" and $tabla2 != "agentes") {
				$sf = $_POST["SFActual"];
				$ac = $_POST["ACActual"];
				$ide = $_POST["IDEActual"];
				$compdom = $_POST["CompDomActual"];
				if (isset($_FILES["SF"]["tmp_name"]) && !empty($_FILES["SF"]["tmp_name"])) {
					$sf = ControladorUsuarios::SubirPDF($_FILES["SF"], "SF", $tabla2, $_POST["ID"]);
				}
				if (isset($_FILES["AC"]["tmp_name"]) && !empty($_FILES["AC"]["tmp_name"])) {
					$ac = ControladorUsuarios::SubirPDF($_FILES["AC"], "AC", $tabla2, $_POST["ID"]);
				}
				if (isset($_FILES["IDE"]["tmp_name"]) && !empty($_FILES["IDE"]["tmp_name"])) {
					$ide = ControladorUsuarios::SubirPDF($_FILES["IDE"], "IDE", $tabla2, $_POST["ID"]);
				}
				if (isset($_FILES["CompDom"]["tmp_name"]) && !empty($_FILES["CompDom"]["tmp_name"])) {
					$compdom = ControladorUsuarios::SubirPDF($_FILES["CompDom"], "CompDom", $tabla2, $_POST["ID"]);
				}
			}
			if ($_POST["IDant"] != $_POST["ID"] && $_POST["IDant"] == $_SESSION["ID"]) {
				$_SESSION["ID"] = $_POST["ID"];
				if ($ruta == $_POST["fotoActual"]) {

					rename("vistas/img/usuarios/" . $_POST["IDant"], "vistas/img/usuarios/" . $_POST["ID"]);
					$ruta = "vistas/img/usuarios/" . $_POST["ID"] . substr($ruta, 20 + strlen($_POST["IDant"]), -1) . "g";
				}
			}
			if ($_POST["ID"] == $_SESSION["ID"] && $_SESSION["foto"] != $ruta) {
				$_SESSION["foto"] = $ruta;
			}

			$datos = array(
				"IDant" => $_POST["IDant"],
				"ID" => $_POST["ID"],
				"nombre_legal_o_rs" => $NomLegal_o_RS,
				"contrasena" => $encriptar,
				"email" => $_POST["Email"],
				"tel" => $_POST["Tel"],
				"foto" => $ruta
			);

			if ($tabla2 == null) {
				$datos["tipo"] = $_POST["Tipo"];
			} else {
				$datos["estado"] = $_POST["Estado"];
				$datos["ciudad"] = $_POST["Ciudad"];
				$tipos = ['mayoristas' => 'Mayorista', 'agentes' => 'Agente', 'dists' => 'Distribuidor', 'solicitantes' => 'Solicitante'];
				$datos["tipo"] = $tipos[$tabla2];

				if ($tabla2 == "mayoristas") {
					/*$zonas = "";
					if (is_array($_POST['ZonaName'])) {  // Verificar si es un array
						// Es un array, así que unir los valores con comas
						$zonas = implode("<br>", $_POST['ZonaName']);
					} else {
						// No es un array, así que solo guardar el valor
						$zonas = $_POST['ZonaName'];
					}
					$datos["zonas"] = $zonas;

					// Obtener la cantidad de elementos en el arreglo
					/*$cantidadZonas = count($zonas);

					for ($i = 0; $i < $cantidadZonas; $i++) {
						$datosZona = array(
							"ID" => $zonas[$i],
							"estados" => ,
							"ciudades" => 

						);
					}*/
				} else {
					$datos["zona"] = $_POST["Zona"];
					$datos["mayorista"] = $_POST["Mayorista"];
					if ($tabla2 != "agentes") {
						$datos["agente"] = $_POST["Agente"];
					}
				}

				if (in_array($tabla2, ['mayoristas', 'dists', 'solicitantes'])) {
					$datos["tipo_persona"] = $_POST["Tipopersona"];
					$datos["dir_fiscal"] = $_POST["Dir_Fiscal"];
					$domicilios = array();
					$domiciliosSeparados = "";
					// Asegurarse de que $_POST['Domicilio'] existe y es un arreglo
					if (isset($_POST['Domicilio']) && is_array($_POST['Domicilio'])) {
						$domicilios = $_POST['Domicilio'];

						// Unir los domicilios en una cadena separada por "<br>"
						$domiciliosSeparados = implode("<br>", $domicilios);
					} else {
						// Manejar el caso en que $_POST['Domicilio'] no existe o no es un arreglo
						$domiciliosSeparados = $_POST['Domicilio'];
					}
					$datos['domicilios'] = $domiciliosSeparados;
					$campos_comunes = ['cp' => 'CP'];
					$campos_variables = ['sit_fiscal' => $sf, 'acta_const' => $ac, 'identificacion' => $ide, 'comp_dom' => $compdom];

					foreach ($campos_comunes as $campo => $nombre) {
						$datos[$campo] = $_POST[$nombre];
					}

					foreach ($campos_variables as $campo => $nombre) {
						$datos[$campo] = $nombre;
					}
				}

				if (in_array($tabla2, ['dists', 'solicitantes'])) {
					$datos["historia"] = $_POST["Historia"];
					$datos["propuesta"] = $_POST["Propuesta"];
				}

				if ($tabla2 == "solicitantes") {
					$datos["observs"] = $_POST["Observs"];
				}
			}

			$respuesta = ModeloUsuarios::mdlGuardarUsuario($tabla2, $datos, $tipo);

			if ($respuesta == "ok") {

				echo '<script>

			swal({
					type: "success",
					title: "El usuario ha sido guardado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result) {
							if (result.value) {

								window.location ="' . $_SERVER["REQUEST_URI"] . '";

							}
						})

			</script>';
			} else {
				echo '<script>

			swal({
					type: "error",
					title: "El usuario no pudo ser guardado",
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
	GUARDAR USUARIOS
	=============================================*/

	public static function ctrGuardarUsuario()
	{

		if (isset($_POST["guardar"])) {

			if ($_SERVER["REQUEST_URI"] == "formulario-solicitantes") {
				$ip = $_SERVER["REMOTE_ADDR"];
				$captcha = $_POST['g-recaptcha-response'];
				$secretKey = '6LfDyOskAAAAAOTxW3Rew22w8VPukzDa3PLfOwH7';

				$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip={$ip}");

				$atributos = json_decode($response, TRUE);

				if (!$atributos['success']) {
					echo '<br><div class="alert alert-danger">Verifica el captcha</div>';
				} else {
					ControladorUsuarios::GuardarUsuario();
				}
			} else if (isset($_POST["ActualPassword"])) {
				$tabla = $_POST["tabla"];
				if ($tabla == null) {
					$tabla = "usuarios";
				}
				$item = "ID";
				$valor = $_SESSION["ID"];
				$item1 = "contrasena";
				$contrasenareal = ModeloGeneral::mdlMostrarItems($tabla, $item, $valor, $item1);
				$contrasenaprobar = crypt($_POST["ActualPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				if ($contrasenaprobar == $contrasenareal) {
					ControladorUsuarios::GuardarUsuario();
				} else {
					echo '<script>

					swal({
							type: "error",
							title: " ¡Contraseña incorrecta! ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result) {
									if (result.value) {
		
										window.location ="' . $_SERVER["REQUEST_URI"] . '";
		
									}
								})
		
					</script>';
				}
			} else {
				ControladorUsuarios::GuardarUsuario();
			}
		}
	}

	/*=============================================
	ASIGNAR MAYORISTA Y AGGENTE A SOLICITANTE
	=============================================*/

	public static function ctrAsignar()
	{
		if (isset($_POST["tipoasignar"])) {
			$tipoasignar = $_POST["tipoasignar"];
			$tabla = "solicitantes";

			if ($_SESSION["tipo"] == "Administrador" || $_SESSION["tipo"] == "Fabricante") {
				$item1 = "mayorista";
				$valor1 = $_POST["Mayorista1"];
				$item2 = "ID";
				$valor2 = $_POST["IDAsign"];
				$resp_mayorista = ModeloGeneral::mdlActualizar($tabla, $item1, $valor1, $item2, $valor2);
			}

			if ($tipoasignar == "mayorista") {

				if ($resp_mayorista == "ok") {
					echo '<script>

						swal({
								type: "success",
								title: "El mayorista ha sido asignado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result) {
										if (result.value) {
			
											window.location ="' . $_SERVER["REQUEST_URI"] . '";
			
										}
									})
			
						</script>';
				} else {
					echo '						
						swal({
							type: "error",
							title: "¡El mayorista no se pudo asignar!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result) {
							if (result.value) {

								window.location ="' . $_SERVER["REQUEST_URI"] . '";

							}
						})';
				}
			} else {
				$item1 = "zona";
				$valor1 = $_POST["Zona1"];
				$item2 = "ID";
				$valor2 = $_POST["IDAsign"];
				$item3 = "agente";
				$valor3 = $_POST["Agente1"];
				$resp_zona = ModeloGeneral::mdlActualizar($tabla, $item1, $valor1, $item2, $valor2);
				$resp_agente = ModeloGeneral::mdlActualizar($tabla, $item3, $valor3, $item2, $valor2);
				if ($resp_mayorista == "ok" && $resp_zona == "ok" && $resp_agente == "ok") {
					echo '<script>

					swal({
							type: "success",
							title: "El agente ha sido asignado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result) {
									if (result.value) {
		
										window.location ="' . $_SERVER["REQUEST_URI"] . '";
		
									}
								})
		
					</script>';
				} else {
					echo 'swal({
						type: "error",
						title: "¡El agente no se pudo asignar!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result) {
						if (result.value) {

							window.location ="' . $_SERVER["REQUEST_URI"] . '";

						}
					})';
				}
			}
		}
	}

	public static function ctrResolucion()
	{
		if (isset($_POST["Observs"])) {
			$tabla = "solicitantes";
			$item1 = "observs";
			$valor1 = $_POST["Observs"];
			$item2 = "ID";
			$valor2 = $_POST["IDResol"];
			$observs = ModeloGeneral::mdlActualizar($tabla, $item1, $valor1, $item2, $valor2);
			if ($observs == "ok") {
				echo '<script>

			swal({
					type: "success",
					title: "Se han enviado las obsrvaciones correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result) {
							if (result.value) {

								window.location ="' . $_SERVER["REQUEST_URI"] . '";

							}
						})

			</script>';
			} else {
				echo '						
			swal({
				type: "error",
				title: "¡Las observaciones no se pudieron enviar!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"
				}).then(function(result) {
				if (result.value) {

					window.location ="' . $_SERVER["REQUEST_URI"] . '";

				}
			})';
			}
		} else if (isset($_POST["Aceptar"])) {
			$tabla = "usuarios";
			$tabla2 = "solicitantes";
			$valor = $_POST["IDResol"];

			if ($_GET["fotoUsuario"] != "") {

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/' . $_GET["idUsuario"]);
			}

			$item = "ID";

			$datosdist = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);

			$eliminarsolic = ModeloGeneral::mdlEliminar($tabla, $tabla2, $valor);

			$datos = array(
				"ID" => $datosdist["ID"],
				"nombre_legal_o_rs" => $datosdist["nombre_legal_o_rs"],
				"contrasena" => $datosdist["contrasena"],
				"email" => $datosdist["email"],
				"tel" => $datosdist["tel"],
				"estado" => $datosdist["estado"],
				"ciudad" => $datosdist["ciudad"],
				"foto" => $datosdist["foto"],
				"tipo" => "Distribuidor",
				"domicilio" => $datosdist["domicilio"],
				"cp" => $datosdist["cp"],
				"mayorista" => $datosdist["mayorista"],
				"zona" => $datosdist["zona"],
				"agente" => $datosdist["agente"],
				"historia" => $datosdist["historia"],
				"propuesta" => $datosdist["propuesta"],
				"sit_fiscal" => $datosdist["sit_fiscal"],
				"acta_const" => $datosdist["acta_const"],
				"identificacion" => $datosdist["identificacion"],
				"comp_dom" => $datosdist["comp_dom"],
			);

			$creardist = ModeloUsuarios::mdlGuardarUsuario($tabla, $tabla2, $datos, "crear");


			if ($eliminarsolic == "ok" && $datosdist == "ok" && $creardist == "ok") {

				echo '<script>

			swal({
				  type: "success",
				  title: "El Usuario ha sido aceptado para ser Distribuidor",
				  showConfirmButton: true,
				  confirmButtonText: "Cerrar",
				  closeOnConfirm: false
				  }).then(function(result) {
							if (result.value) {
								
								window.location = "dists";

							}
						})

			</script>';
			} else {
				echo '<script>

			swal({
				  type: "error",
				  title: "Error al aceptar usuario",
				  showConfirmButton: true,
				  confirmButtonText: "Cerrar",
				  closeOnConfirm: false
				  }).then(function(result) {
							if (result.value) {

								window.location ="' . $_SERVER["REQUEST_URI"] . '";

							}
						})

			</script>';
			}
		} else if (isset($_POST["Rechazar"])) {
			$tabla = "solicitantes";
			$item1 = "observs";
			$valor1 = $_POST["Observs"];
			$item2 = "ID";
			$valor2 = $_POST["IDResol"];
			$item3 = "rechazo";
			$valor3 = date('Y-m-d', strtotime(date('Y-m-d') . ' +15 days'));;
			$observs = ModeloGeneral::mdlActualizar($tabla, $item1, $valor1, $item2, $valor2);
			$fechalimite = ModeloGeneral::mdlActualizar($tabla, $item3, $valor3, $item2, $valor2);
			if ($observs == "ok" && $fechalimite == "ok") {
				echo '<script>

			swal({
					type: "success",
					title: "El solictante ha sido rechazado y tiene 15 días para corregir datos",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result) {
							if (result.value) {

								window.location ="' . $_SERVER["REQUEST_URI"] . '";

							}
						})

			</script>';
			} else {
				echo '						
			swal({
				type: "error",
				title: "¡El solicitante no se pudo rechazar!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"
				}).then(function(result) {
				if (result.value) {

					window.location ="' . $_SERVER["REQUEST_URI"] . '";

				}
			})';
			}
		}
	}

	/*=============================================
	SUBIR ARCHIVO PDF
	=============================================*/

	public static function SubirPDF($pdf, $tipoarchivo, $carpeta, $usr)
	{
		$nombre_archivo = $pdf["name"];
		$ruta_archivo_temporal = $pdf["tmp_name"];
		$directorio = "vistas/docs/" . $carpeta . "/" . $usr . "/";
		$ruta_archivo_permanente = $directorio . $nombre_archivo;

		if (!empty($_POST[$tipoarchivo . "Actual"])) {

			unlink($_POST[$tipoarchivo . "Actual"]);

			if ($_POST["IDant"] != $_POST["ID"]) {
				rmdir("vistas/docs/" . $carpeta . "/" . $_POST["IDant"]);
				mkdir($directorio, 0755);
			}
		} else {

			mkdir($directorio, 0755);
		}
		move_uploaded_file($ruta_archivo_temporal, $ruta_archivo_permanente);

		return $ruta_archivo_permanente;
	}
	public static function validateForm($data)
	{
		$requiredFields = [];
		$conditionalFields = ['SF', 'AC', 'IDE', 'CompDom'];
		$errors = [];

		if (empty($data['tabla'])) {
			$requiredFields = ['ID', 'Email', 'Tipo'];
		} else {
			$requiredFields = ['ID', 'NomLegal_o_RS', 'Email', 'Tel', 'Estado', 'Ciudad'];

			if ($data['tabla'] == "mayoristas" || $data['tabla'] == "dists" || $data['tabla'] == "solicitantes") {
				$extraFields = ['CP', 'Domicilio', 'RS'];
				$requiredFields = array_merge($requiredFields, $extraFields, $conditionalFields);
				// Para el código postal (asumiendo que es un código postal de 5 dígitos)
				$cp = $data['CP'];
				if (!preg_match('/^\d{5}$/', $cp)) {
					$errors[] = 'CP';
				}
			}

			if ($data['tabla'] == "agentes" || $data['tabla'] == "dists") {
				$requiredFields[] = 'Mayorista';
				$requiredFields[] = 'Zona';
			}

			if ($data['tabla'] == "dists") {
				$requiredFields[] = 'Agente';
			}
		}

		if ($data['tipoguardar'] == "crear") {
			$requiredFields[] = 'Password';
		}

		foreach ($requiredFields as $field) {
			if (!isset($data[$field]) || empty($data[$field])) {
				if (in_array($field, $conditionalFields)) {
					$actualField = $field . 'Actual';
					if (!isset($data[$actualField]) || empty($data[$actualField])) {
						$errors[] = $field;
					}
				} else {
					$errors[] = $field;
				}
			}
		}

		if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
			$errors[] = 'Email';
		}

		// Para el teléfono (asumiendo que es un número de 10 dígitos)
		$tel = $data['Tel'];
		if (!preg_match('/^\(\d{3}\)\s\d{3}-\d{4}$/', $tel)) {
			$errors[] = 'Tel';
		}

		if (isset($data["ConfirmPassword"]) && (($data["Password"] != $data["ConfirmPassword"]) || (empty($data["Password"]) && empty($data["ConfirmPassword"])))) {
			$errors[] = 'Password';
		}

		return $errors;
	}

	public static function ctrReestContrasena()
	{
		if (isset($_POST["Email"])) {
			$token = bin2hex(random_bytes(32));
			$resetLink = "https://" . $_SERVER['HTTP_HOST'] . "/restablecer-contrasena.php?token=" . $token;

			$to = $_POST["Email"];
			$subject = "Asunto del correo";
			$message = "Contenido del correo electrónico";

			$headers = "From: me@example.com" . "\r\n" .
				"Reply-To: " . $_POST["Email"] . "" . "\r\n" .
				"X-Mailer: PHP/" . phpversion();

			if (mail($to, $subject, $message, $headers)) {

				echo '<script>

				swal({
						type: "success",
						title: "El correo para reestablecer contraseña ha sido enviado exitosamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result) {
								if (result.value) {
	
									window.location ="' . $_SERVER["REQUEST_URI"] . '";
	
								}
							})
	
				</script>';
			} else {

				echo '<script>

				swal({
						type: "error",
						title: "El correo no se pudo enviar",
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
