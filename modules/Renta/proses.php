<?php
session_start();
require_once "../../config/conexion.php";
$objeto = new Objeto;
$crud = new CRUD;

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {
    if (isset($_GET['act']) && $_GET['act'] =='insertar_salida') {
        if (isset($_POST['Guardar'])) {
        $a = $_POST['bandera'];  
        $quer = $crud->crear_folio($a, $_POST['cliente_1']);
        $quer = $crud->consulta_folio(); $Folio = mysqli_fetch_assoc($quer);  
       
        //echo $Folio['Folio'];
        $i=1;
        while($i <= $a){
          
        $ne = $_POST['codigo_'.$i];
        $modelo = $_POST['modelo_'.$i];
        $descrip = $_POST['descrip_'.$i];
        $plan = $_POST['lista_'.$i]; 
        $cantidad = $_POST['cant_'.$i];
        //$cliente = $_POST['cliente_'.$i];
        $fecha = $_POST['fechai_'.$i];
        //$total = $_POST['itotal_'+$i];
       
        $objeto->fol = $Folio['Folio'];
        $idne = explode("*",$ne); //Separo NE de equipo
        $idp  = explode("*", $plan); //Separo el ID_Plan del costo
        $total =$idp[0]* $cantidad;  //Obtengo el total multiplicando Costo x cantidad.
        $objeto->idne   = $idne[1];
        $objeto->plan  = $idp[1];
       // $objeto->cliente  = $cliente;
        $objeto->cantidadt  = $cantidad;
        $objeto->fechai  = $fecha;
        //$objeto->hora  = $hora;
        
        //consulta mas nuevo uy extrae de ahi

        
        $quer = $crud->consulta_ultimo_check($idne[1]);
        $datoscheck = mysqli_fetch_assoc($quer);
        //Se extraen los siguientes datos de la base de datos
        
        
        $objeto->horometro  = $datoscheck['Horometro'];
        $objeto->diesel  = $datoscheck['Diesel'];
        $objeto->ubicacion  = $datoscheck['Ubicacion'];
        $objeto->total  = $total;
        $objeto->aceite  = $datoscheck['Nivel_de_aceite'];
        $objeto->refrigerante    = $datoscheck['Nivel_de_refrigerante'];
        $objeto->marcab  = $datoscheck['Marca_de_bateria'];
        $objeto->llavea           = $datoscheck['Llave_de_arranque'];
        $objeto->radiador          = $datoscheck['Tapon_de_radiador'];
        $objeto->combustible           = $datoscheck['Tapon_combustible'];
        $objeto->tuercas  = $datoscheck['Tuercas_mariposas'];
        $objeto->selectores           = $datoscheck['Selectores'];
        $objeto->interruptores           = $datoscheck['Interruptores'];
        $objeto->contactos           = $datoscheck['Contactos'];
        $objeto->focos           = $datoscheck['Focos_micas'];
        $objeto->mastil           = $datoscheck['Cable_mastil'];
        $objeto->llantas           = $datoscheck['Llantas'];
        $objeto->remolque           = $datoscheck['Estructura_remolque'];
        $objeto->patin           = $datoscheck['Gato_patin'];
        $objeto->tiron           = $datoscheck['Tiron'];
        $objeto->cadenas           = $datoscheck['Cadenas_de_seguridad'];
        $objeto->matachispas           = $datoscheck['Matachispas'];
        $objeto->condiciones  = $datoscheck['Condiciones_fisicas'];
        $objeto->accesorios  = $datoscheck['Accesorios_adicionales'];
  
        //insertar renta
        if(!empty($_POST['codigo_'.$i])){
        $query = $crud->agregar_renta_E($objeto);
        //Actualizar disponibilidad
        $query = $crud->actualizar_disponibilidad_E($idne[1], 5);
        }
        $i++;
      if($query){
        if ($i >= $a) {
          echo "<script>location.href='../../main.php?module=Renta_Equipo&alert=1';</script>";
          } }
        }

      

           
        }
    }else if (isset($_POST['dato']) && $_POST['dato'] == "datos_codigos") {
        
      // $palabra = explode(",", $_POST['ne']);
      //echo $palabra[0];
      // $palabras = explode(",", $_POST['ne']);
        ?>
    <SELECT class="form-control" id="codigo_<?php echo $_POST['a']; ?>"  NAME="codigo_<?php echo $_POST['a']; ?>" > 
		<?php  
		 $quer = $crud->consultar_inventario_E_D();
     $j=0;
      while ($dat = mysqli_fetch_assoc($quer)) {  if($j==0){?> <option value="0">Selecciona un equipo</option><?php $j++; } ?>
     <?php 
     $palabras = explode(",", $_POST['ne']); 
     $result = TRUE;
     for ($i=1; $i <= $_POST['bandera']; $i++){
     $ne = explode("*", $palabras[$i]); 
     if(strcmp($ne[1], $dat['NE']) == 0){
     $result = FALSE;
     }
     }
     if($result == TRUE){ ?>
      <option tipo="<?php echo $dat['ID_Tipo']; ?>" descripcion="<?php echo $dat['Descripcion']; ?>" value="<?php echo $dat['ID_Tipo']."*".$dat['NE']; ?>" title="<?php echo $dat['Modelo']; ?>"><?php echo $dat['NE'];  echo $palabras[$i];  echo $_POST['bandera']; ?> </option>
      <?php }
     } //terminacion while?> 
		  </SELECT>    
   <?php
  
    }elseif (isset($_GET['act']) && $_GET['act'] =='limpiar_tabla') {
          ?>
     <thead>
                  <tr bgcolor="black" >
                    <th colspan="13" style="text-align: center; color: gold; font-size: 15px; "><strong>EQUIPOS QUE VAN A SALIR</strong>
                    </th>
                  </tr>

                  <tr bgcolor="Coral">
                    <th colspan="2" style="text-align: center;" width="70px">NE</th>
                    <th colspan="2" style="text-align: center;" width="200px">MODELO</th>
                    <th colspan="1" style="text-align: center;" width="80px">DESCRIPCIÓN</th>
                    <th colspan="2" style="text-align: center;" width="80px">PLAN DE RENTA</th>
                    <th colspan="1" style="text-align: center;" width="80px">CANTIDAD DEL PLAN</th>
                    <th colspan="1" style="text-align: center;" width="80px">CLIENTE</th>
                    <th colspan="1" style="text-align: center;" width="200px">FECHA DE SALIDA</th>
                    <th colspan="2" style="text-align: center;" width="80px">TOTAL</th>
                    <th> </th>
                  </tr>
                </thead>

                    <tbody id="material">
                      <tr id="1" onclick="recargarCodigos(2,0);">
                        <td colspan='2'>
                          <select id='codigo_1' name='codigo_1' class='form-control' <?= $required ?> onchange="descripcionCodigo(1,0)">
                            <option value='' selected=''></option>
                          </select>
                        </td>

                        <td colspan='2'>
                          <label id='modelo_1' name='modelo_1'></label>
                          <div id="alert_1" ></div>
                        </td>
                        
                        <td>
                          <label id='descrip_1' name='descrip_1'     >
                        </td>

                        <td colspan='2'>
                        <div class="form-group"  onchange="recargarLista2(1);">
                        <div class="col-sm-7" id="listaview_1">
                      </div>
                      </div>
                        </td>

                        <td >
                        <div class="form-group">
        <div class="col-sm-7">
        <input type="text" maxlength="4" id="cant_1" name="cant_1" placeholder="1 o 2 o 3" class="form-control" required="required" oninput="recargarLista2(1);">
        </div>
        </div>
                </td>

        <td> 

            <div class="form-group" >
                      <div class="col-sm-7" id="listac_1">
                      <SELECT class="form-control" id="cliente_1"  NAME="cliente_1" > 
                      <?php  
                     $quer = $crud->clientes_A();
                      $i=0;
                      while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona un equipo</option><?php $i++; } ?>
                      <OPTION value="<?php echo $dat['ID_clientes']; ?>"><?php echo $dat['Razon_Social'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      </div>
        </td>

        
                        <td colspan='1'>
                        <div class="form-group">
            <div class="col-sm-7">
            <input type="date" id="fechai_1" name="fechai_1" class="form-control" required="required" maxlength="15">
            </div>
            </div>
                        </td>
                        <td colspan="2">
                        <div class="form-group" width='80px'>
           <div id= "itotal_1" class="col-sm-7" >
           </div>
           </div>
                        </td>
            
          
            
                        <td ></td>
                      </tr>  

                </tbody>
      <?php
    }elseif (isset($_GET['act']) && $_GET['act'] =='update_renta') {
        if (isset($_POST['Guardar'])) {
            $objeto->idr = $_POST['idr'];
            $idne = explode("*",$_POST['lista1']); //Separo NE de equipo
            $idp  = explode("*",$_POST['lista2']); //Separo el ID_Plan del costo

            $total =$idp[0]* $_POST['cantidadt'];  //Obtengo el total multiplicando Costo x cantidad.
            $objeto->idne   =$idne[1];
            $objeto->plan  = $idp[1];
            $objeto->cantidadt  = $_POST['cantidadt'];
            $objeto->fechai  = $_POST['fechainicio'];
            $objeto->hora  = $_POST['hora'];
            $objeto->horometro  = $_POST['horometro'];
            $objeto->diesel  = $_POST['diesel'];
            $objeto->ubicacion  = $_POST['ubicacion'];
            $objeto->total  = $total;
            $objeto->aceite  = $_POST['aceite'];
            $objeto->refrigerante           = $_POST['refrigerante'];
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

                $query = $crud->actualizar_renta_E($objeto);

                if ($query) {
                    echo "<script>location.href='../../main.php?module=Renta_Equipo&alert=2';</script>";
                
            }
        }
    } elseif (isset($_GET['act']) && $_GET['act'] =='recargar_plan') { //Lista de planes
            if (isset($_POST['idt'])) {
      $idt=$_POST['idt'];
      $idt = explode("*",$idt);  // Separo ID_Tipo, NE
      $vista = explode("-", $_POST['idt']);  //Separo la vista desde donde viene "m" = modal "v" = view
      $quer = $crud-> consulta_planes_E($idt[0]);
      $filas= mysqli_num_rows($quer);
      if(strcmp($vista[1], "v") == 0){// <select  class='form-control' id='lista_<?php echo $_POST['a']; ?><?php //' name='lista_<?php echo $_POST['a']; '>?> <?php }else{?> <select  class='form-control' id='listam' name='lista2' > <?php }
      while ($dat = mysqli_fetch_assoc($quer)) {
     echo "<div style='margin-bottom:30px;'>";   
     echo '<label  for="title" class="col-sm-4 control-label">'.$dat['Descripcion'].'</label>';                     
     echo "</div>";
     echo '<input type="hidden" name="lista_'.$_POST['a'].$dat['ID_Plan'].'" id="lista_'.$_POST['a'].$dat['ID_Plan'].'" value='.$dat['Costo']."*".$dat['ID_Plan'].'>';            
     echo '<input name="cant_'.$_POST['a'].$dat['ID_Plan'].'" id="cant_'.$_POST['a'].$dat['ID_Plan'].'" type="number"   style="width:50px;">';
     
    }
     echo '<input type="hidden"  id="fila_'.$_POST['a'].'" value='.$filas.'>';            
      //echo  "</select>";
            }
    } elseif (isset($_GET['act']) && $_GET['act'] =='recargar_clientes') { //Lista de planes
        if (isset($_POST['a'])) {  ?>
 
         <SELECT class="form-control" id="cliente_<?php echo $_POST['a']; ?>"  NAME="cliente_<?php echo $_POST['a']; ?>" > 
		  <?php  
		 $quer = $crud->clientes_A();
		  $i=0;
		  while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona cliente</option><?php $i++; } ?>
		  <OPTION value="<?php echo $dat['ID_clientes']; ?>"><?php echo $dat['Razon_Social'];?></OPTION>
		  <?php } //terminacion while?> 
		  </SELECT>    
  
   <?php } }elseif (isset($_GET['act']) && $_GET['act'] =='calculartotal') {
        if (isset($_POST['costo'])) {
            $palabra = explode(",", $_POST['costo']);
           
            $i=1;
            $total=0;
            while($i <= $_POST['l']){
              $costoycantidad=$palabra[$i];
            $costo=explode("*",$costoycantidad);//divido la cadena en 2, $costo[0] es el costo del plan y $costo[1] es el ID_Plan y la cantidad.
            $costo[1]=substr($costo[1],1,strlen($costo[1])); //Corto el id_plan de la cadena y solo me quedo con la cantidad.
           
            $total = $total + ($costo[0]*$costo[1]);
           
            $i++;  
            }
           
            echo "<input type='text' id='total_".$_POST['a']."' name='total' class='form-control' value=$".($total-(($total)*$_POST['des'] /100))." required='required' maxlength='30' disabled>";
                
          
        }
}elseif (isset($_GET['act']) && $_GET['act'] =='crear_folio') {
    if (isset($_POST['fol'])) {
        
        $variables = explode("*",$_POST['fol']);
        $objeto->descripcion  = $variables[0];
        $objeto->equipos  = $variables[1];
        $query = $crud->crear_folio($objeto);
       //if ($query) {
       //   echo "<script>location.href='../../main.php?module=Renta_Salida';</script>";
       //}
        
    }
}elseif (isset($_GET['act']) && $_GET['act'] =='equipos_faltantes') {
$quer = $crud->consulta_folio(); $dat = mysqli_fetch_assoc($quer);  $dat2 = mysqli_fetch_row($crud->consulta_equipos_insertados());
$dat2= $dat['Cuantos_equipos']-$dat2[0];
echo "<input type='text' id='equipos' name='equipos' class='form-control' value=".$dat2." maxlength='30' disabled>";
}
elseif (isset($_GET['act']) && $_GET['act'] =='cancelar_folio_rentas') {
    $quer = $crud->consulta_folio(); $dat = mysqli_fetch_assoc($quer);
  $objeto->folio = $dat['Folio'];
    $crud->eliminar_folio($objeto);  

}











