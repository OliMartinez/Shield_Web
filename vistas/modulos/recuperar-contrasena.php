<body style="background-image: linear-gradient(blue, purple);">
    <div class="content" style="height: 100vh; display: flex; align-items: center;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <div class="box-body">
                            <div id=passwordFields>
                                <div class=form-group>
                                    <label>Escribe la nueva contraseña</label>
                                    <input type=password class=form-control name=Password id=Password>
                                    <span id=passwordStrength></span>
                                </div>
                                <div class=form-group>
                                    <label>Confirma la nueva contraseña</label>
                                    <input type=password class=form-control Password name=ConfirmPassword id=ConfirmPassword>
                                    <span id=passwordCoincide></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btnSalir">Salir</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                    <?php
                    //$reestContrasena = new ControladorUsuarios();
                    //$reestContrasena->ctrReestContrasena();
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>