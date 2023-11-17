
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

            <!--        <div id="jssor_1" style="position:relative;margin: 0 auto; top:0px;left:0px;width:980px;height:392px;overflow:hidden;visibility:hidden;border-bottom: 3px solid #A9A9A9">

            <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../img/spin.svg" />
            </div>
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:390px;overflow:hidden;">
                <div>
                    <img data-u="image" src="vistasimgcatalog-reel1.jpg">
                <div>
                <div>
                    <img data-u="image" src="vistasimgcatalog-reel2.jpg">
                <div>
                <div>
                    <img data-u="image" src="vistasimgcatalog-reel3.jpg">
                <div>
                <div>
                    <img data-u="image" src="vistasimgcatalog-reel4.jpg">
                <div>
                <div>
                    <img data-u="image" src="vistasimgcatalog-reel5.jpg">
                <div>
                <div>
                    <img data-u="image" src="vistasimgcatalog-reel6.jpg">

                </div>
                <div>
                    <img data-u="image" src="vistas/img/catalog-reel/7.jpg">
                </div>
                <div>
                    <img data-u="image" src="vistas/img/catalog-reel/8.jpg">
                </div>
                <div>
                    <img data-u="image" src="vistas/img/catalog-reel/9.jpg">

                </div>
                <a data-u="any" href="https://www.jssor.com" style="display:none">slider in bootstrap</a>
            </div>
            
            <div data-u="navigator" class="jssorb053" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                <div data-u="prototype" class="i" style="width:16px;height:16px;">
                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <path class="b" d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z"></path>
                    </svg>
                </div>
            </div>
            
            <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                    <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                    <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                </svg>
            </div>
            <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                    <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                    <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                </svg>
            </div>
        </div>
        <script type="text/javascript">
            jssor_1_slider_init();
        </script>
-->
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