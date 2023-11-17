<?php

$item = null;
$valor = null;
$tabla = "productos_mayorista";

$productosmayoristas = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla);

?>

<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">
      <?php if ($_SESSION["tipo"] == 'Administrador') {
        echo 'Productos Añadidos Recientemente (Mayoristas)';
      }
       else if ($_SESSION["tipo"] == 'Mayorista') {
        echo 'Productos Añadidos Recientemente';
      } ?>
    </h3>

    <div class="box-tools pull-right">

      <button type="button" class="bstn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

    </div>

  </div>

  <div class="box-body">

    <ul class="products-list product-list-in-box">

      <?php

      $lim = 0;
      if (count($productosmayoristas) > 10) {
        $lim = 10;
      } else {
        $lim = count($productosmayoristas);
      }
      for ($i = 0; $i < $lim; $i++) {
        $img = "vistas/img/productos/default/anonymous.png";
        if ($productosmayoristas[$i]["imagenes"] != null) {
          $imgs = $productosmayoristas[$i]["imagenes"];
          $imgs_array = explode("<br>", $imgs);
          $img = $imgs_array[0];
        }
        echo '<li class="item">

        <div class="product-img">

          <img src="' . $img . '">

        </div>

        <div class="product-info">

          <a href="" class="product-title">'

          . $productosmayoristas[$i]["nombre"] . '

            <span class="label label-warning pull-right">$' . $productosmayoristas[$i]["precio_mayorista"] . '</span>

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