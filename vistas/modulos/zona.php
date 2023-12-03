<?php
$idZona = '';
$estados = '';
$munics = '';
if (isset($_GET['idZona'])) {
    $idZona = $_GET['idZona'];
    $item = 'ID';
    $zona = ControladorGeneral::ctrMostrarFilas($item, $idZona, "zonas");
    $estados = $zona['estados'];
    $munics = $zona['ciudades'];
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Formulario de Zona</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="box box-primary">
                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->
                    <form role="form" enctype="multipart/form-data" method="post">
                        <div class="box-body">

                            <!-- ENTRADA PARA EL NOMBRE DE ZONA-->
                            <div class="form-group">
                                <label>Nombre de la zona*</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                                    <input type="text" class="form-control input-lg" name="ID" id="ID" placeholder="Ingresa el nombre de la zona" value=<?php echo '"' . $idZona . '"'; ?>required>
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
                        <?php include "includes/guardar.html"; ?>
                    </form>

                </div>

                <?php

                $guardarZona = new ControladorZonas();
                $guardarZona->ctrGuardarZona();

                ?>

            </div>
        </div>
    </section>
</div>
<script src="vistas/js/zonas.js"></script>