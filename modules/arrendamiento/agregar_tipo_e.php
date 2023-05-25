<script type="text/javascript" src="modules/Inventario_Equipo/mostrar.js"></script>
<?php
require '../../config/conexion.php';
$crud = new CRUD;
 ?>

    <form class="form-horizontal" method="POST" action="modules/Inventario_Equipo/proses.php?act=agregar_tipo">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">AGREGAR TIPO DE EQUIPO</h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">

      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Tipo de equipo: </label>
                        <div class="col-sm-7">
                          <input type="text" name="descripcion" class="form-control" placeholder="Descripcion"  required="required" maxlength="10">
                        </div>
                      </div>


          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>



      <div class="modal-footer" onmouseenter="camposVacios(1);">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Actualizar"  style="background: black">
      </div>

    </form>

    <?php
