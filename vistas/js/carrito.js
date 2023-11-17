/*=============================================
EDITAR PRODUCTOS
=============================================*/

$(".tablas").on("click", ".btnEditarProducto", function () {
    var id = $(this).attr("id");
    var tabla = $(this).attr("tabla");

    $("#CategoriaSelect").html('');

    var datos = new FormData();
    datos.append("id", id);
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

            var tabla_productos;

            if (tabla == "carritos_mayoristas") {
                tabla_productos = "productos_fab";
            }
            else {
                tabla_productos = "productos_mayorista";
            }
        
            var obtenercategorias = new FormData();
            obtenercategorias.append("item_enc", "categorias");
            obtenercategorias.append("item_cond", "ID");
            obtenercategorias.append("valor_item_cond", respuesta["ID_product"]);
            obtenercategorias.append("tabla", tabla_productos);
        
            $.ajax({
                url: "ajax/general.ajax.php",
                method: "POST",
                data: obtenercategorias,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (resultado) {
                    var categs = resultado.split(",");
                    // Recorre el arreglo y crea opciones en el <select>
                    $.each(categs, function (index, valor) {
                        $("#CategoriaSelect").append($("<option>", {
                            value: valor,
                            text: valor
                        }));
                    });
                }
            })

            $("#tabla").val(tabla);

            $("#ID").val(respuesta["ID"]);

            $("#CategoriaSelect").val(respuesta["categoria"]);

            $("#Precio").val(respuesta["precioxcantidad"] / respuesta["cantidad"]);

            $("#Cantidad").val(respuesta["cantidad"]);

            $("#Cantidad").attr("min", respuesta["cantidad_min"]);

            $("#Precioxcantidad").val(respuesta["precioxcantidad"]);

            $("#Precioxcantidad").attr("min", respuesta["cantidad_min"]);
            
        }

    })
})

/*=============================================
QUITAR PRODUCTO
=============================================*/

$(".tablas").on("click", ".btnQuitarProducto", function () {
    var id = $(this).attr("id");
    var tabla = $(this).attr("tabla");

    swal({

        title: '¿Está seguro de quitar el producto del carrito?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, quitar producto!'
    }).then(function (result) {
        if (result.value) {
            var sPath = window.location.pathname;
            var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
            window.location = 'index.php?ruta=' + sPage + '&id=' + id + '&tabla=' + tabla;

        }


    })
})

/*=============================================
CREAR PEDIDO
=============================================*/
$("#CrearPedido").on("click", function () {
    var a_pagar = 0;

    $('.PrecioxCantidad').each(function () {
        var texto = $(this).text();
        var numeroStr = texto.replace('$', ''); // Elimina el símbolo $
        var numero = parseFloat(numeroStr);

        a_pagar += numero;

    });
    $("#A_pagar").val(a_pagar);
    $("#label_a_pagar").html("A Pagar: $" + a_pagar);

    var productosText = "";

    $(".Producto").each(function (index) {
        var producto = $(this).text();
        var categoria = $(".Categoria").eq(index).text();
        var cantidad = $(".Cantidad").eq(index).text();
        var precioCantidad = $(".PrecioxCantidad").eq(index).text().replace('$', '');

        var productoText = producto + " " + categoria + " x" + cantidad + " " + precioCantidad;
        productosText += productoText + "<br>";
    });

    productosText = productosText.slice(0, -2); // Elimina la última coma y espacio

    $("#Productos").val(productosText);

})

/*=============================================
Agregar el evento change al input de cantidad
=============================================*/
$("#Cantidad").on("change", function () {
    // Obtener el precio de una sola pieza al cargar la página
    var precioUnaPieza = parseFloat($("#Precio").val());
    var cantidad = parseInt($("#Cantidad").val());
    var nuevoPrecio = precioUnaPieza * cantidad;

    // Actualizar el contenido del elemento con el nuevo precio
    $("#Precioxcantidad").val(nuevoPrecio.toFixed(0));
    //$("#total").text((nuevoPrecio + 100).toFixed(0));
});