<script type="text/javascript" src="modules/Renta/mostrar.js"></script>
<?php
require '../../config/conexion.php';
$crud = new CRUD;

if (isset($_GET['idf'])) {
   //$idf = $_GET['idf'];
    $variables = explode("*",$_GET['idf']);
    if(count($variables) <= 1){
    ?>

  
    <form class="form-horizontal" method="POST" action="modules/Renta/proses.php?act=update_renta">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">DETALLES DE FOLIO</h4>
      </div>

      <div id="bodym" class="box-body" onclick="inicioEvent(0);" oninput="ocultarPrefijo(0);">
    
      <div class="form-group" >
      <label for="title" class="col-sm-4 control-label">Salidas:</label>
      <div class="col-sm-7"  >
      <SELECT class="form-control" id="rentas"  NAME="rentas" maxlength="5" onchange="bodym();"> 
      <?php  
      $quer = $crud->consulta_salidas_de_un_folio($variables[0]);
       $i=0;
      while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona una salida</option><?php $i++; } ?>
      <OPTION value="<?php echo $dat['ID_Renta']."*".$dat['NE']."*".$dat['Folio']; ?>" <?php if($data['NE']==$dat['NE']){ ?> selected <?php } ?> ><?php echo $dat['ID_Renta'];?>&nbsp;&nbsp;&nbsp;<?php $cons = $crud->consultar_Cliente_A($dat['ID_clientes']); $cliente = mysqli_fetch_assoc($cons); echo $cliente['Razon_Social']; ?></OPTION>
      <?php } //terminacion while?> 
      </SELECT>    
      </div>
      </div>
      
     
   
    

<div>


<br>


  <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
 

</div>

</div>
     
      <div id="botones" class="modal-footer" onmouseenter="camposVacios(1);">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Actualizar"  >
          
      </div>

    </form>

    <?php
    }else if (count($variables) > 1 ){
      ?>

  
      <form class="form-horizontal"  method="POST" action="modules/Renta/proses.php?act=update_renta">
  
        <div class="modal-header" onmouseenter="bodym();">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">AGREGA ENTRADA</h4>
        </div>
  
        <div id="bodym" class="box-body" onclick="inicioEvent(0);" oninput="ocultarPrefijo(0);">
      
        <div class="form-group" >
        <label for="title" class="col-sm-4 control-label">Salidas:</label>
        <div class="col-sm-7"  >
        <SELECT class="form-control" id="rentas"  NAME="rentas" maxlength="5" onchange="bodym();"> 
        <?php  
        echo $variables[1];
        $quer = $crud->consulta_salidas_de_un_folio($variables[2]);
         $i=0;
        while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona una salida</option><?php $i++; } ?>
        <OPTION value="<?php echo $dat['ID_Renta']."*".$dat['NE']."*".$dat['Folio']; ?>" <?php if($variables[0]==$dat['ID_Renta']){ ?> selected <?php } ?> ><?php echo $dat['ID_Renta'];?>&nbsp;&nbsp;&nbsp;<?php echo $dat['Razon_Social']; ?></OPTION>
        <?php } //terminacion while?> 
        </SELECT>    
        </div>
        </div>
        
       
     
      
  
  <div>
  
  
  <br>
  
  
    <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
   
  
  </div>
  
  </div>
       
        <div id="botones" class="modal-footer" onmouseenter="bodym();" onmouseenter="camposVacios(1);">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Actualizar"  >
            
        </div>
  
      </form>
  
      <?php
    } 
}
