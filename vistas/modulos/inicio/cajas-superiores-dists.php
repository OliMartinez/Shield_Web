<?php

$item = null;
$item1 = null;
$item2 = null;
$valor = null;
$fechaInicial = null;
$fechaFinal = null;
$ventas_dists = null;
$pedidos_dists = null;
$totalPedidosDists = null;
$tabla = "dists";
$tablap = "productos_mayorista";
$totalDists = null;

if (isset($_GET["fechaInicial"])) {

  $fechaInicial = $_GET["fechaInicial"];
  $fechaFinal = $_GET["fechaFinal"];
}
if ($_SESSION["tipo"] == "Administrador") {
  $ventas_dists = ControladorGeneral::ctrSumar("pedidos_dists", "precio", null, null);
  $pedidos_dists = ControladorGeneral::ctrMostrarFilas(null, null, "pedidos_dists");
  $totalPedidosDists = count($pedidos_dists);
  $totalDists = ControladorGeneral::ctrContFilas("dists", null, null);
}
else if($_SESSION["tipo"] == 'Fabricante') {
  $item = "ID";
  $item1 = "mayorista";
  $valor = "FLEXOLAN S.A de C.V";
  $pedidos_de_todos_dists = ControladorGeneral::ctrMostrarFilas(null, null, "pedidos_dists");

  foreach($pedidos_de_todos_dists as $key => $value){
    $mayorista_de_dist = ControladorGeneral::ctrMostrarItems("ID", $value["dist"], "dists", "Mayorista");
    if("FLEXOLAN S.A de C.V" == $mayorista_de_dist){
      $ventas_dists += $value["precio"];
      $totalPedidosDists++;
    }
  }
}
else if ($_SESSION["tipo"] == "Mayorista") {
  $item = "ID";
  $item1 = "mayorista";
  $valor = $_SESSION["ID"];
  $pedidos_de_todos_dists = ControladorGeneral::ctrMostrarFilas(null, null, "pedidos_dists");

  foreach($pedidos_de_todos_dists as $key => $value){
    $mayorista_de_dist = ControladorGeneral::ctrMostrarItems("ID", $value["dist"], "dists", "Mayorista");
    if($_SESSION["ID"] == $mayorista_de_dist){
      $ventas_dists += $value["precio"];
      $totalPedidosDists++;
    }
  }
}
$totalDists = ControladorGeneral::ctrContFilas($tabla, $item1, $valor);
$productosmayoristas = ControladorGeneral::ctrMostrarFilas($item1, $valor, $tablap);
$totalProductosmayoristas = count($productosmayoristas);

?>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">

    <div class="inner">

      <h3>$<?php echo number_format($ventas_dists, 2); ?></h3>

      <p>Ventas a Distribuidores<?php if($_SESSION["tipo"]=="Fabricante"){echo ' directos';} ?></p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="pedidos-dists" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3><?php echo number_format($totalPedidosDists); ?></h3>

      <p>Pedidos de Distribuidores<?php if($_SESSION["tipo"]=="Fabricante"){echo ' directos';} ?></p>

    </div>

    <div class="icon">

      <i class="ion ion-clipboard"></i>

    </div>

    <a href="pedidos-dists" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">

    <div class="inner">

      <h3><?php echo number_format($totalDists); ?></h3>

      <p>Distribuidores<?php if($_SESSION["tipo"]=="Fabricante"){echo ' directos';} ?></p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="dists" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>
<?php if($_SESSION["tipo"] == "Administrador" || $_SESSION["tipo"] == "Mayorista"){echo '
<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">

    <div class="inner">

      <h3>'; echo number_format($totalProductosmayoristas); echo '</h3>

      <p>Productos'; if ($_SESSION["tipo"] == "Administrador") {
                    echo ' de Mayoristas';
                  } echo '</p>

    </div>

    <div class="icon">

      <i class="ion ion-ios-cart"></i>

    </div>

    <a href="productos-mayoristas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>'; }?>