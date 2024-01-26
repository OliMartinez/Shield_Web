/*=============================================
CREAR SOLICITANTE
=============================================*/
$(".btnCrearUsuario").on("click", function () {
	$("#Observs").html('');
})

/*=============================================
EDITAR SOLICITANTE
=============================================*/
$(".btnEditarUsuario").on("click", function () {
	var idUsuario = $(this).attr("idUsuario");
	var tabla = "solicitantes";

	var datos = new FormData();
	datos.append("id", idUsuario);
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
			$("#Observs").html(respuesta["observs"]);
		}

	});
})

// Seleccionamos el modal por su id
var modal = $("#modalAsignar");

/*=============================================
ASIGNAR MAYORISTA
=============================================*/
$(".btnAsignMayorista").on("click", function () {
	// Ocultamos los form-group excepto el primero dentro del modal
	modal.find(".form-group").not(":first").hide();

	var idUsuario = $(this).attr("idUsuario");
	var tabla = "solicitantes";

	var datos = new FormData();
	datos.append("id", idUsuario);
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
			$("#Mayorista1").html(respuesta["mayorista"]);
			$("#Mayorista1").val(respuesta["mayorista"]);
		}

	});
})

/*=============================================
ASIGNAR ZONA
=============================================*/
$(".btnAsignZona").on("click", function () {
	// Ocultamos los form-group excepto el primero dentro del modal
	modal.find(".form-group").not(":first").hide();

	var idUsuario = $(this).attr("idUsuario");
	var tabla = "solicitantes";

	var datos = new FormData();
	datos.append("id", idUsuario);
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
			$("#Mayorista1").html(respuesta["mayorista"]);
			$("#Mayorista1").val(respuesta["mayorista"]);
			$("#Zona1").html(respuesta["zona"]);
			$("#Zona1").val(respuesta["zona"]);
		}

	});
})

/*=============================================
ASIGNAR AGENTE
=============================================*/
$(".btnAsignAgente").on("click", function () {

	// Mostramos todos los form-group dentro del modal
	modal.find(".form-group").show();

	var idUsuario = $(this).attr("idUsuario");
	var tabla = "solicitantes";

	var datos = new FormData();
	datos.append("id", idUsuario);
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
			$("#Mayorista1").html(respuesta["mayorista"]);
			$("#Mayorista1").val(respuesta["mayorista"]);
			$("#Zona1").html(respuesta["zona"]);
			$("#Zona1").val(respuesta["zona"]);
			$("#Agente1").html(respuesta["agente"]);
			$("#Agente1").val(respuesta["agente"]);
			MayoristaSelect(respuesta["mayorista"]);
		}

	});

})

/*=============================================
MANDAR SÓLO OBSERVACIONES
=============================================*/
$(".btnObservs").on("click", function () {
	$("#titlestatsolic").html("Agregar Observaciones");
	$("#titleobservs").html("Escribe tus observaciones");
	$("#sendresol").html("Enviar Observaciones");
	$('#observs').attr('name', 'Observs');
	StatusSolic();
})

/*=============================================
ACEPTAR SOLICITANTE
=============================================*/
$(".btnAceptar").on("click", function () {
	$("#titlestatsolic").html("Aceptar Solicitante");
	$("#titleobservs").html("Agregar observaciones (opcional)");
	$("#sendresol").html("Aceptar Solicitante");
	$('#observs').attr('name', 'Aceptar');
	StatusSolic();
})

/*=============================================
RECHAZAR SOLICITANTE
=============================================*/
$(".btnRechazar").on("click", function () {
	$("#titlestatsolic").html("Rechazar Solicitante");
	$("#titleobservs").html("Agregar observaciones (opcional)");
	$("#sendresol").html("Rechazar Solicitante");
	$('#observs').attr('name', 'Rechazar');
	StatusSolic();
})

var StatusSolic = function () {
	var idUsuario = $(this).attr("idUsuario");
	var tabla = "solicitantes";

	var datos = new FormData();
	datos.append("id", idUsuario);
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
			$("#Observs").html(respuesta["observs"]);
		}

	});
}