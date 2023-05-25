<script type="text/javascript" src="modules/Mantenimiento_Equipo/mostrar.js"></script>
<?php
require '../../config/conexion.php';
$crud = new CRUD;

if (isset($_GET['id'])) {
    $id = $_GET['id']	;
    $query = $crud->consulta_mantenimiento_E($id);

    $data = mysqli_fetch_assoc($query); ?>

    <form class="form-horizontal" method="POST" action="modules/Mantenimiento_Equipo/proses.php?act=update_mantenimiento">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">MODIFICAR MANTENIMIENTO</h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">

      
                    
      <div class="form-group">
                      <label for="title" class="col-sm-4 control-label">Equipo:</label>
                        <div class="col-sm-7">
                        <SELECT class="form-control" NAME="ne" maxlength="5" > 
                        <?php  
                      $quer = $crud->consultar_inventario_E();
                      while ($dat = mysqli_fetch_assoc($quer)) { ?>
                      <OPTION value="<?php echo $dat['NE'];?>"><?php echo $dat['NE']; echo " _____ ";  echo $dat['Descripcion'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Descripcion: </label>
                        <div class="col-sm-7">
                          <input type="text" value="<?php echo $data['Descripcion'];?>" name="descripcion" class="form-control" placeholder="descripcion" required="required" maxlength="150">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Costo del mantenimiento: </label>
                        <div class="col-sm-7">
                          <input type="text" value="<?php echo $data['Costo_mantenimiento'];?>" name="costomantenimiento"  class="form-control" placeholder="" required="required" maxlength="10">
                        </div>
                      </div>

                      
                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Fecha del mantenimiento: </label>
                        <div class="col-sm-7">
                          <input type="date" name="fechamantenimiento" value="<?php echo $data['Fecha_Servicio'];?>" class="form-control" placeholder="" required="required" maxlength="10">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Proximo Mantenimiento:</label>
                        <div class="col-sm-7">
                          <input type="date" name="fechaprox" class="form-control" value="<?php echo $data['Proximo_Servicio'];?>" required="required" maxlength="10">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Horometro Actual:</label>
                        <div class="col-sm-7">
                          <input type="text" name="horometro" class="form-control" value="<?php echo $data['Horometro'];?>" required="required" maxlength="10">
                        </div>
                      </div>

                      

          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>

      <input type="hidden" name="id" value="<?php echo $data['ID_Mantenimiento']; ?>">



      <div class="modal-footer" onmouseenter="camposVacios(1);">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Actualizar"  style="background: black">
      </div>

    </form>

    <?php
}
