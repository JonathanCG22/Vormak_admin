<?php
$r = mysqli_fetch_assoc($crud->Permiso_Acceso_Mayor());
$max = $r['mayor'];

// Usuario Super Administrador
if ($_SESSION['permisos_acceso'] <= $max && $_SESSION['permisos_acceso'] != 0) {
  $objeto->id_Acceso = $_SESSION['permisos_acceso'];

  ?>
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">Menu de Navegación</li>

    <?php
    $objeto->id_Modulo = 'Inicio';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="start") {
          $active_home="active";
      } else {
          $active_home="";
      } ?>
  		<li class="<?php echo $active_home; ?>">
  			<a href="?module=start">
          <i class="fa fa-home"></i>
          <span>Inicio</span>
        </a>
  	  </li>

  	  <?php
    }
    
    
   /*
    //SMA
    $objeto->id_Modulo = 'SMA';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_SESSION['id_user'] == 9) {//SR. eli
          $url = '?module=SMA&id=SO';
      }else{
          $url = '?module=SMA';
      }

      if ($_GET["module"]=="SMA") { ?>
        <li class="active">
          <a href="<?php echo $url ?>">
          <i class="fa fa-pallet" ></i>
            <span>SMA</span>
          </a>
        </li> <?php
      }else{ ?>
        <li>
          <a href="<?php echo $url ?>">
           <i class="fa fa-pallet" ></i>
            <span>SMA</span>
          </a>
        </li> <?php
      }
    }



    $objeto->id_Modulo = 'Clientes';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="clientes" || $_GET["module"]=="form_clientes") { ?>
        <li class="active">
          <a href="?module=clientes">
            <i class="fa fa-users"></i>
            <span>Clientes</span>
          </a>
        </li>	<?php
      }else{ ?>
    	  <li>
      	  <a href="?module=clientes">
            <i class="fa fa-users"></i>
            <span>Clientes</span>
          </a>
        </li> <?php
      }
    }

    $objeto->id_Modulo = 'Proyectos';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="catalogo_proyectos" || $_GET["module"]=="form_catalogo_proyectos") { ?>
        <li class="active">
          <a href="?module=catalogo_proyectos">
            <i class="fa fa-folder"></i>
            <span>Proyectos</span>
          </a>
        </li>	<?php
      }else{ ?>
    	  <li>
      	  <a href="?module=catalogo_proyectos">
            <i class="fa fa-folder"></i>
            <span>Proyectos</span>
          </a>
        </li> <?php
      }
    }

    /*******************inventario***************************
    $objeto->id_Modulo = 'Andamios';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="andamios" || $_GET["module"]=="almacen" ||
          $_GET["module"]=="movimientos" || $_GET["module"]=="Modificar_Proyecto" ||
          $_GET["module"]=="XProyecto" || $_GET["module"]=="inventario" ||
          $_GET["module"]=="inventarioUser" || $_GET["module"]=="reporte") {
          ?>
        <li class="active">
          <a href="?module=andamios">
            <i class="fa fa-film"></i>
            <span>Inventarios de Andamio</span>
          </a>
        </li>
       <?php
      } else {
            ?>
        <li>
          <a href="?module=andamios">
            <i class="fa fa-film"></i>
            <span>Inventarios de Andamio</span>
          </a>
        </li>
       <?php
      }
    }

    /*******************Personal***************************
    $objeto->id_Modulo = 'Datos de Personal';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="personal" || $_GET["module"]=="form_personal") { ?>
        <li class="active">
          <a href="?module=personal">
            <i class="fa fa-users"></i>
            <span>Datos de Personal</span>
          </a>
        </li>	<?php
      }else{ ?>
    	  <li>
      	  <a href="?module=personal">
            <i class="fa fa-users"></i>
            <span>Datos de Personal</span>
          </a>
        </li> <?php
      }
    }

      /*
      if ($_GET["module"]=="nomina") { ?>
    		<li class="active">
    			<a href="?module=nomina">
            <i class="fa fa-list"></i>
            <span>Hojas de Nómina</span>
          </a>
    		</li> <?php
      }else{ ?>
    		<li>
    			<a href="?module=nomina">
            <i class="fa fa-list"></i><span>Hojas de Nómina</span>
          </a>
    		</li> <?php
      }
      

    $objeto->id_Modulo = 'Hojas de Tiempo';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="nomina") { ?>
    		<li class="active">
    			<a href="?module=nomina">
            <i class="fa fa-list"></i>
            <span>Hojas de Tiempo</span>
          </a>
    		</li> <?php
      }else{ ?>
    		<li>
    			<a href="?module=nomina">
            <i class="fa fa-list"></i>
            <span>Hojas de Tiempo</span>
          </a>
    		</li> <?php
      }
    }

    $objeto->id_Modulo = 'Hojas de Trabajo';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET['module']=="HojasTrabajo_Principal" || $_GET["module"]=="hojas_trabajo" || $_GET["module"]=="buscar_HT" ||
          $_GET["module"]=="Reporte_HT" || $_GET["module"]=="BloqueoF") { ?>
        <li class="active">
          <a href="?module=HojasTrabajo_Principal">
            <i class="fa fa-book"></i>
            <span>Andamios Armados</span>
          </a>
        </li> <?php
      }else{ ?>
        <li>
          <a href="?module=HojasTrabajo_Principal">
            <i class="fa fa-book"></i>
            <span>Andamios Armados</span>
          </a>
        </li> <?php
      }
    }

    $objeto->id_Modulo = 'Ventas';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="Ventas" || $_GET["module"]=="Reporte_VT") { ?>
        <li class="active">
          <a href="?module=Ventas&id=VT&op=0">
            <i class="fas fa-handshake" prefix="fas"></i>
            <span>Ventas</span>
          </a>
        </li> <?php
      }else{ ?>
        <li>
          <a href="?module=Ventas&id=VT&op=0">
            <i class="fas fa-handshake" prefix="fas"></i>
            <span>Ventas</span>
          </a>
        </li> <?php
      }
    }

    $objeto->id_Modulo = 'Cobranza';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="Cobranza" || $_GET["module"]=="Caratulas" ||
          $_GET["module"]=="ReporteCobranza") { ?>
        <li class="active">
          <a href="?module=Cobranza&id=CB">
            <i class="fas fa-hand-holding-usd" prefix="fas"></i>
            <span>Cobranza</span>
          </a>
        </li> <?php
      }else{ ?>
        <li>
          <a href="?module=Cobranza&id=CB">
            <i class="fas fa-hand-holding-usd" prefix="fas"></i>
            <span>Cobranza</span>
          </a>
        </li> <?php
      }
    }

    $objeto->id_Modulo = 'Cotizaciones';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="cotizaciones") {?>
        <li class="active">
          <a href="?module=cotizaciones">
            <i class="fa fa-list-alt"></i><span>Cotizaciones</span>
          </a>
        </li><?php
      }else{?>
        <li>
          <a href="?module=cotizaciones">
            <i class="fa fa-list-alt"></i><span>Cotizaciones</span>
          </a>
        </li> <?php
      }
    }

    $objeto->id_Modulo = 'Compras';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="compras") {?>
        <li class="active">
          <a href="?module=compras">
            <i class="fa fa-shopping-bag"></i><span>Compras</span>
          </a>
        </li><?php
      }else{?>
        <li>
          <a href="?module=compras">
            <i class="fa fa-shopping-bag"></i><span>Compras</span>
          </a>
        </li> <?php
      }
    }

    $objeto->id_Modulo = 'Usuarios';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="user" || $_GET["module"]=="form_user" ||
          $_GET["module"]=="userP" || $_GET["module"]=="form_userP" ||
          $_GET["module"]=="PermisosAcceso" || $_GET["module"]=="ModulosSystem") { ?>
    		<li class="active">
    			<a href="?module=user&id=U">
            <i class="fa fa-user"></i>
            <span>Usuarios</span>
          </a>
    	  </li> <?php
      }else{ ?>
    		<li>
    			<a href="?module=user&id=U">
            <i class="fa fa-user"></i><span>Usuarios</span>
          </a>
    	  </li> <?php
      }
    }

    $objeto->id_Modulo = 'Reportes';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="Reportes") { ?>
        <li class="active">
          <a href="?module=Reportes">
            <i class="fas fa-file-download" prefix="fas"></i>
            <span>Reportes</span>
          </a>
        </li><?php
      }else{ ?>
        <li>
          <a href="?module=Reportes">
            <i class="fas fa-file-download" prefix="fas"></i>
            <span>Reportes</span>
          </a>
        </li><?php
      }
    }
*/
    $objeto->id_Modulo = 'Arrendamiento';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="Arrendamiento") { ?>
    		<li class="active">
    			<a href="?module=Arrendamiento">
          <i class="fas fa-user-tie"></i>
            <span>Clientes Arrendamiento</span>
          </a>
    		</li><?php
      }else{ ?>
    		<li>
    			<a href="?module=Arrendamiento">
          <i class="fas fa-user-tie"></i>
            <span>Clientes Arrendamiento</span>
          </a>
    		</li><?php
      }
    }

    $objeto->id_Modulo = 'Inventario_Equipo';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="Inventario_Equipo") { ?>
    		<li class="active">
    			<a href="?module=Inventario_Equipo">
          <i class="fas fa-truck-moving"></i>
            <span>Inventario De Equipos</span>
          </a>
    		</li><?php
      }else{ ?>
    		<li>
    			<a href="?module=Inventario_Equipo">
          <i class="fas fa-truck-moving"></i>
            <span>Inventario De Equipos</span>
          </a>
    		</li><?php
      }
    }

    
    $objeto->id_Modulo = 'Mantenimiento_Equipo';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="Mantenimiento_Equipo") { ?>
    		<li class="active">
    			<a href="?module=Mantenimiento_Equipo">
          <i class="fas fa-wrench"></i>
            <span>Mantenimiento Equipos</span>
          </a>
    		</li><?php
      }else{ ?>
    		<li>
    			<a href="?module=Mantenimiento_Equipo">
          <i class="fas fa-wrench"></i>
            <span>Mantenimiento Equipos</span>
          </a>
    		</li><?php
      }
    }

    $objeto->id_Modulo = 'Renta_Equipo';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));
    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="Renta_Equipo") { ?>
    		<li class="active">
    			<a href="?module=Renta_Equipo">
          <i class="fas fa-truck-loading"></i>
            <span>Salida de equipo</span>
          </a>
    		</li><?php
      }else{ ?>
    		<li>
    			<a href="?module=Renta_Equipo">
          <i class="fas fa-truck-loading"></i>
            <span>Salida de equipo</span>
          </a>
    		</li><?php
      }
    }

  
