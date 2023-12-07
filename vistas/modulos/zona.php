<?php
$idZona = '';
$estados = '';
$munics_por_estado = '';
if (isset($_GET['idZona'])) {
    $idZona = $_GET['idZona'];
    $item = 'ID';
    $zona = ControladorGeneral::ctrMostrarFilas($item, $idZona, "zonas");
    $estados = explode(',', $zona['estados']);
    $munics_por_estado = explode(',', $zona['ciudades']);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Formulario de Zona</h1>
    </section>
    <section class="content">
        <div class="row">
            <form role="form" enctype="multipart/form-data" method="post">
                <div class="col-lg-12">

                    <div class="box box-primary">
                        <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->
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

                    </div>

                </div>
                <?php
                foreach ($estados as $key => $estado) {
                    echo '
                <div class="col-lg-12 EstadoBox">

                    <div class="box box-info">
                        <!--=====================================
                        CUERPO DEL MODAL
                        ======================================-->
                        <div class="box-body">
                            <!-- ENTRADA PARA SELECCIONAR EL ESTADO -->
                            <div class="form-group">
                                <label class="EstadoLabel">Estado</label>
                                <div class="input-group">
                
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    
                                    <select class="form-control input-lg EstadoSelect" name="Estado">
                    
                                        <option value="' . $estado . '" class="Estado">' . $estado . '</option>
                    
                                    </select>
                
                                </div>
                
                            </div>
                            <div class="form-group">
                                <label class="CiudadesLabel">Ciudades</label>
                                <div style="height: 300px;
                                border: 1px solid rgba(0, 0, 0, .125);
                                border-radius: 0.25rem;
                                min-width: 20%;
                                width: 100%;
                                overflow: auto;
                                padding: 0.75rem;">
                                    <fieldset class="Ciudades" required>';

                    $json = json_decode(file_get_contents('vistas/js/estados-munics.json'), true);
                    $munics = explode('-', $munics_por_estado[$key]);
                    if (array_key_exists($estado, $json[0])) {
                        foreach ($json[0][$estado] as $key1 => $munic) {
                            echo '<label class="checkbox-inline"><input type="checkbox" value="' . $munic . '"';
                            if (in_array($munic, $munics)) {
                                echo 'checked';
                            };
                            echo '>' . $munic . '</label><br>';
                        }
                    }

                    echo '          </fieldset>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>';
                } ?>
                <button type="button" class="btn btn-primary col-lg-12" id="AgregarEstado">Agregar estado</button>
                <br><br><br>
                <div class="col-lg-12">
                    <div class="box">
                        <?php include "includes/guardar.html"; ?>
                    </div>
                </div>
            </form>
            <?php

            $guardarZona = new ControladorZonas();
            $guardarZona->ctrGuardarZona();

            ?>
        </div>
    </section>
</div>
<script src="vistas/js/zonas.js"></script>