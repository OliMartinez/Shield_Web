/*=============================================
EDITAR COLECCIÓN
=============================================*/
$(".tablas").on("click", ".btnEditarColeccion", function () {
	var idColeccion = $(this).attr("idColeccion");
	var tabla = "colecciones";

	var datos = new FormData();
	datos.append("id", idColeccion);
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

			$("#ID").val(respuesta["ID"]);
			$("#IDant").val(respuesta["ID"]);
			$("#Descripcion").html(respuesta["descripcion"]);
			if (respuesta["imagen"] != "") {

				$(".previsualizar").attr("src", respuesta["imagen"]);
				$("#fotoActual").val(respuesta["imagen"]);

			} else {

				$(".previsualizar").attr("src", "vistas/img/clasificaciones/default.png");

			}
		}

	})
	$("#tipoguardar").attr("value", "editar");
})

/*=============================================
AGREGAR COLECCION
=============================================*/
$(".btnCrearColeccion").on("click", function () {

	$("#ID").val('');
	$("#IDant").val('');
	$("#Descripcion").html('');
	$("#fotoActual").val('');
	$(".previsualizar").attr("src", "vistas/img/clasificaciones/default.png");

})

/*=============================================
ELIMINAR COLECCIÓN
=============================================*/
$(".tablas").on("click", ".btnEliminarColeccion", function () {
	var idColeccion = $(this).attr("idColeccion");

	swal({
		title: '¿Está seguro de eliminar la colección?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, eliminar colección!'
	}).then(function (result) {

		if (result.value) {

			window.location = "index.php?ruta=colecciones&idColeccion=" + idColeccion;

		}

	})
})