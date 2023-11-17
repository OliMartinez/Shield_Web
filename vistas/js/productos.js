/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#PrecioCompra").change(function () {

    if ($(".porcentaje").prop("checked")) {

        var valorPorcentaje = $(".Porcentaje").val();

        var porcentaje = Number(($("#PrecioCompra").val() * valorPorcentaje / 100)) + Number($("#PrecioCompra").val());

        $("#PrecioVenta").val(porcentaje);

    }

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".Porcentaje").change(function () {

    if ($(".porcentaje").prop("checked")) {

        var valorPorcentaje = $(this).val();

        var porcentaje = Number(($("#PrecioCompra").val() * valorPorcentaje / 100)) + Number($("#PrecioCompra").val());

        $("#PrecioVenta").val(porcentaje);

    }

})

/*=============================================
CREAR PRODUCTO
=============================================*/

$(".btnCrearProducto").on("click", function () {

    var tipo = $("#tabla").val();

    $("#ID").val('');

    $("#Nombre").val('');

    $(".categoria").prop("checked", false);

    $("#Coleccion").val('');

    $("#Coleccion").html('Elegir Colección');

    $("#Descripcion").html('');

    $("#Caracteristicas").html('');

    if (tipo == "productos_mayorista") {

        $("#Mayorista").val('');

        $("#Mayorista").html('Elegir Mayorista');

        $("#PrecioCompra").val('');
    }
    $("#Stock").val('');

    $("#PrecioVenta").val('');

    $("#Cant_min").val('');

    // Eliminar todos los elementos input de tipo file ocultos
    $('.SubirImagenes[style*="display: none;"]').remove();

    $("#ImagenesActuales").val("vistas/img/productos/default/anonymous.png");

    var container = $(".previsualizar-container");
    container.empty();
    var img = $('<img>').attr('src', 'vistas/img/productos/default/anonymous.png').addClass('img-thumbnail previsualizar imgclick').css('cursor', 'pointer').attr('data-toggle', 'modal').attr('data-target', '#modalFoto').attr('width', '100px');
    container.append(img);

})

/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablas").on("click", ".btnEditarProducto", function () {
    if ($("#tabla").val() == "productos_mayorista" || $("#tabla").val() == "productos_fab") {
        var idProducto = $(this).attr("idProducto");
        var tabla = $("#tabla").val();

        var datos = new FormData();
        datos.append("id", idProducto);
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

                $("#Nombre").val(respuesta["nombre"]);

                $("#Modelo").val(respuesta["modelo"]);

                $("#Color").val(respuesta["color"]);

                categorias = respuesta["categorias"].split("<br>");

                categorias.forEach(function (categoria) {
                    // Selecciona las casillas de verificación que coincidan con la categoría
                    $(".categoria[value='" + categoria + "']").prop("checked", true);
                });

                $("#Coleccion").val(respuesta["coleccion"]);

                $("#Coleccion").html(respuesta["coleccion"]);

                $("#Descripcion").html(respuesta["descripcion"]);

                $("#Caracteristicas").html(respuesta["caracteristicas"]);

                $("#Stock").val(respuesta["stock"]);

                if (tabla == "productos_mayorista") {

                    $("#Mayorista").val(respuesta["mayorista"]);

                    $("#Mayorista").html(respuesta["mayorista"]);

                    $("#PrecioCompra").val(respuesta["precio_mayorista"]);

                    $("#PrecioVenta").val(respuesta["precio_dist"]);
                }
                else {
                    $("#PrecioVenta").val(respuesta["precio_mayorista"]);
                }

                $("#Cant_min").val(respuesta["cantidad_min"]);

                // Eliminar todos los elementos input de tipo file ocultos
                $('.SubirImagenes[style*="display: none;"]').remove();

                var container = $(".previsualizar-container");
                container.empty();

                if (respuesta["imagenes"] != "") {

                    $("#ImagenesActuales").val(respuesta["imagenes"]);

                    images = respuesta["imagenes"].split("<br>");

                    images.forEach(function (imagenActual) {

                        var img = $('<img>').attr('src', imagenActual).addClass('img-thumbnail imagen previsualizar imgclick').css('cursor', 'pointer').attr('data-toggle', 'modal').attr('data-target', '#modalFoto').attr('width', '100px');
                        // Agregar el ícono "x" para eliminar la imagen
                        var iconoEliminar = $('<i>').addClass('fa fa-times-circle icono-eliminar').css({
                            'position': 'absolute',
                            'top': '0',
                            'right': '0',
                            'color': 'red',
                            'padding': '5px',
                            'border-radius': '50%',
                            'cursor': 'pointer'
                        })

                        // Crear el campo input para la dirección completa del archivo
                        var inputRuta = $('<input>').attr('type', 'hidden').attr('name', 'imagenActual[]').val(imagenActual);
                        // Agregar la imagen y el ícono al contenedor
                        var contenedorImagen = $('<div>').addClass('imagen-draggable').append(img).append(iconoEliminar).append(inputRuta).css({
                            'display': 'inline-block',
                            'position': 'relative'
                        });
                        container.append(contenedorImagen);
                    });
                }
                else {
                    var img = $('<img>').attr('src', 'vistas/img/productos/default/anonymous.png').addClass('img-thumbnail previsualizar imgclick').css('cursor', 'pointer').attr('data-toggle', 'modal').attr('data-target', '#modalFoto').attr('width', '100px');
                    container.append(img);
                }

            }

        })

        var tipog = $("#tipoguardar");
        tipog.attr("value", "editar");
    }
})

