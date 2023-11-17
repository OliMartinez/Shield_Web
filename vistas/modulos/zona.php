<div id="modalZona" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" enctype="multipart/form-data" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Formulario zona</h4>

                </div>
                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE DE ZONA-->
                        <div class="form-group">
                            <label>Nombre de la zona*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                                <input type="text" class="form-control input-lg" name="ID" id="ID" placeholder="Ingresa el nombre de la zona" required>
                                <input type="hidden" name="IDant" id="IDant">
                                <input type="hidden" name="tipoguardar" id="tipoguardar" value="crear">
                                <input type="hidden" name="tabla" id="tabla" value="zonas">
                            </div>
                        </div>
                        <?php
                        if ($_SESSION["tipo"] == "Administrador") {
                            echo '
                            <!-- ENTRADA PARA SELECCIONAR EL MAYORISTA -->
                            
                            <div class="form-group">

                            <label>Mayorista*</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>

                                <select class="form-control input-lg" name="Mayorista" id="MayoristaSelect" required>

                                    <option value="" id="Mayorista"></option>';

                            $item = null;
                            $valor = null;
                            $tabla = "mayoristas";
                            $item1 = "ID";
                            $Mayoristas = ControladorGeneral::ctrMostrarItems($item, $valor, $tabla, $item1);

                            foreach ($Mayoristas as $key => $value) {

                                echo '<option value="' . $value["ID"] . '" >' . $value["ID"] . '</option>';
                            }

                            echo '
                                </select>

                            </div>

                            </div>';
                        } ?>

                    </div>

                </div>

                <?php include "includes/guardar.html"; ?>

                <?php

                $guardarZona = new ControladorZonas();
                $guardarZona->ctrGuardarZona();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$eliminarZona = new ControladorZonas();
$eliminarZona->ctrEliminarZona();

?>
<script src="vistas/js/zonas.js"></script>