<script type="text/javascript" src="modules/Inventario_Equipo/mostrar.js"></script>
<?php
require '../../config/conexion.php';
$crud = new CRUD;

if (isset($_GET['id'])) {
    $ne = $_GET['id']	;
    $query = $crud->consulta_inventario_E($ne);

    $data = mysqli_fetch_assoc($query); ?>

    <form class="form-horizontal" method="POST" action="modules/Inventario_Equipo/proses.php?act=update_cliente">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">MODIFICAR EQUIPO</h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">

      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">NE: </label>
                        <div class="col-sm-7">
                          <input type="text" id="ne" name="ne" class="form-control" placeholder="NE"  value="<?php echo $data['NE']; ?>" required="required" maxlength="50">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Modelo: </label>
                        <div class="col-sm-7">
                          <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo" value="<?php echo $data['Modelo']; ?>" required="required" maxlength="50">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Descripcion: </label>
                        <div class="col-sm-7">
                          <input type="text" name="descripcion" class="form-control" placeholder="descripcion" value="<?php echo $data['Descripcion']; ?>" required="required" maxlength="150">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">N/S: </label>
                        <div class="col-sm-7">
                          <input type="text" name="ns" class="form-control" placeholder="NS" value="<?php echo $data['NS']; ?>" required="required" maxlength="10">
                        </div>
                      </div>

                      
                      <div class="form-group">
                      <label for="title" class="col-sm-4 control-label">Tipo De Equipo </label>
                        <div class="col-sm-7">
                        <SELECT class="form-control" NAME="combo1" maxlength="5" > 
                        <?php  
                      $quer = $crud->consultar_Tipo_E($data['ID_Tipo']);
                      while ($dat = mysqli_fetch_assoc($quer)) { ?>
                      <OPTION value="<?php echo $dat['ID_Tipo'];?>"  <?php if($data['ID_Tipo']==$dat['ID_Tipo']){ ?> selected <?php } ?>   ><?php echo $dat['Descripcion'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      </div>

                      <div class="form-group" >
                      <label for="title" class="col-sm-4 control-label">Estatus:  </label>
                      <div class="col-sm-7" id="listac_1" style=" width:auto;">
                      <SELECT class="form-control" NAME="combo3" maxlength="5" >
                      <?php  
                     $quer = $crud->consultar_estatus();
                      $i=0;
                      while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona Estatus</option><?php $i++; } ?>
                      <OPTION value="<?php echo $dat['ID_Estatus']; ?>"  <?php if($data['Estatus']==$dat['ID_Estatus']){ ?> selected <?php } ?> ><?php echo $dat['DESCRIPCION'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      </div>


                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Fecha de aquisicion: </label>
                        <div class="col-sm-7">
                          <input type="date" name="fechaad" class="form-control" placeholder="Fecha Adquisicion" value="<?php echo $data['Fecha_Adquisicion']; ?>" required" maxlength="10">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Costo del equipo:</label>
                        <div class="col-sm-7">
                          <input type="text" name="costo" class="form-control" placeholder="Costo del equipo" value="<?php echo $data['Costo']; ?>" required="required" maxlength="10">
                        </div>


          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>

      <input type="hidden" name="id" value="<?php echo $data['NE']; ?>">



      <div class="modal-footer" onmouseenter="camposVacios(1);">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Actualizar"  style="background: black">
      </div>

    </form>

    <?php
}
