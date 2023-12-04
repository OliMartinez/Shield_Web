<head>
    <link rel="stylesheet" type="text/css" href="vistas/css/zonas.css">
</head>

<body>
    <div class="content-wrapper">

        <section class="content-header">

            <h1>

                Administrar zonas

            </h1>
            <ol class="breadcrumb">

                <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

                <li class="active">Administrar zonas</li>

            </ol>

        </section>

        <section class="content">

            <div class="box">

                <div class="box-header with-border">

                    <button class="btn btn-primary btnAgregar">
                        <a href="zona" style="color:white; :hover{color:white;}">
                            Agregar zona
                        </a>
                    </button>

                </div>

                <div class="box-body">

                    <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                        <thead>
                            <tr>
                                <th style="width:10px"></th>
                                <th style="width:67px; text-align:center">Acciones</th>
                                <th style="text-align:center">Zonas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $item = null;
                            $valor = null;
                            if ($_SESSION["tipo"] == "Mayorista") {
                                $item = "mayorista";
                                $valor = $_SESSION["ID"];
                            }
                            $zonas = ControladorGeneral::ctrMostrarFilas($item, $valor, "zonas");
                            foreach ($zonas as $key => $value) {
                                echo '<tr data-id="' . $value["ID"] . '">
                            <td>' . ($key + 1) . '</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditarZona" tabla="zonas" idZona="' . $value["ID"] . '"><i class="fa fa-pencil"></i></button>                   
                                    <button class="btn btn-danger btnEliminarZona" idElimZona="' . $value["ID"] . ' tabla="zonas"><i class="fa fa-times"></i></button>                      
                                </div>                  
                            </td>
                            <td>';
                                echo '
                                <div class="cuadro">
                                    <div class="div-nombre-zona">
                                        <h3 class="nombre-zona">' . $value["ID"] . '</h3>
                                    </div>
                                    <div class="cuerpo">';
                                $estados = explode(',', $value['estados']);
                                $muncipios_por_estado = explode(',', $value['ciudades']);
                                foreach ($estados as $key_estado => $estado) {
                                    echo
                                    '<div class="subcuadro">
                                            <div class="estado">
                                                <h4>' . $estado . '</h4>
                                            </div>
                                            <div class="municipios">';
                                    $municipios = explode('-', $muncipios_por_estado[$key_estado]);
                                    foreach ($municipios as $key_munc => $munc) {
                                        echo '
                                                <div>
                                                    <p class="mun">' . $munc . '</p>
                                                </div>';
                                    };
                                    echo '
                                            </div>
                                        </div>';
                                }
                                echo
                                '</div>
                                </div>
                            </td>
                        </tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </section>

    </div>
    <script src="vistas/js/zonas.js"></script>
</body>
<?php

$eliminarZona = new ControladorZonas();
$eliminarZona->ctrEliminarZona();

?>