$(".SubirImagenes").change(function () {
    var imagenes = Array.from(this.files);
    mostrarImgs($(this), imagenes);
});

/*=============================================
MOSTRAR IMAGENES
=============================================*/

function mostrarImgs(inputfile, imagenes) {

    /*=============================================
      VALIDAMOS EL FORMATO Y TAMAÑO DE LAS IMÁGENES
      =============================================*/

    var formatoValido = imagenes.every(function (imagen) {
        return imagen["type"] === "image/jpeg" || imagen["type"] === "image/png";
    });

    if (!formatoValido) {
        $(inputfile).val("");
        swal({
            title: "Error al subir las imágenes",
            text: "¡Las imágenes deben estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
        return;
    }

    /*=============================================
      MOSTRAR LAS IMÁGENES PREVISUALIZADAS
      =============================================*/

    var container = $(".previsualizar-container");

    if ($(".imagen").length == 0) {
        container.empty();
    }

    imagenes.forEach(function (imagen) {
        var datosImagen = new FileReader();
        datosImagen.readAsDataURL(imagen);

        datosImagen.onload = function (event) {
            var imagenActual = event.target.result;
            var img = $('<img>').attr('src', imagenActual).addClass('img-thumbnail imagen previsualizar imgclick').css('cursor', 'pointer').attr('data-toggle', 'modal').attr('data-target', '#modalFoto').attr('width', '100px');
            // Agregar el ícono "x" para eliminar la imagen
            var iconoEliminar = $('<i>').addClass('fa fa-times-circle icono-eliminar').css({
                'position': 'absolute',
                'top': '2px',
                'right': '2px',
                'color': 'red',
                'background-color': 'white',
                'border-radius': '10px',
                'cursor': 'pointer'
            })
            // Obtener el nombre de la imagen con extensión
            var nombre = imagen["name"];

            // Crear el campo input para el nombre de la imagen con extensión
            var inputNombre = $('<input>').attr('type', 'hidden').attr('name', 'nuevaImagen[]').val(nombre);

            var contenedorImagen = $('<div>').addClass('imagen-draggable').append(img).append(iconoEliminar).css({
                'display': 'inline-block',
                'position': 'relative'
            }).append(inputNombre);
            container.append(contenedorImagen);
        };
    });

    // Ocultar el elemento input existente
    $(inputfile).css('display', 'none');

    // Crinputfileear un nuevo elemento input de tipo file con el mismo nombre
    var nuevoInput = $('<input>').attr({
        type: 'file',
        class: 'SubirImagenes',
        name: 'SubirImagenes[]',
        multiple: 'multiple', // Si también deseas que sea múltiple
        style: 'color: white'
    });

    // Agregar el nuevo elemento después del elemento oculto
    $(inputfile).after(nuevoInput);

    nuevoInput.on('change', function () {
        var imagenes = Array.from(this.files);
        mostrarImgs($(this), imagenes);
    });
}

/*=============================================
ARRASTRAR IMAGENES
=============================================*/


/*=============================================
BORRAR IMAGEN INVIDUALMENTE
=============================================*/

$(".previsualizar-container").on("click", ".icono-eliminar", function () {
    EliminarImagen($(this));
})

function EliminarImagen(iconoEliminar) {
    if ($(".icono-eliminar").length == 1) {
        var container = $(".previsualizar-container");
        container.empty();
        var img = $('<img>').attr('src', 'vistas/img/productos/default/anonymous.png').addClass('img-thumbnail previsualizar imgclick').css('cursor', 'pointer').attr('data-toggle', 'modal').attr('data-target', '#modalFoto').attr('width', '100px');
        container.append(img);
    } else {
        iconoEliminar.closest('div').remove();
    }
}

/*=============================================
BORRAR TODAS LAS IMÁGENES
=============================================*/
$("#EliminarTodasLasImagenes").click(function () {
    // Eliminar todas las imágenes dentro del contenedor
    var container = $(".previsualizar-container");
    container.empty();
    var img = $('<img>').attr('src', 'vistas/img/productos/default/anonymous.png').addClass('img-thumbnail previsualizar imgclick').css('cursor', 'pointer').attr('data-toggle', 'modal').attr('data-target', '#modalFoto').attr('width', '100px');
    container.append(img);
});

$(".previsualizar-container").on("click", ".imgclick", function () {
    modalFoto($(this));
})

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablas").on("click", ".btnEliminarProducto", function () {
    var idProducto = $(this).attr("idProducto");
    var tabla = $(this).attr("tabla");
    var imagen = $(this).attr("fotoProducto");

    swal({

        title: '¿Está seguro de eliminar el producto?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar producto!'
    }).then(function (result) {
        if (result.value) {
            var sPath = window.location.pathname;
            var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
            window.location = "index.php?ruta=" + sPage + "&idProducto=" + idProducto + "&imagen=" + imagen + "&tabla=" + tabla;

        }

    })
})