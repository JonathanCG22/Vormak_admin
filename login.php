<?php 
include "config/conexion.php";
$objeto = new Objeto;
$crud = new CRUD;

if (!empty($_GET['pag'])) {
  
    $pagina = $_GET['pag'];
    $act = 1 ; //por si entro por link por correo
    
    $divi = explode('@', $pagina);    

    if ($divi[0] == 'solicitud_personal') {
      $objeto->id_solicitud = $divi[1];
      $ex = mysqli_fetch_assoc($crud->consult_solicitudPersonal($objeto));  
      $visto = $ex['visto']; //es 1 o 0

    }elseif ($divi[0] == 'solicitud_andamio') {
      $objeto->id_andamio = $divi[1];
      $ex = mysqli_fetch_assoc($crud->consult_solicitudAndamio($objeto));  
      $visto = $ex['visto']; //es 1 o 0
      
    }elseif ($divi[0] == 'EPP') {
      $objeto->id_EPP = $divi[1];
      $ex = mysqli_fetch_assoc($crud->consult_solicitudEPP($objeto));  
      $visto = 0;
    } //SMA
    elseif ($divi[0] == 'SMA') {
      $objeto->id_SMA = $divi[1];
      $ex = mysqli_fetch_assoc($crud->consult_solicitudSMA($objeto)); 
    }
    
}else{
  $act = ''; //por si entro normal
}

date_default_timezone_set("America/Mexico_City");/*Zona horaaria*/
$sys = $crud->system();
$d = explode("-", $sys[1]['hora'] );
$Hora_Actual = strtotime(date("H:i",time()));
$HoraI = strtotime($d[0]);
$HoraF = strtotime($d[1]); 
?>

<!DOCTYPE html>
<html>
<head><meta charset="gb18030">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin-Vormak | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- CSS -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- CSS -->
  <link rel="stylesheet" href="css/style3.css">
  <!-- Icono -->
  <link rel="shortcut icon" href="img/icono.png" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition">

<div class="login-box">

  <?php
  if (empty($_GET['alert'])) {
      echo "";
  } elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-danger alert-dismissable' style='opacity:0.9'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-times-circle'></i> Error al entrar!</h4>
           Usuario o la contrase&ntilde;a es incorrecta, vuelva a verificar su nombre de usuario y contrase&ntilde;a.
          </div>";
  } elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable' style='opacity:0.9'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i> Exito!!</h4>
          Has salido con &eacute;xito.
          </div>";
  } elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-warning alert-dismissable' style='opacity:0.9'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i> Exito!!</h4>
          Este Usuario no tiene acceso a este movimiento.
          </div>";
  }
  
  if (!empty($_GET['pag'])) {
    if ($visto == 1) {
      echo "<div class='alert alert-info alert-dismissable' style='opacity:0.9'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i> Solicitud vista por otro usuario!!</h4>
          Ya fue mandado el correo de enterado al Ing. que la solicito.
          </div>";
    }
    
    if ($divi[2] == 'Coordinador') {   
      if (isset($ex['fch_auto']) &&  $ex['fch_auto'] != ' ') {
        $fecha = isset($ex['fch_auto']) ? date("d/m/Y", strtotime($ex['fch_auto'])) : '' ;
        echo "<div class='alert alert-info alert-dismissable' style='opacity:0.9'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> La Solicitud ya a sido Autorizada el ".$fecha."</h4>
            </div>";
      }
    }
  }
  ?>


  <!-- /.login-logo -->
  <div class="login-box-body" style='opacity:0.9'>
    <div class="login-logo">
      <a href="index.html"><img src="img/logo_inicio.jpg" width="80%" alt="Logo"></a>
    </div>

    <?php    
    if ($sys[1]['codigo'] == 'SYS-UPDATE' && $sys[1]['status'] == 1 && ($Hora_Actual > $HoraI && $Hora_Actual < $HoraF)) {
        $ocultar = 'none';
        ?><p class="login-box-msg">El Sistema se Encuentra en Mantenimiento</p>
          <p class="login-box-msg">De <?= $sys[1]['hora'] ?></p><?php

    }else{
        $ocultar = 'block';
        ?><p class="login-box-msg">Coloca tus datos para Iniciar Sesión</p> <?php
    } ?>

    <?php
    if ($act == 1) {
      ?><form action="login_check.php?pag=<?php echo $pagina ?>" method="post"><?php
    }else{
      ?><form action="login_check.php" method="post"><?php
    }?>
      <div style="display: <?= $ocultar ?>">
        <div class="form-group has-feedback">
          <input type="text" name="username"  class="form-control" placeholder="User" data-toggle='tooltip' data-placement='top'  title="Usuario" require>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password" title="Contraseña" require>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Recordarme
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
  <?php
    if ($sys[1]['codigo'] == 'SYS-UPDATE' && $sys[1]['status'] == 1) {
      echo "<div class='alert alert-info alert-dismissable' style='opacity:0.9; color: #000 !important;'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i>".$sys[1]['nombre']." !!</h4>
            <strong>".$sys[1]['hora']."</strong> ".$sys[1]['texto']."
           </div>";
    }
  ?>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

<script>//Desaparece alert de bootstrab
  window.setTimeout(function (){
      $(".alert").fadeTo(800, 1).slideUp(800, function(){
          $(this).remove();
      });
  }, 3500);
</script>

</body>
</html>
<script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
