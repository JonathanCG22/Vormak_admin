<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="modules/personal/script.js"></script>
<script type="text/javascript">
$(document).ready(function() {
     $("#button").click(function() {
       $('#ModalAddPersonal').on('shown.bs.modal', function() {
         $('#nombre').focus();
       })
     });
});
</script>

<section class="content-header">
  <h1>
    <i class="fa fa-user icon-title" title="Agregar"></i> <span id="titulo">Datos de Personal </span>

    <a class="btn btn-primary btn-social pull-right" id="button" title="Agregar Personal" data-toggle="modal" data-target="#ModalAddPersonal" title="Agregar" data-toggle="tooltip">
      <i class="fas fa-plus fa-lg" style="padding: 6px; height: unset;"></i> Agregar
    </a>

    <a class='btn btn-danger pull-right' href='modules/personal/PDF2.php'  title='Formato Solicitud PDF' data-toggle='tooltip' target='_blank' style="margin-right: 5px;">
      <i class="fas fa-file-download" prefix="fas"></i>
    </a>
    <a class='btn btn-primary pull-right' onclick="openModal(null, 'agregar_salida', 'R4')"  title='Solicitudes andamieros' data-toggle='tooltip' target='_blank' style="margin-right: 5px;">
      <i class="fa fa-user icon-title" prefix="fas"></i>Solicitantes
    </a>
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
             Nuevos datos de personal han sido  almacenado correctamente.
            </div>";
    } elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
             Datos del personal modificados correcamente.
            </div>";
    } elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
            Se eliminaron los datos del personal
            </div>";
    }
    ?>

      <div class="box box-teal-primario">
        <div class="box-body">

		  <div class="table-responsive"> <!--id="dataTables" -->
          <table id="tabla1" class="table table-bordered table-striped table-hover table-condensed">
            <thead>
              <tr class="bg-teal-primary">
                <th class="text-center">Id.</th>
                <th class="center">Nombre</th>
                <th class="center">Ocupación</th>
                <th class="text-center">Teléfono</th>
				        <th class="text-center">Documentación</th>
                <th class="text-center">Estatus</th>
                <th class="text-center">Contrato</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
            $fecha = date('Y-m-d');
            $query = $crud->consulta_Personal();

            while ($data = mysqli_fetch_assoc($query)) {
                ?>
              <tr>
                      <td width='5%' class="text-center" ><?php echo $data['id']; ?></td>
                      <td width='30%' class='center'><?php echo $data['nombre']; ?></td>
                      <td width='10%' class='center'><?php echo $data['ocupacion']; ?></td>
                      <td width='10%'  class='center'><?php echo $data['tel_cel']; ?></td>
                      <td width='10%' align='center'> <?php if ($data['documentos'] == "1 1 1 1 1 1") {
                    echo "<span class='label label-success'>Completo</span>";
                } elseif ($data['documentos'] == "0 0 0 0 0 0") {
                    echo "<span class='label label-danger'>Ninguno</span>";
                } else {
                    echo "<span class='label label-warning'>Incompleto</span>";
                } ?></td>
                      <td width='10%' align='center'><i class="<?php
                      if ($data['estatus'] == 'Lista Negra') { echo 'bg-black';}
                      elseif ($data['estatus'] == 'Inactivo'){ echo 'bg-gray';}
                      elseif ($data['estatus'] == 'Vigente') { echo 'bg-blue';}
                      ?>" style="padding: 3px 6px;"><?php echo $data['estatus']; ?></i></td>
                      <td width='10%'  align='center'><?php if ($data['contrato'] >= $fecha) {
                    echo "<input type='checkbox' checked='checked' disabled='disabled'>";
                } else {
                    echo "<input type='checkbox' disabled='disabled'>";
                } ?></td>
                      <td width='15%'  class='text-center'>
                        <div>
                          <a href="#" onclick="window.open('modules/personal/huella.php?id=<?php echo $data['id']; ?>','Huella Dactilar', ' width=620px height=600px toolbar=no location=no status=no menubar=no top=300 left=700 '); return false;" title="Huella Dactilar" data-toggle="tooltip" class='btn <?php if ($data['f_no1']>0){echo "btn-success"; }else{ echo "btn-danger";} ?> btn-sm finger_personal'/>
                            <i class="fa fa-fingerprint"></i>
                          </a>
                          &nbsp&nbsp&nbsp
                          <button id="<?php echo $data['id']; ?>" title="Editar" data-toggle="tooltip"  class='btn btn-primary btn-sm' onclick="openModal(this, 'update_personal', 'C1')">
                            <i class="fas fa-edit"></i>
                          </button><!-- update_personal -->

                          <a class='btn btn-danger btn-sm' href='modules/personal/PDF2.php?p=<?= $data['id'] ?>'  title='Abrir como PDF' data-toggle='tooltip' target='_blank'>
                            <i class="fa fa-file-pdf"></i>
                          </a>
                    	  </div>
                      </td>
                    </tr>
            <?php
            }//fin del While
            ?>
            </tbody>
          </table>
          </div>


          <!-- Modal update -->
          <div class="modal fade" id="modal_update_personal"><!-- modal-persona -->
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" id="modal-update_personal"><!-- modal-contenido-persona -->

                  </div>
                </div>
          </div><!-- /.Modal -->

          <div class="modal fade" id="modal_agregar_salida" data-backdrop="static"><!-- modal -->
                <div class="modal-dialog modal-lg" style="width:87%;">
                  <div class="modal-content" id="modal-agregar_salida"><!-- modal-contenido -->

                  </div>
                </div>
          </div>

          
          <!-- Modal add -->
          <div class="modal fade" id="ModalAddPersonal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h4 class="modal-title text-center">AGREGAR PERSONA</h4>
                </div>
                <div class="modal-body">
                  <!-- form start -->
                  <form role="form" class="form-horizontal" id="personal" action="modules/personal/proses.php?act=insert" name="agregar" method="POST" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;DATOS PERSONALES</strong></h4></td>
                        </tr>
                      </table>
                    </div>


                    <div class="form-group">
                      <div class="cargar-imagen">
                        <label class="col-sm-2 control-label">FOTOS:</label>
                        <div class="row">
                          <label for="foto_1" class="col-sm-2 control-label">
                            <img id="imgSalida_1" src="images/Personal/user-default.png" title="Foto Perfil izquierdo " data-toggle="tooltip">
                          </label>
                          <label for="foto_2" class="col-sm-2 control-label">
                            <img id="imgSalida_2" src="images/Personal/user-default.png" title="Foto de frente" data-toggle="tooltip">
                          </label>
                          <label for="foto_3" class="col-sm-2 control-label">
                            <img id="imgSalida_3" src="images/Personal/user-default.png" title="Foto perfil derecho" data-toggle="tooltip">
                          </label>
                        </div>
                        <input id="foto_1" type="file" name="foto_1">
                        <input id="foto_2" type="file" name="foto_2">
                        <input id="foto_3" type="file" name="foto_3">
                      </div>
                    </div>

                    <div class="form-group col-sm-12">
                      <label class="control-label">Nombre Completo</label>
                      <input type="text" title="Nombre Completo" data-toggle="tooltip" autofocus class="form-control" placeholder="Apellido Paterno, Apellido Materno y Nombres" name="nombre" id="nombre" required>
                    </div>

                    <div class="form-group col-sm-12">
                      <div class="col-sm-3">
                        <label class="control-label">Edad</label>
                        <div class="input-group">
                          <input type="text" title="Edad" data-toggle="tooltip" class="form-control input-sm text-center" maxlength="2" name="edad">
                          <span class="input-group-addon">años</span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Lugar de Nacimiento</label>
                        <input type="text" title="Lugar de Nacimiento" data-toggle="tooltip" class="form-control input-sm" name="lugar_nacimiento">
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Fecha de Nacimiento</label>
                        <input type="text" class="form-control date-picker input-sm" data-date-format="yyyy/mm/dd" name="fecha_nacimiento">
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Sexo</label>
                        <select class="form-control input-sm" name="sexo" data-placeholder="-- Seleccionar --" autocomplete="off">
                          <option value="" disabled selected>-- Seleccionar --</option>
                          <option value="M">Masculino</option>
                          <option value="F">Femenino</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-sm-12">
                      <div class="col-sm-8">
                        <label class="control-label">Calle y Numero</label>
                        <input type="text" title="Domicilio" data-toggle="tooltip" class="form-control input-sm" name="domicilio">
                      </div>
                      <div class="col-sm-4">
                        <label class="control-label">Codigo Postal</label>
                        <input type="text" title="Codigo Postal" data-toggle="tooltip" onchange="obtener_cp(this.value)" class="form-control input-sm" name="codigo_postal">
                      </div>
                      <!-- <div class="col-sm-3">
                        <label class="control-label">Fecha del Comprobante de Domicilio</label>
                        <input type="text" class="form-control date-picker input-sm" data-date-format="yyyy/mm" name="fecha_cd">
                      </div> -->
                    </div>

                    <div class="form-group col-sm-12" id="domicilio">
                      <div class="col-sm-4">
                        <label class="control-label">Colonia</label>
                        <select class="form-control input-sm" name="colonia" data-placeholder="-- Seleccionar --" autocomplete="off" disabled>
                          <option value="" disabled selected>- Proporcione Codigo Postal -</option>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <label class="control-label">Ciudad</label>
                        <select class="form-control input-sm" name="ciudad" data-placeholder="-- Seleccionar --" autocomplete="off" disabled>
                          <option value="" disabled selected>- Proporcione Codigo Postal -</option>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <label class="control-label">Estado</label>
                        <select class="form-control input-sm" name="estado" data-placeholder="-- Seleccionar --" autocomplete="off" disabled>
                          <option value="" disabled selected>- Proporcione Codigo Postal -</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group col-sm-12">
                      <div class="col-sm-2">
                        <label class="control-label">Tel. Casa</label>
                        <input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="tel_casa" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label">Tel. Celular</label>
                        <input type="text" title="Telefono Celular" data-toggle="tooltip" class="form-control input-sm" name="tel_cel" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Correo Electronico</label>
                        <input type="email" title="Correo" data-toggle="tooltip" class="form-control input-sm" name="correo">
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label">Vive con</label>
                        <select class="form-control input-sm" name="vive_con">
                          <option value="" disabled selected>-- Seleccionar --</option>
                          <option value="Sus Padres">Sus Padres</option>
                          <option value="Su Familia">Su familia</option>
                          <option value="Parientes">Parientes</option>
                          <option value="Solo">Solo</option>
                        </select>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Estado Civil</label>
                        <select class="form-control input-sm" name="estado_civil">
                          <option value="" disabled selected>-- Seleccionar --</option>
                          <option value="Soltero/a">Soltero/a</option>
                          <option value="Casado/a">Casado/a</option>
                          <option value="Divorciado/a">Divorciado/a</option>
                          <option value="Viudo/a">Viudo/a</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTACION</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-3">
                        <label class="control-label">Nombre del Banco</label>
                        <input type="text" title="Banco" data-toggle="tooltip" class="form-control input-sm" name="banco">
                      </div>
                      <div class="col-sm-9">
                        <label class="control-label">Numero de Tarjeta de Nomina</label>
                        <table>
                          <tr>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t1" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t2.focus()" ></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t2" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t3.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t3" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t4.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t4" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t5.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t5" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t6.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t6" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t7.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t7" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t8.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t8" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t9.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t9" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t10.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t10" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t11.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t11" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t12.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t12" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t13.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t13" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t14.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t14" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t15.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t15" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) t16.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="t16" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c1.focus()"></td>
                          </tr>
                        </table>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-9">
                        <label class="control-label">Clave Unica del Registro de Poblacion (CURP)</label>
                        <table>
                          <tr>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c1" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c2.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c2" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c3.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c3" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c4.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c4" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c5.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c5" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c6.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c6" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c7.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c7" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c8.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c8" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c9.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c9" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c10.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c10" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c11.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c11" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c12.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c12" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c13.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c13" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c14.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c14" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c15.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c15" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c16.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c16" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c17.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c17" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) c18.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="c18" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) cartilla.focus(); javascript:this.value=this.value.toUpperCase();"></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">No. Cartilla Militar</label>
                        <input type="text" title="No. Cartilla Militar" data-toggle="tooltip" class="form-control input-sm" name="cartilla">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label">Numero de Seguridad Social (NSS)</label>
                        <table>
                          <tr>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n1" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n2.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n2" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n3.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n3" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n4.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n4" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n5.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n5" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n6.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n6" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n7.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n7" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n8.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n8" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n9.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n9" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n10.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n10" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) n11.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="n11" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r1.focus()"></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label">Registro Federal del Contribuyente (RFC)</label>
                        <table>
                          <tr>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r1" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r2.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r2" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r3.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r3" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r4.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r4" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r5.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r5" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r6.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r6" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r7.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r7" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r8.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r8" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r9.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r9" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r10.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r10" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r11.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r11" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r12.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r12" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) r13.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="r13" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i1.focus(); javascript:this.value=this.value.toUpperCase();" required></td>
                          </tr>
                        </table>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label">Numero de Identificación del INE/IFE</label>
                        <table>
                          <tr>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i1" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i2.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i2" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i3.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i3" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i4.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i4" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i5.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i5" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i6.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i6" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i7.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i7" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i8.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i8" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i9.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i9" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i10.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i10" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i11.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i11" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i12.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i12" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) i13.focus()"></td>
                            <td><input type="text" class="form-control input-sm text-uppercase text-center" maxlength="1" name="i13" onfocus="this.value = ''" onkeyup="if (this.value.length == this.getAttribute('maxlength')) ine_vigencia.focus()"></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label">Vigencia INE/IFE</label>
                        <input type="text" class="form-control date-picker input-sm" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" name="ine_vigencia">
                      </div>
                      <div class="col-sm-4">
                        <label class="control-label">Credito Infonavit</label>
                        <input type="text" title="No. Credito Infonavit" data-toggle="tooltip" class="form-control input-sm" name="infonavit">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-2">
                        <label class="control-label">Pasaporte No.</label>
                        <input type="text" title="No. de Pasaporte" data-toggle="tooltip" class="form-control input-sm" name="pasaporte">
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label">Afores</label>
                        <input type="text" title="Afores" data-toggle="tooltip" class="form-control input-sm" name="afore">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label">Licencia de Manejo</label>
                        <table>
                          <tr>
                            <td><input type="text" title="No. licencia" data-toggle="tooltip" placeholder="No. Licencia" class="form-control input-sm" name="no_licencia"></td>
                            <td><input type="text" title="Tipo de Licencia" data-toggle="tooltip" placeholder="Tipo" class="form-control input-sm" name="tipo_licencia"></td>
                            <td><input type="text" class="form-control date-picker input-sm" placeholder="Vigencia" data-date-format="yyyy/mm/dd" name="vigencia_licencia"></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label">Nacionalidad</label>
                        <input type="text" title="Nacionalidad" data-toggle="tooltip" class="form-control input-sm" name="nacionalidad" value="Mexicana">
                      </div>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;ESTADO DE SALUD Y HABITOS PERSONALES</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-5">
                        <label class="control-label">¿Considera su estado de salud actual?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="salud" class="minimal" value="Bueno">&nbsp;&nbsp;Bueno&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="salud" class="minimal" value="Regular">&nbsp;&nbsp;Regular&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="salud" class="minimal" value="Malo">&nbsp;&nbsp;Malo&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label class="control-label">¿Consume Drogas?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="drogas" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="drogas" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Tipo de Sangre</label>
                        <select class="form-control input-sm" name="sangre" placeholder="" autocomplete="off">
                          <option value="" disabled selected>-- Seleccionar --</option>
                          <option value="O-">O-</option>
                          <option value="O+">O+</option>
                          <option value="A-">A-</option>
                          <option value="A+">A+</option>
                          <option value="B-">B-</option>
                          <option value="B+">B+</option>
                          <option value="AB-">AB-</option>
                          <option value="AB+">AB+</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;¿PADECE DE ALGUNA DE ESTAS ENFERMEDADES?</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-5">
                        <label class="control-label">Diabetes</label>
                        <div class="">
                          <span>
                            <input type="radio" name="diabetes" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="diabetes" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <label class="control-label">¿Se encuentra bajo tratamiento?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="tratamiento_diabetes" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="tratamiento_diabetes" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-4">
                        <label class="control-label">¿Alergía a algún medicamento?</label>
                          <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="alergia_medicamento">
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label">¿Cirugías?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="cirugias" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="cirugias" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">¿Cuantas cirugias?</label>
                          <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="cuantas_cirugias">
                      </div>
                      <div class="col-sm-3 text-center">
                        <label class="control-label">¿Alteracion en Audición?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="audicion" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="audicion" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-3">
                        <label class="control-label">¿Fuma?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="fuma" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="fuma" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">(Frecuencia x semana)</label>
                          <input type="text" title="" size="5" data-toggle="tooltip" class="form-control input-sm" name="semana_fuma">
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">¿Asma?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="asma" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="asma" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">¿Esta bajo tratamiento?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="tratamiento_asma" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="tratamiento_asma" class="minimal" value"Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>

                    </div>

                    <div class="form-group">
                      <div class="col-sm-3">
                        <label class="control-label">¿Epilepsia? (Convulsiones)</label>
                        <div class="">
                          <span>
                            <input type="radio" name="epilepsia" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="epilepsia" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">¿Bronquitis?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="bronquitis" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="bronquitis" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">¿Esta Bajo tratamiento?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="tratamiento_bronquitis" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="tratamiento_bronquitis" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">¿Alteración en la vista?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="alteracion_vista" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="alteracion_vista" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-12">
                        <label class="control-label">Otro especifique:</label>
                        <div class="bordered">
                          <textarea name="otro" class="form-control" rows="2" cols="100%"></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;ESCOLARIDAD</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-4">
                        <label class="control-label">Ultimo grado de estudios</label>
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="estudios">
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label">¿Titulo?</label>
                        <div class="">
                          <span>
                            <input type="radio" name="titulo" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="titulo" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label">Número de Cedula o Certificado</label>
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="instituto">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-6">
                        <label class="control-label">Software que domina</label>
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="software">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label">Idiomas que domina</label>
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="idiomas">
                      </div>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;EMPLEO ACTUAL Y/O ANTERIORES</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label"></label>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Actual/Anterior</label>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Anterior</label>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Anterior</label>
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Periodo</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="periodo_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="periodo_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="periodo_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Empresa</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="empresa_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="empresa_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="empresa_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Telefono</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="telefono_1" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="telefono_2" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="telefono_3" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Puesto</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="puesto_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="puesto_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="puesto_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Motivo de separación</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="separacion_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="separacion_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="separacion_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Jefe inmediato</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="jefe_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="jefe_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="jefe_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Solicitar informes</label>
                      </div>
                      <div class="col-sm-3">
                        <div class="">
                          <span>
                            <input type="radio" name="informes_1" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="informes_1" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="">
                          <span>
                            <input type="radio" name="informes_2" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="informes_2" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="">
                          <span>
                            <input type="radio" name="informes_3" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="informes_3" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;DATOS DE ANDAMIEROS/AYUDANTES</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label"></label>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Planta Actual/Anterior</label>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Anterior</label>
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Anterior</label>
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Planta</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="planta_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="planta_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="planta_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Categoria</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="categoria_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="categoria_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="categoria_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">DC-3 Actualizado</label>
                      </div>
                      <div class="col-sm-3">
                        <div class="">
                          <span>
                            <input type="radio" name="dc3_1" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="dc3_1" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="">
                          <span>
                            <input type="radio" name="dc3_2" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="dc3_2" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="">
                          <span>
                            <input type="radio" name="dc3_3" class="minimal" value="Si">&nbsp;&nbsp;Si&nbsp;&nbsp;
                          </span>
                          <span>
                            <input type="radio" name="dc3_3" class="minimal" value="No">&nbsp;&nbsp;No&nbsp;&nbsp;
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Puesto</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="puesto_planta_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="puesto_planta_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="puesto_planta_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Carnet</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="carnet_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="carnet_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="carnet_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Vigencia</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="text" class="form-control date-picker input-sm" data-date-format="yyyy/mm/dd" name="vigencia_1">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" class="form-control date-picker input-sm" data-date-format="yyyy/mm/dd" name="vigencia_2">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" class="form-control date-picker input-sm" data-date-format="yyyy/mm/dd" name="vigencia_3">
                      </div>
                    </div>

                    <div class="form-group text-center">
                      <div class="col-sm-3">
                        <label class="control-label">Cursos tomados</label>
                      </div>
                      <div class="col-sm-3">
                        <textarea name="cursos_1" rows="2" cols="100%" class="form-control input-sm"></textarea>
                      </div>
                      <div class="col-sm-3">
                        <textarea name="cursos_2" rows="2" cols="100%" class="form-control input-sm"></textarea>
                      </div>
                      <div class="col-sm-3">
                        <textarea name="cursos_3" rows="2" cols="100%" class="form-control input-sm"></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;DATOS FAMILIARES</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group col-sm-12">
                      <div class="col-sm-6">
                        <label class="control-label">Contacto de Emergencia</label>
                          <input type="text" title="Contacto de emergencia" data-toggle="tooltip" class="form-control input-sm text-center" maxlength="2" name="contacto_emergencia">
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Parentesco</label>
                        <input type="text" title="Parentesco" data-toggle="tooltip" class="form-control input-sm" name="parentesco">
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label">Teléfono</label>
                        <input type="text" title="Telefono de Emergencia" data-toggle="tooltip" class="form-control input-sm" name="tel_emergencia" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                      </div>
                    </div>

                    <div class="form-group">
                      <table class="table table-bordered table-striped table-condensed table-hover">
                        <tr class="bg-gray">
                          <th width="30%" class="text-center">Nombre</th>
                          <th width="12%" class="text-center">Se encuentra</th>
                          <th width="30%" class="text-center">Domicilio</th>
                          <th width="14%" class="text-center">Tel. Casa</th>
                          <th width="14%" class="text-center">Tel. Móvil</th>
                        </tr>
                        <tr>
                          <td><strong>Padre</strong></td>
                        </tr>
                        <tr>
                          <td>
                              <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="papa_nombre">
                          </td>
                          <td>
                            <select class="form-control input-sm" name="papa_status">
                              <option value=""></option>
                              <option value="Vive">Vive</option>
                              <option value="Finado">Finado</option>
                            </select>
                          </td>
                          <td>
                            <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="papa_direccion">
                          </td>
                          <td>
                            <input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="papa_tel_casa" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                          </td>
                          <td>
                            <input type="text" title="Telefono movil" data-toggle="tooltip" class="form-control input-sm" name="papa_tel_movil" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                          </td>
                        </tr>
                        <tr>
                          <td><strong>Madre</strong></td>
                        </tr>
                        <tr>
                          <td>
                            <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="mama_nombre">
                          </td>
                          <td>
                            <select class="form-control input-sm" name="mama_status">
                              <option value=""></option>
                              <option value="Vive">Vive</option>
                              <option value="Finado">Finado</option>
                            </select>
                          </td>
                          <td>
                            <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="mama_direccion">
                          </td>
                          <td>
                            <input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="mama_tel_casa" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                          </td>
                          <td>
                            <input type="text" title="Telefono movil" data-toggle="tooltip" class="form-control input-sm" name="mama_tel_movil" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                          </td>
                        </tr>
                        <tr>
                          <td><strong>Esposo(a)</strong></td>
                        </tr>
                        <tr style="vertical-aling: bottom;">
                          <td>
                            <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="esposo_nombre">
                          </td>
                          <td>
                            <select class="form-control input-sm" name="esposo_status">
                              <option value=""></option>
                              <option value="Vive">Vive</option>
                              <option value="Finado">Finado</option>
                            </select>
                          </td>
                          <td>
                            <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="esposo_direccion">
                          </td>
                          <td>
                            <input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="esposo_tel_casa" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                          </td>
                          <td>
                            <input type="text" title="Telefono movil" data-toggle="tooltip" class="form-control input-sm" name="esposo_tel_movil" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                          </td>
                        </tr>
                      </table>

                      <table class="table table-bordered table-striped table-condensed table-hover">
                        <tr class="bg-gray">
                          <th width="30%" class="text-center">Nombre de Hijo</th>
                          <th width="15%" class="text-center">Edad</th>
                          <th width="20%" class="text-center">¿Estudia?</th>
                          <th width="35%" class="text-center">Nivel de escolaridad actual</th>
                        </tr>
                        <tr>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="hijo_1_nombre"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="hijo_1_edad"></td>
                          <td><select class="form-control" name="hijo_1_estudia">
                            <option value=""></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                          </select> </td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="hijo_1_estudios"></td>
                        </tr>
                        <tr>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="hijo_2_nombre"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="hijo_2_edad"></td>
                          <td><select class="form-control" name="hijo_2_estudia">
                            <option value=""></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                          </select> </td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="hijo_2_estudios"></td>
                        </tr>
                        <tr>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="hijo_3_nombre"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="hijo_3_edad"></td>
                          <td><select class="form-control" name="hijo_3_estudia">
                            <option value=""></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                          </select> </td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="hijo_3_estudios"></td>
                        </tr>
                      </table>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;BENEFICIARIOS POR NOMINA</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group">
                      <table class="table table-bordered table-striped table-condensed table-hover">
                        <tr class="bg-gray text-center">
                          <th width="27%" class="text-center">Nombre completo 1</th>
                          <th width="36%" class="text-center">Domicilio Completo</th>
                          <th width="15%" class="text-center">Parentesco</th>
                          <th width="12%" class="text-center">Fecha Nac.</th>
                          <th width="15%" class="text-center">Porcentaje</th>
                        </tr>
                        <tr>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="beneficiario_1_nombre"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="beneficiario_1_domicilio"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="beneficiario_1_parentesco"></td>
                          <td><input type="text" class="form-control date-picker input-sm" data-date-format="yyyy/mm/dd" name="beneficiario_1_nacimiento"></td>
                          <td>
                            <div class="input-group">
                              <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="beneficiario_1_porcentaje">
                              <span class="input-group-addon">%</span>
                            </div>
                          </td>
                        </tr>
                        <tr class="bg-gray center">
                          <th class="text-center">Nombre completo 2</th>
                          <th class="text-center">Domicilio Completo</th>
                          <th class="text-center">Parentesco</th>
                          <th class="text-center">Fecha Nac.</th>
                          <th class="text-center">Porcentaje</th>
                        </tr>
                        <tr>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="beneficiario_2_nombre"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="beneficiario_2_domicilio"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="beneficiario_2_parentesco"></td>
                          <td><input type="text" class="form-control date-picker input-sm" data-date-format="yyyy/mm/dd" name="beneficiario_2_nacimiento"></td>
                          <td>
                            <div class="input-group">
                              <input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="beneficiario_2_porcentaje">
                              <span class="input-group-addon">%</span>
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;3 REFERENCIAS PERSONALES (No familiares)</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group">
                      <table class="table table-bordered table-striped table-condensed table-hover">
                        <tr class="bg-gray">
                          <th class="text-center" width="30%">Nombre</th>
                          <th class="text-center" width="40%">Domicilio</th>
                          <th class="text-center" width="15%">Tel. Casa</th>
                          <th class="text-center" width="15%">Tel. Movil</th>
                        </tr>
                        <tr>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="referencia_1_nombre"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="referencia_1_domicilio"></td>
                          <td><input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="referencia_1_tel_casa" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask=""></td>
                          <td><input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="referencia_1_tel_movil" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask=""></td>
                        </tr>
                        <tr>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="referencia_2_nombre"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="referencia_2_domicilio"></td>
                          <td><input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="referencia_2_tel_casa" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask=""></td>
                          <td><input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="referencia_2_tel_movil" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask=""></td>
                        </tr>
                        <tr>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="referencia_3_nombre"></td>
                          <td><input type="text" title="" data-toggle="tooltip" class="form-control input-sm" name="referencia_3_domicilio"></td>
                          <td><input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="referencia_3_tel_casa" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask=""></td>
                          <td><input type="text" title="Telefono de Casa" data-toggle="tooltip" class="form-control input-sm" name="referencia_3_tel_movil" placeholder="" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask=""></td>
                        </tr>
                      </table>
                    </div>

                    <div class="row">
                      <table width="100%">
                        <tr>
                          <td bgcolor="Coral"><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;DATOS PARA LA EMPRESA</strong></h4></td>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Estatus de la persona:</label>
                      <div class="col-sm-8">
                        <select class="form-control" name="estatus" autocomplete="off">
                          <option value=""></option>
                          <option value="Vigente">Vigente</option>
                          <option value="Inactivo">Inactivo</option>
                          <option value="Lista Negra">Lista Negra</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Calificacion:</label>
                      <div class="col-sm-8">
                        <select class="form-control" name="calificacion" data-placeholder="-- Seleccionar --" autocomplete="off">
                          <option value="" ></option>
                          <option value="1" >1</option>
                          <option value="2" >2</option>
                          <option value="3" >3</option>
                          <option value="4" >4</option>
                          <option value="5" >5</option>
                        </select>
                      </div>
                    </div>
                    <?php $query2 = $crud->Consultar_Departamentos(); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Departamento:</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="departamento" data-placeholder="-- Seleccionar --" autocomplete="off">
                            <option value="" <?php if ($data['categoria'] == ""){ echo 'selected';}?>></option>
                            <?php   while ($departamentos = mysqli_fetch_assoc($query2)) {
                              ?> <option value='<?php echo $departamentos['id_departamento']; ?>'><?php echo $departamentos['departamento']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ocupaci&oacute;n:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="ocupacion" value="Eventual" value="" autocomplete="off">
                        </div>
                    </div>
                    <?php $query3 = $crud->Consultar_Categorias(); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Categoria:</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="categoria" data-placeholder="-- Seleccionar --" autocomplete="off">
                            <option value="" <?php if ($data['categoria'] == ""){ echo 'selected';}?>></option>
                            <?php   while ($categorias = mysqli_fetch_assoc($query3)) {
                              ?> <option value='<?php echo $categorias['id_categoria']; ?>'><?php echo $categorias['categoria']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Observaciones:</label>
                      <div class="col-sm-8">
                        <textarea class="form-control" rows="4"  name="observaciones"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Fecha de ingreso:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control date-picker input-sm" data-date-format="yyyy/mm/dd" name="contrato" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Talla de Overol:</label>
                      <div class="col-sm-8">
                        <select class="form-control" name="talla" data-placeholder="-- Seleccionar --" autocomplete="off">
                          <option value="" ></option>
                          <option value="36" >36</option>
                          <option value="38" >38</option>
                          <option value="40" >40</option>
                          <option value="42" >42</option>
                          <option value="44" >44</option>
                          <option value="46" >46</option>
                        </select>
                      </div>
                    </div>

                    <legend>Documentación</legend>

                    <div class="form-group">
                      <div class="cargar-imagen-2">
                        <div class="row">
                          <label for="dacta" class="col-sm-2 control-label">
                            <img id="docSalida_1" src="images/iconos/acta.png" title="Acta de Nacimiento " data-toggle="tooltip">
                          </label>
                          <label for="dife" class="col-sm-2 control-label">
                            <img id="docSalida_2" src="images/iconos/ine.png" title="INE" data-toggle="tooltip">
                          </label>
                          <label for="dcd" class="col-sm-2 control-label">
                            <img id="docSalida_3" src="images/iconos/comp domicilio.png" title="Comprobante de Domicilio" data-toggle="tooltip">
                          </label>
                          <label for="dcurp" class="col-sm-2 control-label">
                            <img id="docSalida_4" src="images/iconos/curp.png" title="CURP" data-toggle="tooltip">
                          </label>
                          <label for="drfc" class="col-sm-2 control-label">
                            <img id="docSalida_5" src="images/iconos/rfc.png" title="RFC" data-toggle="tooltip">
                          </label>
                          <label for="dns" class="col-sm-2 control-label">
                            <img id="docSalida_6" src="images/iconos/nss.png" title="NSS" data-toggle="tooltip">
                          </label>
                        </div>
                        <input id="dacta" type="file" name="dacta">
                        <input id="dife" type="file" name="dife">
                        <input id="dcd" type="file" name="dcd">
                        <input id="dcurp" type="file" name="dcurp">
                        <input id="drfc" type="file" name="drfc">
                        <input id="dns" type="file" name="dns">
                      </div>
                    </div>


                    <!-- <div class="form-group">
                      <div align="center">
                        <label class="checkbox-inline  col-sm-2">
                          <input type="checkbox" class="" name="dacta" value="1">Acta
                        </label>
                        <label class="checkbox-inline  col-sm-2">
                          <input type="checkbox" class="" name="dife" value="1">IFE
                        </label>
                        <label class="checkbox-inline  col-sm-2">
                          <input type="checkbox" class="" name="dcd" value="1">Comp. Domicilio
                        </label>
                          <label class="checkbox-inline col-sm-2">
                          <input type="checkbox" class="" name="dcurp" value="1">CURP
                        </label>
                        <label class="checkbox-inline col-sm-2">
                          <input type="checkbox" class="" name="drfc" value="1">RFC
                        </label>
                        <label class="checkbox-inline col-sm-1">
                        <input type="checkbox" class="" name="dns" value="1" >NS
                        </label>
                      </div>
                    </div> -->

                  </div><!-- /.box body -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <input type="submit" class="btn btn-primary" name="Guardar" value="Guardar">
                </div>
                </form>
              </div>



          </div><!-- /.Modal add -->

        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->
