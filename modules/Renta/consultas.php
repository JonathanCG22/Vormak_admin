<?php
class CRUD_IAlmacen extends CRUD
{	
	/***************************************************************************
    ******                        inventario                               *****
    ***************************************************************************/
    public function Movimiento_X_Almacen2($objeto)//muestra todos los datos de movimiento_andamio
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM movimiento_andamio WHERE (entrada_cliente = '$objeto->proyecto' OR salida_cliente = '$objeto->proyecto' $objeto->condicion) ORDER BY id_mov DESC LIMIT 300 ")or die("Error : ".mysqli_error($conexion));
        //$result = mysqli_query($conexion, "SELECT * FROM movimiento_andamio WHERE (entrada_cliente LIKE '6000%' OR salida_cliente LIKE '6000%' OR entrada_cliente = 'AP/0' OR salida_cliente = 'AP/0' OR entrada_cliente = 'Todos/0' OR salida_cliente = 'Todos/0') ORDER BY id_mov DESC LIMIT 300 ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    
    public function mostrar_almacenes2($objeto) //muestra todos los datos de almacen
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM almacenes_rentas WHERE id = '$objeto->proyecto'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    
    public function total_almacen2($objeto)//muestra la suma todal de la cantidad de piezas en la tabla almacen
    {
        $conexion = $this->ConectarBD();
        //$result = mysqli_query($conexion, "SELECT SUM(`$objeto->columna`) AS SUMA FROM almacen")or die("Error : ".mysqli_error($conexion));
        $result = mysqli_query($conexion, "SELECT SUM(Npiezas) AS total FROM movimiento_andamio WHERE (entrada_cliente = '$objeto->proyecto' OR salida_cliente = '$objeto->proyecto') ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function total_compras($almacen, $tipo)//muestra la suma todal de la cantidad de piezas en la tabla almacen
    {
        $conexion = $this->ConectarBD();
        // $result = mysqli_query($conexion, "SELECT SUM(`$objeto->columna`) AS SUMA FROM almacen")or die("Error : ".mysqli_error($conexion));
        $result = mysqli_query($conexion, "SELECT almacen.codigo AS codigo, almacen.categoria AS categoria, almacen.descripcion AS descripcion, piezas_andamio.$almacen AS stock  FROM almacen INNER JOIN piezas_andamio ON almacen.codigo = piezas_andamio.codigo where almacen.tipo = '$tipo' ORDER BY almacen.indice_categoria, almacen.indice")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    
    public function total_plantas($almacen, $tipo)//muestra la suma todal de la cantidad de piezas en la tabla almacen
    {
        $conexion = $this->ConectarBD();
        // $result = mysqli_query($conexion, "SELECT SUM(`$objeto->columna`) AS SUMA FROM almacen")or die("Error : ".mysqli_error($conexion));
        $result = mysqli_query($conexion, "SELECT almacen.codigo AS codigo, almacen.categoria AS categoria, almacen.descripcion AS descripcion, piezas_andamio.$almacen AS stock  FROM almacen INNER JOIN piezas_andamio ON almacen.codigo = piezas_andamio.codigo  ORDER BY almacen.indice_categoria, almacen.indice")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function total_rentas($almacen, $tipo)//muestra la suma todal de la cantidad de piezas en la tabla almacen
    {
        $conexion = $this->ConectarBD();
        // $result = mysqli_query($conexion, "SELECT SUM(`$objeto->columna`) AS SUMA FROM almacen")or die("Error : ".mysqli_error($conexion));
        $result = mysqli_query($conexion, "SELECT codigo, categoria, descripcion, `$almacen` AS stock  FROM almacen  where tipo = '$tipo' ORDER BY indice_categoria, indice")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function total_almacen_principal($almacen, $tipo)//muestra la suma todal de la cantidad de piezas en la tabla almacen
    {
        $conexion = $this->ConectarBD();
        // $result = mysqli_query($conexion, "SELECT SUM(`$objeto->columna`) AS SUMA FROM almacen")or die("Error : ".mysqli_error($conexion));
        $result = mysqli_query($conexion, "SELECT codigo, categoria, descripcion, `$almacen` AS stock  FROM almacen  where tipo = '$tipo' ORDER BY indice_categoria, indice")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra el nombre del proyecto que tenga ese id
    public function obtenerProyecto($proyecto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT nom_almacen, cliente FROM rentamaterial WHERE id = '$proyecto' UNION
                                          (SELECT nom_almacen, cliente FROM ventamaterial WHERE id = '$proyecto') UNION
                                          (SELECT nom_almacen, cliente FROM manoobra WHERE id = '$proyecto') UNION
                                          (SELECT nom_almacen, cliente FROM preciofijo WHERE id = '$proyecto') UNION
                                          (SELECT nom_almacen, cliente FROM materialmanoobra WHERE id = '$proyecto') UNION
                                          (SELECT nom_almacen, proveedor FROM almacenes_rentas WHERE id = '$proyecto') 
                                          ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    
    /***************************************************************************
    ******                        hoja_trabajo                             *****
    ***************************************************************************/
    public function Buscar_PiezasArmadas($objeto)
    {
        $aDatosPiezas = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, clientes_id, n_proyecto, cargo, folio, piezas, fchRarmado FROM `hoja_trabajo` WHERE (status = 'Abierto' OR (status = 'cerrado'  AND fchRdesarmado > '$objeto->hoy' ) ) $objeto->cosulta ORDER BY fchRarmado ASC") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);

        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosPiezas[$cont] = array('id_hj' => $data['id_hj'], 'clientes_id' => $data['clientes_id'], 'n_proyecto' => $data['n_proyecto'], 'cargo' => $data['cargo'], 'folio' => $data['folio'], 'piezas' => $data['piezas'], 'fchRarmado' => $data['fchRarmado']);
          $cont++;
        }
        return $aDatosPiezas;
    }
    
    public function codigos2() //muestra todos los codigos dentro de un arreglo
    {
        $aCodigos = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT codigo, descripcion FROM almacen ORDER BY id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        while ($data = mysqli_fetch_array($result)) {
          $aCodigos[$data['codigo']] = $data['descripcion'];
        }
        return $aCodigos;
    }
    
    public function ProyectosConAlmacen($objeto)
    {
        $Proyectos = '';
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id FROM `ventamaterial` WHERE cliente = '$objeto->cliente' AND nom_almacen != '' UNION 
                                           SELECT id FROM `rentamaterial` WHERE cliente = '$objeto->cliente' AND nom_almacen != '' UNION 
                                           SELECT id FROM `preciofijo` WHERE cliente = '$objeto->cliente' AND nom_almacen != '' UNION 
                                           SELECT id FROM `materialmanoobra` WHERE cliente = '$objeto->cliente' AND nom_almacen != '' UNION 
                                           SELECT id FROM `proyec_faltante` WHERE cliente = '$objeto->cliente' AND nom_almacen != '' 
                                          ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        while ($data = mysqli_fetch_array($result)) {
            if($Proyectos == ''){
                $Proyectos = "'".$data['id']."'";
            }else{
                $Proyectos = $Proyectos.",'".$data['id']."'";
            }
        }
        return $Proyectos;
    }
    
    public function ProyectosConAlmacen2($objeto)
    {
        $Proyectos = '';
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id FROM `ventamaterial` WHERE proyecto_almacen  = '$objeto->almacen' UNION 
                                           SELECT id FROM `rentamaterial` WHERE proyecto_almacen  = '$objeto->almacen' UNION 
                                           SELECT id FROM `preciofijo` WHERE proyecto_almacen  = '$objeto->almacen' UNION 
                                           SELECT id FROM `materialmanoobra` WHERE proyecto_almacen  = '$objeto->almacen' UNION 
                                           SELECT id FROM `proyec_faltante` WHERE proyecto_almacen  = '$objeto->almacen' 
                                          ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        while ($data = mysqli_fetch_array($result)) {
            if($Proyectos == ''){
                $Proyectos = "'".$data['id']."'";
            }else{
                $Proyectos = $Proyectos.",'".$data['id']."'";
            }
        }
        return $Proyectos;
    }
    
}

class Objeto_IAlmacen{ }
?>