<?php
  $r = mysqli_fetch_assoc($crud->Permiso_Acceso_Mayor());
  $max = $r['mayor'];
?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-home icon-title"></i> Inicio
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p style="font-size:15px">
            <i class="icon fa fa-user"></i> Bienvenido <strong><?php echo $_SESSION['name_user']; ?></strong> a la aplicación Administrativa.
          </p>
        </div>
      </div>
    </div>
    <?php
    if ($_SESSION['permisos_acceso'] <= $max && $_SESSION['permisos_acceso'] != 0) {

      $objeto->id_Acceso = $_SESSION['permisos_acceso'];
      ?>

      <div class="row">
        <!-- Datos de Personal -->
       <?php
        $objeto->id_Modulo = 'Datos de Personal';
        $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
        $accion = explode(",", $r['accion']);
        $valV = 0; $valA = 0;

        foreach ($accion as $key => $value) {
          if ($value == 'Ver') {
             $valV++;
          }
          if ($value == 'Agregar') {
             $valA++;
          }
        }

        if ($valV > 0) {  /*?>
        
          <div class="col-lg-3 col-xs-6">
            <div style="background: linear-gradient(30deg, #00BCD4, #61e0ffd4);" class="small-box etiqueta"><!-- background-color:#00c0ef; -->
              <div class="inner">
                <?php
                    $query = $crud->Num_Empleados();
                    $data = mysqli_fetch_assoc($query);
                ?>
                <h3><?php echo $data['numero']; ?></h3>
                <p>Datos de Personal</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <?php
              if ($valA > 0) {
                ?><a href="?module=personal" class="small-box-footer" title="Ver" data-toggle="tooltip"><i class="fa fa-eye"></i></a><?php
              }else{
                ?><a class="small-box-footer"><i class="fa"></i></a><?php
              }?>
            </div>
          </div><!-- ./col --><?php
        }?>

        <!-- Proyectos Abiertos -->
        <?php
        $objeto->id_Modulo = 'Proyectos';
        $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
        $accion = explode(",", $r['accion']);
        $valV = 0; $valA = 0;

        foreach ($accion as $key => $value) {
          if ($value == 'Ver') {
             $valV++;
          }
        }
        if ($valV > 0) { ?>
          <div class="col-lg-3 col-xs-6">
            <div style="background: linear-gradient(30deg, #00a65a, #00d975d4);" class="small-box etiqueta"><!-- background-color:#00a65a; -->
              <div class="inner">
                <?php
                    $query = $crud->Num_ProyectosAbiertos();
                    $data = mysqli_fetch_assoc($query);
                ?>
                <h3><?php echo $data['total']; ?></h3>
                <p>Proyectos Abiertos</p>
              </div>
              <div class="icon">
                <i class="fa fa-folder"></i>
              </div>
                <a href="?module=catalogo_proyectos" class="small-box-footer" title="Ver" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
            </div>
          </div><!-- ./col --><?php
        }?>

        <!-- Eventos Proximos -->
        <?php
        $objeto->id_Modulo = 'Inicio';
        $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
        $accion = explode(",", $r['accion']);
        $valV = 0; $valA = 0;

        foreach ($accion as $key => $value) {
          if ($value == 'Ver') {
             $valV++;
          }
        }
        if ($valV > 0) { ?>
          <div class="col-lg-3 col-xs-6">
            <div style="background: linear-gradient(30deg, #f39c12, #ffc76ed4);" class="small-box etiqueta"><!-- background-color:#f39c12; -->
              <div class="inner">

                <p style="font-size: 28px;"><strong>Proximamente</strong></p>
                <p>Eventos Proximos</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                <a href="?module=calendario" class="small-box-footer" title="Calendario" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
            </div>
          </div><!-- ./col --><?php
        }?>

        <!-- Proximamente!! -->
        <?php
        $objeto->id_Modulo = 'Inicio';
        $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
        $accion = explode(",", $r['accion']);
        $valV = 0; $valA = 0;

        foreach ($accion as $key => $value) {
          if ($value == 'Ver') {
             $valV++;
          }
        }
        if ($valV > 0) { ?>
          <div class="col-lg-3 col-xs-6">
            <div style="background: linear-gradient(30deg, #dd4b39, #ff5843d4);" class="small-box etiqueta"><!-- background-color:#dd4b39; -->
              <div class="inner">

                <h3 style="color: transparent;">-</h3>
                <p>Proximamente!!</p>
              </div>
              <div class="icon">
                <i class="fa fa-clone"></i>
              </div>
              <?php
                $val = 0;
                foreach ($accion as $key => $value) {
                  if ($value == 'Descargar') {
                     $val++;
                  }
                }

                if ($val > 0) {
                  ?><a href="" class="small-box-footer" title="Imprimir" data-toggle="tooltip"><i class="fa fa-print"></i></a><?php
                }else {
                  ?><a class="small-box-footer"><i class="fa"></i></a><?php
                }
                */
              ?>
            </div>
          </div><!-- ./col --><?php
        }?>
      </div><!-- /.row --><?php
    }?>
  </section><!-- /.content -->
