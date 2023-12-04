/*=============================================
CREAR USUARIO
=============================================*/
$(".btnCrearUsuario").on("click", function () {
	$("#ID").val('');
	$("#IDant").val('');
	$("#NomLegal_o_RS").val('');
	//$("#NomLegal_o_RSant").val('');
	if (!$("#labelPassword").html().includes("*")) {
		$("#labelPassword").html($("#labelPassword").html() + "*");
	}
	$("#Password").val('');
	$("#Email").val('');
	$("#Emailant").val('');
	$("#Tel").val('');
	$("#Telant").val('');
	$("#fotoActual").val('');
	$(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");
	if ($("#tabla").val() != "") {
		$("#EstadoSelect").html('');
		// Crear elemento option child para EstadoSelect
		$('<option>').attr("id", "Estado").appendTo($("#EstadoSelect"));
		$("#Estado").html("Elegir Estado");
		$("#CiudadSelect").html('');
		// Crear elemento option child para CiudadSelect
		$('<option>').attr("id", "Ciudad").appendTo($("#CiudadSelect"));
		$("#Ciudad").html("Elegir Ciudad");
	}

	if ($("#tabla").val() != "" && $("#tabla").val() != "agentes") {
		$("#NomLegal_o_RS").val('');
		//$("#NomLegal_o_RSant").val('');
		$("#dirfiscal").val('');
		$("#Dir_Fiscalant").val('');
		$(".domicilio").val('');
		$("#Domicilioant").val('');
		if ($(".domicilio").length > 1) {
			$(".domicilio").not(":first").closest('.form-group').remove();
		}
		$("#CP").val('');
		["SF", "AC", "IDE", "CompDom"].forEach(function (prefix) {
			$("#" + prefix + "Actual").val('');
			$("#link" + prefix).html('');
			$("#link" + prefix).attr("href", '');
			$("#link" + prefix).attr("download", '');
			$("#miniatura" + prefix).attr("src", "");
			$("#miniatura" + prefix).attr("title", "");
			$("#miniatura" + prefix).attr("style", "");
		});
		$(".Tipopersona").prop("checked", false);
		$("#labelAC, #AC, #miniaturaAC, #linkAC, #ACActual").hide();

		if ($("#tabla").val() == "solicitantes" || $("#tabla").val() == "dists") {
			$("#Historia").val('');
			$("#Propuesta").val('');

			// Crear elemento option child para MayoristaSelect
			$("#Mayorista").html("Elegir Mayorista");

			$(".formzona:not(#formzona)").remove(); // Eliminar los formzona agregados, excepto el original
			$("#ZonaName").val(""); // Vaciar el valor de ZonaName

			// Restablecer el contador y el id del formzona original
			contadorZona = 1;
			$("#formzona").attr("id", "formzona" + contadorZona);
			$("#ZonaName").attr("id", "ZonaName" + contadorZona);


			$("#AgenteSelect").html('');
			// Crear elemento option child para AgenteSelect
			$('<option>').attr("id", "Agente").appendTo($("#AgenteSelect"));
			$("#Agente").html("Elegir Agente");
		}
	}
	else {
		$("#labelNomLegalRS").text('Nombre Legal');
	}

});

/*===============s==============================
EDITAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEditarUsuario", function () {
	$("#labelPassword").html($("#labelPassword").html().replace("*", ""));
	var idUsuario = $(this).attr("idUsuario");
	var tabla = $(this).attr("tabla");

	var datos = new FormData();
	datos.append("idUsuario", idUsuario);
	datos.append("tabla", tabla);

	$.ajax({

		url: "ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			$("#ID").val(respuesta["ID"]);
			$("#IDant").val(respuesta["ID"]);
			$("#NomLegal_o_RS").val(respuesta["nombre_legal_o_rs"]);
			$("#PasswordActual").val(respuesta["contrasena"]);
			$("#Email").val(respuesta["email"]);
			$("#Emailant").val(respuesta["email"]);
			$("#Tel").val(respuesta["tel"]);
			$("#Telant").val(respuesta["tel"]);

			if (respuesta["foto"] != "") {

				$(".previsualizar").attr("src", respuesta["foto"]);
				$("#fotoActual").val(respuesta["foto"]);

			} else {

				$(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");

			}
			if ($("#tabla").val() != "") {
				$("#Estado").html(respuesta["estado"]);
				$("#Estado").val(respuesta["estado"]);
				$("#Ciudad").html(respuesta["ciudad"]);
				$("#Ciudad").val(respuesta["ciudad"]);
			}
			if ($("#tabla").val() != "" && $("#tabla").val() != "agentes") {
				$("#Dir_Fiscal").val(respuesta["dir_fiscal"]);
				$("#Dir_Fiscalant").val(respuesta["dir_fiscal"]);
				domicilios = respuesta["domicilios"].split("<br>");
				$(".domicilio").first().val(domicilios[0]);
				//$("#Domicilioant").val(domicilios[0]);
				if ($(".domicilio").length > 1) {
					$(".domicilio").not(":first").closest('.form-group').remove();
				}
				for (i = 1; i < domicilios.length; i++) {
					var divPadre = $(".domicilio").last().closest('.form-group');

					// Clonar el div original
					var nuevoDiv = divPadre.clone();

					//nuevoDiv.find('#Domicilioant').remove();
					// Actualizar los ids de los elementos clonados
					nuevoDiv.find(".domicilio").val(domicilios[i]);
					var newButton = $('<button type="button" class="btn btn-danger btnQuitarDomicilio" style="height: 45px; width: 45px"><i class="fa fa-times"></i></button>');

					// Crear nuevo span y adjuntar el botón
					var newSpan = $('<span class="input-group-addon" style="padding: 0px 0px"></span>').append(newButton);

					// Adjuntar manejador de eventos al botón
					newButton.on("click", function () {
						$(this).closest(".form-group").remove();
					});
					// Reemplazar el span antiguo con el nuevo span
					nuevoDiv.find('.input-group span').last().replaceWith(newSpan);
					// Insertar el nuevo div después del div padre
					divPadre.after(nuevoDiv);
				}
				$("#CP").val(respuesta["cp"]);

				if (respuesta["tipo_persona"] == 0) {
					$("#Fisica").prop("checked", true);
					$("#labelAC, #AC, #miniaturaAC, #linkAC, #ACActual").hide();
				}
				else {
					$("#Moral").prop("checked", true);
					$("#labelAC, #AC, #miniaturaAC, #linkAC, #ACActual").show();
					if (respuesta["acta_const"] != "") {
						$("#ACActual").val(respuesta["acta_const"]);
						const fileName = respuesta["acta_const"].split("/").pop();
						$("#linkAC").attr("href", respuesta["acta_const"]);
						$("#linkAC").html(fileName + '<i class="fa fa-download" style="margin-left: 5px;"></i>');
						$("#linkAC").attr("download", fileName);
						Miniatura(respuesta["acta_const"], $("#miniaturaAC")[0]);
					} else {
						$("#linkAC").attr("href", '');
						$("#linkAC").attr("download", '');
						$("#linkAC").html('');
						$("#miniaturaAC").attr("src", "");
					}
				}

				const elementos = ["sit_fiscal", "identificacion", "comp_dom"];
				const prefixs = ["SF", "IDE", "CompDom"];

				for (const prefix of prefixs) {
					elem = respuesta[elementos[prefixs.indexOf(prefix)]];
					if (elem != "") {
						$("#" + prefix + "Actual").val(elem);
						const fileName = elem.split("/").pop();
						$("#link" + prefix).attr("href", elem);
						$("#link" + prefix).html(fileName + '<i class="fa fa-download" style="margin-left: 5px;"></i>');
						$("#link" + prefix).attr("download", fileName);
						Miniatura(elem, $("#miniatura" + prefix)[0]);
					} else {
						$("#link" + prefix).attr("href", '');
						$("#link" + prefix).attr("download", '');
						$("#link" + prefix).html('');
						$("#miniatura" + prefix).attr("src", "");
					}
				}

				if ($("#tabla").val() == "solicitantes" || $("#tabla").val() == "dists") {
					$("#Historia").val(respuesta["historia"]);
					$("#Propuesta").val(respuesta["propuesta"]);
					$("#Mayorista").html(respuesta["mayorista"]);
					$("#Mayorista").val(respuesta["mayorista"]);
					$("#Zona").html(respuesta["zona"]);
					$("#Zona").val(respuesta["zona"]);
					$("#Agente").html(respuesta["agente"]);
					$("#Agente").val(respuesta["agente"]);
					MayoristaSelect(respuesta["mayorista"]);
				}
			}
		}

	});

	if ($("#tabla").val() != "") {
		EstadoSelect()
	};
	$("#tipoguardar").attr("value", "editar");

})

/*=============================================
ESTADO Y CIUDAD SON REQUERIDOS PARA NO ADMINS Y NO FABRICANTES
=============================================*/
if ($("#tabla").val() != "") {
	$("#EstadoLabel").append("*");
	$("#CiudadLabel").append("*");
	$("#EstadoSelect").attr("required", "required");
	$("#CiudadSelect").attr("required", "required");
}

/*=============================================
ACTIVAR USUARIO
=============================================*/
$('.tablas').on('click', '.btnActivar', function () {
	var idUsuario = $(this).attr('idUsuario');
	var estadoUsuario = 1 - $(this).attr('estadoUsuario');
	var id = "ID";
	var estado = "estatus";
	var tabla = "usuarios";

	if (estadoUsuario == 1) {
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-success');
		$(this).html('Activado');
		$(this).attr('estadoUsuario', 1);
	} else {
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario', 0);
	}

	var datos = new FormData();
	datos.append('tabla', tabla);
	datos.append('actualizar1', estadoUsuario);
	datos.append('actualizar2', idUsuario);
	datos.append('item1', estado);
	datos.append('item2', id);

	$.ajax({
		url: 'ajax/general.ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {
			if (window.matchMedia('(max-width:767px)').matches) {
				swal({
					title: 'El usuario ha sido actualizado',
					type: 'success',
					confirmButtonText: '¡Cerrar!',
				}).then(function (result) {
					if (result.value) {
						var sPath = window.location.pathname;
						var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
						window.location = sPage;
					}
				});
			}
		}
	});
});

