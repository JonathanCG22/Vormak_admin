<?php
session_start();
require_once "../../config/conexion.php";
$objeto = new Objeto;
$crud = new CRUD;

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {
    if (isset($_GET['act']) && $_GET['act'] =='insert_mantenimiento') {
        if (isset($_POST['Guardar'])) {
            $objeto->ne     = $_POST['ne'];
            $objeto->descripcion       = $_POST['descripcion'];
            $objeto->costomantenimiento        = $_POST['costomantenimiento'];
            $objeto->fechamantenimiento           = $_POST['fechamantenimiento'];
            //sumo 1 semana
            $objeto->fechaprox         = date("Y-m-d",strtotime( date($_POST['fechamantenimiento'],"d-m-Y")."+ 1 week")); 
            $objeto->estatus           = 2;
           // $objeto->horometro           = $_POST['horometro'];
            //insertar mantenimiento
            $objeto->horometro  = $_POST['horometro'];
            $objeto->diesel  = $_POST['diesel'];
            $objeto->ubicacion  = $_POST['ubicacion'];
            $objeto->aceite  = $_POST['aceite'];
            $objeto->refrigerante    = $_POST['refrigerante'];
            $objeto->marcab  = $_POST['marcabateria'];
            $objeto->llavea           = $_POST['llavea'];
            $objeto->radiador          = $_POST['radiador'];
            $objeto->combustible           = $_POST['combustible'];
            $objeto->tuercas  = $_POST['tuercas'];
            $objeto->selectores           = $_POST['selectores'];
            $objeto->interruptores           = $_POST['interruptores'];
            $objeto->contactos           = $_POST['contactos'];
            $objeto->focos           = $_POST['focos'];
            $objeto->mastil           = $_POST['mastil'];
            $objeto->llantas           = $_POST['llantas'];
            $objeto->remolque           = $_POST['remolque'];
            $objeto->patin           = $_POST['patin'];
            $objeto->tiron           = $_POST['tiron'];
            $objeto->cadenas           = $_POST['cadenas'];
            $objeto->matachispas           = $_POST['matachispas'];
            $objeto->condiciones  = $_POST['condiciones'];
            $objeto->accesorios  = $_POST['accesorios'];
            $query = $crud->agregar_Mantenimiento_E($objeto);

            if ($query) {
                echo "<script>location.href='../../main.php?module=Mantenimiento_Equipo&alert=1';</script>";
            }
        }
    } elseif (isset($_GET['act']) && $_GET['act'] =='update_renta') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['id'])) {
                $objeto->id     = $_POST['id'];
                $objeto->ne     = $_POST['ne'];
            $objeto->descripcion       = $_POST['descripcion'];
            $objeto->costomantenimiento        = $_POST['costomantenimiento'];
            $objeto->fechamantenimiento           = $_POST['fechamantenimiento'];
            $objeto->fechaprox          = $_POST['fechaprox'];
            $objeto->horometro           = $_POST['horometro'];
                $query = $crud->actualizar_mantenimiento_E($objeto);

                if ($query) {
                    echo "<script>location.href='../../main.php?module=Mantenimiento_Equipo&alert=2';</script>";
                }
            }
        }
    } elseif ($_GET['act']=='off') {
        if (isset($_GET['idm'])) {
            $idm = $_GET['idm'];


            $query = $crud->desactivar_mantenimiento($idm);

            if ($query) {
                header("location: ../../main.php?module=Mantenimiento_Equipo&alert=8");
            }
        }
    } 
    
    if(isset($_POST['dato']) && $_POST['dato'] == "consultarPrefijo"){
        $objeto->prefijo = $_POST['prefijo'];

        if ($_POST['x'] == 0) {
            $tag    = "tag";
        }else{
            $tag    = "tag1";
        }

        $respuesta  = $crud->mostrarPrefijo($objeto);
        $aDato = '<ul id="'.$tag.'" class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" tabindex="-1" style="width: 100%; top: 0.216675px; left: -0.25px; display: block; position: absolute; background: currentColor; cursor: pointer; padding: 10px !important;">';

        while ($date = mysqli_fetch_array($respuesta)) {
            $aDato = $aDato. '<li class="ui-menu-item" tabindex="-1" onclick="updatePrefijo(' .$_POST['x']. ', \'' .$date['prefijo']. '\');">' 
                                      .$date['prefijo']. ' - '.$date['nombre'].
                                    '</li>';
        }
        $aDato = $aDato. '</ul>';
        echo json_encode($aDato);
    }
}
