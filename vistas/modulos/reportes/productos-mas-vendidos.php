<?php

$item = null;
$valor = null;
$tablaf = "productos_fab";
$tablam = "productos_mayorista";

$productosfabs = ControladorGeneral::ctrMostrarFilas($item, $valor, $tablaf);

$productosmayoristas = ControladorGeneral::ctrMostrarFilas($item, $valor, $tablam);

$colores = array("red", "green", "yellow", "aqua", "purple", "blue", "cyan", "magenta", "orange", "gold");

//$totalVentas = ControladorProductosFabs::ctrMostrarSumaVentas();


?>

<!--=====================================
PRODUCTOS MÁS VENDIDOS
======================================-->

<div class="box box-default">

  <div class="box-header with-border">

    <h3 class="box-title">Productos más vendidos a Mayoristas</h3>
    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

    </div>
  </div>

  <div class="box-body">

    <div class="row">

      <div class="col-md-7">

        <div class="chart-responsive">

          <canvas id="pieChart" height="150"></canvas>

        </div>

      </div>

      <div class="col-md-5">

        <ul class="chart-legend clearfix">

          <?php

          $lim = 0;
          if (count($productosfabs) > 10) {
            $lim = 10;
          } else {
            $lim = count($productosfabs);
          }
          for ($i = 0; $i < $lim; $i++) {

            echo ' <li><i class="fa fa-circle-o text-' . $colores[$i] . '"></i> ' . $productosfabs[$i]["nombre"] . '</li>';
          }


          ?>


        </ul>

      </div>

    </div>

  </div>

  <div class="box-footer no-padding">

    <ul class="nav nav-pills nav-stacked">

      <?php
      $lim = 0;
      if (count($productosfabs) > 5) {
        $lim = 5;
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
        echo '<li>
						 
						 <a>

						 <img src="' . $img . '" class="img-thumbnail" width="60px" style="margin-right:10px"> 
						 ' . $productosfabs[$i]["nombre"] . '

						 <span class="pull-right text-' . $colores[$i] . '">   
						 ' . ceil(100 * 100 / 100) . '%
						 </span>
							
						 </a>

      				</li>';
      }

      ?>


    </ul>

  </div>

</div>

<script>
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [

    <?php
    $lim = 0;
    if (count($productosfabs) > 10) {
      $lim = 10;
    } else {
      $lim = count($productosfabs);
    }
    for ($i = 0; $i < $lim; $i++) {

      echo "{
      value    : 100,
      color    : '" . $colores[$i] . "',
      highlight: '" . $colores[$i] . "',
      label    : 'unidades de " . $productosfabs[$i]["nombre"] . "'
    },";
    }

    ?>
  ];

  var pieOptions = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    // String - The colour of each segment stroke
    segmentStrokeColor: '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps: 100,
    // String - Animation easing effect
    animationEasing: 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    // String - A legend template
    legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate: '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------
</script>