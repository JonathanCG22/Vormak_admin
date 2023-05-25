<?php
session_start();

define('VERSION','10.5');//para actualizar la cache en los js

include_once "config/conexion.php";
$objeto = new Objeto;
$crud = new CRUD;
?>
<!DOCTYPE html>
<html>
<head>
  <style media="screen">
  input:invalid, select:invalid{
    box-shadow: 0px 0px 1px 1px red;
  }
  </style>
  <meta charset="utf-8">

  <title>Admin-Vormak | Principal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Icono -->
  <link rel="shortcut icon" href="img/icono.png" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.20/fc-3.3.0/datatables.min.css"/>

  <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/> --JS--1.12.1-->
  <link rel="stylesheet" type="text/css" href="bower_components/scrips/css/jquery.dataTables.min.css?v=<?=VERSION?>"/>
    <!--Para seleccionar fila en tablas-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"/>
      <!--Para los botones de descarga en pdf,excel,imprecion..-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"/>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css"/>

  <!-- <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css?v=<?=VERSION?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"><!--JS*-->
  <!--  <link rel="stylesheet" href="bower_components/jquery-ui/themes/vader/jquery-ui.css">JS*-->
  <link rel="stylesheet" href="css/style2.css?v=<?=VERSION?>"><!--JS*-->
  <link rel="stylesheet" href="css/style3.css"> <!-- Carlos Zavala -->
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css"><!-- Carlos Zavala -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-black sidebar-mini sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo" target='_blank'><!--PUSE link-->
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="img/logo_mini_chacon.jpg" width="80%" alt="Logo"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="img/logo_inicio.jpg"  height="40px" alt="Logo"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
         <i class="fa fa-bars"></i>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <input type="hidden" id="id_user" value="<?= $_SESSION['id_user'] ?>:<?= $_SESSION['vista'] ?>">
          <?php
            //include "Notificaciones/view.php";

            include "top-menu.php";
          ?>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Menu Lateral -->
  <aside class="main-sidebar menuScroll">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <?php include "sidebar-menu.php" ?>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <?php include "content.php" ?>

    <!-- Mensaje para Cerrar Sesion -->
    <div class="modal fade" id="logout">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-sign-out-alt"></i> Salir</h4>
            </div>
            <div class="modal-body">
                <p>¿Seguro que quieres salir? </p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-danger" href="logout.php">Si, Salir</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.2
    </div>
    <strong>Copyright &copy; 2019 <a href="https://www.vormak.com">Vormak Andamios</a>.</strong> Todos los derechos reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-cogs"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab"></div>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <!--<div class="control-sidebar-bg"></div>-->
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>JS*--Para corregir error de compativilidad al usar autocomplete-->

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.20/fc-3.3.0/datatables.min.js"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js?v=<?=VERSION?>"></script>  <!--Se suvio PORQUE ELIMINABA LOS BOTONES, si estaba abajo-->
  
   <!--Para seleccionar fila en tablas-->
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
   <!--Para los botones de descarga en pdf,excel,imprecion..-->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>

<!-- <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Input mask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script defer src="bower_components/font-awesome/js/all.min.js"></script>

<!-- Chart -->
<script src="bower_components/chart.js/Chart.bundle.js"></script><!--LO PUSE-->
<script src="bower_components/chart.js/samples/utils.js"></script><!--LO PUSE-->

<script type="text/javascript" src="alerts.js"></script>
<script type="text/javascript" src="modules/hojas_trabajo/mostrar.js?v=<?=VERSION?>"></script>
<script type="text/javascript" src="modules/EPP/mostrar.js?v=<?=VERSION?>"></script>
<script src="libreria/push.js-master/push.js"></script> <!-- incluye la libreria push -->
<script type="text/javascript" src="Notificaciones/push.js?v=<?=VERSION?>"></script>
<!--script para ejecutar funciones sin repetir codigo-->
<script type="text/javascript" src="script/funciones/funciones.js?v=<?=VERSION?>"></script>
<script type="text/javascript" src="modules/Cobranza/mostrar.js?v=<?=VERSION?>"></script>
<script type="text/javascript" src="modules/Ventas/mostrar.js?v=<?=VERSION?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--OSCAR ALERTAS-->

