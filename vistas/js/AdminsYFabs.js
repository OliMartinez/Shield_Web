/*=============================================
CREAR ADMIN O FAB
=============================================*/
$(".btnCrearUsuario").on("click", function () {
	$("#Tipo").html('');
	$("#Tipo").val('');
})

/*=============================================
EDITAR ADMIN O FAB
=============================================*/
$(".tablas").on("click", ".btnEditarUsuario", function () {
	var idUsuario = $(this).attr("idUsuario");
	var tabla = "usuarios";

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

			$("#Tipo").html(respuesta["tipo"]);
			$("#Tipo").val(respuesta["tipo"]);

		}

	});
})