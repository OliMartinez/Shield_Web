/*=============================================
SideBar Menu
=============================================*/
$('.sidebar-menu').tree()

/*=============================================
Data Table
=============================================*/
// Crea una etiqueta <style> y establece el contenido CSS
const style = $('<style>')
	.text(`
	.custom-toolbar {
        width: 100%;
      }
      .custom-toolbar .col-md-6 {
        padding-left: 15px;
        padding-right: 0px;
      }
      .custom-toolbar .d-flex {
        display: flex;
        align-items: center;
        justify-content: flex-start;
      }
      .dt-buttons {
        margin-left: 10px; // Ajusta este valor según prefieras
      }
	  .custom-button {
        background-color: #2A2A2A; // Establece el color de fondo gris oscuro
        border: none;
      }
      .custom-button span {
        color: #DAD9D9; // Establece el color del texto blanco
      }

      .custom-button:hover {
        background-color: #171717; // Establece el color de fondo al pasar el cursor
      }
	  .custom-button:hover span {
        color: #fff; // Establece el color del texto al pasar el cursor
      }
    `);

/*=============================================
Agrega la etiqueta <style> al <head> del documento
=============================================*/
$('head').append(style);

const dttable = $(".tablas").DataTable({

	"language": {

		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	},
	dom: '<"row custom-toolbar"<"col-md-6 d-flex align-items-center"lB><"col-md-6"f>>rtip',

	buttons: [
		{
			extend: 'copy',
			text: 'Copiar',
			className: 'custom-button',
			exportOptions: {
				columns: function (idx, data, node) {
					return idx !== getActionColumnIndex();
				}
			}
		},
		{
			extend: 'csv',
			text: 'CSV',
			className: 'custom-button',
			exportOptions: {
				columns: function (idx, data, node) {
					return idx !== getActionColumnIndex();
				}
			}
		},
		{
			extend: 'excel',
			text: 'Excel',
			className: 'custom-button',
			exportOptions: {
				columns: function (idx, data, node) {
					return idx !== getActionColumnIndex();
				}
			}
		}/*,
		{
			extend: 'pdf',
			text: 'PDF',
			className: 'custom-button',
			exportOptions: {
				columns: function (idx, data, node) {
					return idx !== getActionColumnIndex();
				}
			}
		},
		{
			extend: 'print',
			text: 'Imprimir',
			className: 'custom-button',
			exportOptions: {
				columns: function (idx, data, node) {
					return idx !== getActionColumnIndex();
				}
			}
		}*/
	],
	autoFill: true

});

/*=============================================
 iCheck for checkbox and radio inputs
=============================================*/
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass: 'iradio_minimal-blue'
})

/*=============================================
 input Mask
=============================================*/
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND	
=============================================*/
if (window.matchMedia("(max-width:767px)").matches) {

	$("body").removeClass('sidebar-collapse');

} else {

	$("body").addClass('sidebar-collapse');
}

/*=============================================
Agregar btnSelect Después de btnAgregar	
=============================================*/
$(".btnAgregar").after('<button class="btn btn-info btnSelect" style="margin-left: 10px;">Seleccionar</button>');

/*=============================================
OBTENER NOMBRE DE PÁGINA
=============================================*/
function nombrePaginaEnArray(ultimoSegmento, nombresPaginas) {
	for (var i = 0; i < nombresPaginas.length; i++) {
		if (ultimoSegmento === nombresPaginas[i]) {
			return true;
		}
	}
	return false;
}

/*=============================================
Agregr botones al presionar btnSelect y agregar/quitar casillas para filas
=============================================*/
$('.btnSelect').on('click', function () {
	var paginaActual = window.location.pathname;
	var segmentosURL = paginaActual.split('/');
	var ultimoSegmento = segmentosURL[segmentosURL.length - 1] || segmentosURL[segmentosURL.length - 2];
	var nombresPaginas = ["AdminsYFabs", "agentes", "mayoristas", "dists"];

	var seleccionado = $(this).text() === "Seleccionar";
	$(this).text(seleccionado ? "Salir de la selección" : "Seleccionar");
	// Agregar el botón "Eliminar"
	if (seleccionado) {
		$("table thead tr").prepend("<th></th>");
		$("table tbody tr").each(function () {
			$(this).prepend("<td><input type='checkbox' class='seleccionado'></td>");
		});
		$(".btnSelect").after(
			"<button class='btn btn-info btnSeleccionarTodos' style='margin-left: 10px;'>Seleccionar todos</button>"
		);
		/*$(".box-header").append(
			"<button class='btn btn-primary btnEditarSeleccionados' style='margin-left: 10px;'>Editar</button>"
		);*/
		$(".btnSeleccionarTodos").after(
			"<button class='btn btn-danger btnEliminar' style='margin-left: 10px;'>Eliminar</button>"
		);
		// Agregar botones "Activar" y "Desactivar"
		if (nombrePaginaEnArray(ultimoSegmento, nombresPaginas)) {
			$(".box-header").append(
				"<button class='btn btn-success btnActivarSeleccionados' style='margin-left: 10px;'>Activar</button>"
			);
			$(".box-header").append(
				"<button class='btn btn-warning btnDesactivarSeleccionados' style='margin-left: 10px;'>Desactivar</button>"
			);
		}
	} else {
		$('.table thead tr th:first-child').remove();
		$("table tbody tr td:first-child").remove();
		$(".btnSeleccionarTodos").remove();
		$(".btnEditarSeleccionados").remove();
		$(".btnEliminar").remove();
		if (nombrePaginaEnArray(ultimoSegmento, nombresPaginas)) {
			$(".btnActivarSeleccionados").remove();
			$(".btnDesactivarSeleccionados").remove();
		}
	}
});

