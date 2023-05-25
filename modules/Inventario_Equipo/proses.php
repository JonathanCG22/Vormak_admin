<?php
session_start();
require_once "../../config/conexion.php";
$objeto = new Objeto;
$crud = new CRUD;

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {
    if (isset($_GET['act']) && $_GET['act'] =='insert_equipo') {
        if (isset($_POST['Guardar'])) {
            $objeto->ne     = $_POST['ne'];
            $objeto->modelo          = $_POST['modelo'];
            $objeto->descripcion       = $_POST['descripcion'];
            $objeto->ns        = $_POST['ns'];
            $objeto->tipoequipo           = $_POST['combo1'];
            $objeto->estatus           = $_POST['combo3'];
            $objeto->fechaadquisicion           = $_POST['fechaad'];
            $objeto->costo           = $_POST['costo'];
            //insertar equipo
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

            $query = $crud->agregar_Inventario_E($objeto);

            if ($query) {
                echo "<script>location.href='../../main.php?module=Inventario_Equipo&alert=1';</script>";
            }
        }
    } elseif (isset($_GET['act']) && $_GET['act'] =='update_cliente') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['id'])) {
                $objeto->ne     = $_POST['ne'];
                $objeto->modelo          = $_POST['modelo'];
                $objeto->descripcion       = $_POST['descripcion'];
                $objeto->ns        = $_POST['ns'];
                $objeto->tipoequipo           = $_POST['combo1'];
                $objeto->estatus           = $_POST['combo3'];
                $objeto->fechaadquisicion           = $_POST['fechaad'];
                $objeto->costo           = $_POST['costo'];

                $query = $crud->actualizar_inventario_E($objeto);

                if ($query) {
                    echo "<script>location.href='../../main.php?module=Inventario_Equipo&alert=2';</script>";
                }
            }
        }
    } elseif (isset($_GET['act']) && $_GET['act'] =='delete') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
    } elseif ($_GET['act']=='enviar_peticion') {
        if (isset($_GET['ne'])) {
            $ne = $_GET['ne'];


            $query = $crud->Actualizar_Estatus_E($ne, 6);
            $query2 = $crud->agregar_peticion($ne);
            if ($query && $query2) {
                header("location: ../../main.php?module=Inventario_Equipo&alert=7");
            }
        }
    }elseif ($_GET['act']=='on') {
        if (isset($_GET['ne'])) {
            $ne = $_GET['ne'];


            $query = $crud->Actualizar_Estatus_E($ne, 1);

            if ($query) {
                header("location: ../../main.php?module=Inventario_Equipo&alert=7");
            }
        }
    } elseif ($_GET['act']=='off') {
        if (isset($_GET['ne'])) {
            $ne = $_GET['ne'];


            $query = $crud->Actualizar_Estatus_E($ne, 0);

            if ($query) {
                header("location: ../../main.php?module=Inventario_Equipo&alert=8");
            }
        }
    } elseif (isset($_GET['act']) && $_GET['act'] =='agregar_tipo') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['id'])) {
                $objeto->descripcion     = $_POST['descripcion'];

                $query = $crud->agregar_inventario_T($objeto);

                if ($query) {
                    echo "<script>location.href='../../main.php?module=Inventario_Equipo&alert=9';</script>";
                }
            }
        }
    }if (isset($_GET['act']) && $_GET['act'] =='agregar_plan') {
        if (isset($_POST['Guardar'])) {
            $objeto->tipo     = $_POST['tipoe'];
            $objeto->descripcion       = $_POST['descripcion'];
            $objeto->costo           = $_POST['costo'];

            $query = $crud->agregar_plan($objeto);

            if ($query) {
                echo "<script>location.href='../../main.php?module=Inventario_Equipo&alert=10';</script>";
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
