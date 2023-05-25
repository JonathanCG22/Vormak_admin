<?php
  $r = mysqli_fetch_assoc($crud->Permiso_Acceso_Mayor());
  $max = $r['mayor'];  
?>

<script type="text/javascript" src="modules/arrendamiento/mostrar.js?v=10.5"></script>
<section class="content-header">
  <h1>
    <i class="far fa-user icon-title" prefix="far"></i> <span id="titulo">Datos de Clientes </span>
    <?php
    if ($_SESSION['permisos_acceso'] <= $max && $_SESSION['permisos_acceso'] != 0) { 
      $objeto->id_Acceso = $_SESSION['permisos_acceso'];
      $objeto->id_Modulo = 'Clientes'; 
      $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
      $accion = explode(",", $r['accion']);

      $val = 0;
      foreach ($accion as $key => $value) {
        if ($value == 'Agregar') {
           $val++; 
        }            
      }

      if ($val > 0) { ?>
        <a class="btn btn-primary btn-social pull-right"   data-toggle="modal" data-target="#ModalAdd" title="Agregar Cliente">
          <i class="fa fa-plus" style="padding: 6px; height: unset;"></i> Agregar Cliente
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
               Nuevos datos del Cliente han sido  almacenado correctamente.
              </div>";
      } elseif ($_GET['alert'] == 2) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Datos del cliente modificados correcamente.
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

      }elseif ($_GET['alert'] == 7) {
          echo "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Advertencia!</h4>
               Lo sentimos, ese usuario ya existe.
              </div>";

      }
      ?>

      <div class="box box-teal-primario">
        <div class="box-body">

  		   <div class="">
            <table id="pruebas" class="table table-bordered table-striped table-hover table-condensed" width="100%">
              <thead align="center">
                <tr class="bg-teal-primary">
                  <th class="text-center" width="7%">RFC</th>
                  <th class="text-center" width="5%">Razon Social y/o nombre</th>
                  <th class="text-center" width="10%">Regimen / CFDI</th>
                  <th class="text-center" width="13%">Dirección</th>
                  <th class="text-center" width="10%">Teléfono</th>
                  <th class="text-center" width="10%">Email</th>
                  <th class="text-center" width="5%"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $fecha = date('Y-m-d');
                $query = $crud->clientes_A();
                while ($data = mysqli_fetch_assoc($query)) {
                  /*
                    if ($data['direccion'] != '' && $data['ciudad'] != '' && $data['estado'] != '') {
                    $direccion = $data['direccion']. ",". $data['ciudad']. ",". $data['estado'];

                  }else{
                    if ($data['direccion'] == '' && $data['ciudad'] != '' && $data['estado'] != '') {
                      $direccion = $data['ciudad']. ",". $data['estado']; 

                    }else if ($data['direccion'] != '' && $data['ciudad'] == '' && $data['estado'] != '') {
                      $direccion = $data['direccion']. ",". $data['estado']; 

                    }else if ($data['direccion'] != '' && $data['ciudad'] != '' && $data['estado'] == '' ) {
                      $direccion = $data['direccion']. ",". $data['ciudad']; 

                    }else{
                      $direccion = '';
                    }
                    
                    
                  }*/?>
                      <tr>
                      <td align='center' width="7%"><?php echo $data['RFC']; ?></td>
                          <td align='center' width="5%"><?php echo $data['Razon_Social']; ?></td>
                          <td align='center' width="10%"><?php echo $data['Regimen']." / ".$data['CFDI']; ?></td>                                  <!--EDITADO-->
                          <td align='center' width="13%"><?php echo $data['Direccion'];?></td>
                          <td align='center' width="10%"><?php echo $data['Celular']; ?></td>
                          <td align='center' width="10%"><?php echo $data['Email']; ?></td>
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
                                  <button name="view" value="view" id="<?php echo $data['RFC']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Modificar' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'update_cliente', 'N1')">
                                    <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                  </button><?php //update_cliente
                                }
                                if ($valV > 0) { ?>
                                <!--
                                  <button name="view2" value="view2" id="<?php echo $data['nombre']; ?>:<?php echo $_SESSION['permisos_acceso'] ?>" class='btn btn-info btn-sm' data-toggle='tooltip' title='Ver Usuarios' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'ver_usuariosC', 'B2')">
                                    <i style='color:#fff' class='fa fa-eye'></i>
                                  </button>ver_usuariosC 

                                  <button name="view3" value="view3" id="<?php echo $data['nombre']; ?>:<?php echo $_SESSION['permisos_acceso'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title='Ver Cargos' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'ver_cargosC', 'B4')">
                                    <i style='color:#fff' class='fa fa-eye'></i>
                                  </button> ver_cargosC 

                                  <button name="view4" value="view4" id="<?php echo $data['RFC']; ?>:<?php echo $_SESSION['permisos_acceso'] ?>" class='btn btn-warning btn-sm' data-toggle='tooltip' title='Ver Correos' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'ver_correosC', 'B6')">
                                    <i style='color:#fff' class='fa fa-eye'></i>
                                  </button>//ver_correosC --> <?php 
                                }?>                            
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

          <!-- Modal modificar equipo -->
     <div class="modal fade" id="modal_modificar_equipo" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-modificar_equipo"><!-- modal-contenido -->

                  </div>
                </div>
          </div>
       <!-- /.Modal modificar equipo -->
       
          <!-- Modal ver usuario del cliente -->
          <div class="modal fade" id="modal_ver_usuariosC" data-backdrop="static"><!-- modal_verUC -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-ver_usuariosC"><!-- modal-verUC -->

                  </div>
                </div>
          </div><!-- /.Modal -->

          <!-- Modal agregar/modificar usuario del cliente -->
          <div class="modal fade" id="modal_usuarios_Clientes" data-backdrop="static"><!-- modal_UserClient -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-usuarios_Clientes"><!-- modal-UserClient -->

                  </div>
                </div>
          </div><!-- /.Modal -->

          <!-- Modal ver cargo del cliente -->
          <div class="modal fade" id="modal_ver_cargosC" data-backdrop="static"><!-- modal_verCargoC -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-ver_cargosC"><!-- modal-verCargoC -->

                  </div>
                </div>
          </div><!-- /.Modal -->

          <!-- Modal agregar/modificar cargo del cliente -->
          <div class="modal fade" id="modal_cargos_Clientes" data-backdrop="static"><!-- modal_CargoClient -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-cargos_Clientes"><!-- modal-CargoClient -->

                  </div>
                </div>
          </div><!-- /.Modal -->

          <!-- Modal ver correo del cliente -->
          <div class="modal fade" id="modal_ver_correosC" data-backdrop="static"><!-- modal_verCorreoC -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-ver_correosC"><!-- modal-verCorreoC -->

                  </div>
                </div>
          </div><!-- /.Modal -->

          <!-- Modal agregar/modificar correo del cliente -->
          <div class="modal fade" id="modal_correos_Clientes" data-backdrop="static"><!-- modal_CorreoClient -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-correos_Clientes"><!-- modal-CorreoClient -->

                  </div>
                </div>
          </div><!-- /.Modal -->

          <!-- Modal add -->
          <div class="modal fade" id="ModalAdd" data-backdrop="static">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">AGREGAR CLIENTE</h4>
                </div>
                <div class="modal-body" onchange="camposVacios(0);">
                  <form class="form-horizontal" method="POST" action="modules/arrendamiento/proses.php?act=insert_cliente" enctype="multipart/form-data">

                    <div class="box-body" onclick="inicioEvent(0);" oninput="ocultarPrefijo(0);">

                    <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">RFC: </label>
                        <div class="col-sm-7">
                          <input type="text" id="rfc" name="rfc" class="form-control" placeholder="Nombre" required="required" maxlength="50">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Regimen: </label>
                        <div class="col-sm-7">
                          <input type="text" id="regimen" name="regimen" class="form-control" placeholder="Nombre" required="required" maxlength="50">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">CFDI: </label>
                        <div class="col-sm-7">
                          <input type="text" id="cfdi" name="cfdi" class="form-control" placeholder="Nombre" required="required" maxlength="50">
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Razon Social y/o <br> nombre persona fisica: </label>
                        <div class="col-sm-7">
                          <input type="text" id="razonsocial" name="razonsocial" class="form-control" placeholder="Nombre" required="required" maxlength="50">
                        </div>
                      </div>

                  

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Dirección: </label>
                        <div class="col-sm-7">
                          <input type="text" name="direccion" class="form-control" placeholder="Dirección" required="required" maxlength="150">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Teléfono: </label>
                        <div class="col-sm-7">
                          <input type="text" name="telefono" class="form-control" placeholder="Ej. 000-00-00" required="required" maxlength="10" pattern="^[0-9]{3}(-[0-9]{2})(-[0-9]{2})?$">
                        </div>
                      </div>

              

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Email: </label>
                        <div class="col-sm-7">
                          <input type="email" name="email" class="form-control" placeholder="Ej. email@vormak.com" required="required" maxlength="50">
                        </div>
                      </div>

                      <div class="form-group">
                      <label for="actac" class="col-sm-4 control-label">Imagen de Acta <br>constitutiva:</label>
                      <div class="col-sm-7">
                  <input id="actac"  name="actac" type="file">
                      </div>
                      </div>

                      <div class="form-group">
                      <label for="podern" class="col-sm-4 control-label">Imagen de Poder<br> Notarial:</label>
                      <div class="col-sm-7">
                      <input id="podern"  name="podern" type="file">
                      </div>
                      </div>

                      <div class="form-group">
                      <label for="comprobanted" class="col-sm-4 control-label">Imagen de Comprobante de<br> domicilio:</label>
                      <div class="col-sm-7">
                      <input id="comprobanted"  name="comprobanted" type="file">
                      </div>
                      </div>

                      <div class="form-group">
                      <label for="IFE" class="col-sm-4 control-label">Imagen de IFE del <br>representante legal:</label>
                      <div class="col-sm-7">
                      <input id="IFE"  name="IFE" type="file">
                      </div>
                      </div>

                      <div class="form-group">
                      <label for="ecuenta" class="col-sm-4 control-label">Imagen del ultimo <br> estado de cuenta:</label>
                      <div class="col-sm-7">
                      <input id="ecuenta"  name="ecuenta" type="file">
                      </div>
                      </div>

                      

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