<?php
session_start();
require_once "../../config/conexion.php";
$objeto = new Objeto;
$crud = new CRUD;

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {
    if (isset($_GET['act']) && $_GET['act'] =='insert_cliente') {
        if (isset($_POST['Guardar'])) {
            $objeto->rfc     = $_POST['rfc'];
            $objeto->regimen     = $_POST['regimen'];
            $objeto->cfdi     = $_POST['cfdi'];
            $objeto->razonsocial     = $_POST['razonsocial'];
            $objeto->direccion       = $_POST['direccion'];
            $objeto->telefono        = $_POST['telefono'];
            $objeto->email           = $_POST['email'];
           $objeto->imgacta = subir("actac", "img_Acta_constitutiva");
           $objeto->imgpoder =subir("podern", "img_Poder_notarial");
           $objeto->imgcomprobante =subir("comprobanted", "img_Comprobante_de_domicilio");
           $objeto->imgIFE =subir("IFE", "img_Representante_legal");
           $objeto->imgcuenta =subir("ecuenta", "img_Estado_de_cuenta");
           
            //insertar cliente
            $query = $crud->agregar_cliente_A($objeto);

            if ($query) {
                echo "<script>location.href='../../main.php?module=Arrendamiento&alert=1';</script>";
            }
        }
    } elseif (isset($_GET['act']) && $_GET['act'] =='update_cliente') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['id'])) {
                $objeto->rfca = $_POST['id'];
                $objeto->rfc              = $_POST['RFCMD'];
                $objeto->razonsocial     = $_POST['razonsocialMD'];
                $objeto->regimen          = $_POST['regimenMD'];
                $objeto->cfdi         = $_POST['cfdiMD'];
                $objeto->direccion       = $_POST['direccionMD'];
                $objeto->telefono        = $_POST['telefonoMD'];
                $objeto->email           = $_POST['emailMD'];
                

                $query = $crud->actualizar_cliente_A($objeto);

                if ($query) {
                    echo "<script>location.href='../../main.php?module=Arrendamiento&alert=2';</script>";
                }
            }
        }
    }elseif (isset($_GET['act']) && $_GET['act'] =='update_img_cliente') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['datos'])) {
                $img = explode("*", $_POST['datos']);
                $objeto->rfc              = $img[2];
                $objeto->columna = $img[1];
                $objeto->imgm = subir("imgm", $img[0]);
                $query = $crud->actualizar_imagen($objeto);

                if ($query) {
                    echo "<script>location.href='../../main.php?module=Arrendamiento&alert=2';</script>";
                }
            }
        }
    } elseif (isset($_GET['act']) && $_GET['act'] =='delete') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
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

function subir($name, $ruta){
    $file = $_FILES[$name]["name"]; //Nombre de nuestro archivo
    $url_temp = $_FILES[$name]["tmp_name"]; //Ruta temporal a donde se carga el archivo 
    //dirname(__FILE__) nos otorga la ruta absoluta hasta el archivo en ejecución
    $url_insert = dirname(__FILE__) . "/".$ruta; //Carpeta donde subiremos nuestros archivos
    //Ruta donde se guardara el archivo, usamos str_replace para reemplazar los "\" por "/"
    $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;
    //Si la carpeta no existe, la creamos
    if (!file_exists($url_insert)) {
        mkdir($url_insert, 0777, true);
    };
    //movemos el archivo de la carpeta temporal a la carpeta objetivo y verificamos si fue exitoso
    if (move_uploaded_file($url_temp, $url_target)) {
        //echo "El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.";
    } else {
       // echo "Ha habido un error al cargar tu archivo.";
    }

    return $file;
}