<script>
  $(function () {

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flatl-blue',
      radioClass   : 'iradio_flat-blue'
    })

    $('[data-mask]').inputmask()

    //Date picker
    $('.date-picker').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      autoclose: true,
      language: 'es'
    })

    $('#tablaSola').DataTable({
      'paging'      : false,
      'deferRender' : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'select'      : true,
      responsive    : 'false',
      
    })
     $('#tablaAnteproyecto').DataTable({
    
     'paging'      : true,
      'deferRender' : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'select'      : true,
      responsive    : 'true',
      
      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,
      buttons       : buttons
    })

    $('#tabla1').DataTable({
      'deferRender' : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,

      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,
      buttons       : buttons
    })

    $('#tablaCursos').DataTable({
      'deferRender' : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,

      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,
      buttons       : buttons
    })

    $('#tablaCursos2').DataTable({

      'deferRender' : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,

      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,
      buttons       : buttons
    })

    $('#tabla2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      "order"       :[[0, "desc"]],
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,
      "bStateSave"  : true,
         /*Para poner en el select mostrar registro*/
      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,    //posicion de los botones y lo demas de la tabla
      buttons       : buttons //botones de descarga [ 'copy', 'csv','excel', 'pdf', 'print', 'colvis']
    })

    $('#tabla3').DataTable({//======//
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,

      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,
      buttons       : buttons
    })

    $('#tabla4').DataTable({//======//
      'paging'      : true,
      'lengthChange': true,
      "order"       :[[0, "asc"]],
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true
    })

    $('#tabla5').DataTable({//======//
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,
      dom           : '<"bottom col-md-4 inline"i> <"col-md-8 inline"f>'
    })

    
    $('#tablaP').DataTable({//======//

     'paging'      : true,
     'ordering' : false,
     'lengthChange': true,
    
     'searching'   : true,

     'order': [[2, 'asc']],
 
     'info'        : true,

     'autoWidth'   : true,

     'language'    : idioma_español,

     'select'      : true

    })// .fnDestroy(); para quitar warning de datatable


    $('#pruebas').DataTable({
      'ordering'    : false,
      'paging'      : false,
      'scrollY':        "52vh",
      'scrollX':        true,
      'scrollCollapse': true,
      'language'    : idioma_español,
      'select'      : true,

      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,
      buttons       : buttons
    })

    $('#inventario').DataTable({
      'ordering'    : false,
      'paging'      : false,
      'scrollY'     : "550px",
      'scrollX'     : true,
      'scrollCollapse': true,
      'fixedColumns': { leftColumns: 1,
                      },
      'language'    : idioma_español,
      'select'      : true
    })

    $('#fijoColuma').DataTable({/*tabla de reportes caratula*/
      'ordering'    : false,
      'paging'      : false,
      'scrollY'      : "500px",
      'scrollX'      : true,
      'scrollCollapse': true,
      'fixedColumns' : { leftColumns: 1,//Le indico que deje fijas solo las 2 primeras columnas
                        },
      'language'    : idioma_español,
      'select'       : true
    })

    $('#HojaTrabajo').DataTable({
      'paging'      : true,
      'lengthChange': true,
      // "order"       :[[12, "desc"]],
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,
      "deferRender" : true,
      "bStateSave"  : true, /*true -> para guardar informacion de la tabla en una cookie(N°paginacion, filtrado, longitud de visulizacion, ordenacion)*/

      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,
      buttons       : buttons
    })

    $('#dataTables1').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,

      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,
      buttons       : buttons
    })

    $('#dataTables').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,

      'lengthMenu'  : [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"] ],
      responsive    : 'true',
      dom           : dom,
      buttons       : buttons
    })

    $('#order_data').DataTable({
      'language'    : idioma_español,
      'select'      : true
    })

    $('#tableA').DataTable({
      "order"       :[[2, "asc"]],
      'info'        : true,
      'autoWidth'   : false,
      'language'    : idioma_español,
      'select'      : true,
      "bStateSave"  : true,
      'lengthChange': false,
    })

    $('table.display').DataTable({  //Para inicializar en varias tablas
      'paging'      : true,
      'lengthChange': false,
      "order"       :[[0, "desc"]],
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true
    })

    $('table.displey').DataTable({
        'paging'      : true,
        'lengthChange': false,
        "order"       :[[1, "asc"],[3, "desc"]],
        'searching'   : true,
        'ordering'    : true,
        'info'        : false,
        'autoWidth'   : true,
        'language'    : idioma_español,
        'select'      : true
    })

    $('tabla').DataTable({  //Para inicializar en varias tablas
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true
    })

    $('#tablaArchivo.displey1').DataTable({
      // "order"       :[[2, "asc"]],
      'info'        : false,
      'autoWidth'   : true,
      'language'    : idioma_español,
      'select'      : true,
      "bStateSave"  : true,
      'lengthChange': false,
      responsive    : 'true',
      dom           : 'rt<"bottom col-md-4 inline"f> <"col-md-8 inline"p>'
    })

    /*Para el total de la tabla de cobranza*/
    $('#example').DataTable({
      retrieve      : true, //por si ya se inicializo datatable antes y no marque la advertencia
      //'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      'scrollX'      : true,
      'fixedColumns' : { leftColumns: 2}, //Le indico que deje fijas solo las 2 primeras columnas
      'language'    : idioma_español,
      'select'      : true,
      "bStateSave"  : true,
      dom           : dom,
      buttons       : buttons
    })
  })

  function filterColumn(i) {
      $('#example').DataTable().column(i).search(
          $('#col' + i + '_filter').val()
      ).draw();
  }

  function filePreview(input) {
    if (input.files && input.files[0]) {
       var reader = new FileReader();
       reader.onload = function (e) {
         $('#result').empty();
         $('#result').append('<img style="border:1px solid #eaeaea;border-radius:5px; padding:5px;" src="'+e.target.result+'" width="128"/>');
       }
       reader.readAsDataURL(input.files[0]);
    }
  }

  /*Para avilitar los botones del datatable, Solo poniendo en el titulo lo sig: <span id="titulo">Requisiciones</span>*/
  let buttons = ''; let dom = 'lfrtip';

  if ($('#titulo').text() != '') {
    dom = 'lBfrtip';
    /*Botones genera archivos, Muestra la informacion de la tabla: filtro, seleccionada, quitando columnas*/
    buttons = [
          { extend: 'pdfHtml5',
            download: 'open',
            text:   '<i class="fas fa-file-pdf"></i>',
            orientation: 'landscape',
            titleAttr: 'Exportar a PDF',
            className: 'btn pdf',
            filename: 'Reporte ' + $('#titulo').text(),
            title: 'Datos de ' + $('#titulo').text(),
            footer: false,
            exportOptions: {
                  columns: ':visible'
            },
            customize: function(doc) {
               doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 10
               doc.styles.tableHeader.fontSize = 10 // tamaño letra encabezado
            }
          },

          { extend: 'excelHtml5',
            text:   '<i class="fas fa-file-excel"></i>',
            titleAttr: 'Exportar a Excel',
            className: 'btn excel',
            filename: 'Reporte ' + $('#titulo').text(),
            title: 'Datos de ' + $('#titulo').text(),
            footer: false,
            sheetName: 'Datos',
            exportOptions: {
                  columns: ':visible'
            },
            customize: function ( xlsx ) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                $('row:eq(1) c', sheet).attr( 's', '47' ); //color azul, negritas
            }
          },

          { extend: 'print',
            text:   '<i class="fa fa-print"></i>',
            titleAttr: 'Imprimir',
            className: 'btn print',
            filename: 'Reporte ' + $('#titulo').text(),
            title: 'Datos de ' + $('#titulo').text(),
            footer: false,
            exportOptions: {
                  columns: ':visible'
            },
            customize: function ( win ) {
                $(win.document.body)
                    .css( 'font-size', '9pt' );
                    // .prepend(
                    //     '<img src="http://localhost/admin-vormak/img/Logo.png" style="position:absolute; top:350; left:150; opacity: 0.2; width: 450px" />'
                    // );

                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( 'font-size', 'inherit' );
            }
          },

          { extend: 'colvis',
            text:   '<i class="fas fa-eye"></i> Visibilidad de la Columna',
            className: 'btn visibility'
          }
    ]
  }

  var idioma_español = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  }

     //Date range as a button
  $('#daterange-btn').daterangepicker( //REPORTE
      {
        ranges   : {
          'Todos'             : ['January 1,2015',  moment()],
          'Hoy'               : [moment(), moment()],
          'Ayer'              : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Últimos 7 días'    : [moment().subtract(6, 'days'), moment()],
          'Esta semana'       : [moment().startOf('week'), moment().endOf('week')],
          'La semana pasada'  : [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
          'Este mes'          : [moment().startOf('month'), moment().endOf('month')],
          'El mes pasado'     : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Este año'          : [moment().startOf('year'), moment().endOf('year')],
          'El año pasado'     : [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
        // language : daterangepicker
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        $('#rango').val(start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD'))
      }
  )
</script>
</body>
</html>

<script>
    $(document).ready(function() {
        /*$("#formAgregarHT").bind("keydown", function(e) { alert('Tecla deshabilitada2');
          if (e.keyCode === 9) return false;
        });*/
    
        $("#persona").bind("keydown", function(e) { 
          if (e.keyCode === 9) return false;
        });
    
        //Para quitar $ y coma del precio
        function intVal (i) {
            //buscar que exista <!--->
            var index = i.toString().search("<!---->");
    
            if( index >= 0) { //existe
            //Recortar cadena para que no marque error al sumar el total
              var cadena =  i.split("<!---->");
              return typeof cadena[1] === 'string' ? cadena[1].replace(/[\$,]/g, '') * 1 : typeof cadena[1] === 'number' ? cadena[1] : 0;
    
            } else { //No existe
              return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            }
        };
    
        //Para que se actualice el total al buscar en el filtro
        function actualizarTotalFilter(){
          var aTotales = [11,12,13,14,16,17]; //Posicion de los totales en fooder
    
          for (var s = 0; s < aTotales.length; s++) {  //, search: 'applied'
            var TotalRenta = $('#example').DataTable()
                                          .column( aTotales[s], {"filter":"applied", page: 'current'})
                                          .data()
                                          .reduce(function (a, b) {
                                                  return intVal(a) + intVal(b);
                                              }, 0)
                                          .toFixed(2);
    
            $('#Totales'+aTotales[s]).html(formatoMexico(TotalRenta))
          }
        }
    
        $('#example tfoot th').each(function (i) {
            var title = $(this).text();
    
            if( title != '' && title != '.'){
                $(this).html('<input id="col' + i + '_filter" class="column_filter" type="text" placeholder="Buscar ' + title + '" />');
    
            }else{
                if(title == ''){
                  // var sum = $('#example').DataTable().column(i).data().sum();
                  //suma solo lo de la columna de esa pagina
                  var sumPagina = $('#example').DataTable()
                                        .column(i, { page: 'current'})
                                        .data()
                                        .reduce(function (a, b) {
                                            return intVal(a) + intVal(b);
                                        }, 0);
                  //suma toda la columna
                  var sum = $('#example').DataTable()
                                        .column(i)
                                        .data()
                                        .reduce(function (a, b) {
                                            return intVal(a) + intVal(b);
                                        }, 0);
    
                  $(this).html('<div class="input-group" style="width: 180px; min-width: -webkit-fill-available; min-width: -moz-available;">  <span class="input-group-addon noneColor" style="width: 40px;">$</span>  <label class="precios" id="Totales'+ i +'" style="font-size: 18px; color: black;"> '+  formatoMexico(parseFloat(sumPagina).toFixed(2))   +' </label> </div> ' +
                    '<div class="input-group" style="min-width: -webkit-fill-available; min-width: -moz-available; text-align: center;" data-toggle="tooltip" title="Sumatoria Total de todos los Folios"> <label id="col' + i + '_filter" class="precios" style="font-size: 12px; color: black;"> ($ '+ formatoMexico(parseFloat(sum).toFixed(2)) +' total) </label> </div> ' );
                }
            }
        });
    
        $('input.column_filter').on('keyup click', function () {
            filterColumn($(this).parents('th').attr('data-column'));
    
            actualizarTotalFilter();
        });
    
        $('#example_filter [type="search"]').on('keyup', function () {
            actualizarTotalFilter();
        });
        
        $('#example_paginate .paginate_button').on('click', function () {
            actualizarTotalFilter();
        });
    
        //======================INVENTARIO================================//
        //FILTRO REPORTE
        $(document).ready(function(){
    
          $('#Desplegable_Filtro').on('click',function(){
              $('#Filtro').toggle('slow');
           });
         });
        //====================HOJA_TRABAJO===================================//
        $(document).on('click', '.ModificarHoja_trabajo', function(){
          var HojaTrabajo_id = $(this).attr("id");
          $.ajax({
            url:"modules/hojas_trabajo/HT_Formato/modal_mod.php",
            method:"POST",
            data:{HojaTrabajo_id:HojaTrabajo_id},
            success:function(data){
              $('#modal-HT').html(data);
              $('#modal-HTF').modal('show');
              //Se toma el último valor del contador
              a = parseFloat($("#ultimo-num-contador").val());
              b = parseFloat($("#ultimo-num-contadorP").val());
            }
          });
        });
    
        <?php
        if (isset($_GET['modal']) && $_GET['modal'] != '') {?>
            $(document).ready(function() {
              var folio = getParameterByName('modal'); //obtiene GET
              $.ajax({
                url:"modules/hojas_trabajo/HT_Formato/modal_resul.php",
                method:"POST",
                data:{folio:folio},
                success:function(data){
                  $('#modalresultado').html(data);
                  $('#mostrarmodal').modal('show');
                }
              });
            });<?php
        }?>
    
        $(document).on('click', '.CalculaTotalPzHT', function(){
          $.ajax({
            url:"modules/hojas_trabajo/Ejecutar_calcularPZ.php",
            method:"POST",
            beforeSend: function() {
                $("#sub").empty().append('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i>');
            },
            success:function(r){
                $("#sub").empty().append('<i style="color:#fff" class="fa fa-upload"></i>');
                $("#alert").empty().append('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>  <i class="icon fa fa-check-circle"></i> Exito!</h4>Los Datos han sido Modificados correctamente.</div>');
            }
          });
        });
    
        //==================Compras====================================//
        /*Para abrir el modal sin boton*/
        <?php
        if (isset($_GET['modalREQ']) && $_GET['modalREQ'] != '') { ?>
            $(document).ready(function() {
              var id_REQ = getParameterByName('modalREQ'); //obtiene GET id_REQ
              $.ajax({
                url:"modules/compras/requisiciones/modal_ModR.php",
                method:"GET",
                data:{id:id},
                success:function(data){
                  $('#modal-REQ').html(data);
                  $('#modal_REQ').modal('show');
                }
              });
            });<?php
        }?>
        
        <?php /*Para mostrar modal sin boton, con url*/
            if (isset($_GET['modalOCompra']) && $_GET['modalOCompra'] != '') { ?>
              $(document).ready(function() {
                var id_ordenC = getParameterByName('modalOCompra') +':1'; //obtiene GET id_ordenC
                $.ajax({
                  url:"modules/compras/ordenes compra/modal_ModOC.php",
                  method:"GET",
                  data:{id:id},
                  success:function(data){
                    $('#modal-OC').html(data);
                    $('#modal_OC').modal('show');
                  }
                });
              });<?php
            }
        ?>
        
        <?php
        if (isset($_GET['modalCMP']) && $_GET['modalCMP'] != '') { ?>
           $(document).ready(function() {
              var id_compra = getParameterByName('modalCMP'); //obtiene GET id_compra
              $.ajax({
                url:"modules/compras/modal_VerCompra.php",
                method:"GET",
                data:{id:id},
                success:function(data){
                  $('#modal-CMP').html(data);
                  $('#modal_CMP').modal('show');
                }
              });
            });<?php
        }?>
        
        /*Mostrar datos bancarios desplegables provedor*/
        $(document).ready(function(){
             $('#Desplegable_DatosBancario').on('click',function(){
                $('#DatosBancario').toggle('slow');
             });
        });
        
        //Filtro compras
        $(document).ready(function(){
            $('#Desplegable_FiltroCompras').on('click',function(){
                $('#FiltroCompras').toggle('slow');
             });
        });
    
        //=================Solicitud Personal====================//
        <?php /*Para mostrar modal sin boton, con url*/
          if (isset($_GET['modalSPersonal']) && $_GET['modalSPersonal'] != '') { ?>
            $(document).ready(function() {
              var id = getParameterByName('modalSPersonal') +':1:' + getParameterByName('U'); //obtiene GET
              $.ajax({
                url:"modules/solicitud_personal/modal_ModSpersonal.php",
                method:"GET",
                data:{id:id},
                success:function(data){
                  $('#modal-sPerso').html(data);
                  $('#modal-sPersonal').modal('show');
                }
              });
            });<?php
          }
        ?>
    
        <?php /*Para mostrar modal sin boton, con url*/
          if (isset($_GET['modalSAndamio']) && $_GET['modalSAndamio'] != '') { ?>
            $(document).ready(function() {
              var id = getParameterByName('modalSAndamio') +':1:' + getParameterByName('U'); //obtiene GET
              $.ajax({
                url:"modules/solicitud_personal/modal_ModSandamio.php",
                method:"GET",
                data:{id:id},
                success:function(data){
                  $('#modal-sAnda').html(data);
                  $('#modal-sAndamio').modal('show');
                }
              });
            });<?php
          }
        ?>
    
        //====================Solicitud EPP========================//
        <?php /*Para mostrar modal sin boton, con url*/
          if (isset($_GET['modalSEPP']) && $_GET['modalSEPP'] != '') { ?>
            $(document).ready(function() {
              var id = getParameterByName('modalSEPP'); //obtiene GET
              $.ajax({
                url:"modules/EPP/modal_ModSEPP.php",
                method:"GET",
                data:{id:id},
                success:function(data){
                  $('#modal-sEPP').html(data);
                  $('#modal_sEPP').modal('show');
                }
              });
            });<?php
          }
        ?>
    
        $(document).on('click', '.modal_RechazadoS', function(){
          var id = $(this).attr("id");
          $.ajax({
            url:"modules/EPP/modal_RechazadoS.php",
            method:"POST",
            data:{id:id},
            success:function(data){
              $('#modal-RechazadoEPP').html(data);
              $('#modal_RechazadoEPP').modal('show');
            }
          });
        });
    
    });

    //====================Solicitud SMA========================//
    <?php /*Para mostrar modal sin boton, con url*/
      if (isset($_GET['modalSSMA']) && $_GET['modalSSMA'] != '') { ?>
        $(document).ready(function() {
          var id = getParameterByName('modalSSMA'); //obtiene GET
          $.ajax({
            url:"modules/SMA/modal_ModSSMA.php",
            method:"GET",
            data:{id:id},
            success:function(data){

              $('#modal-sSMA').html(data);
              $('#modal_sSMA').modal('show');
            }
          });
        });



        <?php
      }
    ?>

    $(document).on('click', '.modal_RechazadoSSMA', function(){
      var id = $(this).attr("id");
      $.ajax({
        url:"modules/SMA/modal_RechazadoSSMA.php",
        method:"POST",
        data:{id:id},
        success:function(data){
          $('#modal-RechazadoSMA').html(data);
          $('#modal_RechazadoSMA').modal('show');
        }
      });
    });
    
      //======================(example)===========================//
    $(document).on('keyup click', function() {
    /*Para que se de ponga las cantidades en el foother, actualice las cantidades al buscar, paginacion. En la vista de cobranza.  
        Los dos primeros se vuelven a poner o marcara error que no esta definido.
        Y los tres ultimos para que se actualice los ddatos cuando se da clic o se escribe algo*/
        
        function intVal (i) {
            //buscar que exista <!--->
            var index = i.toString().search("<!---->");
    
            if( index >= 0) { //existe
            //Recortar cadena para que no marque error al sumar el total
              var cadena =  i.split("<!---->");
              return typeof cadena[1] === 'string' ? cadena[1].replace(/[\$,]/g, '') * 1 : typeof cadena[1] === 'number' ? cadena[1] : 0;
    
            } else { //No existe
              return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            }
        };
        
        function actualizarTotalFilter(){
          var aTotales = [11,12,13,14,16,17]; //Posicion de los totales en fooder
    
          for (var s = 0; s < aTotales.length; s++) {  //, search: 'applied'
            var TotalRenta = $('#example').DataTable()
                                          .column( aTotales[s], {"filter":"applied", page: 'current'})
                                          .data()
                                          .reduce(function (a, b) {
                                                  return intVal(a) + intVal(b);
                                              }, 0)
                                          .toFixed(2);
    
            $('#Totales'+aTotales[s]).html(formatoMexico(TotalRenta))
          }
        }
        
        $('input.column_filter').on('keyup click', function () {
            filterColumn($(this).parents('th').attr('data-column'));
    
            actualizarTotalFilter();
        });
        
        $('#example_filter [type="search"]').on('keyup', function () {
            actualizarTotalFilter();
        });
        
        $('#example_paginate .paginate_button').on('click', function () {
            actualizarTotalFilter();
        });
    });


</script>

<script>
  //Desaparece alert de bootstrab
  window.setTimeout(function (){
      $(".alert").fadeTo(800, 1).slideUp(800, function(){
          $(this).remove();
      });
  }, 4000);

  //Para sacar algun dato de la URL (GET)
  function getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, '\\$&');
      var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }

   /*Para obtener los datos del input search*/
  function getSearch(table){

    $(table).on('search.dt', function() {
        var value = $('.dataTables_filter input').val();

        $('#dato').val(value);

        if (value == '') {
          document.getElementById('btnPDF').style.display='none';
          document.getElementById('btnEXE').style.display='none';
        }else{
          document.getElementById('btnPDF').style.display='-webkit-inline-box';
          document.getElementById('btnEXE').style.display='-webkit-inline-box';
        }
    });
  }

  /*Mostrar checkbox, al escribir en el buscador de datatabled*/
  $(document).ready(function() {
    const dt = $('#dataTables1').DataTable();

    dt.on('search.dt', function(e) {
      document.getElementById("Select").style.display  = "block";

      if($(".check_todos").is(":checked")) {
        $(".check_todos").prop("checked", false);
      }
    });
  });
</script>
