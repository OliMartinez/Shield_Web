<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar agentes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar agentes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btnAgregar btnCrearUsuario" data-toggle="modal" data-target="#modalAgente">

          Agregar agente

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px"></th>
              <th>Estatus</th>
              <th>Acciones</th>
              <th>Nombre Usuario</th>
              <th>Nombre Legal</th>
              <th>Foto</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Zona</th>

              <?php if ($_SESSION["tipo"] == "Administrador") {
                echo '<th>Mayorista</th>';
              } ?>

              <th>Total de Comisiones</th>
              <th>Última comisión</th>
              <th>Estado</th>
              <th>Ciudad</th>
              <th>Último Login</th>
              <th>Ingreso al sistema</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;
            if ($_SESSION["tipo"] == "Fabricante") {
              $item = "mayorista";
              $valor = "FLEXOLAN S.A de C.V";
            } else if ($_SESSION["tipo"] == "Mayorista") {
              $item = "mayorista";
              $valor = $_SESSION["ID"];
            }
            $tabla2 = "agentes";
            $Agentes = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);

            foreach ($Agentes as $key => $value) {

              echo '<tr data-id="' . $value["ID"] . '">
  
              <td>' . ($key + 1) . '</td>';
              if ($value["estatus"] == 1) {

                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["ID"] . '" estadoUsuario="1">Activado</button></td>';
              } else {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["ID"] . '" estadoUsuario="0">Desactivado</button></td>';
              }
              echo '<td>

            <div class="btn-group">
              
              <button class="btn btn-warning btnEditarUsuario" data-toggle="modal" data-target="#modalAgente" tabla="agentes" idUsuario="' . $value["ID"] . '"><i class="fa fa-pencil"></i></button>

              <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $value["ID"] . '" " fotoUsuario="' . $value["foto"] . '" tabla="agentes"><i class="fa fa-times"></i></button>

            </div>  

          </td>
          <td>' . $value["ID"] . '</td>

          <td>' . $value["nombre_legal_o_rs"] . '</td>';

              if ($value["foto"] != "") {

                echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto"></td>';
              } else {

                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto"></td>';
              }

              echo '<td>' . $value["email"] . '</td>

          <td>' . $value["tel"] . '</td>

          <td>' . $value["zona"] . '</td>';

              if ($_SESSION["tipo"] == "Administrador") {
                echo '<td>' . $value["mayorista"] . '</td>';
              }

              echo '<td>' . $value["comisiones"] . '</td>

                    <td>' . $value["ultima_comision"] . '</td>

                    <td>' . $value["estado"] . '</td>

                    <td>' . $value["ciudad"] . '</td> 

                    <td>' . $value["ultimo_login"] . '</td>

                    <td>' . $value["ingreso"] . '</td></tr>';
            }

            ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL  AGENTE
======================================-->

<div id="modalAgente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" enctype="multipart/form-data" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Formulario agente</h4>

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
                <input type="hidden" name="tabla" id="tabla" value="agentes">
              </div>
            </div>
            <?php 
            include "includes/datosprincipales.html";
            include "includes/emailtelefono.html";

            if ($_SESSION["tipo"] == "Administrador") {
              echo '
            <!-- ENTRADA PARA SELECCIONAR EL MAYORISTA -->
            
            <div class="form-group">

              <label>Mayorista*</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>

                <select class="form-control input-lg" name="Mayorista" id="MayoristaSelect" required>

                  <option value="" id="Mayorista"></option>';

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
            } ?>
            <!-- ENTRADA PARA SELECCIONAR LA ZONA -->

            <div class="form-group">

              <label>Zona*</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                <select class="form-control input-lg" name="Zona" id="ZonaSelect" required>

                  <option value="" id="Zona"></option>

                </select>

              </div>

            </div>

            <?php
            include "includes/estadoyciudad.html";
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
<script src="vistas/js/agentes.js"></script>