<script type="text/javascript" src="modules/Inventario_Equipo/mostrar.js"></script>
<?php
require '../../../config/conexion.php';
$crud = new CRUD;

    ?>

    <form class="form-horizontal" method="POST" action="modules/Inventario_Equipo/proses.php?act=agregar_plan">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">AGREGAR PLAN</h4>
      </div>

      <div class="modal-body">

      
<div class="form-group">
<label for="title" class="col-sm-4 control-label">Tipo De Equipo: </label>
  <div class="col-sm-7">
  <SELECT id='tipoe' class="form-control" NAME="tipoe" maxlength="5"  required> 
  <?php  
$query = $crud->consultar_Tipos_E();
while ($data = mysqli_fetch_assoc($query)) { if($i==0){ ?> <option value="0">Selecciona un equipo</option><?php $i++; } ?>
<OPTION value="<?php echo $data['ID_Tipo'];?>"><?php echo $data['Descripcion'];?></OPTION>
<?php } //terminacion while?> 
</SELECT>    
</div>

</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Descripcion del plan: </label>
<div class="col-sm-7">
<SELECT id='desc' class="form-control" NAME="descripcion" maxlength="5"  required> 
<OPTION value="01 DIA O 08 HORAS">01 DIA O 08 HORAS</OPTION>
<OPTION value="07 DIAS O 60 HORAS">07 DIAS O 60 HORAS</OPTION>
<OPTION value="15 DIAS O 120 HORAS">15 DIAS O 120 HORAS</OPTION>
<OPTION value="30 DIAS O 240 HORAS">30 DIAS O 240 HORAS</OPTION>
</SELECT>    
</div>
</div>          

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Costo: </label>
<div class="col-sm-7">
<input type="number" id="costo" name="costo" class="form-control" placeholder="Cual es el costo de por cantidad c/u, Ej. 1 dia: $500 " required="required" maxlength="25">                </div>
</div>   

          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>

      <input type="hidden" name="id" value="<?php echo $data['ID_clientes']; ?>">



      <div class="modal-footer" onmouseenter="vacios_plan();">
          <button type="button" class="btn btn-secondary" id="button" data-dismiss="modal">Cerrar</button>
          <button id="btnG" type="submit" class="btn btn-primary" name="Guardar">Guardar</button>
      </div>

    </form>

    <?php
