<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Custom CSS -->
    <!--<link rel="stylesheet" type="text/css" href="../css/estilo-catalogo.css">-->

    <!-- Custom JavaScript -->
    <!--<script src="vistas/js/jssor.slider-26.3.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="vistas/js/catalogo.js"></script>-->

</head>

<body>
    <div class="wrapper">
        <div class="content-wrapper" style="background-color: white;">

            <section class="content-header">

                <h1>

                    Catálogo

                </h1>

                <ol class="breadcrumb">

                    <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

                    <li class="active">Catálogo</li>

                </ol>

            </section>
            <section class="content">

                    <div style="border-bottom: 3px solid #A9A9A9;margin-top: 1%">

                        <div class="row">
                            <?php

                            $item = null;
                            $valor = null;

                            if ($_SESSION["tipo"] == "Distribuidor") {
                                $item = "mayorista";
                                $tabla = "productos_mayorista";
                                $valor  = ControladorGeneral::ctrMostrarItems("ID", $_SESSION["ID"], "dists", $item);

                            } else if ($_SESSION["tipo"] == "Mayorista") {

                                $tabla = "productos_fab";
                            }

                            $Productos = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla); ?>

                            <?php foreach ($Productos as $key => $value) {
                                echo '<div class="col-md-3 product">
                                        <div style="border-bottom: 1px solid #A9A9A9">
                                            <a class="producto-catalogo" style="cursor:pointer;" idProducto="' . $value["ID"] . '"><img style="width:100%;height:100%;" src=\'' . explode('<br>',$value["imagenes"])[0] . '\' ></a>
                                        </div>
                                        <p style="text-align: center;"><b><a class="producto-catalogo" style="cursor:pointer; color: black;" idProducto="' . $value["ID"] . '">' . $value["nombre"] . '</a></b></p>
                                        <p style="text-align: center;" data-currency-iso="MXN">$';

                                if ($_SESSION["tipo"] == "Mayorista") {
                                    echo $value["precio_mayorista"];
                                } else {
                                    echo $value["precio_dist"];
                                }

                                echo '</p>
                                      <p style="text-align: center;"><a class="producto-catalogo" style="cursor:pointer; margin: 5%;" idProducto="' . $value["ID"] . '">Ver más...</a><p>
                                      <br><br><br>
                                    </div>';
                            } ?>

                        </div>
                    </div>
            </section>
        </div>
    </div>
</body>