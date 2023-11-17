<?php

$item = null;
$valor = null;
$tablaf = "productos_fab";

if (isset($_GET["fechaInicial"])) {

  $fechaInicial = $_GET["fechaInicial"];
  $fechaFinal = $_GET["fechaFinal"];
} else {

  $fechaInicial = null;
  $fechaFinal = null;
}

$ventas_mayoristas =  ControladorGeneral::ctrSumar("pedidos_mayoristas","precio",null,null);

$pedidos_mayoristas = ControladorGeneral::ctrMostrarFilas(null,null,"pedidos_mayoristas");
$totalPedidosMayoristas = count($pedidos_mayoristas);

$tabla="mayoristas";
$mayoristas = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla);
$totalMayoristas = count($mayoristas);

$productosfabs = ControladorGeneral::ctrMostrarFilas($item, $valor, $tablaf);
$totalProductosfabs = count($productosfabs);

?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">

    <div class="inner">

      <h3>$<?php echo number_format($ventas_mayoristas, 2); ?></h3>

      <p>Ventas a Mayoristas</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="pedidos-mayoristas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3><?php echo number_format($totalPedidosMayoristas); ?></h3>

      <p>Pedidos de Mayoristas</p>

    </div>

    <div class="icon">

      <i class="ion ion-clipboard"></i>

    </div>

    <a href="pedidos-mayoristas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">

    <div class="inner">

      <h3><?php echo number_format($totalMayoristas); ?></h3>

      <p>Mayoristas</p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="mayoristas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">

    <div class="inner">

      <h3><?php echo number_format($totalProductosfabs); ?></h3>

      <p>Productos de Fábricante</p>

    </div>

    <div class="icon">

      <i class="ion ion-ios-cart"></i>

    </div>

    <a href="productos-fabs" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>