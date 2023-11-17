<div style="background-image: linear-gradient(blue, purple);">

    <div class="content">

        <div class="modal-dialog">

            <div class="modal-content">

                <form role="form" enctype="multipart/form-data" method="post">
                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header" style="background:#3c8dbc; color:white">

                        <h4 class="modal-title">Formulario de Solicitante para ser Distribuidor</h4>

                    </div>

                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                    <div class="modal-body">

                        <div class="box-body">
                            <div class="form-group">
                                <label>Nombre completo*</label>
                                <input type="text" class="form-control" id="NomLegal_o_RS" name="NomLegal_o_RS" required placeholder="Ingresa el nombre completo">
                                <input type="hidden" name="IDant" id="IDant">
                                <input type="hidden" name="tipoguardar" id="tipoguardar" value="crear">
                                <input type="hidden" name="tabla" id="tabla" value="solicitantes">
                            </div>
                            <div class="form-group">
                                <label>Nombre de usuario único*</label>
                                <input type="text" class="form-control" id="ID" name="ID" required placeholder="Ingresa el nombre de usuario">
                            </div>
                            <div class="box-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Contraseña*</label>
                                        <input type="password" class="form-control" name="Password" id="Password" placeholder="Ingresa la contraseña">
                                        <span id="passwordStrength"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirmar Contraseña*</label>
                                        <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" placeholder="Ingresa la confirmación de contraseña">
                                        <span id="passwordCoincide"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email*</label>
                                <input type="email" class="form-control" id="Email" name="Email" required placeholder="Ingresa el correo electrónico">
                                <input type="hidden" id="Emailant">
                            </div>
                            <div class="form-group">
                                <label>Teléfono*</label>
                                <input type="text" class="form-control" data-inputmask="'mask':'(999) 999-9999'" data-mask id="Tel" name="Tel" required placeholder="Ingresa el teléfono">
                                <input type="hidden" id="Telant">
                            </div>
                            <div class="form-group">
                                <label>Estado*</label>
                                <select class="form-control" id="EstadoSelect" name="Estado" required>
                                    <option value="" id="Estado">Elegir Estado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ciudad*</label>
                                <select class="form-control" id="CiudadSelect" name="Ciudad" required>
                                    <option value="" id="Ciudad">Elegir Ciudad</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA CÓDIGO POSTAL (5 NÚMEROS) -->
                            <div class="form-group">
                                <label>Código Postal*</label>
                                <input type="text" name="CP" class="form-control" data-inputmask="'mask':'99999'" data-mask id="CP" required placeholder="Ingresa el código postal">
                            </div>
                            <!-- ENTRADA PARA LA DIRECCIÓN FISCAL -->
                            <div class="form-group">
                                <label>Dirección Fiscal*</label>
                                <div class="input-group">
                                    <input type="text" name="Dir_Fiscal" id="Dir_Fiscal" class="form-control input-lg" placeholder="Ingresa la dirección fiscal" required>
                                    <input type="hidden" id="Dir_Fiscalant">
                                </div>
                            </div>
                            <!-- ENTRADA PARA DOMICILIO ADICIONAL-->
                            <div class="form-group">
                                <label>Domicilio Adicional</label>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg domicilio" name="Domicilios[]" placeholder="Ingresa el domicilio">
                                    <!--<input type="hidden" class="domicilioant">-->
                                    <span class="input-group-addon" style="padding: 0px 0px"><button type="button" class="btn btn-info" id="btnAgregarNuevoDomicilio" style="height: 45px; width: 45px"><i class="fa fa-plus"></i></button></span>
                                </div>
                            </div>
                            <!-- ENTRADA PARA LA HISTORIA -->
                            <div class="form-group">
                                <label>Historia/Descripción de tu empresa/negocio*</label>
                                <textarea class="form-control input-lg" name="Historia" id="Historia" required rows="10" placeholder="Ingresa la historia/descripción de la empresa/negocio"></textarea>
                            </div>

                            <!-- ENTRADA PARA LA PROPUESTA -->
                            <div class="form-group">
                                <label>Propuesta de ventas mensuales (MXN)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="number" name="Propuesta" class="form-control" id="Propuesta" placeholder="Ingresa la propuesta">
                                </div>
                            </div>
                            <!-- ENTRADA PARA SITUACIÓN FISCAL PDF -->
                            <div class="form-group">
                                <label>Subir Situación Fiscal en PDF*</label>
                                <input type="file" id="SF" name="SF" class="archivo">
                                <img id="miniaturaSF" src="">
                            </div>
                            <!-- ENTRADA PARA ACTA CONSTITUTIVA PDF -->
                            <div class="form-group">
                                <label>¿Eres persona física o moral?*</label>
                                <br>
                                <fieldset required>
                                    <input type="radio" class="Tipopersona" name="Tipopersona" value="0">
                                    <label for="Física">Física</label><br>
                                    <input type="radio" class="Tipopersona" name="Tipopersona" value="1">
                                    <label for="Moral">Moral</label><br>
                                </fieldset>
                                <br>
                                <label id="labelAC">Subir Acta Constitutiva en PDF*</label>
                                <input type="file" id="AC" name="AC" class="archivo">
                                <img id="miniaturaAC" src="" style="max-width: 300px; display: none;">

                            </div>
                            <!-- ENTRADA PARA INE O PASAPORTE PDF -->
                            <div class="form-group">
                                <label>Subir Identificación Oficial (INE, Pasaporte, etc)*</label>
                                <input type="file" id="IDE" name="IDE" class="archivo">
                                <img id="miniaturaIDE" src="">
                            </div>
                            <!-- ENTRADA PARA COMPROBANTE DE DIRECCIÓN FISCAL PDF -->
                            <div class="form-group">
                                <label>Subir Comprobante de Dirección Fiscal en PDF*</label>
                                <input type="file" id="CompDom" name="CompDom" class="archivo">
                                <img id="miniaturaCompDom" src="">
                            </div>

                            <!-- ENTRADA PARA FOTO -->
                            <div class="form-group">
                                <label>Subir Foto de Perfil</label>
                                <input type="file" id="Foto" name="Foto">
                                <p class="help-block">Peso máximo de la foto 2MB</p>
                                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar imgclick" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto" width=" 100px">
                                <input type="hidden" name="fotoActual" id="fotoActual">
                            </div>

                            <div class="form-group">
                                <div class="g-recaptcha" name="g-recaptcha" data-sitekey="6LfDyOskAAAAABg5zkCg2D0BNg2FkzcrPo0sq_Js"></div>
                            </div>

                        </div>

                    </div>

                    <!-- /.card-body -->

                    <div class="modal-footer botones">
                        <button type="button" class="btn btn-danger btnSalir">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar y Enviar</button>
                    </div>
                    <?php
                    $guardarUsuario = new ControladorUsuarios();
                    $guardarUsuario->ctrGuardarUsuario();
                    ?>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include "includes/modalFoto.html"; ?>