/*=============================================
ELIMINAR USUARIO
=============================================*/
$('.tablas').on('click', '.btnEliminarUsuario', function () {

	var idUsuario = $(this).attr('idUsuario');
	var tabla = $(this).attr('tabla');
	var fotoUsuario = $(this).attr('fotoUsuario');

	swal({
		title: '¿Está seguro de eliminar el usuario?',
		text: '¡Si no lo está puede cancelar la accíón!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, eliminar usuario!'
	}).then(function (result) {
		if (result.value) {
			var sPath = window.location.pathname;
			var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
			window.location = 'index.php?ruta=' + sPage + '&idUsuario=' + idUsuario + '&tabla=' + tabla + '&fotoUsuario=' + fotoUsuario;
		}
	});
});

/*=============================================
TIPO DE PERSONA
=============================================*/

// Cuando se cambie la selección del radio button
$(".Tipopersona").change(function () {
	const show = $(this).val() === "1";
	$("#labelAC, #AC, #miniaturaAC, #linkAC, #ACActual").toggle(show);
});

/*=============================================
AL CAMBIAR LA ZONA SE QUITA EL ESTADO SELECCIONADO
=============================================*/
$('#ZonaSelect').change(function () {
	$("#Estado").html('Elegir Estado').val('Elegir Estado');
	ZonaSelect();
});

