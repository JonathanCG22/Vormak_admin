<?php
class CRUD
{
    private $server = 'localhost';
    private $user = 'vormakco_jonathan';
    private $pass = 'jonathanCG13';
    private $db = 'vormakco_espejo_jonathan';
    /*private $server = 'localhost'; private $user = 'root'; private $pass = ''; private $db = 'vormakc1_crud';*/

    public function ConectarBD()
    {
        $conexion = mysqli_connect($this->server, $this->user, $this->pass, $this->db) or die("Error al conectar con la base de datos");
        $conexion->set_charset("utf8");
        return $conexion;
    }

    public function Cerrar_Conexion($conexion)
    {
        mysqli_close($conexion);
    }

    /**
    * Conexiones
    **/

    /***************************************************************************
    ******                               start                             *****
    ***************************************************************************/

    //Consultar numero de Empleados
    public function Num_Empleados()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT COUNT(id) as numero FROM andamieros")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consultar numero de Proyectos
    public function Num_Proyectos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT (select COUNT(distinct id) from rentamaterial) + (select COUNT(distinct id) from preciofijo)+(select COUNT(distinct id) from ventamaterial)+(select COUNT(distinct id) from manoobra)+(select COUNT(distinct id) from materialmanoobra) AS total")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consultar numero de Proyectos diferente de Cerrados
    public function Num_ProyectosAbiertos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT (select COUNT(distinct id) from rentamaterial WHERE estatus != 'Cerrado') + (select COUNT(distinct id) from preciofijo WHERE estatus != 'Cerrado')+(select COUNT(distinct id) from ventamaterial WHERE estatus != 'Cerrado')+(select COUNT(distinct id) from manoobra WHERE estatus != 'Cerrado')+(select COUNT(distinct id) from materialmanoobra WHERE estatus != 'Cerrado') AS total")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                                 Logueo                          *****
    ***************************************************************************/

