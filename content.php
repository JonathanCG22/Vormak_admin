<?php
require_once "config/conexion.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {
    /******************* Inicio ********************/
    if ($_GET['module'] == 'start') {
        include "modules/start/view.php";
    } elseif ($_GET['module'] == 'stock_inventory') {
        include "modules/stock_inventory/view.php";


   /******************* Reportes ********************/
    } elseif ($_GET['module'] == 'stock_report') {
        include "modules/stock_report/view.php";

    /******************* Personal ********************/
    } elseif ($_GET['module'] == 'personal') {
        include "modules/personal/view.php";
    } elseif ($_GET['module'] == 'form_personal') {
        include "modules/personal/form.php";
    }elseif ($_GET['module'] == 'personal_huella') {
           include "modules/personal/huella.php";
    }elseif ($_GET['module'] == 'Solicitudes_andamieros') {
        include "modules/personal/solicitantes/modal_solicitantes.php";
    }elseif ($_GET['module'] == 'Inicio_Personal') {
        include "modules/personal/view_nuevo.php";

    /*******************user********************/
    } elseif ($_GET['module'] == 'user') {
        include "modules/user/view.php";
    }elseif ($_GET['module'] == 'PermisosAcceso') {
        include "modules/user/permisos_acceso/view_permiso.php";
    } elseif ($_GET['module'] == 'ModulosSystem') {
        include "modules/user/permisos_acceso/view_modulo.php";
    } elseif ($_GET['module'] == 'form_user') {
        include "modules/user/form.php";

    } elseif ($_GET['module'] == 'profile') {
        include "modules/profile/view.php";
    } elseif ($_GET['module'] == 'form_profile') {
        include "modules/profile/form.php";

    } elseif ($_GET['module'] == 'password') {
        include "modules/password/view.php";
    } 
    /*******************Arrendamiento Chacon********************/
    elseif ($_GET['module'] == 'Arrendamiento') {
    include "modules/arrendamiento/view.php";
    
    } 
    /*******************Inventario_Equipo  Chacon********************/
    elseif ($_GET['module'] == 'Inventario_Equipo') {
    include "modules/Inventario_Equipo/view.php";

   } 
   /*******************Mantenimiento_Equipo  Chacon********************/
   elseif ($_GET['module'] == 'Mantenimiento_Equipo') {
   include "modules/Mantenimiento_Equipo/view.php";

    } 
    /*******************Renta_Equipo  Chacon********************/
    //Salida del equipo
    elseif ($_GET['module'] == 'Renta_Equipo') {
  //  include "modules/Renta/view.php";
    include "modules/Renta/view.php";
    //Entrada del equipo
    }elseif ($_GET['module'] == 'Renta_Salida') {
        include "modules/Renta/modal_salida.php";
    
    /*******************user Planta********************/
    } elseif ($_GET['module'] == 'userP') {
        include "modules/user/planta/view.php";
    } elseif ($_GET['module'] == 'form_userP') {
        include "modules/user/planta/form.php";
    }elseif ($_GET['module'] == 'PermisoPersonal') {
        include "modules/user/permisos_planta/view.php";

    /******************* Proyecto *******************/
    } elseif ($_GET['module'] == 'gastos') {
        include "modules/gastos/view_proyect.php";

    } elseif ($_GET['module'] == 'andamio') {
        include "modules/andamio/view.php";
    } elseif ($_GET['module'] == 'form_andamio') {
        include "modules/andamio/form.php";

    } elseif ($_GET['module'] == 'estimaciones') {
        include "modules/estimaciones/view.php";
    } elseif ($_GET['module'] == 'form_estimaciones') {
        include "modules/estimaciones/form.php";

    } elseif ($_GET['module'] == 'manoobra') {
        include "modules/manoobra/view.php";

    } elseif ($_GET['module'] == 'calculo_nomina') {
        include "modules/calculo_nomina/view.php";
    } elseif ($_GET['module'] == 'form_calculo_nomina') {
        include "modules/calculo_nomina/form.php";

    } elseif ($_GET['module'] == 'catalogo_proyectos') {
        include "modules/catalogo_proyectos/view.php";
    } elseif ($_GET['module'] == 'form_catalogo_proyectos') {
        include "modules/catalogo_proyectos/form.php";

    } elseif ($_GET['module'] == 'clientes') {
        include "modules/clientes/view.php";
    } elseif ($_GET['module'] == 'form_clientes') {
        include "modules/clientes/form.php";

    } elseif ($_GET['module'] == 'proyecto') {
        include "modules/proyecto/view.php";

    /******************configuracion*******************/
    } elseif ($_GET['module'] == 'configuracion') {
        include "modules/configuracion/view.php";
    } elseif ($_GET['module'] == 'form_configuracion') {
        include "modules/configuracion/form.php";
    }elseif ($_GET['module'] == 'EPP_configuracion') {
         include "modules/configuracion/EPP/view.php";
    }elseif ($_GET['module'] == 'Compras_EPP') {
        include "modules/configuracion/Compra/view.php";
    }elseif ($_GET['module'] == 'Provedores_EPP') {
        include "modules/configuracion/Provedor/view.php";
    }elseif ($_GET['module'] == 'Categorias_Precios') {
        include "modules/configuracion/Categorias/view.php";
    }elseif ($_GET['module'] == 'Categorias_Precios_pw') {
        include "modules/configuracion/CategoriasPreviw/view.php";
    }elseif ($_GET['module'] == 'View_annio') {
        include "modules/configuracion/Categorias/View_anio.php";                          //gabriel anteproyecto
    }elseif ($_GET['module'] == 'Infonavit') {
        include "modules/configuracion/Infonavit/view.php";
    }elseif ($_GET['module'] == 'Lista_precios') {

        include "modules/configuracion/ListaPrecios/view.php";
    // }elseif ($_GET['module'] == 'ReportesC') {
    //     include "modules/configuracion/Reportes/view.php";

    /******************nomina*************************/
    }elseif ($_GET['module'] == 'nomina') {
        include "modules/nomina/view_trabajo.php";
    }elseif ($_GET['module'] == 'form_nomina') {
        include "modules/nomina/form.php";
    }elseif ($_GET['module'] == 'nomina2') {
        include "modules/nomina/view2.php";
    }elseif ($_GET['module'] == 'nomina3') {
        include "modules/nomina/view3.php";
    }elseif ($_GET['module'] == 'nomina4') {
        include "modules/nomina/view4.php";
    }elseif ($_GET['module'] == 'excel') {
        include "modules/nomina/excel.php";
    }elseif ($_GET['module'] == 'calculo') {
        include "modules/nomina/nomina.php";

    /********************inventario*******************/
    }elseif ($_GET['module'] == 'andamios') {
        include "modules/inventario/view.php";
    }elseif ($_GET['module'] == 'agregar_piezas') {
        include "modules/inventario/almacen/proses.php";
    }elseif ($_GET['module'] == 'agregar_Movimiento') {
        include "modules/inventario/movimientos/form.php";
    }elseif ($_GET['module'] == 'agregar_Movimiento2') { /*quitar si no se ocupa 2 boton Agregar*/
        include "modules/inventario/movimientos/form_Agr.php";
    }elseif ($_GET['module'] == 'movimientos') {
        include "modules/inventario/movimientos/view.php";
    }elseif ($_GET['module'] == 'almacen') {
        include "modules/inventario/almacen/view.php";
    }elseif ($_GET['module'] == 'XProyecto') {
        include "modules/inventario/XProyecto/view.php";
    }elseif ($_GET['module'] == 'inventario') {
        include "modules/inventario/form.php";
    }elseif ($_GET['module'] == 'inventarioUser') {
        include "modules/inventario/form2.php";
    }elseif ($_GET['module'] == 'reporte') {
        include "modules/inventario/reportes/view.php";
    }elseif ($_GET['module'] == 'descargarR') {
        include "modules/inventario/reportes/proses.php";
    }elseif ($_GET['module'] == 'Modificar_Proyecto') {
        include "modules/inventario/XProyecto/mostrar_ocultar/view.php";
    }elseif ($_GET['module'] == 'proses_Modificar') {
        include "modules/inventario/XProyecto/mostrar_ocultar/proses.php";
    }elseif ($_GET['module'] == 'modal_mov') {
        include "modules/inventario/movimientos/modal.php";
    }elseif ($_GET['module'] == 'modalMod_mov') {
        include "modules/inventario/movimientos/modal_Mod.php";

    }elseif ($_GET['module'] == 'modal_mov2') {
        include "modules/inventario/movimientos/modal_ver.php";
    }elseif ($_GET['module'] == 'modalMod_mov2') {
        include "modules/inventario/movimientos/modal_Mod_2.php";
    }elseif ($_GET['module'] == 'proses') {
        include "modules/inventario/proses.php";

    /********************hojas trabajo*******************/
    }elseif ($_GET['module'] == 'hojas_trabajo') {
        include "modules/hojas_trabajo/view.php";
    }elseif ($_GET['module'] == 'HojasTrabajo_Principal') {
        include "modules/hojas_trabajo/view_principal.php";
    }elseif ($_GET['module'] == 'proses_HojasT') {
        include "modules/hojas_trabajo/proses.php";
    }elseif ($_GET['module'] == 'Reporte_HT') {
        include "modules/hojas_trabajo/form2.php";
    }elseif ($_GET['module'] == 'BloqueoF') {
        include "modules/hojas_trabajo/Bloqueo_Folio/view.php";
    }elseif ($_GET['module'] == 'proses_BloqueoF') {
        include "modules/hojas_trabajo/Bloqueo_Folio/proses.php";
    /**************Cobranza******************/
    }elseif ($_GET['module'] == 'Cobranza') {
        include "modules/Cobranza/view.php";
    }elseif ($_GET['module'] == 'Caratulas') {
        include "modules/Cobranza/Caratulas/view.php";
    }elseif ($_GET['module'] == 'PagosCaratula') {
        include "modules/Cobranza/Caratulas/form.php";
    }elseif ($_GET['module'] == 'ReporteCobranza') {
        include "modules/Cobranza/Reporte/view.php";
    }elseif ($_GET['module'] == 'UpdateCaratula2') {
        include "modules/Cobranza/Caratulas/Mod_caratula2.php";
    }elseif ($_GET['module'] == 'proseso') {
        include "modules/Cobranza/Caratulas/proses.php";
    /****************Ventas*******************/
    }elseif ($_GET['module'] == 'Ventas') {
        include "modules/Ventas/view.php";
    }elseif ($_GET['module'] == 'Reporte_VT') {
        include "modules/Ventas/Reporte/view.php";

    /********************cotizaciones*******************/
    }elseif ($_GET['module'] == 'cotizaciones') {
        include "modules/cotizaciones/view.php";
    }elseif ($_GET['module'] == 'propuesta') {
        include "modules/cotizaciones/form.php";
    }elseif ($_GET['module'] == 'servicio') {
        include "modules/cotizaciones/servicio/view.php";
    }elseif ($_GET['module'] == 'forPartidas') {
        include "modules/cotizaciones/form2.php";
    }elseif ($_GET['module'] == 'TipoTrabajo') {
        include "modules/cotizaciones/form3.php";
    }elseif ($_GET['module'] == 'jornadas') {
        include "modules/cotizaciones/jornada/view.php";
    }elseif ($_GET['module'] == 'dia') {
        include "modules/cotizaciones/dia/view.php";
    }elseif ($_GET['module'] == 'descargarPdf') {
        include "modules/cotizaciones/Propuesta_pdf.php";

    /********************compras*******************/
    }elseif ($_GET['module'] == 'compras') {
        include "modules/compras/view.php";
    }elseif ($_GET['module'] == 'productos_C') {
         include "modules/compras/productos/view.php";
    }elseif ($_GET['module'] == 'requisiciones_C') {
         include "modules/compras/requisiciones/view.php";
    }elseif ($_GET['module'] == 'ordenCompra_C') {
         include "modules/compras/ordenes compra/view.php";
    }elseif ($_GET['module'] == 'provedores_C') {
         include "modules/compras/proveedores/view.php";
    }elseif ($_GET['module'] == 'reportes_C') {
         include "modules/compras/reportes/view.php";
    }elseif ($_GET['module'] == 'recepcion_C') {
         include "modules/compras/recepcion/view.php";
    }elseif ($_GET['module'] == 'tablas_C') {
         include "modules/compras/tablas/view.php";
    }elseif ($_GET['module'] == 'Filtro_Compras') {
         include "modules/compras/reportes/form_filtroCompra.php";
    }elseif ($_GET['module'] == 'Filtro_Gastos') {
         include "modules/compras/reportes/form_filtroGasto.php";
    }elseif ($_GET['module'] == 'FCompras_Proses') {
         include "modules/compras/reportes/proses.php";

    /***************** reloj checador *****************/
	}elseif ($_GET['module'] == 'checador') {
         include "modules/reloj_checador/jmu_create_user.php";

    /***************** reloj checador *****************/
    }elseif ($_GET['module'] == 'OT') {
         include "modules/OT/view.php";

    /***************** reloj checador *****************/
    }elseif ($_GET['module'] == 'EPP') {
          include "modules/EPP/view.php";

    /***************** scripts *****************/
    }elseif ($_GET['module'] == 'scripts') {
        include "script/view.php";
    }elseif ($_GET['module'] == 'scripts_pro') {
        include "script/proses.php";

    /***************** solicitud personal *****************/
    }elseif ($_GET['module'] == 'solicitud_personal') {
          include "modules/solicitud_personal/view.php";

    /***************** solicitud andamio *****************/
    }elseif ($_GET['module'] == 'solicitud_andamio') {
          include "modules/solicitud_personal/view2.php";
    
    /***************** Control de Asistencia *****************/
    }elseif ($_GET['module'] == 'asistencia') {
          include "modules/asistencia/view.php";

    /************* Vista Reportes en General *************/
    }elseif ($_GET['module'] == 'Reportes') {
          include "modules/Reportes/view.php";

    /******************** Asistencia ********************/
    }elseif ($_GET['module'] == 'Asistencia') {
        include "modules/Asistencia/view.php";
    }elseif ($_GET['module'] == 'Asistencia_Proses') {
        include "modules/Asistencia/proses.php";
    
    /******************** SMA ********************/
    }elseif ($_GET['module'] == 'SMA') {
        include "modules/SMA/view.php";
    }elseif ($_GET['module'] == 'agregar_MovimientoDsalida') { /*quitar si no se ocupa 2 boton Agregar*/
        include "modules/SMA/form_salida_materiales.php";
    }elseif ($_GET['module'] == 'Calidad') {
        include "modules/calidad/view.php";
    
    /******************** Cursos ********************/
    }elseif ($_GET['module'] == 'Cursos') {
        include "modules/Cursos/View.php";
               
    }elseif ($_GET['module'] == 'ViewCursos') {
        include "modules/Cursos/ViewCursos.php";
               
    }elseif ($_GET['module'] == 'EditCurso') {
        include "modules/Cursos/Editar_curso.php";
               
    }elseif ($_GET['module'] == 'Agregar_curso') {
        include "modules/Cursos/Agregar_curso.php";
               
    }elseif ($_GET['module'] == 'Capacitacion') {
        include "modules/Cursos/Capacitacion.php";

    }elseif ($_GET['module'] == 'Capacitando') {
        include "modules/Cursos/Capacitando.php";

    }elseif ($_GET['module'] == 'Cursados') {
        include "modules/Cursos/ViewCursados.php";
    
    }elseif ($_GET['module'] == 'infoGralCursosPersonal') {
        include "modules/Cursos/infoGralCursosPersonal.php";

    }elseif ($_GET['module'] == 'Resultados') {
        include "modules/Cursos/View_resultados.php";

    /*************Solicitud_Entrega****************/
    }elseif ($_GET['module'] == 'Solicitud_Entrega') {
        include "modules/Solicitud_Entrega/view.php";

    } /***************** Anteproyecto *****************/                       //GABRIEL
    elseif ($_GET['module'] == 'Anteproyectos') {

        include "modules/Anteproyecto/view.php";

    }elseif ($_GET['module'] == 'partidas_proyecto') {

        include "modules/proyecto/partidas_proyecto.php";

    }
    elseif ($_GET['module'] == 'partidas') {

        include "modules/Anteproyecto/view_partidas.php";

    }elseif ($_GET['module'] == 'Solicitud_Entrega') {
        include "modules/Solicitud_Entrega/view.php";

    }




}
