<?php
require '../../config/conexion.php';
$crud = new CRUD;

if (isset($_GET['id'])) {
    $id = $_GET['id']	;
    $query = $crud->consulta_rentas_E($id);

    $data = mysqli_fetch_assoc($query); ?>

    <form class="form-horizontal" method="POST" action="#">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Salida del equipo</h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">

      
        <div>
        <input type="checkbox" id="aceite" name="aceite" <?php  if($data['Nivel_de_aceite']==1){?> checked<?php } ?> onclick="return false;"/>
        <label for="scales">Nivel de aceite</label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="refrigerante" name="refrigerante" <?php  if($data['Nivel_de_refrigerante']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Nivel de refrigerante</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="llavea" name="llavea" <?php  if($data['Llave_de_arranque']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Llave de arranque</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="radiador" name="radiador" <?php  if($data['Tapon_de_radiador']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Tapon de radiador</label>
        </div>
       <div>
       <input type="checkbox" id="combustible" name="combustible" <?php  if($data['Tapon_combustible']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Tapon combustible</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="selectores" name="selectores" <?php  if($data['Selectores']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Selectores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="interruptores" name="interruptores" <?php  if($data['Interruptores']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Interruptores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="contactos" name="contactos" <?php  if($data['Contactos']==1){?> checked<?php } ?>  onclick="return false;"/>
       <label for="horns">contactos</label>
       </div>
       <div>
       <input type="checkbox" id="focos" name="focos"  <?php  if($data['Focos_micas']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Focos y micas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="mastil" name="mastil" <?php  if($data['Cable_mastil']==1){?> checked<?php } ?>   onclick="return false;"/>
       <label for="horns">Cable mastil</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="llantas" name="llantas"  <?php  if($data['Llantas']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Llantas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="remolque" name="remolque"  <?php  if($data['Estructura_remolque']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Estructura remolque</label>
       </div>
       <div>
       <input type="checkbox" id="patin" name="patin" <?php  if($data['Gato_patin']==1){?> checked<?php } ?>  onclick="return false;"/>
       <label for="horns">Gato patin</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="tiron" name="tiron" <?php  if($data['Tiron']==1){?> checked<?php } ?>  onclick="return false;"/>
       <label for="horns">Tiron</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="cadenas" name="cadenas"  <?php  if($data['Cadenas_de_seguridad']==1){?> checked<?php } ?>  onclick="return false;"/>
       <label for="horns">Cadenas de seguridad</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="matachispas" name="matachispas"  <?php  if($data['Matachispas']==1){?> checked<?php } ?> onclick="return false;"/>
       <label for="horns">Matachispas</label>
       </div>
       <div>
       <input type="checkbox" id="acesoriosad" name="acesoriosad"    onclick="return false;"/>
       <label for="horns">Accesorios adicionales</label>
       </div>

       <br>

       <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Marca de bateria:</label>
        <div class="col-sm-7">
        <input type="text"  name="marcabateria" class="form-control" value="<?php echo $data['Marca_de_bateria']; ?>" required="required" maxlength="5" readonly="readonly" />
        </div>
        </div>

        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Condiciones fisicas:</label>
        <div class="col-sm-7">
        <input type="text" name="condiciones" class="form-control" value="<?php echo $data['Condiciones_fisicas']?>" required="required" maxlength="5" readonly="readonly" />
        </div>
        </div>
      
        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Tuercas, Mariposas:</label>
        <div class="col-sm-7">
        <input type="text" name="tuercas" class="form-control" value="<?php echo $data['Tuercas_mariposas']?>" required="required" maxlength="5" readonly="readonly" />
        </div>
        </div>

        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Accesorios adicionales:</label>
        <div class="col-sm-7">
        <input type="text" name="tuercas" class="form-control" value="<?php echo $data['Accesorios_adicionales']?>" required="required" maxlength="5" readonly="readonly" />
        </div>
        </div>


          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>

      <input type="hidden" name="id" value="<?php echo $data['ID_Renta']; ?>">



      <div class="modal-footer" onmouseenter="camposVacios(1);">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </form>

    <?php
}
