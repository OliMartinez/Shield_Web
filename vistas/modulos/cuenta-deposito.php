<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar cuentas de depósito

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar cuentas de depósito</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-primary btnAgregar btnCrearCuentaDep" data-toggle="modal" data-target="#modalCuentaDep">

                    Agregar cuenta de depósito

                </button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>

                        <tr>

                            <th style="width:10px"></th>
                            <th>Acciones</th>
                            <?php if ($_SESSION["tipo"] == "Administrador") {
                                echo '<th>Propietario</th>';
                            }
                            ?>
                            <th>Tipo</th>
                            <th>Valor(es)</th>
                            <th>Fecha de Registro</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;
                        if ($_SESSION["tipo"] == "Mayorista") {
                            $item = "propietario";
                            $valor = $_SESSION["ID"];
                        } else if ($_SESSION["tipo"] == "Fabricante") {
                            $item = "propietario";
                            $valor = "FLEXOLAN S.A de C.V";
                        }
                        $tabla = "cuentas_deps";
                        $CuentasDeps = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla);

                        foreach ($CuentasDeps as $key => $value) {
                            $valores = "";
                            if ($value["tipo"] == "Cuenta Bancaria") {
                                if ($value["cuenta"] != null) {
                                    $valores = "No. de Cuenta: " . $value["cuenta"] . "<br>";
                                }
                                if ($value["clabe"] != null) {
                                    $valores .= "Clabe Interbancaria: " . $value["clabe"] . "<br>";
                                }
                                if ($value["tarjeta"] != null) {
                                    $valores .= "No. de tarjeta: " . $value["tarjeta"] . "<br>";
                                }
                            } else {
                                $valores == $value["valor"];
                            }

                            echo '<tr data-id="' . $value["ID"] . '">

                            <td>' . ($key + 1) . '</td>';
                                                echo '<td>

                            <div class="btn-group">
                                
                                <button class="btn btn-warning btnEditarCuentaDep" data-toggle="modal" data-target="#modalCuentaDep" idCuenta="' . $value["ID"] . '"><i class="fa fa-pencil"></i></button>

                                <button class="btn btn-danger btnEliminarCuentaDep" idCuenta="' . $value["ID"] . '"><i class="fa fa-times"></i></button>

                            </div>  

                            </td>';
                            if ($_SESSION["tipo"] == "Administrador") {
                                echo '<td>' . $value["propietario"] . '</td>';
                            }
                            echo '<td>' . $value["tipo"] . '</td>

                                <td>' . $valores . '</td>

                                <td>' . $value["fecha"] . '</td>

                             </tr>';
                        }

                        ?>
                    </tbody>
                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL AdminOFab
======================================-->

<div id="modalCuentaDep" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" enctype="multipart/form-data" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Formulario Cuenta de Depósito</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <input type="hidden" name="tipoguardar" id="tipoguardar" value="crear">
                        <input type="hidden" name="ID" id="ID" value="">

                        <?php if ($_SESSION["tipo"] == "Administrador") {
                            $mayoristas = ControladorGeneral::ctrMostrarItems(null, null, "mayoristas", "ID");
                            echo '<div class="form-group">
                            <label>Propietario</label>
                            <select class="form-control" id="propietarioselect">
                                <option id="propietario" name="propietario">Elegir propietario</option>
                                <option value="FLEXOLAN S.A de C.V">FLEXOLAN S.A de C.V</option>';
                            foreach ($mayoristas as $Key => $value) {
                                echo '<option value="' . $value["ID"] . '">' . $value["ID"] . '</option>';
                            }
                            echo '</select>                            
                        </div>';
                        } ?>
                        <div class="form-group">
                            <label for="tipo">Seleccionar tipo de cuenta:</label>
                            <select class="form-control" id="tiposelect">
                                <option id="tipo" name="tipo">Elegir tipo de cuenta</option>
                                <option value="cuenta-bancaria">Cuenta Bancaria</option>
                                <option value="correo-paypal">Correo de PayPal</option>
                                <option value="paypal-me">PayPal.Me</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div id="cuenta-bancaria" class="form-group oculto">
                            <h5 class="text-center">Sólo escribe el(los) dato(s) que consideres necesario(s), no todos</h5>
                            <label>Beneficiario</label>
                            <input type="text" class="form-control" placeholder="Ingresar nombre de beneficiario" id="beneficiario">
                            <br>
                            <label>Número de cuenta</label>
                            <input type="text" class="form-control" placeholder="Ingresar número de cuenta" data-inputmask="'mask':'9999999999'" data-mask id="cuenta">
                            <br>
                            <label>Número CLABE</label>
                            <input type="text" class="form-control" placeholder="Ingresar CLABE" data-inputmask="'mask':'999999999999999999'" data-mask id="clabe">
                            <br>
                            <label>Número de tarjeta</label>
                            <input type="text" class="form-control" placeholder="Ingresar número de tarjeta" data-inputmask="'mask':'9999 9999 9999 9999'" data-mask id="tarjeta">
                        </div>

                        <div id="correo-paypal" class="form-group oculto">
                            <label>Correo de PayPal</label>
                            <input type="email" class="form-control" placeholder="Ingresar correo" id="correo_paypal">
                        </div>

                        <div id="paypal-me" class="form-group oculto">
                            <label>PayPal.Me</label>
                            <input type="text" class="form-control" placeholder="Ingresar código" id="paypalme">
                        </div>

                        <div id="otro" class="form-group oculto">
                            <label>Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingresar nombre" id="otro_nombre">
                            <br>
                            <label>Valor</label>
                            <input type="text" class="form-control" placeholder="Ingresar valor" id="otro_valor">
                        </div>

                    </div>
                </div>

                <?php include "includes/guardar.html"; ?>

            </form>

            <?php

            $guardarCuenta = new ControladorCuentasDeps();
            $guardarCuenta->ctrGuardarCuentaDep();

            ?>

        </div>

    </div>

</div>

<?php

$eliminarCuenta = new ControladorCuentasDeps();
$eliminarCuenta->ctrEliminarCuentaDep()

?>

<script src="vistas/js/cuenta-deposito.js"></script>