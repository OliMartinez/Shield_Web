/*=============================================
CREAR CUENTA
=============================================*/
$(".btnCrearCuentaDep").on("click", function () {
	$('.oculto').hide();
	$('#tipo').prop('selected', true);
	$("#ID").val("");
	if ($("#propietario").length > 0) {
		$("#propietario").val("");
	}
	$("#tipo").val("");
	$("#tipo").html('Elegir tipo de cuenta');
	$("#beneficiario").val("");
	$("#cuenta").val("");
	$("#clabe").val("");
	$("#tarjeta").val("");
	$("#correo_paypal").val("");
	$("#paypalme").val("");
	$("#otro_nombre").val("");
	$("#otro_valor").val("");
})

/*=============================================
EDITAR CUENTA
=============================================*/
$(".btnEditarCuentaDep").on("click", function () {

	var idCuenta = $(this).attr("idCuenta");
	var tabla = "cuentas_deps";

	var datos = new FormData();
	datos.append("id", idCuenta);
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
			var tipoCuenta;
			$("#ID").val(respuesta["ID"]);
			if ($("#propietario").length > 0) {
				$("#propietario").val(respuesta["propietario"]);
			}
			$('.oculto').hide();
			if (respuesta["tipo"] == "Cuenta Bancaria") {
				$("#correo_paypal").val("");
				$("#paypal.me").val("");
				$("#otro_nombre").val("");
				$("#otro_valor").val("");
				$("#tiposelect").val("cuenta-bancaria");
				tipoCuenta = "cuenta-bancaria";

				$("#beneficiario").val(respuesta["beneficiario"]);
				$("#cuenta").val(respuesta["cuenta"]);
				$("#clabe").val(respuesta["clabe"]);
				$("#tarjeta").val(respuesta["tarjeta"]);
			}
			else if (respuesta["tipo"] == "Correo de PayPal") {
				$("#beneficiario").val("");
				$("#cuenta").val("");
				$("#clabe").val("");
				$("#tarjeta").val("");
				$("#paypal.me").val("");
				$("#otro_nombre").val("");
				$("#otro_valor").val("");
				$("#tiposelect").val("correo-paypal");
				tipoCuenta = "correo-paypal";

				$("#correo_paypal").val(respuesta["valor"]);
			}
			else if (respuesta["tipo"] == "PayPal.Me") {
				$("#beneficiario").val("");
				$("#cuenta").val("");
				$("#clabe").val("");
				$("#tarjeta").val("");
				$("#correo_paypal").val("");
				$("#otro_nombre").val("");
				$("#otro_valor").val("");
				$("#tiposelect").val("paypal-me");
				tipoCuenta = "paypal-me";

				$("#paypal.me").val(respuesta["valor"]);
			}
			else {
				$("#beneficiario").val("");
				$("#cuenta").val("");
				$("#clabe").val("");
				$("#tarjeta").val("");
				$("#correo_paypal").val("");
				$("#paypal.me").val("");
				$("#tiposelect").val("otro");
				tipoCuenta = "otro";
				$("#otro_nombre").val(respuesta["tipo"]);
				$("#otro_valor").val(respuesta["valor"]);
			}
			$('#' + tipoCuenta).show();
		}
	});

	var tipo = document.getElementById("tipoguardar");
	tipo.setAttribute("value", "editar");

})

/*=============================================
ELIMINAR CUENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarCuentaDep", function () {

	var idCuenta = $(this).attr("idCuenta");

	swal({
		title: '¿Está seguro de eliminar la cuenta?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, eliminar cuenta!'
	}).then(function (result) {

		if (result.value) {
			var sPath = window.location.pathname;
			var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
			window.location = "index.php?ruta=" + sPage + "&idCuenta=" + idCuenta;

		}

	})

})

/*=============================================
Al seleccionar un tipo de cuenta, mostrar solo los campos correspondientes
=============================================*/
$('#tiposelect').change(function () {
	var tipoCuenta = $(this).val();
	$('.oculto').hide();
	if (tipoCuenta != "") {
		$('#' + tipoCuenta).show();
	}
});