elseif (isset($_GET['act']) && $_GET['act'] =='body_m') {
    
    if (isset($_POST['idf'])) {
    $variables = explode("*",$_POST['idf']);
    if(count($variables) <= 3 ){
      
    ?> 
<div class="form-group" >
      <label for="title" class="col-sm-4 control-label">Salidas:</label>
      <div class="col-sm-7"  >
      <SELECT class="form-control" id="rentas"  NAME="rentas" maxlength="5" onchange="bodym();"> 
      <?php  
      $quer = $crud->consulta_salidas_de_un_folio($variables[2]);
       $i=0;
      while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona una salida</option><?php $i++; } ?>
      <OPTION value="<?php echo $dat['ID_Renta']."*".$dat['NE']."*".$dat['Folio']; ?>" <?php if($variables[0]==$dat['ID_Renta']){ ?> selected <?php } ?> ><?php echo $dat['ID_Renta'];?>&nbsp;&nbsp;&nbsp;<?php $cons = $crud->consultar_Cliente_A($dat['ID_clientes']); $cliente = mysqli_fetch_assoc($cons); echo $cliente['Razon_Social']; ?></OPTION>
      <?php } //terminacion while?> 
      </SELECT>    
      </div>
      </div>
<?php
     $quer = $crud->consulta_rentas_E($variables[0]);
     $data = mysqli_fetch_assoc($quer);
       $quer = $crud->consultar_inventario_E();
       $i=0;
       echo " <div class='form-group' >
       <label for='title' class='col-sm-4 control-label'>Equipo:</label>
       <div class='col-sm-7'  >";
       echo "<SELECT class='form-control' id='lista1'  name='lista1' maxlength='5' onchange='recargarListam();'> ";
       while ($dat = mysqli_fetch_assoc($quer)) { if($i==0){?> <option value="0">Selecciona un equipo</option><?php $i++; } ?>  
        <OPTION value="<?php echo $dat['ID_Tipo']."*".$dat['NE']; ?>" <?php if($data['NE']==$dat['NE']){ ?> selected <?php } ?> ><?php echo $dat['NE'];?>&nbsp;&nbsp;&nbsp;<?php echo $dat['Descripcion'];?></OPTION>
       <?php } 
       echo  "</select>
       </div>
       </div>";
       echo "<script> recargarListam(); </script>"; ?>
     
     <div class="form-group" >
           <label for="title" class="col-sm-4 control-label">Planes:</label>
            <div class="col-sm-7" id="planesmodal" onchange='recargartotalm();'>
            </div>
    </div>


  <div class="form-group">
<label for="title" class="col-sm-4 control-label">Cantidad de tiempo:</label>
<div class="col-sm-7">
<input type="text" maxlength="4" id="cantm" name="cantidadt" value="<?php echo $data['Cantidad_Tiempo']; ?>" placeholder="Escribe la cantidad del plan elegido, ejemplo: 2 dias (Solo pon la cantidad)." class="form-control" required="required" oninput="recargartotalm();">
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Fecha inicio:</label>
<div class="col-sm-7">
<input type="date" id="fechai" name="fechainicio" value="<?php echo $data['Fecha_Inicio']; ?>" class="form-control" required="required" maxlength="15">
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Hora:</label>
<div class="col-sm-7">
<input type="time" id="hora" name="hora" class="form-control" value="<?php echo $data['Hora']; ?>" required="required" maxlength="15">
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Horometro:</label>
<div class="col-sm-7">
<input type="number" id="horometro" name="horometro" value="<?php echo $data['Horometro']; ?>" class="form-control" required="required" maxlength="15">
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Diesel:</label>
<div class="col-sm-7">
<input type="number" id="diesel" name="diesel" value="<?php echo $data['Diesel']; ?>" class="form-control" required="required" maxlength="15">
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Ubicacion:</label>
<div class="col-sm-7">
<input type="text" id="ubicacion" name="ubicacion" value="<?php echo $data['Ubicacion']; ?>" class="form-control" required="required" maxlength="35">
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Total:</label>
<div id= "itotal_m" class="col-sm-7">
<input type="text" id="total" name="total" value="<?php echo $data['Total']; ?>" class="form-control" required="required" maxlength="35" disabled>
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Marca de bateria:</label>
<div class="col-sm-7">
<input type="text" id="marcabateria" name="marcabateria" class="form-control" value="<?php echo $data['Marca_de_bateria']; ?>" required="required" maxlength="15">
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Condiciones fisicas:</label>
<div class="col-sm-7">
<input type="text" name="condiciones" class="form-control" value="<?php echo $data['Condiciones_fisicas']; ?>" required="required" maxlength="30">
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Tuercas, Mariposas:</label>
<div class="col-sm-7">
<input type="text" id="tuercas" name="tuercas" class="form-control" value="<?php echo $data['Tuercas_mariposas']; ?>" required="required" maxlength="10" >
</div>
</div>

<div class="form-group">
<label for="title" class="col-sm-4 control-label">Accesorios adicionales:</label>
<div class="col-sm-7">
<input type="text" id="accesorios" name="accesorios" class="form-control"  value="<?php echo $data['Accesorios_adicionales']; ?>" required="required" maxlength="10" >
</div>
</div>


<div>
        <input type="checkbox" id="aceite" name="aceite" value="1" <?php  if($data['Nivel_de_aceite']==1){?> checked<?php } ?> >
        <label for="scales">Nivel de aceite</label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="refrigerante" name="refrigerante" value="1" <?php  if($data['Nivel_de_refrigerante']==1){?> checked<?php } ?> >
       <label for="horns">Nivel de refrigerante</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="llavea" name="llavea" value="1" <?php  if($data['Llave_de_arranque']==1){?> checked<?php } ?> >
       <label for="horns">Llave de arranque</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="radiador" name="radiador" value="1" <?php  if($data['Tapon_de_radiador']==1){?> checked<?php } ?> >
       <label for="horns">Tapon de radiador</label>
        </div>
       <div>
       <input type="checkbox" id="combustible" name="combustible" value="1" <?php  if($data['Tapon_combustible']==1){?> checked<?php } ?> >
       <label for="horns">Tapon combustible</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="selectores" name="selectores" value="1" <?php  if($data['Selectores']==1){?> checked<?php } ?> >
       <label for="horns">Selectores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="interruptores" name="interruptores" value="1" <?php  if($data['Interruptores']==1){?> checked<?php } ?> >
       <label for="horns">Interruptores</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="contactos" name="contactos" value="1" <?php  if($data['Contactos']==1){?> checked<?php } ?>  >
       <label for="horns">contactos</label>
       </div>
       <div>
       <input type="checkbox" id="focos" name="focos" value="1" <?php  if($data['Focos_micas']==1){?> checked<?php } ?> >
       <label for="horns">Focos y micas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="mastil" name="mastil" value="1" <?php  if($data['Cable_mastil']==1){?> checked<?php } ?>   >
       <label for="horns">Cable mastil</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="llantas" name="llantas" value="1" <?php  if($data['Llantas']==1){?> checked<?php } ?> >
       <label for="horns">Llantas</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="remolque" name="remolque" value="1" <?php  if($data['Estructura_remolque']==1){?> checked<?php } ?> >
       <label for="horns">Estructura remolque</label>
       </div>
       <div>
       <input type="checkbox" id="patin" name="patin" value="1" <?php  if($data['Gato_patin']==1){?> checked<?php } ?>  >
       <label for="horns">Gato patin</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="tiron" name="tiron" value="1" <?php  if($data['Tiron']==1){?> checked<?php } ?>  >
       <label for="horns">Tiron</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="cadenas" name="cadenas" value="1" <?php  if($data['Cadenas_de_seguridad']==1){?> checked<?php } ?>  >
       <label for="horns">Cadenas de seguridad</label>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="matachispas" name="matachispas" value="1" <?php  if($data['Matachispas']==1){?> checked<?php } ?> >
       <label for="horns">Matachispas</label>
       </div>
       <input type="hidden" name="idr" value="<?php echo $data['ID_Renta']; ?>">

<div>
    
<?php 

}

    }
}elseif (isset($_GET['act']) && $_GET['act'] =='botonesm') {
    if (isset($_POST['idf'])) {
        $variables = explode("*",$_POST['idf']);
        $quer = $crud->consulta_rentas_E($variables[0]);
        $data = mysqli_fetch_assoc($quer); ?>
             <a class='btn btn-danger btn-secondary' id="<?php echo $_POST['idf']; ?>" style='margin-right:5px; margin-top: 5px;' onclick="openModal(this, 'update_cliente', 'R1')"  title='Agregar entrada' >
      <i class="fas fa-sign-in-alt"></i> Entrada </a> 
      <a class='btn btn-danger btn-secondary' style='margin-right:5px; margin-top: 5px;' href='modules/Renta/reporte_renta/PDF.php?nR=<?php echo $data['ID_Renta'];?>'  title='Abrir PDF' data-toggle='tooltip' target='_blank'>
      <i class="glyphicon glyphicon-download-alt"></i> PDF </a>    
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      <input type="submit" class="btn btn-primary" id="button" name="Guardar" value="Actualizar"  >
    <?php }
}elseif (isset($_GET['act']) && $_GET['act'] =='prueba_verificar') {
  

  $ne = explode("*",$_POST['codigo_1']);
  $quer = $crud->consulta_ultimo_check($ne[1]); //$dat = mysqli_fetch_assoc($quer);
 
   ?> <br> <?php
  echo $quer;

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