/*=============================================
VALIDAR QUE NO EXISTA DETERMINADO ELEMENTO
=============================================*/
function validarElemento($elemento, elementoAnterior, item, tabla) {
	const valor = $elemento.val();
	const valorAnterior = elementoAnterior.val();

	if (valorAnterior !== "" && valor !== valorAnterior) {
		const datos = new FormData();
		datos.append("validar", valor);
		datos.append("tabla", tabla);
		datos.append("item_validar", item);

		$.ajax({
			url: "ajax/general.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (respuesta) {
				const alerta = $elemento.next(".alerta");

				if (alerta.length > 0) {
					alerta.remove();
				}
				if (respuesta) {
					$elemento.css('border-color', 'red');
					$elemento.after('<span class="alerta" style="color: red;"><i class="fa fa-times"></i>Este valor ya existe en el sistema</span>');
				} else {
					if ($elemento.css('border-color') === 'rgb(255, 0, 0)') {
						$elemento.css('border-color', '');
					}
				}
			}
		});
	}
}

$("#ID").change(function () {
	var sPath = window.location.pathname;
	var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
	if (sPage == "formulario-solicitantes") {
		validarElemento($(this), $("#IDant"), "ID", "usuarios");
	}
});

$("#Email").change(function () {
	checkEmail($(this).val());
	validarElemento($(this), $("#Emailant"), "email", "usuarios");
});

