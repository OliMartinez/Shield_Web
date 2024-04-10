<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Carrito

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Carrito</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <?php $tabla = null; 
        $tabla2 = null; 
        $tipo_vendedor=null;
        $id_vendedor=null;
        if ($_SESSION["tipo"] == "Mayorista") {
          $tabla = "carritos_mayoristas";
        } else {
          $tabla = "carritos_dists";
          $tipo_user = "mayorista";
        } ?>
        <button class="btn btn-success" style="margin-right:7px" data-toggle="modal" data-target="#modalCompra" id="CrearPedido" tabla="<?php echo $tabla; ?>">

          Realizar Compra

        </button>

        <a class="btnAgregar" href="catalogo">
          <button class="btn btn-primary btnAgregarProducto">

            Agregar más productos

          </button>
        </a>

        <span style="margin-left: 10px; font-size: 20px;"><b>Importe + Envío: </b>
          <?php
          $importe = ControladorGeneral::ctrSumar($tabla, "precioxcantidad", "ID_user", $_SESSION["ID"]);
          $envio = 100;
          echo '$' . $importe+$envio;
          ?>
        </span>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px"></th>
              <th>Acciones</th>
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Categoría</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Importe</th>
              <!--<th>Envío</th>-->
              <!--<th>Total</th>-->

            </tr>

          </thead>

          <tbody>
            <?php

            $item = "ID_user";
            $valor = $_SESSION["ID"];
            $tabla1 = null;

            if ($_SESSION["tipo"] == "Distribuidor") {
              $tabla1 = "productos_mayorista";
            } else {
              $tabla1 = "productos_fab";
            }
            $Productos = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla);

            foreach ($Productos as $key => $value) {
              $producto_gral = ControladorGeneral::ctrMostrarFilas("ID", $value["ID_product"], $tabla1);
              echo '<tr><td>' . ($key + 1) . '</td>
                    <td>
                    <button class="btn btn-warning btnEditarProducto" data-toggle="modal" data-target="#modalProducto" id="' . $value["ID"] . '" tabla="' . $tabla . '"><i class="fa fa-pencil"></i></button>          
                      <button class="btn btn-danger btnQuitarProducto" id="' . $value["ID"] . '" tabla="' . $tabla . '"><i class="fa fa-times"></i></button>
          
                  </td>';

              if ($producto_gral["imagenes"] != "") {
                $Imagenes = explode('<br>', $producto_gral["imagenes"]);

                echo '<td><img src="' . $Imagenes[0] . '" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto"><br></td>';
              } else {

                echo '<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto"></td>';
              }

              echo '<td class="Producto">' . $producto_gral["nombre"] . '</td>
  
        <td class="Categoria">' . $value["categoria"] . '</td>';

              if ($tabla1 == "productos_mayorista") {
                echo '<td>$' . $producto_gral["precio_dist"] . '</td>';
              } else {
                echo '<td>$' . $producto_gral["precio_mayorista"] . '</td>';
              }

              echo '<td class="Cantidad">' . $value["cantidad"] . '</td>

        <td class="PrecioxCantidad">$' . $value["precioxcantidad"] . '</td>

        </tr>';

              /*<td>$' . $value["envio"] . '</td>
              <td>$' . $value["total"] . '</td>*/
            }

            ?>
          </tbody>

        </table>

      </div>

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

            <input type="hidden" name="ID" id="ID">

            <input type="hidden" name="tabla" id="tabla">

            <!--<label id="Nombre"></label>-->

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
            <div class="form-group">
              <label for="Categoria">Categoría:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="Categoria" id="CategoriaSelect" required>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="Precio">Precio:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="number" class="form-control input-lg" id="Precio" readonly>
              </div>
            </div>

            <!-- ENTRADA PARA CANTIDAD -->
            <div class="form-group">
              <label for="Cantidad">Cantidad:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                <input type="number" class="form-control input-lg" id="Cantidad" name="Cantidad" min="0" required>
              </div>
            </div>

            <div class="form-group">
              <label for="Precioxcantidad">Precio x Cantidad:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="number" class="form-control input-lg" id="Precioxcantidad" name="Precioxcantidad" readonly>
              </div>
            </div>

          </div>

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="GuardarProducto">Guardar</button>

        </div>

        <?php

        $GuardarProducto = new ControladorCarrito();
        $GuardarProducto->ctrGuardarProducto();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$eliminarProducto = new ControladorCarrito();
$eliminarProducto->ctrEliminarProducto();

?>

<!--=====================================
MODAL FOTO
======================================-->
<div id="modalFoto" class="modal fade" tabindex="-1" role="document">

  <div class="modal-dialog">

    <div class="modal-content center-block">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <img center src="" class="img-thumbnail img-responsive center-block" id="FotoGrande">

      </div>

    </div>

  </div>

</div>

<?php include "includes/compra.php"; ?>

<script src="vistas/js/carrito.js"></script>