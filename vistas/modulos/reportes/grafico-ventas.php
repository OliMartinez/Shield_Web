<?php

error_reporting(0);

$respuesta = ControladorGeneral::ctrMostrarFilas(null,null,"pedidos_mayoristas");

$arrayFechas = array();
$arrayPedidos = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value) {

  #Capturamos sólo el año y el mes
  $fecha = substr($value["fecha_solicitud"], 0, 7);

  #Introducir las fechas en arrayFechas
  array_push($arrayFechas, $fecha);

  #Capturamos los Pedidos
  $arrayPedidos = array($fecha => $value["precio"]);

  #Sumamos los pagos que ocurrieron el mismo mes
  foreach ($arrayPedidos as $key => $value) {

    $sumaPagosMes[$key] += $value;
  }
}

$noRepetirFechas = array_unique($arrayFechas);


?>

<!--=====================================
GRÁFICO DE Pedidos
======================================-->


<div class="box box-solid bg-teal-gradient">

  <div class="box-header">

    <i class="fa fa-th"></i>

    <h3 class="box-title">Ventas a Mayoristas</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

    </div>

  </div>

  <div class="box-body border-radius-none nuevoGraficoPedidos">

    <div class="chart" id="line-chart-Pedidosayoristas" style="height: 250px;"></div>

  </div>

</div>

<script>
  var line = new Morris.Line({
    element: 'line-chart-Pedidosayoristas',
    resize: true,
    data: [

      <?php

      if ($noRepetirFechas != null) {

        foreach ($noRepetirFechas as $key) {

          echo "{ y: '" . $key . "', Ventas: " . $sumaPagosMes[$key] . " },";
        }

        echo "{y: '" . $key . "', Ventas: " . $sumaPagosMes[$key] . " }";
      } else {

        echo "{ y: '0', Ventas: '0' }";
      }

      ?>

    ],
    xkey: 'y',
    ykeys: ['Ventas'],
    labels: ['Ventas'],
    lineColors: ['#efefef'],
    lineWidth: 2,
    hideHover: 'auto',
    gridTextColor: '#fff',
    gridStrokeWidth: 0.4,
    pointSize: 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor: '#efefef',
    gridTextFamily: 'Open Sans',
    preUnits: '$',
    gridTextSize: 10
  });
</script>