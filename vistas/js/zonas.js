$(".tablas").on("click", ".btnEditarZona", function () {
    var idZona = $(this).attr("idZona");

	window.location = "index.php?ruta=zona&idZona="+idZona;

})