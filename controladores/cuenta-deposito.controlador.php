<?php

class ControladorCuentasDeps
{

    /*=============================================
    GUARDAR CUENTAS DE DEPOSITO
    =============================================*/

    public static function ctrGuardarCuentaDep()
    {
        if (isset($_POST["guardar"])) {

            $tabla = "cuentas_deps";

            if($_SESSION["tipo"]=="Administrador"){
                $propietario = $_POST["propietario"];
            }
            else{
                $propietario = $_SESSION["ID"];
            }

            $datos = array(
                "ID" => $_POST["ID"],
                "propietario" => $propietario
            );

            if($_POST["tipo"] == "Cuenta Bancaria"){
                $datos["tipo"] = $_POST["tipo"];
                $datos["beneficiario"] = $_POST["beneficiario"];
                $datos["cuenta"] = $_POST["cuenta"];
                $datos["clabe"] = $_POST["clabe"];
                $datos["tarjeta"] = $_POST["tarjeta"];
                $datos["valor"] = '';

            }
            else if($_POST["tipo"] == "Correo de PayPal"){
                $datos["tipo"] = $_POST["tipo"];
                $datos["valor"] = $_POST["correo_paypal"];
                $datos["beneficiario"] = '';
                $datos["cuenta"] = '';
                $datos["clabe"] = '';
                $datos["tarjeta"] = '';
            }
            else if($_POST["tipo"] == "PayPal.Me"){
                $datos["tipo"] = $_POST["tipo"];
                $datos["valor"] = $_POST["paypalme"];
                $datos["beneficiario"] = '';
                $datos["cuenta"] = '';
                $datos["clabe"] = '';
                $datos["tarjeta"] = '';
            }
            else{
                $datos["tipo"] = $_POST["otro_nombre"];
                $datos["valor"] = $_POST["otro_nombre"];
                $datos["beneficiario"] = '';
                $datos["cuenta"] = '';
                $datos["clabe"] = '';
                $datos["tarjeta"] = '';
            }

            $tipo = $_POST["tipoguardar"];

            $respuesta = ModeloCuentasDeps::mdlGuardarCuentaDep($datos, $tipo);

            if ($respuesta == "ok") {

                echo '<script>

					swal({
							type: "success",
							title: "La cuenta ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
									if (result.value) {

									window.location = "cuenta-deposito";

									}
								})

					</script>';
            }
        }
    }

    /*=============================================
    ELIMINAR CUENTAS DE DEPOSITO
    =============================================*/

    public static function ctrEliminarCuentaDep()
    {

        if (isset($_GET["idCuenta"])) {

            $tabla = "cuentas_deps";

            $tabla = "cuentas_deps";
            $datos = $_GET["idCuenta"];

            $respuesta = ModeloGeneral::mdlEliminar($tabla, null, $datos);

            if ($respuesta == "ok") {

                echo '<script>

            swal({
                  type: "success",
                  title: "La cuenta ha sido borrado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {

                            window.location = "cuenta-deposito";

                            }
                        })

            </script>';
            }
        }
    }
}
?>
