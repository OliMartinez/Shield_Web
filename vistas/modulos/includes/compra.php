<!--=====================================
MODAL COMPRA
======================================-->

<div id="modalCompra" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" enctype="multipart/form-data" method="post">

        <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Realizar Compra</h4>

        </div>

        <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <input type="hidden" name="Productos" id="Productos">

            <input type="hidden" name="A_pagar" id="A_pagar">

            <!--INFORMACIÓN PARA DEPÓSITO BANCARIO-->
            <div>
              <h4 style="text-align: center;">Información para depósito bancario</h4>
              <?php
              $cuentasdeps = null;
              if ($_SESSION["tipo"] == "Mayorista") {
                $cuentasdeps = ControladorGeneral::ctrMostrarFilas("propietario", "FLEXOLAN S.A de C.V", "cuentas_deps");
              } else {
                $mayorista = ControladorGeneral::ctrMostrarItems("ID", $_SESSION["ID"], "dists", "mayorista");
                $cuentasdeps = ControladorGeneral::ctrMostrarFilas("propietario", $mayorista, "cuentas_deps");
              }
              foreach ($cuentasdeps as $key => $value) {
                echo '<b>' . $value["tipo"] . '</b>
                  <br><br><b id="label_a_pagar"></b>';
                if ($value["tipo"] == "Cuenta Bancaria") {
                  echo '<br><br><b>Beneficiario: </b><span>' . $value['beneficiario'] . '</span>';
                  if ($value['cuenta'] != null) {
                    echo '<br><br><b>Cuenta: </b><span>' . $value['cuenta'] . '</span>';
                  }
                  if ($value['clabe'] != null) {
                    echo '<br><br><b>CLABE: </b><span>' . $value['clabe'] . '</span>';
                  }
                  if ($value['tarjeta'] != null) {
                    echo '<br><br><b>Tarjeta: </b><span>' . $value['tarjeta'] . '</span>';
                  }
                } else {

                  echo '<b>: </b><p> ' . $value['valor'] . '</p>';
                }
              }
              ?>
            </div>
            <br>

            <!-- ENTRADA PARA SELECCIONAR EL DOMICILIO DE ENTREGA -->

            <div class="form-group">

              <label>Domicilo de entrega*</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-pin"></i></span>

                <select class="form-control input-lg" name="Domicilio" id="DomicilioSelect" required>

                  <option value="" id="Domicilio">Elige el domicilio de entrega</option>
                  <?php

                  $item = "ID";
                  $valor = $_SESSION["ID"];
                  if ($_SESSION["tipo"] == "Mayorista") {
                    $tabla = "mayoristas";
                  } else {
                    $tabla = "dists";
                  }
                  $dir_fis = ControladorGeneral::ctrMostrarItems($item, $valor, $tabla, "dir_fiscal");
                  $domicilios = ControladorGeneral::ctrMostrarItems($item, $valor, $tabla, "domicilios");

                  echo '<option value="' . $dir_fis . '">' . $dir_fis . '</option>';

                  $arrayDoms = explode("<br>", $domicilios);

                  for ($i = 0; $i < count($arrayDoms); $i++) {
                    echo '<option value="' . $arrayDoms[$i] . '">' . $arrayDoms[$i] . '</option>';
                  }
                  ?>
                </select>

              </div>

            </div>
          </div>

        </div>
        <!--=====================================
          PIE DEL MODAL
          ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="CrearPedido">Generar Pedido</button>

        </div>

        <?php
        $EliminarCarrito = new ControladorCarrito();
        $EliminarCarrito->ctrEliminarCarrito();
        $CrearPedido = new ControladorPedidos();
        $CrearPedido->ctrGuardarPedido();
        ?>

      </form>

    </div>

  </div>

</div>