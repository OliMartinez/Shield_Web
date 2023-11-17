/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarCategoria", function(){

	var idCategoria = $(this).attr("idCategoria");
	var tabla = "categorias";

	var datos = new FormData();
	datos.append("id", idCategoria);
	datos.append("tabla", tabla);

	$.ajax({
		url: "ajax/general.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#ID").val(respuesta["ID"]);
     		$("#IDant").val(respuesta["ID"]);
			 $("#Descripcion").html(respuesta["descripcion"]);
			 if (respuesta["imagen"] != "") {

				$(".previsualizar").attr("src", respuesta["imagen"]);
				$("#fotoActual").val(respuesta["imagen"]);

			} else {

				$(".previsualizar").attr("src", "vistas/img/categorias/default.png");

			}
     	}

	})
	$("#tipoguardar").attr("value", "editar");
})

/*=============================================
AGREGAR CATEGORIA
=============================================*/
$(".btnCrearCategoria").on("click", function(){

	$("#ID").val('');
	$("#IDant").val('');
	$("#Descripcion").html('');
	$("#fotoActual").val('');
	$(".previsualizar").attr("src", "vistas/img/categorias/default.png");
})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarCategoria", function(){

	 var idCategoria = $(this).attr("idCategoria");

	 swal({
	 	title: '¿Está seguro de eliminar la categoría?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, eliminar categoría!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

	 	}

	 })

})