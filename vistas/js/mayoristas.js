var contadorZona = 1;

/*=============================================
CREAR MAYORISTA
=============================================*/
$(".btnCrearUsuario").on("click", function () {
    TodosEstados();
    /*$('.formzona:not(:first)').remove();
    $(".inputzona").val('');
    if ($('.ZonaEstados optgroup option').length == 0) { // Si no hay opciones, ejecutar EstadosParaZona
        EstadosParaZona();
    } else { // Si hay opciones, deseleccionar todas
        $(".ZonaEstados").val([]);
    }
    $(".municipios").remove(); // Eliminar el div de municipios en la zona restante*/
})

/*=============================================
EDITAR MAYORISTA
=============================================*/
$(".tablas").on("click", ".btnEditarUsuario", function () {
/*    contadorZona = 1;
    var idUsuario = $(this).attr("idUsuario");
    var tabla = $(this).attr("tabla");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("tabla", tabla);
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            TodosEstados();
            $('.formzona:not(:first)').remove();

            if ($('.ZonaEstados optgroup option').length == 0) { // Si no hay opciones, ejecutar EstadosParaZona
                EstadosParaZona();
            } else { // Si hay opciones, deseleccionar todas
                $(".ZonaEstados").val([]);
            }
            $(".municipios").remove(); // Eliminar el div de municipios en la zona restante

            if (respuesta["zonas"] != "" && respuesta["zonas"] != null) {
                zonas = respuesta["zonas"].split('<br>');

                for (i = 0; i < zonas.length; i++) {
                    if (i != 0) {
                        AgregarZona($('.formzona').eq(i - 1));
                    }
                    $('.inputzona').eq(i).val(zonas[i]);
                    const pos = i;
                    var datosZona = new FormData();
                    datosZona.append("id", zonas[i]);
                    datosZona.append("tabla", "zonas");
                    $.ajax({
                        url: "ajax/general.ajax.php",
                        method: "POST",
                        data: datosZona,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (res) {
                            var estados = res["estados"].split(',');
                            var selectEstados = $('.ZonaEstados').eq(pos);
                            estados.forEach(function (estado) {
                                selectEstados.children("optgroup").find("option").eq(estado).prop("selected", true);
                            });
                            for (j = 0; j < estados.length; j++) {
                                var estado = estados[j];
                                getMunicipios(estado, selectEstados, true);
                                var todosmunics = res["ciudades"].split(',');
                                var munics = todosmunics[j].split('-');
                                //esperarZonaMunics(munics, (pos+1)*j);
                            }
                        }
                    })
                }
            }
        }
    }
    )*/
})

/*=============================================
Agregar una nueva zona
=============================================*/
$("#btnAgregarNuevaZona").click(function () {
    //AgregarZona($(this).closest(".form-group"));
});

/*=============================================
Evento para quitar una zona
=============================================*/
/*$(document).on("click", ".btnQuitarZona", function () {
    $(this).closest(".form-group").next('br').remove();
    $(this).closest(".form-group").remove();
});*/

/*=============================================
Manejar el evento de cambio en el select de estados
=============================================*/
/*$(document).on('change', '.ZonaEstados', function () {
    var estadoSeleccionado = $(this).val();
    var selectEstados = $(this);
    // Obtener los municipios del estado seleccionado
    getMunicipios(estadoSeleccionado, selectEstados, false);
});*/

/*=============================================
Agregar lista de estados para creación de Zona
=============================================*/
/*function EstadosParaZona() {
    $.getJSON('vistas/js/estados-munics.json', function (data) {
        $('.ZonaEstados').each(function () {
            var select = $(this); // Selector del elemento select dentro del bucle
            var optgroup = select.find('optgroup'); // Encuentra el elemento optgroup existente

            // Como data es un array de objetos, necesitamos iterar sobre cada objeto
            $.each(data, function (i, obj) {
                // Ahora obj es un objeto y necesitamos iterar sobre sus claves
                var pos_estado = 0;
                $.each(obj, function (estado, municipios) {
                    var optionExists = optgroup.find('option[value="' + pos_estado + '"]').length > 0;

                    if (!optionExists) {
                        var option = $('<option></option>').attr('value', pos_estado).text(estado);
                        optgroup.append(option);
                    } else {
                        optgroup.find('option[value="' + pos_estado + '"]').prop('selected', false);
                    }
                    pos_estado++;
                });
            });
        });
    });
}*/

