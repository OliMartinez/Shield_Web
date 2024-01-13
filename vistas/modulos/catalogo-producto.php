<head>
  <link rel="stylesheet" type="text/css" href="vistas/css/catalogo/catalogo-producto.css">
</head>

<body>
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: white;">

      <!-- Main content -->
      <section class="content">

        <?php
        $item = "ID";
        $valor = $_GET["idProducto"];
        $tabla = null;

        if ($_SESSION["tipo"] == "Mayorista") {
          $tabla = "productos_fab";
        } else {
          $tabla = "productos_mayorista";
        }

        $producto = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla);
        ?>

        <!-- Default box -->
        <div class="card card-solid">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"><b><?php echo $producto["nombre"] ?></b></h3>
                <div class="col-12">
                  <img src="<?php echo explode('<br>', $producto["imagenes"])[0] ?>" class="product-image" alt="Product Image" style="width:100%">
                </div>
                <div class="col-12 product-image-thumbs">
                  <?php foreach (explode('<br>', $producto["imagenes"]) as $key => $value) {
                    echo '<div class="product-image-thumb"><img src="' . $value . '
                  ?>" alt="Product Image"></div>';
                  }
                  ?>
                </div>
              </div>
              <div class="col-12 col-sm-6">

                <form role="form" enctype="multipart/form-data" method="post">

                  <h3 class="my-3"><b class="producto" id="nombre"><?php echo $producto["nombre"] ?></b></h3>
                  <input type="hidden" name="ID" value="<?php echo $producto["ID"] ?>">

                  <h3 class="my-3"><b>Colección: </b><?php echo $producto["coleccion"] ?></h3>

                  <div style="margin-top: 20px;"><span class="my-3" style="font-size: 23px; margin-right: 5px;"><b>Categoría: </b></span>
                    <select name="categoria" id='categoria' style="border: 2px solid gray;border-radius: 15px;cursor: pointer;width: 20%;height: 30px; font-size: 18px; text-align: center;">
                      <?php
                      $item = "ID";
                      $valor = $producto["ID"];
                      $selectitem = "categorias";
                      $Categorias = ControladorGeneral::ctrMostrarItems($item, $valor, $tabla, $selectitem);
                      $Categorias1 = explode("<br>", $Categorias);
                      for ($i = 0; $i < count($Categorias1); $i++) {
                        $valor = $Categorias1[$i];
                        echo "<option value='$valor'>$valor</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <h3 class="my-3"><b>Precio: </b><span>
                      <span id="precio">
                        <?php
                        if ($tabla == "productos_fab") {
                          echo '$' . $producto["precio_mayorista"];
                        } else {
                          echo '$' . $producto["precio_dist"];
                        }
                        ?>
                      </span>
                    </span>
                  </h3>

                  <div style="margin-top: 20px"><span class="my-3" style="font-size: 23px; margin-right: 5px;"><b>Cantidad: </b></span>
                    <input type="number" class='Cantidad' style="width: 12%;height: 30px;border-radius: 15px;border: 2px solid gray; font-size: 18px; text-align: center;" name="cantidad" id="cantidad" value="<?php echo $producto["cantidad_min"]; ?>" min="<?php echo $producto["cantidad_min"]; ?>">
                  </div>

                  <h3 class="my-3"><b>Precio x Cantidad: </b><span>
                      <span class='PrecioxCantidad' id="precioxcantidad">
                        <?php
                        if ($tabla == "productos_fab") {
                          echo '$' . $producto["precio_mayorista"] * $producto["cantidad_min"];
                        } else {
                          echo '$' . $producto["precio_dist"] * $producto["cantidad_min"];
                        }
                        ?>
                      </span>
                    </span>
                  </h3>
                  <input type="hidden" name="precioxcantidad" value="
                  <?php
                  if ($tabla == "productos_fab") {
                    echo $producto["precio_mayorista"] * $producto["cantidad_min"];
                  } else {
                    echo $producto["precio_dist"] * $producto["cantidad_min"];
                  }
                  ?>
                        ">

                  <!--<h3 class="my-3"><b>Envío: </b>$ <span name = "envio"> </span></h3>-->

                  <!--<h3 class="my-3"><b>Total: </b>
                    <span id="total">$ <span id="total" name="total"> </span></span>
                  </h3>-->

                  <br>

                  <div class="mt-4">
                    <button name="submit" class="btn btn-lg btncarrito">
                      <i class="fa fa-cart-plus fa-lg mr-2"></i>
                      Agregar al carrito
                    </button>

                    <button type='button' class="btn btn-lg btncomprar" data-toggle="modal" data-target="#modalCompra" id="CrearPedido">
                      <i class="fa fa-money fa-lg mr-2"></i>
                      Comprar ahora
                    </button>
                  </div>
                </form>
                <?php

                $carrito = new ControladorCatalogo();
                $carrito->ctrAgregarAlCarrito();

                ?>
                <br>
                <h3 class="mb-0"><b>Descripción:</b></h3>
                <h4><?php echo $producto["descripcion"] ?></h4>
                <h3 class="mb-0" style="margin-top: 32px;"><b>Características:</b></h3>
                <h4><?php echo $producto["caracteristicas"] ?></h4>
                <h3 class="mb-0" style="margin-top: 32px;"><b>Detalles Técnicos:</b></h3>
                <h4><?php echo $producto["detalles_tecnicos"] ?></h4>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <?php include "includes/compra.php"; ?>
  <script src="vistas/js/carrito.js"></script>
</body>