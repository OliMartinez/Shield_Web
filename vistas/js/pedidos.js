/*=============================================
ELIMINAR PEDIDO
=============================================*/
$(".tablas").on("click", ".btnEliminarPedido", function () {

  var idPedido = $(this).attr("idPedido");
  var tabla = $(this).attr("tabla");

  swal({
    title: '¿Está seguro de eliminar el pedido?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar pedido!'
  }).then(function (result) {
    if (result.value) {

    }

  })

})

/*=============================================
MOSTRAR MOTIVO DE PAGO EN INFORMACIÓN DE DEPÓSITO
=============================================*/
$(".InfoDeposito").on("click", function () {

  var idPedido = $(this).attr("idPedido");
  var tabla = $(this).attr("tabla");

  var datos = new FormData();
  datos.append("id", idPedido);
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

      $("#Motivo_pago").html(respuesta["motivo_pago"]);

    }

  });

})

$('#conf_pago').click(function () {
  $('#subir_comp').click();
});

// Manejar el evento de cambio en el input de archivo
$('#subir_comp').change(function () {
  var fileName = $(this).val().split('\\').pop(); // Obtener solo el nombre del archivo
  var fileExtension = fileName.split('.').pop().toLowerCase(); // Obtener la extensión en minúsculas
  if (fileExtension === 'jpg' || fileExtension === 'pdf') {
    alert('Se ha confirmado el pago con el comprobante: ' + filename);
  }
  else {
    alert('Por favor, selecciona un archivo JPG o PDF.');
  }
});


/*=============================================
IMPRIMIR FACTURA
=============================================*/

/*$(".tablas").on("click", ".btnImprimirFactura", function(){

  var codigoPedido = $(this).attr("codigoPedido");

  window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoPedido, "_blank");

})*/