/*

    $objeto->id_Modulo = 'Contraseña';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="password") { ?>
    		<li class="active">
    			<a href="?module=password">
            <i class="fa fa-lock"></i>
            <span>Contraseña</span>
          </a>
    		</li><?php
      }else{ ?>
    		<li>
    			<a href="?module=password">
            <i class="fa fa-lock"></i>
            <span>Contraseña</span>
          </a>
    		</li><?php
      }
    }


    //SMA
  $objeto->id_Modulo = 'Calidad';
  $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

  if (!empty($r) && $r['accion'] != '') {

    if ($_GET["module"]=="Calidad") { ?>
      <li class="active">
        <a href="?module=Calidad">
        <i class="fa fa-pallet" ></i>
          <span>Calidad</span>
        </a>
      </li> <?php
    }else{ ?>
      <li>
        <a href="?module=Calidad">
         <i class="fa fa-pallet" ></i>
          <span>Calidad</span>
        </a>
      </li> <?php
    }
  }


    $objeto->id_Modulo = 'Configuraciones';
    $r = mysqli_fetch_assoc($crud->DatPermiso_Modulo($objeto));

    if (!empty($r) && $r['accion'] != '') {
      if ($_GET["module"]=="configuracion") { ?>
    		<li class="active">
    			<a href="?module=configuracion">
            <i class="fa fa-cogs"></i>
            <span>Configuraciones</span>
          </a>
    		</li> <?php
      }else{ ?>
    		<li>
    			<a href="?module=configuracion">
            <i class="fa fa-cogs"></i>
            <span>Configuraciones</span>
          </a>
    		</li> <?php
      }
    }
    */
    ?>

  </ul>
  <?php
}
