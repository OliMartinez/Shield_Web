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

$('.conf_pago').click(function () {
  $('.subir_comp').click();
});

// Manejar el evento de cambio en el input de archivo
$('.subir_comp').change(function () {
  $('.mandar_comp').click();
});

//Obtener Foto del Comprobante de Pago
$('.ver_comp_pago').on("click", function () {
  var compdir = $(this).attr('compdir');
  var ext = compdir.slice(compdir.lastIndexOf('.') + 1);
  if(ext.toLowerCase() == 'jpg' || ext.toLowerCase() == 'jpeg'){
    var $img = $('#FotoComp');
    var $modal = $("#modalCompPago");

    // Establecer la imagen en el modal
    $img.attr("src", compdir);

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
  else if(ext.toLowerCase() == 'pdf'){
    // Abrir el PDF en una nueva ventana
    window.open(compdir, '_blank');
    // Esperar 2 segundos (2000 milisegundos) antes de realizar la siguiente instrucción
    setTimeout(function () {
      $('#cerrar').click();
    },1)
  }
})


$('.confpago').click(function () {
  $('.mandarconf').click();
});

/*=============================================
IMPRIMIR FACTURA
=============================================*/

/*$(".tablas").on("click", ".btnImprimirFactura", function(){

  var codigoPedido = $(this).attr("codigoPedido");

  window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoPedido, "_blank");

})*/