$("#Tel").change(function () {
	checkTel($(this).val());
	validarElemento($(this), $("#Telant"), "tel", "usuarios");
});

$(".domicilio").change(function () {
	validarElemento($(this), $("#Domicilioant"), "domicilio", $("#tabla").val());
});

/*=============================================
Elegir Estado o Agente
=============================================*/
$('#ZonaSelect').change(function () {
	if ($("#tabla").val() == "agentes") {
		$("#Estado").html('Elegir Estado');
		$("#Estado").val('Elegir Estado');
		ZonaSelect();
	}
	else {
		$("#Agente").html('Elegir Agente');
		$("#Agente").val('Elegir Agente');
		AgenteSelect();
	}
});

/*=============================================
Elegir Estados
=============================================*/
var AgenteSelect = function (AgenteSelect) {
	var idAgente = AgenteSelect;
	var tabla = "agentes";
	var datos = new FormData();
	datos.append("idUsuario", idAgente);
	datos.append("tabla", tabla);
	$.ajax({
		url: "ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			var estado = 'EstadoSelect';
			var select = $('#' + estado);
			var datos1 = new FormData();
			datos1.append("ID", respuesta['zona']);
			datos1.append("tabla", 'zonas');
			// Realizar la segunda llamada AJAX
			$.ajax({
				url: "ajax/general.ajax.php", // Cambiar por la URL de tu servidor
				method: "POST",
				data: datos1,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuestaZonas) {
					var estados = respuestaZonas['estados'].split(','); // Separar los estados
					$('#Estado option:not(:first)').remove();
					// Crear y agregar las nuevas opciones
					estados.forEach(function (estado) {
						var option = $('<option>', {
							value: estado,
							text: estado
						});
						select.append(option);
					});
				}
			});
			EstadoSelect();
		}
	})
}

/*=============================================
Elegir Estados
=============================================*/
$('#AgenteSelect').change(function () {
	$("#Estado").html('Elegir Estado');
	$("#Estado").val('Elegir Estado');
	AgenteSelect();
});

/* =============================================
Desplegar todos los Estados
============================================= */
var TodosEstados = function () {
	var estado = 'EstadoSelect';
	var select = $('#' + estado);
	$.getJSON('vistas/js/estados-munics.json', function (json) {
		var child = select.children().last();
		while (child.attr('id') != 'Estado') {
			child.remove();
			child = select.children().last();
		}

		json.forEach(item => {
			Object.keys(item).forEach(key => {
				var option = $('<option>', {
					'value': key,
					'text': key
				});
				select.append(option);
			});
		});
	});
};