/*=============================================
Cambiar texto al presionar btnSeleccionarTodos
=============================================*/
$(document).on("click", ".btnSeleccionarTodos", function () {
	if ($(this).text() === 'Seleccionar todos') {
		$('.tablas tbody input[type="checkbox"]').prop('checked', true);
		$(this).text('Deseleccionar todos');
	} else {
		$('.tablas tbody input[type="checkbox"]').prop('checked', false);
		$(this).text('Seleccionar todos');
	}
});

/*=============================================
Obtener número de columna
=============================================*/
function getActionColumnIndex() {
	const columnHeader = $('.tablas thead th').filter(function () {
		return $(this).text().trim() === 'Acciones';
	});

	if (columnHeader.length === 0) {
		return -1;
	}
	return columnHeader.index();
}

/*=============================================
Eliminar filas seleccionadas
=============================================*/
$(".btnEliminar").on("click", function () {
	// Obtener los elementos seleccionados
	var elementosSeleccionados = $('.tablas tbody input[type="checkbox"]').map(function () {
		return $(this).closest("tr").data("id");
	}).get();

	// Verificar si hay elementos seleccionados
	if (elementosSeleccionados.length > 0) {
		// Confirmar si se desea eliminar
		if (confirm("¿Está seguro de que desea eliminar los elementos seleccionados?")) {
			// Eliminar cada elemento
			elementosSeleccionados.forEach(function (elementoId) {
				// Realizar la petición AJAX para eliminar el elemento
				var tabla = "";
				var tabla2 = "";
				var pagina = window.location.pathname;
				if (pagina == "AdmisYFabs" || pagina == "mayoristas" || pagina == "agentes" || pagina == "dists" || pagina == "solicitantes") { tabla = "usuarios"; if (pagina != "AdmisYFabs") { tabla2 = pagina } }
				else { tabla = pagina }
				var id = elementoId;
				var datos = new FormData();
				datos.append("id", id);
				datos.append("tabla", tabla);
				datos.append("tabla2", tabla2);
				$.ajax({
					url: "general.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function (respuesta) {
						if (respuesta === "ok") {
							// Recargar la página para actualizar la tabla
							location.reload();
						} else {
							alert("Error al eliminar el elemento con ID " + elementoId);
						}
					}
				});
			});
		}
	} else {
		alert("No hay elementos seleccionados para eliminar");
	}
});

/*=============================================
SUBIENDO LA FOTO
=============================================*/
$("#Foto").change(function () {

	var imagen = this.files[0];

	/*=============================================
		VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
		=============================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$("#Foto").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function (event) {

			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);

		})

	}
})

/* =============================================
Modal Foto
============================================= */
$(".imgclick").on("click", function () {
	modalFoto($(this));
});

function modalFoto($imgclick){
	var $img = $("#FotoGrande");
    var $modal = $("#modalFoto");

    // Establecer la imagen en el modal
    $img.attr("src", $imgclick.attr("src"));

    // Restablecer el tamaño original de la imagen
    $img.css({ "max-height": "", "max-width": "" });

    // Obtener el tamaño de la ventana del navegador
    var windowHeight = $(window).height();
    var windowWidth = $(window).width();

    // Obtener el tamaño de la imagen
    var imgHeight = $img.height();
    var imgWidth = $img.width();

    // Calcular la reducción necesaria
    var reduceHeight = imgHeight - windowHeight + 10;
    var reduceWidth = imgWidth - windowWidth + 10;

    // Aplicar la reducción si es necesario
    if (reduceHeight > 0) {
        $img.css("max-height", imgHeight - reduceHeight + "px");
    }

    if (reduceWidth > 0) {
		imgWidth = imgWidth - reduceWidth;
        $img.css("max-width", imgWidth + "px");
		
    }

    // Restablecer el tamaño del modal
    $modal.find(".modal-dialog").css({"max-width": imgWidth});
    $modal.find(".modal-content").css({ "width": "auto", "margin": 0 });
    $modal.find(".modal-body").css({ "padding": 1 });
    $modal.find(".modal-header").css({ "height": 15, "padding": 2 });
}

/*=============================================
SALIR
=============================================*/
$(".btnSalir").on("click", function () {

	swal({
		title: '¿Seguro que deseas salir?',
		text: "¡Si lo hace, no se realizará ninguna acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, quiero salir'
	}).then(function (result) {

		if (result.value) {

			window.location = "ingreso";

		}

	})

})