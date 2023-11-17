<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar fabricantes y administradores

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar fabricantes y administradores</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btnAgregar btnCrearUsuario" data-toggle="modal" data-target="#modalAdminOFab">

          Agregar admin o fabricante

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
              <th>Foto</th>
              <th>Tipo</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Último Login</th>
              <th>Ingreso al sistema</th>

            </tr>
          </thead>
          <tbody>

            <?php

            $item = null;
            $valor = null;
            $AdminsYFabs = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, null);

            foreach ($AdminsYFabs as $key => $value) {

              echo '<tr data-id="' . $value["ID"] . '">

        <td>' . ($key + 1) . '</td>';
              if ($value["estatus"] == 1) {

                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["ID"] . '" estadoUsuario="1">Activado</button></td>';
              } else {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["ID"] . '" estadoUsuario="0">Desactivado</button></td>';
              }
              echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarUsuario" data-toggle="modal" data-target="#modalAdminOFab" idUsuario="' . $value["ID"] . '" tabla=""><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $value["ID"] . '" fotoUsuario="' . $value["foto"] . '" tabla=""><i class="fa fa-times"></i></button>

                    </div>  

                  </td>
                  <td>' . $value["ID"] . '</td>';

              if ($value["foto"] != "") {

                echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto"></td>';
              } else {

                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail imgclick" width="40px"  style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto"></td>';
              }

              echo ' <td>' . $value["tipo"] . '</td>
                    
                    <td>' . $value["email"] . '</td>

                    <td>' . $value["tel"] . '</td>

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
MODAL AdminOFab
======================================-->

<div id="modalAdminOFab" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" enctype="multipart/form-data" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Formulario Usuario</h4>

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

                <input type="hidden" name="IDant" id="IDant" value="">

                <input type="hidden" name="tipoguardar" id="tipoguardar" value="crear">

                <input type="hidden" name="tabla" id="tabla" value="">

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->
            <div class="form-group">
              <label id="labelPassword">Contraseña</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="Password" id="Password" required placeholder="Ingresa la contraseña">
                <input type="hidden" name="PasswordActual" id="PasswordActual">
                <span id="passwordStrength"></span>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR EL TIPO -->
            <div class="form-group">
              <label>Tipo*</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                <select class="form-control input-lg" name="Tipo" required>
                  <option value="" id="Tipo">Elige el tipo de usuario</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Fabricante">Fabricante</option>
                </select>
              </div>
            </div>

            <?php
            include "includes/emailtelefono.html";
            include "includes/subir-foto.html";
            ?>

          </div>

        </div>

        <?php include "includes/guardar.html"; ?>

      </form>

      <?php

      $guardarUsuario = new ControladorUsuarios();
      $guardarUsuario->ctrGuardarUsuario();

      ?>

    </div>

  </div>

</div>

<?php

$eliminarUsuario = new ControladorUsuarios();
$eliminarUsuario->ctrEliminarUsuario();

include "includes/modalFoto.html";
?>

<script src="vistas/js/AdminsYFabs.js"></script>