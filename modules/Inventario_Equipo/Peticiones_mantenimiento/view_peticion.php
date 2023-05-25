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
        <h4 class="modal-title">PETICIONES</h4>
      </div>

      <div class="modal-body" onchange="camposVacios(1);" onclick="inicioEvent(1);" oninput="ocultarPrefijo(1);">
       <?php /* <div  class="btnR" style="padding-top: 6px;  position: absolute;"><!--Boton para agregar-->
                <button type="button"  id="button" class='btn btn-success pull-right' data-dismiss="modal"  title='Agregar Plan'  onclick="openModal(this, 'agregar_plan', 'P3')" data-toggle='tooltip' style="width: 25px; height: 20px; padding: 0;">
                  <i class='fa fa-plus'></i>
                </button>
              </div>  */ ?>
      <div class="">
        

      
            <table id="pruebas" class="table table-bordered table-striped table-hover table-condensed" width="100%">
              <thead align="center">
                <tr class="bg-teal-primary">
                  <th class="text-center" width="5%">Id Peticion</th>
                  <th class="text-center" width="10%">Numero Economico</th>
                  <th class="text-center" width="15%">Estatus Del Equipo</th>
                  <th class="text-center" width="10%"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $fecha = date('Y-m-d');
                $query = $crud->consulta_peticiones_mantenimiento();
                while ($data = mysqli_fetch_assoc($query)) {
              ?>
                      <tr>
                          <td align='center' width="5%"><?php echo $data['id_peticion']; ?></td>
                          <td align='center' width="10%"><?php echo $data['NE']; ?></td>                                  <!--EDITADO-->
                          <td align='center' width="15%"><?php echo $data['DESCRIPCION'];?></td>
                          <td align="center" width="10%">
                  
                              <div><?php
                            /* ?>
                            
                            <button name="view" value="view" id="<?php echo $data[0]; ?>" class='btn btn-primary btn-sm' type="button"  data-dismiss="modal" title='Modificar' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'modificar_plan', 'P4')">
                            <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                            </button><?php //update_cliente
                             
                      
                        */ ?>
                                                   
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

  