/*=============================================
Agregar Zona
=============================================*/
/*function AgregarZona(div) {
    var divClonado = div.clone();

    divClonado.find(".inputzona").val(""); // Limpiar el campo de entrada
    divClonado.find(".ZonaEstados").val([]); // Deseleccionar todos los estados
    divClonado.find(".municipios").remove(); // Eliminar los divs con la clase "municipios"

    // Crear un nuevo botón de quitar y agregarlo a la zona clonada
    var botonQuitar = $('<span class="input-group-addon" style="padding: 0px 0px"><button type="button" class="btn btn-danger btnQuitarZona" style="height: 45px; width: 45px"><i class="fa fa-times"></i></button></span>');
    divClonado.find("#btnAgregarNuevaZona").parent().replaceWith(botonQuitar);

    div.next().after(divClonado);

    divClonado.after('<br>');

    contadorZona++;
}

function getMunicipios(estado, selectEstados, multiple) {
    $.getJSON('vistas/js/estados-munics.json', function (data) {
        var municipios;
        var estadosArray = Object.values(data); // Obtener los objetos con los estados

        // Verificar si el estado se encuentra dentro del rango de posiciones válidas
        var estados = estadosArray[0]; // Obtener el objeto del estado según la posición
        var estadoNombre = Object.keys(estados)[estado]; // Obtener el nombre del estado
        // Asignar la lista de municipios para el estado seleccionado
        municipios = estados[estadoNombre];

        // Si encontramos municipios, cargar la nueva lista de municipios
        if (municipios) {
            cargarMunicipios(municipios, estadoNombre, selectEstados, multiple);
        }
    });
}*/


/*=============================================
Agregar lista de municipios por estado seleccionado
=============================================*/
/*function cargarMunicipios(municipios, estado, selectEstados, multiple) {
    var divInputGroup = selectEstados.closest('.input-group').clone();
    divInputGroup.removeClass('ZonaEstados').addClass('municipios');

    var optgroup = $('<optgroup></optgroup>').attr('label', 'Selecciona los municipios de ' + estado);

    var pos_mun = 0;
    $.each(municipios, function (_, municipio) {
        var option = $('<option></option>').text(municipio).attr('value', pos_mun);
        optgroup.append(option);
        pos_mun++;
    });

    divInputGroup.find('select').empty().attr('id', estado).removeClass('ZonaEstados').addClass('ZonaMunics').attr('name', 'ZonaMunics[][][]').append(optgroup);

    var grupoInput = selectEstados.closest('.input-group');

    var divAnterior = grupoInput.nextAll('.input-group.municipios');
    if (divAnterior.length > 0) {
        if (!multiple) {
            divAnterior.replaceWith(divInputGroup);
        }
        else {
            divAnterior.last().after(divInputGroup);
        }
    } else {
        grupoInput.next('br').after(divInputGroup);
    }
}*/

/*=============================================
Función recursiva para esperar a que los elementos .ZonaMunics estén disponibles
=============================================*/
/*function esperarZonaMunics(munics, pos) {
    if ($('.ZonaMunics').length >= pos) {
        // Si los elementos .ZonaMunics están disponibles, continuar con el forEach
        munics.forEach(function (munic) {
            $('.ZonaMunics').eq(pos).children("optgroup").find("option").eq(munic).prop("selected", true);
        });
    } else {
        // Si los elementos aún no están disponibles, esperar 100 milisegundos y luego volver a llamar la función
        setTimeout(esperarZonaMunics, 100);
    }
}*/