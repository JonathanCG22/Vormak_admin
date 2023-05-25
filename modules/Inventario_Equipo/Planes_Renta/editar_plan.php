<script type="text/javascript" src="modules/Inventario_Equipo/mostrar.js"></script>
<?php
require '../../../config/conexion.php';
$crud = new CRUD;
if (isset($_GET['id'])) {
    $idp = $_GET['id']	;
    $query = $crud->consulta_plan($idp);

    $data1 = mysqli_fetch_assoc($query);
    ?>

    <form class="form-horizontal" method="POST" action="modules/Inventario_Equipo/proses.php?act=update_plan">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">EDITAR PLAN</h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">

      
<div class="form-group">
<label for="title" class="col-sm-4 control-label">Tipo De Equipo </label>
  <div class="col-sm-7">
  <SELECT  id='tipoem' class="form-control" NAME="combo1" maxlength="5"  required> 
  <?php  
$query = $crud->consultar_Tipos_E();
while ($data = mysqli_fetch_assoc($query)) { ?>
<OPTION value="<?php echo $data['ID_Tipo'];?>"  <?php if($data1['ID_Tipo']==$data['ID_Tipo']){ ?> selected <?php } ?> ><?php echo $data['Descripcion'];?></OPTION>
<?php } //terminacion while?> 
</SELECT>    
</div>

</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Descripcion del plan: </label>
<div class="col-sm-7">
<SELECT id='descm' class="form-control" NAME="descripcion" maxlength="5"  required> 
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
<input id="costom" type="number" name="descripcion" value="<?php echo $data1['Costo'];?>" class="form-control" placeholder="Cual es el costo de por cantidad c/u, Ej. 1 dia: $500 " required="required" maxlength="25">                </div>
</div>   

          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>

      <input type="hidden" name="id" value="<?php echo $data['ID_clientes']; ?>">



      <div class="modal-footer" onmouseenter="vacios_plan();">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button id="btnG" type="submit" class="btn btn-primary" name="update">Actualizar</button>
      </div>

    </form>

    <?php
}