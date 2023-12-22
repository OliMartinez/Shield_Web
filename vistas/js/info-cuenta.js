$(document).ready(function () {
  /*=============================================
  ELIMINAR USUARIO
  =============================================*/
  $(".btnElimCuenta").click(function () {

    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var tabla = $(this).attr("tabla");

    swal({
      title: '¿Está seguro de eliminar su cuenta?',
      text: "¡Si no lo está puede cancelar la acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, eliminar usuario'
    }).then(function (result) {
      if (result.value) {

        var sPath = window.location.pathname;
        var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
        window.location = "index.php?ruta=" + sPage + "&idUsuario=" + idUsuario + "&tabla=" + tabla + "&fotoUsuario=" + fotoUsuario;
      }

    })

  })

  /*=============================================
  ESTADOS Y MINIATURAS PARA INFO CUENTA
  =============================================*/
  if ($("#tabla").val() != "") {
    TodosEstados();
    EstadoSelect($('#EstadoSelect').val());
  }
  if ($("#tabla").val() == "dists" || $("#tabla").val() == "mayoristas" || $("#tabla").val() == "solicitantes") {
    $("[id*='Actual']").each(function () {
      var id = $(this).attr('id');
      if (id != 'fotoActual' && id != 'PasswordActual') {
        var valor = $(this).val();
        if (valor != '') {
          var tipodoc = id.split('Actual')[0];
          const fileName = valor.split("/").pop();
          $("#link" + tipodoc).attr("href", valor);
          $("#link" + tipodoc).html(fileName + '<i class="fa fa-download" style="margin-left: 5px;"></i>');
          $("#link" + tipodoc).attr("download", fileName);
          Miniatura(valor, $("#miniatura" + tipodoc)[0]);
        }
      }
    });
  }

  /*=============================================
  Cambiar contraseña
  =============================================*/
  $("#togglePassword").click(function () {
    if ($("#passwordFields").length == 0) {
      $(this).text("Cancelar");
      var passwordFieldsHtml = '<div id="passwordFields">' +
        '<label style="font-size: 18px; display: flex; justify-content: center; align-items: center;">Cambiar Contraseña</label>' +
        '<div class="form-group">' +
        '<label>Escribe la nueva contraseña</label>' +
        '<input type="password" class="form-control" name="Password" id="Password">' +
        '<span id="passwordStrength"></span>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Confirma la nueva contraseña</label>' +
        '<input type="password" class="form-control Password" name="ConfirmPassword" id="ConfirmPassword">' +
        '<span id="passwordCoincide"></span>' +
        '</div>' +
        '</div>';
      $(".card-body").prepend(passwordFieldsHtml);
    } else {
      $(this).text("Cambiar Contraseña");
      $("#passwordFields").remove();
    }
  });

  // Adjuntar manejador de eventos al botón btnQuitarDomicilio
  $(".btnQuitarDomicilio").click(function () {
    $(this).closest(".form-group").remove();
  });


})