<?php
  $r = mysqli_fetch_assoc($crud->Permiso_Acceso_Mayor());
  $max = $r['mayor'];  
?>

<script type="text/javascript" src="modules/Renta/mostrar.js?v=10.5"></script>
<section class="content-header">
  <h1>
    <i class="far fa-user icon-title" prefix="far"></i> <span id="titulo">Entrada Equipo</span>
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
        <a class="btn btn-primary btn-social pull-right"   data-toggle="modal" data-target="#ModalAdd" title="Agregar Renta">
          <i class="fa fa-plus" style="padding: 6px; height: unset;"></i> Agregar Entrada
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
             El equipo se desactivo con éxito.
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
                  <th class="text-center" width="5%">NE</th>
                  <th class="text-center" width="10%">Plan De Renta</th>
                  <th class="text-center" width="10%">Cliente</th>
                  <th class="text-center" width="7%">Cantidad Tiempo</th>
                  <th class="text-center" width="9%">Fecha Inicio</th>
                  <th class="text-center" width="5%">Hora</th>
                  <th class="text-center" width="9%">Fecha Entrega</th>
                  <th class="text-center" width="5%">Horometro</th>
                  <th class="text-center" width="5%">Diesel</th>
                  <th class="text-center" width="15%">Ubicacion</th>
                  <th class="text-center" width="5%">Total</th>
                  <th class="text-center" width="10%"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $fecha = date('Y-m-d');
                $query = $crud->consultar_rentas_Entradas();
                while ($data = mysqli_fetch_assoc($query)) {
              ?>
                      <tr>
                      <td align='center' width="5%"><?php echo $data['ID_Renta']; ?></td>
                          <td align='center' width="5%"><?php echo $data['NE']; ?></td>
                          <td align='center' width="10%"><?php $consulta = $crud->consulta_plan($data['ID_Plan']);  $datos = mysqli_fetch_assoc($consulta); echo $datos['Descripcion']."&nbsp;&nbsp;&nbsp;".$datos['Costo'] ; ?></td>                                  <!--EDITADO-->
                          <td align='center' width="10%"><?php $consulta = $crud->consultar_Cliente_A($data['ID_clientes']);  $datos = mysqli_fetch_assoc($consulta); echo $datos['Razon_Social']."&nbsp;&nbsp;&nbsp;".$datos['Nombre'] ;?></td>
                          <td align='center' width="7%"><?php echo $data['Cantidad_Tiempo']; ?></td>
                          <td align='center' width="9%"><?php echo $data['Fecha_Inicio']; ?></td>
                          <td align='center' width="5%"><?php  echo $data['Hora']; ?></td>
                          <td align='center' width="9%"><?php echo $data['Fecha_Entrega']; ?></td>
                          <td align='center' width="5%"><?php echo $data['Horometro']; ?></td>
                          <td align='center' width="5%"><?php echo $data['Diesel']; ?></td>
                          <td align='center' width="15%"><?php echo $data['Ubicacion']; ?></td>
                          <td align='center' width="5%"><?php echo $data['Total']; ?></td>
                          <td align="center" width="10%">
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
                                  <button name="view" value="view" id="<?php echo $data['ID_Renta']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Modificar' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'update_cliente', 'R1')">
                                    <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                  </button><?php //update_renta?>
                                
                                
                                  <button name="view2" value="view2" id="<?php echo $data['ID_Renta']; ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Ver List' style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'update_cliente', 'R2')">
                                  <i style='color:#fff' class='fa fa-eye'></i>
                                  </button><?php //ver_list?>
                                
                                  <a class='btn btn-danger btn-social pull-right' style='margin-right:5px; margin-top: 5px;' href='modules/Renta/reporte_renta/PDF.php?nR=<?php echo $data['ID_Renta'];?>'  title='Abrir PDF' data-toggle='tooltip' target='_blank'>
                                  <i class="glyphicon glyphicon-download-alt"></i> PDF
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
          </div>
          
          <!-- Modal add -->
          <div class="modal fade" id="ModalAdd" data-backdrop="static">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">AGREGAR RENTA</h4>
                </div>
                <div class="modal-body" onchange="camposVacios(0);">
                  <form class="form-horizontal" method="POST" action="modules/Renta/proses.php?act=insert_renta">

                    <div class="box-body" onclick="inicioEvent(0);" oninput="ocultarPrefijo(0);">

                    <div class="form-group" >
                      <label for="title" class="col-sm-4 control-label">Salidas Activas:</label>
                        <div class="col-sm-7"  >
                        <SELECT class="form-control" id="lista1"  NAME="lista1" maxlength="5" > 
                        <?php  
                      $quer = $crud->consultar_salidas_E();
                      $i=0;
                      while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona un equipo</option><?php $i++; } ?>
                      <OPTION value="<?php echo $dat['ID_Renta']."*".$dat['NE']; ?>"><?php echo $dat['NE'];?>&nbsp;&nbsp;&nbsp;<?php echo $dat['ID_Renta'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      </div>
                         
                      <div class="form-group" >
                      <label for="title" class="col-sm-4 control-label">Planes:</label>
                        <div class="col-sm-7" id="listaview">
                      </div>
                      </div>
                     
                      <div class="form-group" >
                      <label for="title" class="col-sm-4 control-label">Clientes:</label>
                      <div class="col-sm-7" >
                      <SELECT class="form-control" id="lista3"  NAME="lista3" maxlength="5" > 
                      <?php  
                      $quer = $crud->clientes_A();
                      $i=0;
                      while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona un equipo</option><?php $i++; } ?>
                      <OPTION value="<?php echo $dat['ID_clientes']; ?>"><?php echo $dat['Razon_Social'];?>&nbsp;&nbsp;&nbsp;<?php echo $dat['Nombre'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      </div>
      
                      <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Cantidad de tiempo:</label>
        <div class="col-sm-7">
        <input type="text" maxlength="4" id="cant" name="cantidadt" placeholder="Escribe la cantidad del plan elegido, ejemplo: 2 dias (Solo pon la cantidad)." class="form-control" required="required" oninput="recargarLista2()">
        </div>
        </div>


        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Hora:</label>
        <div class="col-sm-7">
        <input type="time" id="hora" name="hora" class="form-control" required="required" maxlength="15">
        </div>
        </div>

        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Fecha entrega:</label>
        <div class="col-sm-7">
        <input type="date" id="fechae" name="fechaentrega" class="form-control" required="required" maxlength="15">
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
        <label for="title" class="col-sm-4 control-label">Total:</label>
        <div id= "itotal1" class="col-sm-7">
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
        <input type="text" name="condiciones" class="form-control"  required="required" maxlength="30">
        </div>
        </div>
      
        <div class="form-group">
        <label for="title" class="col-sm-4 control-label">Tuercas, Mariposas:</label>
        <div class="col-sm-7">
        <input type="text" id="tuercas" name="tuercas" class="form-control"  required="required" maxlength="10" >
        </div>
        </div>

        <div class="form-group">
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
       <input type="checkbox" id="radiador" name="radiador" value="1" >
       <label for="horns">Tapon de radiador</label>
        </div>
       <div>
       <input type="checkbox" id="combustible" name="combustible" value="1" >
       <label for="horns">Tapon combustible</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="selectores" name="selectores" value="1">
       <label for="horns">Selectores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="interruptores" name="interruptores" value="1" >
       <label for="horns">Interruptores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="contactos" name="contactos" value="1"  >
       <label for="horns">contactos</label>
       </div>
       <div>
       <input type="checkbox" id="focos" name="focos" value="1" >
       <label for="horns">Focos y micas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="mastil" name="mastil" value="1"  >
       <label for="horns">Cable mastil</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="llantas" name="llantas"  value="1" >
       <label for="horns">Llantas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="remolque" name="remolque"  value="1" >
       <label for="horns">Estructura remolque</label>
       </div>
       <div>
       <input type="checkbox" id="patin" name="patin" value="1" >
       <label for="horns">Gato patin</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="tiron" name="tiron" value="1">
       <label for="horns">Tiron</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="cadenas" name="cadenas"  value="1">
       <label for="horns">Cadenas de seguridad</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="matachispas" name="matachispas"  value="1" >
       <label for="horns">Matachispas</label>
       </div>
       <div>
       

       <br>


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