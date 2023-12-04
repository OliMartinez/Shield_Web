/*=============================================
CREAR AGENTE
=============================================*/
$(".btnCrearUsuario").on("click", function () {
	$("#Zona").html('Elegir Zona');
	$("#Zona").val('');
	$("#Mayorista").html('Elegir Mayorista');
	$("#Mayorista").val('');
})

/*=============================================
EDITAR AGENTE
=============================================*/
$(".btnEditarUsuario").on("click", function () {
	var idUsuario = $(this).attr("idUsuario");
	var tabla = "agentes";

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
			$("#Mayorista").html(respuesta["mayorista"]);
			$("#Mayorista").val(respuesta["mayorista"]);
			$("#Zona").html(respuesta["zona"]);
			$("#Zona").val(respuesta["zona"]);
			if ($("#Mayorista").length > 0) { MayoristaSelect(respuesta["mayorista"]); }
		}

	});
})