/*=============================================
Elegir Municipios
=============================================*/
var EstadoSelect = function () {
	var Estado = $('#EstadoSelect').val();
	var select = $('#CiudadSelect');
	$.getJSON('vistas/js/estados-munics.json')
		.done(function (json) {
			for (var key in json[0]) {
				if (key == Estado) {
					var child = select.children().last();
					while (child.attr('id') != 'Ciudad') {
						child.remove();
						child = select.children().last();
					}
					for (var key1 in json[0][key]) {
						var option = $('<option>');
						option.val(json[0][key][key1]);
						option.text(json[0][key][key1]);
						select.append(option);
					}
					break;
				}
			}
		})
		.fail(function (error) {
			console.error(error);
		});
}
$('#EstadoSelect').change(function () {
	$("#Ciudad").html('Elegir Ciudad');
	$("#Ciudad").val('Elegir Ciudad');
	EstadoSelect()
})

/*=============================================
Elegir Zonas del Mayorista
=============================================*/
var MayoristaSelect = function (MayoristaSelect) {
	var mayorista = MayoristaSelect;
	var tabla = "zonas";
	var zona = 'ZonaSelect';
	var select = $("#" + zona);
	var datos = new FormData();
	datos.append("item_enc", "ID");
	datos.append("item_cond", "mayorista");
	datos.append("valor_item_cond", mayorista);
	datos.append("tabla", tabla);

	$.ajax({
		url: "ajax/general.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			$('#Zona option:not(:first)').remove();
			$.each(respuesta, function (key, value) {
				var option = $("<option></option>").attr("value", value).html(value);
				select.append(option);
			});
			ZonaSelect();
		}
	});
};
$('#MayoristaSelect').change(function () {
	$("#Zona").html('Elegir Zona');
	$("#Zona").val('Elegir Zona');
	MayoristaSelect($('#MayoristaSelect').val());
})

/*=============================================
Elegir Agentes o Estados
=============================================*/
var ZonaSelect = function () {
	var Zona = $('#Zona').val();

	if ($('#tabla').val() == "agentes") {
		var estado = 'EstadoSelect';
		var select = $('#' + estado);
		var datos1 = new FormData();
		datos1.append("ID", Zona);
		datos1.append("tabla", 'zonas');
		// Realizar la segunda llamada AJAX
		$.ajax({
			url: "ajax/general.ajax.php", // Cambiar por la URL de tu servidor
			method: "POST",
			data: datos1,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (respuesta) {
				var estados = respuesta['estados'].split(','); // Separar los estados
				$('#Estado option:not(:first)').remove();
				// Crear y agregar las nuevas opciones
				estados.forEach(function (estado) {
					var option = $('<option>', {
						value: estado,
						text: estado
					});
					select.append(option);
				});
			}
		});
		EstadoSelect();
	} else {
		var tabla = "agentes";
		var agente = 'AgenteSelect';
		var select = $("#" + agente);

		var datos = new FormData();
		datos.append("item_enc", "ID");
		datos.append("item_cond", "zona");
		datos.append("valor_item_cond", Zona);
		datos.append("tabla", tabla);
		$.ajax({
			url: "ajax/general.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "Json",
			success: function (respuesta) {

				$('#Agente option:not(:first)').remove();
				$.each(respuesta, function (key, value) {
					var option = $("<option></option>").attr("value", value.ID).html(value.ID);
					select.append(option);
				});
			}
		})
		AgenteSelect(select.val());
	}
}

/* =============================================
Agregar Miniatura
============================================= */
$(".archivo").change(function () {
	mostrarMiniatura($(this).attr("id"), "miniatura" + $(this).attr("id"));
	if ($(this).next(".alerta").length > 0) {
		$(this).next(".alerta").remove();
	}
})

/* =============================================
Agregar Miniatura
============================================= */
function mostrarMiniatura(inputId, imagenId) {
	const input = $("#" + inputId)[0];
	const lector = new FileReader();
	lector.readAsDataURL(input.files[0]);

	lector.onload = function () {
		const pdfData = lector.result;
		const imagen = $("#" + imagenId)[0];
		$("#link" + inputId).html('');
		$("#link" + inputId).attr("href", '');
		$("#link" + inputId).attr("download", '');
		Miniatura(pdfData, imagen);
	};
}

