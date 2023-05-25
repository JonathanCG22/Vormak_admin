<script type="text/javascript" src="modules/Inventario_Equipo/mostrar.js"></script>
<?php
require '../../../config/conexion.php';
$crud = new CRUD;

    //$ne = $_GET['id']	;
    $query = $crud->consulta_planes();

    $data = mysqli_fetch_assoc($query); ?>

    <form class="form-horizontal" method="POST" action="#">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">PLANES DE RENTA</h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">
      <div  class="btnR" style="padding-top: 6px;  position: absolute;"><!--Boton para agregar-->
                <button type="button"  id="button" class='btn btn-success pull-right' data-dismiss="modal"  title='Agregar Plan'  onclick="openModal(this, 'agregar_plan', 'P3')" data-toggle='tooltip' style="width: 25px; height: 20px; padding: 0;">
                  <i class='fa fa-plus'></i>
                </button>
              </div>
      <div class="">
        

      
            <table id="pruebas" class="table table-bordered table-striped table-hover table-condensed" width="100%">
              <thead align="center">
                <tr class="bg-teal-primary">
                  <th class="text-center" width="5%">Tipo de equipo</th>
                  <th class="text-center" width="10%">Tiempo del plan</th>
                  <th class="text-center" width="15%">Costo</th>
                  <th class="text-center" width="10%"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $fecha = date('Y-m-d');
                $query = $crud->consulta_planes();
                while ($data = mysqli_fetch_row($query)) {
              ?>
                      <tr>
                          <td align='center' width="5%"><?php echo $data[1]; ?></td>
                          <td align='center' width="10%"><?php echo $data[2]; ?></td>                                  <!--EDITADO-->
                          <td align='center' width="15%"><?php echo $data[3];?></td>
                          <td align="center" width="10%">
                            <?php
                           ?>
                              <div><?php
                            ?>
                            
                            <button name="view" value="view" id="<?php echo $data[0]; ?>" class='btn btn-primary btn-sm' type="button"  data-dismiss="modal" title='Modificar' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'modificar_plan', 'P4')">
                                    <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                  </button><?php //update_cliente
                             
                      
                        ?>
                                                   
                          		</div><?php
                            ?>
                          </td>
                      </tr>
                  
                  <?php
                }//fin del While
                ?>
              </tbody>
            </table>
          </div>


          <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>
      </div>

      <input type="hidden" name="id" value="<?php echo $data['ID_clientes']; ?>">



      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </form>

    <?php
/*
<div class="form-group">
<label for="title" class="col-sm-4 control-label">Tipo De Equipo </label>
  <div class="col-sm-7">
  <SELECT class="form-control" NAME="combo1" maxlength="5"  required> 
  <?php  
$query = $crud->consultar_Tipos_E();
while ($data = mysqli_fetch_assoc($query)) { ?>
<OPTION value="<?php echo $data['ID_Tipo'];?>"><?php echo $data['Descripcion'];?></OPTION>
<?php } //terminacion while?> 
</SELECT>    
</div>

</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Descripcion: </label>
<div class="col-sm-7">
<input type="text" name="descripcion" class="form-control" placeholder="descripcion" required="required" maxlength="25">                </div>
</div>            

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Costo: </label>
<div class="col-sm-7">
<input type="number" name="descripcion" class="form-control" placeholder="Cual es el costo de por cantidad c/u, Ej. 1 dia: $500 " required="required" maxlength="25">                </div>
</div>   */