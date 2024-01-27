<div class="content-wrapper">

  <section class="content-header">

    <h1>
      <?php if ($_SESSION['tipo'] != 'Distribuidor') {
        echo 'Administrar pedidos de distribuidores';
      } else {
        echo 'Mis pedidos';
      } ?>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">
        <?php if ($_SESSION['tipo'] != 'Distribuidor') {
          echo 'Administrar pedidos de distribuidores';
        } else {
          echo 'Mis pedidos';
        } ?>
      </li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <!--<div class="box-header with-border">

        <button class="btn btn-primary btnAgregar" href="crear-pedido">

          Agregar pedido

        </button>

      </div>-->

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px"></th>
              <th>Acciones</th>
              <?php if ($_SESSION["tipo"] != "Distribuidor") {
                echo '
              <th>Distribuidor</th>';
                if ($_SESSION["tipo"] != "Agente") {
                  echo
                  '<th>Agente</th>';
                  if ($_SESSION["tipo"] != "Mayorista") {
                    echo '<th>Mayorista</th>';
                  }
                }
              }
              include "includes/columnspedidos.html";
              if ($_SESSION["tipo"] != "Agente" and $_SESSION["tipo"] != "Distribuidor") {
                echo '
                <th>Motivo de pago</th>';
              }
              include "includes/columnspedidos1.html";
              ?>
            </tr>

          </thead>

          <tbody>

            <?php
            $item = null;
            $valor = null;
            if ($_SESSION["tipo"] == "Distribuidor") {
              $item = "dist";
              $valor = $_SESSION["ID"];
            }
            $respuesta = ControladorGeneral::ctrMostrarFilas($item, $valor, "pedidos_dists");

            $distsarray = array();
            $agentesarray = array();
            if ($_SESSION["tipo"] == "Agente") {
              $item = null;
              $valor = null;
              $tabla2 = "dists";
              $dists = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);
              foreach ($dists as $key => $value) {
                if ($value["agente"] == $_SESSION["ID"]) {
                  array_push($distsarray, $value["ID"]);
                }
              }
            } else if ($_SESSION["tipo"] == "Mayorista" || $_SESSION["tipo"] == "Fabricante") {
              $item = null;
              $valor = null;
              $tabla2 = "agentes";
              $agentes = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);
              foreach ($agentes as $key => $value) {
                if ($value["mayorista"] == $_SESSION["ID"]) {
                  array_push($agentesarray, $value["ID"]);
                }
              }
              $tabla2 = "dists";
              $item = null;
              $valor = null;
              $dists = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);
              foreach ($dists as $key => $value) {
                if (in_array($value["agente"], $agentesarray)) {
                  array_push($distsarray, $value["ID"]);
                }
              }
            }

            foreach ($respuesta as $key => $value) {
              if ($_SESSION["tipo"] == "Distribuidor" || ($_SESSION["tipo"] == "Agente" and  in_array($value["dist"], $distsarray)) || ($_SESSION["tipo"] == "Mayorista" and in_array($value["dist"], $distsarray)) || ($_SESSION["tipo"] == "Fabricante" and in_array($value["dist"], $distsarray)) || $_SESSION["tipo"] == "Administrador") {
                echo '<tr data-id="' . $value["ID"] . '">';
                echo '<td>' . ($key + 1) . '</td>
                  <td>
                    <ul class="nav">
                      <li>
                        <ul class="nav">
                          <li>
                            <a data-toggle="dropdown" style="color:#646364;"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a style="cursor:pointer;" data-toggle="modal" data-target="#modalSeguimiento">Seguimiento</a></li>
                              <li class="dropdown-item"><a style="cursor:pointer;">Comprobante</a></li>
                              <!--<li class="dropdown-item"><a style="cursor:pointer;">Factura</a></li>-->';
                if ($_SESSION["tipo"] == "Distribuidor") {
                  echo ' 
                              <li class="dropdown-item"><a style="cursor:pointer;" data-toggle="modal" data-target="#modalInfoDeposito" class="InfoDeposito" tabla="pedidos_dists" idPedido="' . $value["ID"] . '">Información para Depósito Bancario</a></li>
                              <li class="dropdown-item"><a style="cursor:pointer;" id="conf_pago">Subir comprobante de pago (JPG o PDF)</a></li>
                              <input type="file" id="subir_comp" style="display: none;">
                              <li class="dropdown-item"><a style="cursor:pointer;">Confirmar de recibido</a></li>
                          <!--<li class="dropdown-item"><a style="cursor:pointer;">Hacer un Reclamo</a></li>-->
                              <li class="dropdown-item"><a style="cursor:pointer;">Devolución</a></li>
                  ';
                } else if ($_SESSION["tipo"] == "Administrador") {
                  echo '
                              <!--<li class="dropdown-item"><a style="cursor:pointer;" class="btnEditarPedido" tabla="pedidos_dists" idPedido="" data-toggle="modal" data-target="#modalPedido">Editar</a></li>-->
                              <li class="dropdown-item"><a style="cursor:pointer;" class="btnEliminarPedido" idPedido="' . $value["ID"] . '" tabla="pedidos_dists">Eliminar</a></li>';
                }
                if ($_SESSION["tipo"] != "Distribuidor") {
                  echo '<li class="dropdown-item"><a style="cursor:pointer;">Marcar como entregado</a></li>
                  <li class="dropdown-item"><a style="cursor:pointer;" data-toggle="modal" data-target="#modalCompPago" tabla="pedidos_dists" idPedido="' . $value["ID"] . '">Ver comprobante de pago</a></li>
                  <li class="dropdown-item"><a style="cursor:pointer;">Confirmar pago</a></li>';
                }
                echo ' 
                              <li class="dropdown-item"><a style="cursor:pointer;">Cancelar</a></li>
                            </ul>
                          </li>
                        </ul>
                      </td>';
                if ($_SESSION["tipo"] != "Distribuidor") {

                  echo '<td>' . $value["dist"] . '</td>';
                  if ($_SESSION["tipo"] != "Agente") {

                    $itemUsuario = "ID";
                    $valorUsuario = $value["dist"];
                    $tabla2 = "dists";

                    $respuestaDist = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario, $tabla2);

                    echo '<td>' . $respuestaDist["agente"];
                    if ($_SESSION["tipo"] != "Mayorista") {

                      echo '<td>' . $respuestaDist["mayorista"] . '</td>';
                    }
                  }
                }
                echo '<td>' . $value["productos"] . '</td>

                  <td>$' . number_format($value["precio"], 2) . '</td>
                  
                  <td>$' . number_format($value["envio"], 2) . '</td>

                  <td>$' . number_format($value["total"], 2) . '</td>

                  <td>' . $value["domicilio"] . '</td>

                  <td>' . $value["tipo"] . '</td>

                  <td>' . $value["fecha_solicitud"] . '</td>';

                if ($_SESSION["tipo"] == "Administrador" || $_SESSION["tipo"] == "Mayorista") {

                  echo '<td>' . $value["motivo_pago"] . '</td>';
                }

                echo '<td>';
                if ($value["fecha_pago"] != "0000-00-00") {
                  echo $value["fecha_pago"];
                } else {
                  echo 'En espera de pago';
                };
                echo '</td>

                  <td>';
                if ($value["fecha_llegada"] != "0000-00-00") {
                  echo $value["fecha_llegada"];
                } else {
                  echo 'Aún no concretado';
                };
                echo '</td>

                  <!--<td></td>-->

                </tr>';
              }
            }

            ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<?php
include "includes/modalseguimiento.html";
include "includes/modaldepbanc.php";
include "includes/modalcomppago.html";
?>