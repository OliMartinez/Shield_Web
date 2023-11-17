<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar productos de mayorista

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar productos de mayorista</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btnAgregar btnCrearProducto" data-toggle="modal" data-target="#modalProducto">

          Agregar producto

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>
              <?php include "includes/columnsprods.html";
              if ($_SESSION["tipo"] != "Mayorista") {
                echo '<th>Mayorista</th>';
              } ?>
              <th>Stock</th>
              <th>Precio de compra</th>
              <?php include "includes/columnsprods1.html";?>
            </tr>

          </thead>

          <tbody>
            <?php

            $item = null;
            $valor = null;
            if ($_SESSION["tipo"] == "Mayorista") {
              $item = "mayorista";
              $valor = $_SESSION["ID"];
            }
            $tabla = "productos_mayorista";
            $Productos = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla);

            foreach ($Productos as $key => $value) {
              echo '<tr data-id="' . $value["ID"] . '">

        <td>' . ($key + 1) . '</td>
                    <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarProducto" data-toggle="modal" data-target="#modalProducto" idProducto="' . $value["ID"] . '" tabla="productos_mayorista"><i class="fa fa-pencil"></i></button>
          
                      <button class="btn btn-danger btnEliminarProducto" idProducto="' . $value["ID"] . '" fotoProducto="' . $value["imagenes"] . '" tabla="productos_mayorista"><i class="fa fa-times"></i></button>
          
                    </div>  
          
                  </td>
                  <td>';

              if ($value["imagenes"] != "") {
                $Imagenes = explode('<br>', $value["imagenes"]);
                foreach ($Imagenes as $key => $imagen) {
                  echo '<img src="' . $imagen . '" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto"><br>';
                }
              } else {

                echo '<img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto">';
              }

              echo '</td>
              <td>' . $value["nombre"] . '</td>
  
              <td>' . $value["categorias"] . '</td>

              <td>' . $value["coleccion"] . '</td>
              
              <td>' . $value["descripcion"] . '</td>

              <td>' . $value["caracteristicas"] . '</td>';

              if ($_SESSION["tipo"] != "Mayorista") {
                echo '<td>' . $value["mayorista"] . '</td>';
              }
              echo '<td>' . $value["stock"] . '</td>

              <td>$' . $value["precio_mayorista"] . '</td>

              <td>$' . $value["precio_dist"] . '</td>

              <td>$' . $value["cantidad_min"] . '</td>

              <td>' . $value["fecha_alta"] . '</td>

              <td>' . $value["fecha_modif"] . '</td>

            </tr>';
            }

            ?>
          </tbody>

        </table>

      </div>

  </section>

</div>

<!--=====================================
MODAL  PRODUCTO
======================================-->

<div id="modalProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" enctype="multipart/form-data" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            <input type="hidden" name="tabla" id="tabla" value="productos_mayorista">

            <?php include "includes/productos.php"; ?>

            <?php
            if ($_SESSION["tipo"] != "Mayorista") {
              echo '
            <!-- ENTRADA PARA SELECCIONAR MAYORISTA -->
            <div class="form-group">
              <label for="Mayorista">Mayorista:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="Mayorista" required>
                  <option id="Mayorista"></option>';

              $item = null;
              $valor = null;
              $tabla2 = "mayoristas";

              $Mayoristas = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla2);

              foreach ($Mayoristas as $key => $value) {

                echo '<option value="' . $value["ID"] . '" >' . $value["ID"] . '</option>';
              }
              echo '
                </select>
              </div>
            </div>';
            } ?>
            <!-- ENTRADA PARA STOCK -->
            <div class="form-group">
              <label for="Stock">Stock:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                <input type="number" class="form-control input-lg" id="Stock" name="Stock" min="0" required>
              </div>
            </div>
            <!-- ENTRADA PARA PRECIO COMPRA -->
            <div class="form-group row">
              <div class="col-xs-6">
                <label for="Precio">Precio compra x unidad:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                  <input type="number" class="form-control input-lg" id="PrecioCompra" name="PrecioCompra" step="any" min="0" required>
                </div>
              </div>

              <!-- ENTRADA PARA PRECIO VENTA -->
              <div class="col-xs-6">
                <label for="Precio">Precio venta x unidad:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                  <input type="number" class="form-control input-lg" id="PrecioVenta" name="PrecioVenta" step="any" min="0" required>
                </div>
                <br>
                <!-- CHECKBOX PARA PORCENTAJE -->

                <div class="col-xs-6">

                  <div class="form-group">

                    <label>

                      <input type="checkbox" class="minimal porcentaje" checked>
                      Utilizar procentaje
                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA PORCENTAJE -->

                <div class="col-xs-6" style="padding:0">

                  <div class="input-group">

                    <input type="number" class="form-control input-lg Porcentaje" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            <!-- CANTIDAD MÍNIMA DE PRODUCTOS A VENDER -->
            <div class="form-group">
              <label for="Cant_min">Cantidad mínima de unidades para venta:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                <input type="number" class="form-control input-lg" id="Cant_min" name="Cant_min" min="0" required>
              </div>
            </div>              

            </div>

            <?php include "includes/imgprods.html"; ?>

          </div>
          <?php include "includes/guardar.html"; ?>
        </div>

        <?php

        $GuardarProducto = new ControladorProductos();
        $GuardarProducto->ctrGuardarProducto();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$eliminarProducto = new ControladorProductos();
$eliminarProducto->ctrEliminarProducto();

include "includes/modalFoto.html";
?>