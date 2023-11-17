<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar colecciones

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar colecciones</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-primary btnAgregar btnCrearColeccion" data-toggle="modal" data-target="#modalColeccion">

                    Agregar colección

                </button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                        <tr>
                            <th style="width:10px">#</th>
                            <th>Imagen</th>
                            <th>Colección</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;
                        $tabla = "colecciones";
                        $colecciones = ControladorGeneral::ctrMostrarFilas($item, $valor, $tabla);

                        foreach ($colecciones as $key => $value) {

                            echo ' <tr>

                                <td>' . ($key + 1) . '</td>
                                <td>';
                            if ($value["imagen"] != "") {

                                echo '<img src="' . $value["imagen"] . '" class="img-thumbnail imgclick" width="40px" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto">';
                            }
                            echo '</td>
                                    <td>' . $value["ID"] . '</td>

                                    <td>' . $value["descripcion"] . '</td>
                                
                                    <td>

                                        <div class="btn-group">
                                            
                                            <button class="btn btn-warning btnEditarColeccion" idColeccion="' . $value["ID"] . '" data-toggle="modal" data-target="#modalColeccion"><i class="fa fa-pencil"></i></button>';

                            echo '<button class="btn btn-danger btnEliminarColeccion" idColeccion="' . $value["ID"] . ' tabla="colecciones"><i class="fa fa-times"></i></button>';

                            echo '</div>  

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

<!--=====================================
MODAL COLECCIÓN
======================================-->

<div id="modalColeccion" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" enctype="multipart/form-data" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar colección</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <label for="ID">Nombre:</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" id="ID" name="ID" required>

                                <input type="hidden" name="tipoguardar" id="tipoguardar" value="crear">

                                <input type="hidden" name="tabla" id="tabla" value="colecciones">

                                <input type="hidden" name="IDant" id="IDant">

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA DESCRIPCIÓN -->
                        <div class="form-group">
                            <label for="Descripcion">Descripción:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                <textarea class="form-control input-lg" id="Descripcion" name="Descripcion" rows="10"></textarea>
                            </div>
                        </div>

                        <!-- ENTRADA PARA IMAGEN -->
                        <div class="form-group">
                            <label for="Foto">Imagen</label>
                            <input type="file" id="Foto" name="Foto">
                            <img src="" class="img-thumbnail previsualizar imgclick" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto" width="100px">
                            <input type="hidden" name="fotoActual" id="fotoActual">
                        </div>
                    </div>

                </div>

                <?php include "includes/guardar.html"; ?>

                <?php

                $guardarColeccion = new ControladorCategoriasColecciones();
                $guardarColeccion->ctrGuardar();

                ?>

            </form>

        </div>

    </div>

</div>
<?php

$eliminarColeccion = new ControladorCategoriasColecciones();
$eliminarColeccion->ctrEliminar();

include "includes/modalFoto.html";

?>

<script src="vistas/js/colecciones.js"></script>