var contadorZona = 1;
/*=============================================
CREAR MAYORISTA
=============================================*/
$(".btnCrearUsuario").on("click", function () {
    $('.buttonzona').remove();
    TodosEstados();
})

/*=============================================
EDITAR MAYORISTA
=============================================*/
$(".tablas").on("click", ".btnEditarUsuario", function () {
    $('.buttonzona').remove();
    var idUsuario = $(this).attr("idUsuario");
    var datos = new FormData();
    datos.append('item_cond', 'mayorista');
    datos.append('valor_item_cond', idUsuario);
    datos.append('item_enc', 'ID');
    datos.append('tabla', 'zonas');
    $.ajax({

        url: "ajax/general.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // Asegúrate de que la respuesta es un array y contiene datos
            if (Array.isArray(respuesta) && respuesta.length) {
                $('#containerzonas #btnAgregarNuevaZona').before(crearBotones(respuesta));
            }
        }
    });
    TodosEstados();
});

function crearBotones(datos) {
    var botones = '';
    datos.forEach(function (dato) {
        botones += '<a class="btn btn-success buttonzona" href="index.php?ruta=zona&idZona=' + dato.ID + '" style="color:white; :hover{color:white;}; margin: 5px;">'
            + dato.ID + '</a>';
    });
    return botones;
}

/*$(document).on('click', '.buttonzona', function () {
    var id = $(this).attr("idZona");

    window.location = "index.php?ruta=zona&idZona=" + id;

})*/