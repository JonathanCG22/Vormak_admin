<script type="text/javascript" src="modules/arrendamiento/mostrar.js"></script>
<?php
require '../../config/conexion.php';
$crud = new CRUD;

if (isset($_GET['id'])) {
    $id = $_GET['id']	;
    $query = $crud->consultar_cliente_A($id);

    $data = mysqli_fetch_assoc($query); ?>

    <form class="form-horizontal" method="POST" action="modules/arrendamiento/proses.php?act=update_cliente">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">MODIFICAR CLIENTE</h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">

      <div class="form-group">
            <label for="title" class="col-sm-4 control-label">RFC: </label>
            <div class="col-sm-7">
              <input type="text" id="RFCMD" name="RFCMD" class="form-control"  placeholder="Razón Social" value="<?php echo $data['RFC']; ?>" required="required"  maxlength="50"><!-- autofocus="autofocus" -->
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Razón Social <br>y/o nombre: </label>
            <div class="col-sm-7">
              <input type="text" id="razonsocialMD" name="razonsocialMD" class="form-control"  placeholder="Razón Social" value="<?php echo $data['Razon_Social']; ?>" required="required"  maxlength="50"><!-- autofocus="autofocus" -->
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Regimen: </label>
            <div class="col-sm-7">
              <input type="text" id="regimenMD" name="regimenMD" class="form-control" placeholder="Regimen" value="<?php echo $data['Regimen']; ?>" required="required" maxlength="50">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">CFDI: </label>
            <div class="col-sm-7">
              <input type="text" id="cfdiMD" name="cfdiMD" class="form-control" placeholder="Nombre" value="<?php echo $data['CFDI']; ?>" required="required" maxlength="50">
            </div>
          </div>


          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Dirección: </label>
            <div class="col-sm-7">
              <input type="text" name="direccionMD" class="form-control" placeholder="Dirección" value="<?php echo $data['Direccion']; ?>" maxlength="150" required="required">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Teléfono: </label>
            <div class="col-sm-7">
              <input type="text" name="telefonoMD" class="form-control" placeholder="Ej. 000-00-00" value="<?php echo $data['Celular']; ?>" maxlength="10" pattern="^[0-9]{3}(-[0-9]{2})(-[0-9]{2})?$" required="required">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Email: </label>
            <div class="col-sm-7">
              <input type="email" name="emailMD" class="form-control" placeholder="Ej. email@vormak.com" value="<?php echo $data['Email']; ?>" maxlength="50" required="required">
            </div>
          </div>

          <div class="form-group">
          <div class="col-sm-7" style="text-align:right">
          <button name="view" data-dismiss="modal" value="view" id="<?php echo "img_Acta_constitutiva*".$data['Acta_constitutiva']."*Acta_constitutiva*".$data['RFC']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Acta Constitutiva' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'modificar_equipo', 'N2')">
          <i class="fas fa-file-alt"></i></button>
          <button name="view" data-dismiss="modal" value="view" id="<?php echo "img_Poder_notarial*".$data['Poder_notarial']."*Poder_notarial*".$data['RFC']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Poder Notarial' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'modificar_equipo', 'N2')">
          <i class="fas fa-passport"></i></button>
          <button name="view" data-dismiss="modal" value="view" id="<?php echo "img_Comprobante_de_domicilio*".$data['Comprobante_de_domicilio']."*Comprobante_de_domicilio*".$data['RFC']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Comprobante de domicilio' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'modificar_equipo', 'N2')">
          <i class="fas fa-file-image"></i></i></button>
          <button name="view" data-dismiss="modal" value="view" id="<?php echo "img_Representante_legal*".$data['IFE_del_Representante_legal']."*IFE_del_Representante_legal*".$data['RFC']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='IFE del representante' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'modificar_equipo', 'N2')">
          <i class="fas fa-id-card"></i></i></button>
          <button name="view" data-dismiss="modal" value="view" id="<?php echo "img_Estado_de_cuenta*".$data['Ultimo_estado_de_cuenta']."*Ultimo_estado_de_cuenta*".$data['RFC']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Ultimo estado de cuenta' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'modificar_equipo', 'N2')">
          <i class="fas fa-file-invoice-dollar"></i></button>
          </div>  
          </div>

          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>

      <input type="hidden" name="id" value="<?php echo $id; ?>">



      <div class="modal-footer" onmouseenter="camposVacios(1);">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Actualizar"  style="background: black">
      </div>

    </form>


    <?php
}
