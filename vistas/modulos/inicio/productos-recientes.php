<?php

$item = null;
$valor = null;
$tablaf = "productos_fab";
$tablam = "productos_mayorista";

$productosfabs = ControladorGeneral::ctrMostrarFilas($item, $valor, $tablaf);

$productosmayoristas = ControladorGeneral::ctrMostrarFilas($item, $valor, $tablam);

?>


<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Productos Añadidos Recientemente (Fabricante)</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

    </div>

  </div>

  <div class="box-body">

    <ul class="products-list product-list-in-box">

      <?php

      $lim = 0;
      if (count($productosfabs) > 10) {
        $lim = 10;
      } else {
        $lim = count($productosfabs);
      }
      for ($i = 0; $i < $lim; $i++) {
        $img = "vistas/img/productos/default/anonymous.png";
        if ($productosfabs[$i]["imagenes"] != null) {
          $imgs = $productosfabs[$i]["imagenes"];
          $imgs_array = explode("<br>", $imgs);
          $img = $imgs_array[0];
        }
        echo '<li class="item">

        <div class="product-img">

          <img src="' . $img . '">

        </div>

        <div class="product-info">

          <a href="" class="product-title">'

          . $productosfabs[$i]["nombre"] . '

            <span class="label label-warning pull-right">$' . $productosfabs[$i]["precio_mayorista"] . '</span>

          </a>
    
       </div>

      </li>';
      }

      ?>

    </ul>

  </div>

  <div class="box-footer text-center">

    <a href="productos-fabs" class="uppercase">Ver todos los productos</a>

  </div>

</div>