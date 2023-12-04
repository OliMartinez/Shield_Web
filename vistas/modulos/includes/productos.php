     <input type="hidden" name="tipoguardar" id="tipoguardar" value="crear">
     <input type="hidden" name="ID" id="ID" value="">

     <!-- ENTRADA PARA EL NOMBRE -->
     <div class="form-group">
       <label for="Nombre">Nombre:</label>
       <div class="input-group">
         <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
         <input type="text" class="form-control input-lg" id="Nombre" name="Nombre" required>
       </div>
     </div>
     <!-- ENTRADA PARA SELECCIONAR CATEGORÍAS -->
     <div class="form-group">
       <label for="Categoria">Categorías:</label>
       <div class="input-group">
         <fieldset required>
           <?php
            $item = null;
            $valor = null;
            $tabla = "categorias";
            $item1 = "ID";
            $Categorias = ControladorGeneral::ctrMostrarItems($item, $valor, $tabla, $item1);

            foreach ($Categorias as $key => $value) {
              echo '<label class="checkbox-inline">
              <input type="checkbox" class="categoria" name="Categoria[]" value="' . $value["ID"] . '"> ' . $value["ID"].
              '</label><br>';
            }
            ?>
         </fieldset>
       </div>
     </div>
     <!-- ENTRADA PARA SELECCIONAR COLECCIÓN -->
     <div class="form-group">
       <label for="Coleccion">Colección:</label>
       <div class="input-group">
         <span class="input-group-addon"><i class="fa fa-th"></i></span>
         <select class="form-control input-lg" name="Coleccion" required>
           <option id="Coleccion"></option>
           <?php
            $item = null;
            $valor = null;
            $tabla = "colecciones";
            $item1 = "ID";
            $colecciones = ControladorGeneral::ctrMostrarItems($item, $valor, $tabla, $item1);

            foreach ($colecciones as $key => $value) {

              echo '<option value="' . $value["ID"] . '" >' . $value["ID"] . '</option>';
            }
            ?>

         </select>
       </div>
     </div>
     <!-- ENTRADA PARA LA DESCRIPCIÓN -->
     <div class="form-group">
       <label for="Descripcion">Descripción:</label>
       <div class="input-group">
         <span class="input-group-addon"><i class="fa fa-bars"></i></span>
         <textarea class="form-control input-lg" id="Descripcion" name="Descripcion" rows="10" required></textarea>
       </div>
     </div>
     <!-- ENTRADA PARA LAS CARECTERISTICAS -->
     <div class="form-group">
       <label for="Caracteristicas">Características:</label>
       <div class="input-group">
         <span class="input-group-addon"><i class="fa fa-list"></i></span>
         <textarea class="form-control input-lg" class="form-control input-lg" id="Caracteristicas" name="Caracteristicas" rows="10" required></textarea>
       </div>
     </div>