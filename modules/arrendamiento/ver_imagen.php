<script type="text/javascript" src="modules/Inventario_Equipo/mostrar.js"></script>
<?php
require '../../config/conexion.php';
$crud = new CRUD;

if (isset($_GET['id'])) {
    $rfc = $_GET['id']	;
    //echo $rfc; 
    $img = explode("*", $rfc);
   
    ?>

    <form class="form-horizontal" method="POST" action="modules/arrendamiento/proses.php?act=update_img_cliente" enctype="multipart/form-data">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">IMAGEN: </h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">
    
      <?php  if($img[1] !== ""){ ?>
      <img style="width: 100%;" src="modules/arrendamiento/<?php echo $img[0]; ?>/<?php echo $img[1]; ?>">
      <?php }else{
        echo "<h1>Documento no existe</h1>";
        }?>
      <div class="form-group" style="margin-top:50px;">
      <label for="imgm" class="col-sm-4 control-label">Selecciona la imagen<br>a actualizar:</label>
      <div class="col-sm-7">
      <input id="imgm"  name="imgm" type="file">
      </div>
      </div>

      <input type="hidden" name="datos" value="<?php echo $img[0]."*".$img[2]."*".$img[3]; ?>">


          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>

      



      <div class="modal-footer" onmouseenter="camposVacios(1);">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Actualizar Imagen"  >
      </div>

    </form>

    <?php
}