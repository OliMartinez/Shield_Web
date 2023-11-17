<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar solicitantes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar solicitantes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btnAgregar btnCrearUsuario" data-toggle="modal" data-target="#modalSolic">

          Agregar solicitante

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px"></th>
              <th>Acciones</th>
              <?php include "includes/columnsclientes.html";
              if ($_SESSION["tipo"] == "Administrador" || $_SESSION["tipo"] == "Fabricante") {
                echo '<th>Mayorista revisor</th>';
              }
              if ($_SESSION["tipo"] != "Agente") {
                echo '<th>Agente revisor</th>';
              }
              include "includes/columnsclientes.html"; ?>
              <th>Historia/Descripción de la empresa/negocio</th>
              <th>Propuesta de Ventas Mensuales</th>
              <?php include "includes/columnsclientes2.html"; ?>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;
            $tabla2 = "solicitantes";
            if ($_SESSION["tipo"] == "Mayorista") {
              $item = "mayorista";
              $valor = $_SESSION["ID"];
            } else if ($_SESSION["tipo"] == "Agente") {
              $item = "agente";
              $valor = $valor = $_SESSION["ID"];
            }

            $solics = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);

            foreach ($solics as $key => $value) {

              echo '<tr data-id="' . $value["ID"] . '">                    
                    <td>' . ($key + 1) . '</td>
                    <td>
                    <ul class="nav">
                    <li>
                      <a data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                      <ul class="dropdown-menu">
                        <li class="dropdown-item"><a style="cursor:pointer;" class="btnAsignMayorista" tabla="solicitantes" idUsuario="' . $value["ID"] . '" data-toggle="modal" data-target="#modalAsignar">Asignar Mayorista</a></li>
                        <li class="dropdown-item"><a style="cursor:pointer;" class="btnAsignAgente" tabla="solicitantes" idUsuario="' . $value["ID"] . '" data-toggle="modal" data-target="#modalAsignar">Asignar Agente</a></li>
                        <li class="dropdown-item"><a style="cursor:pointer;" class="btnAceptar" tabla="solicitantes" idUsuario="' . $value["ID"] . '" data-toggle="modal" data-target="#modalObservs">Aceptar</a></li>
                        <li class="dropdown-item"><a style="cursor:pointer;" class="btnRechazar" tabla="solicitantes" idUsuario="' . $value["ID"] . '" data-toggle="modal" data-target="#modalObservs">Rechazar</a></li>
                        <li class="dropdown-item"><a style="cursor:pointer;" class="btnObservs" tabla="solicitantes" idUsuario="' . $value["ID"] . '" data-toggle="modal" data-target="#modalObservs">Hacer observaciones</a></li>
                        <li class="dropdown-item"><a style="cursor:pointer;" class="btnEditarUsuario" tabla="solicitantes" idUsuario="' . $value["ID"] . '" data-toggle="modal" data-target="#modalSolic">Editar</a></li>
                        <li class="dropdown-item"><a style="cursor:pointer;" class="btnEliminarUsuario" idUsuario="' . $value["ID"] . '" " fotoUsuario="' . $value["foto"] . '" tabla="solicitantes">Eliminar</a></li>
                      </ul>
                    </li>
                  </ul>

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

                    <td>' . $value["tel"] . '</td>';
              if ($_SESSION["tipo"] == "Administrador" || $_SESSION["tipo"] == "Fabricante") {
                echo '<td>' . $value["mayorista"] . '</td>';
              }
              if ($_SESSION["tipo"] != "Agente") {
                echo '<td>' . $value["agente"] . '</td>';
              }
              echo '<td>' . $value["estado"] . '</td>

                    <td>' . $value["ciudad"] . '</td>

                    <td>' . $value["cp"] . '</td>   

                    <td>' . $value["dir_fiscal"] . '</td>

                    <td>' . $value["domicilios"] . '</td>     

                    <td>' . $value["historia"] . '</td> 

                    <td>$' . $value["propuesta"] . '</td><td>';

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
MODAL  SOLICITANTE
======================================-->

<div id="modalSolic" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" enctype="multipart/form-data" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Formulario Solicitante</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DE USUARIO DEL USUARIO-->

            <div class="form-group">

              <label>Nombre de usuario*</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                <input type="text" class="form-control input-lg" name="ID" id="ID" placeholder="Ingresa el nombre de usuario" required>

                <input type="hidden" name="IDant" id="IDant">

                <input type="hidden" name="tipoguardar" id="tipoguardar" value="crear">

                <input type="hidden" name="tabla" id="tabla" value="solicitantes">

              </div>

            </div>

            <?php include "includes/datosprincipales.html"; ?>

            <!-- ENTRADA PARA OBSERVACIONES-->
            <div class="form-group">
              <label>Observaciones</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <textarea class="form-control input-lg" name="Observs" id="Observs" required rows="5" placeholder="Agrega observaciones"></textarea>
              </div>
            </div>

            <?php include "includes/emailtelefono.html"; ?>

            <?php
            if ($_SESSION["tipo"] != "Agente") {
              echo '
            <!-- ENTRADA PARA SELECCIONAR EL MAYORISTA -->

            <div class="form-group">

              <label>Mayorista revisor</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>

                <select class="form-control input-lg" name="Mayorista" id="MayoristaSelect">

                  <option value="" id="Mayorista"></option>';
              $item = null;
              $valor = null;
              $tabla = "mayoristas";
              $item1 = "ID";
              $Mayoristas = ControladorGeneral::ctrMostrarItems($item, $valor, $tabla, $item1);

              foreach ($Mayoristas as $key => $value) {

                echo '<option value="' . $value["ID"] . '" >' . $value["ID"] . '</option>';
              }

              echo '</select>

              </div>

            </div>
            <!-- ENTRADA PARA SELECCIONAR LA ZONA -->

            <div class="form-group">

              <label>Zona</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                <select class="form-control input-lg" name="Zona" id="ZonaSelect">

                  <option value="" id="Zona"></option>

                </select>

              </div>

            </div>
            <!-- ENTRADA PARA SELECCIONAR EL AGENTE -->

            <div class="form-group">

              <label>Agente revisor</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="Agente" id="AgenteSelect">

                  <option value="" id="Agente"></option>
                </select>

              </div>

            </div>';
            } ?>

            <?php
            include "includes/estadoyciudad.html";
            include "includes/domicilio.html";
            include "includes/historiaypropuesta.html";
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
$eliminarUsuario->ctrEliminarUsuario()

?>

<!--=====================================
MODAL ASIGNAR
======================================-->

<div id="modalAsignar" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Asignar</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            <input type="hidden" name="IDAsign" id="IDAsign">
            <input type="hidden" name="tipoasignar" id="tipoasignar" value="agente">
            <?php
            if ($_SESSION["tipo"] == "Administrador") {
              echo '
            <!-- ENTRADA PARA SELECCIONAR EL MAYORISTA -->

            <div class="form-group">

              <label>Mayorista</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>

                <select class="form-control input-lg" name="Mayorista1" id="MayoristaSelect1">

                  <option value="" id="Mayorista1"></option>';

              $item = null;
              $valor = null;
              $tabla = "mayoristas";
              $item1 = "ID";
              $Mayoristas = ControladorGeneral::ctrMostrarItems($item, $valor, $tabla, $item1);

              foreach ($Mayoristas as $key => $value) {

                echo '<option value="' . $value["ID"] . '" >' . $value["ID"] . '</option>';
              }

              echo '
                </select>

              </div>

            </div>';
            }
            ?>
            <!-- ENTRADA PARA SELECCIONAR LA ZONA -->

            <div class="form-group">

              <label>Zona</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                <select class="form-control input-lg" name="Zona1" id="ZonaSelect1">

                  <option value="" id="Zona1"></option>

                </select>

              </div>

            </div>
            <!-- ENTRADA PARA SELECCIONAR EL AGENTE -->

            <div class="form-group">

              <label>Agente</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="Agente1" id="AgenteSelect1">

                  <option value="" id="Agente1"></option>
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

          <button type="submit" class="btn btn-primary">Asignar</button>

        </div>
        <?php

        $asignar = new ControladorUsuarios();
        $asignar->ctrAsignar();

        ?>
      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL OBSERVACIONES
======================================-->

<div id="modalObservs" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titlestatsolic"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA OBSERVACIONES-->
            <div class="form-group">
              <label id="titleobservs"></label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="hidden" name="IDResol" id="IDResol">
                <textarea class="form-control input-lg" name="Observs" id="Observs" required rows="5" placeholder="Agrega observaciones"></textarea>
              </div>
            </div>
          </div>
          <!--=====================================
        PIE DEL MODAL
        ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" id="sendresol"></button>

          </div>
          <?php

          //$guardarUsuario = new ControladorUsuarios();
          //$guardarUsuario->ctrGuardarUsuario();

          ?>
        </div>
      </form>

    </div>

  </div>

</div>