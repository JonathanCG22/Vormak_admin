<?php
  $r = mysqli_fetch_assoc($crud->Permiso_Acceso_Mayor());
  $max = $r['mayor'];

  $objeto->id_Acceso = $_SESSION['permisos_acceso'];
  $objeto->id_Modulo = 'Hojas de Trabajo';
  $rHT = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
  $accion = explode(",", $rHT['accion']);

  date_default_timezone_set("America/Mexico_City");/*Zona horaaria*/
?>
<link rel="stylesheet" href="css/hojaTrabajo.css">

<section class="content-header">
  <h1>
    <i class="fa fa-book"></i> <span id="titulo">Andamios Armados</span>
    <?php
    /*if ($_SESSION['permisos_acceso'] <= $max && $_SESSION['permisos_acceso'] != 0) {
      $valA = 0;

      foreach ($accion as $key => $value) {
        if ($value == 'Agregar') {
           $valA++;
        }
      }

      if ($valA > 0) { 
        //cunado el Archivo de Permiso de alguna planta que tenga el usuario aun no se pone, no dejar crear otra hoja de trabajo
        $Archivo_cargado = 0;
        $id_user = $_SESSION['id_user'];
        $r2 = mysqli_fetch_array($crud->ConsultaUsuario($id_user));

        /*Si el usuario tiene permisos a plantas/
        if($r2['planta_acceso'] != ''){ 

          include_once("libreria/mPDF/vendor/autoload.php");          
          $mpdf = new \Mpdf\Mpdf(); //_llama la libreria

          $div_permiso = explode(",", $r2['planta_acceso']);
          $ids_HT = '';

          /*Separa plantas/
          foreach ($div_permiso as $key0 => $valor) {
            //obtener ultimo registro del cliente
            $objeto->id_cliente = $valor;
            $r3 = mysqli_fetch_array($crud->folioMayor_Cliente($objeto));

            //Buscar que exista el archivo, si esta abierto solo busca el permiso de armado y si esta cerrado busca ambos
            if( ( (strpos($r3['archivosSubidos'], 'HTrabajo_FirmasArmado') !== false) && $r3['status'] == 'Abierto' ) ||
                ( (strpos($r3['archivosSubidos'], 'HTrabajo_FirmasArmado') !== false) &&
                  (strpos($r3['archivosSubidos'], 'HTrabajo_FirmasDesarmado') !== false) && $r3['status'] == 'Cerrado' )
              ){//si el dato es != ''

              //checar que exista archivo en tabla archivos (HTrabajo_FirmasArmado,HTrabajo_FirmasDesarmado)              
              $objeto->id     = $r3['id_hj'];
              $objeto->tabla  = 'hoja_trabajo';

              $div_Archivos = explode(",", $r3['archivosSubidos']);

              //Separa archivos y buscar que existan
              foreach ($div_Archivos as $key1 => $valor1) {
                $objeto->nombre = $valor1;

                if($valor1 == 'HTrabajo_FirmasArmado' || $valor1 == 'HTrabajo_FirmasDesarmado') { 
                  $r4 = mysqli_fetch_array($crud->Archivo_Requisicion($objeto));

                  if ($r4['name'] != '') {
                    //checar que el archivo tenga mas de 1 hoja   
                    $fileName = "archivos/Hojas_Trabajo/".$r4['name'];

                    //definimos el archivo pdf a leer. Nos devuelve el numero de paginas
                    $paginas = $mpdf->setSourceFile($fileName);
                    
                    if ($paginas < 2) { //Si tiene menos de 2 Hojas incrementar contador
                      $Archivo_cargado++;

                      if ($ids_HT == '') {
                        $ids_HT = $r3['id_hj'];
                      }else{
                         $ids_HT = $ids_HT.",".$r3['id_hj'];
                      }
                    }

                  }else{
                    $Archivo_cargado++;
                    
                    if ($ids_HT == '') {
                      $ids_HT = $r3['id_hj'];
                    }else{
                       $ids_HT = $ids_HT.",".$r3['id_hj'];
                    }
                  }
                }else{
                  error_log("no entro: ".$valor1);
                }
              }         
              
            }else{ //no hay archivo              
              $Archivo_cargado++;

              if ($ids_HT == '') {
                $ids_HT = $r3['id_hj'];
              }else{
                 $ids_HT = $ids_HT.",".$r3['id_hj'];
              }
            }
            
          }
        }
        
        /*if ($Archivo_cargado > 0) {
          ?><button id="Hoja_Trabajo:<?= $ids_HT ?>" class='btn btn-primary btn-social pull-right' data-toggle='tooltip' title='Agregar Hoja de Trabajo' data-dismiss="modal" style="border-color: white;" onclick="openModal(this, 'AdvertenciaA', 'Z1')">
                <i class="fa fa-plus" style="padding: 6px; height: unset;"></i> Agregar
          </button><?php //modal_advertencia

        }else{ */ ?>
        <div>
            <button id="btn-mod-1" name="view" value="view" class='btn btn-primary btn-social pull-right' data-toggle='tooltip' title="Agregar Hoja de Trabajo" onclick="openModal(null, 'addHoja_trabajo', 'G1')">
              <i class="fa fa-plus" style="padding: 6px; height: unset;"></i> Agregar
            </button> <!--AgregarHoja_trabajo-->
        </div>    <?php
        /*}
      }

      if ($_SESSION['id_user'] == '6' || $_SESSION['id_user'] == '1') {?>
        <!--Recalcula Precios y Total Piezas
        <button id="sub" name='sub' class='btn bg-navy btn-md pull-right CalculaTotalPzHT' data-toggle='tooltip' title='Calcular Total Piezas' data-dismiss="modal" style="border-color: white; " onclick="return alertModificar();">
          <i style='color:#fff' class='fa fa-upload'></i>
        </button> --><?php
      }
    }*/?>
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="?module=HojasTrabajo_Principal"><i class="fa fa-book"></i> Andamios Armados (Principal)</a>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">  <?php
      if (empty($_GET['alert'])) {
        echo "";
      }elseif ($_GET['alert'] == 1) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Hoja de Trabajo guardada correctamente.
              </div>";
      }elseif ($_GET['alert'] == 2) {
          echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon glyphicon glyphicon-remove-sign'></i> Error!</h4>
               Lo sentimos, ese folio ya existe.
              </div>";
      }elseif ($_GET['alert'] == 3) {
          echo "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-exclamation-triangle'></i> Advertencia!</h4>
               Lo sentimos, los datos no se pudieron guardar. Porfavor llenar todos los campos.
              </div>";
      }elseif ($_GET['alert'] == 4) {
          echo "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-exclamation-triangle'></i> Advertencia!</h4>
               Lo sentimos, los datos no se pudieron guardar. Porfavor llenar todos los campos y verifique la fecha de Desarmado, no debe ser mayor a la fecha de Armado.
              </div>";
      }elseif ($_GET['alert'] == 5) {
          echo "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-exclamation-triangle'></i> Advertencia!</h4>
               Lo sentimos, los datos no se pudieron guardar. Porfavor verifique la fecha de Desarmado, no debe ser mayor a la fecha de Armado.
              </div>";
      }elseif ($_GET['alert'] == 6) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Tabla de Trabajo guardada correctamente.
              </div>";
      }elseif ($_GET['alert'] == 7) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Los datos han sido guardados exitosamente.
              </div>";
      }elseif ($_GET['alert'] == 8) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Se a creado el folio clon con exito. El folio original se a modificado con exito.
              </div>";
      }elseif ($_GET['alert'] == 9) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Se a creado el corte parcial con exito. Y se a creado el clon del folio.
              </div>";
      }elseif ($_GET['alert'] == 10) {
          echo "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-exclamation-triangle'></i> Advertencia!</h4>
               Lo sentimos, no se puedo crear el corte parcial, asegurece que este Abierto y tenga fecha de corte.
              </div>";
      }elseif ($_GET['alert'] == 11) {
          echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
               Se guardaron con Exito los Archivos.
              </div>";
      }elseif ($_GET['alert'] == 12) {
          echo "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-exclamation-triangle'></i> Advertencia!</h4>
               Lo sentimos, No se guardaron los Archivos, intentelo de nuevo.
              </div>";
      }?>

      <ul class="nav nav-tabs ">
        <li role="presentation" <?php if (isset($_GET['id']) and $_GET['id'] == 'HA') { echo "class='active'" ;} ?> >
          <a href="?module=hojas_trabajo&id=HA">Andamios Armados</a>
        </li>

        <?php
        if ($_SESSION['permisos_acceso'] <= $max && $_SESSION['permisos_acceso'] != 0) {
          $valD = 0; $valBq = 0;
          foreach ($accion as $key => $value) {
            if ($value == 'Descargar') {
               $valD++;
            }

            if ($value == 'Bloquear') {
               $valBq++;
            }
          }

          if ($valD > 0) { ?>
            <li role="presentation" <?php if (isset($_GET['id']) and ($_GET['id'] == 'RP' OR $_GET['id'] == 'RP2' OR $_GET['id'] == 'RP3' OR $_GET['id'] == 'RP4')) { echo "class='active'" ;} ?> >
              <a>Reportes</a>

              <ul class="dropdown-menu">
                <li role="presentation" <?php if (isset($_GET['id']) and ($_GET['id'] == 'RP')) { echo "class='active'" ;} ?> >
                  <a href="?module=Reporte_HT&id=RP&op=0" data-toggle='tooltip' data-placement="right" data-container="body" title='Muestra los Datos de Todos los Andamios que Cumplan con el Filtro.'>Reporte Diario de Planta</a>
                </li>
                <li role="presentation" <?php if (isset($_GET['id']) and ($_GET['id'] == 'RP2')) { echo "class='active'" ;} ?>>
                  <a href="?module=Reporte_HT&id=RP2&op=0" data-toggle='tooltip' data-placement="right" data-container="body" data-html="true" title='El Excel Nuestra el Total de Piezas que tiene cada Codigo.<br> Se Filtra por Cliente y Proyecto.'>Total de Piezas Armadas </a>
                </li>
                <li role="presentation" <?php if (isset($_GET['id']) and ($_GET['id'] == 'RP3')) { echo "class='active'" ;} ?>>
                  <a href="?module=Reporte_HT&id=RP3&op=0" data-toggle='tooltip' data-placement="right" data-container="body" data-html="true" title='Nuestra el Total de Piezas que tiene cada Codigo. Se Filtra por Cliente, Proyecto y Año.<br> Y Muestra una Grafica de Barras donde muestra las Piezas por Codigo.'>Total de Armados por Año </a>
                </li>
                <li role="presentation" <?php if (isset($_GET['id']) and ($_GET['id'] == 'RP4')) { echo "class='active'" ;} ?>>
                  <a href="?module=Reporte_HT&id=RP4&op=0" data-toggle='tooltip' data-placement="right" data-container="body" data-html="true" title='Andamios que aun Siguen Armados desde 01/Ene/2021 a la Fecha Actual, por Proyecto.<br> Toma en Cuanta el Costo Hasta el Día Actual.'>Reporte de Andamios Armados por Proyecto </a>
                </li>
                <li role="presentation" <?php if (isset($_GET['id']) and ($_GET['id'] == 'RP5')) { echo "class='active'" ;} ?>>
                  <a href="?module=Reporte_HT&id=RP5&op=0" data-toggle='tooltip' data-placement="right" data-container="body" data-html="true" title=''>Reporte de piezas de andamio por rango </a>
                </li>
              </ul>

            </li><?php
          }

          if ($valBq > 0) { ?>
            <li role="presentation" <?php if (isset($_GET['id']) and $_GET['id'] == 'BF') { echo "class='active'" ;} ?> >
              <a href="?module=BloqueoF&id=BF"><i class="fa fa-lock fa-lg"></i> Campos Folios</a>
            </li> <?php
          }
        }?>
      </ul>

      <div class="box box-teal-primario">

        <div class="box-body">
          <div class="table-responsive">
              <table id="HojaTrabajo" class="table table-bordered table-striped table-hover table-condensed sizeResponsivoG" style="vertical-align: middle;">
                  <thead class="bg-teal-primary">
                    <tr>
                      <th class="text-center" style="width: 100px">Folio</th>
                      <th class="text-center" style="width: 100px">N° Proyecto</th>
                      <th class="text-center" style="width: 100px">SP</th>
                      <th class="text-center" style="width: 150px">Cliente</th>
                      <th class="text-center" style="width: 170px">Área</th>
                      <th class="text-center" style="width: 170px">Equipo</th>
                      <!--<th class="text-center" style="width: 100px">Identificador</th>                      Editado-->
                      <th class="text-center" style="width: 200px">Usuario</th>
                      <th class="text-center" style="width: 120px">Fecha Real Armado</th>
                      <th class="text-center" style="width: 120px">Fecha Solicitud Desarmado</th>              <!--Editado-->
                      <th class="text-center" style="width: 120px">Fecha Real Desarmado</th>
                      <th class="text-center" style="width: 120px">Total de Piezas</th>
                      <th class="text-center" style="width: 100px">Días de Renta</th>
                      <th class="text-center" style="width: 100px">Renta Diaria</th>

                      <th class="text-center" style="width: 200px">Total de Renta</th>
                      <th class="text-center" style="width: 200px">Mano de Obra</th>
                      <th class="text-center" style="width: 200px">Costo Total</th>
                      <th class="text-center" style="width: 2%">Status Andamio</th>
                      <th class="text-center" style="width: 2%">Status Sistema</th>

                      <?php
                      if ($_SESSION['id_user'] == '1' || $_SESSION['id_user'] == '6' || $_SESSION['id_user'] == '8' || $_SESSION['permisos_acceso'] == 2 || $_SESSION['permisos_acceso'] == 4) {
                        ?><th class="text-center" style="width: 6%">Modificado</th><?php
                      }?>

                      <th class="text-center" style="width: 6%"></th>
                    </tr>
                  </thead>

                  <tbody><?php
                    if ($_SESSION['permisos_acceso'] == 5 || $_SESSION['permisos_acceso'] == 12 || $_SESSION['permisos_acceso'] == 13) { //Aux.Ventas o ventas
                      $objeto->user  = $_SESSION['planta_acceso'];
                      $objeto->N = 2;
                    }else{
                      $objeto->N = 1;
                    }

                    $fecha_actual   = date("Y/m/d");
                    $objeto->rango  = date("Y");
                    $objeto->rango2 = date("Y",strtotime($fecha_actual."- 1 year"));
                    $objeto->Fecha  = date("Y/m",strtotime($fecha_actual."- 1 month"));

                    $query = $crud->consultarhoja_trabajo2($objeto);

                    $n = 1;

                    while ($data = mysqli_fetch_array($query)) {
                      // $objeto->usuarioID = $data['userC_id'];
                      // $user = mysqli_fetch_array($crud->obtenDTuser($objeto));
                      
                      if ($data['desmontaje'] != '') {                                                      /*EDITADO*/
                        $SolucitudDesmontaje = date("d-m-Y", strtotime($data['desmontaje']));
                      }else{
                        $SolucitudDesmontaje = '';
                      }                                                                                     /*EDITADO*/

                      if ($data['fchRarmado'] != '') {
                        $montaje = date("d-m-Y", strtotime($data['fchRarmado']));
                      }else{
                        $montaje = '';
                      }

                      if ($data['fchRdesarmado'] != '') {
                        $desmontaje = date("d-m-Y", strtotime($data['fchRdesarmado']));
                      }else{
                        $desmontaje = '';
                      }

                      if ($data['fchRarmado'] != '' && $data['fchRdesarmado'] == '') {

                        $datetimeM        = date_create($montaje);
                        $datetimeD        = date_create(date("d-m-Y"));

                        if ($datetimeM > $datetimeD) {      //CARLOS
                          $dias_utilizados = 0;
                        }else{
                          $diferencia       = date_diff($datetimeM, $datetimeD);
                          $dias             = $diferencia->format('%a');
                          $dias_utilizados  = $dias + 1;
                        }

                        

                        $totalx_drenta    = $data['totalrentaD_andamio'] * $dias_utilizados;
                        $totalx_diasrenta = number_format($totalx_drenta, 2, '.', ',');
                        $CostoT           = $totalx_drenta + $data['mano_obra'];
                        $costoTotal       = number_format($CostoT, 2, '.', ',');
                        $colors           = '#16ca00';

                      }else{
                        $dias_utilizados = $data['dias_utilizados'];
                        $totalx_diasrenta = number_format($data['totalx_diasrenta'], 2, '.', ',');
                        $costoTotal       = number_format($data['total'], 2, '.', ',');
                        $colors = 'black';
                      }

                      if ($data['mano_obra'] != '0.00') { $colorsMO = 'black'; }
                      else{ $colorsMO = 'red'; }

                      if ($data['TotalFacturado'] != '0.00') { $colorsTF = 'black'; }
                      else{ $colorsTF = 'red'; }

                      if ($data['statusVenta'] == 'Pagado') {
                        $TotalPagado = $data['TotalFacturado'];
                      }else{
                        $TotalPagado = 0.00;
                      }

                      if ($TotalPagado != '0.00') { $colorsTP = 'black'; }
                      else{ $colorsTP = 'red'; }

                      if ($data['update_RentaDiaria'] == 1) {
                        $BG_RentaD = 'repeating-linear-gradient(180deg, #ffa5008a, #efff0038 125px);';
                      }else{
                        $BG_RentaD = 'transparent;';
                      }

                      if ($data['update_porDiasRenta'] == 1) {
                        $BG_xDiasR = 'repeating-linear-gradient(180deg, #ffa5008a, #efff0038 125px);';
                      }else{
                        $BG_xDiasR = 'transparent;';
                      }

                      if($data['cancelado'] == 1){
                        $BG_cancelado = '#ffdfdf';
                      }else{
                        $BG_cancelado = '';
                      }

                      //$Fch_creado = explode(" ", $data["creado"]);
                      ?>
                      <tr style="background: <?= $BG_cancelado ?>;">
                        <td class="text-center"><?= RecortarFolio($data['folio']); ?></td>
                        <td class="text-center"><?= $data['n_proyecto']; ?></td>
                        <td class="text-center"><?= $data['sp']; ?></td>
                        <td class="text-center"><?= $data['cliente']; //$user['cliente']; ?></td>
                        <td class="text-center"><?= $data['area']; ?></td>

                        <td class="text-center"><?= $data['equipo']; ?></td>
                        <!--<td class="text-center"><= $data['tag4']; ?></td>                              Editado-->
                        <td class="text-center"><?= $data['usuario'];//$user['nombre_userC']; ?></td>
                        <td class="text-center"><?= $montaje ?></td>
                        <td class="text-center"><?= $SolucitudDesmontaje ?></td>                           <!--Editado-->
                        <td class="text-center"><?= $desmontaje ?></td>

                        <td class="text-center"><?= number_format($data['totalpz_andamio'], 0, '.', ','); ?> pz.</td>
                        <td class="text-center" style="color: <?=$colors ?>"><?= $dias_utilizados; ?></td>
                        <td class="text-center" style=" background:  <?= $BG_RentaD ?>;">
                            <div class="input-group" style="min-width: -webkit-fill-available; min-width: -moz-available;">
                                <span class="input-group-addon" style="background: #5a901b00; color: black; border-color: transparent; line-height: 0; width: 10px;">$</span>
                                <label class="precios" style="font-weight: normal;"><?= number_format($data['totalrentaD_andamio'], 2, '.', ','); ?></label>
                            </div>
                        </td>

                        <td class="text-center" style="color: <?=$colors ?>;  background: <?= $BG_xDiasR ?>;">
                            <div class="input-group" style="min-width: -webkit-fill-available; min-width: -moz-available;">
                                <span class="input-group-addon" style="background: #5a901b00; color: black; border-color: transparent; line-height: 0; width: 10px;">$</span>
                                <label class="precios" style="font-weight: normal;"><?= $totalx_diasrenta; ?></label>
                            </div>
                        </td>

                        <td class="text-center" style="color: <?=$colorsMO ?>;">
                          <div class="input-group" style="min-width: -webkit-fill-available; min-width: -moz-available;" data-toggle="tooltip" data-html="true" title="Serv. Armado: <strong>$ <?= number_format($data['Mano_Obra_SA'], 2, '.', ',') ?></strong> <br> Serv. Desarmado: <strong>$ <?= number_format($data['Mano_Obra_SD'], 2, '.', ',') ?></strong">
                            <span class="input-group-addon" style="background: #5a901b00; color: black; border-color: transparent; line-height: 0; width: 10px;">$</span>
                            <label class="precios" style="font-weight: normal;"><?= number_format($data['mano_obra'], 2, '.', ','); ?></label>
                          </div>
                        </td>

                        <td class="text-center" style="color: <?=$colors ?>;">
                            <div class="input-group" style="min-width: -webkit-fill-available; min-width: -moz-available;">
                                <span class="input-group-addon" style="background: #5a901b00; color: black; border-color: transparent; line-height: 0; width: 10px;">$</span>
                                <label class="precios" style="font-weight: normal;"><?= $costoTotal; ?></label>
                            </div>
                        </td>

                        <?php
                        if ($data['status'] == "Abierto") {
                          ?><td class="text-center"><p class="etq BGverde"><?= $data['status']; ?></p></td><?php
                        }else if ($data['status'] == "Cerrado") {
                          ?><td class="text-center"><p class="etq BGrojo"><?= $data['status']; ?></p></td><?php
                        }else{
                          ?><td class="text-center"><?= $data['status']; ?></td><?php
                        }

                        if($data['cancelado'] == '1'){
                          ?><td class="text-center">
                              <strong id="alert_comentario<?= $n ?>">Cancelado</strong>
                              <!-- función "preg_replace" para remover todos los saltos de linea y reemplazarlos por espacios, trim quita espacios en blanco al inicio y final de la cadena -->
                              <button class="text-danger" type="button" onclick="alert_cmentario(<?= $n ?>,'<?= trim(preg_replace('/\s+/', ' ',$data['comentario']))?>',1);" data-toggle='tooltip' title="Ver más" style="background: transparent; border-color: transparent;">
                                <i style="vertical-align: middle; color: #08c;" class="glyphicon glyphicon-eye-open"></i>
                              </button><?php

                        }else if($data['Corte_Parcial'] == '2'){
                          ?><td class="text-center">
                              <strong id="alert_comentario<?= $n ?>">Corte por Material</strong>
                              <button class="text-danger" type="button" onclick="alert_cmentario(<?= $n ?>,'Corte de Material del Folio <?= RecortarFolio($data['MostrarFolio']) ?>',1);" data-toggle='tooltip' title="Ver más" style="background: transparent; border-color: transparent;">
                                <i style="vertical-align: middle; color: #08c;" class="glyphicon glyphicon-eye-open"></i>
                              </button><?php

                        }else{
                          ?><td class="text-center" id="alert_comentario<?= $n ?>">
                              <strong id="alert_comentario<?= $n ?>">En Uso</strong>
                              <?php

                              if ($data['comentario'] != '') { ?> <!--  nl2br sustitulle salto de linea por <br/> -->
                                  <button class="text-danger" type="button" onclick="alert_cmentario(<?= $n ?>,'<?= trim(preg_replace('/\s+/', ' ',$data['comentario']))?>');" data-toggle='tooltip' title="Ver más">
                                    <i style="color: #08c;" class="glyphicon glyphicon-eye-open"></i>
                                  </button> <?php
                              } 
                        }
                            
                        //EDITADO
                        if( (strpos($data['archivosSubidos'], 'HTrabajo_FirmasDesarmado') !== false ) && (strpos($data['archivosSubidos'], 'HTrabajo_Foto') !== false ) ){  //si tiene archivo desarmado y foto
                            $titulo = 'Archivos Completos';
                            $colorLabel = 'green';
                        }else if( (strpos($data['archivosSubidos'], 'HTrabajo_FirmasDesarmado') === false ) && (strpos($data['archivosSubidos'], 'HTrabajo_Foto') !== false ) ){
                            $titulo = 'Falta Archivo de Desarmado';
                            $colorLabel = 'blue';
                        }else if( (strpos($data['archivosSubidos'], 'HTrabajo_FirmasDesarmado') !== false ) && (strpos($data['archivosSubidos'], 'HTrabajo_Foto') === false ) ){
                            $titulo = 'Falta Fotos';
                            $colorLabel = 'blue';
                        }else{
                            $titulo = 'Sin Archivos';
                            $colorLabel = 'red';
                        }
                        ?>
                            <label class="text-center" style="font-size: 11px; color: <?= $colorLabel ?>;"><?= $titulo ?></label>

                            </td><?php

                        if ($_SESSION['id_user'] == '1' || $_SESSION['id_user'] == '6' || $_SESSION['permisos_acceso'] == 2 || $_SESSION['permisos_acceso'] == 4) {
                          if ($data['modificado'] != '') {
                            ?><th class="text-center"><?= $data['modificado']; ?></th><?php
                          }else{
                            ?><th class="text-center"><?= $data['creado']; ?></th><?php
                          }

                        }?>

                        <th class="text-center">
                           <input type="hidden" id="id_<?php echo $n ?>" name="id_<?php echo $n ?>" value="<?php echo $data['id_hj']; ?>">
                           <div><?php
                             if ($_SESSION['permisos_acceso'] <= $max && $_SESSION['permisos_acceso'] != 0) {
                                $valM = 0; $valD = 0; $valC = 0;

                                foreach ($accion as $key => $value) {
                                  if ($value == 'Modificar') {
                                     $valM++;
                                  }
                                  if ($value == 'Descargar') {
                                     $valD++;
                                  }
                                  if ($value == 'Cancelar') {
                                     $valC++;
                                  }
                                }
                                
                                //--MODIFICAR-->
                                if ($valM > 0 && $data['cancelado'] != '1' && $data['statusVenta'] != 'Facturado' && $data['statusVenta'] != 'Cadenas-Productivas' && $data['statusVenta'] != 'Pagado') { ?>
                                      <button type= "button" name="view" value="view" id="<?php echo $data['id_hj']; ?>:modificar:<?php echo $_SESSION['id_user'] ?>:<?php echo $_SESSION['permisos_acceso']?>" class='btn btn-primary btn-sm ModificarHoja_trabajo' style='margin-right:5px; margin-top: 5px;' data-toggle='tooltip' title="Modificar Hoja Trabajo">
                                        <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                      </button><?php
                                }
                                
                                //--PDF-->
                                if ($valD > 0) { ?>
                                  <a class='btn btn-danger btn-sm'  style='margin-right:5px; margin-top: 5px;' href='modules/hojas_trabajo/HT_Formato/PDF2.php?HT=<?= $data['id_hj'] ?>'  title='Abrir como PDF' data-toggle='tooltip' target='_blank'>
                                    <i class="fa fa-file-pdf"></i>
                                  </a><?php
                                } ?>
                                
                                <!--SUBIR ARCHIVOS-->
                                <?php
                                if($data['cancelado'] != '1' && $data['Corte_Parcial'] != 1){ ?>
                                    <button type="button" id="<?php echo $data['id_hj']; ?>" class="btn bg-teal-primary btn-sm" data-toggle="tooltip" title="Subir Archivos" style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'SubirArchivos', 'G5')">
                                        <i style='color:#fff' class="fas fa-file-upload" prefix="fas"></i>
                                    </button> <?php
                                } ?>
                                    
                                <!--CORTE PARCIAL-->
                                <?php
                                if ($valM > 0 && $data['status'] != 'Cerrado') { ?>
                                    <!--<button type= "button" name="view" value="view" id="<php echo $data['id_hj']; ?>:corte:<php echo $_SESSION['id_user'] ?>:<php echo $_SESSION['permisos_acceso']?>" class='btn btn-warning btn-sm ModificarHoja_trabajo' style='margin-right:5px; margin-top: 5px;' data-toggle='tooltip' title="Corte Parcial de Material">
                                        <i style='color:#fff' class='fa fa-cut'></i>
                                    </button>
                                    <button type= "button" name="view" value="view" id="<php echo $data['id_hj']; ?>:<php echo $_SESSION['id_user'] ?>" class='btn bg-teal-primary btn-sm' style='margin-right:5px; margin-top: 5px;' data-toggle='tooltip' title="Corte Parcial" onclick="openModal(this, 'CorteParcial', 'G4')">
                                        <i style='color:#fff' class='fas fa-clone'></i>
                                    </button>-->
                                      
                                    <div class="btn-group" style="padding-top: 5px;">
                                        <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" title="Corte Parcial" style='margin-right:5px; margin-top: 5px;'>
                                            <i style='color:#fff' class="fa fa-cut" prefix="fas"></i>
                                            <span class="caret"></span>
                                        </button>
        
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" style="background: repeating-linear-gradient(180deg, #a6a6a6, #fff 180px); color: white;">
                                            <li id="<?php echo $data['id_hj']; ?>:corte:<?php echo $_SESSION['id_user'] ?>:<?php echo $_SESSION['permisos_acceso']?>" class='ModificarHoja_trabajo'>
                                                <a class='negro' href="#">Corte Parcial de Material</a>
                                            </li>
                                            <!--  <li class="divider"></li> -->
                                            <li id="<?php echo $data['id_hj']; ?>:<?php echo $_SESSION['id_user'] ?>" onclick="openModal(this, 'CorteParcial', 'G4')">
                                                <a class='negro' href="#">Corte Parcial por Clon</a>
                                            </li>
                                        </ul>
                                    </div>
                                      
                                      <?php
                                }
                              }

                              $separar = explode('-', $data['folio']);

                              $objeto->Folio = $separar[0].'-'.$separar[1].'-';
                              $F = mysqli_fetch_array($crud->Mostrar_FoliosConClon($objeto));

                              if($data['statusVenta'] == 'Sin-OC' || $data['statusVenta'] == 'Sin-SP'){
                                $Caratula = 'NO';
                              }else{
                                $Caratula = 'SI';
                              }

                              //Solo mostrar cuando: tenga permiso de Cancelar, no este cancelado el folio, no sea un folio clon, Que no tenga clones, y no no este en una caratula

                              if ($valC > 0 && $data['cancelado'] != '1' && $data['Corte_Parcial'] == '0' && $F['folio'] == '' && $Caratula == 'NO'){ /* Quitar cuando se quiera cancelar un clon (&& $data['Corte_Parcial'] == '0' && $F['folio'] == '')*/ ?>
                                <!--checar que no este en caratula, no tenga clon, no sea clon-->
                                <div class="btn-group" style="padding-top: 5px;">
                                  <button type="button" class="btn bg-purple btn-sm dropdown-toggle" data-toggle="dropdown" title="Cancelar Folio" style='margin-right:5px; margin-top: 5px;'>
                                    <i style='color:#fff' class="fas fa-ban" prefix="fas"></i>
                                    <span class="caret"></span>
                                  </button>

                                  <ul class="dropdown-menu dropdown-menu-right" role="menu" style="background: repeating-linear-gradient(180deg, #a6a6a6, #fff 180px); color: white;">
                                      <li id="<?php echo $data['id_hj']; ?>,<?php echo $_SESSION['permisos_acceso'] ?>:<?php echo $_SESSION['id_user'] ?>"onclick="openModal(this, 'cancelarFolio', 'G2')">
                                        <a class='negro' href="#">Cancelacion por Error</a>
                                      </li>
                                     <!--  <li class="divider"></li> -->
                                      <li id="<?php echo $data['id_hj']; ?>,<?php echo $_SESSION['permisos_acceso'] ?>:<?php echo $_SESSION['id_user'] ?>"onclick="openModal(this, 'clonarFolio', 'G3')">
                                        <a class='negro' href="#">Cancelacion con Clonacion a Proyecto</a>
                                      </li>
                                  </ul>
                                </div>
                                <?php
                              }?>
                            </div>
                        </th>
                      </tr><?php
                      $n++;
                    }?>
                  </tbody>
              </table>
          </div>

          <!-- Modal add -->
          <div class="modal fade" id="modal_addHoja_trabajo" data-backdrop="static"><!-- ModalAdd -->
              <div class="modal-dialog modal-lg">
                <div class="modal-content"  id="modal-addHoja_trabajo"><!-- modal -->

                </div>
              </div>
          </div><!-- /.Modal add -->

           <!-- Modal ver_HojaTrabajo y Modificar_HojaTrabajo(Formato) -->
          <div class="modal fade" id="modal-HTF" data-backdrop="static">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" id="modal-HT">

                </div>
              </div>
          </div><!-- /.Modal -->

          <!--Modal resultado -->
          <div class="modal fade" id="mostrarmodal" data-backdrop="static">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" id="modalresultado">

                </div>
             </div>
          </div>

          <!--Modal cancelar folio -->
          <div class="modal fade" id="modal_cancelarFolio" data-backdrop="static">
              <div class="modal-dialog modal-md">
                <div class="modal-content" id="modal-cancelarFolio">

                </div>
             </div>
          </div>
          <!--Modal cancelar folio -->
          <div class="modal fade" id="modal_clonarFolio" data-backdrop="static">
              <div class="modal-dialog modal-md">
                <div class="modal-content" id="modal-clonarFolio">

                </div>
             </div>
          </div>
          <!--Modal corte parcial -->
          <div class="modal fade" id="modal_CorteParcial" data-backdrop="static">
              <div class="modal-dialog modal-md">
                <div class="modal-content" id="modal-CorteParcial">

                </div>
             </div>
          </div>
          
          <!--Modal Subir Archivos -->
          <div class="modal fade" id="modal_SubirArchivos" data-backdrop="static">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" id="modal-SubirArchivos">

                </div>
             </div>
          </div>

          <!-- Modal Mdl_advertencia-->
          <div class="modal fade" id="modal_AdvertenciaA"><!-- Mdl_advertencia -->
              <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content"  id="modal-AdvertenciaA"><!-- Mdl-advertencia -->
                  
                </div>
              </div>     
          </div>

        </div>
      </div><!--box-body-->
    </div>
  </div>
</section>

<?php
function RecortarFolio($nFolio){
  $separaFoli = explode("-", $nFolio);
  $Folio = '';

  for($i=1;$i<count($separaFoli);$i++){

    if ($Folio == '') {
      if( strpos($separaFoli[1], 'N') !== false){ //Si encuentra una N es folio nuevo
        preg_match('/[0-9]+/', $separaFoli[0], $nunProyecto); //muestra los primeros numeros en la cadena ($nunProyecto[0])
        $Folio = $nunProyecto[0]."-".$separaFoli[$i];
      }else{
        $Folio = $separaFoli[$i];
      }
    }else{
      $Folio = $Folio."-".$separaFoli[$i];
    }
  }

  return $Folio;
} ?>

<script src="http://momentjs.com/downloads/moment.min.js"></script><!--para la diferencia de fecha-->
<script type="text/javascript" src="modules/hojas_trabajo/HT_Formato/mostrarDatos.js?v=<?=VERSION?>"></script>
