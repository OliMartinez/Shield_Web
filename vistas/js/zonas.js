$(".tablas").on("click", ".btnEditarZona", function () {
    var idZona = $(this).attr("idZona");

    window.location = "index.php?ruta=zona&idZona=" + idZona;

})
/*=============================================
Casillas de Municipios
=============================================*/
var CasillasMunics = function (EstadoSelect, primero) {
    Estado = EstadoSelect.val();
    var fieldset = $('.Ciudades').first();
    $.getJSON('vistas/js/estados-munics.json')
        .done(function (json) {
            for (var key in json[0]) {
                if (key == Estado) {
                    var child = fieldset.children().last();
                    if (!primero) {
                        while (child.length > 0) {
                            child.remove();
                            child = fieldset.children().last();
                        }
                    }
                    for (var key1 in json[0][key]) {
                        var casilla = $('<input type="checkbox">');
                        casilla.val(json[0][key][key1]);
                        casilla.text(json[0][key][key1]);
                        label = $('<label class="checkbox-inline">');
                        label.append(casilla);
                        fieldset.append(label);
                    }
                    break;
                }
            }
        })
        .fail(function (error) {
            console.error(error);
        });
}

$(document).ready(function () {
    if ($('.EstadoSelect').length == 1) {
        CasillasMunics($('.EstadoSelect').first(), True);
    }
})

$('.EstadoSelect').change(function () {
    $(".Ciudad").html('Elegir Ciudad');
    $(".Ciudad").val('Elegir Ciudad');
    CasillasMunics(this, False);
})