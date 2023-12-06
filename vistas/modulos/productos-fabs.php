<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar productos del fabricante

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar productos del fabricante</li>

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
              include "includes/columnsprods1.html"; ?>
            </tr>

          </thead>
          <tbody>
            <?php

            $item = null;
            $valor = null;
            $tabla = "productos_fab";
            $Productos = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla);

            foreach ($Productos as $key => $value) {

              echo '<tr data-id="' . $value["ID"] . '">

                    <td>' . ($key + 1) . '</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarProducto" data-toggle="modal" data-target="#modalProducto" idProducto="' . $value["ID"] . '" tabla="productos_fab"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarProducto" idProducto="' . $value["ID"] . '" fotoProducto="' . $value["imagenes"] . '" tabla="productos_fab"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>
                    <td>';

              if ($value["imagenes"] != "") {
                $imagenes = explode("<br>", $value["imagenes"]);
                foreach ($imagenes as $imagen) {
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

                    <td>' . $value["caracteristicas"] . '</td>

                    <td>$' . $value["precio_mayorista"] . '</td>

                    <td>$' . $value["cantidad_min"] . '</td>

                    <td>$' . $value["envio"] . '</td>

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
            <input type="hidden" name="tabla" id="tabla" value="productos_fab">
            <?php include "includes/productos.php"; ?>

            <!-- ENTRADA PARA PRECIO VENTA -->
            <div class="form-group">
              <label for="Precio">Precio venta x unidad:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="number" class="form-control input-lg" id="PrecioVenta" name="PrecioVenta" step="any" min="0" required>
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

            <!-- ENTRADA PARA ENVÍO-->
            <div class="form-group">
              <label for="Envío">Precio de envío:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="number" class="form-control input-lg" id="Envio" name="Envio" min="0" required>
              </div>
            </div>

            <?php include "includes/imgprods.html"; ?>

          </div>

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