    //Login al sistema Admin Empresur
    public function login($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM usuarios WHERE username ='$objeto->username' AND password ='$objeto->password' AND status='activo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Login al sistema Admin Empresur
    public function login_Planta($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM usuarios_planta WHERE username ='$objeto->username' AND password ='$objeto->password' AND status='activo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                           Usuarios                              *****
    ***************************************************************************/
    //Consulta de un Usuario en sesion
    public function ConsultaUsuario($id_user)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id_user='$id_user'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    //Consulta todos los Usuarios
    public function ConsultaUsuarios()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM usuarios ORDER BY id_user ASC") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    //Insertar Usuario
    public function InsertarUsuario($objeto)
    {
        $conexion = $this->ConectarBD();
        mysqli_query($conexion, "INSERT INTO usuarios(username,password,name_user,permisos_acceso, email)
                                              VALUES('$objeto->username','$objeto->password','$objeto->name_user','$objeto->permisos_acceso', '$objeto->email')") or die(mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Actualizar Usuario sin password ni foto
    public function ActualizarUsuario($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios SET username         = '$objeto->username',
                                                                   name_user        = '$objeto->name_user',
                                                                   email            = '$objeto->email',
                                                                   telefono         = '$objeto->telefono',
                                                                   permisos_acceso  = '$objeto->permisos_acceso'
                                                                   WHERE id_user    = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Actualizar Usuario sin foto
    public function ActualizarUsuario2($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios SET username           = '$objeto->username',
                                                                   name_user          = '$objeto->name_user',
                                                                   password           = '$objeto->password',
                                                                   email            = '$objeto->email',
                                                                   telefono         = '$objeto->telefono',
                                                                   permisos_acceso  = '$objeto->permisos_acceso'
                                                                   WHERE id_user      = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Actualizar Usuario sin password
    public function ActualizarUsuario3($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios SET username           = '$objeto->username',
                                                                   name_user          = '$objeto->name_user',
                                                                   email            = '$objeto->email',
                                                                   telefono         = '$objeto->telefono',
                                                                   foto                 = '$objeto->name_file',
                                                                   permisos_acceso  = '$objeto->permisos_acceso'
                                                                   WHERE id_user      = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Actualizar Usuario
    public function ActualizarUsuario4($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios SET username          = '$objeto->username',
                                                                   name_user         = '$objeto->name_user',
                                                                   password        = '$objeto->password',
                                                                   email           = '$objeto->email',
                                                                   telefono        = '$objeto->telefono',
                                                                   foto                = '$objeto->name_file',
                                                                   permisos_acceso = '$objeto->permisos_acceso'
                                                                   WHERE id_user     = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Status de  Usuario
    public function ActualizarStatusUsuario($id_user, $status)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios SET status  = '$status'
                                                                   WHERE id_user = '$id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //muestra los usuarios con ese Permiso_Acceso
    public function Permiso_user($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `usuarios` WHERE permisos_acceso = '$objeto->permiso_acceso'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Modificar planta_acceso
    public function Modificar_planta_acceso($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios
                                               SET planta_acceso     = '$objeto->planta_acceso'
                                               WHERE id_user = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //muestra los usuarios con ese Permiso_Acceso (Aux. Ventas, Ventas, Aux. Ventas2)
    public function AuxVentas()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `usuarios` WHERE (permisos_acceso = 5 OR permisos_acceso = 12 OR permisos_acceso = 13) AND status = 'activo' ") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los usuarios (Aux. Ventas, Ventas, Aux. Ventas2, gerente de ventas)
    public function vendedor_asignado()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_user, username, name_user FROM `usuarios` WHERE (permisos_acceso = 4 OR permisos_acceso = 5 OR permisos_acceso = 12 OR permisos_acceso = 13) AND status = 'activo' ") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

   /****************************************************************************
    ******                            Usuarios  Planta                     *****
    ***************************************************************************/
    //Consulta todos los Usuarios
    public function ConsultaUsuarios_Planta()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM usuarios_planta ORDER BY id_userP ASC") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta de un Usuario en sesion
    public function ConsultaUsuario_Planta($id_user)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM usuarios_planta WHERE id_userP='$id_user'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Insertar Usuario
    public function InsertarUsuario_Planta($objeto)
    {
        $conexion = $this->ConectarBD();
        mysqli_query($conexion, "INSERT INTO usuarios_planta(username,password,name_user,permisos_acceso, email, planta)
                                              VALUES('$objeto->username','$objeto->password','$objeto->name_user','$objeto->permisos_acceso', '$objeto->email', '$objeto->planta')") or die(mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

      //Actualizar Usuario sin password ni foto
    public function ActualizarUsuario_Planta($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios_planta SET username         = '$objeto->username',
                                                                          name_user        = '$objeto->name_user',
                                                                          email            = '$objeto->email',
                                                                          telefono         = '$objeto->telefono',
                                                                          permisos_acceso  = '$objeto->permisos_acceso',
                                                                          planta           = '$objeto->planta'
                                                                     WHERE id_userP        = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Actualizar Usuario sin foto
    public function ActualizarUsuario2_Planta($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios_planta SET username         = '$objeto->username',
                                                                          name_user        = '$objeto->name_user',
                                                                          password         = '$objeto->password',
                                                                          email            = '$objeto->email',
                                                                          telefono         = '$objeto->telefono',
                                                                          permisos_acceso  = '$objeto->permisos_acceso',
                                                                          planta           = '$objeto->planta'
                                                                      WHERE id_userP       = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Actualizar Usuario sin password
    public function ActualizarUsuario3_Planta($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios_planta SET username         = '$objeto->username',
                                                                          name_user        = '$objeto->name_user',
                                                                          email            = '$objeto->email',
                                                                          telefono         = '$objeto->telefono',
                                                                          foto             = '$objeto->name_file',
                                                                          permisos_acceso  = '$objeto->permisos_acceso',
                                                                          planta           = '$objeto->planta'
                                                                      WHERE id_userP       = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Actualizar Usuario
    public function ActualizarUsuario4_Planta($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios_planta SET username        = '$objeto->username',
                                                                          name_user       = '$objeto->name_user',
                                                                          password        = '$objeto->password',
                                                                          email           = '$objeto->email',
                                                                          telefono        = '$objeto->telefono',
                                                                          foto            = '$objeto->name_file',
                                                                          permisos_acceso = '$objeto->permisos_acceso',
                                                                          planta          = '$objeto->planta'
                                                                      WHERE id_userP      = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Status de  Usuario
    public function ActualizarStatusUsuario_Planta($id_user, $status)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios_planta SET status  = '$status'
                                                                          WHERE id_userP = '$id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                           Permiso_Acceso                        *****
    ***************************************************************************/
    //muestra el numero mayor de Permiso_Acceso
    public function Permiso_Acceso_Mayor()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(idAcceso) AS mayor FROM permiso_acceso") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra el primer modulo de permiso
    public function Primer_permiso_modulo($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT idModulo, nombre FROM modulos WHERE idModulo = (SELECT id_Modulo FROM permiso_modulo WHERE id_Acceso = '$objeto->id_Acceso' AND accion != ' ' ORDER BY id_Modulo LIMIT 1)") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //mostrar datos permiso_modulo
    public function DatPermiso_Modulo($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM permiso_modulo  WHERE id_Acceso = '$objeto->id_Acceso' AND id_Modulo = (SELECT idModulo FROM modulos WHERE nombre = '$objeto->id_Modulo')") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;

    }

    //muestra los Permiso_Acceso
    public function Consulta_Permiso_Acceso()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM permiso_acceso ORDER BY idAcceso ASC") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra el nombre del Permiso_Acceso de ese id
    public function obten_Permiso_Acceso($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM permiso_acceso WHERE idAcceso = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los Modulos
    public function Consulta_Modulos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM modulos ORDER BY idModulo ASC") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los datos de ese id (Modulos)
    public function muestraDatos_Modulo($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM modulos WHERE idModulo = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Insertar modulo
    public function insertar_Modulo($objeto)
    {
        $conexion = $this->ConectarBD();
        mysqli_query($conexion, "INSERT INTO modulos(nombre, opciones)
                                             VALUES('$objeto->nombre',
                                                     '$objeto->opciones')")
                                             or die(mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //Modificar modulo
    public function Modificar_Modulo($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE modulos
                                               SET nombre     = '$objeto->nombre',
                                                   opciones   = '$objeto->opciones'
                                               WHERE idModulo = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //muestra el Modulo si Existe
    public function Existe_MD($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM modulos WHERE nombre = '$objeto->nombre'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los datos de ese id (permiso)
    public function muestraDatos_Permiso($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM permiso_acceso WHERE idAcceso = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Insertar permiso Acceso
    public function insertar_permiso($objeto)
    {
        $conexion = $this->ConectarBD();
        mysqli_query($conexion, "INSERT INTO permiso_acceso(nombre)
                                             VALUES('$objeto->permisoAcceso')")
                                             or die(mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //Modificar modulo
    public function Modificar_permiso($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE permiso_acceso
                                               SET nombre     = '$objeto->permisoAcceso'
                                               WHERE idAcceso = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //muestra el permiso Acceso si Existe
    public function Existe_PA($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM permiso_acceso WHERE nombre = '$objeto->permisoAcceso'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Insertar en tabla permiso_modulo
    public function insertar_permiso_modulo($objeto)
    {
        $conexion = $this->ConectarBD();
        mysqli_query($conexion, "INSERT INTO permiso_modulo(id_Acceso, id_Modulo, accion)
                                             VALUES('$objeto->id_Acceso',
                                                    '$objeto->id_Modulo',
                                                    '$objeto->accion'  )")
                                             or die(mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //muestra los datos de ese id (permiso_modulo)
    public function Datospermiso_modulo($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM permiso_modulo WHERE id_Acceso = '$objeto->id_Acceso'
                                                                         AND  id_Modulo = '$objeto->id_Modulo'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Modificar en tabla permiso_modulo
    public function modificar_permiso_modulo($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE permiso_modulo
                                               SET accion     = '$objeto->accion'
                                               WHERE id_PM = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //para sacar lo de permiso (SELECT P.nombre AS permisoA, M.nombre AS modelo, M.campos FROM `permiso_acceso` P INNER JOIN `permiso_modulo` PM ON PM.id_Acceso = P.idAcceso INNER JOIN `modulos` M ON M.idModulo = PM.id_Modulo)
    /***************************************************************************
    ******                                Perfil                           *****
    ***************************************************************************/
    //Actualizar Perfil sin foto
    public function ActualizarPerfil($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios SET username        = '$objeto->username',
                                                                   name_user       = '$objeto->name_user',
                                                                   email         = '$objeto->email',
                                                                   telefono      = '$objeto->telefono'
                                                                   WHERE id_user = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }
    //Actualizar Perfil con foto
    public function ActualizarPerfil2($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios SET username           = '$objeto->username',
                                                                   name_user          = '$objeto->name_user',
                                                                   email            = '$objeto->email',
                                                                   telefono         = '$objeto->telefono',
                                                                   foto             = '$objeto->name_file'
                                                                   WHERE id_user      = '$objeto->id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                              Password                           *****
    ***************************************************************************/
    //Actualizar Contraseña de Usuario
    public function ActualizarPasswordUsuario($new_pass, $id_user)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE usuarios SET password        = '$new_pass'
                                                        WHERE id_user  = '$id_user'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                          Proyectos                              *****
    ***************************************************************************/

    //Consulta al Catalogo de Proyectos
    public function catalogo()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT rentamaterial.*, lista_precios.nombre_lista
                                            FROM rentamaterial
                                            LEFT JOIN lista_precios
                                            ON rentamaterial.tipoPrecioMO = lista_precios.id_lista
                                            UNION (SELECT ventamaterial.*, lista_precios.nombre_lista
                                                   FROM ventamaterial
                                                   LEFT JOIN lista_precios
                                                   ON ventamaterial.tipoPrecioMO = lista_precios.id_lista)
                                            UNION (SELECT manoobra.*, lista_precios.nombre_lista
                                                   FROM manoobra
                                                   LEFT JOIN lista_precios
                                                   ON manoobra.tipoPrecioMO = lista_precios.id_lista)
                                            UNION (SELECT preciofijo.*, lista_precios.nombre_lista
                                                   FROM preciofijo
                                                   LEFT JOIN lista_precios
                                                   ON preciofijo.tipoPrecioMO = lista_precios.id_lista)
                                            UNION (SELECT materialmanoobra.*, lista_precios.nombre_lista
                                                   FROM materialmanoobra
                                                   LEFT JOIN lista_precios
                                                   ON materialmanoobra.tipoPrecioMO = lista_precios.id_lista)
                                          ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    public function renta_material()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT rentamaterial.*, lista_precios.nombre_lista
                                            FROM rentamaterial
                                            LEFT JOIN lista_precios
                                            ON rentamaterial.tipoPrecioMO = lista_precios.id_lista
                                            ORDER BY rentamaterial.id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    public function venta_material()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT ventamaterial.*, lista_precios.nombre_lista
                                            FROM ventamaterial
                                            LEFT JOIN lista_precios
                                            ON ventamaterial.tipoPrecioMO = lista_precios.id_lista
                                            ORDER BY ventamaterial.id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    public function mano_obra()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT manoobra.*, lista_precios.nombre_lista
                                            FROM manoobra
                                            LEFT JOIN lista_precios
                                            ON manoobra.tipoPrecioMO = lista_precios.id_lista
                                            ORDER BY manoobra.id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    public function precio_fijo()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT preciofijo.*, lista_precios.nombre_lista
                                            FROM preciofijo
                                            LEFT JOIN lista_precios
                                            ON preciofijo.tipoPrecioMO = lista_precios.id_lista
                                            ORDER BY preciofijo.id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    public function material_mano_obra()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT materialmanoobra.*, lista_precios.nombre_lista
                                            FROM materialmanoobra
                                            LEFT JOIN lista_precios
                                            ON materialmanoobra.tipoPrecioMO = lista_precios.id_lista
                                            ORDER BY materialmanoobra.id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    public function insertar_proyecto($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO $objeto->clase (cliente, proyecto, tipoPrecio, tipoPrecioMO, estatus, vendedor, almacen)
                                        VALUES('$objeto->cliente','$objeto->proyecto','$objeto->tipoPrecio','$objeto->tipoPrecioMO','$objeto->estatus','$objeto->vendedor','$objeto->almacen')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function obtenerIDproyec($objeto)
    { //===consultar datos
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `$objeto->clase` WHERE id = (SELECT MAX(id) FROM `$objeto->clase`)")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function catalogo_Btn_VigenteCerrado($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE `".mysqli_escape_string($conexion,$objeto->tabla)."`
                                            SET estatus = '$objeto->status',
                                                almacen = '$objeto->almacen'
                                            WHERE id = '$objeto->proyecto'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function catalogo_updateProyec($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE `".mysqli_escape_string($conexion,$objeto->tabla)."`
                                            SET proyecto   = '$objeto->proyecto',
                                                tipoPrecio = '$objeto->tipoPrecio'
                                            WHERE id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra el nombre del proyecto que tenga ese id
    public function obtenerProyecto($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT proyecto FROM rentamaterial WHERE id = '$objeto->proyecto' UNION(SELECT proyecto FROM ventamaterial WHERE id = '$objeto->proyecto') UNION(SELECT proyecto FROM manoobra WHERE id = '$objeto->proyecto') UNION(SELECT proyecto FROM preciofijo WHERE id = '$objeto->proyecto') UNION(SELECT proyecto FROM materialmanoobra WHERE id = '$objeto->proyecto')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                            Clientes                             *****
    ***************************************************************************/

    //Consulta al Clientes por nombre corto
    public function clientes_nombre()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_cliente, nombre, mostrar FROM clientes ORDER BY id_cliente ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta al Clientes
    public function clientes()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM clientes ORDER BY id_cliente ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta al Clientes Arrendamiento
    public function clientes_A()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM clientes_A ORDER BY RFC ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //Consulta  Inventario Equipo Arrendamiento
     public function consultar_inventario_E()
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT t1.NE, t1.Modelo, t1.Descripcion, t1.NS, t1.ID_Tipo, t1.Estatus, t1.Fecha_Adquisicion, t1.Costo, t2.DESCRIPCION FROM equipo_A t1 INNER JOIN Estatus_A t2 ON t1.Estatus = t2.ID_Estatus")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

       //Consulta los diferentes estatus disponibles a elegir
       public function consultar_estatus()
       {
           $conexion = $this->ConectarBD();
           $result = mysqli_query($conexion, "SELECT * FROM Estatus_A")or die("Error : ".mysqli_error($conexion));
           $this->Cerrar_Conexion($conexion);
           return $result;
       }

     //Consulta  Inventario Disponible Equipo Arrendamiento
     public function consultar_inventario_E_D()
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * FROM equipo_A WHERE Estatus = 1")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

     public function consultar_cantidad_E_D()
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT COUNT(*) FROM equipo_A WHERE Estatus = 1")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

      //Consulta  Inventario Equipo Arrendamiento
      public function consulta_inventario_E($id)
      {
          $conexion = $this->ConectarBD();
          $result = mysqli_query($conexion, "SELECT * FROM equipo_A WHERE NE = '$id'")or die("Error : ".mysqli_error($conexion));
          $this->Cerrar_Conexion($conexion);
          return $result;
      }
    
     //Estatus de  Equipo
     public function Actualizar_Estatus_E($ne, $status)
     {
         $conexion = $this->ConectarBD();
         $actualizar = mysqli_query($conexion, "UPDATE equipo_A SET Estatus  = '$status'
                                                                    WHERE NE = '$ne'") or die("Error: ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return "true";
     }

     //actualizar disponibilidad de  Equipo
     public function actualizar_disponibilidad_E($ne, $dispo)
     {
         $conexion = $this->ConectarBD();
         $actualizar = mysqli_query($conexion, "UPDATE equipo_A SET Estatus  = '$dispo'
                                                                    WHERE NE = '$ne'") or die("Error: ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return "true";
     }

     //Consulta  El Tipo De Equipo Arrendamiento
     public function consultar_Tipo_E($id)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * FROM tipo_equipo where ID_Tipo = $id")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

     //Consulta  Los Tipos De Equipos Arrendamiento
     public function consultar_Tipos_E()
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * FROM tipo_equipo ")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }
    //Actualizar Equipo Arrendamiento
    public function actualizar_Inventario_E($objeto)
    {
    $conexion = $this->ConectarBD();
    $result = mysqli_query($conexion, "UPDATE equipo_A SET NE     = '$objeto->ne',
                                                           Modelo          = '$objeto->modelo',
                                                           Descripcion       = '$objeto->descripcion',
                                                           NS        = '$objeto->ns',
                                                           ID_Tipo           = '$objeto->tipoequipo',
                                                           Disponibilidad           = '$objeto->disponible',
                                                           Estatus           = '$objeto->estatus',
                                                           Fecha_Adquisicion   = '$objeto->fechaadquisicion',
                                                           Costo           = '$objeto->costo'
                                                      WHERE NE     = '$objeto->ne'")or die("Error : ".mysqli_error($conexion));
    $this->Cerrar_Conexion($conexion);
    return $result;
    }

     //Agregar tipo de Equipo
     public function agregar_Inventario_T($objeto)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "INSERT INTO tipo_equipo (Descripcion)
                                                 VALUES('$objeto->descripcion')")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

     //Agregar Inventario Equipo
    public function agregar_Inventario_E($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO equipo_A(NE, Modelo, Descripcion, NS, ID_Tipo, Estatus, Fecha_Adquisicion, Costo, Horometro, Diesel, Ubicacion, Nivel_de_aceite, Nivel_de_refrigerante, Marca_de_bateria, Llave_de_arranque, Tapon_de_radiador, Tapon_combustible, Tuercas_mariposas, Selectores, Interruptores, Contactos, Focos_micas, Cable_mastil, Llantas, Estructura_remolque, Gato_patin, Tiron, Cadenas_de_seguridad, Matachispas, Condiciones_fisicas, Accesorios_adicionales)
                                                VALUES('$objeto->ne',
                                                       '$objeto->modelo',
                                                       '$objeto->descripcion',
                                                       '$objeto->ns',
                                                       '$objeto->tipoequipo',
                                                       '$objeto->estatus',
                                                       '$objeto->fechaadquisicion ',
                                                       '$objeto->costo',
                                                       '$objeto->horometro',
                                                        '$objeto->diesel',
                                                        '$objeto->ubicacion',
                                                        '$objeto->aceite',
                                                        '$objeto->refrigerante',
                                                        '$objeto->marcab',
                                                        '$objeto->llavea',
                                                        '$objeto->radiador',
                                                        '$objeto->combustible',
                                                        '$objeto->tuercas',
                                                        '$objeto->selectores',
                                                        '$objeto->interruptores',
                                                        '$objeto->contactos',
                                                        '$objeto->focos',
                                                        '$objeto->mastil',
                                                        '$objeto->llantas',
                                                        '$objeto->remolque',
                                                        '$objeto->patin',
                                                        '$objeto->tiron',
                                                        '$objeto->cadenas',
                                                        '$objeto->matachispas',
                                                        '$objeto->condiciones',
                                                        '$objeto->accesorios' )")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //Consulta los mantenimientos
     public function consultar_mantenimiento_E()
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * FROM mantenimiento")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

     //Consulta un mantenimiento en especifico
     public function consulta_mantenimiento_E($id)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * FROM mantenimiento WHERE ID_Mantenimiento = '$id'")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }
    
     //Agregar Mantenimiento de Equipo
     public function agregar_Mantenimiento_E($objeto)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "INSERT INTO mantenimiento(NE, Descripcion, Costo_mantenimiento, Fecha_Servicio, Proximo_Servicio, Horometro,Estatus, Diesel, Ubicacion, Nivel_de_aceite, Nivel_de_refrigerante, Marca_de_bateria, Llave_de_arranque, Tapon_de_radiador, Tapon_combustible, Tuercas_mariposas, Selectores, Interruptores, Contactos, Focos_micas, Cable_mastil, Llantas, Estructura_remolque, Gato_patin, Tiron, Cadenas_de_seguridad, Matachispas, Condiciones_fisicas, Accesorios_adicionales)
                                                 VALUES('$objeto->ne',
                                                        '$objeto->descripcion',
                                                        '$objeto->costomantenimiento',
                                                        '$objeto->fechamantenimiento',
                                                        '$objeto->fechaprox',
                                                        '$objeto->horometro',
                                                        2,
                                                        '$objeto->diesel',
                                                        '$objeto->ubicacion',
                                                        '$objeto->aceite',
                                                        '$objeto->refrigerante',
                                                        '$objeto->marcab',
                                                        '$objeto->llavea',
                                                        '$objeto->radiador',
                                                        '$objeto->combustible',
                                                        '$objeto->tuercas',
                                                        '$objeto->selectores',
                                                        '$objeto->interruptores',
                                                        '$objeto->contactos',
                                                        '$objeto->focos',
                                                        '$objeto->mastil',
                                                        '$objeto->llantas',
                                                        '$objeto->remolque',
                                                        '$objeto->patin',
                                                        '$objeto->tiron',
                                                        '$objeto->cadenas',
                                                        '$objeto->matachispas',
                                                        '$objeto->condiciones',
                                                        '$objeto->accesorios' )")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }


    //Actualizar mantenimiento 
    public function actualizar_mantenimiento_E($objeto)
    {
    $conexion = $this->ConectarBD();
    $result = mysqli_query($conexion, "UPDATE mantenimiento SET NE          = '$objeto->ne ',
                                                           Descripcion       = '$objeto->descripcion',
                                                           Costo_mantenimiento        = '$objeto->costomantenimiento ',
                                                           Fecha_Servicio           = '$objeto->fechamantenimiento',
                                                           Proximo_Servicio           = '$objeto->fechaprox ',
                                                           Horometro  = '$objeto->horometro'  WHERE ID_Mantenimiento =  '$objeto->id'")or die("Error : ".mysqli_error($conexion));
    $this->Cerrar_Conexion($conexion);
    return $result;
    }
     
    //Desactivar mantenimiento
     public function desactivar_mantenimiento($idm)
     {  
     $conexion = $this->ConectarBD();
     $result = mysqli_query($conexion, "UPDATE mantenimiento SET Estatus  = '0' WHERE ID_Mantenimiento =  '$idm'")or die("Error : ".mysqli_error($conexion));
     $this->Cerrar_Conexion($conexion);
     return $result;
     }
      
    //Consulta tabla folios
    public function consultar_folios()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT t1.Folio, t1.Cuantos_equipos, t2.Razon_Social FROM FOLIO t1 INNER JOIN clientes_A t2 ON t1.RFC = t2.RFc order by Folio DESC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

       //Consulta total de un folio y fecha estimada de salida
       public function consulta_detalles($idf)
       {
           $conexion = $this->ConectarBD();
           $result = mysqli_query($conexion, "SELECT Fecha_inicio, SUM(Total) FROM renta WHERE Folio = '$idf'")or die("Error : ".mysqli_error($conexion));
           $this->Cerrar_Conexion($conexion);
           return $result;
       }

     //Consulta ultimo folio insertado
     public function consulta_folio()
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * from FOLIO order by Folio desc limit 1")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

      //Consulta un folio insertado
      public function consulta_folio2($idf)
      {
          $conexion = $this->ConectarBD();
          $result = mysqli_query($conexion, "SELECT t1.Cuantos_equipos, t1.ID_clientes, t2.Nombre, t2.Razon_Social from FOLIO t1 INNER JOIN clientes_A t2 ON t1.ID_clientes = t2.ID_clientes AND t1.Folio = '$idf'")or die("Error : ".mysqli_error($conexion));
          $this->Cerrar_Conexion($conexion);
          return $result;
      }
 

     //consulta la cantidad de equipos faltantes a insertar
     public function consulta_equipos_insertados()
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT COUNT(*) FROM renta WHERE Folio = (SELECT Folio from FOLIO order by Folio desc limit 1)")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

     //consulta salidas de un solo folio
     public function consulta_salidas_de_un_folio($idf)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, " SELECT t1.ID_Renta, t1.NE, t1.Folio, t2.ID_clientes  FROM renta t1 INNER JOIN FOLIO t2 ON t1.Folio = '$idf' AND t2.Folio = '$idf'")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

      //cancela el folio que se estaba creando y las rentas del folio (CASCADE)
      public function eliminar_folio($objeto)
      {
          $conexion = $this->ConectarBD();
          $result = mysqli_query($conexion, "DELETE from FOLIO WHERE Folio = '$objeto->folio'")or die("Error : ".mysqli_error($conexion));
          $this->Cerrar_Conexion($conexion);
          return $result;
      }

   
    //Crear folio
    public function crear_folio($cant_equipos, $cliente)
    {
        $conexion = $this->ConectarBD();
        $conexion->autocommit(FALSE);
        $conexion->query("INSERT INTO FOLIO(Cuantos_equipos, ID_clientes) VALUES( '$cant_equipos', $cliente)")or die("Error : ".mysqli_error($conexion));
        $conexion->commit();
        //$conexion->rollback();
        $this->Cerrar_Conexion($conexion);
        //return $result;
    }



     
     //Consulta salidas de equipos
     public function consultar_rentas_E()
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * FROM renta")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

    //Consulta entradas de equipos
    public function consultar_rentas_Entradas()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM renta_entrada")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    
     //Consulta la ultima actualizacion del equipo
     public function consulta_ultimo_check($idne)
     {
         $conexion = $this->ConectarBD();
         $tabla1 = mysqli_query($conexion,"SELECT modificacion, creacion from equipo_A WHERE NE  = '$idne'");
         $dat = mysqli_fetch_assoc($tabla1);
         if($dat['modificacion'] > $dat['creacion']){ $dat = $dat['modificacion']; }else{ $dat = $dat['creacion']; }
         $tabla2 = mysqli_query($conexion,"SELECT modificacion, creacion from mantenimiento WHERE NE  = '$idne'");
         $dat2 = mysqli_fetch_assoc($tabla2);
         if($dat2['modificacion'] > $dat2['creacion']){ $dat2 = $dat2['modificacion']; }else{ $dat2 = $dat2['creacion']; }
         $tabla3 = mysqli_query($conexion,"SELECT modificacion, creacion from renta_entrada WHERE NE  = '$idne'");
         $dat3 = mysqli_fetch_assoc($tabla3);
         if($dat3['modificacion'] > $dat3['creacion']){ $dat3 = $dat3['modificacion']; }else{ $dat3 = $dat3['creacion']; } 

         if($dat >  $dat2 && $dat > $dat3 ){ $tabla = "equipo_A"; } else { if($dat2 > $dat3 ){ $tabla = "mantenimiento"; }else{  $tabla = "renta_entrada"; } }

         $result = mysqli_query($conexion, "SELECT creacion, modificacion, Horometro, Diesel, Ubicacion, Nivel_de_aceite, Nivel_de_refrigerante, Marca_de_bateria, Llave_de_arranque, Tapon_de_radiador, Tapon_combustible, Tuercas_mariposas, Selectores, Interruptores, Contactos, Focos_micas, Cable_mastil, Llantas, Estructura_remolque, Gato_patin, Tiron, Cadenas_de_seguridad, Matachispas, Condiciones_fisicas, Accesorios_adicionales FROM $tabla WHERE NE = '$idne'")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }


     //Consulta salida de un equipo
     public function consulta_rentas_E($id)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * FROM renta WHERE ID_Renta = '$id'; ")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

     //Agregar Renta de Equipo
     public function agregar_renta_E($objeto)
     {
         $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,"INSERT INTO renta(Folio, NE, ID_Plan, Cantidad_Tiempo, Fecha_Inicio, Hora, Horometro, Diesel, Ubicacion, Total, Nivel_de_aceite, Nivel_de_refrigerante, Marca_de_bateria, Llave_de_arranque, Tapon_de_radiador, Tapon_combustible, Tuercas_mariposas, Selectores, Interruptores, Contactos, Focos_micas, Cable_mastil, Llantas, Estructura_remolque, Gato_patin, Tiron, Cadenas_de_seguridad, Matachispas, Condiciones_fisicas, Accesorios_adicionales)
                                                 VALUES('$objeto->fol',
                                                        '$objeto->idne',
                                                        '$objeto->plan',
                                                        '$objeto->cantidadt',
                                                        '$objeto->fechai',
                                                        '$objeto->hora',
                                                        '$objeto->horometro',
                                                        '$objeto->diesel',
                                                        '$objeto->ubicacion',
                                                        '$objeto->total',
                                                        '$objeto->aceite',
                                                        '$objeto->refrigerante',
                                                        '$objeto->marcab',
                                                        '$objeto->llavea',
                                                        '$objeto->radiador',
                                                        '$objeto->combustible',
                                                        '$objeto->tuercas',
                                                        '$objeto->selectores',
                                                        '$objeto->interruptores',
                                                        '$objeto->contactos',
                                                        '$objeto->focos',
                                                        '$objeto->mastil',
                                                        '$objeto->llantas',
                                                        '$objeto->remolque',
                                                        '$objeto->patin',
                                                        '$objeto->tiron',
                                                        '$objeto->cadenas',
                                                        '$objeto->matachispas',
                                                        '$objeto->condiciones',
                                                        '$objeto->accesorios' 
                                                        )")or die("Error : ".mysqli_error($conexion));

       
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

        //Actualizar Renta de Equipo
        public function actualizar_renta_E($objeto)
        {
            $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE renta SET 
                        NE     =  '$objeto->idne',
                        ID_Plan   = '$objeto->plan',
                        Cantidad_Tiempo  = '$objeto->cantidadt',
                        Fecha_Inicio   = '$objeto->fechai',
                        Hora     =   '$objeto->hora',
                        Horometro  =  '$objeto->horometro',
                        Diesel   =   '$objeto->diesel',
                        Ubicacion   =  '$objeto->ubicacion',
                        Total   =   '$objeto->total',
                        Nivel_de_aceite   =   '$objeto->aceite',
                        Nivel_de_refrigerante  =  '$objeto->refrigerante',
                        Marca_de_bateria   =  '$objeto->marcab',
                        Llave_de_arranque   =   '$objeto->llavea',
                        Tapon_de_radiador  =   '$objeto->radiador',
                        Tapon_combustible   =   '$objeto->combustible',
                        Tuercas_mariposas   =    '$objeto->tuercas',
                        Selectores   =    '$objeto->selectores',
                        Interruptores  =     '$objeto->interruptores',
                        Contactos  =     '$objeto->contactos',
                        Focos_micas  =      '$objeto->focos',
                        Cable_mastil  =      '$objeto->mastil',
                        Llantas  =      '$objeto->llantas',
                        Estructura_remolque   =       '$objeto->remolque',
                        Gato_patin  =  '$objeto->patin',
                        Tiron   =  '$objeto->tiron',
                        Cadenas_de_seguridad  =    '$objeto->cadenas',
                        Matachispas   =      '$objeto->matachispas',
                        Condiciones_fisicas   =    '$objeto->condiciones',
                        Accesorios_adicionales =  '$objeto->accesorios'
                        WHERE ID_Renta = '$objeto->idr'")or die("Error : ".mysqli_error($conexion));
            $this->Cerrar_Conexion($conexion);
            return $result;
        }
     
     //Consulta planes de equipo
     public function consulta_planes_E($id)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT ID_Plan, ID_Tipo, Descripcion, Costo FROM planes_renta WHERE ID_Tipo = '$id'")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

    //Consulta un plan en especifico
    public function consulta_plan($id)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM planes_renta WHERE ID_Plan = '$id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //Consulta un plan en especifico mediante descripcion 
     public function consulta_plan_2($id)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * FROM planes_renta WHERE ID_Plan = '$id'")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }


    //Agregar Plan
    public function agregar_plan($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO planes_renta(ID_Tipo, Descripcion, Costo)
                                                VALUES('$objeto->tipo',
                                                       '$objeto->descripcion',
                                                       '$objeto->costo')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

 //Consulta todos los planes
 public function consulta_planes()
 {
     $conexion = $this->ConectarBD();
     $result = mysqli_query($conexion, "SELECT t1.ID_Plan, t2.Descripcion, t1.Descripcion, t1.Costo  FROM planes_renta t1 INNER JOIN tipo_equipo t2 ON t1.ID_Tipo = t2.ID_Tipo")or die("Error : ".mysqli_error($conexion));
     $this->Cerrar_Conexion($conexion);
     return $result;
 }

  //Consulta todas las peticiones de mantenimiento
  public function consulta_peticiones_mantenimiento()
  {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "SELECT t1.id_peticion, t1.NE, t3.DESCRIPCION FROM peticiones_mantenimiento t1 INNER JOIN equipo_A t2 ON t1.NE = t2.NE INNER JOIN Estatus_A t3 ON t2.Estatus = t3.ID_Estatus ")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
  }

 //Agregar Peticion de mantenimiento
 public function agregar_peticion($ne)
 {
   $conexion = $this->ConectarBD();
    $result = mysqli_query($conexion, "INSERT INTO peticiones_mantenimiento(NE)
                                           VALUES('$ne')")or die("Error : ".mysqli_error($conexion));
 $this->Cerrar_Conexion($conexion);
 return $result;
 }

    //Consulta  Cliente
    public function consultar_Cliente($id)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM clientes where id_cliente = $id")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //Consulta  Cliente Arrendamiento
     public function consultar_Cliente_A($id)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT * FROM clientes_A where RFC = '$id'")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

    

    //Agregar Cliente
    public function agregar_cliente($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO clientes(razonsocial, nombre, prefijo, direccion, ciudad, estado, telefono, ext, contactoOficina, enSitio, email, email2)
                                                VALUES('$objeto->razonsocial',
                                                       '$objeto->nombre',
                                                       '$objeto->prefijo',
                                                       '$objeto->direccion',
                                                       '$objeto->ciudad',
                                                       '$objeto->estado',
                                                       '$objeto->telefono',
                                                       '$objeto->ext',
                                                       '$objeto->contactoOficina',
                                                       '$objeto->enSitio',
                                                       '$objeto->email',
                                                       '$objeto->email2')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

//Agregar Cliente Arrendamiento
public function agregar_cliente_A($objeto)
{
    $conexion = $this->ConectarBD();
    $result = mysqli_query($conexion, "INSERT INTO clientes_A(RFC, Razon_Social, Regimen, CFDI, Estatus, Direccion, celular, Email, Acta_constitutiva, Poder_notarial, Comprobante_de_domicilio, IFE_del_Representante_legal, Ultimo_estado_de_cuenta)
                                            VALUES('$objeto->rfc',
                                                '$objeto->razonsocial',
                                                '$objeto->regimen',
                                                '$objeto->cfdi',
                                                    1, 
                                                   '$objeto->direccion',
                                                   '$objeto->telefono',
                                                   '$objeto->email',
                                                   '$objeto->imgacta',
                                                   '$objeto->imgpoder',
                                                   '$objeto->imgcomprobante',
                                                   '$objeto->imgIFE',
                                                   '$objeto->imgcuenta')")or die("Error : ".mysqli_error($conexion));
    $this->Cerrar_Conexion($conexion);
    return $result;
}


    //Actualizar Cliente
    public function actualizar_cliente($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE clientes SET razonsocial     = '$objeto->razonsocial',
                                                               nombre          = '$objeto->nombre',
                                                               prefijo         = '$objeto->prefijo',
                                                               direccion       = '$objeto->direccion',
                                                               ciudad          = '$objeto->ciudad',
                                                               estado          = '$objeto->estado',
                                                               telefono        = '$objeto->telefono',
                                                               ext             = '$objeto->ext',
                                                               contactoOficina = '$objeto->contactoOficina',
                                                               enSitio         = '$objeto->enSitio',
                                                               email           = '$objeto->email',
                                                               email2          = '$objeto->email2'
                                                          WHERE id_cliente     = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //Actualizar Cliente arrendamiento
     public function actualizar_cliente_A($objeto)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "UPDATE clientes_A SET RFC  = '$objeto->rfc',
                                                                Razon_Social     = '$objeto->razonsocial',
                                                                Regimen          = '$objeto->regimen',
                                                                CFDI            =  '$objeto->cfdi',               
                                                                Direccion       = '$objeto->direccion',
                                                                Celular        = '$objeto->telefono',
                                                                Email           = '$objeto->email'
                                                           WHERE RFC     = '$objeto->rfca'")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

     //Actualizar imagen cliente
     public function actualizar_imagen($objeto)
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "UPDATE clientes_A SET $objeto->columna = '$objeto->imgm'
                                                           WHERE RFC     = '$objeto->rfc '")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

    //Consulta al Clientes
    public function Mostrarclientes()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_cliente,nombre FROM clientes WHERE mostrar = 1 ORDER BY id_cliente ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Status de  Usuario
    public function UpdateMostrar($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE clientes SET mostrar  = '$objeto->mostrar'
                                                                   WHERE id_cliente = '$objeto->id_cliente'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                           Configuracion                         *****
    ***************************************************************************/

    //Consulta  Mano de Obra Precio  de Venta
    public function consultar_mo_pv()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM mo_pv")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra personal con infonavit
    public function consultar_infonavit()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id, nombre, infonavit, infonavit_dias, infonavit_salario, infonavit_aportacion, infonavit_descuento, infonavit_valor, infonavit_amortizacion, infonavit_proporcion FROM andamieros WHERE  infonavit != ''")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    //Actualizar Mano de Obra PRecio de Venta
    public function actualizar_mo_pv($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE mo_pv SET jo_ss      = '$objeto->jo_ss',
                                                            jo_sa      = '$objeto->jo_sa',
                                                            jo_and     = '$objeto->jo_and',
                                                            jo_ayu     = '$objeto->jo_ayu',
                                                            he_ss      = '$objeto->he_ss',
                                                            he_sa      = '$objeto->he_sa',
                                                            he_and     = '$objeto->he_and',
                                                            he_ayu     = '$objeto->he_ayu',
                                                            jex_ss     = '$objeto->jex_ss',
                                                            jex_sa     = '$objeto->jex_sa',
                                                            jex_and    = '$objeto->jex_and',
                                                            jex_ayu    = '$objeto->jex_ayu'
                                                      WHERE id         = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    //Consulta  EPP
    public function consultar_epp()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM epp")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta EPP dependiendo de la descripcion
    public function Datos_EPP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM epp WHERE id = '$objeto->descripcion_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta existencia de EPP
    public function existe_EPP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM epp WHERE descripcion = '".mysqli_escape_string($conexion,$objeto->descripcion)."'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Agregar Precios EPP
     public function agregar_EPP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO epp(descripcion, jornadas, stock)
                                                VALUES('$objeto->descripcion',
                                                       '$objeto->jornadas',
                                                       '$objeto->stock')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Actualizar Precios EPP
    public function actualizar_epp($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE epp SET descripcion = '$objeto->descripcion',
                                                          jornadas    = '$objeto->jornadas'
                                                    WHERE id          = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Actualizar stock
    public function actualizar_eppStock($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE productos SET stock = '$objeto->stock'
                                                    WHERE id_producto    = '$objeto->descripcion_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                            Password                             *****
    ***************************************************************************/

    //Actualizar Precios EPP
    public function actualizar_password($id_user, $new_pass)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE usuarios SET password = '$new_pass'
                                                      WHERE id_user  = '$id_user'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Actualizar password planta
    public function actualizar_password_planta($id_user, $new_pass)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE usuarios_planta SET password = '$new_pass'
                                                      WHERE id_userP  = '$id_user'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                           Personal                              *****
    ***************************************************************************/

    //Consulta  de Personal
    public function consulta_Personal()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id,nombre,tel_cel,ocupacion,estatus,calificacion,documentos,estatus, contrato, f_no1 FROM andamieros ORDER BY id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //Consulta  personas que solicitan trabajo Jonathan G.
     public function consulta_Personal_solicitante()
     {
         $conexion = $this->ConectarBD();
         $result = mysqli_query($conexion, "SELECT id,nombre,tel_cel,ocupacion,estatus,calificacion,documentos,estatus, contrato, f_no1 FROM solicitantes ORDER BY id ASC")or die("Error : ".mysqli_error($conexion));
         $this->Cerrar_Conexion($conexion);
         return $result;
     }

    //Consulta  de Persona
    public function consulta_Persona($id)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM andamieros WHERE id= '$id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Insertar Persona
    public function insertar_Persona($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO andamieros(nombre,
                                                                  edad,
                                                                  lugar_nacimiento,
                                                                  fecha_nacimiento,
                                                                  sexo,
                                                                  domicilio,
                                                                  fecha_cd,
                                                                  tel_casa,
                                                                  tel_cel,
                                                                  correo,
                                                                  vive_con,
                                                                  estado_civil,
                                                                  banco,
                                                                  tarjeta,
                                                                  curp,
                                                                  cartilla,
                                                                  nss,
                                                                  rfc,
                                                                  ine,
                                                                  ine_vigencia,
                                                                  infonavit,
                                                                  pasaporte,
                                                                  afore,
                                                                  no_licencia,
                                                                  tipo_licencia,
                                                                  vigencia_licencia,
                                                                  nacionalidad,
                                                                  salud,
                                                                  drogas,
                                                                  sangre,
                                                                  diabetes,
                                                                  tratamiento_diabetes,
                                                                  alergia_medicamento,
                                                                  cirugias,
                                                                  cuantas_cirugias,
                                                                  audicion,
                                                                  fuma,
                                                                  semana_fuma,
                                                                  asma,
                                                                  tratamiento_asma,
                                                                  epilepsia,
                                                                  bronquitis,
                                                                  tratamiento_bronquitis,
                                                                  alteracion_vista,
                                                                  otro,
                                                                  estudios,
                                                                  titulo,
                                                                  instituto,
                                                                  software,
                                                                  idiomas,
                                                                  periodo_1,
                                                                  periodo_2,
                                                                  periodo_3,
                                                                  empresa_1,
                                                                  empresa_2,
                                                                  empresa_3,
                                                                  telefono_1,
                                                                  telefono_2,
                                                                  telefono_3,
                                                                  puesto_1,
                                                                  puesto_2,
                                                                  puesto_3,
                                                                  separacion_1,
                                                                  separacion_2,
                                                                  separacion_3,
                                                                  jefe_1,
                                                                  jefe_2,
                                                                  jefe_3,
                                                                  informes_1,
                                                                  informes_2,
                                                                  informes_3,
                                                                  planta_1,
                                                                  planta_2,
                                                                  planta_3,
                                                                  categoria_1,
                                                                  categoria_2,
                                                                  categoria_3,
                                                                  dc3_1,
                                                                  dc3_2,
                                                                  dc3_3,
                                                                  puesto_planta_1,
                                                                  puesto_planta_2,
                                                                  puesto_planta_3,
                                                                  carnet_1,
                                                                  carnet_2,
                                                                  carnet_3,
                                                                  vigencia_1,
                                                                  vigencia_2,
                                                                  vigencia_3,
                                                                  cursos_1,
                                                                  cursos_2,
                                                                  cursos_3,
                                                                  contacto_emergencia,
                                                                  parentesco,
                                                                  tel_emergencia,
                                                                  papa_nombre,
                                                                  papa_status,
                                                                  papa_direccion,
                                                                  papa_tel_casa,
                                                                  papa_tel_movil,
                                                                  mama_nombre,
                                                                  mama_status,
                                                                  mama_direccion,
                                                                  mama_tel_casa,
                                                                  mama_tel_movil,
                                                                  esposo_nombre,
                                                                  esposo_status,
                                                                  esposo_direccion,
                                                                  esposo_tel_casa,
                                                                  esposo_tel_movil,
                                                                  hijo_1_nombre,
                                                                  hijo_1_edad,
                                                                  hijo_1_estudia,
                                                                  hijo_1_estudios,
                                                                  hijo_2_nombre,
                                                                  hijo_2_edad,
                                                                  hijo_2_estudia,
                                                                  hijo_2_estudios,
                                                                  hijo_3_nombre,
                                                                  hijo_3_edad,
                                                                  hijo_3_estudia,
                                                                  hijo_3_estudios,
                                                                  beneficiario_1_nombre,
                                                                  beneficiario_1_domicilio,
                                                                  beneficiario_1_parentesco,
                                                                  beneficiario_1_nacimiento,
                                                                  beneficiario_1_porcentaje,
                                                                  beneficiario_2_nombre,
                                                                  beneficiario_2_domicilio,
                                                                  beneficiario_2_parentesco,
                                                                  beneficiario_2_nacimiento,
                                                                  beneficiario_2_porcentaje,
                                                                  referencia_1_nombre,
                                                                  referencia_1_domicilio,
                                                                  referencia_1_tel_casa,
                                                                  referencia_1_tel_movil,
                                                                  referencia_2_nombre,
                                                                  referencia_2_domicilio,
                                                                  referencia_2_tel_casa,
                                                                  referencia_2_tel_movil,
                                                                  referencia_3_nombre,
                                                                  referencia_3_domicilio,
                                                                  referencia_3_tel_casa,
                                                                  referencia_3_tel_movil,
                                                                  estatus,
                                                                  calificacion,
                                                                  departamento,
                                                                  ocupacion,
                                                                  categoria,
                                                                  observaciones,
                                                                  contrato,
                                                                  documentos,
                                                                  dacta,
                                                                  dine,
                                                                  dcd,
                                                                  dcurp,
                                                                  drfc,
                                                                  dns,
                                                                  foto_1,
                                                                  foto_2,
                                                                  foto_3,
                                                                  edito)
                                                                  VALUES('$objeto->nombre',
                                                                          '$objeto->edad',
                                                                          '$objeto->lugar_nacimiento',
                                                                          '$objeto->fecha_nacimiento',
                                                                          '$objeto->sexo',
                                                                          '$objeto->domicilio',
                                                                          '$objeto->fecha_cd',
                                                                          '$objeto->tel_casa',
                                                                          '$objeto->tel_cel',
                                                                          '$objeto->correo',
                                                                          '$objeto->vive_con',
                                                                          '$objeto->estado_civil',
                                                                          '$objeto->banco',
                                                                          '$objeto->tarjeta',
                                                                          '$objeto->curp',
                                                                          '$objeto->cartilla',
                                                                          '$objeto->nss',
                                                                          '$objeto->rfc',
                                                                          '$objeto->ine',
                                                                          '$objeto->ine_vigencia',
                                                                          '$objeto->infonavit',
                                                                          '$objeto->pasaporte',
                                                                          '$objeto->afore',
                                                                          '$objeto->no_licencia',
                                                                          '$objeto->tipo_licencia',
                                                                          '$objeto->vigencia_licencia',
                                                                          '$objeto->nacionalidad',
                                                                          '$objeto->salud',
                                                                          '$objeto->drogas',
                                                                          '$objeto->sangre',
                                                                          '$objeto->diabetes',
                                                                          '$objeto->tratamiento_diabetes',
                                                                          '$objeto->alergia_medicamento',
                                                                          '$objeto->cirugias',
                                                                          '$objeto->cuantas_cirugias',
                                                                          '$objeto->audicion',
                                                                          '$objeto->fuma',
                                                                          '$objeto->semana_fuma',
                                                                          '$objeto->asma',
                                                                          '$objeto->tratamiento_asma',
                                                                          '$objeto->epilepsia',
                                                                          '$objeto->bronquitis',
                                                                          '$objeto->tratamiento_bronquitis',
                                                                          '$objeto->alteracion_vista',
                                                                          '$objeto->otro',
                                                                          '$objeto->estudios',
                                                                          '$objeto->titulo',
                                                                          '$objeto->instituto',
                                                                          '$objeto->software',
                                                                          '$objeto->idiomas',
                                                                          '$objeto->periodo_1',
                                                                          '$objeto->periodo_2',
                                                                          '$objeto->periodo_3',
                                                                          '$objeto->empresa_1',
                                                                          '$objeto->empresa_2',
                                                                          '$objeto->empresa_3',
                                                                          '$objeto->telefono_1',
                                                                          '$objeto->telefono_2',
                                                                          '$objeto->telefono_3',
                                                                          '$objeto->puesto_1',
                                                                          '$objeto->puesto_2',
                                                                          '$objeto->puesto_3',
                                                                          '$objeto->separacion_1',
                                                                          '$objeto->separacion_2',
                                                                          '$objeto->separacion_3',
                                                                          '$objeto->jefe_1',
                                                                          '$objeto->jefe_2',
                                                                          '$objeto->jefe_3',
                                                                          '$objeto->informes_1',
                                                                          '$objeto->informes_2',
                                                                          '$objeto->informes_3',
                                                                          '$objeto->planta_1',
                                                                          '$objeto->planta_2',
                                                                          '$objeto->planta_3',
                                                                          '$objeto->categoria_1',
                                                                          '$objeto->categoria_2',
                                                                          '$objeto->categoria_3',
                                                                          '$objeto->dc3_1',
                                                                          '$objeto->dc3_2',
                                                                          '$objeto->dc3_3',
                                                                          '$objeto->puesto_planta_1',
                                                                          '$objeto->puesto_planta_2',
                                                                          '$objeto->puesto_planta_3',
                                                                          '$objeto->carnet_1',
                                                                          '$objeto->carnet_2',
                                                                          '$objeto->carnet_3',
                                                                          '$objeto->vigencia_1',
                                                                          '$objeto->vigencia_2',
                                                                          '$objeto->vigencia_3',
                                                                          '$objeto->cursos_1',
                                                                          '$objeto->cursos_2',
                                                                          '$objeto->cursos_3',
                                                                          '$objeto->contacto_emergencia',
                                                                          '$objeto->parentesco',
                                                                          '$objeto->tel_emergencia',
                                                                          '$objeto->papa_nombre',
                                                                          '$objeto->papa_status',
                                                                          '$objeto->papa_direccion',
                                                                          '$objeto->papa_tel_casa',
                                                                          '$objeto->papa_tel_movil',
                                                                          '$objeto->mama_nombre',
                                                                          '$objeto->mama_status',
                                                                          '$objeto->mama_direccion',
                                                                          '$objeto->mama_tel_casa',
                                                                          '$objeto->mama_tel_movil',
                                                                          '$objeto->esposo_nombre',
                                                                          '$objeto->esposo_status',
                                                                          '$objeto->esposo_direccion',
                                                                          '$objeto->esposo_tel_casa',
                                                                          '$objeto->esposo_tel_movil',
                                                                          '$objeto->hijo_1_nombre',
                                                                          '$objeto->hijo_1_edad',
                                                                          '$objeto->hijo_1_estudia',
                                                                          '$objeto->hijo_1_estudios',
                                                                          '$objeto->hijo_2_nombre',
                                                                          '$objeto->hijo_2_edad',
                                                                          '$objeto->hijo_2_estudia',
                                                                          '$objeto->hijo_2_estudios',
                                                                          '$objeto->hijo_3_nombre',
                                                                          '$objeto->hijo_3_edad',
                                                                          '$objeto->hijo_3_estudia',
                                                                          '$objeto->hijo_3_estudios',
                                                                          '$objeto->beneficiario_1_nombre',
                                                                          '$objeto->beneficiario_1_domicilio',
                                                                          '$objeto->beneficiario_1_parentesco',
                                                                          '$objeto->beneficiario_1_nacimiento',
                                                                          '$objeto->beneficiario_1_porcentaje',
                                                                          '$objeto->beneficiario_2_nombre',
                                                                          '$objeto->beneficiario_2_domicilio',
                                                                          '$objeto->beneficiario_2_parentesco',
                                                                          '$objeto->beneficiario_2_nacimiento',
                                                                          '$objeto->beneficiario_2_porcentaje',
                                                                          '$objeto->referencia_1_nombre',
                                                                          '$objeto->referencia_1_domicilio',
                                                                          '$objeto->referencia_1_tel_casa',
                                                                          '$objeto->referencia_1_tel_movil',
                                                                          '$objeto->referencia_2_nombre',
                                                                          '$objeto->referencia_2_domicilio',
                                                                          '$objeto->referencia_2_tel_casa',
                                                                          '$objeto->referencia_2_tel_movi',
                                                                          '$objeto->referencia_3_nombre',
                                                                          '$objeto->referencia_3_domicilio',
                                                                          '$objeto->referencia_3_tel_casa',
                                                                          '$objeto->referencia_3_tel_movil',
                                                                          '$objeto->estatus',
                                                                          '$objeto->calificacion',
                                                                          '$objeto->departamento',
                                                                          '$objeto->ocupacion',
                                                                          '$objeto->categoria',
                                                                          '$objeto->observaciones',
                                                                          '$objeto->contrato',
                                                                          '$objeto->documentos',
                                                                          '$objeto->dacta',
                                                                          '$objeto->dine',
                                                                          '$objeto->dcd',
                                                                          '$objeto->dcurp',
                                                                          '$objeto->drfc',
                                                                          '$objeto->dns',
                                                                          '$objeto->foto_1',
                                                                          '$objeto->foto_2',
                                                                          '$objeto->foto_3',
                                                                          '$objeto->edito')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    // Insertar Huellas Dactilares
    public function insertar_huella($id,$objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE andamieros SET f_no1       = '$objeto->fu_no1',
                                                               f_no2       = '$objeto->fu_no2',
                                                               fptemplate1 = '$objeto->fputemplate1',
                                                               fptemplate2 = '$objeto->fputemplate2'
                                                               WHERE id = '$id'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    //Consulta  de Persona
    public function actualizar_Persona($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE andamieros SET  nombre = '$objeto->nombre',
                                                                  edad = '$objeto->edad',
                                                                  lugar_nacimiento = '$objeto->lugar_nacimiento',
                                                                  fecha_nacimiento = '$objeto->fecha_nacimiento',
                                                                  sexo = '$objeto->sexo',
                                                                  domicilio = '$objeto->domicilio',
                                                                  fecha_cd = '$objeto->fecha_cd',
                                                                  tel_casa = '$objeto->tel_casa',
                                                                  tel_cel = '$objeto->tel_cel',
                                                                  correo = '$objeto->correo',
                                                                  vive_con = '$objeto->vive_con',
                                                                  estado_civil = '$objeto->estado_civil',
                                                                  banco = '$objeto->banco',
                                                                  tarjeta = '$objeto->tarjeta',
                                                                  curp    = '$objeto->curp',
                                                                  cartilla = '$objeto->cartilla',
                                                                  nss = '$objeto->nss',
                                                                  rfc = '$objeto->rfc',
                                                                  ine = '$objeto->ine',
                                                                  ine_vigencia = '$objeto->ine_vigencia',
                                                                  infonavit = '$objeto->infonavit',
                                                                  pasaporte = '$objeto->pasaporte',
                                                                  afore = '$objeto->afore',
                                                                  no_licencia = '$objeto->no_licencia',
                                                                  tipo_licencia = '$objeto->tipo_licencia',
                                                                  vigencia_licencia = '$objeto->vigencia_licencia',
                                                                  nacionalidad = '$objeto->nacionalidad',
                                                                  salud = '$objeto->salud',
                                                                  drogas = '$objeto->drogas',
                                                                  sangre = '$objeto->sangre',
                                                                  diabetes = '$objeto->sangre',
                                                                  diabetes = '$objeto->diabetes',
                                                                  tratamiento_diabetes = '$objeto->tratamiento_diabetes',
                                                                  alergia_medicamento = '$objeto->alergia_medicamento',
                                                                  cirugias = '$objeto->cirugias',
                                                                  cuantas_cirugias = '$objeto->cuantas_cirugias',
                                                                  audicion = '$objeto->audicion',
                                                                  fuma = '$objeto->fuma',
                                                                  semana_fuma = '$objeto->semana_fuma',
                                                                  asma = '$objeto->asma',
                                                                  tratamiento_asma = '$objeto->tratamiento_asma',
                                                                  epilepsia = '$objeto->epilepsia',
                                                                  bronquitis = '$objeto->bronquitis',
                                                                  tratamiento_bronquitis = '$objeto->tratamiento_bronquitis',
                                                                  alteracion_vista = '$objeto->alteracion_vista',
                                                                  otro = '$objeto->otro',
                                                                  estudios = '$objeto->estudios',
                                                                  titulo = '$objeto->titulo',
                                                                  instituto = '$objeto->instituto',
                                                                  software = '$objeto->software',
                                                                  idiomas = '$objeto->idiomas',
                                                                  periodo_1 = '$objeto->periodo_1',
                                                                  periodo_2 = '$objeto->periodo_2',
                                                                  periodo_3 = '$objeto->periodo_3',
                                                                  empresa_1 = '$objeto->empresa_1',
                                                                  empresa_2 = '$objeto->empresa_2',
                                                                  empresa_3 = '$objeto->empresa_3',
                                                                  telefono_1 = '$objeto->telefono_1',
                                                                  telefono_2 = '$objeto->telefono_2',
                                                                  telefono_3 = '$objeto->telefono_3',
                                                                  puesto_1 = '$objeto->puesto_1',
                                                                  puesto_2 = '$objeto->puesto_2',
                                                                  puesto_3 = '$objeto->puesto_3',
                                                                  separacion_1 = '$objeto->separación_1',
                                                                  separacion_2 = '$objeto->separación_2',
                                                                  separacion_3 = '$objeto->separación_3',
                                                                  jefe_1 = '$objeto->jefe_1',
                                                                  jefe_2 = '$objeto->jefe_2',
                                                                  jefe_3 = '$objeto->jefe_3',
                                                                  informes_1 = '$objeto->informes_1',
                                                                  informes_2 = '$objeto->informes_2',
                                                                  informes_3 = '$objeto->informes_3',
                                                                  planta_1 = '$objeto->planta_1',
                                                                  planta_2 = '$objeto->planta_2',
                                                                  planta_3 = '$objeto->planta_3',
                                                                  categoria_1 = '$objeto->categoria_1',
                                                                  categoria_2 = '$objeto->categoria_2',
                                                                  categoria_3 = '$objeto->categoria_3',
                                                                  dc3_1 = '$objeto->dc3_1',
                                                                  dc3_2 = '$objeto->dc3_2',
                                                                  dc3_3 = '$objeto->dc3_3',
                                                                  planta_1 = '$objeto->puesto_planta_1',
                                                                  planta_2 = '$objeto->puesto_planta_2',
                                                                  planta_3 = '$objeto->puesto_planta_3',
                                                                  carnet_1 = '$objeto->carnet_1',
                                                                  carnet_2 = '$objeto->carnet_2',
                                                                  carnet_3 = '$objeto->carnet_3',
                                                                  vigencia_1 = '$objeto->vigencia_1',
                                                                  vigencia_2 = '$objeto->vigencia_2',
                                                                  vigencia_3 = '$objeto->vigencia_3',
                                                                  cursos_1 = '$objeto->cursos_1',
                                                                  cursos_2 = '$objeto->cursos_2',
                                                                  cursos_3 = '$objeto->cursos_3',
                                                                  contacto_emergencia = '$objeto->contacto_emergencia',
                                                                  parentesco = '$objeto->parentesco',
                                                                  tel_emergencia = '$objeto->tel_emergencia',
                                                                  papa_nombre = '$objeto->papa_nombre',
                                                                  papa_status = '$objeto->papa_status',
                                                                  papa_direccion = '$objeto->papa_direccion',
                                                                  papa_tel_casa = '$objeto->papa_tel_casa',
                                                                  papa_tel_movil = '$objeto->papa_tel_movil',
                                                                  mama_nombre = '$objeto->mama_nombre',
                                                                  mama_status = '$objeto->mama_status',
                                                                  mama_direccion = '$objeto->mama_direccion',
                                                                  mama_tel_casa = '$objeto->mama_tel_casa',
                                                                  mama_tel_movil = '$objeto->mama_tel_movil',
                                                                  esposo_nombre = '$objeto->esposo_nombre',
                                                                  esposo_status = '$objeto->esposo_status',
                                                                  esposo_direccion = '$objeto->esposo_direccion',
                                                                  esposo_tel_casa = '$objeto->esposo_tel_casa',
                                                                  esposo_tel_movil = '$objeto->esposo_tel_movil',
                                                                  hijo_1_nombre = '$objeto->hijo_1_nombre',
                                                                  hijo_1_edad = '$objeto->hijo_1_edad',
                                                                  hijo_1_estudia = '$objeto->hijo_1_estudia',
                                                                  hijo_1_estudios = '$objeto->hijo_1_estudios',
                                                                  hijo_2_nombre = '$objeto->hijo_2_nombre',
                                                                  hijo_2_edad = '$objeto->hijo_2_edad',
                                                                  hijo_2_estudia = '$objeto->hijo_2_estudia',
                                                                  hijo_2_estudios = '$objeto->hijo_2_estudios',
                                                                  hijo_3_nombre = '$objeto->hijo_3_nombre',
                                                                  hijo_3_edad = '$objeto->hijo_3_edad',
                                                                  hijo_3_estudia = '$objeto->hijo_3_estudia',
                                                                  hijo_3_estudios = '$objeto->hijo_3_estudios',
                                                                  beneficiario_1_nombre = '$objeto->beneficiario_1_nombre',
                                                                  beneficiario_1_domicilio = '$objeto->beneficiario_1_domicilio',
                                                                  beneficiario_1_parentesco = '$objeto->beneficiario_1_parentesco',
                                                                  beneficiario_1_nacimiento = '$objeto->beneficiario_1_nacimiento',
                                                                  beneficiario_1_porcentaje = '$objeto->beneficiario_1_porcentaje',
                                                                  beneficiario_2_nombre = '$objeto->beneficiario_2_nombre',
                                                                  beneficiario_2_domicilio ='$objeto->beneficiario_2_domicilio',
                                                                  beneficiario_2_parentesco = '$objeto->beneficiario_2_parentesco',
                                                                  beneficiario_2_nacimiento = '$objeto->beneficiario_2_nacimiento',
                                                                  beneficiario_2_porcentaje = '$objeto->beneficiario_2_porcentaje',
                                                                  referencia_1_nombre = '$objeto->referencia_1_nombre',
                                                                  referencia_1_domicilio = '$objeto->referencia_1_domicilio',
                                                                  referencia_1_tel_casa = '$objeto->referencia_1_tel_casa',
                                                                  referencia_1_tel_movil = '$objeto->referencia_1_tel_movil',
                                                                  referencia_2_nombre = '$objeto->referencia_2_nombre',
                                                                  referencia_2_domicilio = '$objeto->referencia_2_domicilio',
                                                                  referencia_2_tel_casa = '$objeto->referencia_2_tel_casa',
                                                                  referencia_2_tel_movil = '$objeto->referencia_2_tel_movil',
                                                                  referencia_3_nombre = '$objeto->referencia_3_nombre',
                                                                  referencia_3_domicilio = '$objeto->referencia_3_domicilio',
                                                                  referencia_3_tel_casa = '$objeto->referencia_3_tel_casa',
                                                                  referencia_3_tel_movil = '$objeto->referencia_3_tel_movil',
                                                                  estatus = '$objeto->estatus',
                                                                  calificacion = '$objeto->calificacion',
                                                                  departamento = '$objeto->departamento',
                                                                  ocupacion = '$objeto->ocupacion',
                                                                  categoria = '$objeto->categoria',
                                                                  observaciones = '$objeto->observaciones',
                                                                  contrato = '$objeto->contrato',
                                                                  foto_1 = '$objeto->foto_1',
                                                                  foto_2 = '$objeto->foto_2',
                                                                  foto_3 = '$objeto->foto_3',
                                                                 documentos             = '$objeto->documentos',
                                                                 infonavit_dias         = '$objeto->infonavit_dias',
                                                                 infonavit_salario      = '$objeto->infonavit_salario',
                                                                 infonavit_aportacion   = '$objeto->infonavit_aportacion',
                                                                 infonavit_descuento    = '$objeto->infonavit_descuento',
                                                                 infonavit_valor        = '$objeto->infonavit_valor',
                                                                 infonavit_amortizacion = '$objeto->infonavit_amortizacion',
                                                                 infonavit_proporcion   = '$objeto->infonavit_proporcion',
                                                                 dacta   = '$objeto->dacta',
                                                                 dine    = '$objeto->dine',
                                                                 dcd     = '$objeto->dcd',
                                                                 dcurp   = '$objeto->dcurp',
                                                                 drfc    = '$objeto->drfc',
                                                                 dns     = '$objeto->dns'
                                                                 WHERE id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Actualizar datos infonavit
    public function Actualizar_Infonavit($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE andamieros SET infonavit_dias         = '$objeto->dias',
                                                                 infonavit_salario      = '$objeto->salario',
                                                                 infonavit_aportacion   = '$objeto->aportacion',
                                                                 infonavit_descuento    = '$objeto->descuento',
                                                                 infonavit_valor        = '$objeto->valor',
                                                                 infonavit_amortizacion = '$objeto->amortizacion',
                                                                 infonavit_proporcion   = '$objeto->proporcion'
                                                            WHERE id  = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta  de Persona por nombre
    public function muestra_Personal($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM andamieros WHERE nombre= '$objeto->solicitante'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                             Solicitud EPP                       *****
    ***************************************************************************/

    //muestra las solicitudes de epp, ya sean SS o SO
    public function Consultar_solicitud_EPP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT *, (SELECT name_user FROM usuarios WHERE id_user = solicitante) AS Nsolicitante, (SELECT name_user FROM usuarios WHERE id_user = coordinador) AS Ncoordinador, (SELECT name_user FROM usuarios WHERE id_user = almacen) AS Nalmacen, (SELECT name_user FROM usuarios WHERE id_user = chofer) AS Nchofer FROM solicitud_epp WHERE opcion = '$objeto->opcion' $objeto->consult AND planta != '' AND proyecto != ''")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    // Insertar solicitud EPP
    public function Insert_solicitud_EPP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO solicitud_epp(planta, proyecto, tipo_solicitud, razon, epp, consumibles, especiales, Epredefinidos, solicitante, fch_soli, status, opcion)
                                                VALUES('$objeto->planta',
                                                       '$objeto->proyecto',
                                                       '$objeto->tipo_solicitud',
                                                       '$objeto->razon',
                                                       '".mysqli_escape_string($conexion,$objeto->epp)."',
                                                       '".mysqli_escape_string($conexion,$objeto->consumibles)."',
                                                       '".mysqli_escape_string($conexion,$objeto->especiales)."',
                                                       '".mysqli_escape_string($conexion,$objeto->predefinidos)."',
                                                       '$objeto->solicitante',
                                                       '$objeto->fch_soli',
                                                       '$objeto->status',
                                                       '$objeto->opcion')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    // Insertar solicitud EPP, cuandolo inserta la solicitud el cordinador
    public function Insert_solicitud_EPP2($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO solicitud_epp(planta, proyecto, tipo_solicitud, razon, epp, consumibles, especiales, Epredefinidos, solicitante, fch_soli, fch_auto, coordinador, status, opcion)
                                                VALUES('$objeto->planta',
                                                       '$objeto->proyecto',
                                                       '$objeto->tipo_solicitud',
                                                       '$objeto->razon',
                                                       '".mysqli_escape_string($conexion,$objeto->epp)."',
                                                       '".mysqli_escape_string($conexion,$objeto->consumibles)."',
                                                       '".mysqli_escape_string($conexion,$objeto->especiales)."',
                                                       '".mysqli_escape_string($conexion,$objeto->predefinidos)."',
                                                       '$objeto->solicitante',
                                                       '$objeto->fch_soli',
                                                       '$objeto->fch_auto',
                                                       '$objeto->coordinador',
                                                       '$objeto->status',
                                                       '$objeto->opcion')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Update solicitud epp
    public function Update_solicitud_EPP($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_epp SET tipo_solicitud = '$objeto->tipo_solicitud',
                                                                  razon          = '$objeto->razon',
                                                                  epp            = '".mysqli_escape_string($conexion,$objeto->epp)."',
                                                                  consumibles    = '".mysqli_escape_string($conexion,$objeto->consumibles)."',
                                                                  especiales     = '".mysqli_escape_string($conexion,$objeto->especiales)."',
                                                                  Epredefinidos  = '".mysqli_escape_string($conexion,$objeto->predefinidos)."',
                                                                  fch_soli       = '$objeto->fch_soli',
                                                                  status         = '$objeto->status'
                                                               WHERE id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    public function Update_StatusAuto_EPP($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_epp SET status   = '$objeto->status',
                                                               fch_auto    = '$objeto->fch_auto',
                                                               coordinador = '$objeto->coordinador'
                                                               WHERE id = '$objeto->id_EPP'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    public function Update_StatusMod_EPP($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_epp SET comentario = '$objeto->comentario',
                                                               status      = '$objeto->status',
                                                               fch_modi    = '$objeto->fch_modi',
                                                               coordinador = '$objeto->coordinador'
                                                               WHERE id = '$objeto->id_EPP'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    public function Update_StatusAcep_EPP($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_epp SET status   = '$objeto->status',
                                                               fch_acep    = '$objeto->fch_acep',
                                                               almacen     = '$objeto->almacen'
                                                               WHERE id = '$objeto->id_EPP'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    public function Update_StatusProce_EPP($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_epp SET status   = '$objeto->status',
                                                               fch_proc    = '$objeto->fch_proc',
                                                               chofer      = '$objeto->chofer'
                                                               WHERE id = '$objeto->id_EPP'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    public function Update_StatusReci_EPP($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_epp SET status   = '$objeto->status',
                                                               fch_reci    = '$objeto->fch_reci'
                                                               WHERE id = '$objeto->id_EPP'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    public function Update1_FchHrs_EPP($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_epp SET `$objeto->fch_date` = '$objeto->fch_Chofer',
                                                                   chofer = '$objeto->chofer'
                                                               WHERE id = '$objeto->id_EPP'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    public function Update2_FchHrs_EPP($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_epp SET `$objeto->fch_date` = '$objeto->fch_Chofer'
                                                               WHERE id = '$objeto->id_EPP'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    public function mostrar_idEPP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(id) AS id FROM `solicitud_epp` WHERE solicitante = '$objeto->user' AND fecha LIKE '$objeto->fcha %'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consult_solicitudEPP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM solicitud_epp WHERE id = '$objeto->id_EPP'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                          Profile                                *****
    ***************************************************************************/

    //Actualizar Usuario sin imagen
    public function Actualizar_Usuario1($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE usuarios SET username     = '$objeto->username',
                                                               name_user    = '$objeto->name_user',
                                                               email      = '$objeto->email',
                                                               telefono   = '$objeto->telefono'
                                                         WHERE id_user    objeto->= '$objeto->id_user'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Agregar Usuario con imagen
    public function Actualizar_Usuario2($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE usuarios SET username     = '$objeto->username',
                                                               name_user    = '$objeto->name_user',
                                                               email      = '$objeto->email',
                                                               telefono   = '$objeto->telefono',
                                                               foto         = '$objeto->name_file'
                                                         WHERE id_user    = '$objeto->id_user'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                          Hojas de Tiempo                        *****
    ***************************************************************************/

    //Consulta todos los proyectos donde haya Mano de Obra
    public function Consultar_Proyectos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id, cliente, proyecto FROM manoobra UNION(SELECT id, cliente, proyecto FROM preciofijo) UNION(SELECT id, cliente, proyecto FROM materialmanoobra)")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta todo el personal con ocupacion de andamiero
    public function Consultar_Andamieros()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id, nombre  FROM andamieros WHERE ocupacion = 'Andamiero' ORDER BY nombre")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta Hoja de Tiempo
    public function Consultar_Hoja_Tiempo($count)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hojas_nomina  WHERE count = $count LIMIT 1")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta Hoja de Tiempo
    public function Consultar_Jornadas($count)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT t1.*,t2.nombre AS name FROM hojas_nomina t1 INNER JOIN andamieros t2 WHERE count = '$count' AND t1.nombre = t2.id ORDER BY id") or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta jornadas de  Hoja de Tiempo
    public function Consultar_Jornadas_HT($count)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hojas_nomina WHERE count = ".$count." ORDER BY id ASC") or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta de todas las categorias
    public function Consultar_Categorias()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM categoria")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta de todas los departamentos
    public function Consultar_Departamentos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM departamentos")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    // EMPIEZA GABRIEL CATEGORIA

public function consultar_ultima_categoria()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM categoria order by id DESC limit 1")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

 public function Consultar_Categorias_X_lista($id)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM lista_categoria where lista_categoria.id_lista='$id' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

 public function consulta_nombre_categoria($id_categoria)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM categoria where id_categoria='$id_categoria' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

  public function insertar_lista($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO lista_precios (nombre_lista) VALUES ( '$objeto->nombre')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

  public function insertar_lista_categoria($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO lista_categoria (id_cat,JOR,HEX,JEXT,id_lista) VALUES ('$objeto->id_categoria','$objeto->jo','$objeto->he','$objeto->jex','$objeto->id_lista' )")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

//GABRIEL
  public function consultar_ultima_lista()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM  lista_precios order by id_lista DESC limit 1")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    public function Consultar_Categorias_X_Precio($id)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM lista_categoria where id_lista='$id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

 //Consulta  el año de los precios
    public function Consultar_anio_precios()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT id_lista FROM lista_categoria ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
       public function Actualizar_precios($objeto)
    {

        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE lista_categoria SET
                                                               JOR           = '$objeto->JO',
                                                               HEX           = '$objeto->HE',
                                                               JEXT          = '$objeto->JEX'
                                                               WHERE id_cat = '$objeto->id' and id_lista='$objeto->id_lista'  ")or die("ErroFDDHFrs : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }


    public function agregar_categoriaA_Lista($objeto)        //GABRIEL
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO lista_categoria (id_cat,id_lista) VALUES ('$objeto->id_categoria','$objeto->id_lista')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

       public function Consultar_Categoriax_lista_categoria($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM lista_categoria INNER JOIN categoria on lista_categoria.id_cat=categoria.id_categoria WHERE id_cat = '$objeto->id_categoria' and id_lista='$objeto->id_lista'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //existe categoria
    public function consultar_listas_precios()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM lista_precios ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }


   //OBTIENE EL VIDA UTIL DEL PRODUCTO
    public function obtenVidaUtil($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT vidaUtil from productos where id_producto='$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }


   //TERMINA GABRIEL CATEGORIA

    //existe categoria
    public function existe_Categoria($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM categoria WHERE categoria = '".mysqli_escape_string($conexion,$objeto->categoria)."'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta de todas las categorias
    public function Insertar_Categoria($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO categoria (categoria, corto, JO, HE, JEX) VALUES ('".mysqli_escape_string($conexion,$objeto->categoria)."',
                                                                                                  '$objeto->iniciales',
                                                                                                  '$objeto->JO',
                                                                                                  '$objeto->HE',
                                                                                                  '$objeto->JEX')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

       public function consulta_nombre_lista($id_lista)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM lista_precios WHERE id_lista = '$id_lista'     ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }




    //actualizar categoria
     public function Actualizar_Categoria($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE categoria SET categoria        = '$objeto->categoria',
                                                               corto        = '$objeto->iniciales',
                                                               JO          = '$objeto->JO',
                                                               HE         = '$objeto->HE',
                                                               JEX        = '$objeto->JEX'
                                                         WHERE id_categoria = '$objeto->id' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

  public function Actualizar_categoria_G($objeto)
    {

        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE categoria SET categoria   = '$objeto->categoria',
                                                               corto        = '$objeto->inicial'
                                                               WHERE id_categoria = '$objeto->id_categoria'  ")or die("ErroFDDHFrs : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     public function Insertar_Categoria_G($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO categoria (categoria,inicial) VALUES ('$objeto->nombre_categoria','$objeto->nombre_inicial')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta de una categoria por ID
    public function Consultar_Categoria($id)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM categoria WHERE id_categoria = '$id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta de una categoria en por nombre
    public function Consultar_Categoria_nombre($nombre)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM categoria WHERE categoria = '$nombre'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta ultimo folio en la tabla hojas de nomina
    public function Consultar_ultimo_folio()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count FROM `hojas_nomina` ORDER BY id DESC LIMIT 1")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Insertar Jornadas de Trabajdor
    public function Insertar_Jornadas($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO hojas_nomina(folio,
                                                                    count,
                                                                    proyecto,
                                                                    semana,
                                                                    anio,
                                                                    turno,
                                                                    nombre,
                                                                    categoria,
                                                                    vjo,
                                                                    vhe,
                                                                    vjex,
                                                                    sjo,
                                                                    she,
                                                                    sjex,
                                                                    djo,
                                                                    dhe,
                                                                    djex,
                                                                    ljo,
                                                                    lhe,
                                                                    ljex,
                                                                    majo,
                                                                    mahe,
                                                                    majex,
                                                                    mijo,
                                                                    mihe,
                                                                    mijex,
                                                                    jjo,
                                                                    jhe,
                                                                    jjex)
                                                             VALUES('$objeto->folio',
                                                                    '$objeto->count',
                                                                    '$objeto->proyecto',
                                                                    '$objeto->semana',
                                                                    '$objeto->anio',
                                                                    '$objeto->turno',
                                                                    '$objeto->nombre',
                                                                    '$objeto->categoria',
                                                                    '$objeto->vjo',
                                                                    '$objeto->vhe',
                                                                    '$objeto->vjex',
                                                                    '$objeto->sjo',
                                                                    '$objeto->she',
                                                                    '$objeto->sjex',
                                                                    '$objeto->djo',
                                                                    '$objeto->dhe',
                                                                    '$objeto->djex',
                                                                    '$objeto->ljo',
                                                                    '$objeto->lhe',
                                                                    '$objeto->ljex',
                                                                    '$objeto->majo',
                                                                    '$objeto->mahe',
                                                                    '$objeto->majex',
                                                                    '$objeto->mijo',
                                                                    '$objeto->mihe',
                                                                    '$objeto->mijex',
                                                                    '$objeto->jjo',
                                                                    '$objeto->jhe',
                                                                    '$objeto->jjex')")
                                                                    or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Actualizacion de Jornadas
    public function Actualizar_Jornadas($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE hojas_nomina SET folio      = '$objeto->folio',
                                                                   proyecto   = '$objeto->proyecto',
                                                                   turno      = '$objeto->turno',
                                                                   nombre     = '$objeto->nombre',
                                                                   categoria  = '$objeto->categoria',
                                                                   vjo        = '$objeto->vjo',
                                                                   vhe        = '$objeto->vhe',
                                                                   vjex       = '$objeto->vjex',
                                                                   sjo        = '$objeto->sjo',
                                                                   she        = '$objeto->she',
                                                                   sjex       = '$objeto->sjex',
                                                                   djo        = '$objeto->djo',
                                                                   dhe        = '$objeto->dhe',
                                                                   djex       = '$objeto->djex',
                                                                   ljo        = '$objeto->ljo',
                                                                   lhe        = '$objeto->lhe',
                                                                   ljex       = '$objeto->ljex',
                                                                   majo       = '$objeto->majo',
                                                                   mahe       = '$objeto->mahe',
                                                                   majex      = '$objeto->majex',
                                                                   mijo       = '$objeto->mijo',
                                                                   mihe       = '$objeto->mihe',
                                                                   mijex      = '$objeto->mijex',
                                                                   jjo        = '$objeto->jjo',
                                                                   jhe        = '$objeto->jhe',
                                                                   jjex       = '$objeto->jjex',
                                                                   comidas    = '$objeto->comidas'
                                                             WHERE id         = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Eliminar Partida  en la  hoja de nomina
    public function Eliminar_Jornadas($id)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "DELETE FROM hojas_nomina WHERE id='$id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta Hojas de Tiempo por Semana y Año
    public function Consultar_Semana_Anio()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT semana, anio FROM hojas_nomina GROUP BY anio, semana ORDER BY anio desc, semana desc")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Obtener las hojas de tiempo de la semana y año
    public function Consultar_hojas_tiempo($semana, $anio)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hojas_nomina WHERE semana = ".$semana." and anio = ". $anio)or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Obtenemos todas Todos los contadores de la semana y año a consultar
    public function Obtener_contadores($semana, $anio)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count, folio, proyecto FROM hojas_nomina WHERE semana = ".$semana." and anio = ".$anio." GROUP BY count ORDER BY id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Agrega 3 campos nuevos de una categoria nueva  a la tabla jornadas
    public function Agregar_Categorias_Jornadas($id)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "ALTER TABLE jornadas ADD JO_$id DOUBLE NOT NULL, ADD HE_$id DOUBLE NOT NULL, ADD JEX_$id DOUBLE NOT NULL;")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Agrega 3 campos nuevos de una categoria nueva  a la tabla jornadas
    public function Insertar_hoja_tiempo($i, $count, $ordinarias, $extras, $extraordinarias)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO jornadas (count,
                                                                 JO_$i,
                                                                 HE_$i,
                                                                 JEX_$i)
                                                         VALUES ('$count',
                                                                 '$ordinarias',
                                                                 '$extras',
                                                                 '$extraordinarias')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Agrega 3 campos nuevos de una categoria nueva  a la tabla jornadas
    public function Actualizar_hoja_tiempo($i, $count, $ordinarias, $extras, $extraordinarias)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE jornadas SET JO_$i  = '$ordinarias',
                                                               HE_$i  = '$extras',
                                                               JEX_$i = '$extraordinarias'
                                                         WHERE count  = '$count' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Agrega 3 campos nuevos de una categoria nueva  a la tabla jornadas
    public function Prueba1()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count FROM hojas_nomina GROUP BY count ORDER BY id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Agrega 3 campos nuevos de una categoria nueva  a la tabla jornadas
    public function Prueba2($count)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hojas_nomina WHERE count = '$count'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta todos los contadores dentro de una semana y añio especificos
    public function Consulta_por_semana($anio, $semana)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count, folio, proyecto FROM hojas_nomina WHERE anio = '$anio' AND semana = '$semana' GROUP BY count")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta todos los contadores dentro de una semana y añio especificos
    public function Consulta_jornadas_por_semana($cadena)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM jornadas WHERE count IN ($cadena)")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta LAs jornadas de un contador especifico
    public function Consultar_jornadas2($count)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM jornadas WHERE count = $count")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                          Inventario (andamios)                  *****
    ***************************************************************************/
    public function insertarPieza($objeto)//inserta datos pieza nueva
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO almacen (codigo, descripcion, categoria, cantidad)
                                           VALUES ('$objeto->codigo',
                                                   '".mysqli_escape_string($conexion,$objeto->descripcion)."',
                                                   '$objeto->categoria',
                                                   '$objeto->cantidad')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function insertarPieza2($objeto)//inserta datos pieza nueva
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO piezas_andamio (codigo)
                                           VALUES ('$objeto->codigo')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function insertarPieza3($objeto)//inserta datos pieza nueva
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO precios_pieza (codigo, descripcion)
                                           VALUES ('$objeto->codigo',
                                                   '".mysqli_escape_string($conexion,$objeto->descripcion)."')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function insertarPieza4($objeto)//inserta datos pieza nueva
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO piezas_andamio_usuarios (codigo)
                                           VALUES ('$objeto->codigo')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function existeCodigo($objeto)//consulta existencia de codigo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT codigo FROM almacen WHERE codigo = '$objeto->codigo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificarTabla($objeto)//insertar mas columnas (proyecto) a la tabla piezas_andamio
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion,
            "ALTER TABLE piezas_andamio ADD `".mysqli_escape_string($conexion,$objeto->proyecto)."` INT(11) NOT NULL DEFAULT 0") or die("Error al insertar el cliente".mysqli_error($conexion));
        $conexion->set_charset("utf8");
        $this->Cerrar_Conexion($conexion);
    }

    public function modificarTabla2($objeto)//insertar mas columnas (proyecto) a la tabla piezas_andamio_usuarios
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion,
            "ALTER TABLE piezas_andamio_usuarios ADD `".mysqli_escape_string($conexion,$objeto->proyecto)."` INT(11) NOT NULL DEFAULT 0") or die("Error al insertar el usuario".mysqli_error($conexion));
        $conexion->set_charset("utf8");
        $this->Cerrar_Conexion($conexion);
    }

    public function almacen() //muestra todos los datos de almacen
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM almacen ORDER BY id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    
    public function total_almacen($almacen)// Suma las piezas del almacen seleccionado
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(`$almacen`) total FROM almacen")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function tipo_almacen($almacen, $tipo) // Muestra las piezas de material dependiendo el tipo y el almacen a consultar CARLOS
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT codigo, descripcion,categoria,`$almacen` AS stock FROM almacen where tipo = $tipo ORDER BY indice_categoria, indice")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function almacen_Calculo() //muestra todos los datos de almacen y muestra peso y tipo
    {
        $conexion = $this->ConectarBD(); //SELECT * FROM almacen ORDER BY id ASC   pp.peso, pp.Tipo
        $result = mysqli_query($conexion, "SELECT a.*, pp.* FROM `almacen` a INNER JOIN precios_pieza pp on a.codigo = pp.codigo ORDER BY a.id ASC ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultar_almacenes() //Consulta todos los almacenes vigentes ]CARLOS
    {
        $conexion = $this->ConectarBD(); 
        $result = mysqli_query($conexion, "SELECT * FROM almacenes_rentas WHERE estatus = 'Vigente' ") or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function almacenPorCategoria($objeto) //muestra todos los datos de almacen dependiendo la categoria
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `almacen` WHERE categoria = '$objeto->categoria' ORDER BY id ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function almacenTotal()//muestra total de piezas(codigos) que hay en la tabla
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count(*) FROM almacen")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    public function almacenTotalC()//muestra la suma todal de la cantidad de piezas en la tabla almacen
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(cantidad) FROM almacen")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function codigos() //muestra todos los codigos dentro de un arreglo
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

    public function buscarDescrip($objeto) //muestra la descripcion de ese codigo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT descripcion FROM almacen WHERE codigo = '$objeto->codigo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function datosCodigo($objeto) //muestra los datos de ese codigo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `almacen` WHERE codigo = '$objeto->codigo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function movimientosTotalC()//muestra la suma todal de la cantidad de piezas en la tabla almacen
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count(*) FROM movimiento_andamio")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function insertarMoviAndamio($objeto)//inserta los datos (cantidad de piezas a utilizar)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO movimiento_andamio (folio, tipo, fecha,  Semana, piezas, Npiezas, Peso_Total, CostoTotal, tipoPrecioS, entrada_cliente, salida_cliente, movimiento, planta, vehiculo, nota, Referencia, modificado)
                                             VALUES ('$objeto->folio',
                                                     '$objeto->tipo',
                                                     '$objeto->fecha',
                                                     '$objeto->Semana',
                                                     '$objeto->piezas',
                                                     '$objeto->Npiezas',
                                                     '$objeto->PesoTotal',
                                                     '$objeto->CostoTotal',
                                                     '$objeto->tipoPrecio',
                                                     '$objeto->EntradaC',
                                                     '$objeto->SalidaC',
                                                     '$objeto->movimiento',
                                                     '$objeto->planta',
                                                     '$objeto->vehiculo',
                                                     '$objeto->nota',
                                                     '$objeto->Referencia',
                                                     '$objeto->modificado')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function insertar_PreMoviAndamio($objeto)//inserta los datos de ajuste(cantidad de piezas a utilizar) para que sean autorizadas
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO premovimiento_andamio (folio,tipo, fecha,  Semana, piezas, Npiezas, Peso_Total, CostoTotal, tipoPrecioS, entrada_cliente, salida_cliente, movimiento, planta, vehiculo, nota, Referencia, modificado)
                                             VALUES ('$objeto->folio',
                                                     '$objeto->tipo',
                                                     '$objeto->fecha',
                                                     '$objeto->Semana',
                                                     '$objeto->piezas',
                                                     '$objeto->Npiezas',
                                                     '$objeto->PesoTotal',
                                                     '$objeto->CostoTotal',
                                                     '$objeto->tipoPrecio',
                                                     '$objeto->EntradaC',
                                                     '$objeto->SalidaC',
                                                     '$objeto->movimiento',
                                                     '$objeto->planta',
                                                     '$objeto->vehiculo',
                                                     '$objeto->nota',
                                                     '$objeto->Referencia',
                                                     '$objeto->modificado')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Delete_PreMoviAndamio($objeto) //Eliminar
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "DELETE FROM premovimiento_andamio WHERE  id_mov = '$objeto->id_mov'") or die("Error al Eliminar Registro".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
    }

    public function existeFolio_Entrada($folio)//consulta existencia folio
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM movimiento_andamio WHERE folio = '$folio' AND movimiento != 'Ajuste' AND tipo = 'Entrada'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function existeFolio_Salida($folio)//consulta existencia folio
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM movimiento_andamio WHERE folio = '$folio' AND movimiento != 'Ajuste' AND tipo = 'Salida'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function existeFolio_Ajuste($folio)//consulta existencia folio
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM movimiento_andamio WHERE folio = '$folio' AND movimiento = 'Ajuste'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function inventario()//muestra todos los datos de movimiento_andamio
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM movimiento_andamio ORDER BY id_mov DESC LIMIT 300")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function inventariDat($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM movimiento_andamio WHERE (entrada_cliente = '$objeto->id_cliente' OR salida_cliente='$objeto->id_cliente') && piezas LIKE '%$objeto->pieza%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultarDatos($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM movimiento_andamio WHERE entrada_cliente = '$objeto->id_cliente' OR salida_cliente='$objeto->id_cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultar_Movimiento($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM movimiento_andamio WHERE id_mov = '$objeto->id_movimiento'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultar_PreMovimiento($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM premovimiento_andamio WHERE id_mov = '$objeto->id_movimiento'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Maximo_PreMovimiento()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(id_mov) AS Maximo FROM `premovimiento_andamio`")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultarTTPiezas($objeto) //consultar el total de piezas que hay
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `".mysqli_escape_string($conexion,$objeto->tabla)."` WHERE codigo = '$objeto->codigo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function ProyectoCliente($objeto) //muestra los proyectos de ese cliente que tenga almacen
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id, cliente FROM `ventamaterial` WHERE cliente = '$objeto->cliente' AND almacen LIKE 'Si%' UNION SELECT id, cliente FROM `rentamaterial` WHERE cliente = '$objeto->cliente' AND almacen LIKE 'Si%' UNION SELECT id, cliente FROM `preciofijo` WHERE cliente = '$objeto->cliente' AND almacen LIKE 'Si%' UNION SELECT id, cliente FROM `materialmanoobra` WHERE cliente = '$objeto->cliente' AND almacen LIKE 'Si%' UNION SELECT id, cliente FROM `proyec_faltante` WHERE cliente = '$objeto->cliente' AND almacen LIKE 'Si%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificarTTPiezas($objeto) //modifica el total de piezas que hay de cada cliente
    {
        $conexion = $this->ConectarBD();
        if ($objeto->cliente == 'AlmacenP') {
            $result = mysqli_query($conexion, "UPDATE almacen
                                           SET cantidad = '$objeto->TTPieza'
                                           WHERE codigo = '$objeto->codigo'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->cliente == 'Almacenes') {
            $result = mysqli_query($conexion, "UPDATE almacen
                                           SET `".mysqli_escape_string($conexion,$objeto->proyecto)."` = '$objeto->TTPieza'
                                           WHERE codigo = '$objeto->codigo'")or die("Error : ".mysqli_error($conexion));

        }else {
            $result = mysqli_query($conexion, "UPDATE piezas_andamio
                                           SET `".mysqli_escape_string($conexion,$objeto->proyecto)."` = '$objeto->TTPieza'
                                           WHERE codigo = '$objeto->codigo'")or die("Error : ".mysqli_error($conexion));
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultarMovimiento($objeto) //consultar el todal de movimientos que hay
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count(movimiento) FROM movimiento_andamio WHERE (movimiento ='Entrada' OR movimiento = 'Salida')  AND ".mysqli_escape_string($conexion,$objeto->cliente_opcion)." ='$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultMovi($objeto) //consultar el todal de movimientos que hay
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count(movimiento) FROM movimiento_andamio WHERE movimiento='$objeto->movimiento' AND (".mysqli_escape_string($conexion,$objeto->cliente_op1)." ='$objeto->cliente' OR ".mysqli_escape_string($conexion,$objeto->cliente_op2)." ='$objeto->cliente')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function cantidadMovimientos($objeto) //consultar el todal de movimientos que tiene el proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count(movimiento) FROM `movimiento_andamio` WHERE entrada_cliente = '$objeto->cliente' OR salida_cliente = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarProyecto() //muestra los proyectos en el select de movimientos que tengan
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `ventamaterial` WHERE almacen='Si' UNION SELECT * FROM `rentamaterial` WHERE almacen='Si' UNION SELECT * FROM `preciofijo` WHERE almacen='Si' UNION SELECT * FROM `materialmanoobra` WHERE almacen='Si' UNION SELECT * FROM `proyec_faltante` WHERE almacen='Si'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificarMoviAndamio($objeto){//modificar movimiento
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE movimiento_andamio
                                             SET folio            = '$objeto->folio',
                                                 movimiento       = '$objeto->movimiento',
                                                 tipo             = '$objeto->tipo',
                                                 fecha            = '$objeto->fecha',
                                                 Semana           = '$objeto->Semana',
                                                 piezas           = '$objeto->piezas',
                                                 Npiezas          = '$objeto->Npiezas',
                                                 Peso_Total       = '$objeto->PesoTotal',
                                                 CostoTotal       = '$objeto->CostoTotal', 
                                                 tipoPrecioS      = '$objeto->tipoPrecio',
                                                 entrada_cliente  = '$objeto->EntradaC',
                                                 salida_cliente   = '$objeto->SalidaC',
                                                 planta           = '$objeto->planta',
                                                 vehiculo         = '$objeto->vehiculo',
                                                 nota             = '$objeto->nota',
                                                 Referencia       = '$objeto->Referencia',
                                                 modificado       = '$objeto->modificado'
                                           WHERE id_mov  = '$objeto->id_movimiento' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultarTTPiezaProyecto($objeto) //consulta valor que tenga el codigo de esse proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT `".mysqli_escape_string($conexion,$objeto->proyecto)."` FROM `".mysqli_escape_string($conexion,$objeto->tabla)."` WHERE codigo ='$objeto->codigo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificarTTPiezaProyecto($objeto) //modificar valor que tenga el codigo de ese proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE `".mysqli_escape_string($conexion,$objeto->tabla)."` SET `".mysqli_escape_string($conexion,$objeto->proyecto)."`  = '$objeto->total' WHERE codigo ='$objeto->codigo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function actualizar_almacen($objeto)//modificar almacen
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE ".mysqli_escape_string($conexion,$objeto->tabla)." SET almacen  = '$objeto->almacen'
                                                         WHERE id  = '$objeto->id' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultProyec() //muestra los datos que tengan en almacen que si
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `ventamaterial` WHERE almacen LIKE 'Si%' UNION SELECT * FROM `rentamaterial` WHERE almacen LIKE 'Si%' UNION SELECT * FROM `preciofijo` WHERE almacen LIKE 'Si%' UNION SELECT * FROM `materialmanoobra` WHERE almacen LIKE 'Si%' UNION SELECT * FROM `proyec_faltante` WHERE almacen LIKE 'Si%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultProyecVigente() //muestra los datos que tengan en almacen que si y estatus = 'Vigente'
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `ventamaterial` WHERE almacen LIKE 'Si%' AND estatus = 'Vigente' UNION SELECT * FROM `rentamaterial` WHERE almacen LIKE 'Si%' AND estatus = 'Vigente' UNION SELECT * FROM `preciofijo` WHERE almacen LIKE 'Si%' AND estatus = 'Vigente' UNION SELECT * FROM `materialmanoobra` WHERE almacen LIKE 'Si%' AND estatus = 'Vigente' UNION SELECT * FROM `proyec_faltante` WHERE almacen LIKE 'Si%' AND estatus = 'Vigente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function cantidadAlmacenP() //cuenta los proyectos que tienen almacen
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count(*) FROM `ventamaterial` WHERE almacen LIKE 'Si%' UNION ALL SELECT count(*) FROM `rentamaterial` WHERE almacen LIKE 'Si%' UNION ALL SELECT count(*) FROM `preciofijo` WHERE almacen LIKE 'Si%' UNION ALL SELECT count(*) FROM `materialmanoobra` WHERE almacen LIKE 'Si%' UNION ALL SELECT count(*) FROM `proyec_faltante` WHERE almacen LIKE 'Si%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function DatosProyecto($objeto) //cmuestra el proyecto con el mismo id
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `ventamaterial` WHERE id='$objeto->proyecto' UNION SELECT * FROM `rentamaterial` WHERE id='$objeto->proyecto' UNION SELECT * FROM `preciofijo` WHERE id='$objeto->proyecto' UNION SELECT * FROM `materialmanoobra` WHERE id='$objeto->proyecto' UNION SELECT * FROM `proyec_faltante` WHERE id='$objeto->proyecto'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function categoriaPiezas() //muestra las categorias que hay en tabla:almacen
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT categoria FROM `almacen`")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function sumaPiezas($objeto) //suma el total de las piezas del proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(`$objeto->proyecto`), MAX(`$objeto->proyecto`) FROM `".mysqli_escape_string($conexion,$objeto->tabla)."`")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultProyecAlmacen($objeto) //muestra los datos del proyecto que tengan en almacen que si
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `ventamaterial` WHERE almacen LIKE 'Si%' AND id='$objeto->proyecto' UNION SELECT * FROM `rentamaterial` WHERE almacen LIKE 'Si%' AND id='$objeto->proyecto' UNION SELECT * FROM `preciofijo` WHERE almacen LIKE 'Si%' AND id='$objeto->proyecto' UNION SELECT * FROM `materialmanoobra` WHERE almacen LIKE 'Si%' AND id='$objeto->proyecto' UNION SELECT * FROM `proyec_faltante` WHERE almacen LIKE 'Si%' AND id='$objeto->proyecto'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function FolioMayor_Movimiento_Entrada() //Folio mayor, solo los movimientos difeerente de ajuste y tipo entrada
    {//diferente a esos folios porque ya existen en traspaso
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(CAST(folio AS UNSIGNED)) AS Mayor FROM `movimiento_andamio` WHERE movimiento != 'Ajustes' AND tipo = 'Entrada' AND folio != '1044' AND folio != '1040' AND folio != '1005'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function FolioMayor_Movimiento_Salida() //Folio mayor, solo los movimientos difeerente de ajuste y tipo salida
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(CAST(folio AS UNSIGNED)) AS Mayor FROM `movimiento_andamio` WHERE movimiento != 'Ajustes' AND tipo = 'Salida'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function FolioMayor_Movimiento_Ajustes() //Folio mayor, solo los movimientos de auste
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(CAST(folio AS UNSIGNED)) AS Mayor FROM `movimiento_andamio` WHERE movimiento = 'Ajustes'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Suma_ProyecPiezas($objeto) //suma total de piezas de ese proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(`$objeto->proyecto`) AS Suma FROM `piezas_andamio`")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function MAX_movimiento() //sobtiene el id mayor
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `movimiento_andamio` WHERE id_mov = (SELECT MAX(id_mov) FROM `movimiento_andamio`)")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Stock_Tipo($objeto) //consultar el stock que hay en el proyecto o almacen
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT codigo, `$objeto->tipo` FROM `".mysqli_escape_string($conexion,$objeto->tabla)."`")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //obtiene la suma de piezas que tiene ese cliente
    public function sumatoriaPz($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT pa.codigo, $objeto->proyectos FROM piezas_andamio pa INNER JOIN precios_pieza pp ON pa.codigo = pp.codigo $objeto->condicion")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                             Clientes                            *****
    ***************************************************************************/
    //Consulta  id del Cliente
    public function consultarID($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM clientes where nombre = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Nclientes()//obtiene cantidad de clientes
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT count(*) FROM clientes ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarPrefijo($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT(prefijo),nombre FROM `clientes` WHERE prefijo LIKE '$objeto->prefijo%' ORDER BY prefijo ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /**********************************************************************************************************************
    ******                                     Reportes                                                              *****
    **********************************************************************************************************************/
    public function contarCodigos($objeto)//muestra veces repetido el codigo
    {
        $conexion = $this->ConectarBD();
        if ($objeto->n == '1') {
            $result = mysqli_query($conexion, "SELECT * FROM `movimiento_andamio` WHERE piezas LIKE '%$objeto->codigo%' AND entrada_cliente NOT LIKE '%/0'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->n == '2') {
           $result = mysqli_query($conexion, "SELECT * FROM `movimiento_andamio` WHERE piezas LIKE '%$objeto->codigo%' AND entrada_cliente = '$objeto->proyecto' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->n == '3') {
           $result = mysqli_query($conexion, "SELECT * FROM `movimiento_andamio` WHERE piezas LIKE '%$objeto->codigo%' AND entrada_cliente = '$objeto->proyecto' AND entrada_cliente LIKE '%/$objeto->clase%' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->n == '4') {
           $result = mysqli_query($conexion, "SELECT * FROM `movimiento_andamio` WHERE piezas LIKE '%$objeto->codigo%' AND entrada_cliente = '$objeto->proyecto' AND entrada_cliente LIKE '%/$objeto->clase%' AND (fecha BETWEEN '$objeto->RInicial' AND '$objeto->RFinal') ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->n == '5') {
           $result = mysqli_query($conexion, "SELECT * FROM `movimiento_andamio` WHERE piezas LIKE '%$objeto->codigo%' AND entrada_cliente LIKE '%/$objeto->clase%'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->n == '6') {
           $result = mysqli_query($conexion, "SELECT * FROM `movimiento_andamio` WHERE piezas LIKE '%$objeto->codigo%' AND entrada_cliente LIKE '%/$objeto->clase%' AND (fecha BETWEEN '$objeto->RInicial' AND '$objeto->RFinal')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->n == '7') {
           $result = mysqli_query($conexion, "SELECT * FROM `movimiento_andamio` WHERE piezas LIKE '%$objeto->codigo%' AND (fecha BETWEEN '$objeto->RInicial' AND '$objeto->RFinal')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->n == '8') {
           $result = mysqli_query($conexion, "SELECT * FROM `movimiento_andamio` WHERE piezas LIKE '%$objeto->codigo%' AND entrada_cliente = '$objeto->proyecto' AND (fecha BETWEEN '$objeto->RInicial' AND '$objeto->RFinal')")or die("Error : ".mysqli_error($conexion));
        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Proyect_distinct($objeto)//para mostrar los proyectos sin repetir
    {
        $conexion = $this->ConectarBD();
        if ($objeto->m == '1') {
            $result = mysqli_query($conexion, "SELECT DISTINCT entrada_cliente AS Proyects FROM `movimiento_andamio` UNION SELECT DISTINCT salida_cliente FROM `movimiento_andamio`")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->m == '2') {
            $result = mysqli_query($conexion, "SELECT DISTINCT entrada_cliente AS Proyects FROM `movimiento_andamio` WHERE (entrada_cliente LIKE '%$objeto->cliente/%' OR salida_cliente LIKE '%$objeto->cliente/%') UNION SELECT DISTINCT salida_cliente FROM `movimiento_andamio` WHERE (entrada_cliente LIKE '%$objeto->cliente/%' OR salida_cliente LIKE '%$objeto->cliente/%')")or die("Error : ".mysqli_error($conexion));
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Filtro_Semana($objeto)//muestra veces repetido el codigo
    {
        $conexion = $this->ConectarBD();
        if ($objeto->m == '1') {
            $result = mysqli_query($conexion, "SELECT Semana,Npiezas,tipo, entrada_cliente, salida_cliente FROM `movimiento_andamio` WHERE fecha <= '$objeto->ultimo_dia'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->m == '2') {
            $result = mysqli_query($conexion, "SELECT Semana,Npiezas,tipo, entrada_cliente, salida_cliente FROM `movimiento_andamio` WHERE fecha <= '$objeto->ultimo_dia' AND (entrada_cliente LIKE '%$objeto->cliente/%' OR salida_cliente LIKE '%$objeto->cliente/%')")or die("Error : ".mysqli_error($conexion));
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    /***************************************************************************
    ******                        hojas_trabajo                            *****
    ***************************************************************************/
    //Consulta hoja_trabajo
    public function consultarhoja_trabajo()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta hoja_trabajo (muestra solo las activas y las cerradas de ese mismo año)  // Puse  OR creado LIKE '$objeto->rango2%' por mientras
    public function consultarhoja_trabajo2($objeto)
    {
        $conexion = $this->ConectarBD();
        if ($objeto->N == 1) {
          $result = mysqli_query($conexion, "
                SELECT hoja_trabajo.*, clientes.nombre AS cliente, user_cliente.nombre_userC AS usuario FROM `hoja_trabajo`
                INNER JOIN clientes ON hoja_trabajo.clientes_id = clientes.id_cliente
                INNER JOIN user_cliente ON hoja_trabajo.userC_id = user_cliente.id_userC
                WHERE (hoja_trabajo.status = 'Abierto' OR (hoja_trabajo.status = 'Cerrado' AND hoja_trabajo.creado LIKE '$objeto->rango%')) ORDER BY id_hj DESC")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->N == 2){
          $result = mysqli_query($conexion, "
                SELECT hoja_trabajo.*, clientes.nombre AS cliente, user_cliente.nombre_userC AS usuario FROM `hoja_trabajo`
                INNER JOIN clientes ON hoja_trabajo.clientes_id = clientes.id_cliente
                INNER JOIN user_cliente ON hoja_trabajo.userC_id = user_cliente.id_userC
                WHERE (hoja_trabajo.status = 'Abierto' OR (hoja_trabajo.status = 'Cerrado' AND (hoja_trabajo.creado LIKE '$objeto->rango%' OR hoja_trabajo.creado LIKE '$objeto->rango2%' OR hoja_trabajo.modificado LIKE '$objeto->Fecha%' OR hoja_trabajo.sp = '0') ) ) AND hoja_trabajo.clientes_id in ($objeto->user) ORDER BY id_hj DESC")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->N == 3){   //view cobranza  //status = 'Cerrado' AND
          $result = mysqli_query($conexion, "
                SELECT hoja_trabajo.id_hj, hoja_trabajo.folio, hoja_trabajo.n_proyecto, hoja_trabajo.sp, clientes.nombre AS cliente, hoja_trabajo.ordenCompra, hoja_trabajo.equipo, user_cliente.nombre_userC AS usuario, hoja_trabajo.fchRarmado,
                       hoja_trabajo.fchRdesarmado, hoja_trabajo.dias_utilizados, hoja_trabajo.totalrentaD_andamio, hoja_trabajo.totalx_diasrenta, hoja_trabajo.Mano_Obra_SA, hoja_trabajo.Mano_Obra_SD, hoja_trabajo.mano_obra, hoja_trabajo.total,
                       hoja_trabajo.nFactura, hoja_trabajo.TotalFacturado, hoja_trabajo.TotalPagado, hoja_trabajo.status, hoja_trabajo.statusVenta, hoja_trabajo.modificado, hoja_trabajo.creado, hoja_trabajo.item
                FROM `hoja_trabajo`
                INNER JOIN clientes ON hoja_trabajo.clientes_id = clientes.id_cliente
                INNER JOIN user_cliente ON hoja_trabajo.userC_id = user_cliente.id_userC
                WHERE (hoja_trabajo.fchRarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') ".$objeto->consulta. " ORDER BY hoja_trabajo.fchRarmado")or die("Error : ".mysqli_error($conexion));
        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta hoja_trabajo cuando status = cerrado y mano obra != 0.00
    public function consultarhoja_trabajo3($objeto)
    { //status ='Cerrado' AND
        $conexion = $this->ConectarBD();
        if( $_SESSION['radioParcial'] == 'CerrarFolio'){
            $result = mysqli_query($conexion, "SELECT id_hj, folio, (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario, n_proyecto, fchRarmado, fchRdesarmado, ordenCompra, sp, totalx_diasrenta, Mano_Obra_SA, Mano_Obra_SD, mano_obra, total, (SELECT SUM(mano_obra_SA) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SA, (SELECT SUM(mano_obra_SD) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SD, (SELECT SUM(costo_andamio) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_RentaMAterial, (SELECT SUM(Descuento) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreDescuento, nFactura, TotalFacturado, Deben, statusVenta FROM hoja_trabajo WHERE clientes_id = '$objeto->cliente_id' AND  statusVenta = 'Facturado-Parcialmente' AND Deben != 0.00  ORDER BY Deben DESC")or die("Error : ".mysqli_error($conexion));

        }else if ( $_SESSION['radioParcial'] == 'Costo_Andamio' || $_SESSION['radioParcial'] == 'Costo_ManoO') { /*styrolution  $_SESSION['cliente_id'] == '18' &&*/

            if($_SESSION['radioParcial'] == 'Costo_ManoO'){ //apareceran folios abiertos que  solo tengan la MO_SA
                $result = mysqli_query($conexion, "SELECT id_hj, folio, (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario, n_proyecto, fchRarmado, fchRdesarmado, ordenCompra, sp, totalx_diasrenta, Mano_Obra_SA, Mano_Obra_SD, mano_obra, total, (SELECT SUM(mano_obra_SA) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SA, (SELECT SUM(mano_obra_SD) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SD, (SELECT SUM(costo_andamio) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_RentaMAterial, (SELECT SUM(Descuento) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreDescuento, nFactura, TotalFacturado, Deben, statusVenta FROM hoja_trabajo WHERE clientes_id = '$objeto->cliente_id' AND mano_obra != 0.00 AND total > TotalFacturado AND ordenCompra != '' AND (status = 'Cerrado' OR (status = 'Abierto' AND Mano_Obra_SA > 0 AND Mano_Obra_SD = 0.00 )) ORDER BY Deben DESC")or die("Error : ".mysqli_error($conexion));
            }else{
                $result = mysqli_query($conexion, "SELECT id_hj, folio, (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario, n_proyecto, fchRarmado, fchRdesarmado, ordenCompra, sp, totalx_diasrenta, Mano_Obra_SA, Mano_Obra_SD, mano_obra, total, (SELECT SUM(mano_obra_SA) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SA, (SELECT SUM(mano_obra_SD) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SD, (SELECT SUM(costo_andamio) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_RentaMAterial, (SELECT SUM(Descuento) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreDescuento, nFactura, TotalFacturado, Deben, statusVenta FROM hoja_trabajo WHERE clientes_id = '$objeto->cliente_id' AND mano_obra != 0.00 AND total > TotalFacturado AND ordenCompra != '' AND status = 'Cerrado' ORDER BY Deben DESC")or die("Error : ".mysqli_error($conexion)); //Corte_Parcial = '1'
            }

        }else if($_SESSION['radioParcial'] == 'SoloRentaAndamio'){
            $result = mysqli_query($conexion, "SELECT id_hj, folio, (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario, n_proyecto, fchRarmado, fchRdesarmado, ordenCompra, sp, totalx_diasrenta, Mano_Obra_SA, Mano_Obra_SD, mano_obra, total, (SELECT SUM(mano_obra_SA) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SA, (SELECT SUM(mano_obra_SD) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SD, (SELECT SUM(costo_andamio) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_RentaMAterial, (SELECT SUM(Descuento) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreDescuento, nFactura, TotalFacturado, Deben, statusVenta FROM hoja_trabajo WHERE clientes_id = '$objeto->cliente_id' AND status = 'Cerrado' AND mano_obra = 0 AND TotalFacturado = 0 AND Deben = 0 AND ordenCompra != '' AND status = 'Cerrado' ORDER BY Deben DESC")or die("Error : ".mysqli_error($conexion));

        }else{ //normal     apareceran folios abiertos que  solo tengan la MO_SA
          $result = mysqli_query($conexion, "SELECT id_hj, folio, (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario, n_proyecto, fchRarmado, fchRdesarmado, ordenCompra, sp, totalx_diasrenta, Mano_Obra_SA, Mano_Obra_SD, mano_obra, total, (SELECT SUM(mano_obra_SA) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SA, (SELECT SUM(mano_obra_SD) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SD, (SELECT SUM(costo_andamio) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_RentaMAterial, (SELECT SUM(Descuento) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreDescuento, nFactura, TotalFacturado, Deben, statusVenta FROM hoja_trabajo WHERE clientes_id = '$objeto->cliente_id' AND total > TotalFacturado AND mano_obra != 0.00 AND ordenCompra != '' AND (status = 'Cerrado' OR (status = 'Abierto' AND Mano_Obra_SA > 0 AND Mano_Obra_SD = 0.00 )) ORDER BY Deben DESC ")or die("Error : ".mysqli_error($conexion)); //AND TotalFacturado = 0 AND Deben = 0
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta de Vista de Hojas de trabajo
    public function consultarhoja_trabajo4($iniciomes, $finmes,$plantas)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo INNER JOIN clientes ON (hoja_trabajo.clientes_id = clientes.id_cliente) INNER JOIN user_cliente ON (hoja_trabajo.userC_id = user_cliente.id_userC) WHERE fchRarmado BETWEEN '$iniciomes' AND '$finmes' $plantas ORDER BY id_hj DESC ")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    //Consulta de Vista de Hojas de trabajo
    public function consultarhoja_trabajo5($folio,$plantas)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE folio LIKE '%".$folio."%' $plantas")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    //Obtiene algunos datos de todas las HojaTrabajo y las guarda en un arreglo
    public function ObtenerDatos_HojasTrabajo()
    {
        $aDatosHT = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, mano_obra, totalx_diasrenta, ordenCompra, statusVenta, nFactura, TotalFacturado, Deben, Mano_Obra_SA, Mano_Obra_SD FROM hoja_trabajo")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosHT[$data['id_hj']] = array('mano_obra' => $data['mano_obra'], 'totalx_diasrenta' => $data['totalx_diasrenta'], 'ordenCompra' => $data['ordenCompra'], 'statusVenta' => $data['statusVenta'], 'nFactura' => $data['nFactura'], 'TotalFacturado' => $data['TotalFacturado'], 'Deben' => $data['Deben'], 'Mano_Obra_SA' => $data['Mano_Obra_SA'], 'Mano_Obra_SD' => $data['Mano_Obra_SD']);
          $cont++;
        }
        return $aDatosHT;
    }

    //Obtiene algunos datos de todas las HojaTrabajo y las guarda en un arreglo
    public function ObtenerAlgunosDatos_HT()
    {
        $aDatos2HT = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, folio, fchRarmado, fchRdesarmado, clientes_id, userC_id, equipo, cargo, ordenCompra, totalrentaD_andamio, totalx_diasrenta, mano_obra, total, status, desmontaje, update_RentaDiaria FROM hoja_trabajo")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aDatos2HT[$data['id_hj']] = array('folio' => $data['folio'], 'fchRarmado' => $data['fchRarmado'], 'fchRdesarmado' => $data['fchRdesarmado'], 'cliente' => $data['clientes_id'],'userC_id' => $data['userC_id'], 'equipo' => $data['equipo'], 'cargo' => $data['cargo'], 'ordenCompra' => $data['ordenCompra'], 'TotalDRentaDiaria' => $data['totalrentaD_andamio'], 'totalDrenta' => $data['totalx_diasrenta'], 'mano_obra' => $data['mano_obra'], 'total' => $data['total'], 'status' => $data['status'], 'desmontaje' => $data['desmontaje'], 'update_RentaDiaria' => $data['update_RentaDiaria']);
          $cont++;
        }
        return $aDatos2HT;
    }

    //consultar HT por id
    public function consultar_HT($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE id_hj = '$objeto->id_HT'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //mostrar datos de ese folio
    public function mDatos_HojaT($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE folio = '$objeto->folio'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mDatos_HojaT_1($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, (SELECT nombre_userC FROM user_cliente WHERE id_userC = userC_id) AS usuario, folio, fchRarmado, fchRdesarmado, totalx_diasrenta, Mano_Obra_SA, Mano_Obra_SD, mano_obra, total, ordenCompra, TotalFacturado, Deben, TotalPagado, equipo FROM hoja_trabajo WHERE folio = '$objeto->folio'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /*Lo mismo que el de arriba, solo que muestra datos de tabla costos_prefacturas*/
    public function mDatos_HojaT_2($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT HT.id_hj, (SELECT nombre_userC FROM user_cliente WHERE id_userC = userC_id) AS usuario, HT.folio, HT.fchRarmado, HT.fchRdesarmado, HT.totalx_diasrenta, HT.Mano_Obra_SA, HT.Mano_Obra_SD, HT.mano_obra, HT.total, HT.ordenCompra, HT.TotalFacturado, HT.Deben, HT.TotalPagado, CP.*, HT.equipo FROM hoja_trabajo HT INNER JOIN costos_prefacturas CP ON HT.id_hj = CP.HT_ID WHERE HT.folio = '$objeto->folio' AND CP.Caratula_ID = '$objeto->id_CR'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //consultar HT por id
    public function obtenerID_HojaT($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, folio, Corte_Parcial FROM hoja_trabajo WHERE clientes_id = '$objeto->cliente_id' AND folio like '$objeto->nfolio'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Mostrar_FoliosConClon($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT folio FROM hoja_trabajo WHERE folio like '$objeto->Folio%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Buscar Folios en especifico para obtener sus datos, con solo el numero de su folio (n° despues del guion)
    public function BuscarFolios_HojaT($objeto)
    {
        $aDatosB = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, clientes_id, userC_id, equipo, folio, fchRarmado, fchRdesarmado FROM hoja_trabajo WHERE clientes_id = '$objeto->cliente_id' $objeto->consulta ORDER BY fchRarmado ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosB[$cont] = array('id_hj' => $data['id_hj'], 'clientes_id' => $data['clientes_id'], 'userC_id' => $data['userC_id'], 'equipo' => $data['equipo'], 'folio' => $data['folio'], 'fchRarmado' => $data['fchRarmado'], 'fchRdesarmado' => $data['fchRdesarmado']);
          $cont++;
        }
        return $aDatosB;
    }

    //Consulta precios_pieza
    public function consultarprecios_pieza()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM precios_pieza")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta precios_pieza
    public function consultar_piezas()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT codigo, descripcion FROM precios_pieza")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta precios_pieza por codigo
    public function PZ_PRECIO($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM precios_pieza WHERE codigo = '$objeto->codigo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //obtener cliente de dicho proyecto
    public function obten_cliente($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT cliente FROM `ventamaterial` WHERE id = '$objeto->nProyecto' UNION SELECT cliente FROM `manoobra` WHERE id = '$objeto->nProyecto' UNION ALL SELECT cliente FROM `rentamaterial` WHERE id = '$objeto->nProyecto' UNION ALL SELECT cliente FROM `preciofijo` WHERE id = '$objeto->nProyecto' UNION ALL SELECT cliente FROM `materialmanoobra` WHERE id = '$objeto->nProyecto'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function obtenerDProyecto($objeto) //muestra los datos del proyecto con el mismo id
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `ventamaterial` WHERE id='$objeto->proyecto' UNION SELECT * FROM `manoobra` WHERE id='$objeto->proyecto' UNION SELECT * FROM `rentamaterial` WHERE id='$objeto->proyecto' UNION SELECT * FROM `preciofijo` WHERE id='$objeto->proyecto' UNION SELECT * FROM `materialmanoobra` WHERE id='$objeto->proyecto'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function obtenerPrefijo($objeto) //muestra el nom. prefijo y nombre de ese cliente por medio del proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT C.prefijo, C.id_cliente FROM clientes C INNER JOIN (SELECT cliente FROM `ventamaterial` WHERE id='$objeto->n_Proyecto' UNION SELECT cliente FROM `manoobra` WHERE id='$objeto->n_Proyecto' UNION SELECT cliente FROM `rentamaterial` WHERE id='$objeto->n_Proyecto' UNION SELECT cliente FROM `preciofijo` WHERE id='$objeto->n_Proyecto' UNION SELECT cliente FROM `materialmanoobra` WHERE id='$objeto->n_Proyecto') P ON C.nombre = P.cliente")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //obtener el folio mayor de ese cliente
    public function folioMayor($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(CAST((REPLACE(folio,'$objeto->prefijo','')) AS UNSIGNED)) as folio FROM hoja_trabajo WHERE clientes_id = '$objeto->clienteID'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //obtener el folio clon mayor de ese folio original
    public function folioMayorClon($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(CAST((REPLACE(folio,'$objeto->Folio','')) AS UNSIGNED)) as folioClon FROM hoja_trabajo WHERE folio LIKE '$objeto->Folio%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //obtener usuarios de dicho cliente
    public function obtenDTuser_cliente($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_userC, nombre_userC FROM user_cliente WHERE cliente = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //obtener cliente de ese usuario
    public function obtenDTuser($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM user_cliente WHERE id_userC = '$objeto->usuarioID'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //obtener datos de ese usuario
    public function Datos_user($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `user_cliente` WHERE creado = '$objeto->creado'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //consultar si existe folio
    public function folioExiste_HT($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, clientes_id, userC_id, n_proyecto, companiaUso, planta, sp, cargo, THrsMuertasA, THrsMuertasD, dias_utilizados, personal, totalpz_andamio, totalrentaD_andamio, totalx_diasrenta, mano_obra, total, supervisor, creado
          FROM hoja_trabajo WHERE folio = '$objeto->folio'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //consultar si los datos ya existen en otro folio
    public function Existe_HT($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, piezas
          FROM hoja_trabajo WHERE clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->usuario_id' AND   n_proyecto = '$objeto->nProyecto' AND (creado BETWEEN '$objeto->fch2' AND '$objeto->fch1')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los proyectos vigentes
    public function proyectosVigentes()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `ventamaterial` WHERE estatus = 'Vigente' UNION ALL SELECT * FROM `rentamaterial` WHERE estatus = 'Vigente' UNION ALL SELECT * FROM `preciofijo` WHERE estatus = 'Vigente' UNION ALL SELECT * FROM `materialmanoobra` WHERE estatus = 'Vigente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los proyectos de ese cliente
    public function proyectosCliente($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `ventamaterial` WHERE cliente = '$objeto->cliente' UNION ALL SELECT * FROM `rentamaterial` WHERE cliente = '$objeto->cliente' UNION ALL SELECT * FROM `preciofijo` WHERE cliente = '$objeto->cliente'  UNION ALL SELECT * FROM `materialmanoobra` WHERE cliente = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los proyectos de ese cliente y que esten vigentes
    public function proyectosVigentesCliente($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `ventamaterial` WHERE cliente = '$objeto->cliente' AND estatus = 'Vigente' UNION ALL SELECT * FROM `rentamaterial` WHERE cliente = '$objeto->cliente' AND estatus = 'Vigente' UNION ALL SELECT * FROM `preciofijo` WHERE cliente = '$objeto->cliente' AND estatus = 'Vigente' UNION ALL SELECT * FROM `materialmanoobra` WHERE cliente = '$objeto->cliente' AND estatus = 'Vigente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los andamieros y ayudantes vigentes
    // AND estatus = 'Vigente'
    public function mAndamieros()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM andamieros WHERE (ocupacion = 'Eventual' OR ocupacion = 'Supervisor de Obra') AND estatus != 'Lista Negra' ORDER BY nombre ASC ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los supervisores vigentes
    public function mSupervisorObra()
    { //SELECT * FROM andamieros WHERE categoria = 'Supervisor de Obra' AND estatus = 'Vigente' ORDER BY nombre ASC
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT nombre,(SELECT categoria FROM `categoria` WHERE id_categoria = categoria) AS categoria FROM andamieros WHERE categoria = '2' AND estatus = 'Vigente' ORDER BY nombre ASC ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mSupervisorSeguridad()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT nombre,(SELECT categoria FROM `categoria` WHERE id_categoria = categoria) AS categoria FROM andamieros WHERE categoria = '1' AND estatus = 'Vigente' ORDER BY nombre ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los datos de esa persona
    public function mDatosAndamieros($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT andamieros.*, categoria.categoria AS Nom_Categoria FROM andamieros LEFT JOIN categoria on andamieros.categoria = categoria.id_categoria WHERE nombre = '$objeto->nombre'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function insertar_HojaTrabajo($objeto)//inserta datos en hoja trabajo
    {
        $conexion = $this->ConectarBD();

        if ($objeto->montaje != '' &&  $objeto->montajeReal != '' && $objeto->desmontaje != '' && $objeto->desmontajeReal != '') {
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, folio, sp, cargo, montaje,
              desmontaje, fchRarmado, hrsArmado,  fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados,  longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, total, supervisor, supervisorSGD, tipoPrecio, mano_obra, status, archivosSubidos, folioAntecesor, creado, statusVenta, tag1, tag2, tag3, tag4)
                        VALUES ('$objeto->clienteID',         '$objeto->usuarioID',           '$objeto->fecha',
                                '$objeto->n_Proyecto',        '$objeto->compañia',            '$objeto->tipo_andamio',
                                '$objeto->tipoSolicitud',     '$objeto->tipoActividad',       '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                                '$objeto->area',              '$objeto->equipo',              '$objeto->planta',
                                '$objeto->folio',             '$objeto->sp_ot',               '$objeto->cargo',
                                '$objeto->montaje',           '$objeto->desmontaje',          '$objeto->montajeReal',
                                '$objeto->hrsArmado',         '$objeto->desmontajeReal'     , '$objeto->hrsDesarmado',
                                '".mysqli_escape_string($conexion,$objeto->observacion)."',    '$objeto->TTHrsMuertasARM',
                                '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                                '$objeto->TTHrsMuertasDES',   '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                                '$objeto->nServicios',        '$objeto->periodo',             '$objeto->diasUtilizados',
                                '$objeto->longitud',          '$objeto->ancho',               '$objeto->altura',
                                '$objeto->volumen',           '$objeto->F_Dificultad',        '$objeto->piezas',
                                '$objeto->personal',          '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                                '$objeto->totalrentaD_andamio','$objeto->totalx_diasrenta',   '$objeto->total',
                                '$objeto->supervisor',        '$objeto->supervisorSGD',       '$objeto->tipoPrecio',
                                '$objeto->mano_obra',         '$objeto->status',              '$objeto->archivosSubidos',
                                '$objeto->folioAntecesor',    '$objeto->creado',              '$objeto->StatusV',
                                '".mysqli_escape_string($conexion,$objeto->tag1)."',
                                '".mysqli_escape_string($conexion,$objeto->tag2)."',
                                '".mysqli_escape_string($conexion,$objeto->tag3)."',
                                '".mysqli_escape_string($conexion,$objeto->tag4)."')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal != '' && $objeto->desmontaje != '' && $objeto->desmontajeReal == '') {
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, folio, sp, cargo, montaje,
              desmontaje, fchRarmado, hrsArmado,  fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, total, supervisor, supervisorSGD, tipoPrecio, mano_obra, status, archivosSubidos, folioAntecesor, creado, statusVenta, tag1, tag2, tag3, tag4)
                        VALUES ('$objeto->clienteID',         '$objeto->usuarioID',           '$objeto->fecha',
                                '$objeto->n_Proyecto',        '$objeto->compañia',            '$objeto->tipo_andamio',
                                '$objeto->tipoSolicitud',     '$objeto->tipoActividad',       '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                                '$objeto->area',              '$objeto->equipo',              '$objeto->planta',
                                '$objeto->folio',             '$objeto->sp_ot',               '$objeto->cargo',
                                '$objeto->montaje',           '$objeto->desmontaje',          '$objeto->montajeReal',
                                '$objeto->hrsArmado',          NULL,                          '$objeto->hrsDesarmado',
                                '".mysqli_escape_string($conexion,$objeto->observacion)."',   '$objeto->TTHrsMuertasARM',
                                '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                                '$objeto->TTHrsMuertasDES',   '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                                '$objeto->nServicios',        '$objeto->periodo',             '$objeto->diasUtilizados',
                                '$objeto->longitud',          '$objeto->ancho',               '$objeto->altura',
                                '$objeto->volumen',           '$objeto->F_Dificultad',        '$objeto->piezas',
                                '$objeto->personal',          '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                                '$objeto->totalrentaD_andamio','$objeto->totalx_diasrenta',   '$objeto->total',
                                '$objeto->supervisor',        '$objeto->supervisorSGD',       '$objeto->tipoPrecio',
                                '$objeto->mano_obra',         '$objeto->status',              '$objeto->archivosSubidos',
                                '$objeto->folioAntecesor',    '$objeto->creado',              '$objeto->StatusV',
                                '".mysqli_escape_string($conexion,$objeto->tag1)."',
                                '".mysqli_escape_string($conexion,$objeto->tag2)."',
                                '".mysqli_escape_string($conexion,$objeto->tag3)."',
                                '".mysqli_escape_string($conexion,$objeto->tag4)."')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal != '' && $objeto->desmontaje == '' && $objeto->desmontajeReal != '') {
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, folio, sp, cargo, montaje,
              desmontaje, fchRarmado, hrsArmado,  fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, total, supervisor, supervisorSGD, tipoPrecio, mano_obra, status, archivosSubidos, folioAntecesor, creado, statusVenta, tag1, tag2, tag3, tag4)
                        VALUES ('$objeto->clienteID',         '$objeto->usuarioID',           '$objeto->fecha',
                                '$objeto->n_Proyecto',        '$objeto->compañia',            '$objeto->tipo_andamio',
                                '$objeto->tipoSolicitud',     '$objeto->tipoActividad',       '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                                '$objeto->area',              '$objeto->equipo',              '$objeto->planta',
                                '$objeto->folio',             '$objeto->sp_ot',               '$objeto->cargo',
                                '$objeto->montaje',            NULL,                          '$objeto->montajeReal',
                                '$objeto->hrsArmado',         '$objeto->desmontajeReal'     , '$objeto->hrsDesarmado',
                                '".mysqli_escape_string($conexion,$objeto->observacion)."',   '$objeto->TTHrsMuertasARM',
                                '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                                '$objeto->TTHrsMuertasDES',   '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                                '$objeto->nServicios',        '$objeto->periodo',             '$objeto->diasUtilizados',
                                '$objeto->longitud',          '$objeto->ancho',               '$objeto->altura',
                                '$objeto->volumen',           '$objeto->F_Dificultad',        '$objeto->piezas',
                                '$objeto->personal',          '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                                '$objeto->totalrentaD_andamio','$objeto->totalx_diasrenta',   '$objeto->total',
                                '$objeto->supervisor',        '$objeto->supervisorSGD',       '$objeto->tipoPrecio',
                                '$objeto->mano_obra',         '$objeto->status',              '$objeto->archivosSubidos',
                                '$objeto->folioAntecesor',    '$objeto->creado',              '$objeto->StatusV',
                                '".mysqli_escape_string($conexion,$objeto->tag1)."',
                                '".mysqli_escape_string($conexion,$objeto->tag2)."',
                                '".mysqli_escape_string($conexion,$objeto->tag3)."',
                                '".mysqli_escape_string($conexion,$objeto->tag4)."')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal == '' && $objeto->desmontaje != '' && $objeto->desmontajeReal != '') {
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, folio, sp, cargo, montaje,
              desmontaje, fchRarmado, hrsArmado,  fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, total, supervisor, supervisorSGD, tipoPrecio, mano_obra, status, archivosSubidos, folioAntecesor, creado, statusVenta, tag1, tag2, tag3, tag4)
                        VALUES ('$objeto->clienteID',         '$objeto->usuarioID',           '$objeto->fecha',
                                '$objeto->n_Proyecto',        '$objeto->compañia',            '$objeto->tipo_andamio',
                                '$objeto->tipoSolicitud',     '$objeto->tipoActividad',       '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                                '$objeto->area',              '$objeto->equipo',              '$objeto->planta',
                                '$objeto->folio',             '$objeto->sp_ot',               '$objeto->cargo',
                                '$objeto->montaje',           '$objeto->desmontaje',           NULL,
                                '$objeto->hrsArmado',         '$objeto->desmontajeReal'     , '$objeto->hrsDesarmado',
                                '".mysqli_escape_string($conexion,$objeto->observacion)."',   '$objeto->TTHrsMuertasARM',
                                '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                                '$objeto->TTHrsMuertasDES',   '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                                '$objeto->nServicios',        '$objeto->periodo',             '$objeto->diasUtilizados',
                                '$objeto->longitud',          '$objeto->ancho',               '$objeto->altura',
                                '$objeto->volumen',           '$objeto->F_Dificultad',        '$objeto->piezas',
                                '$objeto->personal',          '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                                '$objeto->totalrentaD_andamio','$objeto->totalx_diasrenta',   '$objeto->total',
                                '$objeto->supervisor',        '$objeto->supervisorSGD',       '$objeto->tipoPrecio',
                                '$objeto->mano_obra',         '$objeto->status',              '$objeto->archivosSubidos',
                                '$objeto->folioAntecesor',    '$objeto->creado',              '$objeto->StatusV',
                                '".mysqli_escape_string($conexion,$objeto->tag1)."',
                                '".mysqli_escape_string($conexion,$objeto->tag2)."',
                                '".mysqli_escape_string($conexion,$objeto->tag3)."',
                                '".mysqli_escape_string($conexion,$objeto->tag4)."')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal != '' && $objeto->desmontaje == '' && $objeto->desmontajeReal == '') {
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, folio, sp, cargo, montaje,
              desmontaje, fchRarmado, hrsArmado,  fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, total, supervisor, supervisorSGD, tipoPrecio, mano_obra, status, archivosSubidos, folioAntecesor, creado, statusVenta, tag1, tag2, tag3, tag4)
                        VALUES ('$objeto->clienteID',         '$objeto->usuarioID',           '$objeto->fecha',
                                '$objeto->n_Proyecto',        '$objeto->compañia',            '$objeto->tipo_andamio',
                                '$objeto->tipoSolicitud',     '$objeto->tipoActividad',       '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                                '$objeto->area',              '$objeto->equipo',              '$objeto->planta',
                                '$objeto->folio',             '$objeto->sp_ot',               '$objeto->cargo',
                                '$objeto->montaje',            NULL,                          '$objeto->montajeReal',
                                '$objeto->hrsArmado',          NULL,                          '$objeto->hrsDesarmado',
                                '".mysqli_escape_string($conexion,$objeto->observacion)."',   '$objeto->TTHrsMuertasARM',
                                '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                                '$objeto->TTHrsMuertasDES',   '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                                '$objeto->nServicios',        '$objeto->periodo',             '$objeto->diasUtilizados',
                                '$objeto->longitud',          '$objeto->ancho',               '$objeto->altura',
                                '$objeto->volumen',           '$objeto->F_Dificultad',        '$objeto->piezas',
                                '$objeto->personal',          '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                                '$objeto->totalrentaD_andamio','$objeto->totalx_diasrenta',   '$objeto->total',
                                '$objeto->supervisor',        '$objeto->supervisorSGD',       '$objeto->tipoPrecio',
                                '$objeto->mano_obra',         '$objeto->status',              '$objeto->archivosSubidos',
                                '$objeto->folioAntecesor',    '$objeto->creado',              '$objeto->StatusV',
                                '".mysqli_escape_string($conexion,$objeto->tag1)."',
                                '".mysqli_escape_string($conexion,$objeto->tag2)."',
                                '".mysqli_escape_string($conexion,$objeto->tag3)."',
                                '".mysqli_escape_string($conexion,$objeto->tag4)."')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal == '' && $objeto->desmontaje != '' && $objeto->desmontajeReal == '') {
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, folio, sp, cargo, montaje,
              desmontaje, fchRarmado, hrsArmado,  fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, total, supervisor, supervisorSGD, tipoPrecio, mano_obra, status, archivosSubidos, folioAntecesor, creado, statusVenta, tag1, tag2, tag3, tag4)
                        VALUES ('$objeto->clienteID',         '$objeto->usuarioID',           '$objeto->fecha',
                                '$objeto->n_Proyecto',        '$objeto->compañia',            '$objeto->tipo_andamio',
                                '$objeto->tipoSolicitud',     '$objeto->tipoActividad',       '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                                '$objeto->area',              '$objeto->equipo',              '$objeto->planta',
                                '$objeto->folio',             '$objeto->sp_ot',               '$objeto->cargo',
                                '$objeto->montaje',           '$objeto->desmontaje',           NULL,
                                '$objeto->hrsArmado',          NULL,                          '$objeto->hrsDesarmado',
                                '".mysqli_escape_string($conexion,$objeto->observacion)."',   '$objeto->TTHrsMuertasARM',
                                '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                                '$objeto->TTHrsMuertasDES',   '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                                '$objeto->nServicios',        '$objeto->periodo',             '$objeto->diasUtilizados',
                                '$objeto->longitud',          '$objeto->ancho',               '$objeto->altura',
                                '$objeto->volumen',           '$objeto->F_Dificultad',        '$objeto->piezas',
                                '$objeto->personal',          '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                                '$objeto->totalrentaD_andamio','$objeto->totalx_diasrenta',   '$objeto->total',
                                '$objeto->supervisor',        '$objeto->supervisorSGD',       '$objeto->tipoPrecio',
                                '$objeto->mano_obra',         '$objeto->status',              '$objeto->archivosSubidos',
                                '$objeto->folioAntecesor',    '$objeto->creado',              '$objeto->StatusV',
                                '".mysqli_escape_string($conexion,$objeto->tag1)."',
                                '".mysqli_escape_string($conexion,$objeto->tag2)."',
                                '".mysqli_escape_string($conexion,$objeto->tag3)."',
                                '".mysqli_escape_string($conexion,$objeto->tag4)."')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal == '' && $objeto->desmontaje == '' && $objeto->desmontajeReal != '') {
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, folio, sp, cargo, montaje,
              desmontaje, fchRarmado, hrsArmado,  fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, total, supervisor, supervisorSGD, tipoPrecio, mano_obra, status, archivosSubidos, folioAntecesor, creado, statusVenta, tag1, tag2, tag3, tag4)
                        VALUES ('$objeto->clienteID',         '$objeto->usuarioID',           '$objeto->fecha',
                                '$objeto->n_Proyecto',        '$objeto->compañia',            '$objeto->tipo_andamio',
                                '$objeto->tipoSolicitud',     '$objeto->tipoActividad',       '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                                '$objeto->area',              '$objeto->equipo',              '$objeto->planta',
                                '$objeto->folio',             '$objeto->sp_ot',               '$objeto->cargo',
                                '$objeto->montaje',            NULL,                           NULL,
                                '$objeto->hrsArmado',         '$objeto->desmontajeReal'     , '$objeto->hrsDesarmado',
                                '".mysqli_escape_string($conexion,$objeto->observacion)."',   '$objeto->TTHrsMuertasARM',
                                '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                                '$objeto->TTHrsMuertasDES',   '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                                '$objeto->nServicios',        '$objeto->periodo',             '$objeto->diasUtilizados',
                                '$objeto->longitud',          '$objeto->ancho',               '$objeto->altura',
                                '$objeto->volumen',           '$objeto->F_Dificultad',        '$objeto->piezas',
                                '$objeto->personal',          '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                                '$objeto->totalrentaD_andamio','$objeto->totalx_diasrenta',   '$objeto->total',
                                '$objeto->supervisor',        '$objeto->supervisorSGD',       '$objeto->tipoPrecio',
                                '$objeto->mano_obra',         '$objeto->status',              '$objeto->archivosSubidos',
                                '$objeto->folioAntecesor',    '$objeto->creado',              '$objeto->StatusV',
                                '".mysqli_escape_string($conexion,$objeto->tag1)."',
                                '".mysqli_escape_string($conexion,$objeto->tag2)."',
                                '".mysqli_escape_string($conexion,$objeto->tag3)."',
                                '".mysqli_escape_string($conexion,$objeto->tag4)."')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal == '' && $objeto->desmontaje == '' && $objeto->desmontajeReal == '') {
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, folio, sp, cargo, montaje,
              desmontaje, fchRarmado, hrsArmado,  fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, total, supervisor, supervisorSGD, tipoPrecio, mano_obra, status, archivosSubidos, folioAntecesor, creado, statusVenta, tag1, tag2, tag3, tag4)
                        VALUES ('$objeto->clienteID',         '$objeto->usuarioID',           '$objeto->fecha',
                                '$objeto->n_Proyecto',        '$objeto->compañia',            '$objeto->tipo_andamio',
                                '$objeto->tipoSolicitud',     '$objeto->tipoActividad',       '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                                '$objeto->area',              '$objeto->equipo',              '$objeto->planta',
                                '$objeto->folio',             '$objeto->sp_ot',               '$objeto->cargo',
                                '$objeto->montaje',            NULL,                           NULL,
                                '$objeto->hrsArmado',          NULL,                          '$objeto->hrsDesarmado',
                                '".mysqli_escape_string($conexion,$objeto->observacion)."',   '$objeto->TTHrsMuertasARM',
                                '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                                '$objeto->TTHrsMuertasDES',   '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                                '$objeto->nServicios',        '$objeto->periodo',             '$objeto->diasUtilizados',
                                '$objeto->longitud',          '$objeto->ancho',               '$objeto->altura',
                                '$objeto->volumen',           '$objeto->F_Dificultad',        '$objeto->piezas',
                                '$objeto->personal',          '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                                '$objeto->totalrentaD_andamio','$objeto->totalx_diasrenta',   '$objeto->total',
                                '$objeto->supervisor',        '$objeto->supervisorSGD',       '$objeto->tipoPrecio',
                                '$objeto->mano_obra',         '$objeto->status',              '$objeto->archivosSubidos',
                                '$objeto->folioAntecesor',    '$objeto->creado',              '$objeto->StatusV',
                                '".mysqli_escape_string($conexion,$objeto->tag1)."',
                                '".mysqli_escape_string($conexion,$objeto->tag2)."',
                                '".mysqli_escape_string($conexion,$objeto->tag3)."',
                                '".mysqli_escape_string($conexion,$objeto->tag4)."')")or die("Error : ".mysqli_error($conexion));
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Insertar_HojaTrabajoClonada($objeto){/*Folio clonado corte parcial*/
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, ot_servicio, folio, folioAntecesor, sp, cargo, montaje, desmontaje, fchRarmado, hrsArmado,  fchRdesarmado,
        hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados,  longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, mano_obra, total, tipoPrecio, supervisor, supervisorSGD, archivosSubidos, status, ordenCompra, hoja_Entrada, nFactura, TotalFacturado, Deben, TotalPagado, FaltaPorPagar, statusVenta, Corte_Parcial, creado, modificado, tag1, tag2, tag3, tag4)
              VALUES ('$objeto->clienteID',           '$objeto->usuarioID',           '$objeto->fecha',
                      '$objeto->n_Proyecto',          '$objeto->compañia',            '$objeto->tipo_andamio',
                      '$objeto->tipoSolicitud',       '$objeto->tipoActividad',       '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                      '$objeto->area',                '$objeto->equipo',              '$objeto->planta',
                      '$objeto->ot_servicio',         '$objeto->folio',               '$objeto->folioAntecesor',
                      '$objeto->sp_ot',               '$objeto->cargo',               '$objeto->montaje',
                      '$objeto->desmontaje',          '$objeto->montajeReal',         '$objeto->hrsArmado',
                      NULL,                           '$objeto->hrsDesarmado',        '".mysqli_escape_string($conexion,$objeto->observacion)."',
                      '$objeto->TTHrsMuertasARM',     '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                      '$objeto->TTHrsMuertasDES',     '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                      '$objeto->nServicios',          '$objeto->periodo',             0,
                      '$objeto->longitud',            '$objeto->ancho',               '$objeto->altura',
                      '$objeto->volumen',             '$objeto->F_Dificultad',        '$objeto->piezas',
                      '$objeto->personal',            '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                      '$objeto->totalrentaD_andamio', 0.00,                            0.00,
                      0.00,                           '$objeto->tipoPrecio',          '$objeto->supervisor',
                      '$objeto->supervisorSGD',       '$objeto->archivosSubidos',     '$objeto->status',
                      '$objeto->ordenCompra',         NULL,       NULL,      0.00,    0.00,     0.00,     0.00,
                      '$objeto->StatusV',             1,          '$objeto->creado',  NULL,
                      '".mysqli_escape_string($conexion,$objeto->tag1)."',
                      '".mysqli_escape_string($conexion,$objeto->tag2)."',
                      '".mysqli_escape_string($conexion,$objeto->tag3)."',
                      '".mysqli_escape_string($conexion,$objeto->tag4)."')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function CrearHojaT_Clonada($objeto){ /*Folio clonado a otro proyecto al cancelar folio original*/
        $conexion = $this->ConectarBD();
        if($objeto->fchRdesarmado == ''){ //poner null
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, ot_servicio, folio, folioAntecesor, sp, cargo, montaje, desmontaje, fchRarmado, hrsArmado, fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, mano_obra, total, tipoPrecio, supervisor, supervisorSGD, archivosSubidos, status, ordenCompra, hoja_Entrada, statusVenta, update_RentaDiaria, update_porDiasRenta, tag1, tag2, tag3, tag4, creado)
                  VALUES ('$objeto->clientes_id',         '$objeto->userC_id',            '$objeto->fecha',
                          '$objeto->n_proyecto',          '$objeto->companiaUso',         '$objeto->tipo_andamio',
                          '$objeto->tipo_solicitud',      '$objeto->tipo_actividad',      '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                          '$objeto->area',                '$objeto->equipo',              '$objeto->planta',
                          '$objeto->ot_servicio',         '$objeto->folio',               '$objeto->folioAntecesor',
                          '$objeto->sp',                  '$objeto->cargo',               '$objeto->montaje',
                           NULL,                          '$objeto->fchRarmado',          '$objeto->hrsArmado',
                           NULL,                          '$objeto->hrsDesarmado',       '".mysqli_escape_string($conexion,$objeto->observaciones)."',
                          '$objeto->THrsMuertasA',        '".mysqli_escape_string($conexion,$objeto->descripciónHMA)."',
                          '$objeto->THrsMuertasD',        '".mysqli_escape_string($conexion,$objeto->descripciónHMD)."',
                          '$objeto->nServicios',          '$objeto->periodo',             '$objeto->dias_utilizados',
                          '$objeto->longitud',            '$objeto->ancho',               '$objeto->altura',
                          '$objeto->volumen',             '$objeto->fac_dificultad',      '$objeto->piezas',
                          '$objeto->personal',            '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                          '$objeto->totalrentaD_andamio', '$objeto->totalx_diasrenta',    '$objeto->mano_obra',
                          '$objeto->total',               '$objeto->tipoPrecio',          '$objeto->supervisor',
                          '$objeto->supervisorSGD',       '$objeto->archivosSubidos',     '$objeto->status',
                          '$objeto->ordenCompra',         '$objeto->hoja_Entrada',        '$objeto->statusVenta',
                          '$objeto->update_RentaDiaria',  '$objeto->update_porDiasRenta',
                          '".mysqli_escape_string($conexion,$objeto->tag1)."',
                          '".mysqli_escape_string($conexion,$objeto->tag2)."',
                          '".mysqli_escape_string($conexion,$objeto->tag3)."',
                          '".mysqli_escape_string($conexion,$objeto->tag4)."',
                          '$objeto->creado')")or die("Error : ".mysqli_error($conexion));
        }else{
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, ot_servicio, folio, folioAntecesor, sp, cargo, montaje, desmontaje, fchRarmado, hrsArmado, fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, mano_obra, total, tipoPrecio, supervisor, supervisorSGD, archivosSubidos, status, ordenCompra, hoja_Entrada, statusVenta, update_RentaDiaria, update_porDiasRenta, tag1, tag2, tag3, tag4, creado)
                  VALUES ('$objeto->clientes_id',         '$objeto->userC_id',            '$objeto->fecha',
                          '$objeto->n_proyecto',          '$objeto->companiaUso',         '$objeto->tipo_andamio',
                          '$objeto->tipo_solicitud',      '$objeto->tipo_actividad',      '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                          '$objeto->area',                '$objeto->equipo',              '$objeto->planta',
                          '$objeto->ot_servicio',         '$objeto->folio',               '$objeto->folioAntecesor',
                          '$objeto->sp',                  '$objeto->cargo',               '$objeto->montaje',
                          '$objeto->desmontaje',          '$objeto->fchRarmado',          '$objeto->hrsArmado',
                          '$objeto->fchRdesarmado',       '$objeto->hrsDesarmado',        '".mysqli_escape_string($conexion,$objeto->observaciones)."',
                          '$objeto->THrsMuertasA',        '".mysqli_escape_string($conexion,$objeto->descripciónHMA)."',
                          '$objeto->THrsMuertasD',        '".mysqli_escape_string($conexion,$objeto->descripciónHMD)."',
                          '$objeto->nServicios',          '$objeto->periodo',             '$objeto->dias_utilizados',
                          '$objeto->longitud',            '$objeto->ancho',               '$objeto->altura',
                          '$objeto->volumen',             '$objeto->fac_dificultad',      '$objeto->piezas',
                          '$objeto->personal',            '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                          '$objeto->totalrentaD_andamio', '$objeto->totalx_diasrenta',    '$objeto->mano_obra',
                          '$objeto->total',               '$objeto->tipoPrecio',          '$objeto->supervisor',
                          '$objeto->supervisorSGD',       '$objeto->archivosSubidos',     '$objeto->status',
                          '$objeto->ordenCompra',         '$objeto->hoja_Entrada',        '$objeto->statusVenta',
                          '$objeto->update_RentaDiaria',  '$objeto->update_porDiasRenta',
                          '".mysqli_escape_string($conexion,$objeto->tag1)."',
                          '".mysqli_escape_string($conexion,$objeto->tag2)."',
                          '".mysqli_escape_string($conexion,$objeto->tag3)."',
                          '".mysqli_escape_string($conexion,$objeto->tag4)."',
                          '$objeto->creado')")or die("Error : ".mysqli_error($conexion));
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function insertar_CorteMaterial($objeto){ /*Folio clonado, porque se cambiaron las piezas*/
        $conexion = $this->ConectarBD();

        if($objeto->desmontajeReal == ''){ //poner null
            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, ot_servicio, folio, folioAntecesor, sp, cargo, montaje, desmontaje, fchRarmado, hrsArmado, fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, mano_obra, total, tipoPrecio, supervisor, supervisorSGD, archivosSubidos, status, ordenCompra, statusVenta, Deben, Corte_Parcial, tag1, tag2, tag3, tag4, creado)
                  VALUES ('$objeto->clienteID',           '$objeto->usuarioID',           '$objeto->fecha',
                          '$objeto->n_Proyecto',          '$objeto->compañia',            '$objeto->tipo_andamio',
                          '$objeto->tipoSolicitud',       '$objeto->tipoActividad',      '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                          '$objeto->area',                '$objeto->equipo',              '$objeto->planta',
                          '$objeto->ot_servicio',         '$objeto->folio',               '$objeto->folioAntecesor',
                          '$objeto->sp_ot',               '$objeto->cargo',               '$objeto->montaje',
                           NULL,                          '$objeto->montajeReal',          '$objeto->hrsArmado',
                           NULL,                          '$objeto->hrsDesarmado',       '".mysqli_escape_string($conexion,$objeto->observacion)."',
                          '$objeto->TTHrsMuertasARM',     '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                          '$objeto->TTHrsMuertasDES',     '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                          '$objeto->nServicios',          '$objeto->periodo',             '$objeto->diasUtilizados',
                          '$objeto->longitud',            '$objeto->ancho',               '$objeto->altura',
                          '$objeto->volumen',             '$objeto->F_Dificultad',        '$objeto->piezas',
                          '$objeto->personal',            '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                          '$objeto->totalrentaD_andamio', '$objeto->totalx_diasrenta',    '$objeto->mano_obra',
                          '$objeto->total',               '$objeto->tipoPrecio',          '$objeto->supervisor',
                          '$objeto->supervisorSGD',       '$objeto->archivosSubidos',     '$objeto->status',
                          '$objeto->ordenCompra',         '$objeto->StatusV',             '$objeto->Deben',
                           '$objeto->CorteParcial',
                          '".mysqli_escape_string($conexion,$objeto->tag1)."',
                          '".mysqli_escape_string($conexion,$objeto->tag2)."',
                          '".mysqli_escape_string($conexion,$objeto->tag3)."',
                           '".mysqli_escape_string($conexion,$objeto->tag4)."',
                          '$objeto->creado'  )")or die("Error : ".mysqli_error($conexion));
        }else{

            $result = mysqli_query($conexion, "INSERT INTO hoja_trabajo (clientes_id, userC_id, fecha, n_proyecto, companiaUso, tipo_andamio, tipo_solicitud, tipo_actividad, descripcionT, area, equipo, planta, ot_servicio, folio, folioAntecesor, sp, cargo, montaje, desmontaje, fchRarmado, hrsArmado, fchRdesarmado, hrsDesarmado, observaciones, THrsMuertasA, descripciónHMA, THrsMuertasD, descripciónHMD, nServicios, periodo, dias_utilizados, longitud, ancho, altura, volumen, fac_dificultad, piezas, personal, totalpz_andamio, totalpeso_andamio, totalrentaD_andamio, totalx_diasrenta, mano_obra, total, tipoPrecio, supervisor, supervisorSGD, archivosSubidos, status, ordenCompra, statusVenta, Deben, Corte_Parcial, tag1, tag2, tag3, tag4, creado)
                  VALUES ('$objeto->clienteID',           '$objeto->usuarioID',           '$objeto->fecha',
                          '$objeto->n_Proyecto',          '$objeto->compañia',            '$objeto->tipo_andamio',
                          '$objeto->tipoSolicitud',       '$objeto->tipoActividad',      '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                          '$objeto->area',                '$objeto->equipo',              '$objeto->planta',
                          '$objeto->ot_servicio',         '$objeto->folio',               '$objeto->folioAntecesor',
                          '$objeto->sp_ot',               '$objeto->cargo',               '$objeto->montaje',
                          '$objeto->desmontaje',          '$objeto->montajeReal',          '$objeto->hrsArmado',
                          '$objeto->desmontajeReal',       '$objeto->hrsDesarmado',        '".mysqli_escape_string($conexion,$objeto->observacion)."',
                          '$objeto->TTHrsMuertasARM',     '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                          '$objeto->TTHrsMuertasDES',     '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                          '$objeto->nServicios',          '$objeto->periodo',             '$objeto->diasUtilizados',
                          '$objeto->longitud',            '$objeto->ancho',               '$objeto->altura',
                          '$objeto->volumen',             '$objeto->F_Dificultad',        '$objeto->piezas',
                          '$objeto->personal',            '$objeto->totalpz_andamio',     '$objeto->totalpeso_andamio',
                          '$objeto->totalrentaD_andamio', '$objeto->totalx_diasrenta',    '$objeto->mano_obra',
                          '$objeto->total',               '$objeto->tipoPrecio',          '$objeto->supervisor',
                          '$objeto->supervisorSGD',       '$objeto->archivosSubidos',     '$objeto->status',
                          '$objeto->ordenCompra',         '$objeto->StatusV',             '$objeto->Deben',
                          '$objeto->CorteParcial',
                          '".mysqli_escape_string($conexion,$objeto->tag1)."',
                          '".mysqli_escape_string($conexion,$objeto->tag2)."',
                          '".mysqli_escape_string($conexion,$objeto->tag3)."',
                          '".mysqli_escape_string($conexion,$objeto->tag4)."',
                          '$objeto->creado')")or die("Error : ".mysqli_error($conexion));
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificar_HojaTrabajo($objeto){//modificar HojaTrabajo
        $conexion = $this->ConectarBD();
        if ($objeto->montaje != '' &&  $objeto->montajeReal != '' && $objeto->desmontaje != '' && $objeto->desmontajeReal != '') {
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET clientes_id         = '$objeto->clienteID',           userC_id            = '$objeto->usuarioID',
                            fecha               = '$objeto->fecha',               n_proyecto          = '$objeto->n_Proyecto',
                            companiaUso         = '$objeto->compañia',            tipo_andamio        = '$objeto->tipo_andamio',
                            tipo_solicitud      = '$objeto->tipoSolicitud',       tipo_actividad      = '$objeto->tipoActividad',
                            descripcionT        = '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                            area                = '$objeto->area',                equipo              = '$objeto->equipo',
                            planta              = '$objeto->planta',              folio               = '$objeto->folio',
                            sp                  = '$objeto->sp_ot',               cargo               = '$objeto->cargo',
                            montaje             = '$objeto->montaje',             desmontaje          = '$objeto->desmontaje',
                            fchRarmado          = '$objeto->montajeReal',         hrsArmado           = '$objeto->hrsArmado',
                            fchRdesarmado       = '$objeto->desmontajeReal',      hrsDesarmado        = '$objeto->hrsDesarmado',
                            observaciones       = '".mysqli_escape_string($conexion,$objeto->observacion)."',
                            THrsMuertasA        = '$objeto->TTHrsMuertasARM',
                            descripciónHMA      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                            THrsMuertasD        = '$objeto->TTHrsMuertasDES',
                            descripciónHMD      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                            nServicios          = '$objeto->nServicios',          periodo             = '$objeto->periodo',
                            dias_utilizados     = '$objeto->diasUtilizados',      longitud            = '$objeto->longitud',
                            ancho               = '$objeto->ancho',               altura              = '$objeto->altura',
                            volumen             = '$objeto->volumen',             fac_dificultad      = '$objeto->F_Dificultad',
                            piezas              = '$objeto->piezas',              personal            = '$objeto->personal',
                            supervisor          = '$objeto->supervisor',          tipoPrecio          = '$objeto->tipoPrecio',
                            mano_obra           = '$objeto->mano_obra',           totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',   totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',    total               = '$objeto->total',
                            status              = '$objeto->status',              modificado          = '$objeto->modificado',
                            archivosSubidos     = '$objeto->archivosSubidos',     folioAntecesor      = '$objeto->folioAntecesor',
                            statusVenta         = '$objeto->StatusV',             update_porDiasRenta = '$objeto->update_porDiasRenta',
                            tag1                = '".mysqli_escape_string($conexion,$objeto->tag1)."',
                            tag2                = '".mysqli_escape_string($conexion,$objeto->tag2)."',
                            tag3                = '".mysqli_escape_string($conexion,$objeto->tag3)."',
                            tag4                = '".mysqli_escape_string($conexion,$objeto->tag4)."',
                            Deben               = '$objeto->Deben',               supervisorSGD       = '$objeto->supervisorSGD'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal != '' && $objeto->desmontaje != '' && $objeto->desmontajeReal == '') {
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET clientes_id         = '$objeto->clienteID',           userC_id            = '$objeto->usuarioID',
                            fecha               = '$objeto->fecha',               n_proyecto          = '$objeto->n_Proyecto',
                            companiaUso         = '$objeto->compañia',            tipo_andamio        = '$objeto->tipo_andamio',
                            tipo_solicitud      = '$objeto->tipoSolicitud',       tipo_actividad      = '$objeto->tipoActividad',
                            descripcionT        = '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                            area                = '$objeto->area',                equipo              = '$objeto->equipo',
                            planta              = '$objeto->planta',              folio               = '$objeto->folio',
                            sp                  = '$objeto->sp_ot',               cargo               = '$objeto->cargo',
                            montaje             = '$objeto->montaje',             desmontaje          = '$objeto->desmontaje',
                            fchRarmado          = '$objeto->montajeReal',         hrsArmado           = '$objeto->hrsArmado',
                            fchRdesarmado       =  NULL,                          hrsDesarmado        = '$objeto->hrsDesarmado',
                            observaciones       = '".mysqli_escape_string($conexion,$objeto->observacion)."',
                            THrsMuertasA        = '$objeto->TTHrsMuertasARM',
                            descripciónHMA      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                            THrsMuertasD        = '$objeto->TTHrsMuertasDES',
                            descripciónHMD      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                            nServicios          = '$objeto->nServicios',          periodo             = '$objeto->periodo',
                            dias_utilizados     = '$objeto->diasUtilizados',      longitud            = '$objeto->longitud',
                            ancho               = '$objeto->ancho',               altura              = '$objeto->altura',
                            volumen             = '$objeto->volumen',             fac_dificultad      = '$objeto->F_Dificultad',
                            piezas              = '$objeto->piezas',              personal            = '$objeto->personal',
                            supervisor          = '$objeto->supervisor',          tipoPrecio          = '$objeto->tipoPrecio',
                            mano_obra           = '$objeto->mano_obra',           totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',   totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',    total               = '$objeto->total',
                            status              = '$objeto->status',              modificado          = '$objeto->modificado',
                            archivosSubidos     = '$objeto->archivosSubidos',     folioAntecesor      = '$objeto->folioAntecesor',
                            statusVenta         = '$objeto->StatusV',             update_porDiasRenta = '$objeto->update_porDiasRenta',
                            tag1                = '".mysqli_escape_string($conexion,$objeto->tag1)."',
                            tag2                = '".mysqli_escape_string($conexion,$objeto->tag2)."',
                            tag3                = '".mysqli_escape_string($conexion,$objeto->tag3)."',
                            tag4                = '".mysqli_escape_string($conexion,$objeto->tag4)."',
                            Deben               = '$objeto->Deben',               supervisorSGD       = '$objeto->supervisorSGD'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal != '' && $objeto->desmontaje == '' && $objeto->desmontajeReal != '') {
           $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET clientes_id         = '$objeto->clienteID',           userC_id            = '$objeto->usuarioID',
                            fecha               = '$objeto->fecha',               n_proyecto          = '$objeto->n_Proyecto',
                            companiaUso         = '$objeto->compañia',            tipo_andamio        = '$objeto->tipo_andamio',
                            tipo_solicitud      = '$objeto->tipoSolicitud',       tipo_actividad      = '$objeto->tipoActividad',
                            descripcionT        = '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                            area                = '$objeto->area',                equipo              = '$objeto->equipo',
                            planta              = '$objeto->planta',              folio               = '$objeto->folio',
                            sp                  = '$objeto->sp_ot',               cargo               = '$objeto->cargo',
                            montaje             = '$objeto->montaje',             desmontaje          =  NULL,
                            fchRarmado          = '$objeto->montajeReal',         hrsArmado           = '$objeto->hrsArmado',
                            fchRdesarmado       = '$objeto->desmontajeReal',      hrsDesarmado        = '$objeto->hrsDesarmado',
                            observaciones       = '".mysqli_escape_string($conexion,$objeto->observacion)."',
                            THrsMuertasA        = '$objeto->TTHrsMuertasARM',
                            descripciónHMA      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                            THrsMuertasD        = '$objeto->TTHrsMuertasDES',
                            descripciónHMD      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                            nServicios          = '$objeto->nServicios',          periodo             = '$objeto->periodo',
                            dias_utilizados     = '$objeto->diasUtilizados',      longitud            = '$objeto->longitud',
                            ancho               = '$objeto->ancho',               altura              = '$objeto->altura',
                            volumen             = '$objeto->volumen',             fac_dificultad      = '$objeto->F_Dificultad',
                            piezas              = '$objeto->piezas',              personal            = '$objeto->personal',
                            supervisor          = '$objeto->supervisor',          tipoPrecio          = '$objeto->tipoPrecio',
                            mano_obra           = '$objeto->mano_obra',           totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',   totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',    total               = '$objeto->total',
                            status              = '$objeto->status',              modificado          = '$objeto->modificado',
                            archivosSubidos     = '$objeto->archivosSubidos',     folioAntecesor      = '$objeto->folioAntecesor',
                            statusVenta         = '$objeto->StatusV',             update_porDiasRenta = '$objeto->update_porDiasRenta',
                            tag1                = '".mysqli_escape_string($conexion,$objeto->tag1)."',
                            tag2                = '".mysqli_escape_string($conexion,$objeto->tag2)."',
                            tag3                = '".mysqli_escape_string($conexion,$objeto->tag3)."',
                            tag4                = '".mysqli_escape_string($conexion,$objeto->tag4)."',
                            Deben               = '$objeto->Deben',               supervisorSGD       = '$objeto->supervisorSGD'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal == '' && $objeto->desmontaje != '' && $objeto->desmontajeReal != '') {
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET clientes_id         = '$objeto->clienteID',           userC_id            = '$objeto->usuarioID',
                            fecha               = '$objeto->fecha',               n_proyecto          = '$objeto->n_Proyecto',
                            companiaUso         = '$objeto->compañia',            tipo_andamio        = '$objeto->tipo_andamio',
                            tipo_solicitud      = '$objeto->tipoSolicitud',       tipo_actividad      = '$objeto->tipoActividad',
                            descripcionT        = '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                            area                = '$objeto->area',                equipo              = '$objeto->equipo',
                            planta              = '$objeto->planta',              folio               = '$objeto->folio',
                            sp                  = '$objeto->sp_ot',               cargo               = '$objeto->cargo',
                            montaje             = '$objeto->montaje',             desmontaje          = '$objeto->desmontaje',
                            fchRarmado          =  NULL,                          hrsArmado           = '$objeto->hrsArmado',
                            fchRdesarmado       = '$objeto->desmontajeReal',      hrsDesarmado        = '$objeto->hrsDesarmado',
                            observaciones       = '".mysqli_escape_string($conexion,$objeto->observacion)."',
                            THrsMuertasA        = '$objeto->TTHrsMuertasARM',
                            descripciónHMA      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                            THrsMuertasD        = '$objeto->TTHrsMuertasDES',
                            descripciónHMD      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                            nServicios          = '$objeto->nServicios',          periodo             = '$objeto->periodo',
                            dias_utilizados     = '$objeto->diasUtilizados',      longitud            = '$objeto->longitud',
                            ancho               = '$objeto->ancho',               altura              = '$objeto->altura',
                            volumen             = '$objeto->volumen',             fac_dificultad      = '$objeto->F_Dificultad',
                            piezas              = '$objeto->piezas',              personal            = '$objeto->personal',
                            supervisor          = '$objeto->supervisor',          tipoPrecio          = '$objeto->tipoPrecio',
                            mano_obra           = '$objeto->mano_obra',           totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',   totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',    total               = '$objeto->total',
                            status              = '$objeto->status',              modificado          = '$objeto->modificado',
                            archivosSubidos     = '$objeto->archivosSubidos',     folioAntecesor      = '$objeto->folioAntecesor',
                            statusVenta         = '$objeto->StatusV',             update_porDiasRenta = '$objeto->update_porDiasRenta',
                            tag1                = '".mysqli_escape_string($conexion,$objeto->tag1)."',
                            tag2                = '".mysqli_escape_string($conexion,$objeto->tag2)."',
                            tag3                = '".mysqli_escape_string($conexion,$objeto->tag3)."',
                            tag4                = '".mysqli_escape_string($conexion,$objeto->tag4)."',
                            Deben               = '$objeto->Deben',               supervisorSGD       = '$objeto->supervisorSGD'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal != '' && $objeto->desmontaje == '' && $objeto->desmontajeReal == '') {
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET clientes_id         = '$objeto->clienteID',           userC_id            = '$objeto->usuarioID',
                            fecha               = '$objeto->fecha',               n_proyecto          = '$objeto->n_Proyecto',
                            companiaUso         = '$objeto->compañia',            tipo_andamio        = '$objeto->tipo_andamio',
                            tipo_solicitud      = '$objeto->tipoSolicitud',       tipo_actividad      = '$objeto->tipoActividad',
                            descripcionT        = '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                            area                = '$objeto->area',                equipo              = '$objeto->equipo',
                            planta              = '$objeto->planta',              folio               = '$objeto->folio',
                            sp                  = '$objeto->sp_ot',               cargo               = '$objeto->cargo',
                            montaje             = '$objeto->montaje',             desmontaje          =  NULL,
                            fchRarmado          = '$objeto->montajeReal',         hrsArmado           = '$objeto->hrsArmado',
                            fchRdesarmado       =  NULL,                          hrsDesarmado        = '$objeto->hrsDesarmado',
                            observaciones       = '".mysqli_escape_string($conexion,$objeto->observacion)."',
                            THrsMuertasA        = '$objeto->TTHrsMuertasARM',
                            descripciónHMA      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                            THrsMuertasD        = '$objeto->TTHrsMuertasDES',
                            descripciónHMD      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                            nServicios          = '$objeto->nServicios',          periodo             = '$objeto->periodo',
                            dias_utilizados     = '$objeto->diasUtilizados',      longitud            = '$objeto->longitud',
                            ancho               = '$objeto->ancho',               altura              = '$objeto->altura',
                            volumen             = '$objeto->volumen',             fac_dificultad      = '$objeto->F_Dificultad',
                            piezas              = '$objeto->piezas',              personal            = '$objeto->personal',
                            supervisor          = '$objeto->supervisor',          tipoPrecio          = '$objeto->tipoPrecio',
                            mano_obra           = '$objeto->mano_obra',           totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',   totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',    total               = '$objeto->total',
                            status              = '$objeto->status',              modificado          = '$objeto->modificado',
                            archivosSubidos     = '$objeto->archivosSubidos',     folioAntecesor      = '$objeto->folioAntecesor',
                            statusVenta         = '$objeto->StatusV',             update_porDiasRenta = '$objeto->update_porDiasRenta',
                            tag1                = '".mysqli_escape_string($conexion,$objeto->tag1)."',
                            tag2                = '".mysqli_escape_string($conexion,$objeto->tag2)."',
                            tag3                = '".mysqli_escape_string($conexion,$objeto->tag3)."',
                            tag4                = '".mysqli_escape_string($conexion,$objeto->tag4)."',
                            Deben               = '$objeto->Deben',               supervisorSGD       = '$objeto->supervisorSGD'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal == '' && $objeto->desmontaje != '' && $objeto->desmontajeReal == '') {
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET clientes_id         = '$objeto->clienteID',           userC_id            = '$objeto->usuarioID',
                            fecha               = '$objeto->fecha',               n_proyecto          = '$objeto->n_Proyecto',
                            companiaUso         = '$objeto->compañia',            tipo_andamio        = '$objeto->tipo_andamio',
                            tipo_solicitud      = '$objeto->tipoSolicitud',       tipo_actividad      = '$objeto->tipoActividad',
                            descripcionT        = '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                            area                = '$objeto->area',                equipo              = '$objeto->equipo',
                            planta              = '$objeto->planta',              folio               = '$objeto->folio',
                            sp                  = '$objeto->sp_ot',               cargo               = '$objeto->cargo',
                            montaje             = '$objeto->montaje',             desmontaje          = '$objeto->desmontaje',
                            fchRarmado          =  NULL,                          hrsArmado           = '$objeto->hrsArmado',
                            fchRdesarmado       =  NULL,                          hrsDesarmado        = '$objeto->hrsDesarmado',
                            observaciones       = '".mysqli_escape_string($conexion,$objeto->observacion)."',
                            THrsMuertasA        = '$objeto->TTHrsMuertasARM',
                            descripciónHMA      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                            THrsMuertasD        = '$objeto->TTHrsMuertasDES',
                            descripciónHMD      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                            nServicios          = '$objeto->nServicios',          periodo             = '$objeto->periodo',
                            dias_utilizados     = '$objeto->diasUtilizados',      longitud            = '$objeto->longitud',
                            ancho               = '$objeto->ancho',               altura              = '$objeto->altura',
                            volumen             = '$objeto->volumen',             fac_dificultad      = '$objeto->F_Dificultad',
                            piezas              = '$objeto->piezas',              personal            = '$objeto->personal',
                            supervisor          = '$objeto->supervisor',          tipoPrecio          = '$objeto->tipoPrecio',
                            mano_obra           = '$objeto->mano_obra',           totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',   totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',    total               = '$objeto->total',
                            status              = '$objeto->status',              modificado          = '$objeto->modificado',
                            archivosSubidos     = '$objeto->archivosSubidos',     folioAntecesor      = '$objeto->folioAntecesor',
                            statusVenta         = '$objeto->StatusV',             update_porDiasRenta = '$objeto->update_porDiasRenta',
                            tag1                = '".mysqli_escape_string($conexion,$objeto->tag1)."',
                            tag2                = '".mysqli_escape_string($conexion,$objeto->tag2)."',
                            tag3                = '".mysqli_escape_string($conexion,$objeto->tag3)."',
                            tag4                = '".mysqli_escape_string($conexion,$objeto->tag4)."',
                            Deben               = '$objeto->Deben',               supervisorSGD       = '$objeto->supervisorSGD'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal == '' && $objeto->desmontaje == '' && $objeto->desmontajeReal != '') {
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET clientes_id         = '$objeto->clienteID',           userC_id            = '$objeto->usuarioID',
                            fecha               = '$objeto->fecha',               n_proyecto          = '$objeto->n_Proyecto',
                            companiaUso         = '$objeto->compañia',            tipo_andamio        = '$objeto->tipo_andamio',
                            tipo_solicitud      = '$objeto->tipoSolicitud',       tipo_actividad      = '$objeto->tipoActividad',
                            descripcionT        = '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                            area                = '$objeto->area',                equipo              = '$objeto->equipo',
                            planta              = '$objeto->planta',              folio               = '$objeto->folio',
                            sp                  = '$objeto->sp_ot',               cargo               = '$objeto->cargo',
                            montaje             = '$objeto->montaje',             desmontaje          =  NULL,
                            fchRarmado          =  NULL,                          hrsArmado           = '$objeto->hrsArmado',
                            fchRdesarmado       = '$objeto->desmontajeReal',      hrsDesarmado        = '$objeto->hrsDesarmado',
                            observaciones       = '".mysqli_escape_string($conexion,$objeto->observacion)."',
                            THrsMuertasA        = '$objeto->TTHrsMuertasARM',
                            descripciónHMA      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                            THrsMuertasD        = '$objeto->TTHrsMuertasDES',
                            descripciónHMD      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                            nServicios          = '$objeto->nServicios',          periodo             = '$objeto->periodo',
                            dias_utilizados     = '$objeto->diasUtilizados',      longitud            = '$objeto->longitud',
                            ancho               = '$objeto->ancho',               altura              = '$objeto->altura',
                            volumen             = '$objeto->volumen',             fac_dificultad      = '$objeto->F_Dificultad',
                            piezas              = '$objeto->piezas',              personal            = '$objeto->personal',
                            supervisor          = '$objeto->supervisor',          tipoPrecio          = '$objeto->tipoPrecio',
                            mano_obra           = '$objeto->mano_obra',           totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',   totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',    total               = '$objeto->total',
                            status              = '$objeto->status',              modificado          = '$objeto->modificado',
                            archivosSubidos     = '$objeto->archivosSubidos',     folioAntecesor      = '$objeto->folioAntecesor',
                            statusVenta         = '$objeto->StatusV',             update_porDiasRenta = '$objeto->update_porDiasRenta',
                            tag1                = '".mysqli_escape_string($conexion,$objeto->tag1)."',
                            tag2                = '".mysqli_escape_string($conexion,$objeto->tag2)."',
                            tag3                = '".mysqli_escape_string($conexion,$objeto->tag3)."',
                            tag4                = '".mysqli_escape_string($conexion,$objeto->tag4)."',
                            Deben               = '$objeto->Deben',               supervisorSGD       = '$objeto->supervisorSGD'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->montaje != '' &&  $objeto->montajeReal == '' && $objeto->desmontaje == '' && $objeto->desmontajeReal == '') {
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET clientes_id         = '$objeto->clienteID',           userC_id            = '$objeto->usuarioID',
                            fecha               = '$objeto->fecha',               n_proyecto          = '$objeto->n_Proyecto',
                            companiaUso         = '$objeto->compañia',            tipo_andamio        = '$objeto->tipo_andamio',
                            tipo_solicitud      = '$objeto->tipoSolicitud',       tipo_actividad      = '$objeto->tipoActividad',
                            descripcionT        = '".mysqli_escape_string($conexion,$objeto->descripcionT)."',
                            area                = '$objeto->area',                equipo              = '$objeto->equipo',
                            planta              = '$objeto->planta',              folio               = '$objeto->folio',
                            sp                  = '$objeto->sp_ot',               cargo               = '$objeto->cargo',
                            montaje             = '$objeto->montaje',             desmontaje          =  NULL,
                            fchRarmado          =  NULL,                          hrsArmado           = '$objeto->hrsArmado',
                            fchRdesarmado       =  NULL,                          hrsDesarmado        = '$objeto->hrsDesarmado',
                            observaciones       = '".mysqli_escape_string($conexion,$objeto->observacion)."',
                            THrsMuertasA        = '$objeto->TTHrsMuertasARM',
                            descripciónHMA      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasARM)."',
                            THrsMuertasD        = '$objeto->TTHrsMuertasDES',
                            descripciónHMD      = '".mysqli_escape_string($conexion,$objeto->DescripHrsMuertasDES)."',
                            nServicios          = '$objeto->nServicios',          periodo             = '$objeto->periodo',
                            dias_utilizados     = '$objeto->diasUtilizados',      longitud            = '$objeto->longitud',
                            ancho               = '$objeto->ancho',               altura              = '$objeto->altura',
                            volumen             = '$objeto->volumen',             fac_dificultad      = '$objeto->F_Dificultad',
                            piezas              = '$objeto->piezas',              personal            = '$objeto->personal',
                            supervisor          = '$objeto->supervisor',          tipoPrecio          = '$objeto->tipoPrecio',
                            mano_obra           = '$objeto->mano_obra',           totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',   totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',    total               = '$objeto->total',
                            status              = '$objeto->status',              modificado          = '$objeto->modificado',
                            archivosSubidos     = '$objeto->archivosSubidos',     folioAntecesor      = '$objeto->folioAntecesor',
                            statusVenta         = '$objeto->StatusV',             update_porDiasRenta = '$objeto->update_porDiasRenta',
                            tag1                = '".mysqli_escape_string($conexion,$objeto->tag1)."',
                            tag2                = '".mysqli_escape_string($conexion,$objeto->tag2)."',
                            tag3                = '".mysqli_escape_string($conexion,$objeto->tag3)."',
                            tag4                = '".mysqli_escape_string($conexion,$objeto->tag4)."',
                            Deben               = '$objeto->Deben',               supervisorSGD       = '$objeto->supervisorSGD'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificar_HojaTrabajoMO($objeto){//modificar HojaTrabajo solo mano obra
        $conexion = $this->ConectarBD();

        if($objeto->opcion == 'SA'){
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET Mano_Obra_SA        = '$objeto->Mano_Obra_Serv',
                            mano_obra           = '$objeto->mano_obra',
                            total               = '$objeto->total',
                            Deben               = '$objeto->Deben',
                            statusVenta         = '$objeto->statusVenta',
                            modificado          = '$objeto->modificado'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));
        }else{
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET Mano_Obra_SD        = '$objeto->Mano_Obra_Serv',
                            mano_obra           = '$objeto->mano_obra',
                            total               = '$objeto->total',
                            Deben               = '$objeto->Deben',
                            statusVenta         = '$objeto->statusVenta',
                            modificado          = '$objeto->modificado'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));
        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_HojaTrabajoMCierre($objeto){//cerrar hojaTrabajo cuando se hace corte parcial
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET desmontaje          = '$objeto->desmontaje',
                            fchRdesarmado       = '$objeto->fchRdesarmado',
                            dias_utilizados     = '$objeto->dias_utilizados',
                            totalrentaD_andamio = '$objeto->TotalRentaDiaria',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',
                            mano_obra           = '$objeto->mano_obra',
                            total               = '$objeto->total',
                            status              = '$objeto->status',
                            modificado          = '$objeto->modificado',
                            update_RentaDiaria  = '$objeto->update_RentaDiaria'
                        WHERE folio  = '$objeto->folio' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_HojaTrabajoCierre2($objeto){//cerrar hojaTrabajo cuando se hace corte parcial por piezas
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET desmontaje          = '$objeto->desmontaje',
                            fchRdesarmado       = '$objeto->fchRdesarmado',
                            dias_utilizados     = '$objeto->dias_utilizados',
                            totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',
                            totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',
                            total               = '$objeto->total',
                            modificado          = '$objeto->modificado',
                            status              = '$objeto->status'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificar_HojaTrabajoOC($objeto){//modificar HojaTrabajo solo orden Compra
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET ordenCompra = '$objeto->OrdenC'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificar_HojaTrabajoitem($objeto){//modificar HojaTrabajo solo item
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET item = '$objeto->item'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificar_HojaTrabajoHE($objeto){//modificar HojaTrabajo solo Hoja entrada
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET hoja_Entrada = '$objeto->hoja'
                        WHERE folio  = '$objeto->folio' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificar_HojaTrabajoSV($objeto){//modificar HojaTrabajo solo status Venta
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET statusVenta = '$objeto->StatusV'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_HojaTrabajoSV($objeto){//modificar HojaTrabajo solo status Venta con el folio
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET statusVenta = '$objeto->StatusV'
                        WHERE folio  = '$objeto->folio' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificar_TotalPz($objeto){//modificar total de piezas de cada HojaTrabajo
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',
                            totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',
                            total               = '$objeto->total'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra tipo de actividad
    public function Tipo_actividad()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM actividad_ht")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra el id mayor
    public function mayorID()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(id) FROM actividad_ht")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consult_HT_RDiario($objeto)
    {
        $conexion = $this->ConectarBD();
        if ($objeto->RD == 1) {
          $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE (fchRarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') OR (fchRdesarmado BETWEEN '$objeto->inicio' AND '$objeto->fin')")or die("Error : ".mysqli_error($conexion));
        }else if ($objeto->RD == 2) {
          $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE clientes_id = '$objeto->id_cliente' AND ( (fchRarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') OR (fchRdesarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') )")or die("Error : ".mysqli_error($conexion));
        }else if ($objeto->RD == 3) {
          $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE clientes_id = '$objeto->id_cliente' AND supervisor = '$objeto->supervisor' AND ((fchRarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') OR (fchRdesarmado BETWEEN '$objeto->inicio' AND '$objeto->fin'))")or die("Error : ".mysqli_error($conexion));
        }else if ($objeto->RD == 4) {
          $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE supervisor = '$objeto->supervisor' AND ( (fchRarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') OR (fchRdesarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') )")or die("Error : ".mysqli_error($conexion));
        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los supervisores que tienen HT
    public function supervisoresHT()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT supervisor FROM hoja_trabajo GROUP BY supervisor")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //consultar HT por cliente y Fecha
    public function consulta_HT_CF($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE clientes_id = '$objeto->id_cliente' AND (fchRarmado LIKE '$objeto->fecha%' OR desmontaje LIKE '$objeto->fecha%')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los cargos de ese cliente
    public function cargosCliente($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `cargo_cliente` WHERE cliente = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarProyectos_HT($objeto) //muestra las hojas e trabajo igual al n_proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `hoja_trabajo` WHERE n_proyecto = '$objeto->proyecto' AND status = 'Cerrado'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_TipoPrecioCostos($objeto){//modificar HojaTrabajo solo mano obra
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',
                            total               = '$objeto->total',
                            tipoPrecio          = '$objeto->tipoPrecio'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra hoja_trabajo
    public function mostrarFolioHT()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj,folio FROM hoja_trabajo")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Ubdate_Folio_HT($objeto){//modificar HojaTrabajo solo folio
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET folio = '$objeto->folio'
                        WHERE id_hj  = '$objeto->id' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Folios_con_OrdenCompra_HT($objeto)
    {
        $conexion = $this->ConectarBD();
        if($objeto->radioParcial == 'SoloRentaAndamio'){
            $result = mysqli_query($conexion, "SELECT id_hj, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente, n_proyecto, folio, (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario, fchRarmado, fchRdesarmado, ordenCompra, sp, totalrentaD_andamio, totalx_diasrenta, Mano_Obra_SA, Mano_Obra_SD, mano_obra, total, nFactura, TotalFacturado, Deben, TotalPagado, FaltaPorPagar, statusVenta, (SELECT SUM(mano_obra_SA) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SA, (SELECT SUM(mano_obra_SD) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SD, (SELECT SUM(costo_andamio) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_RentaMAterial, (SELECT SUM(Descuento) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreDescuento FROM `hoja_trabajo` WHERE clientes_id = '$objeto->cliente' AND ordenCompra LIKE '%$objeto->ordenCompra%' AND mano_obra = 0 AND (total > TotalFacturado OR total = 0)")or die("Error : ".mysqli_error($conexion));
        }else{
            if($objeto->radioParcial == 'Costo_Andamio'){ //Para que salgan los clones tambien
                $result = mysqli_query($conexion, "SELECT id_hj, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente, n_proyecto, folio, (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario, fchRarmado, fchRdesarmado, ordenCompra, sp, totalrentaD_andamio, totalx_diasrenta,  Mano_Obra_SA, Mano_Obra_SD, mano_obra, total, nFactura, TotalFacturado, Deben, TotalPagado, FaltaPorPagar, statusVenta, (SELECT SUM(mano_obra_SA) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SA, (SELECT SUM(mano_obra_SD) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SD, (SELECT SUM(costo_andamio) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_RentaMAterial, (SELECT SUM(Descuento) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreDescuento FROM `hoja_trabajo` WHERE clientes_id = '$objeto->cliente' AND ordenCompra LIKE '%$objeto->ordenCompra%' AND (mano_obra > 0 OR Corte_Parcial > 0) AND (total >= TotalFacturado OR total = 0)")or die("Error : ".mysqli_error($conexion));
            }else{
                $result = mysqli_query($conexion, "SELECT id_hj, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente, n_proyecto, folio, (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario, fchRarmado, fchRdesarmado, ordenCompra, sp, totalrentaD_andamio, totalx_diasrenta,  Mano_Obra_SA, Mano_Obra_SD, mano_obra, total, nFactura, TotalFacturado, Deben, TotalPagado, FaltaPorPagar, statusVenta, (SELECT SUM(mano_obra_SA) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SA, (SELECT SUM(mano_obra_SD) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_MO_SD, (SELECT SUM(costo_andamio) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreTotal_RentaMAterial, (SELECT SUM(Descuento) FROM `costos_prefacturas` WHERE HT_ID = id_hj) AS PreDescuento FROM `hoja_trabajo` WHERE clientes_id = '$objeto->cliente' AND ordenCompra LIKE '%$objeto->ordenCompra%' AND mano_obra > 0 AND (total >= TotalFacturado OR total = 0)")or die("Error : ".mysqli_error($conexion));
            }
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consulta_script($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, folio, fchRarmado, fchRdesarmado, tipoPrecio, piezas, nServicios, dias_utilizados, totalrentaD_andamio, totalx_diasrenta, mano_obra, total FROM `hoja_trabajo` WHERE clientes_id = '$objeto->cliente' and (fchRarmado LIKE '$objeto->fecha%' or fchRdesarmado LIKE '$objeto->fecha%') ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarSP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT(sp) FROM `hoja_trabajo` WHERE planta = '$objeto->planta' $objeto->consulta ORDER BY sp ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function updateHojaT_Cancelada($objeto){//modificar datos para cancelar folio
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET piezas              = '$objeto->piezas',
                            desmontaje          = '$objeto->desarmado',
                            fchRdesarmado       = '$objeto->desarmado',
                            dias_utilizados     = '$objeto->dias_utilizados',
                            totalpz_andamio     = '$objeto->totalpz_andamio',
                            totalpeso_andamio   = '$objeto->totalpeso_andamio',
                            totalrentaD_andamio = '$objeto->totalrentaD_andamio',
                            totalx_diasrenta    = '$objeto->totalx_diasrenta',
                            mano_obra           = '$objeto->mano_obra',
                            total               = '$objeto->total',
                            status              = '$objeto->status',
                            comentario          = '$objeto->comentario',
                            cancelado           = '$objeto->cancelado'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /*Muestra las hojas de trabajo de ese proyecto y cliente*/
    public function consult_HT_RAndamio_ArmadoProyect($objeto)
    {
        $conexion = $this->ConectarBD();
        if ($objeto->RAP == 1) {
          $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE clientes_id = '$objeto->id_cliente' AND status = 'Abierto' AND fchRarmado > '2020-12-31'")or die("Error : ".mysqli_error($conexion));
        }else if ($objeto->RAP == 2) {
          $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE clientes_id = '$objeto->id_cliente' AND n_proyecto = '$objeto->nProyecto' AND status = 'Abierto' AND fchRarmado > '2020-12-31'")or die("Error : ".mysqli_error($conexion));
        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //obtiene datos del id mayor de ese cliente
    public function folioMayor_Cliente($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `hoja_trabajo` WHERE id_hj = ( SELECT MAX(id_hj) AS mayor FROM `hoja_trabajo` WHERE clientes_id = '$objeto->id_cliente')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function updateMostrarFolio($objeto){ //guardar el id del folio del que se hizo el corte por material
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                    SET MostrarFolio  = '$objeto->MostrarFolio'
                    WHERE folio = '$objeto->folio' AND creado = '$objeto->creado' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los folios que se buscan
    public function MostrarFolios_Bloquear($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `hoja_trabajo` WHERE folio IN ($objeto->cadena_Folios)")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los folios que se buscan
    public function MostrarFolios_Bloquear2()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `hoja_trabajo` WHERE camposBloqueados != '1,2,3,4,5' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function UpdateBloqueo($objeto){//modificar camposBloqueados, para solo mostrar los que se pueden modificar en hoja trabajo
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET camposBloqueados = '$objeto->vOpciones'
                        WHERE id_hj = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                    hojas_trabajo (BUSCAR)                       *****
    ***************************************************************************/
    public function BuscarHojaTrabajo($objeto)//busca las hoja de trabajo que concuerde con los datos
    {
        $conexion = $this->ConectarBD();

        if ($objeto->B == '0') {
            $result = mysqli_query($conexion, "SELECT *, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente,
                                              (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario,
                                              (SELECT cargo_cliente.cargo FROM cargo_cliente WHERE cargo_cliente.id_CargoC = ht.cargo) AS cargo,
                                              (SELECT COUNT(*) FROM `hoja_trabajo` ht2 WHERE MostrarFolio IN (ht.folio)) AS CortesxMaterial
                                              FROM hoja_trabajo ht WHERE id_hj = '$objeto->B'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->B == '1') {
            $result = mysqli_query($conexion, "SELECT *, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente,
                                              (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario,
                                              (SELECT cargo_cliente.cargo FROM cargo_cliente WHERE cargo_cliente.id_CargoC = ht.cargo) AS cargo,
                                              (SELECT COUNT(*) FROM `hoja_trabajo` ht2 WHERE MostrarFolio IN (ht.folio)) AS CortesxMaterial
                                              FROM hoja_trabajo ht WHERE fchRarmado BETWEEN '$objeto->inicio' AND '$objeto->fin' ".$objeto->checkbox. "ORDER BY fchRarmado")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->B == '2') {
            $result = mysqli_query($conexion, "SELECT *, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente,
                                              (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario,
                                              (SELECT cargo_cliente.cargo FROM cargo_cliente WHERE cargo_cliente.id_CargoC = ht.cargo) AS cargo,
                                              (SELECT COUNT(*) FROM `hoja_trabajo` ht2 WHERE MostrarFolio IN (ht.folio)) AS CortesxMaterial
                                              FROM hoja_trabajo ht WHERE fchRdesarmado BETWEEN '$objeto->inicio' AND '$objeto->fin' ".$objeto->checkbox. "ORDER BY fchRarmado")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->B == '3') {
            $result = mysqli_query($conexion, "SELECT *, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente,
                                              (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario,
                                              (SELECT cargo_cliente.cargo FROM cargo_cliente WHERE cargo_cliente.id_CargoC = ht.cargo) AS cargo,
                                              (SELECT COUNT(*) FROM `hoja_trabajo` ht2 WHERE MostrarFolio IN (ht.folio)) AS CortesxMaterial
                                              FROM hoja_trabajo ht WHERE (fchRarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') OR (fchRdesarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') ".$objeto->checkbox. "ORDER BY fchRarmado")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->B == '4') {
            $result = mysqli_query($conexion, "SELECT *, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente,
                                              (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario,
                                              (SELECT cargo_cliente.cargo FROM cargo_cliente WHERE cargo_cliente.id_CargoC = ht.cargo) AS cargo,
                                              (SELECT COUNT(*) FROM `hoja_trabajo` ht2 WHERE MostrarFolio IN (ht.folio)) AS CortesxMaterial
                                              FROM hoja_trabajo ht WHERE (fchRarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') AND clientes_id = '$objeto->planta' ".$objeto->checkbox. "ORDER BY fchRarmado")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->B == '5') {
            $result = mysqli_query($conexion, "SELECT *, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente,
                                              (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario,
                                              (SELECT cargo_cliente.cargo FROM cargo_cliente WHERE cargo_cliente.id_CargoC = ht.cargo) AS cargo,
                                              (SELECT COUNT(*) FROM `hoja_trabajo` ht2 WHERE MostrarFolio IN (ht.folio)) AS CortesxMaterial
                                              FROM hoja_trabajo ht WHERE (fchRdesarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') AND clientes_id = '$objeto->planta' ".$objeto->checkbox. "ORDER BY fchRarmado")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->B == '6') {
            $result = mysqli_query($conexion, "SELECT *, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente,
                                              (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario,
                                              (SELECT cargo_cliente.cargo FROM cargo_cliente WHERE cargo_cliente.id_CargoC = ht.cargo) AS cargo,
                                              (SELECT COUNT(*) FROM `hoja_trabajo` ht2 WHERE MostrarFolio IN (ht.folio)) AS CortesxMaterial
                                              FROM hoja_trabajo ht WHERE ((fchRarmado BETWEEN '$objeto->inicio' AND '$objeto->fin') OR (fchRdesarmado BETWEEN '$objeto->inicio' AND '$objeto->fin')) AND clientes_id = '$objeto->planta' ".$objeto->checkbox. "ORDER BY fchRarmado")or die("Error : ".mysqli_error($conexion));
        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function buscarHT($objeto)//busca las hoja de trabajo que concuerde con n_proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE n_proyecto = '$objeto->proyecto_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function cantidadHT($objeto)//cuenta las hoja de trabajo que concuerde con n_proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT COUNT(*) as contador FROM hoja_trabajo WHERE n_proyecto = '$objeto->proyecto_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Buscar_Piezas($objeto)
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

    public function Buscar_Piezas_Año($objeto)
    {
        $aDatosPiezas = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, clientes_id, n_proyecto, cargo, folio, piezas, fchRarmado, fchRdesarmado FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio%' $objeto->cosulta ORDER BY fchRarmado ASC") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);

        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosPiezas[$cont] = array('id_hj' => $data['id_hj'], 'clientes_id' => $data['clientes_id'], 'n_proyecto' => $data['n_proyecto'], 'cargo' => $data['cargo'], 'folio' => $data['folio'], 'piezas' => $data['piezas'], 'fchRarmado' => $data['fchRarmado'], 'fchRdesarmado' => $data['fchRdesarmado']);
          $cont++;
        }
        return $aDatosPiezas;
    }

    //Obtiene algunos datos de todas las HojaTrabajo para reporte de armado/desarmado
    public function Obtener_ArmaDesarma($objeto)
    {
        $aDatosAD = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, (SELECT nombre FROM `clientes` WHERE id_cliente = clientes_id) AS cliente, n_proyecto, folio, (SELECT nombre_userC FROM `user_cliente` WHERE id_userC = userC_id) AS usuario, fchRarmado, fchRdesarmado, tipo_andamio, longitud, ancho, altura, volumen, fac_dificultad, cancelado FROM `hoja_trabajo` WHERE clientes_id = '$objeto->cliente' AND (fchRarmado LIKE '$objeto->fecha' OR fchRdesarmado LIKE '$objeto->fecha') $objeto->consulta")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosAD[$cont] = array('id_hj' => $data['id_hj'], 'cliente' => $data['cliente'], 'n_proyecto' => $data['n_proyecto'], 'folio' => $data['folio'], 'usuario' => $data['usuario'], 'fchRarmado' => $data['fchRarmado'], 'fchRdesarmado' => $data['fchRdesarmado'], 'tipo_andamio' => $data['tipo_andamio'], 'longitud' => $data['longitud'], 'ancho' => $data['ancho'], 'altura' => $data['altura'], 'volumen' => $data['volumen'], 'fac_dificultad' => $data['fac_dificultad'], 'cancelado' => $data['cancelado']);
          $cont++;
        }
        return $aDatosAD;
    }


    /***************************************************************************
    *****                            CARATULAS                             *****
    ***************************************************************************/
    public function consultar_Caratulas()//muestra todas las CARATULAS
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT caratulas.*, clientes.nombre AS cliente FROM caratulas
                                            INNER JOIN clientes ON caratulas.cliente_id = clientes.id_cliente
                                            ORDER BY id_cara DESC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Buscar_Caratula($objeto)//muestra los datos de la CARATULA
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM caratulas WHERE id_cara = '$objeto->id_CR' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function insertar_Caratula($objeto)//inserta datos en caratula
    {
        $conexion = $this->ConectarBD();

        if($objeto->FchaTermino == ''){
            $result = mysqli_query($conexion, "INSERT INTO caratulas (FchaInicio, FchaTermino, cliente_id, Actividad, UpdateActividad, cargo, Pedido, MontoTotal, MontoPrcial, Corte_Parcial, Opcion, Folios, PrefijoFolio, Referencia, observacion, CreadoPor)
                                            VALUES ('$objeto->FchaInicio',
                                                    NULL,
                                                    '$objeto->cliente_id',
                                                    '$objeto->Actividad',
                                                    '$objeto->UpdateActividad',
                                                    '$objeto->id_cargo',
                                                    '$objeto->Pedido',
                                                    '$objeto->MontoTotal',
                                                    '$objeto->MontoParcial',
                                                    '$objeto->Corte_Parcial',
                                                    '$objeto->opcion',
                                                    '$objeto->Folios',
                                                    '$objeto->PrefijoFolio',
                                                    '$objeto->Referencia',
                                                    '$objeto->observacion',
                                                    '$objeto->CreadoPor')")or die("Error : ".mysqli_error($conexion));
        }else{
            $result = mysqli_query($conexion, "INSERT INTO caratulas (FchaInicio, FchaTermino, cliente_id, Actividad, UpdateActividad, cargo, Pedido, MontoTotal, MontoPrcial, Corte_Parcial, Opcion, Folios, PrefijoFolio, Referencia, observacion, CreadoPor)
                                            VALUES ('$objeto->FchaInicio',
                                                    '$objeto->FchaTermino',
                                                    '$objeto->cliente_id',
                                                    '$objeto->Actividad',
                                                    '$objeto->UpdateActividad',
                                                    '$objeto->id_cargo',
                                                    '$objeto->Pedido',
                                                    '$objeto->MontoTotal',
                                                    '$objeto->MontoParcial',
                                                    '$objeto->Corte_Parcial',
                                                    '$objeto->opcion',
                                                    '$objeto->Folios',
                                                    '$objeto->PrefijoFolio',
                                                    '$objeto->Referencia',
                                                    '$objeto->observacion',
                                                    '$objeto->CreadoPor')")or die("Error : ".mysqli_error($conexion));
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_FchEntrega($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE caratulas
                        SET FhcEntrega = '$objeto->FhcEntrega'
                        WHERE id_cara  = '$objeto->id' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_HojaEntrega($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE caratulas
                        SET hoja_Entrada_fk = '$objeto->hoja'
                        WHERE id_cara  = '$objeto->id' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_HTrabajoFacturado($objeto){
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET nFactura       = '$objeto->nFactura',
                            TotalFacturado = '$objeto->TFacturado',
                            Deben          = '$objeto->Deben',
                            statusVenta    = '$objeto->StatusV',
                            DescuentoFacturado = '$objeto->DesFacturado'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_HTrabajoPagado($objeto){
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET TotalPagado   = '$objeto->TotalPagado',
                            FaltaPorPagar = '$objeto->FaltaPorPagar'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Update_NFactura_Folio($objeto){
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE hoja_trabajo
                        SET nFactura = '$objeto->nFactura'
                        WHERE id_hj  = '$objeto->id_HT' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarCaratula($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT PC.*, C.comentario, (SELECT nFactura FROM hoja_trabajo WHERE id_hj = PC.HT_id) AS nFacturas FROM `pagos_caratula` PC INNER JOIN `caratulas` C ON PC.Caratula_id = C.id_cara WHERE Caratula_id = '$objeto->Caratula_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Insert_DatosFactura($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO pagos_caratula (debe, facturado, n_Factura, Fch_Factura, HT_id, Caratula_id, CreadoPor)
                                                VALUES ('$objeto->debe',
                                                        '$objeto->facturado',
                                                        '$objeto->nFactura',
                                                        '$objeto->FchFactura',
                                                        '$objeto->id_HT',
                                                        '$objeto->Caratula_id',
                                                        '$objeto->creado')")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_FechaFactura($objeto){
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE `pagos_caratula`
                          SET Fch_Factura = '$objeto->FchFactura'
                          WHERE Caratula_id = '$objeto->Caratula_id'")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Update_NFactura_Pago($objeto){
        $conexion = $this->ConectarBD();
            $result = mysqli_query($conexion, "UPDATE `pagos_caratula`
                          SET n_Factura   = '$objeto->nFactura',
                              Fch_Factura = '$objeto->Fch_Factura'
                          WHERE id_pago = '$objeto->id_pago'")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function ObtenerPagos_Caratula($objeto)
    {
        $aDatosCara = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_pago, debe, facturado, n_Factura, HT_id FROM `pagos_caratula` WHERE Caratula_id = '$objeto->Caratula_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);

        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosCara[$data['HT_id']] = array('debe' => $data['debe'], 'facturado' => $data['facturado'], 'n_Factura' => $data['n_Factura'], 'id_pago' => $data['id_pago']);
          $cont++;
        }
        return $aDatosCara;
    }

    public function ObtenerNFactura($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT n_Factura, Fch_Factura FROM `pagos_caratula` WHERE Caratula_id = '$objeto->Caratula_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Folios_Facturados($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT pg.*, c.cliente_id, c.pedido, c.Corte_Parcial, c.Opcion, c.Folios FROM `pagos_caratula` pg INNER JOIN caratulas c ON c.id_cara = pg.Caratula_id
          WHERE cliente_id = '$objeto->cliente_id' AND (Fch_Factura LIKE '$objeto->Fecha%') ORDER BY n_Factura, Caratula_id") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Insert_DatosPagos($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO HistorialPagos_caratula (FaltaPagar, Pagado, nFactura, HT_id, Caratula_id, CreadoPor)
                                                VALUES ('$objeto->faltapagar',
                                                        '$objeto->pagado',
                                                        '$objeto->nFactura',
                                                        '$objeto->id_HT',
                                                        '$objeto->Caratula_id',
                                                        '$objeto->creado')")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_Datos($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE caratulas SET $objeto->consulta
                                           WHERE id_cara  = '$objeto->id_cara' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_DatosUser($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE updatecaratulap SET $objeto->consulta
                                           WHERE cara_id = '$objeto->id_cara' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /*Para mostrar el tipo de caratula en el pdf*/
    public function MostrarCargosAceptados()
    {   $aDato = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT id_CargoC, cargo,cliente FROM `cargo_cliente` WHERE (cliente = 'INSA' OR cliente = 'Dynasol' OR cliente = 'INSA Paro') AND (cargo LIKE 'Producción%' OR cargo LIKE 'Mantenimiento%' OR cargo LIKE 'Proyecto%')") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        while ($data = mysqli_fetch_array($result)) {
          $aDato[$data['id_CargoC']] = array('cargo' => $data['cargo'], 'cliente' => $data['cliente']);
        }
        return $aDato;
    }

    public function Datos_Caratula2($objeto)//muestra los datos de la CARATULA
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `caratulas` LEFT JOIN `updatecaratulap` ON caratulas.id_cara = updatecaratulap.cara_id WHERE caratulas.id_cara = '$objeto->id_CR' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function UpdateCaratula2($objeto)//muestra los datos
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `updatecaratulap` WHERE cara_id = '$objeto->id_cara' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Update_DatosCara2($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE updatecaratulap
                                          SET contratista    = '$objeto->contratista',
                                              Trb_Contratado = '$objeto->TrbContratado',
                                              fch_Contrato   = '$objeto->FchContrato',
                                              concepto       = '$objeto->concepto',
                                              cuentaCargo    = '$objeto->cuentaCargo',
                                              No_SIC         = '$objeto->No_SIC',
                                              fch_Servicio   = '$objeto->fch_Servicio',
                                              modificado     = '$objeto->modificado'
                                           WHERE cara_id  = '$objeto->id_cara' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Insert_DatosCara2($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO updatecaratulap (concepto, Trb_Contratado, fch_Contrato, contratista, cuentaCargo, No_SIC, fch_Servicio, cara_id, modificado)
                                         VALUES ('$objeto->concepto',
                                                 '$objeto->TrbContratado',
                                                 '$objeto->FchContrato',
                                                 '$objeto->contratista',
                                                 '$objeto->cuentaCargo',
                                                 '$objeto->No_SIC',
                                                 '$objeto->fch_Servicio',
                                                 '$objeto->id_cara',
                                                 '$objeto->modificado')")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Delete_Caratula($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "DELETE FROM caratulas WHERE id_cara = '$objeto->id_CR'") or die("Error al Eliminar Registro".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
    }

    public function ExisteFolio_Caratula($objeto)//muestra las caratukas donde aparece el folio
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM caratulas  WHERE cliente_id = '$objeto->cliente_id' AND Folios LIKE '%$objeto->folio%' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function HojaTrabajo_porFacturar($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `hoja_trabajo` WHERE clientes_id = '$objeto->cliente_id' AND fchRarmado LIKE '$objeto->Fecha%' AND statusVenta != 'Facturado' UNION ALL SELECT * FROM `hoja_trabajo` WHERE clientes_id = '$objeto->cliente_id' AND fchRarmado LIKE '$objeto->Fecha%' AND statusVenta = 'Facturado' AND Deben > '1.00' ORDER BY fchRarmado ASC") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_ComentarioCaratula($objeto){//modificar comentario de esa caratula
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE caratulas
                        SET comentario = '$objeto->comentario'
                        WHERE id_cara  = '$objeto->id_cara' ")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function updateDebePago($objeto){ //modificar el debe del pagoCaratula
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE `pagos_caratula`
                                           SET debe = '$objeto->debe'
                                           WHERE id_pago  = '$objeto->id_Pago' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Mostrar_Caratula_Agregada($objeto)//muestra la caratula que coincida con el filtro
    {  ///en ves de like es = , se cambio porque no estaba agarando con los decimales mayores a 0
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM caratulas  WHERE cliente_id = '$objeto->cliente_id' AND CreadoPor = $objeto->CreadoPor AND MontoTotal = '$objeto->MontoTotal' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Insert_CostosPrefacturas($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO costos_prefacturas (costo_andamio, mano_obra_SA , mano_obra_SD, Descuento, HT_ID, Caratula_ID, CreadoPor)
                                         VALUES ('$objeto->costo_andamio',
                                                 '$objeto->mano_obra_SA',
                                                 '$objeto->mano_obra_SD',
                                                 '$objeto->Descuento',
                                                 '$objeto->HT_ID',
                                                 '$objeto->Caratula_ID',
                                                 '$objeto->CreadoPor')")or die("Error : ".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mDatos_caratula($objeto)//muestra los datos
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM caratulas WHERE cliente_id = '$objeto->cliente_id' and Folios LIKE '%$objeto->folionum%' $objeto->nProyecto ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Facturado_Prefactura($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT PC.*, CP.*, (SELECT C.Opcion FROM pagos_caratula PC2 INNER JOIN caratulas C ON PC2.Caratula_id = C.id_cara WHERE PC2.HT_id = PC.HT_id AND PC.Caratula_id = C.id_cara) AS Opcion FROM `pagos_caratula` PC LEFT JOIN `costos_prefacturas` CP ON (PC.HT_id = CP.HT_ID AND PC.Caratula_id = CP.Caratula_ID) WHERE PC.HT_id = '$objeto->HT_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Facturado_Caratula($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT PC.*,C.Opcion FROM pagos_caratula PC INNER JOIN caratulas C ON PC.Caratula_id = C.id_cara WHERE PC.HT_id = '$objeto->HT_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    *****                    REPORTES CARATULAS                            *****
    ***************************************************************************/
    public function aDatosReporte1($objeto)
    {
        $aDatosR1 = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, clientes_id, userC_id, folio, fchRarmado, fchRdesarmado, totalx_diasrenta, mano_obra, total, ordenCompra, nFactura, Deben, TotalFacturado, TotalPagado, FaltaPorPagar, statusVenta, sp, equipo, area, supervisor,hoja_Entrada, n_proyecto FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio%' AND clientes_id = '$objeto->clientes_id' $objeto->option  AND status = 'Cerrado' ORDER BY statusVenta DESC") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);

        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosR1[$cont] = array('id_hj' => $data['id_hj'], 'clientes_id' => $data['clientes_id'], 'userC_id' => $data['userC_id'], 'folio' => $data['folio'], 'fchRarmado' => $data['fchRarmado'], 'fchRdesarmado' => $data['fchRdesarmado'], 'totalx_diasrenta' => $data['totalx_diasrenta'], 'mano_obra' => $data['mano_obra'], 'total' => $data['total'], 'ordenCompra' => $data['ordenCompra'], 'nFactura' => $data['nFactura'], 'Deben' => $data['Deben'], 'TotalFacturado' => $data['TotalFacturado'], 'TotalPagado' => $data['TotalPagado'],'FaltaPorPagar' => $data['FaltaPorPagar'], 'statusVenta' => $data['statusVenta'], 'sp' => $data['sp'], 'equipo' => $data['equipo'], 'area' => $data['area'], 'supervisor' => $data['supervisor'], 'hoja_Entrada' => $data['hoja_Entrada'], 'n_proyecto' => $data['n_proyecto']);
          $cont++;
        }
        return $aDatosR1;
    }

    /*Para obtener el total por mes*/
    public function aDatosReporte1_TotalesMes($objeto)
    {
        $aDatosTotal = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
          "SELECT SUM(total) AS 'Costo' FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-01-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-02-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-03-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-04-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-05-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-06-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-07-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-08-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-09-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-10-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-11-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id'  AND status = 'Cerrado' UNION ALL
           SELECT SUM(total) FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio-12-%' AND clientes_id = '$objeto->clientes_id' AND userC_id = '$objeto->userC_id' AND status = 'Cerrado'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);

        $cont = 1;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosTotal[$cont] = array('costo' => $data['Costo']);
          $cont++;
        }
        return $aDatosTotal;
    }

    /***************************************************************************
    ******                         costos_prefacturas                      *****
    ***************************************************************************/
    public function Delete_Costo_Prefactura($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "DELETE FROM costos_prefacturas WHERE Caratula_ID = '$objeto->id_CR'") or die("Error al Eliminar Registro".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                              GASTOS                             *****
    ***************************************************************************/
    public function buscarGastos($objeto)//busca los gastos de ese proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM gastos WHERE proyecto_id = '$objeto->proyecto_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function obtenerDatosG($objeto)//busca datos de ese gasto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM gastos WHERE id_gastos = '$objeto->gastos_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function insertar_Gasto($objeto)//inserta datos en gastos
    {
        $conexion = $this->ConectarBD();
        if($objeto->proyecto_id  == ''){
            $result = mysqli_query($conexion, "INSERT INTO gastos (fchaEntrega, categoria_id, descripcion_id, especificacion, cantidad, precioUnitario,  precioTotal, proyecto_id, creado)
                                                VALUES ('$objeto->fecha',
                                                        '$objeto->Categoria',
                                                        '$objeto->descripcion_id',
                                                        '". mysqli_escape_string($conexion,$objeto->especificacion). "',
                                                        '$objeto->cantidad',
                                                        '$objeto->precioUnitario',
                                                        '$objeto->precioTotal',
                                                        NULL,
                                                        '$objeto->creado')")or die("Error : ".mysqli_error($conexion));
        }else{
            $result = mysqli_query($conexion, "INSERT INTO gastos (fchaEntrega, categoria_id, descripcion_id, especificacion, cantidad, precioUnitario,  precioTotal, proyecto_id, creado)
                                                VALUES ('$objeto->fecha',
                                                        '$objeto->Categoria',
                                                        '$objeto->descripcion_id',
                                                        '". mysqli_escape_string($conexion,$objeto->especificacion). "',
                                                        '$objeto->cantidad',
                                                        '$objeto->precioUnitario',
                                                        '$objeto->precioTotal',
                                                        '$objeto->proyecto_id',
                                                        '$objeto->creado')")or die("Error : ".mysqli_error($conexion));
        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificar_Gasto($objeto)//inserta datos en gastos
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE gastos SET fchaEntrega    = '$objeto->fecha',
                                                             categoria_id   = '$objeto->Categoria',
                                                             descripcion_id = '$objeto->descripcion_id',
                                                             especificacion = '". mysqli_escape_string($conexion,$objeto->especificacion). "',
                                                             cantidad       = '$objeto->cantidad',
                                                             precioUnitario = '$objeto->precioUnitario',
                                                             precioTotal    = '$objeto->precioTotal',
                                                             modificado     = '$objeto->modificado'
                                                         WHERE id_gastos    = '$objeto->gastos_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Cantidad_GastosP($objeto)//total de gastos
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(precioTotal) AS G_TOTAL FROM `gastos` WHERE fchaEntrega LIKE '%$objeto->mes%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function totalGastosP($objeto)//total de gastos por proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(precioTotal) AS TOTAL FROM gastos WHERE proyecto_id = '$objeto->proyecto_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function gastoExiste($objeto)//total de gastos por proyecto
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_gastos,creado FROM `gastos` WHERE creado = '$objeto->creado'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Obtener_gasto_recepcion($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT g.id_gastos, r.id AS id_Recepcion FROM `gastos` g INNER JOIN `recepcion_compra` r ON g.creado = r.creado WHERE g.creado = '$objeto->creado'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                         USUARIOS_ CLIENTE                       *****
    ***************************************************************************/
    public function buscarUserC($objeto)//busca los usuarios de ese cliente
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM user_cliente WHERE cliente = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function MostarUserC($objeto)//muestra los datos del usuario
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM user_cliente WHERE id_userC = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function ExisteUserC($objeto)//muestra los datos del usuario
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM user_cliente WHERE nombre_userC = '$objeto->nombreUser' AND cliente = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function InsertarUserC($objeto)//inserta datos en usuario
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO user_cliente (nombre_userC, cliente, creado)
                                                VALUES ('$objeto->nombreUser',
                                                        '$objeto->cliente',
                                                        '$objeto->creado')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificarUserC($objeto)//modifica datos en usuario
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE user_cliente SET nombre_userC = '$objeto->nombreUser',
                                                                   cliente      = '$objeto->cliente',
                                                                   modificado   = '$objeto->modificado'
                                                             WHERE id_userC     = '$objeto->id_user'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultUserCliente($objeto)//muestra los usuario-cliente, sin repetir ninguno
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `user_cliente` WHERE piezas > -1 AND cliente = '$objeto->cliente' GROUP BY nombre_userC, cliente ORDER BY piezas DESC, id_userC ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modUserC_Pz($objeto)//modifica total de piezas de es usuario
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE user_cliente SET piezas = '$objeto->SumaT'
                                                             WHERE id_userC     = '$objeto->id_user'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function cantidad_usuariosC($objeto)//muestra cantidad de usuarios que hay
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT COUNT(*) AS cant FROM `user_cliente` WHERE cliente = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrar_usuariosC($objeto)//muestra los usuarios de ese cliente
    {
        $aDatosUserC = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_userC, nombre_userC FROM `user_cliente` WHERE cliente = (SELECT nombre FROM `clientes` WHERE id_cliente = '$objeto->cliente') ORDER BY nombre_userC ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosUserC[$cont] = array('id_userC' => $data['id_userC'], 'nombre_userC' => $data['nombre_userC']);
          $cont++;
        }
        return $aDatosUserC;
    }

    public function mostrar_usersC($objeto)//muestra los usuarios que tenga hojas de trabajo
    {
        $aUserC = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT HT.userC_id, UC.nombre_userC FROM `hoja_trabajo` HT INNER JOIN `user_cliente` UC ON HT.userC_id = UC.id_userC WHERE fchRarmado LIKE '$objeto->anio%' AND clientes_id = '$objeto->cliente' AND status = 'Cerrado' ORDER BY UC.nombre_userC ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        $cont = 0;
        while ($data = mysqli_fetch_array($result)) {
          $aUserC[$cont] = array('id_userC' => $data['userC_id'], 'nombre_userC' => $data['nombre_userC']);
          $cont++;
        }
        return $aUserC;
    }

    /***************************************************************************
    ******                             CARGOS_ CLIENTE                     *****
    ***************************************************************************/
    public function buscarCargoC($objeto)//busca los cargo de ese cliente
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM cargo_cliente WHERE cliente = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function MostarCargoC($objeto)//muestra los datos del cargo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM cargo_cliente WHERE id_CargoC = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function InsertarCargoC($objeto)//inserta datos en cargo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO cargo_cliente (cargo, cliente, creado)
                                                VALUES ('$objeto->nombreCargo',
                                                        '$objeto->cliente',
                                                        '$objeto->creado')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificarCargoC($objeto)//modifica datos en cargo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE cargo_cliente SET cargo = '$objeto->nombreCargo',
                                                                   cliente      = '$objeto->cliente',
                                                                   modificado   = '$objeto->modificado'
                                                             WHERE id_CargoC     = '$objeto->id_Cargo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function cargosCliente2($objeto)//obtiene los cargos de ese id_cliente
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM cargo_cliente WHERE cliente = (SELECT nombre FROM `clientes` WHERE id_cliente = '$objeto->id_cliente')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                         CORREOS_ CLIENTE                        *****
    ***************************************************************************/
    public function buscarCorreoC($objeto)//busca los correo de ese cliente
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM correos_planta WHERE planta_id = '$objeto->cliente'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function MostarCorreoC($objeto)//muestra los datos del correo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM correos_planta WHERE id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function InsertarCorreoC($objeto)//inserta datos en correo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO correos_planta (planta_id, correo, creado)
                                                VALUES ('$objeto->cliente',
                                                        '$objeto->correo',
                                                        '$objeto->creado')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function modificarCorreoC($objeto)//modifica datos en correo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE correos_planta SET correo     = '$objeto->correo',
                                                                     modificado = '$objeto->modificado'
                                                               WHERE id         = '$objeto->id_Correo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******              _________COTIZACIONES___________                   *****
    ***************************************************************************/
    //Muestra todas las Propuestas
    public function MuestraPropuestas()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT C.razonsocial, P.tipoTrabajo, P.nPropuesta, P.id_propuesta, P.areaTrabajo,
                                                  P.costo, P.condicionPago, V.nombre, P.fecha, P.autorP
                                           FROM propuesta P
                                           INNER JOIN clientes C
                                           ON C.id_cliente=P.clienteId
                                           INNER JOIN andamieros V
                                           ON V.id=P.vendedorId
                                           WHERE (C.id_cliente=P.clienteId AND
                                                  V.id=P.vendedorId)
                                           ORDER BY nPropuesta ASC")
                                           or die("Error en la consulta".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra el id del cliente
    public function ObtenerCPropuestas($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT c.id_cliente
                                           FROM clientes c
                                           INNER JOIN (SELECT cliente
                                                       FROM manoobra
                                                       WHERE id = '$objeto->proyecto_id'
                                                       UNION(SELECT cliente
                                                             FROM preciofijo
                                                             WHERE id = '$objeto->proyecto_id' )
                                                       UNION(SELECT cliente
                                                             FROM materialmanoobra
                                                             WHERE id = '$objeto->proyecto_id' )) p
                                           ON c.nombre = p.cliente")
                                           or die("Error en la consulta".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra todas las Propuestas del mismo cliente
    public function MuestraPropuestasCliente($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT C.razonsocial, P.tipoTrabajo, P.nPropuesta, P.id_propuesta,
                                                  P.costo, P.condicionPago, V.nombre, P.fecha
                                           FROM propuesta P
                                           INNER JOIN clientes C
                                           ON C.id_cliente=P.clienteId
                                           INNER JOIN andamieros V
                                           ON V.id=P.vendedorId
                                           WHERE (C.id_cliente='$objeto->cliente_id' AND
                                                  V.id=P.vendedorId)
                                           ORDER BY nPropuesta ASC")
                                           or die("Error en la consulta".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }


    public function ConsultaPropuesta($nPropuesta)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT nPropuesta FROM propuesta WHERE nPropuesta = '$nPropuesta'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarFolioPropuesta($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT nPropuesta, clase_proyecto, areaTrabajo FROM propuesta WHERE id_propuesta = '$objeto->id_propuesta'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarCliente($cliente)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT razonsocial FROM clientes ORDER BY razonsocial") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarDatosCliente($cliente)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM clientes WHERE razonsocial='$cliente'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //obtener el folio mayor de ese cliente para numero de propuesta
    public function folioMayor_Propuesta($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(CAST((REPLACE(nPropuesta,'$objeto->prefijo','')) AS UNSIGNED)) as folio FROM propuesta WHERE clienteId  = '$objeto->clienteID'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function ConsultaVendedor($vendedor)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id,tel_cel,correo FROM andamieros WHERE nombre = '$vendedor'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarVendedor($vendedor)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM andamieros WHERE ocupacion = 'Ventas' OR ocupacion = 'Aux. Ventas' ORDER BY id") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //_________por servicio
    public function consultMontoServicioINSA($alturaMax)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT monto FROM costosinsa WHERE alturaMax='$alturaMax'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consultMontoServicioCABOT($alturaMax)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT monto FROM costoscabot WHERE alturaMax='$alturaMax'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function MuestraAlturaINSA()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT alturaMax FROM costosinsa") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function AlturaMaxINSA($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(alturaMax)alturaMax FROM costosinsa") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function MuestraAlturaCABOT()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT alturaMax FROM costoscabot") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function AlturaMaxCABOT($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(alturaMax)alturaMax FROM costoscabot") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //_________
    public function MuestraPartidas($id_propuesta)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM partidas WHERE propuestaId = '$id_propuesta'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function sumaMonto($id_propuesta)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT Sum(monto)monto FROM partidas WHERE propuestaId = '$id_propuesta' AND status='activo' ") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra la ultima propuesta de ese usuario
    public function ultimaPropuesta_Usuario($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `propuesta` WHERE autorP = '$objeto->autor' ORDER BY id_propuesta DESC LIMIT 1 ") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function InsertDatosGPropuesta($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO propuesta(nPropuesta, tipoTrabajo, clase_proyecto, condicionPago, lugarTrabajo, areaTrabajo, areaExpecifica, fecha, costo, clienteId, vendedorId, autorP)
            VALUES ('$objeto->nPropuesta',
                    '$objeto->tipoTrabajo',
                    '$objeto->clase',
                    '$objeto->condPago',
                    '$objeto->lugarTrab',
                    '$objeto->areaTrab',
                    '$objeto->areaExpe',
                    '$objeto->fecha',
                    '$objeto->costo',
                    '$objeto->nCliente',
                    '$objeto->idVendedor',
                    '$objeto->autor')")
            or die("Error en la insercion".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function InsertDatosPartida($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO partidas(cantidad, unidadMedida, descripcion, datos, pu, monto, status, propuestaId, creado)
            VALUES ('$objeto->cantidad',
                    '$objeto->unidadM',
                    '$objeto->descripcion',
                    '$objeto->datos',
                    '$objeto->pu',
                    '$objeto->monto',
                    '$objeto->status',
                    '$objeto->propuestaId',
                    '$objeto->creado')")
            or die("Error en la insercion".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
    }

    public function ActualizaStatusProp($idPartidas, $status)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE partidas SET status  = '$status'
                                               WHERE idPartidas = '$idPartidas'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function EliminaStatusProp($idPartidas)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "DELETE FROM partidas WHERE idPartidas = '$idPartidas'") or die("Error al Eliminar Registro".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
    }

    public function ModificaCostoProp($id_propuesta, $costoSubTotal)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE propuesta SET costo  = '$costoSubTotal'
                                               WHERE id_propuesta = '$id_propuesta'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function ConsulClient($nProp){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT C.razonsocial
                                           FROM clientes C
                                           INNER JOIN propuesta P
                                           ON C.id_cliente=P.clienteId
                                           WHERE (id_propuesta='$nProp' ) ")
                                           or die("Error en la consulta".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function obtenerDescrip($codigo,$prenta)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT descripcion, $prenta, peso FROM precios_pieza WHERE codigo = '$codigo'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra solo las partidas activas al momento de crear el pdf
    public function PartidasenPDF($id_propuesta)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM partidas WHERE propuestaId = '$id_propuesta' AND status = 'activo'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarPartida($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM partidas WHERE idPartidas = '$objeto->idPartidas'") or die("Error en la consulta");
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                         solicitud de personal                   *****
    ***************************************************************************/
    //Consulta compras
    public function Buscar_solicitudPersonal()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM solicitud_personal")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar compra
    public function Insert_solicitudPersonal($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO solicitud_personal(planta, ordenCliente, solicitante, departamento, area, equipo, compañia, Tipo, supervisorSGD, andamiero, supervisorOBR, ayudante, observacion, fechaSolicitud, creado)
            VALUES ('$objeto->planta',
                    '$objeto->ordenCliente',
                    '$objeto->solicitante',
                    '$objeto->departamento',
                    '$objeto->area',
                    '$objeto->equipo',
                    '$objeto->compañia',
                    '$objeto->TipoSolicitud',
                    '$objeto->supervisorSGD',
                    '$objeto->andamiero',
                    '$objeto->supervisorOBR',
                    '$objeto->ayudante',
                    '$objeto->observacion',
                    '$objeto->fechaSolicitud',
                    '$objeto->creado')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta
    public function consult_solicitudPersonal($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM solicitud_personal WHERE id_solicitud = '$objeto->id_solicitud'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Update_solicitudPersonal($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE solicitud_personal SET ordenCliente   = '$objeto->ordenCliente',
                                                                             solicitante    = '$objeto->solicitante',
                                                                             departamento   = '$objeto->departamento',
                                                                             area           = '$objeto->area',
                                                                             equipo         = '$objeto->equipo',
                                                                             compañia       = '$objeto->compañia',
                                                                             Tipo           = '$objeto->TipoSolicitud',
                                                                             supervisorSGD  = '$objeto->supervisorSGD',
                                                                             andamiero      = '$objeto->andamiero',
                                                                             supervisorOBR  = '$objeto->supervisorOBR',
                                                                             ayudante       = '$objeto->ayudante',
                                                                             observacion    = '$objeto->observacion',
                                                                             fechaSolicitud = '$objeto->fechaSolicitud',
                                                                             modificado    = '$objeto->modificado'
                                               WHERE id_solicitud = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function Update_Status_solicitudP($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE solicitud_personal SET status         = '$objeto->status',
                                                                             modificado     = '$objeto->modificado'
                                               WHERE id_solicitud = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function mostrar_solicitudPersonal($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(id_solicitud) AS id FROM `solicitud_personal` WHERE CONCAT(creado) LIKE '%$objeto->fcha% %$objeto->user%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Update_VistoSPersonal($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE solicitud_personal SET visto       = '$objeto->visto',
                                                                             visto_por   = '$objeto->visto_por',
                                                                             status      = '$objeto->status'
                                               WHERE id_solicitud = '$objeto->id_solicitud'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                        solicitud de andamio                     *****
    ***************************************************************************/
    //Consulta
    public function Buscar_solicitudAndamio()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM solicitud_andamio")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar
    public function Insert_solicitudAndamio($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO solicitud_andamio(planta, ordenCliente, solicitante, departamento, fechaArmado, area, longitud, ancho, altura, equipo, fechaDesarmado, compañia, Tipo, TActividad, observacion, creado)
            VALUES ('$objeto->planta',
                    '$objeto->ordenCliente',
                    '$objeto->solicitante',
                    '$objeto->departamento',
                    '$objeto->fechaArmado',
                    '$objeto->area',
                    '$objeto->longitud',
                    '$objeto->ancho',
                    '$objeto->altura',
                    '$objeto->equipo',
                    '$objeto->fechaDesarmado',
                    '$objeto->compañia',
                    '$objeto->TipoSolicitud',
                    '$objeto->TActividad',
                    '$objeto->observacion',
                    '$objeto->creado')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta
    public function consult_solicitudAndamio($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM solicitud_andamio WHERE id_andamio = '$objeto->id_andamio'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Update_solicitudAndamio($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE solicitud_andamio SET ordenCliente  = '$objeto->ordenCliente',
                                                                             solicitante   = '$objeto->solicitante',
                                                                             departamento  = '$objeto->departamento',
                                                                             fechaArmado   = '$objeto->fechaArmado',
                                                                             area          = '$objeto->area',
                                                                             longitud      = '$objeto->longitud',
                                                                             ancho         = '$objeto->ancho',
                                                                             altura        = '$objeto->altura',
                                                                             equipo        = '$objeto->equipo',
                                                                             fechaDesarmado= '$objeto->fechaDesarmado',
                                                                             compañia      = '$objeto->compañia',
                                                                             Tipo          = '$objeto->TipoSolicitud',
                                                                             TActividad    = '$objeto->TActividad',
                                                                             observacion   = '$objeto->observacion',
                                                                             modificado    = '$objeto->modificado'
                                               WHERE id_andamio = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function Update_Status_solicitudA($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE solicitud_andamio SET status         = '$objeto->status',
                                                                            modificado     = '$objeto->modificado'
                                               WHERE id_andamio = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function mostrar_solicitudAndamio($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(id_andamio) AS id FROM `solicitud_andamio` WHERE CONCAT(creado) LIKE '%$objeto->fcha% %$objeto->user%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Update_VistoSAndamio($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE solicitud_andamio SET visto       = '$objeto->visto',
                                                                             visto_por   = '$objeto->visto_por',
                                                                             status      = '$objeto->status'
                                               WHERE id_andamio = '$objeto->id_andamio'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

     /**************************************************************************
    ******                               COMPRAS                           *****
    ***************************************************************************/
    //Consulta compras
    public function Buscar_Compras()/*===*/
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM compras ORDER BY id_compra DESC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta compras dependiendo del  id
    public function Consultar_Compras($objeto)/*===*/
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM compras WHERE id_compra = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta compras dependiendo de la descripcion
    public function Datos_Compras($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM compras WHERE Descripcion_id = '$objeto->descripcion_id' AND Sobra > 0")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar valor de sobra en compra
    public function actualizar_compraSobra($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE compras SET sobra  = '$objeto->sobra'
                                               WHERE id_compra = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //Consulta compras dependiendo de la descripcion
    public function existe_Compras($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM compras WHERE FchaCompra     = '$objeto->FchaCompra'
                                                                  AND  Descripcion_id = '$objeto->descripcion'
                                                                  AND  PrecioCompra   = '$objeto->precioCompra'
                                                                  AND  Provedor_id    = '$objeto->provedor_id'
                                                                  AND  Facturado      = '$objeto->facturado'
                                                                  ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra la compra que concuerde con los datos
    public function existe_Compra($objeto)/*===*/
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE Requisicion_id = '$objeto->idReq'
                                                                    AND Provedor_id     = '$objeto->provedor_id'
                                                                    AND OrdenCompra_id  = '$objeto->OrdenCompra_id'
                                                                    AND Creado          = '$objeto->creado'
                                                                  ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    //insertar compra
    public function Insert_Compra($objeto)/*===*/
    { //Iva,  '$objeto->iva',
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO compras(FchaCompra, Semana, Costo, MetodoPago_id, FormaPago_id, Facturado, DatosBancario_id, Requisicion_id, Provedor_id, OrdenCompra_id, Creado)
            VALUES ('$objeto->FchaCompra',
                    '$objeto->semana',
                    '$objeto->costo',
                    '$objeto->metodoPago',
                    '$objeto->formaPago',
                    '$objeto->facturado',
                    '$objeto->DatosBancario_id',
                    '$objeto->idReq',
                    '$objeto->provedor_id',
                    '$objeto->OrdenCompra_id',
                    '$objeto->creado')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }
    //modificar compra
    public function Mod_Compra($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE compras SET FchaCompra     = '$objeto->FchaCompra',
                                                                  Semana         = '$objeto->semana',
                                                                  Cantidad       = '$objeto->cantidad',
                                                                  Sobra          = '$objeto->Sobra',
                                                                  Facturado      = '$objeto->facturado',
                                                                  Provedor_id    = '$objeto->provedor_id',
                                                                  Modificado     = '$objeto->modificado'
                                               WHERE id_compra = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //Consulta compras dependiendo de la fila
    public function Compras($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM compras WHERE ".mysqli_escape_string($conexion,$objeto->fila)." = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta precios de compras
    public function precios_Compras($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT *,SUM(Cantidad) AS Cantidad FROM compras WHERE Descripcion_id  = '$objeto->id' GROUP BY PrecioCompra")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function totalCompra()//total de compra
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(PrecioCompra * Cantidad) AS TOTAL FROM compras")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra compras dependiendo de la orden de compra
    public function Compras_OrdenesC($objeto)/*===*/
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE OrdenCompra_id = '$objeto->id_ordenesC'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Cantidad_Compra($objeto)//muestra el costo de las compras de ese mes
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(Costo) AS TOTAL FROM `compras` WHERE FchaCompra LIKE '%$objeto->mes%'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                          REPORTES COMPRAS                       *****
    ***************************************************************************/
    public function filtroCompra($objeto)//muestra los datos del filtro
    {
        $conexion = $this->ConectarBD();
        if ($objeto->c == '1') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras`")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '2') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE MetodoPago_id = '$objeto->metodoPago'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '3') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE MetodoPago_id = '$objeto->metodoPago' AND FormaPago_id = '$objeto->formaPago'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '4') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE MetodoPago_id = '$objeto->metodoPago' AND Provedor_id = '$objeto->proveedor'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '5') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE MetodoPago_id = '$objeto->metodoPago' AND (FchaCompra BETWEEN '$objeto->inicial' AND '$objeto->final')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '6') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE MetodoPago_id = '$objeto->metodoPago' AND FormaPago_id = '$objeto->formaPago' AND Provedor_id = '$objeto->proveedor'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '7') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE MetodoPago_id = '$objeto->metodoPago' AND FormaPago_id = '$objeto->formaPago' AND (FchaCompra BETWEEN '$objeto->inicial' AND '$objeto->final')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '8') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE MetodoPago_id = '$objeto->metodoPago' AND Provedor_id = '$objeto->proveedor' AND (FchaCompra BETWEEN '$objeto->inicial' AND '$objeto->final')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '9') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE MetodoPago_id = '$objeto->metodoPago' AND FormaPago_id = '$objeto->formaPago' AND Provedor_id = '$objeto->proveedor' AND (FchaCompra BETWEEN '$objeto->inicial' AND '$objeto->final')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '10') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE FormaPago_id = '$objeto->formaPago'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '11') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE FormaPago_id = '$objeto->formaPago' AND Provedor_id = '$objeto->proveedor'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '12') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE FormaPago_id = '$objeto->formaPago' AND (FchaCompra BETWEEN '$objeto->inicial' AND '$objeto->final')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '13') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE FormaPago_id = '$objeto->formaPago' AND Provedor_id = '$objeto->proveedor' AND (FchaCompra BETWEEN '$objeto->inicial' AND '$objeto->final')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '14') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE Provedor_id = '$objeto->proveedor' ")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '15') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE Provedor_id = '$objeto->proveedor' AND (FchaCompra BETWEEN '$objeto->inicial' AND '$objeto->final')")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '16') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE FchaCompra BETWEEN '$objeto->inicial' AND '$objeto->final'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->c == '17') {
            $result = mysqli_query($conexion, "SELECT * FROM `compras` WHERE FchaCompra LIKE '$objeto->mes%'")or die("Error : ".mysqli_error($conexion));

        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function filtroGastos($objeto)//muestra los gastos que concuerden con el filtro
    {
        $conexion = $this->ConectarBD();
        if ($objeto->G == '1') {
            $result = mysqli_query($conexion, "SELECT * FROM gastos")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '2') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                          SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id AND mm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id AND vm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id AND rm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id and pf.cliente IN ('$objeto->cliente'))")
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '3') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                          SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id AND mm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id AND vm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id AND rm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id and pf.cliente IN ('$objeto->cliente'))
                AND g.proyecto_id = '$objeto->nProyecto'")
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '4') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                          SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id AND mm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id AND vm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id AND rm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id and pf.cliente IN ('$objeto->cliente'))
                AND g.descripcion_id = ".mysqli_escape_string($conexion,$objeto->description))
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '5') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                          SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id AND mm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id AND vm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id AND rm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id and pf.cliente IN ('$objeto->cliente'))
                AND (fchaEntrega BETWEEN '$objeto->inicial' AND '$objeto->final')")
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '6') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                          SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id AND mm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id AND vm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id AND rm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id and pf.cliente IN ('$objeto->cliente'))
                AND g.proyecto_id = '$objeto->nProyecto' AND g.descripcion_id = ".mysqli_escape_string($conexion,$objeto->description))
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '7') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                          SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id AND mm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id AND vm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id AND rm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id and pf.cliente IN ('$objeto->cliente'))
                AND g.proyecto_id = '$objeto->nProyecto' AND (fchaEntrega BETWEEN '$objeto->inicial' AND '$objeto->final')")
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '8') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                          SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id AND mm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id AND vm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id AND rm.cliente IN ('$objeto->cliente')
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id and pf.cliente IN ('$objeto->cliente'))
                AND g.proyecto_id = '$objeto->nProyecto' AND g.descripcion_id = ".mysqli_escape_string($conexion,$objeto->description). "AND (fchaEntrega BETWEEN '$objeto->inicial' AND '$objeto->final')")
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '9') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                          SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id )
                AND g.descripcion_id = ".mysqli_escape_string($conexion,$objeto->description))
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '10') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                          SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id )
                AND g.descripcion_id = ".mysqli_escape_string($conexion,$objeto->description). " AND (fchaEntrega BETWEEN '$objeto->inicial' AND '$objeto->final')")
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '11') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                        SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id )
                AND (fchaEntrega BETWEEN '$objeto->inicial' AND '$objeto->final')")
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->G == '12') {
           $result = mysqli_query($conexion, "SELECT * FROM gastos g WHERE exists (
                        SELECT NULL FROM materialmanoobra mm WHERE mm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM ventamaterial vm WHERE vm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM rentamaterial rm WHERE rm.id = g.proyecto_id
                UNION ALL SELECT NULL FROM preciofijo pf WHERE pf.id = g.proyecto_id )
                AND (fchaEntrega LIKE '$objeto->mes%')")
                or die("Error : ".mysqli_error($conexion));

        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function filtroComparativaMS($objeto)//muestra las compras que concuerden con el filtro
    {
        $conexion = $this->ConectarBD();
        if ($objeto->n == '1') {
            $result = mysqli_query($conexion, "SELECT pcm.id_ProduCom, pcm.producto_id, c.FchaCompra, c.Semana FROM `compras` c
                INNER JOIN pcompra_compras pc ON c.id_compra = pc.compra_id
                INNER JOIN productos_compra pcm ON pc.PCompra_id = pcm.id_ProduCom
                WHERE c.FchaCompra LIKE '$objeto->año%'")
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->n == '2') {
            $result = mysqli_query($conexion, "SELECT pcm.id_ProduCom, pcm.producto_id, c.FchaCompra, c.Semana FROM `compras` c
                INNER JOIN pcompra_compras pc ON c.id_compra = pc.compra_id
                INNER JOIN productos_compra pcm ON pc.PCompra_id = pcm.id_ProduCom
                WHERE c.FchaCompra LIKE '$objeto->año%' AND pcm.producto_id = '".mysqli_escape_string($conexion,$objeto->descripcion)."'")
                or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->n == '3') {
            $result = mysqli_query($conexion, "SELECT pcm.id_ProduCom, pcm.producto_id, c.FchaCompra, c.Semana FROM `compras` c
                INNER JOIN pcompra_compras pc ON c.id_compra = pc.compra_id
                INNER JOIN productos_compra pcm ON pc.PCompra_id = pcm.id_ProduCom
                WHERE c.Semana LIKE '%$objeto->año'")
                or die("Error : ".mysqli_error($conexion));

        }else  if ($objeto->n == '4') {
            $result = mysqli_query($conexion, "SELECT pcm.id_ProduCom, pcm.producto_id, c.FchaCompra, c.Semana FROM `compras` c
                INNER JOIN pcompra_compras pc ON c.id_compra = pc.compra_id
                INNER JOIN productos_compra pcm ON pc.PCompra_id = pcm.id_ProduCom
                WHERE c.Semana LIKE '%$objeto->año' AND pcm.producto_id = '".mysqli_escape_string($conexion,$objeto->descripcion)."'")
                or die("Error : ".mysqli_error($conexion));

        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                                PROVEDOR                         *****
    ***************************************************************************/
    //Consulta Provedor
    public function consultar_Provedor()/*===*/
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM provedores")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta Provedor
    public function Datos_Provedor($objeto)/*===*/
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT P.*, B.* FROM provedores P LEFT JOIN datos_bancarios B ON P.id_prove = B.provedor_id WHERE id_prove = '$objeto->id' AND B.predeterminada = 1")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta Provedor (FormaPago y LimiteCredito)
    public function FormaPago_Provedor($objeto)/*===*/
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT FormaPago, LimiteCredito FROM provedores WHERE id_prove = '$objeto->provedor_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //existe Provedor
    public function Existe_Provedor($objeto)/*===*/
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM provedores WHERE RazonSocial = '".mysqli_escape_string($conexion,$objeto->razonSocial)."'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar Provedor
    public function Insert_Provedor($objeto)/*===*/
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO provedores(RazonSocial, nombre, direccion, nombreContacto, telefono, correo, condicionesPago, LimiteCredito, monto_credito, saldo_credito, status, creado, MetodoPago_id, FormaPago_id)
            VALUES ('".mysqli_escape_string($conexion,$objeto->razonSocial)."',
                    '$objeto->nombre',
                    '$objeto->direccion',
                    '$objeto->nombreContacto',
                    '$objeto->telefono',
                    '$objeto->correo',
                    '$objeto->condicionesPago',
                    '$objeto->LimiteCredito',
                    '$objeto->monto_credito',
                    '$objeto->saldo_credito',
                    '$objeto->status',
                    '$objeto->creado',
                    '$objeto->metodoPago',
                    '$objeto->formaPago')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar compra
    public function Mod_Provedor($objeto)/*(modifica lo mismo que el otro solo que menos campos)*/
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE provedores SET RazonSocial = '".mysqli_escape_string($conexion,$objeto->razonSocial)."',
                                                                  nombre         = '$objeto->nombre',
                                                                  direccion      = '$objeto->direccion',
                                                                  nombreContacto = '$objeto->contacto',
                                                                  telefono       = '$objeto->telefono',
                                                                  correo         = '$objeto->email',
                                                                  modificado     = '$objeto->modificado'
                                               WHERE id_prove = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //modificar provedor
    public function Update_Provedor($objeto)/*===*/
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE provedores SET RazonSocial = '".mysqli_escape_string($conexion,$objeto->razonSocial)."',
                                                                  nombre         = '$objeto->nombre',
                                                                  direccion      = '$objeto->direccion',
                                                                  nombreContacto = '$objeto->nombreContacto',
                                                                  telefono       = '$objeto->telefono',
                                                                  correo         = '$objeto->correo',
                                                                  condicionesPago= '$objeto->condicionesPago',
                                                                  LimiteCredito  = '$objeto->LimiteCredito',
                                                                  monto_credito  = '$objeto->monto_credito',
                                                                  status         = '$objeto->status',
                                                                  modificado     = '$objeto->modificado',
                                                                  MetodoPago_id  = '$objeto->metodoPago',
                                                                  FormaPago_id   = '$objeto->formaPago'
                                               WHERE id_prove = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                          REQUISICIÓN                            *****
    ***************************************************************************/
    //Consulta Requisicion
    public function Buscar_Requisicion()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM requisiciones")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta Requisicion dependiendo del folio
    public function obtener_Requisicion($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM requisiciones WHERE folio = '$objeto->folio'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta datos de la Requisicion
    public function Datos_Requisicion($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM requisiciones WHERE id_requisicion = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra nombres para select SOLICITANTE
    public function Solicitante()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM andamieros WHERE estatus = 'Vigente' AND nombre != '' ORDER BY nombre ASC ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //MUESTRA ULTIMO FOLIO
    public function Buscar_UltimaRequisicion()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(folio) AS folio FROM requisiciones")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar Requisicion
    public function Insert_Requisicion($objeto)
    {
        $conexion = $this->ConectarBD();
        if($objeto->nProyecto == ''){
            $result = mysqli_query($conexion,
               "INSERT INTO requisiciones(folio, fecha, departamento, solicitante, costoTotal, estatus, optionCotizacion, observaciones, n_Proyecto, Creado)
                VALUES ('$objeto->folio',
                        '$objeto->fecha',
                        '$objeto->departamento',
                        '$objeto->solicitante',
                        '$objeto->costoTOTAL',
                        '$objeto->status',
                        '$objeto->optionCotizacion',
                        '".mysqli_escape_string($conexion,$objeto->observacion)."',
                        NULL,
                        '$objeto->creado' )")
                or die("Error en la insercion".mysqli_error($conexion));
        }else{
            $result = mysqli_query($conexion,
               "INSERT INTO requisiciones(folio, fecha, departamento, solicitante, costoTotal, estatus, optionCotizacion, observaciones, n_Proyecto, Creado)
                VALUES ('$objeto->folio',
                        '$objeto->fecha',
                        '$objeto->departamento',
                        '$objeto->solicitante',
                        '$objeto->costoTOTAL',
                        '$objeto->status',
                        '$objeto->optionCotizacion',
                        '".mysqli_escape_string($conexion,$objeto->observacion)."',
                        '$objeto->nProyecto',
                        '$objeto->creado' )")
                or die("Error en la insercion".mysqli_error($conexion));
        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar Requisicion status y costoTotal
    public function Update_Requisicion_Status($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE requisiciones SET estatus    = '$objeto->status',
                                                                        costoTotal = '$objeto->costoTotal'
                                               WHERE id_requisicion = '$objeto->requisicion_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //modificar Requisicion status
    public function Update_requisition_Statu($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE requisiciones SET estatus = '$objeto->estatus'
                                               WHERE id_requisicion = '$objeto->idReq'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

     //Muestra fecha, precio Y proveedor del ultimo producto que se compro
    public function obtenPrecioFechaP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT CT.precio, C.provedor_id, MAX(C.FchaCompra) AS fecha FROM compras C INNER JOIN pcompra_compras PCC ON C.id_compra = PCC.compra_id INNER JOIN productos_compra PC ON PCC.PCompra_id = PC.id_ProduCom INNER JOIN cotizaciones_pc CT ON CT.PCompra_id = PC.id_ProduCom WHERE PC.producto_id = '$objeto->id' AND CT.Compra_Autorizada = 1 GROUP BY CT.precio, C.provedor_id")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                         productos_compra                        *****
    ***************************************************************************/
    //Consulta los productos_compra de la Requisicion
    public function ProductosCom_Requisicion($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM productos_compra WHERE requisicion_id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta los productos_compra de ese id
    public function ProductosCompra($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM productos_compra WHERE id_ProduCom = '$objeto->produc_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta los datos de productos_compra de ese id , con el id de cotizacion
    public function Data_Product($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `productos_compra` WHERE id_ProduCom = (SELECT PCompra_id FROM `cotizaciones_pc` WHERE id_cot = '$objeto->cotizacion_id')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar productos en Tabla "productos_compra" (solicituds)
    public function Insert_ProductosComprar($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO productos_compra(producto_id, cantidad, especificacion, prioridad, precioS, can_disponible, requisicion_id, provedor_id, creado)
            VALUES ('$objeto->producto_id',
                    '$objeto->cantidad',
                    '$objeto->especificacion',
                    '$objeto->Prioridad',
                    '$objeto->Precio',
                     0,
                    '$objeto->requisicion_id',
                    '$objeto->provedor_id',
                    '$objeto->creado' )")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    ///Muestra los datos del PRODUCTO y UNIDAD MEDIDA de ese id
    public function ObtenDatosProductos($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT P.*,UM.* FROM `productos` P INNER JOIN unidadesmedida UM ON P.unidadMedida_id = UM.id_u_Medida WHERE P.id_producto = (SELECT PC.producto_id FROM `productos_compra` PC WHERE id_ProduCom = '$objeto->produc_id')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar datos en Tabla PCOMPRA_COMPRAS (cuando fue pagado el producto)
    public function Insert_PCOMPRA_COMPRAS($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO pcompra_compras(PCompra_id, compra_id) VALUES ('$objeto->PCompra_id', '$objeto->Compra_id' )") or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //mostrar datos de PCOMPRA_COMPRAS cuando sea el mismo id
    public function Mostrar_PCOMPRA_COMPRAS($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `pcompra_compras` WHERE compra_id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar valor de sobra en compra
    public function actualizar_ProductoSobra($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE productos_compra SET can_disponible  = '$objeto->can_disponible'
                                               WHERE id_ProduCom = '$objeto->produc_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function mostrar_precioCant($objeto)
    { //, CT.iva
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT PC.id_ProduCom, PC.can_disponible, CT.precio FROM `productos_compra` PC INNER JOIN cotizaciones_pc CT ON PC.id_ProduCom = CT.PCompra_id WHERE PC.producto_id = '$objeto->id' AND CT.Pagado = 1 AND CT.Recibido > 0 AND CT.Compra_Autorizada = 1 AND PC.especificacion LIKE '$objeto->especificacion'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function recepcionProductos($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT cotizaciones_pc.id_cot, cotizaciones_pc.PCompra_id, (SELECT P.nombre FROM `productos` P WHERE P.id_producto = (SELECT PC.producto_id FROM `productos_compra` PC WHERE id_ProduCom = cotizaciones_pc.PCompra_id)) AS Producto FROM `pcompra_compras` LEFT JOIN `cotizaciones_pc` ON pcompra_compras.PCompra_id = cotizaciones_pc.PCompra_id WHERE pcompra_compras.compra_id = '$objeto->compra_id' AND cotizaciones_pc.Compra_Autorizada = 1 AND cotizaciones_pc.Pagado = 1 AND cotizaciones_pc.PCompra_id = pcompra_compras.PCompra_id")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                               PRODUCTOS                         *****
    ***************************************************************************/
    //Muestra los PRODUCTOS
    public function Productos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT *, (SELECT SUM(
                                                                    (SELECT SUM( C.cantidad * C.precio)
                                                                     FROM `cotizaciones_pc` C
                                                                     WHERE C.requisicion_id = PC.requisicion_id AND C.Compra_Autorizada = 1 AND C.Pagado = 0 AND C.PCompra_id = PC.id_ProduCom
                                                                    )
                                                                ) AS suma
                                                        FROM `productos_compra` PC
                                                        WHERE PC.producto_id = P.id_producto
                                                      ) AS Falta_Pagar
                                            FROM productos P")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra los datos del PRODUCTO
    public function ProductosDatos($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM productos WHERE id_producto = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra el stock que hay, de ese producto con misma especificacion
    public function stock_Producto($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(PC.can_disponible) AS stock FROM `productos_compra` PC INNER JOIN cotizaciones_pc CT ON PC.id_ProduCom = CT.PCompra_id WHERE PC.producto_id = '$objeto->id' AND CT.Pagado = 1 AND CT.Recibido > 0 AND CT.Compra_Autorizada = 1 AND PC.especificacion LIKE '$objeto->especificacion' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    ///Muestra los datos del PRODUCTO y UNIDAD MEDIDA de ese id
    public function ProductosUMedida_Datos($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT P.*,UM.* FROM `productos` P INNER JOIN unidadesmedida UM ON P.unidadMedida_id = UM.id_u_Medida WHERE P.id_producto = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra los datos del PRODUCTO con el id de producto_compra
    public function Mostrar_DatosProducto($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `productos` WHERE id_producto = (SELECT producto_id FROM `productos_compra` WHERE id_ProduCom = '$objeto->PCompra_id')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar producto pendiente_Recibir
    public function Update_Producto_stockPendiente($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE `productos` SET pendiente_Recibir = '$objeto->pendiente_Recibir' WHERE id_producto = '$objeto->id_producto'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    // modificar stocks producto
    public function Update_stockProducto($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE productos SET stock             = '$objeto->stock',
                                                                    pendiente_Recibir = '$objeto->pendiente_Recibir'
                                                                WHERE id_producto = '$objeto->id_producto'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //Muestra producto igual al nombre
    public function Existe_Productos($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM productos WHERE nombre = '$objeto->nombre'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra el codigo maximo de esa categoria
    public function Maximo_CodigoP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(codigo) AS MaximoCodigo FROM `productos` WHERE categoria_id = '$objeto->categoria'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar datos en Producto
    public function Insert_Producto($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO productos(codigo, nombre, unidadMedida_id, categoria_id, stock_minimo, creado,vidaUtil)
            VALUES ('$objeto->codigo',
                    '$objeto->nombre',
                    '$objeto->unidadMedida',
                    '$objeto->categoria',
                    '$objeto->stockMinimo',
                    '$objeto->creado',
                    '$objeto->vidaUtil')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar Producto
    public function Update_Producto($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE productos SET codigo          = '$objeto->codigo',
                                                                    nombre          = '$objeto->nombre',
                                                                    unidadMedida_id = '$objeto->unidadMedida',
                                                                    categoria_id    = '$objeto->categoria',
                                                                    stock_minimo    = '$objeto->stockMinimo',
                                                                    modificado      = '$objeto->modificado',
                                                                    vidaUtil      = '$objeto->vidaUtil'
                                               WHERE id_producto = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function Cantidad_Productos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(stock) AS Suma FROM `productos`")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Cantidad_ProduPendietes()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(pendiente_Recibir) AS Suma_Pendiente FROM `productos`")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Producto_Datos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `productos` ORDER BY stock DESC, codigo ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function ProductoPend_Datos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `productos` ORDER BY pendiente_Recibir DESC, codigo ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarDescription($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM productos  WHERE categoria_id = '$objeto->categoria_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function mostrarDescription2($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT P.id_producto, P.codigo, P.nombre, PC.especificacion,
                                                (SELECT SUM(PC2.can_disponible)
                                                 FROM `productos_compra` PC2 INNER JOIN cotizaciones_pc CT ON PC2.id_ProduCom = CT.PCompra_id
                                                 WHERE PC2.producto_id = P.id_producto AND CT.Pagado = 1 AND CT.Recibido > 0 AND CT.Compra_Autorizada = 1 AND PC2.especificacion LIKE PC.especificacion
                                                ) AS stock
                                            FROM `productos` P INNER JOIN `productos_compra` PC ON P.id_producto = PC.producto_id
                                            WHERE P.categoria_id = '$objeto->categoria_id'
                                            ORDER BY P.nombre, PC.especificacion ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                    COTIZACIONES (PRODUCTO)                      *****
    ***************************************************************************/
    //Muestra las cotizaciones de esa requisicion
    public function Buscar_Cotizaciones($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM cotizaciones_pc WHERE requisicion_id = '$objeto->idReq'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra la cotizacion de ese id
    public function Mostrar_Cotizacion($objeto)
    { //SELECT * FROM cotizaciones_pc WHERE id_cot = '$objeto->idcot'
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT C.*, (SELECT R.n_Proyecto FROM `requisiciones` R WHERE R.id_requisicion = C.requisicion_id) AS proyecto FROM cotizaciones_pc C WHERE C.id_cot = '$objeto->idcot'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestrar los provedores donde las cotizaciones sean esa requisicion y esten autorizadas
    public function mostrarProvedoresC($objeto)
    { //, iva
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT provedor_id FROM `cotizaciones_pc` WHERE requisicion_id = '$objeto->idReq' AND Compra_Autorizada = 1 GROUP BY provedor_id")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestrar las cotizaciones que coinsida con esa requisicion, provedor y esten autorizadas
    public function mostrar_CotizaAutorizadas($objeto)
    { //AND iva = '$objeto->iva'
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `cotizaciones_pc` WHERE requisicion_id = '$objeto->idReq' AND provedor_id = '$objeto->provedor_id' AND Compra_Autorizada = 1")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestrar las cotizaciones que coinsida con esa requisicion, producto y esten autorizadas
    public function Suma_CotizaAutorizadasP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(cantidad) AS CantidadTotal FROM `cotizaciones_pc` WHERE Compra_Autorizada = 1 AND PCompra_id = '$objeto->PCompra_id' AND requisicion_id = '$objeto->requisicion_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestrar las cotizaciones(producto) que tiene esa orden de compra
    public function productos_OrdenCompra($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `cotizaciones_pc` WHERE requisicion_id = '$objeto->idReq' AND provedor_id = '$objeto->provedor_id' AND Compra_Autorizada = 1")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar datos en cotizacion
    public function Insert_Cotizacion($objeto)
    { //iva,'$objeto->iva',
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO cotizaciones_pc(cantidad, precio, Tm_entrega, Compra_Autorizada, Pagado, Recibido, provedor_id, PCompra_id, requisicion_id, creado)
            VALUES ('$objeto->cantidad',
                    '$objeto->precio',
                    '$objeto->TM_entrega',
                    '$objeto->Compra_Autorizada',
                    '$objeto->Pagado',
                    '$objeto->Recibido',
                    '$objeto->provedor_id',
                    '$objeto->PCompra_id',
                    '$objeto->requisicion_id',
                    '$objeto->creado')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar cotizacion
    public function Update_Cotizacion($objeto)
    { //iva               = '$objeto->iva',
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE cotizaciones_pc SET cantidad         = '$objeto->cantidad',
                                                                         precio            = '$objeto->precio',
                                                                         Tm_entrega        = '$objeto->TM_entrega',
                                                                         Compra_Autorizada = '$objeto->Compra_Autorizada',
                                                                         provedor_id       = '$objeto->provedor_id',
                                                                         PCompra_id        = '$objeto->PCompra_id',
                                                                         requisicion_id    = '$objeto->requisicion_id',
                                                                         modificado        = '$objeto->modificado'
                                               WHERE id_cot = '$objeto->id_COT'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //modificar AutorizarCotizacion
    public function Update_AutorizarCotizacion($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE cotizaciones_pc SET Compra_Autorizada = '$objeto->Compra_Autorizada'
                                               WHERE id_cot = '$objeto->id_COT'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    // modificar cotizacion statusPagado
    public function Update_Cotizacion_StatusCompra($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE cotizaciones_pc SET Pagado = '$objeto->Pagado' WHERE id_cot = '$objeto->id_cot'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    // Muestrar las cotizaciones(producto) que tiene esa orden de compra
    public function productos_Comprados($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `cotizaciones_pc` WHERE Compra_Autorizada = 1 AND Pagado = 1 AND PCompra_id = '$objeto->PCompra_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    // modificar cotizacion recibido producto
    public function Update_RecibidoCotiza($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE cotizaciones_pc SET Recibido = '$objeto->Recibido' WHERE id_cot = '$objeto->cotizacion_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                          ORDEN DE COMPRA                        *****
    ***************************************************************************/
    //MUESTRA LAS OrdenCompra
    public function Orden_Compra()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM ordenes_compra")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //MUESTRA ULTIMO FOLIO
    public function Buscar_UltimaOrdenC()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(folio) AS folio FROM ordenes_compra")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //MUESTRA Orden De Compra
    public function Datos_OrdenCompra($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM ordenes_compra WHERE id_ordenesC = '$objeto->id_ordenesC'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //MUESTRA Orden De Compra dependiendo folio
    public function Dato_OrdenCompra($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM ordenes_compra WHERE folio = '$objeto->folio'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar datos en OrdenCompra
    public function Insertar_OrdenCompra($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO ordenes_compra(folio, fecha, costo, debe, DiaLimitePago, status, requisicion_id, provedor_id, creado)
            VALUES ('$objeto->folio',
                    '$objeto->fecha',
                    '$objeto->costo',
                    '$objeto->debe',
                    '$objeto->DiaLimitePago',
                    '$objeto->status',
                    '$objeto->requisicion_id',
                    '$objeto->provedor_id',
                    '$objeto->creado')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar AutorizarCotizacion
    public function Update_ordenCompra_StatusDebe($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE ordenes_compra SET debe   = '$objeto->debe',
                                                                         status = '$objeto->status'
                                               WHERE id_ordenesC = '$objeto->OrdenCompra_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //MUESTRA Ordenes De Compra de esa requisicion
    public function Muestra_OrdenCompraREQ($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM ordenes_compra WHERE requisicion_id = '$objeto->idReq'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                                RECEPCIÓN                        *****
    ***************************************************************************/
    //Muestrar Recepcion
    public function Recepcion()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `recepcion_compra` ORDER BY id DESC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //Muestrar Recepcion
    public function Datos_Recepcion($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `recepcion_compra` WHERE id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar datos en RECEPCIÓN
    public function Insert_Recepcion($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO recepcion_compra(fecha, recibio, cantidad, observacion, compra_id, cotizacion_id, creado)
            VALUES ('$objeto->fecha',
                    '$objeto->recibio',
                    '$objeto->cantidad',
                    '".mysqli_escape_string($conexion,$objeto->observacion)."',
                    '$objeto->compra_id',
                    '$objeto->cotizacion_id',
                    '$objeto->creado')")
            or die("Error en la insercion".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar RECEPCIÓN
    public function Update_Recepcion($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE recepcion_compra SET cantidad    = '$objeto->cantidad',
                                                                           observacion = '".mysqli_escape_string($conexion,$objeto->observacion)."',
                                                                           recibio     = '$objeto->recibio',
                                                                           modificado  = '$objeto->modificado'
                                               WHERE id = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //suma las cantidades con el mismo id
    public function Suma_CantidadRecepcion($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(cantidad) AS CantidaTotal FROM `recepcion_compra` WHERE compra_id = '$objeto->compra_id' AND cotizacion_id = '$objeto->cotizacion_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //suma las cantidades con el mismo id
    public function Suma_CantidadRecepcion2($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT SUM(cantidad) AS CantidaTotal FROM `recepcion_compra` WHERE compra_id = '$objeto->compra_id' AND cotizacion_id = '$objeto->cotizacion_id' AND id != '$objeto->id_RCP'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestrar las suma las cantidades con el mismo id
    public function Datos_Producto($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM `productos` WHERE id_producto = (SELECT producto_id FROM `productos_compra` WHERE id_ProduCom = (SELECT PCompra_id FROM `cotizaciones_pc` WHERE id_cot = '$objeto->idcot'))")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function updateGasto($objeto)//inserta datos en recepcion_compra
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "UPDATE recepcion_compra
                                            SET gastos_id  = '$objeto->gasto_id'
                                            WHERE id  = '$objeto->id_recepcion'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                 UNUDAD DE MEDIDA (PRODUCTO)                     *****
    ***************************************************************************/
    //Muestra las unidadesmedida
    public function UnidadesMedida()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM unidadesmedida")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra los datos de la unidadesmedida
    public function UnidadesMedidaDatos($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM unidadesmedida WHERE id_u_Medida = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra los datos de la UnidadesMedida
    public function Existe_UnidadesMedida($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM unidadesmedida WHERE descripcion = '".mysqli_escape_string($conexion,$objeto->description)."'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar
    public function Insert_UnidadesMedida($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO unidadesmedida(c_ClaveUnidad, descripcion)
            VALUES ('$objeto->clave',
                    '".mysqli_escape_string($conexion,$objeto->description)."')")
            or die("Error en la insercion".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar
    public function Update_UnidadesMedida($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE unidadesmedida SET c_ClaveUnidad     = '$objeto->clave',
                                               descripcion = '".mysqli_escape_string($conexion,$objeto->description)."'
                                               WHERE id_u_Medida = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                        CATEGORIA (PRODUCTO)                     *****
    ***************************************************************************/
    //Muestra las categoria
    public function CategoriaP()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM categorias_prdct")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra los datos de la categoria
    public function CategoriaPDatos($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM categorias_prdct WHERE id_cat = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra los datos de la categoria
    public function Existe_categoriaP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM categorias_prdct WHERE descripcion = '".mysqli_escape_string($conexion,$objeto->descripcion)."'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar
    public function Insert_CategoriaP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO categorias_prdct(descripcion, prefijo)
            VALUES ('".mysqli_escape_string($conexion,$objeto->descripcion)."',
                    '$objeto->prefijo')")
            or die("Error en la insercion".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar
    public function Update_CategoriaP($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE categorias_prdct SET descripcion = '".mysqli_escape_string($conexion,$objeto->descripcion)."',
                                                                           prefijo     = '$objeto->prefijo'
                                               WHERE id_cat = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                    METODOS DE PAGO (compra)                     *****
    ***************************************************************************/
    // Muestra el METODOS DE PAGO
    public function Metodos_Pago()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM metodos_pago")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Mostrar_Metodos_Pago($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM metodos_pago WHERE id_mPago = '$objeto->MetodoPago_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra los datos de la FormasPago
    public function Existe_MetodoPago($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM metodos_pago WHERE descripcion = '".mysqli_escape_string($conexion,$objeto->description)."'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar
    public function Insert_MetodoPago($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO metodos_pago(c_MetodoPago, descripcion)
            VALUES ('$objeto->MetodoPago',
                    '".mysqli_escape_string($conexion,$objeto->description)."')")
            or die("Error en la insercion".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar
    public function Update_MetodoPago($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE metodos_pago SET c_MetodoPago  = '$objeto->MetodoPago',
                                                descripcion = '".mysqli_escape_string($conexion,$objeto->description)."'
                                               WHERE id_mPago = '$objeto->MetodoPago_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                     FORMAS DE PAGO (compra)                     *****
    ***************************************************************************/
    // Muestra el FORMAS DE PAGO
    public function Formas_Pago()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM formas_pago")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Mostrar_Formas_Pago($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM formas_pago WHERE id_fPago = '$objeto->FormaPago_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Muestra los datos de la FormasPago
    public function Existe_FormasPago($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM formas_pago WHERE descripcion = '".mysqli_escape_string($conexion,$objeto->description)."'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar
    public function Insert_FormasPago($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO formas_pago(c_FormaPago, descripcion)
            VALUES ('$objeto->formaPg',
                    '".mysqli_escape_string($conexion,$objeto->description)."')")
            or die("Error en la insercion".mysqli_error($conexion));

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar
    public function Update_FormasPago($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE formas_pago SET c_FormaPago  = '$objeto->formaPg',
                                                descripcion = '".mysqli_escape_string($conexion,$objeto->description)."'
                                               WHERE id_fPago = '$objeto->FormaPago_id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                  DATOS BANCARIOS (proveedor)                    *****
    ***************************************************************************/
    // Muestra el Datos_Bancarios de ese provedor
    public function Mostrar_Datos_Bancarios($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM datos_bancarios WHERE provedor_id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Datos_Datos_Bancarios($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM datos_bancarios WHERE id = '$objeto->DatosBancario_id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Obten_DatosCuenta($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM datos_bancarios WHERE cuenta = '$objeto->cuenta'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     //insertar
    public function Insert_Datos_Bancarios($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO datos_bancarios(banco, rfc, cuenta, clave_interbancaria, provedor_id, predeterminada, creado)
            VALUES ('$objeto->banco',
                    '$objeto->RFC',
                    '$objeto->cuenta',
                    '$objeto->clave',
                    '$objeto->provedor_id',
                    '$objeto->predeterminada',
                    '$objeto->creado')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar
    public function Update_Datos_Bancarios($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE datos_bancarios SET  banco      = '$objeto->banco',
                                                                           rfc        = '$objeto->RFC',
                                                                           cuenta     = '$objeto->cuenta',
                                                                           clave_interbancaria  = '$objeto->clave',
                                                                           modificado = '$objeto->modificado'
                                               WHERE id = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function Update_Cuentas_Predeterminadas($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE datos_bancarios SET  predeterminada = '0'
                                               WHERE provedor_id = '$objeto->provedor_id' AND predeterminada = 1") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function Update_Cuenta_Predeterminada($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE datos_bancarios SET predeterminada = '1'
                                               WHERE id = '$objeto->id_Bancario'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                    DATATABLES SEARCH DESCARGABLE                *****
    ***************************************************************************/
    public function solicitud_personal($objeto)
    {
        $conexion = $this->ConectarBD();
        if ($objeto->op == 'sin planta') {
          $result = mysqli_query($conexion, "SELECT * FROM `solicitud_personal` WHERE CONCAT_WS(' ', solicitante, area, fechaSolicitud, status) LIKE '$objeto->search'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->op == 'con planta') {
          $result = mysqli_query($conexion, "SELECT * FROM `solicitud_personal` WHERE CONCAT_WS(' ', solicitante, area, fechaSolicitud, status) LIKE '$objeto->search' AND planta = '$objeto->planta'")or die("Error : ".mysqli_error($conexion));
        }
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function solicitud_andamio($objeto)
    {
        $conexion = $this->ConectarBD();
        if ($objeto->op == 'sin planta') {
          $result = mysqli_query($conexion, "SELECT * FROM `solicitud_andamio` WHERE CONCAT_WS(' ', solicitante, area, fechaArmado, longitud, ancho, altura, status) LIKE '$objeto->search'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->op == 'con planta') {
          $result = mysqli_query($conexion, "SELECT * FROM `solicitud_andamio` WHERE CONCAT_WS(' ', solicitante, area, fechaArmado, longitud, ancho, altura, status) LIKE '$objeto->search' AND planta = '$objeto->planta'")or die("Error : ".mysqli_error($conexion));

        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function hoja_trabajo($objeto)
    {
        $conexion = $this->ConectarBD();
        if ($objeto->op == 'sin planta') {
          $result = mysqli_query($conexion, "SELECT * FROM `hoja_trabajo` WHERE CONCAT_WS(' ', folio, area, equipo, userC_id, fchRarmado, desmontaje, totalpz_andamio, dias_utilizados ,totalx_diasrenta, mano_obra, status) LIKE '$objeto->search'")or die("Error : ".mysqli_error($conexion));

        }else if ($objeto->op == 'con planta') {
          $result = mysqli_query($conexion, "SELECT * FROM `hoja_trabajo` WHERE CONCAT_WS(' ', folio, area, equipo, userC_id, fchRarmado, desmontaje, totalpz_andamio, dias_utilizados ,totalx_diasrenta, mano_obra, status) LIKE '$objeto->search' AND clientes_id = '$objeto->planta'")or die("Error : ".mysqli_error($conexion));

        }

        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                               ARCHIVOS                          *****
    ***************************************************************************/
    //MUESTRA si existe ese archivo
    public function Existe_Archivo($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM archivos WHERE name = '$objeto->name' AND nombre = '$objeto->nombre' AND tabla = '$objeto->tabla'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Consulta datos del archivo si existe la Requisicion
    public function Archivo_Requisicion($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM archivos WHERE  nombre = '$objeto->nombre' AND tabla = '$objeto->tabla' AND FK_id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar datos en archivo
    public function Insert_Archivo($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO archivos(name, type, size, nombre, tabla, FK_id, user_id, fch_creado)
            VALUES ('$objeto->name',
                    '$objeto->type',
                    '$objeto->size',
                    '$objeto->nombre',
                    '$objeto->tabla',
                    '$objeto->FK_id',
                    '$objeto->user_id',
                    '$objeto->fch_creado')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //modificar archivo
    public function Update_Archivo($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE archivos SET name      = '$objeto->name',
                                                                  type       = '$objeto->type',
                                                                  size       = '$objeto->size',
                                                                  nombre     = '$objeto->nombre',
                                                                  tabla      = '$objeto->tabla',
                                                                  FK_id      = '$objeto->FK_id',
                                                                  user_id    = '$objeto->user_id',
                                                                  fch_creado = '$objeto->fch_creado'
                                               WHERE id_arch = '$objeto->id_arch'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //Mostrar archivo
    public function Archivo($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM archivos WHERE  id_arch = '$objeto->id_arch'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Mostrar tablas que tienen archivos
    public function TablasconArchivos()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT(tabla) FROM archivos")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Mostrar archivos de la misma tabla
    public function Archivos_Tabla($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM archivos WHERE tabla = '$objeto->tabla' AND (fch_creado BETWEEN '$objeto->FchInicial' AND '$objeto->FchFinal') AND name != '' AND FK_id != 0 ORDER BY fch_creado, FK_id")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    /***************************************************************************
    ******                        NOTIFICACIONES                           *****
    ***************************************************************************/
    public function Mostrar_Notificaciones($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM notificaciones WHERE id_not = '$objeto->id_not' ORDER BY id_not DESC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //Mostrar NOTIFICACIONES
    public function Notificaciones($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM notificaciones WHERE  destinatario = '$objeto->id_user' AND leido = '0' AND lugar_acceso = '$objeto->acceso' ORDER BY id_not DESC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Ubdate_Notificacion($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE notificaciones SET leido      = 1,
                                                                         modificado = '$objeto->modificado'
                                               WHERE id_not = '$objeto->id_not'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    //insertar datos en Notificaciones
    public function Insert_Notificacion($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO notificaciones(autor, destinatario, titulo, mensaje, leido, URL, icono, fecha)
            VALUES ('$objeto->autor',
                    '$objeto->destinatario',
                    '$objeto->titulo',
                    '$objeto->mensaje',
                    '$objeto->leido',
                    '$objeto->URL',
                    '$objeto->icono',
                    '$objeto->fecha')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //insertar datos en Notificaciones de planta
    public function Insert_NotificacionP($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion,
           "INSERT INTO notificaciones(autor, destinatario, titulo, mensaje, leido, URL, icono, lugar_acceso, fecha)
            VALUES ('$objeto->autor',
                    '$objeto->destinatario',
                    '$objeto->titulo',
                    '$objeto->mensaje',
                    '$objeto->leido',
                    '$objeto->URL',
                    '$objeto->icono',
                    '$objeto->lugar_acceso',
                    '$objeto->fecha')")
            or die("Error en la insercion".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Buscar_Notificacion($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "SELECT * FROM `notificaciones` WHERE autor = '$objeto->autor' AND destinatario = '$objeto->destinatario' AND titulo = '$objeto->titulo' AND fecha LIKE '$objeto->fch%'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $actualizar;
    }

    public function Ubdate2_Notificacion($objeto)
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion,
              "UPDATE notificaciones SET leido      = 0,
                                         mensaje    = '$objeto->mensaje',        modificado = '$objeto->modificado'
                                     WHERE id_not = '$objeto->id_not'")
                                     or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    /***************************************************************************
    ******                           SCRIPTS                               *****
    ***************************************************************************/
    public function Ubdate_movimiento_Semana($objeto)//modificar Semana
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE `movimiento_andamio` SET Semana = '$objeto->Semana'
                                               WHERE id_mov = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }


    public function consulta_ht()//modificar Semana
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consulta_ht2($proyecto)//Hecho por carlos
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM hoja_trabajo WHERE n_proyecto = '$proyecto'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consulta_pieza($tipo, $pieza)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT codigo, $tipo AS tipo FROM precios_pieza WHERE codigo = '$pieza'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function update_ht($id, $renta_diaria)//Hecho por Carlos
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE `hoja_trabajo` SET totalrentaD_andamio = '$renta_diaria'
                                               WHERE id_hj = '$id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function system()
    {   $aDSystem = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM system") or die("Error: ".mysqli_error($conexion));

        while ($data = mysqli_fetch_array($result)) {
          $aDSystem[$data['id_Sys']] = array('codigo' => $data['codigo'], 'nombre' => $data['nombre'], 'texto' => $data['texto'], 'hora' => $data['hora'], 'status' => $data['status']);
        }
        $this->Cerrar_Conexion($conexion);
        return $aDSystem;
    }

    public function UpdatePeso_Mov($objeto)//modificar Semana
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE `movimiento_andamio` SET Peso_Total = '$objeto->Peso_Total'
                                               WHERE id_mov = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function UpdatePeso_HT($objeto)//modificar Semana
    {
        $conexion = $this->ConectarBD();
        $actualizar = mysqli_query($conexion, "UPDATE `hoja_trabajo` SET totalpeso_andamio  = '$objeto->totalpeso_andamio'
                                               WHERE  id_hj = '$objeto->id'") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return "true";
    }

    public function FoliosPendientes()
    {   $aDatosPendientes = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT folio, totalx_diasrenta, mano_obra, total, userC_id, status, fchRarmado FROM `hoja_trabajo` WHERE (statusVenta = 'Sin-OC' OR statusVenta = 'Sin-SP') AND status = 'Cerrado' ORDER BY fchRarmado ASC ") or die("Error: ".mysqli_error($conexion));
        $cont = 1;
        while ($data = mysqli_fetch_array($result)) {
          $aDatosPendientes[$cont] = array('folio' => $data['folio'], 'totalx_diasrenta' => $data['totalx_diasrenta'], 'mano_obra' => $data['mano_obra'], 'total' => $data['total'], 'userC_id' => $data['userC_id'], 'status' => $data['status'], 'fchRarmado' => $data['fchRarmado']);
          $cont++;
        }
        $this->Cerrar_Conexion($conexion);
        return $aDatosPendientes;
    }

    /***************************************************************************
    ******                     ASISTENCIA (Reloj Checador)                 *****
    ***************************************************************************/
    // Muestra la asistencia de ese dia
    public function AsistenciaxDia($objeto)
    {
        $aAsitencia = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT Asistencia.id_asis, Asistencia.id_persona,andamieros.nombre, Asistencia.fecha, Asistencia.hora, Asistencia.planta, categoria.categoria 
                                            FROM `Asistencia` 
                                            INNER JOIN andamieros ON Asistencia.id_persona = andamieros.id
                                            LEFT JOIN categoria ON andamieros.categoria = categoria.id_categoria
                                            $objeto->consulta 
                                            ORDER BY andamieros.nombre ASC, Asistencia.id_asis ASC ")or die("Error : ".mysqli_error($conexion));
        $cont = 1;
        while ($data = mysqli_fetch_array($result)) {
          $aAsitencia[$cont] = array('id_asis' => $data['id_asis'], 'id_persona' => $data['id_persona'],'nombre' => $data['nombre'], 'fecha' => $data['fecha'], 'hora' => $data['hora'], 'planta' => $data['planta'], 'Categoria' => $data['categoria']);
          $cont++;
        }
        $this->Cerrar_Conexion($conexion);
        return $aAsitencia;
    }

    // Muestra la primera hora(ASC)/ultima hora(DESC) de esa fecha, de ese cliente
    public function HoraInicial_Final($objeto)
    {
        $aHora = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT Asistencia.fecha, Asistencia.hora, Asistencia.planta FROM `Asistencia` INNER JOIN andamieros ON Asistencia.id_persona = andamieros.id WHERE Asistencia.fecha = '$objeto->fecha' AND Asistencia.planta = '$objeto->planta' ORDER BY Asistencia.hora $objeto->orden LIMIT 1 ")or die("Error : ".mysqli_error($conexion));
        $cont = 1;
        while ($data = mysqli_fetch_array($result)) {
          $aHora[1] = array('fecha' => $data['fecha'], 'hora' => $data['hora'], 'planta' => $data['planta']);
          $cont++;
        }
        $this->Cerrar_Conexion($conexion);
        return $aHora;
    }

    // Muestra la cantidad de veces que se encuentra el planta
    public function PlantaRepetido($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT COUNT(planta) AS cantidad FROM `Asistencia` WHERE fecha = '$objeto->fecha' AND planta = '$objeto->planta'  ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //muestra los supervisores vigentes
    public function huellaPersonal()
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id, nombre FROM andamieros WHERE f_no1 != '' ORDER BY nombre ASC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    //REPORTES GABRIEL
    public function Nombre_proyecto($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM rentamaterial where id='$objeto->proyecto' UNION(SELECT * FROM ventamaterial where id='$objeto->proyecto') UNION(SELECT * FROM manoobra where id='$objeto->proyecto') UNION(SELECT * FROM preciofijo where id='$objeto->proyecto') UNION(SELECT * FROM materialmanoobra where id='$objeto->proyecto')")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consulta_numproyecto($objeto)
    {
        $aDatosR1 = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT n_proyecto FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio%' AND clientes_id = '$objeto->clientes_id'   AND status = 'Cerrado' ORDER BY n_proyecto ASC ") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);

        return $result;
    }

    public function consulta_clientesconhojas($objeto)
    {
        $aDatosR1 = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT DISTINCT clientes_id FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio%'   AND status = 'Cerrado' ORDER BY clientes_id ASC ") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);

        return $result;
    }

    public function consulta_Info_XNo_proyecto($objeto)
    {
        $aDatosR1 = [];
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT id_hj, clientes_id, userC_id, folio, fchRarmado, fchRdesarmado, totalx_diasrenta, mano_obra, total, ordenCompra, nFactura, Deben, TotalFacturado, TotalPagado, FaltaPorPagar, statusVenta, sp, equipo, area, supervisor,hoja_Entrada, n_proyecto, nFactura FROM `hoja_trabajo` WHERE fchRarmado LIKE '$objeto->anio%' AND clientes_id = '$objeto->clientes_id' $objeto->option AND n_proyecto='$objeto->n_proyecto'  AND status = 'Cerrado' ORDER BY statusVenta DESC") or die("Error: ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function consult_pagoCaratula($objeto){
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT PC.*,C.Opcion FROM pagos_caratula PC INNER JOIN caratulas C ON PC.Caratula_id = C.id_cara WHERE PC.n_Factura = '$objeto->Factura' AND PC.HT_id = '$objeto->id_HT'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }



    //MODULO SMA

        // Insertar solicitud EPP, cuandolo inserta la solicitud el cordinador
    public function Insert_SMA($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO solicitud_movimiento_almacen(planta, solicitante,fecha_solicitada,fch_soli ,nota,piezas, status,peso,no_proyecto,faltantes)
                                                VALUES('$objeto->planta',
                                                       '$objeto->solicitante',
                                                       '$objeto->fecha_solicitada',
                                                       '$objeto->fch_soli',
                                                       '$objeto->nota',
                                                       '$objeto->piezas',
                                                       '$objeto->status',
                                                       '$objeto->peso',
                                                       '$objeto->no_proyecto',
                                                       '$objeto->faltantes')")or die("Errsor : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

        // Insertar solicitud SMA
    public function Insert_SMA2($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "INSERT INTO solicitud_movimiento_almacen(planta, solicitante,fecha_solicitada,fch_soli,nota,piezas, status,peso,no_proyecto,faltantes)
                                                VALUES('$objeto->planta',
                                                       '$objeto->solicitante',
                                                       '$objeto->fecha_solicitada',
                                                       '$objeto->fch_soli',
                                                       '$objeto->nota',
                                                       '$objeto->piezas',
                                                       '$objeto->status',
                                                       '$objeto->peso',
                                                       '$objeto->no_proyecto',
                                                       '$objeto->faltantes')")or die("Ersror : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

   public function mostrar_idSMA($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT MAX(id) AS id FROM `solicitud_movimiento_almacen` WHERE solicitante = '$objeto->user' AND fecha LIKE '$objeto->fecha %'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

   //Update solicitud epp
    public function Update_solicitud_SMA($objeto)                   //mod
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_movimiento_almacen SET fch_soli = '$objeto->fch_soli',
                                                                fecha_solicitada = '$objeto->fecha_solicitada',
                                                                  nota          = '$objeto->nota',
                                                                  piezas         = '$objeto->piezas',
                                                                  status         = '$objeto->status',
                                                                  planta         = '$objeto->planta',
                                                                  peso         = '$objeto->peso',
                                                                  faltantes         = '$objeto->faltantes',
                                                                   no_proyecto       =  '$objeto->no_proyecto'
                                                               WHERE id = '$objeto->id'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

   public function consult_solicitudSMA($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM solicitud_movimiento_almacen WHERE id = '$objeto->id_SMA' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function Update_StatusAuto_SMA($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_movimiento_almacen SET status   = '$objeto->status',
                                                               fch_auto    = '$objeto->fch_auto'
                                                               WHERE id = '$objeto->id_SMA'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

   public function Update_StatusMod_SMA($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_movimiento_almacen SET comentario = '$objeto->comentario',
                                                               status      = '$objeto->status',
                                                               fch_mod    = '$objeto->fch_mod'
                                                               WHERE id = '$objeto->id_SMA'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }

    public function Update_StatusAcep_SMA($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_movimiento_almacen SET status   = '$objeto->status',
                                                               fch_acep    = '$objeto->fch_acep',
                                                               almacen     = '$objeto->almacen'
                                                               WHERE id = '$objeto->id_SMA'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }


   public function Update_StatusProce_SMA($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_movimiento_almacen SET status   = '$objeto->status',
                                                               fch_proc    = '$objeto->fch_proc',
                                                                chofer    = '$objeto->chofer'
                                                               WHERE id = '$objeto->id_SMA'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }



    public function Update_StatusReci_SMA($objeto)
    {
      $conexion = $this->ConectarBD();
      $result = mysqli_query($conexion, "UPDATE solicitud_movimiento_almacen SET status   = '$objeto->status',
                                                               fch_reci    = '$objeto->fch_reci'
                                                               WHERE id = '$objeto->id_SMA'")or die("Error : ".mysqli_error($conexion));
      $this->Cerrar_Conexion($conexion);
      return $result;
    }


    //muestra las solicitudes de SMA
    public function Consultar_solicitud_SMA($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM solicitud_movimiento_almacen   order by id DESC")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }


    public function Consultar_descripcion_piezas($objeto)
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * from precios_pieza where codigo='$objeto->codigo' ")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }



 public function modificar_status_chofer_SMA($objeto)
    {
      $conexion = $this->ConectarBD();

    if($objeto->opcion=='salida'){

           $result = mysqli_query($conexion, "UPDATE solicitud_movimiento_almacen SET salida_chofer   = '$objeto->fecha',
                                                                                      chofer   = '$objeto->chofer'
                                                               WHERE id = '$objeto->id_SMA'")or die("Error : ".mysqli_error($conexion));

    }else if($objeto->opcion=='llegada'){

           $result = mysqli_query($conexion, "UPDATE solicitud_movimiento_almacen SET llegada_chofer   = '$objeto->fecha',
                                                                                      chofer   = '$objeto->chofer'
                                                               WHERE id = '$objeto->id_SMA'")or die("Error : ".mysqli_error($conexion));

    }else if($objeto->opcion=='entregado'){

           $result = mysqli_query($conexion, "UPDATE solicitud_movimiento_almacen SET entrega_material   = '$objeto->fecha',
                                                                                      chofer   = '$objeto->chofer'
                                                               WHERE id = '$objeto->id_SMA'")or die("Error : ".mysqli_error($conexion));

    }



      $this->Cerrar_Conexion($conexion);
      return $result;
    }



  // public function codigos_peso() //muestra todos los codigos dentro de un arreglo
  //   {
  //       $aCodigos = [];
  //       $conexion = $this->ConectarBD();
  //       $result = mysqli_query($conexion, "SELECT almacen.codigo, almacen.descripcion, precios_pieza.peso FROM almacen INNER JOIN precios_pieza on precios_pieza.codigo=almacen.codigo  ORDER BY almacen.id ASC")or die("Error : ".mysqli_error($conexion));
  //       $this->Cerrar_Conexion($conexion);
  //       while ($data = mysqli_fetch_array($result)) {
  //         $aCodigos[$data['codigo']] =  array('descripcion' => $data['descripcion'], 'peso' => $data['peso']);
  //       }
  //       return $aCodigos;
  //   }

    public function Peso_pieza($objeto) //muestra los datos de ese codigo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT * FROM precios_pieza WHERE codigo = '$objeto->codigo'")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function usuarios_planta($planta, $inicio) //muestra los datos de ese codigo
    {
       $conexion = $this->ConectarBD();
       $result = mysqli_query($conexion, "SELECT DISTINCT user_cliente.nombre_userC AS nombre, hoja_trabajo.userC_id AS id_user, user_cliente.correo AS correo FROM hoja_trabajo INNER JOIN user_cliente  ON hoja_trabajo.userC_id = user_cliente.id_userC where clientes_id = $planta AND (fchRarmado >= '$inicio' OR status = 'Abierto' OR fchRdesarmado >= '$inicio') ORDER  BY user_cliente.nombre_userC")or die("Error : ".mysqli_error($conexion));
       $this->Cerrar_Conexion($conexion);
       return $result;
    }

    public function usersAll(){ // PARA TRAER TODOS LOS USUARIOS
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, " SELECT DISTINCT user_cliente.nombre_userC AS nombre, hoja_trabajo.userC_id AS id_user, user_cliente.correo AS correo ,(SELECT nombre FROM clientes WHERE id_cliente=hoja_trabajo.clientes_id) AS cliente FROM hoja_trabajo INNER JOIN user_cliente ON hoja_trabajo.userC_id = user_cliente.id_userC where YEAR(fchRarmado) >= 2022 AND YEAR(fchRarmado) ORDER BY cliente")or die("Error : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function proyectos_planta($user) //muestra los datos de ese codigo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT n_proyecto, COUNT(n_proyecto) AS armados FROM hoja_trabajo WHERE userC_id = $user AND (fchRdesarmado IS NULL OR fchRdesarmado = '0000-00-00') AND YEAR(fchRarmado) >= 2022 GROUP BY n_proyecto")or die("Error1 : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function proyectos_General($user) //muestra los datos de ese codigo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT n_proyecto, COUNT(n_proyecto) AS armados FROM hoja_trabajo WHERE userC_id = $user AND fchRdesarmado IS NULL AND YEAR(fchRarmado) >= 2022 GROUP BY n_proyecto")or die("Error1 : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

    public function folios_planta($user, $proyecto) //muestra los datos de ese codigo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT n_proyecto, area, folio, equipo, fchRarmado, montaje, desmontaje, sp FROM hoja_trabajo WHERE userC_id = $user AND (fchRdesarmado IS NULL OR fchRdesarmado = '0000-00-00') AND YEAR(fchRarmado) >= 2022 AND n_proyecto = $proyecto")or die("Error1 : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }

     public function folios_general($user, $proyecto) //muestra los datos de ese codigo
     {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT n_proyecto, area, folio, equipo, fchRarmado FROM hoja_trabajo WHERE userC_id = $user AND fchRdesarmado IS NULL AND YEAR(fchRarmado) >= 2022 AND n_proyecto = $proyecto")or die("Error1 : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
     }

    public function consultar_proyecto($tipo, $proyecto) //muestra los datos de ese codigo
    {
        $conexion = $this->ConectarBD();
        $result = mysqli_query($conexion, "SELECT  * FROM $tipo WHERE id = $proyecto")or die("Error2 : ".mysqli_error($conexion));
        $this->Cerrar_Conexion($conexion);
        return $result;
    }



    public function proyectos_insa($id) //muestra los datos de ese codigo
    {
       $conexion = $this->ConectarBD();
       $result = mysqli_query($conexion, "SELECT DISTINCT n_proyecto FROM hoja_trabajo where clientes_id = $id AND YEAR(fchRarmado) = 2021 AND statusVenta != 'Facturado'")or die("Error : ".mysqli_error($conexion));
       $this->Cerrar_Conexion($conexion);
       return $result;
    }


    public function folios_proyecto_insa($proyecto) //muestra los datos de ese codigo
    {
       $conexion = $this->ConectarBD();
       $result = mysqli_query($conexion, "SELECT n_proyecto, folio, totalx_diasrenta, mano_obra, TotalFacturado, Deben, statusVenta FROM hoja_trabajo WHERE  YEAR(fchRarmado) = 2021 AND n_proyecto = $proyecto AND statusVenta != 'Facturado'")or die("Error1 : ".mysqli_error($conexion));
       $this->Cerrar_Conexion($conexion);
       return $result;
    }

    public function proyectos_insa_2022($id) //muestra los datos de ese codigo
    {
       $conexion = $this->ConectarBD();
       $result = mysqli_query($conexion, "SELECT DISTINCT n_proyecto FROM hoja_trabajo where clientes_id = $id AND YEAR(fchRarmado) = 2022 AND statusVenta != 'Facturado'")or die("Error : ".mysqli_error($conexion));
       $this->Cerrar_Conexion($conexion);
       return $result;
    }


    public function folios_proyecto_insa_2022($proyecto) //muestra los datos de ese codigo
    {
       $conexion = $this->ConectarBD();
       $result = mysqli_query($conexion, "SELECT n_proyecto, folio, totalx_diasrenta, mano_obra, TotalFacturado, Deben, statusVenta FROM hoja_trabajo WHERE  YEAR(fchRarmado) = 2022 AND n_proyecto = $proyecto AND statusVenta != 'Facturado'")or die("Error1 : ".mysqli_error($conexion));
       $this->Cerrar_Conexion($conexion);
       return $result;
    }

    public function contar_andamios_del_mes($user,$andamios,$inicio,$fin)
    {
       $conexion = $this->ConectarBD();
       $result = mysqli_query($conexion, "SELECT COUNT(folio) AS contador FROM hoja_trabajo WHERE userC_id = $user AND $andamios BETWEEN '$inicio' AND '$fin'")or die("Error1 : ".mysqli_error($conexion));
       $this->Cerrar_Conexion($conexion);
       return $result;
    }































    /***************************************************************************
    ******                          EVENTOS                               ******
    ***************************************************************************/ //NO lo ocupo, solo lo utilizo en lo viejo
    // public function insertar_Eventos($objeto)//inserta datos en eventos cuando se inserta o modifica un registro
    // {
    //     $conexion = $this->ConectarBD();

    //     $result = mysqli_query($conexion, "INSERT INTO eventos(tipo,nombre,usuario)
    //                                        VALUES('$objeto->tipo',
    //                                               '".mysqli_escape_string($conexion,$objeto->nombre2)."',
    //                                               '$objeto->usuario')")or die("Error : ".mysqli_error($conexion));
    //     $this->Cerrar_Conexion($conexion);
    //     return $result;
    // }
}

class Objeto
{
}
