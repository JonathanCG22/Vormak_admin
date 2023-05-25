<?php
  $r = mysqli_fetch_assoc($crud->Permiso_Acceso_Mayor());
  $max = $r['mayor'];  
?>

<script type="text/javascript" src="modules/Renta/mostrar.js?v=10.5"></script>
<section class="content-header">
  <h1>
    <i class="far fa-user icon-title" prefix="far"></i> <span id="titulo">Rentas de Equipos</span>
    <?php
    if ($_SESSION['permisos_acceso'] <= $max && $_SESSION['permisos_acceso'] != 0) { 
      $objeto->id_Acceso = $_SESSION['permisos_acceso'];
      $objeto->id_Modulo = 'Inventario_Equipo'; 
      $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
      $accion = explode(",", $r['accion']);

      $val = 0;
      foreach ($accion as $key => $value) {
        if ($value == 'Agregar') {
           $val++; 
        }            
      }

      if ($val > 0) { ?>
        <a class="btn btn-primary btn-social pull-right"   data-toggle="tooltip" title="Agregar Renta"  onclick="openModal(null, 'agregar_salida', 'R3')">
          <i class="fa fa-plus" style="padding: 6px; height: unset;"></i> Agregar Renta
        </a>
        
         <?php
      }
    }?>
  </h1>

</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

      <?php
      if (empty($_GET['alert'])) {
          echo "";
      } elseif ($_GET['alert'] == 1) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Se agrego con exito la nueva transaccion.
              </div>";
      } elseif ($_GET['alert'] == 2) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Datos del equipo modificados correcamente.
              </div>";
      } elseif ($_GET['alert'] == 3) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
              Se eliminaron los datos del cliente
              </div>";
      } elseif ($_GET['alert'] == 4) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Nuevos datos han sido almacenado correctamente.
              </div>";
      } elseif ($_GET['alert'] == 5) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Los Datos han sido modificados correcamente.
              </div>";

      }elseif ($_GET['alert'] == 6) {
          echo "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Advertencia!</h4>
               Ocurrio un error, comuniquese con el administrador del sistema.
              </div>";

      } elseif ($_GET['alert'] == 7) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
            El equipo ha sido activado correctamente.
            </div>";
    } elseif ($_GET['alert'] == 8) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
             Se cancelo con exito las el folio y transaciones  :) 
            </div>";
    }elseif ($_GET['alert'] == 9) {
      echo "<div class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
           Se agrego con exito el nuevo tipo de equipo.
          </div>";
  }
      ?>

      <div class="box box-teal-primario">
        <div class="box-body">

  		   <div class="">
            <table id="pruebas" class="table table-bordered table-striped table-hover table-condensed" width="100%">
              <thead align="center">
                <tr class="bg-teal-primary">
                <th class="text-center" width="5%">FOLIO</th>
                  <th class="text-center" width="5%">CLIENTE</th>
                  <th class="text-center" width="5%">TOTAL DE SALIDAS</th>
                  <th class="text-center" width="5%">TOTAL MONETARIO</th>
                  <th class="text-center" width="5%">FECHA ESTIMADA DE SALIDA</th>
                  <th class="text-center" width="5%"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $fecha = date('Y-m-d');
                $query = $crud->consultar_folios();
                while ($data = mysqli_fetch_assoc($query)) {
                  $query2 = $crud->consulta_detalles($data['Folio']);
                  $data2 = mysqli_fetch_row($query2);
              ?>
                      <tr>
                          <td align='center' width="5%"><?php echo $data['Folio']; ?></td>
                          <td align='center' width="5%"><?php echo $data['Razon_Social']; ?></td>                                  <!--EDITADO-->
                          <td align='center' width="5%"><?php echo $data['Cuantos_equipos'];?></td>
                          <td align='center' width="5%">$<?php echo $data2[1]; ?></td>   
                          <td align='center' width="5%"><?php echo $data2[0]; ?></td>   
                          <td align="center" width="5%">
                            <?php
                            if ($_SESSION['permisos_acceso'] <= $max && $_SESSION['permisos_acceso'] != 0) { ?>
                              <div><?php
                                $valM = 0; $valV = 0;
                                foreach ($accion as $key => $value) {
                                  if ($value == 'Modificar') {
                                     $valM++; 
                                  }  
                                  if ($value == 'Ver') {
                                     $valV++; 
                                  }           
                                }

                                if ($valM > 0) { ?>
                                  <button name="view" value="view" id="<?php echo $data['Folio']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Detalles' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'agregar_salida2', 'R1')">
                                    <i style='color:#fff' class='fas fa-info'></i>
                                  </button><?php //detalles de folio?>
                                

                                 <?php 
                                }
                                ?>
                                                   
                          		</div><?php
                            }?>
                          </td>
                      </tr>
                  
                  <?php
              }//fin del While
                ?>
              </tbody>
            </table>
          </div>

          <!-- Modal -->
          <!-- Modal update -->
          <div class="modal fade" id="modal_agregar_salida" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg" style="width:87%;">
                  <div class="modal-content" id="modal-agregar_salida"><!-- modal-contenido -->

                  </div>
                </div>
          </div>

        <!-- Modal detalles -->
          <div class="modal fade" id="modal_agregar_salida2" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-agregar_salida2"><!-- modal-contenido -->

                  </div>
                </div>
          </div>
       <!-- /.Modal detalles -->


          
          <!-- Modal addSalida --><!-- /.Modal addSalida -->

        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->