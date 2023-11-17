<div class="content-wrapper" style="background-image: linear-gradient(blue, red);">

  <section class="content">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" enctype="multipart/form-data" method="post">
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

          <div class="modal-header" style="background:#3c8dbc; color:white">

            <h4 class="modal-title">Información de Cuenta</h4>

          </div>

          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

          <div class="modal-body">

            <div class="box-body">
              <?php
              $tabla2 = "";
              $item = "ID";
              $valor = $_SESSION["ID"];

              $info_user =  ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2); ?>
              <div class="form-group">
                <label>Nombre de usuario*</label>
                <input type="text" class="form-control" value="<?php echo $info_user['ID']; ?>" name="ID" id="ID" required>
                <input type="hidden" name="IDant" id="IDant" value="<?php echo $info_user['ID']; ?>">
                <input type="hidden" name="tipoguardar" id="tipoguardar" value="editar">
              </div>
              <?php
              if($_SESSION["tipo"]!="Administrador" and $_SESSION["tipo"]!="Fabricante"){
                  echo '<div class="form-group">
                    <label>Nombre Legal/Razón Social*</label>
                    <input type="text" class="form-control" value="'.$info_user['nombre_legal_o_rs'].'" name="NomLegal_o_RS" id="NomLegal_o_RS">
                  </div>';
              }
              ?>
              <div class="box-body">
                <div class="card-body">
                  <div class="form-group">
                    <button type="button" class="btn btn-primary" id="togglePassword">Cambiar Contraseña</button>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Tipo</label>
                <input type="text" class="form-control" value="<?php echo $info_user['tipo']; ?>" name="Tipo" id="Tipo" readonly>
              </div>
              <div class="form-group">
                <label>Email*</label>
                <input type="email" class="form-control" value="<?php echo $info_user['email']; ?>" name="Email" id="Email" required>
                <input type="hidden" id="Emailant" value="<?php echo $info_user['email']; ?>">
              </div>
              <div class="form-group">
                <label>Teléfono*</label>
                <input type="text" class="form-control" data-inputmask="'mask':'(999) 999-9999'" value="<?php echo $info_user['tel']; ?>" name="Tel" id="Tel">
                <input type="hidden" id="Telant" value="<?php echo $info_user['tel']; ?>">
              </div>
              <?php $tipo = $_SESSION["tipo"];
              if ($tipo != "Administrador" and $tipo != "Fabricante") {
                if ($tipo == "Agente") {
                  $item = "ID";
                  $valor = $_SESSION["ID"];
                  $tabla2 = "agentes";
                  $info_user =  ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);
                  echo '<div class="form-group">
                      <label>Mayorista</label>
                      <input class="form-control" name="Mayorista" id="MayoristaSelect" value="' . $info_user["mayorista"] . '" readonly>
                    </div>
                    
                    <div class="form-group">
                      <label>Zona</label>
                      <input class="form-control" name="Zona" id="ZonaSelect" value="' . $info_user["zona"] . '" readonly>
                    </div>';
                } else {
                  if ($tipo == "Mayorista") {
                    $tabla2 = "mayoristas";
                    $info_user =  ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);
                  } else if ($tipo == "Distribuidor") {
                    $tabla2 = "dists";
                    $info_user =  ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);
                    echo '<input type="hidden" name="Agente" id="Agente" value="' . $info_user["agente"] . '">';
                  } else if ($tipo == "Solicitante") {
                    $tabla2 = "solicitantes";
                    $info_user =  ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);
                  }
                  echo '
                  <div class="form-group">
                  <label>Estado*</label>
                  <select class="form-control" name="Estado" id="EstadoSelect">
                    <option value="'.$info_user['estado'].'" id="Estado">'.$info_user['estado'].'</option>
                  </select>
                </div>
  
                <div class="form-group">
                  <label>Ciudad*</label>
                  <select class="form-control" name="Ciudad" id="CiudadSelect">
                    <option value="'.$info_user['ciudad'].'" id="Ciudad">'.$info_user['ciudad'].'</option>
                  </select>
                </div>
              <!-- ENTRADA PARA LA DIRECCIÓN FISCAL -->
              <div class="form-group">
                <label>Dirección Fiscal*</label>
                <input type="text" class="form-control" name="Dir_Fiscal" id="Dir_Fiscal" value ="' . $info_user["dir_fiscal"] . '" required>
                <input type="hidden" id="Dir_Fiscalant" value ="' . $info_user["dir_fiscal"] . '">
               </div>';

                  $domicilios = explode("<br>", $info_user["domicilios"]);
                  echo '
               <!-- ENTRADA PARA DOMICILIO ADICIONAL-->
               <div class="form-group">
                 <label>Domicilio Adicional</label>
                 <div class="input-group">
                   <input type="text" class="form-control input-lg domicilio" name="Domicilios[]" value ="' . $domicilios[0] . '">
                   <!--<input type="hidden" class="domicilioant">-->
                   <span class="input-group-addon" style="padding: 0px 0px"><button type="button"
                       class="btn btn-info" id="btnAgregarNuevoDomicilio" style="height: 45px; width: 45px"><i
                         class="fa fa-plus"></i></button></span>
                 </div>
               </div>';
                  $primerElemento = true;
                  foreach ($domicilios as $domicilio) {
                    if ($primerElemento) {
                      $primerElemento = false; // Marca que se ha omitido el primer elemento
                      continue; // Salta el primer elemento y pasa al siguiente
                    }
                    echo '
                <!-- ENTRADA PARA DOMICILIO ADICIONAL-->
                <div class="form-group">
                    <label>Domicilio Adicional</label>
                    <div class="input-group">
                        <input type="text" class="form-control input-lg domicilio" name="Domicilios[]" value ="' . $domicilio . '">
                        <!--<input type="hidden" class="domicilioant" value ="">-->
                        <span class="input-group-addon" style="padding: 0px 0px">
                          <button type="button" class="btn btn-danger btnQuitarDomicilio" style="height: 45px; width: 45px">
                            <i class="fa fa-times">
                            </i>
                          </button>
                        </span>
                    </div>
                </div>';
                  }
                  echo '
              <!-- ENTRADA PARA CÓDIGO POSTAL (5 NÚMEROS) -->
              <div class="form-group">
                <label>Código Postal*</label>
                <input type="text" class="form-control" data-inputmask="\'mask\':\'99999\'" data-mask id="CP" name="CP" value ="' . $info_user["cp"] . '" required>
              </div>
            
              <!-- Situación fiscal PDF -->
              <div class="form-group">
                <label>Subir Situación Fiscal en PDF*</label>
                <input type="file"  class="archivo" name="SF">
                <a href="' . $info_user["sit_fiscal"] . '" id="linkSF" name="linkSF">' . basename($info_user["sit_fiscal"]) . '</a>
                <br>
                <img id="miniaturaSF" src="">
                <input type="hidden" name="SFActual" id="SFActual" value ="' . $info_user["sit_fiscal"] . '">
              </div>
              <br>
              <!-- Acta constitutiva PDF -->
              <div class="form-group">
                <label >¿Eres persona física o moral?*</label>
                <br>
                <fieldset required>
                  <input type="radio" class="Tipopersona" name="Tipopersona" value="0"';
                  if ($info_user["tipo_persona"] == 0) echo "checked";
                  echo '>
                  <label for="Física">Física</label><br>
                  <input type="radio" class="Tipopersona" name="Tipopersona" value="1"';
                  if ($info_user["tipo_persona"] == 1) echo "checked";
                  echo '>
                  <label for="Moral">Moral</label><br>
                </fieldset>
                <br>';
                  if ($info_user["tipo_persona"] == 1) {
                    echo '
                <label id="labelAC">Subir Acta Constitutiva en PDF*</label>
                <input type="file"  class="archivo" id="AC" name="AC">
                <a href="' . $info_user["acta_const"] . '" id="linkAC" name="linkAC">' . basename($info_user["acta_const"]) . '</a>
                <br>
                <img id="miniaturaAC" src="">
                <input type="hidden" name="ACActual" id="ACActual" value ="' . $info_user["acta_const"] . '">              
              </div>';
                  } else {
                    echo '
                <label id="labelAC" hidden>Subir Acta Constitutiva en PDF*</label>
                <input type="file" class="archivo" id="AC" name="AC" style="display: none;">
                <a id="linkAC" name="linkAC" hidden></a>
                <br>
                <img id="miniaturaAC" hidden>
                <input type="hidden" name="ACActual" id="ACActual" style="display: none;">              
              </div>';
                  }
                  echo '
              <br>
              <!-- INE o pasaporte PDF -->
              <div class="form-group">
                <label>Subir Identificación Oficial (INE, Pasaporte, etc)*</label>
                <input type="file"  class="archivo" name="IDE">
                <a href="' . $info_user["identificacion"] . '" id="linkIDE" name="linkIDE">' . basename($info_user["identificacion"]) . '</a>
                <br>
                <img id="miniaturaIDE" src="">
                <input type="hidden" name="IDEActual" id="IDEActual" value ="' . $info_user["identificacion"] . '">
              </div>
              <br>
              <!-- Comprobante de dirección fiscal PDF -->
              <div class="form-group">
                <label>Subir Comprobante de Dirección Fiscal en PDF*</label>
                <input type="file"  class="archivo" name="CompDom">
                <a href="' . $info_user["comp_dom"] . '" id="linkCompDom" name="linkCompDom">' . basename($info_user["comp_dom"]) . '</a>
                <br>
                <img id="miniaturaCompDom" src="">
                <input type="hidden" name="CompDomActual" id="CompDomActual" value ="' . $info_user["comp_dom"] . '">
              </div>
              <br>';
                  if ($tipo == "Distribuidor") {
                    $tabla2 = "dists";
                    $info_user =  ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $tabla2);
                    echo '           
                <!-- Historia -->
                <div class="form-group">
                  <label>Historia/Descripción de tu empresa/negocio</label>
                  <textarea class="form-control input-lg" name="Historia" id="Historia" required rows="10">' . $info_user["historia"] . '</textarea>
                </div>
                
                <!-- Propuesta -->
                <div class="form-group">
                  <label>Propuesta de Ventas Mensuales en pesos mexicanos</label>
                  <input type="number" class="form-control" name="Propuesta" id="Propuesta" value="' . $info_user["propuesta"] . '">
                </div>';
                  }
                }
              } ?>
              <!-- ENTRADA PARA FOTO -->
              <div class="form-group">
                <label>Subir Foto</label>
                <input type="file" id="Foto" name="Foto">
                <p class="help-block">Peso máximo de la foto 2MB</p>
                <img src="<?php echo ($info_user["foto"] == '') ? 'vistas/img/usuarios/default/anonymous.png' : $info_user["foto"]; ?>" class="img-thumbnail previsualizar imgclick" style="cursor:pointer;" data-toggle="modal" data-target="#modalFoto" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActual" value="<?php echo $info_user["foto"]; ?>">
                <input type="hidden" name="tabla" id="tabla" value="<?php echo $tabla2; ?>">
                <input type="hidden" name="PasswordActual" id="PasswordActual" value="<?php echo $info_user["contrasena"]; ?>">
              </div>
              <div class="form-group">
                <label>Escribe tu contraseña actual para guardar los cambios</label>
                <input type="password" class="form-control" name="ActualPassword" id="ActualPassword" required>
              </div>
            </div>
          </div>

          <!-- /.card-body -->

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-danger btnElimCuenta" idUsuario="<?php echo $info_user["ID"]; ?>" fotoUsuario="<?php echo $info_user["foto"]; ?>" tabla="<?php echo $tabla2; ?>">Eliminar Cuenta</button>
          </div>
        </form>
        <?php
        $GuardarUsuario = new ControladorUsuarios();
        $GuardarUsuario->ctrGuardarUsuario();
        ?>

      </div>

    </div>

  </section>

</div>

<?php

$eliminarUsuario = new ControladorUsuarios();
$eliminarUsuario->ctrEliminarUsuario()

?>

<?php include "includes/modalFoto.html"; ?>

<script src="vistas/js/info-cuenta.js"></script>