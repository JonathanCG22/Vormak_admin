<?php
  $r = mysqli_fetch_assoc($crud->Permiso_Acceso_Mayor());
  $max = $r['mayor'];  
?>

<script type="text/javascript" src="modules/arrendamiento/mostrar.js?v=10.5"></script>
<section class="content-header">
  <h1>
    <i class="far fa-user icon-title" prefix="far"></i> <span id="titulo">Mantenimientos</span>
    <?php
    if ($_SESSION['permisos_acceso'] <= $max && $_SESSION['permisos_acceso'] != 0) { 
      $objeto->id_Acceso = $_SESSION['permisos_acceso'];
      $objeto->id_Modulo = 'Mantenimiento_Equipo'; 
      $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
      $accion = explode(",", $r['accion']);

      $val = 0;
      foreach ($accion as $key => $value) {
        if ($value == 'Agregar') {
           $val++; 
        }            
      }

      if ($val > 0) { ?>
        <a class="btn btn-primary btn-social pull-right"   data-toggle="modal" data-target="#ModalAdd" title="Agregar Mantenimiento">
          <i class="fa fa-plus" style="padding: 6px; height: unset;"></i> Agregar Mantenimiento
        </a><?php
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
               Se agrego con exito el mantenimiento.
              </div>";
      } elseif ($_GET['alert'] == 2) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Los datos del mantenimiento han modificados correcamente.
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
             Se desactivo con exito el mantenimiento.
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
                  <th class="text-center" width="5%">NE</th>
                  <th class="text-center" width="20%">Descripcion</th>
                  <th class="text-center" width="10%">Costo del mantenimiento</th>
                  <th class="text-center" width="10%">Fecha Servicio</th>
                  <th class="text-center" width="10%">Proximo Servicio</th>
                  <th class="text-center" width="10%">Horometro</th>
                  <th class="text-center" width="15%"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $fecha = date('Y-m-d');
                $query = $crud->consultar_mantenimiento_E();
                while ($data = mysqli_fetch_assoc($query)) {
              ?>
                      <tr>
                          <td align='center' width="5%"><?php echo $data['NE']; ?></td>                                 <!--EDITADO-->
                          <td align='center' width="20%"><?php echo $data['Descripcion'];?></td>
                          <td align='center' width="10%">$<?php echo $data['Costo_mantenimiento']; ?></td>
                          <td align='center' width="10%"><?php echo $data['Fecha_Servicio']; ?></td>
                          <td align='center' width="10%"><?php echo $data['Proximo_Servicio']; ?></td>
                          <td align='center' width="10%"><?php echo $data['Horometro']; ?></td>
                          <td align="center" width="15%">
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

                             ?>
                      <button name="view" data-dismiss="modal" value="view" id="<?php echo $data['ID_Mantenimiento']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Modificar' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'update_cliente', 'Q1')">
                      <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                      </button>
                      
                     
                      <?php //update_mantenimiento
                                

                                if ($data['Estatus']== 1) {
                                  ?>
                                    <a data-toggle="tooltip" data-placement="top" title="DESACTIVAR" style="margin-right:5px" class="btn btn-warning btn-sm" href="modules/Mantenimiento_Equipo/proses.php?act=off&idm=<?php echo $data['ID_Mantenimiento']; ?>" onclick="javascript:if(!confirm('¿Desea desactivar mantenimiento?'))return false">
                                        <i style="color:#fff" class="glyphicon glyphicon-off"></i>
                                    </a>
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
          <div class="modal fade" id="modal_update_cliente" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-update_cliente"><!-- modal-contenido -->

                  </div>
                </div>
          </div><!-- /.Modal -->

          
          <!-- Modal add -->
          <div class="modal fade" id="ModalAdd" data-backdrop="static">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">AGREGAR MANTENIMIENTO</h4>
                </div>
                <div class="modal-body" onchange="camposVacios(0);">
                  <form class="form-horizontal" method="POST" action="modules/Mantenimiento_Equipo/proses.php?act=insert_mantenimiento">

                    <div class="box-body" onclick="inicioEvent(0);" oninput="ocultarPrefijo(0);">

                    
                    <div class="form-group">
                      <label for="title" class="col-sm-4 control-label">Equipo:</label>
                        <div class="col-sm-7">
                        <SELECT class="form-control" NAME="ne" maxlength="5" > 
                        <?php  
                      $query = $crud->consultar_inventario_E();
                      while ($data = mysqli_fetch_assoc($query)) { ?>
                      <OPTION value="<?php echo $data['NE'];?>"><?php echo $data['NE']; echo " _____ ";  echo $data['Descripcion'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Descripcion: </label>
                        <div class="col-sm-7">
                          <input type="text" name="descripcion" class="form-control" placeholder="descripcion" required="required" maxlength="150">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Costo del mantenimiento: </label>
                        <div class="col-sm-7">
                          <input type="number" name="costomantenimiento" class="form-control" placeholder="" required="required" maxlength="10">
                        </div>
                      </div>

                      
                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Fecha del mantenimiento: </label>
                        <div class="col-sm-7">
                          <input  type="date" name="fechamantenimiento" class="form-control" placeholder="" required="required" maxlength="10">
                        </div>
                      </div>
                     
                      <?php
                     // <div class="form-group">
                       // <label for="title" class="col-sm-4 control-label">Proximo Mantenimiento:</label>
                       // <div class="col-sm-7">
                         // <input type="date" name="fechaprox" class="form-control" placeholder="" required="required" maxlength="10" disabled>
                        //</div>
                     // </div>
                    ?>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Horometro Actual:</label>
                        <div class="col-sm-7">
                          <input type="number" name="horometro" class="form-control" placeholder="" required="required" maxlength="10">
                        </div>
                      </div>

                      
        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Diesel:</label>
        <div class="col-sm-7">
        <input type="number" id="diesel" name="diesel" class="form-control" required="required" maxlength="15">
        </div>
        </div>

        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Ubicacion:</label>
        <div class="col-sm-7">
        <input type="text" id="ubicacion" name="ubicacion" class="form-control" required="required" maxlength="35">
        </div>
        </div>


       <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Marca de bateria:</label>
        <div class="col-sm-7">
        <input type="text" id="marcabateria" name="marcabateria" class="form-control" required="required" maxlength="15">
        </div>
        </div>

        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Condiciones fisicas:</label>
        <div class="col-sm-7">
        <input type="text" id="condiciones" name="condiciones" class="form-control"  required="required" maxlength="30">
        </div>
        </div>
      
        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Tuercas, Mariposas:</label>
        <div class="col-sm-7">
        <input type="number" id="tuercas" name="tuercas" class="form-control"  required="required" maxlength="10" >
        </div>
        </div>

        <div class="form-group" >
        <label for="title" class="col-sm-4 control-label">Accesorios adicionales:</label>
        <div class="col-sm-7">
        <input type="text" id="accesorios" name="accesorios" class="form-control"  required="required" maxlength="10" >
         </div>
        </div>


        <br>

        <div>
        <input type="checkbox" id="aceite" name="aceite"  value="1" >
        <label for="scales">Nivel de aceite</label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="refrigerante" name="refrigerante" value="1" >
       <label for="horns">Nivel de refrigerante</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="llavea" name="llavea"  value="1" >
       <label for="horns">Llave de arranque</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="radiador" name="radiador"  value="1" >
       <label for="horns">Tapon de radiador</label>
        </div>
       <div>
       <input type="checkbox" id="combustible" name="combustible"  value="1" >
       <label for="horns">Tapon combustible</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="selectores" name="selectores" value="1" >
       <label for="horns">Selectores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="interruptores" name="interruptores" value="1" >
       <label for="horns">Interruptores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="contactos" name="contactos"   value="1" >
       <label for="horns">contactos</label>
       </div>
       <div>
       <input type="checkbox" id="focos" name="focos"  value="1" >
       <label for="horns">Focos y micas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="mastil" name="mastil"   value="1" >
       <label for="horns">Cable mastil</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="llantas" name="llantas"   value="1" >
       <label for="horns">Llantas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="remolque" name="remolque"   value="1" >
       <label for="horns">Estructura remolque</label>
       </div>
       <div>
       <input type="checkbox" id="patin" name="patin"  value="1" >
       <label for="horns">Gato patin</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="tiron" name="tiron" value="1" >
       <label for="horns">Tiron</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="cadenas" name="cadenas"  value="1" >
       <label for="horns">Cadenas de seguridad</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="matachispas" name="matachispas"  value="1" >
       <label for="horns">Matachispas</label>
       </div>
       <div>

                      <p class="MensajeCampoVacio" id="vacio"><strong>Favor de llenar los campos en rojo</strong> </p>

                    </div>

                </div>
                <div class="modal-footer" onmouseenter="camposVacios(0);">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Guardar">
                </div>
                </form>
              </div>
            </div>
          </div><!-- /.Modal add -->

        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->