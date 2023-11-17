<body style="background-image: linear-gradient(blue, purple);">
    <div class="content" style="height: 100vh; display: flex; align-items: center;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label style="font-size: 20px">Ingresa tu correo electrónico para reestablecer tu contraseña</label>
                                <input type="text" class="form-control" id="Email" name="Email" required placeholder="Ingresa el correo electrónico">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btnSalir">Salir</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                    <?php
                    $reestContrasena = new ControladorUsuarios();
                    $reestContrasena->ctrReestContrasena();
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>