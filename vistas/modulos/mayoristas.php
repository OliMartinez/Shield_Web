<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar mayoristas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar mayoristas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btnAgregar btnCrearUsuario" data-toggle="modal" data-target="#modalMayorista">

          Agregar mayorista

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px"></th>
              <th>Estatus</th>
              <?php include "includes/columnsclientes.html";
              include "includes/columnsclientes1.html"; ?>
              <th>Zonas</th>
              <?php include "includes/columns_mayoristas_dists.html";
              include "includes/columnsclientes2.html"; ?>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;
            $tabla2 = "mayoristas";
            $mayoristas = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);

            foreach ($mayoristas as $key => $value) {
              echo '<tr data-id="' . $value["ID"] . '">

          <td>' . ($key + 1) . '</td>';

              if ($value["estatus"] == 1) {

                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["ID"] . '" estadoUsuario="1">Activado</button></td>';
              } else {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["ID"] . '" estadoUsuario="0">Desactivado</button></td>';
              }

              echo '<td>

          <div class="btn-group">

            <button class="btn btn-warning btnEditarUsuario" data-toggle="modal" data-target="#modalMayorista" tabla="mayoristas" idUsuario="' . $value["ID"] . '"><i class="fa fa-pencil"></i></button>

            <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $value["ID"] . '"fotoUsuario="' . $value["foto"] . '" tabla="mayoristas"><i class="fa fa-times"></i></button>

          </div>  

        </td>

        <td>' . $value["ID"] . '</td>

        <td>' . $value["nombre_legal_o_rs"] . '</td>';

              if ($value["foto"] != "") {

                echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto"></td>';
              } else {

                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto"></td>';
              }

              echo '<td>';
              if ($value["tipo_persona"] == 0) {
                echo "Física";
              } else {
                echo "Moral";
              };
              echo '</td>

                    <td>' . $value["email"] . '</td>

                    <td>' . $value["tel"] . '</td>

                    <td>' . $value["estado"] . '</td>
                    
                    <td>' . $value["ciudad"] . '</td>

                    <td>' . $value["cp"] . '</td>

                    <td>' . $value["dir_fiscal"] . '</td>

                    <td>' . $value["domicilios"] . '</td>   

                    <td></td>

                    <td>' . $value["total_pedidos"] . '</td>

                    <!--<td></td>-->

                    <td>' . $value["total_compras"] . '</td>

                    <!--<td></td>-->

                    <td>' . $value["ultimo_pedido"] . '</td>

                    <td>' . $value["compra_promedio"] . '</td>

                    <!--<td></td>

                    <td></td>-->
                    <td>';
              if (!empty($value["sit_fiscal"])) {
                echo '<a class="linkSF" href="' . $value["sit_fiscal"] . '" target="_blank" style="margin-right: 5px;">' . basename($value["sit_fiscal"]) . '</a><a href="' . $value["sit_fiscal"] . '" download="' . basename($value["sit_fiscal"]) . '" style="a:hover {
                          cursor: pointer;
                        }">
                        <i class="fa fa-download"></i></a><br><br><img class="minSF" src="">';
              }
              echo '</td>
                        
                        <td>';
              if (!empty($value["acta_const"])) {
                echo '<a class="linkAC" href="' . $value["acta_const"] . '" target="_blank" style="margin-right: 5px;">' . basename($value["acta_const"]) . '</a><a href="' . $value["acta_const"] . '" download="' . basename($value["acta_const"]) . '" style="a:hover {
                          cursor: pointer;
                        }">
                        <i class="fa fa-download"></i></a><br><br><img class="minAC" src="">';
              } else if ($value["tipo_persona"] == 0) {
                echo 'No Aplica';
              }
              echo '</td>
                        
                        <td>';
              if (!empty($value["identificacion"])) {
                echo '<a class="linkIDE" href="' . $value["identificacion"] . '" target="_blank" style="margin-right: 5px;">' . basename($value["identificacion"]) . '</a><a href="' . $value["identificacion"] . '" download="' . basename($value["identificacion"]) . '" style="a:hover {
                          cursor: pointer;
                        }">
                        <i class="fa fa-download"></i></a><br><br><img class="minIDE" src="">';
              }
              echo '</td>
                        
                        <td>';
              if (!empty($value["comp_dom"])) {
                echo '<a class="linkCompDom" href="' . $value["comp_dom"] . '" target="_blank" style="margin-right: 5px;">' . basename($value["comp_dom"]) . '</a><a href="' . $value["comp_dom"] . '" download="' . basename($value["comp_dom"]) . '" style="a:hover {
                          cursor: pointer;
                        }">
                        <i class="fa fa-download"></i></a><br><br><img class="minCompDom" src="">';
              }
              echo '</td>
              <td>' . $value["ultimo_login"] . '</td>

                    <td>' . $value["ingreso"] . '</td>

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
MODAL  MAYORISTA
======================================-->

<div id="modalMayorista" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" enctype="multipart/form-data" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Formulario mayorista</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DE USUARIO-->

            <div class="form-group">

              <label>Nombre de usuario*</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                <input type="text" class="form-control input-lg" name="ID" id="ID" placeholder="Ingresa el nombre de usuario" required>

                <input type="hidden" name="IDant" id="IDant">

                <input type="hidden" name="tipoguardar" id="tipoguardar" value="crear">

                <input type="hidden" name="tabla" id="tabla" value="mayoristas">

              </div>

            </div>

            <?php include "includes/datosprincipales.html"; ?>

            <?php
            include "includes/emailtelefono.html";
            include "includes/estadoyciudad.html";
            include "includes/domicilio.html";
            ?>

            <!-- ENTRADA PARA ZONAS -->
            <label>Zonas</label>
            <div class="form-group" id="containerzonas">

              <button id="btnAgregarNuevaZona" class="btn btn-info">
                <a href="zona" style="color:white; :hover{color:white;}">
                  Agregar zona
                </a></button>
            </div>
            <br>

            <?php
            include "includes/documentos.html";
            include "includes/subir-foto.html";
            ?>

          </div>
        </div>
        <?php include "includes/guardar.html"; ?>

        <?php

        $guardarUsuario = new ControladorUsuarios();
        $guardarUsuario->ctrGuardarUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$eliminarUsuario = new ControladorUsuarios();
$eliminarUsuario->ctrEliminarUsuario();

include "includes/modalFoto.html";
?>

<script src="vistas/js/mayoristas.js"></script>