var contadorZona = 1;

/*=============================================
CREAR MAYORISTA
=============================================*/
$(".btnCrearUsuario").on("click", function () {
    TodosEstados();
})

/*=============================================
EDITAR MAYORISTA
=============================================*/
$(".tablas").on("click", ".btnEditarUsuario", function () {
    var idUsuario = $(this).attr("idUsuario");
    var tabla = "zonas";
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("tabla", tabla);
})