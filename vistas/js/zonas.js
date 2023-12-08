$(".tablas").on("click", ".btnEditarZona", function () {
    var idZona = $(this).attr("idZona");

    window.location = "index.php?ruta=zona&idZona=" + idZona;

})

$(document).ready(function () {
    if ($('.EstadoSelect').length > 0) { DesplegarEstados($('.EstadoSelect').first()); }
})

$("#AgregarEstado").on("click", function () {
    var EstadoBox = '<div class="col-lg-12 EstadoBox">' +
        '<div class="box box-info">' +
        '<!--=====================================' +
        'CUERPO DEL MODAL' +
        '======================================-->' +
        '<div class="box-body">' +
        '<!-- ENTRADA PARA SELECCIONAR EL ESTADO -->' +
        '<div class="form-group">' +
        '<label class="EstadoLabel">Estado</label>' +
        '<div class="input-group">' +
        '<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>' +
        '<select class="form-control input-lg EstadoSelect" name="Estado[]">' +
        '<option class="Estado">Elegir Estado</option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="form-group">' +
        '<label class="CiudadesLabel">Ciudades</label>' +
        '<div style="height: 300px;' +
        'border: 1px solid rgba(0, 0, 0, .125);' +
        'border-radius: 0.25rem;' +
        'min-width: 20%;' +
        'width: 100%;' +
        'overflow: auto;' +
        'padding: 0.75rem;">' +
        '<fieldset required>' +
        '</fieldset>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';
    if ($('.EstadoBox').length > 0) { $('.EstadoBox').last().after(EstadoBox); }
    else { $('.col-lg-12').first().after(EstadoBox); }
    DesplegarEstados($('.EstadoSelect').last());
    $('.EstadoSelect').last().change(function () {
        CasillasMunics($(this));
    })
})

/* =============================================
Desplegar todos los Estados
============================================= */
var DesplegarEstados = function (select) {
    //var select = $('.EstadoSelect');
    $.getJSON('vistas/js/estados-munics.json', function (json) {
        var child = select.children().last();
        while (child.attr('class') != 'Estado') {
            child.remove();
            child = select.children().last();
        }

        json.forEach(item => {
            Object.keys(item).forEach(key => {
                var option = $('<option>', {
                    'value': key,
                    'text': key
                });
                select.append(option);
            });
        });
    });
};

/*=============================================
Casillas de Municipios
=============================================*/
var CasillasMunics = function (EstadoSelect) {
    Estado = EstadoSelect.val();
    var fieldset = EstadoSelect.closest('.box-body').children().last().children().eq(1).children().first();
    $.getJSON('vistas/js/estados-munics.json')
        .done(function (json) {
            for (var key in json[0]) {
                if (key == Estado) {
                    var child = fieldset.children().last();
                    while (child.length > 0) {
                        child.remove();
                        child = fieldset.children().last();
                    }
                    for (var key1 in json[0][key]) {
                        var casilla = $('<input type="checkbox" name="Ciudad[]">');
                        casilla.val(json[0][key][key1]);
                        label = $('<label class="checkbox-inline">');
                        label.append(casilla).append(json[0][key][key1]);
                        fieldset.append(label);
                        fieldset.append('<br>');
                    }
                    break;
                }
            }
        })
        .fail(function (error) {
            console.error(error);
        });
}

$('.EstadoSelect').change(function () {
    CasillasMunics($(this));
})
