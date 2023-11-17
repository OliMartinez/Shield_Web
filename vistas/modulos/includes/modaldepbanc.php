<!--=====================================
MODAL PARA VER INFORMACIÓN PARA DEPÓSITO BANCARIO
======================================-->

<div id="modalInfoDeposito" class="modal fade" role="dialog">

    <div class="modal-dialog">
  
      <div class="modal-content">
  
        <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
  
        <div class="modal-header" style="background:#3c8dbc; color:white">
  
          <button type="button" class="close" data-dismiss="modal">&times;</button>
  
          <h4 class="modal-title">Información para Depósito Bancario</h4>
  
        </div>
  
        <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
  
        <div class="modal-body">
  
          <div class="box-body">
  
            <!-- INFORMACIÓN PARA DEPÓSITO BANCARIO -->
            <div>
              <?php
              $cuentasdeps = null;
              if ($_SESSION["tipo"] == "Mayorista") {
                $cuentasdeps = ControladorGeneral::ctrMostrarFilas("propietario", "FLEXOLAN S.A de C.V", "cuentas_deps");
              } else {
                $mayorista = ControladorGeneral::ctrMostrarItems("ID", $_SESSION["ID"], "dists", "mayorista");
                $cuentasdeps = ControladorGeneral::ctrMostrarFilas("propietario", $mayorista, "cuentas_deps");
              }
              foreach ($cuentasdeps as $key => $value) {
                echo '<h4 style="text-align: center;"><b>' . $value["tipo"] . '</b></h4>';
                if ($value["tipo"] == "Cuenta Bancaria") {
                  echo '<br><h4 style="text-align: center;"><b>Beneficiario:</b></h4><p style="text-align: center;">' . $value['beneficiario'] . '</p>';
                  if ($value['cuenta'] != null) {
                    echo '<br><h4 style="text-align: center;"><b>Cuenta:</b></h4><p style="text-align: center;">' . $value['cuenta'] . '</p>';
                  }
                  if ($value['clabe'] != null) {
                    echo '<br><h4 style="text-align: center;"><b>CLABE:</b></h4><p style="text-align: center;">' . $value['clabe'] . '</p>';
                  }
                  if ($value['tarjeta'] != null) {
                    echo '<br><h4 style="text-align: center;"><b>Tarjeta:</b></h4><p style="text-align: center;">' . $value['tarjeta'] . '</p>';
                  }
                } else {
  
                  echo '<h4>: </h4><p> ' . $value['valor'] . '</p>';
                }
              }
              ?>
              <br>
              <h4 style="text-align: center;"><b>Concepto/Motivo de pago:</b></h4>
              <p id="Motivo_pago" style="text-align: center;"></p>
            </div>
  
          </div>
  
        </div>
        <!--=====================================
          PIE DEL MODAL
          ======================================-->
  
        <div class="modal-footer">
  
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
  
        </div>
  
      </div>
  
    </div>
  
  </div>