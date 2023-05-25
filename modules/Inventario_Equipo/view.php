<?php
  $r = mysqli_fetch_assoc($crud->Permiso_Acceso_Mayor());
  $max = $r['mayor'];  
?>

<script type="text/javascript" src="modules/arrendamiento/mostrar.js?v=10.5"></script>
<section class="content-header">
  <h1>
    <i class="far fa-user icon-title" prefix="far"></i> <span id="titulo">Inventario De Equipos</span>
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
        <a class="btn btn-primary btn-social pull-right"   data-toggle="modal" data-target="#ModalAdd" title="Agregar Equipo">
          <i class="fa fa-plus" style="padding: 6px; height: unset;"></i> Agregar Equipo
        </a>
      <a class='btn btn-primary pull-right'  title='Ver planes' data-toggle='tooltip' target='_blank' style="margin-right: 5px;" onclick="openModal(null, 'planes_renta', 'P2')">
     Planes de renta
      </a>
      <a class='btn btn-primary pull-right'  title='Ver planes' data-toggle='tooltip' target='_blank' style="margin-right: 5px;" onclick="openModal(null, 'peticiones', 'P5')">
     Peticiones
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
               Se agrego con exito el nuevo equipo
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
             El equipo se desactivo con éxito.
            </div>";
    }elseif ($_GET['alert'] == 9) {
      echo "<div class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
           Se agrego con exito el nuevo tipo de equipo.
          </div>";
  }elseif ($_GET['alert'] == 10) {
    echo "<div class='alert alert-success alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
         Se agrego con exito el nuevo plan
        </div>";
} elseif ($_GET['alert'] == 11) {
  echo "<div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
     Se envio el equipo a peticion de mantenimiento, solo falta que el tecnico atienda la peticion.
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
                  <th class="text-center" width="10%">Modelo</th>
                  <th class="text-center" width="15%">Descripcion</th>
                  <th class="text-center" width="10%">N/S</th>
                  <th class="text-center" width="10%">Tipo De Equipo</th>
                  <th class="text-center" width="10%">Estatus</th>
                  <th class="text-center" width="10%">Fecha_Adquisicion</th>
                  <th class="text-center" width="10%">Costo</th>
                  <th class="text-center" width="20%"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $fecha = date('Y-m-d');
                $query = $crud->consultar_inventario_E();
                while ($data = mysqli_fetch_assoc($query)) {
              ?>
                      <tr>
                          <td align='center' style="width: auto;"><?php echo $data['NE']; ?></td>
                          <td align='center' style="width: auto;"><?php echo $data['Modelo']; ?></td>                                  <!--EDITADO-->
                          <td align='center' style="width: auto;"><?php echo $data['Descripcion'];?></td>
                          <td align='center' style="width: auto;"><?php echo $data['NS']; ?></td>
                          <td align='center' style="width: auto;"><?php $quer = $crud->consultar_Tipo_E($data['ID_Tipo']); $dat = mysqli_fetch_assoc($quer); echo $dat['Descripcion']; ?></td>
                          <td align='center' style="width: auto;"><?php echo $data['DESCRIPCION']; ?></td>
                          <td align='center' style="width: auto;"><?php echo $data['Fecha_Adquisicion']; ?></td>
                          <td align='center' style="width: auto;">$<?php echo  $data['Costo']; ?></td>
                          <td align="center" style="width: auto;">
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
                                  <a data-toggle="tooltip" data-placement="top" title="Enviar peticion mantenimiento" style="margin-right:5px" class="btn btn-warning btn-sm" href="modules/Inventario_Equipo/proses.php?act=enviar_peticion&ne=<?php echo $data['NE']; ?>" onclick="javascript:if(!confirm('¿Desea levantar la peticion de mantenimiento?'))return false">
                                  <i class="fas fa-share"></i>
                                  </a>
                                  <button name="view" value="view" id="<?php echo $data['NE']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Modificar' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'modificar_equipo', 'P1')">
                                    <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                  </button>
                                  <?php //update_cliente
                                  
                                }
                                

                                if ($data['Estatus']== 1) {
                                  ?>
                                    <a data-toggle="tooltip" data-placement="top" title="Desactivar" style="margin-right:5px" class="btn btn-warning btn-sm" href="modules/Inventario_Equipo/proses.php?act=off&ne=<?php echo $data['NE']; ?>" onclick="javascript:if(!confirm('¿Desea desactivar el equipo?'))return false">
                                        <i style="color:#fff" class="glyphicon glyphicon-off"></i>
                                    </a>
                                  <?php
                                  } else {?>
                                    <a data-toggle="tooltip" data-placement="top" title="Activar" style="margin-right:5px" class="btn btn-success btn-sm" href="modules/Inventario_Equipo/proses.php?act=on&ne=<?php echo $data['NE']; ?>" onclick="javascript:if(!confirm('¿Desea activar el equipo?'))return false">
                                        <i style="color:#fff" class="glyphicon glyphicon-ok"></i>
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

          <!-- Modal renta -->
        <div class="modal fade" id="modal_planes_renta" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-planes_renta"><!-- modal-contenido -->

                  </div>
                </div>
          </div>
       <!-- /.Modal planes renta --> 


        <!-- Modal modificar equipo -->
        <div class="modal fade" id="modal_modificar_equipo" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-modificar_equipo"><!-- modal-contenido -->

                  </div>
                </div>
          </div>
       <!-- /.Modal modificar equipo -->

        <!-- Modal peticiones -->
        <div class="modal fade" id="modal_peticiones" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-peticiones"><!-- modal-contenido -->

                  </div>
                </div>
          </div>
       <!-- /.Modal peticiones -->

       <!-- Modal agregar plan -->
       <div class="modal fade" id="modal_agregar_plan" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-agregar_plan"><!-- modal-contenido -->

                  </div>
                </div>
          </div>
       <!-- /.Modal agregar plan -->

        <!-- Modal modificar plan -->
        <div class="modal fade" id="modal_modificar_plan" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-modificar_plan"><!-- modal-contenido -->

                  </div>
                </div>
          </div>
       <!-- /.Modal modificar plan -->

          <!-- Modal add -->
          <div class="modal fade" id="ModalAdd" data-backdrop="static">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">AGREGAR EQUIPO</h4>
                </div>
                <div class="modal-body" onchange="camposVacios(0);">
                  <form class="form-horizontal" method="POST" action="modules/Inventario_Equipo/proses.php?act=insert_equipo">

                    <div class="box-body" onclick="inicioEvent(0);" oninput="ocultarPrefijo(0);">

                    <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">NE: </label>
                        <div class="col-sm-7">
                          <input type="text" id="ne" name="ne" class="form-control" placeholder="NE" required="required" maxlength="17">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Modelo: </label>
                        <div class="col-sm-7">
                          <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo" required="required" maxlength="20">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Descripcion: </label>
                        <div class="col-sm-7">
                          <input type="text" name="descripcion" class="form-control" placeholder="descripcion" required="required" maxlength="25">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">N/S: </label>
                        <div class="col-sm-7">
                          <input type="text" name="ns" class="form-control" placeholder="NS" required="required" maxlength="17">
                        </div>
                      </div>

                      
                      <div class="form-group">
                      <label for="title" class="col-sm-4 control-label">Tipo De Equipo </label>
                        <div class="col-sm-7">
                        <SELECT class="form-control" NAME="combo1" maxlength="5" > 
                        <?php  
                      $query = $crud->consultar_Tipos_E();
                      while ($data = mysqli_fetch_assoc($query)) { ?>
                      <OPTION value="<?php echo $data['ID_Tipo'];?>"><?php echo $data['Descripcion'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      <button name="view" data-dismiss="modal" value="view" id="<?php echo $data['NE']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Modificar' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'modificar_equipo', 'O1')">
                      <i style='color:#fff' class="fa fa-plus"></i>
                      </button>
                      </div>
                    
                      
                     
                      <div class="form-group" >
                      <label for="title" class="col-sm-4 control-label">Estatus:  </label>
                      <div class="col-sm-7" id="listac_1" style=" width:auto;">
                      <SELECT class="form-control" NAME="combo3" maxlength="5" >
                      <?php  
                     $quer = $crud->consultar_estatus();
                      $i=0;
                      while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona Estatus</option><?php $i++; } ?>
                      <OPTION value="<?php echo $dat['ID_Estatus']; ?>"><?php echo $dat['DESCRIPCION'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Fecha de aquisicion: </label>
                        <div class="col-sm-7">
                          <input type="date" name="fechaad" class="form-control" placeholder="Fecha Adquisicion" required="required" maxlength="10">
                        </div>
                      </div>

          
                      <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Costo del equipo:</label>
                        <div class="col-sm-7">
                          <input type="text" name="costo" class="form-control" placeholder="Costo del equipo" required="required" maxlength="11">
                        </div>
                      </div>
   
                      <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Horometro:</label>
        <div class="col-sm-7">
        <input type="number" id="horometro" name="horometro" class="form-control" required="required" maxlength="15">
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
        <input type="text" id="tuercas" name="tuercas" class="form-control"  required="required" maxlength="10" >
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
        <input type="checkbox" id="aceite" name="aceite" value="1">
        <label for="scales">Nivel de aceite</label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="refrigerante" name="refrigerante"  value="1">
       <label for="horns">Nivel de refrigerante</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="llavea" name="llavea"  value="1">
       <label for="horns">Llave de arranque</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="radiador" name="radiador"  value="1">
       <label for="horns">Tapon de radiador</label>
        </div>
       <div>
       <input type="checkbox" id="combustible" name="combustible"  value="1">
       <label for="horns">Tapon combustible</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="selectores" name="selectores" value="1">
       <label for="horns">Selectores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="interruptores" name="interruptores" value="1">
       <label for="horns">Interruptores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="contactos" name="contactos"   value="1">
       <label for="horns">contactos</label>
       </div>
       <div>
       <input type="checkbox" id="focos" name="focos"  value="1">
       <label for="horns">Focos y micas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="mastil" name="mastil"   value="1">
       <label for="horns">Cable mastil</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="llantas" name="llantas"   value="1">
       <label for="horns">Llantas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="remolque" name="remolque"  value="1">
       <label for="horns">Estructura remolque</label>
       </div>
       <div>
       <input type="checkbox" id="patin" name="patin"  value="1">
       <label for="horns">Gato patin</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="tiron" name="tiron" value="1">
       <label for="horns">Tiron</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="cadenas" name="cadenas"  value="1">
       <label for="horns">Cadenas de seguridad</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="matachispas" name="matachispas"  value="1">
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