/* =============================================
Agregar Miniatura
============================================= */
function Miniatura(pdfData, imagen) {
	const pdf = window.pdfjsLib.getDocument(pdfData);
	pdf.promise.then(function (pdf) {
		pdf.getPage(1).then(function (pagina) {
			const canvas = $("<canvas>")[0];
			const contexto = canvas.getContext('2d');
			const viewport = pagina.getViewport({ scale: 0.25 });
			canvas.height = viewport.height;
			canvas.width = viewport.width;

			pagina.render({
				canvasContext: contexto, viewport: viewport
			}).promise.then(function () {
				imagen.src = canvas.toDataURL('image/png');
			});
		});
	});
	imagen.style.border = "1px solid #ccc";
	imagen.style.boxShadow = "2px 2px 5px rgba(0, 0, 0, 0.3)";
	imagen.style.transition = "transform 0.2s ease-in-out";

	function escalarImagen() {
		this.style.transform = "scale(1.1)";
		this.style.cursor = "pointer";
	}

	function reducirImagen() {
		this.style.transform = "scale(1)";
	}

	function abrirPDF() {
		window.open(pdfData, '_blank');
	}

	if (!pdfData.includes("data:application/pdf;base64")) {
		imagen.title = "Ver PDF";
		$(imagen).on("mouseenter", escalarImagen);
		$(imagen).on("mouseleave", reducirImagen);
		$(imagen).on("click", abrirPDF);

	} else {
		imagen.title = "";
		$(imagen).off("mouseenter");
		$(imagen).off("mouseleave");
		$(imagen).off("click");
		imagen.style.cursor = "auto";
	}
}

/* =============================================
Generar Miniatura
============================================= */
function generarMiniaturas() {
	const DocsTipos = ["SF", "AC", "IDE", "CompDom"];

	for (let i = 0; i < DocsTipos.length; i++) {
		const tipoDocumento = DocsTipos[i];
		const Links = $(".link" + tipoDocumento);
		const Mins = $(".min" + tipoDocumento);
		Links.map(function () {
			const href = $(this).attr("href");
			const posicion = $(this).index();
			if (href != undefined && href != "") {
				Miniatura(href, Mins[posicion]);
			}
		});
	}
}
$(function () {
	if ($("#tabla").val() == "dists" || $("#tabla").val() == "mayoristas" || $("#tabla").val() == "solicitantes") {
		generarMiniaturas();
	}
})

/*=============================================
Seguridad de contraseña
=============================================*/
$(document).on('keyup', '#Password', function () {
	var password = $(this).val();
	var passwordStrength = checkPasswordStrength(password);

	if (passwordStrength === 'weak') {
		$(this).css('border-color', 'red');
		$('#passwordStrength').html('<i class="fa fa-times"></i> La contraseña es débil.Para hacerla segura, debe tener al menos 8 caracteres, mayúsculas, minúsculas, números y carácteres especiales como !@#$%^&*.').css('color', 'red');
	} else if (passwordStrength === 'moderate') {
		$(this).css('border-color', 'orange');
		$('#passwordStrength').html('<i class="fa fa-exclamation"></i> La contraseña es moderada. Para hacerla segura, debe tener al menos 8 caracteres y un carácter especial como !@#$%^&*.').css('color', 'orange');
	} else if (passwordStrength === 'strong') {
		$(this).css('border-color', 'green');
		$('#passwordStrength').html('<i class="fa fa-check"></i> La contraseña es segura').css('color', 'green');
	}

	if ($('#ConfirmPassword').length) {
		checkPasswordCoincide();
	}
});

/*=============================================
Revisar que los dos campos de la contraseña coincidan
=============================================*/
$(document).on('keyup', '#ConfirmPassword', function () {
	checkPasswordCoincide();
});

