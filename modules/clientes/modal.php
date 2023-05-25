<script type="text/javascript" src="modules/clientes/mostrar.js"></script>
<?php
require '../../config/conexion.php';
$crud = new CRUD;

if (isset($_GET['id'])) {
    $id = $_GET['id']	;
    $query = $crud->consultar_cliente($id);

    $data = mysqli_fetch_assoc($query); ?>

    <form class="form-horizontal" method="POST" action="modules/clientes/proses.php?act=update_cliente">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">MODIFICAR CLIENTE</h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Razón Social: </label>
            <div class="col-sm-7">
              <input type="text" id="razonsocialMD" name="razonsocialMD" class="form-control"  placeholder="Razón Social" value="<?php echo $data['razonsocial']; ?>" required="required"  maxlength="50"><!-- autofocus="autofocus" -->
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Nombre corto: </label>
            <div class="col-sm-7">
              <input type="text" id="nombreMD" name="nombreMD" class="form-control" placeholder="Nombre" value="<?php echo $data['nombre']; ?>" required="required" maxlength="50">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Nombre de Prefijo: </label>
            <div class="col-sm-7">
              <input type="text" id="prefijoMD" name="prefijoMD" class="form-control" placeholder="Prefijo no máximo a 3 letras, para las Hojas de Trabajo" value="<?php echo $data['prefijo']; ?>" required="required" maxlength="3" oninput="ExistePrefijo(1);" autocomplete="off">

              <div id="container_tags1" class="col-xs-12 ui-widget">
                <ul id="tag1" class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" tabindex="-1" style="width: 100%; top: 0.216675px; left: -0.25px; display: none; position: absolute; background: currentColor;">
                </ul>
              </div>
              <div id="loading1" class="col-xs-12 ui-widget"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Dirección: </label>
            <div class="col-sm-7">
              <input type="text" name="direccionMD" class="form-control" placeholder="Dirección" value="<?php echo $data['direccion']; ?>" maxlength="150">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Ciudad: </label>
            <div class="col-sm-7">
              <input type="text" id="ciudadMD" name="ciudadMD" class="form-control" placeholder="Ciudad" value="<?php echo $data['ciudad']; ?>" required="required" maxlength="50">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Estado: </label>
            <div class="col-sm-7">
              <input type="text" id="estadoMD" name="estadoMD" class="form-control" placeholder="Estado" value="<?php echo $data['estado']; ?>" required="required" maxlength="80">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Teléfono: </label>
            <div class="col-sm-7">
              <input type="text" name="telefonoMD" class="form-control" placeholder="Ej. 000-00-00" value="<?php echo $data['telefono']; ?>" maxlength="10" pattern="^[0-9]{3}(-[0-9]{2})(-[0-9]{2})?$">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Ext.: </label>
            <div class="col-sm-7">
              <input type="number" name="extMD" class="form-control" placeholder="Extención" value="<?php echo $data['ext']; ?>" maxlength="5">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Contacto en Oficina: </label>
            <div class="col-sm-7">
              <input type="text" name="contactoOficinaMD" class="form-control" placeholder="Nombre Completo del Contacto" value="<?php echo $data['contactoOficina']; ?>" maxlength="50">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">En Sitio: </label>
            <div class="col-sm-7">
              <input type="text" name="enSitioMD" class="form-control" placeholder="" value="<?php echo $data['enSitio']; ?>" maxlength="50">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Email: </label>
            <div class="col-sm-7">
              <input type="email" name="emailMD" class="form-control" placeholder="Ej. email@vormak.com" value="<?php echo $data['email']; ?>" maxlength="50">
            </div>
          </div>

          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Email 2: </label>
            <div class="col-sm-7">
              <input type="email" name="email2MD" class="form-control" placeholder="Ej. email@vormak.com" value="<?php echo $data['email2']; ?>" maxlength="50">
            </div>
          </div>

          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>

      <input type="hidden" name="id" value="<?php echo $data['id_cliente']; ?>">



      <div class="modal-footer" onmouseenter="camposVacios(1);">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Actualizar"  onclick="return alertActualizar()" disabled style="background: black">
      </div>

    </form>

    <?php
}