/*=============================================
Revisar campos al enviar formulario
=============================================*/
function checkPasswordCoincide() {
	if ($('#Password').val() == $('#ConfirmPassword').val()) {
		$('#ConfirmPassword').css('border-color', 'green');
		$('#passwordCoincide').html('<i class="fa fa-check"></i> Las contraseñas coinciden').css('color', 'green');
	} else {
		$('#ConfirmPassword').css('border-color', 'red');
		$('#passwordCoincide').html('<i class="fa fa-times"></i> Las contraseñas no coinciden').css('color', 'red');
	}
}

/*=============================================
Seguridad de contraseña
=============================================*/
function checkPasswordStrength(password) {
	var strength = 'weak';
	var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
	var moderateRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})");

	if (strongRegex.test(password)) {
		strength = 'strong';
	} else if (moderateRegex.test(password)) {
		strength = 'moderate';
	}

	return strength;
}

/*=============================================
Checar Email
=============================================*/
function checkEmail(email) {
	var campovalido = true;
	var emailRegEx = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
	$("#Email").next(".alerta").remove();
	if (!emailRegEx.test(email)) {
		$('#Email').css('border-color', 'red');
		$('#Email').after('<span style="color: red;" class="alerta">Por favor, introduce un correo electrónico válido.</div>');
		campovalido = false;
	}
	else {
		$('#Email').css('border-color', '');
		campovalido = true;
	}
	return campovalido;
}

/*=============================================
Checar Teléfono
=============================================*/
function checkTel(tel) {
	var campovalido = true;
	var telRegEx = /^\(\d{3}\)\s\d{3}-\d{4}$/;
	$("#Tel").next(".alerta").remove();
	if (!telRegEx.test(tel)) {
		$('#Tel').css('border-color', 'red');
		$('#Tel').after('<span style="color: red;" class="alerta">Por favor, introduce un número de teléfono válido.</div>');
		campovalido = false;
	}
	else {
		$('#Tel').css('border-color', '');
		campovalido = true;
	}
	return campovalido;
}

/*=============================================
Checar CP
=============================================*/
function checkCP(cp) {
	$("#CP").next(".alerta").remove();
	var campovalido = true;
	// Para el código postal (asumiendo que es un código postal de 5 dígitos)
	var cpRegEx = /^\d{5}$/;
	if (!cpRegEx.test(cp)) {
		$('#CP').css('border-color', 'red');
		$('#CP').after('<span style="color: red;" class="alerta">Por favor, introduce un código postal válido.</div>');
		campovalido = false;
	}
	else {
		$('#CP').css('border-color', '');
		campovalido = true;
	}
	return campovalido;
}

/*=============================================
Checar CP
=============================================*/
$('#CP').change(function () {
	checkCP($(this).val());
});

/*=============================================
Agregar otro Domicilio
=============================================*/
$("#btnAgregarNuevoDomicilio").on("click", function () {
	// Obtener el div padre del botón presionado
	var ultDiv = $('.domicilio').last().closest('.form-group');

	// Clonar el div original
	var nuevoDiv = ultDiv.clone();
	nuevoDiv.find('.domicilio').val('');
	//nuevoDiv.find('#Domicilioant').remove();

	ultDiv.after(nuevoDiv);

	// Crear nuevo botón
	var newButton = $('<button type="button" class="btn btn-danger btnQuitarDomicilio" style="height: 45px; width: 45px"><i class="fa fa-times"></i></button>');

	// Crear nuevo span y adjuntar el botón
	var newSpan = $('<span class="input-group-addon" style="padding: 0px 0px"></span>').append(newButton);

	// Reemplazar el span antiguo con el nuevo span
	nuevoDiv.find('.input-group span').last().replaceWith(newSpan);

	// Adjuntar manejador de eventos al botón
	newButton.on("click", function () {
		$(this).closest(".form-group").remove();
	});
});