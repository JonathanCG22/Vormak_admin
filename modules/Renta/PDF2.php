<?php
  session_start();
  require_once "../../../config/conexion.php";
    $objeto = new Objeto;
    $crud = new CRUD;
  //_es para poder crear un pdf con la libreria mPDF
  include_once("../../../libreria/mPDF/vendor/autoload.php");

  //_llama la libreria
  $mpdf = new \Mpdf\Mpdf();
  $mpdf -> SetTitle('Reporte Almacen');
  $mpdf -> SetAuthor('VORMAK ANDAMIOS');
  $mpdf -> SetCreator('VORMAK ANDAMIOS');
  $mpdf -> SetSubject('Reporte de Piezas en Almacen');
  $mpdf -> SetKeywords('Piezas Andamio');
      
 

                        $Suma_TPiezas_Copa   = 0;
                        $suma_TPeso_Copa     = 0;
                        $Suma_TPiezas_Roseta = 0;
                        $suma_TPeso_Roseta   = 0;
                        $Suma_TPiezas        = 0;
                        $suma_TPeso          = 0;
                        
                        
                       
                        if ($_GET['id']=="plan") {
                            $almacen = $_GET['idA'];
                            $query = $crud->total_plantas($almacen, "1");
                            $query2 = $crud->total_plantas($almacen, "2"); 

                            $nom = mysqli_fetch_array($crud->obtenerProyecto2($almacen)); 
                            $hoy = date("Y-m-d");
                            $armado = pz_Armadas($hoy, $almacen);

                            $header   = " <header>
                            <div>
                              <img src='../../../images/inventario/encabezado.png' style='width: 100%; padding-top: 5px;'>
                            </div>
          
                            <h4>Stock en planta</h4>
                          </header>";

                        /*
            $codigoHTML ="<body>
            <div style='padding-left: 15px;'>        
              <table id='tabla1' class='table table-bordered table-striped' style='text-align: center; font-size: 12px; border: 2px solid #1f64ad; '>
              <tr><td colspan='3'>MATERIAL TOTAL</td></tr>
              <tr style='background: #1f64ad; font-size: 15px; color: #ffffff; '>
                    <th style='width: 95px; padding: 3px;'>Codigo</th>
                    <th style='width: 275px; padding: 3px;'>Descripci贸n</th>
                    <th style='width: 130px; padding: 3px;'>Categoria</th>
                    <th style='width: 75px; padding: 3px;'>Cantidad</th>
                    <th style='width: 110px; padding: 3px;'>Peso Total</th>
                  </tr>
                  
                  
                  </table>
                  </div>";

*/
                            $codigoHTML ="<body>
                            <div style='padding-left: 15px;'>        
                              <table id='tabla1' class='table table-bordered table-striped' style='text-align: center; font-size: 12px; border: 2px solid #1f64ad; '>
                              <thead class='bg-teal'>
                              <tr><td colspan='3'>MATERIAL TOTAL</td></tr>
                              <tr style='background: #1f64ad; font-size: 15px; color: #ffffff; '>
                                    <th style='width: 95px; padding: 3px;'>Codigo</th>
                                    <th style='width: 275px; padding: 3px;'>Descripci贸n</th>
                                    <th style='width: 75px; padding: 3px;'>Cantidad</th>
                                  </tr>
                                  </thead>
                                    ";
                                                     
                                                     $j=0;
                                                        while ($r = mysqli_fetch_assoc($query)) {
                                                            if ($id == "buy") {
                                                                $stock = $r['stock'] * -1;    
                                                            }elseif ($id == "rent") {
                                                                $stock = $r['stock'];    
                                                            }else{
                                                                $stock = $r['stock'];    
                                                            }                                            
                                                            if($stock < 0){
                                                                $bg = '#fbd6d6;';
                                                            }else{
                                                                $bg = 'transparent;';
                                                            }
                                                            
                                                            if (!codigo_fake($r['codigo'])){
                                                            $codigoHTML .= "<tr>
                                                                <td class='text-center'>".$r['codigo']."</td>
                                                                <td class='text-center'>".$r['descripcion']."</td>                                         
                                                                <td class='text-center' style='background: " .$bg. "'>".$stock."</td>
                                                            </tr>";
                                                            
                                                            $armado[$r['codigo']]['TotalReal'] = $stock;
                                                            //$a[$r['codigo']][$j]= $stock;
                                                            }
                                                        }                
                                                        
                                                                                                                      
                                                        while ($r2 = mysqli_fetch_assoc($query2)) {
                                                            if ($id == "buy") {
                                                                $stock2 = $r2['stock'] * -1;    
                                                            }elseif ($id == "rent") {
                                                                $stock2 = $r2['stock'];    
                                                            }else{
                                                                $stock2 = $r2['stock'];    
                                                            }                                            
                                                            if($stock2 < 0){
                                                                $bg = '#fbd6d6;';
                                                            }else{
                                                                $bg = 'transparent;';
                                                            }
                                                            
                                                            if (codigo_fake($r['codigo'])){
                                                            $codigoHTML .="  <tr>
                                                                <td class='text-center'>".$r2['codigo']."</td>
                                                                <td class='text-center'>".$r2['descripcion']."</td>
                                                                <td class='text-center' style='background: " .$bg. "'>".$stock2."</td>
                                                            </tr>";
                                                            
                                                            $armado[$r2['codigo']]['TotalReal'] = $stock2;
                                                           // $a[$r2['codigo']][$j]= $stock2;
                                                            }
                                                        }
                                                       
                                                        $codigoHTML .="</table> </div>";
                                                        
                                               
                                                
                                                        $codigoHTML .="
                                                    <br><br>
                                                    <div class='col-sm-4 text-center'><!-- Material armado -->
                                                    <table id='tabla2' class='table table-bordered table-striped' style='text-align: center; font-size: 12px; border: 2px solid #1f64ad; '>
                                                    <thead class='bg-teal'>
                                                   <tr><td colspan='3'>MATERIAL ARMADO</td></tr>
                                                   <tr style='background: #1f64ad; font-size: 15px; color: #ffffff; '>
                                                                    <td class='text-center'><strong>Codigo</strong></td>
                                                                    <td class='text-center'><strong>Descripci&oacute;n</strong></td>
                                                                    <td class='text-center'><strong>Cantidad</strong></td>
                                                                </tr>
                                                            </thead>
                                                             ";
 
                                                        mysqli_data_seek($query, 0); //reinicia consulta
                                                        
                                                        while ($r = mysqli_fetch_assoc($query)) {
                                                            if ($id == "buy") {
                                                                $armados = ($armado[$r['codigo']]['TotalArmado']) * -1;    
                                                            }elseif ($id == "rent") {
                                                                $armados = $armado[$r['codigo']]['TotalArmado'];    
                                                            }else{
                                                                $armados = $armado[$r['codigo']]['TotalArmado'];      
                                                            }
                                                            
                                                            if($armado < 0){
                                                                $bg = '#fbd6d6;';
                                                            }else{
                                                                $bg = 'transparent;';
                                                            }
                                                            
                                                            $codigoHTML .=" <tr>
                                                                <td class='text-center'>".$r['codigo']."</td>
                                                                <td class='text-center'>".$r['descripcion']."</td>
                                                                <td class='text-center' style='background: " .$bg. "'>".$armados."</td>
                                                            </tr>";
                                                        
                                                        } 
                                                        
                                                     
                                                        mysqli_data_seek($query2, 0); //reinicia consulta
                                                        
                                                        while ($r2 = mysqli_fetch_assoc($query2)) {
                                                            if ($id == "buy") {
                                                                $armados2 = ($armado[$r2['codigo']]['TotalArmado']) * -1;    
                                                            }elseif ($id == "rent") {
                                                                $armados2 = $armado[$r2['codigo']]['TotalArmado'];    
                                                            }else{
                                                               $armados2 =  $armados = $armado[$r['codigo']]['TotalArmado'];     
                                                            }                                            
                                                            if($armado2 < 0){
                                                                $bg = '#fbd6d6;';
                                                            }else{
                                                                $bg = 'transparent;';
                                                            }
                                                            
                                                            $codigoHTML .=" <tr>
                                                                <td class='text-center'>".$r2['codigo']."</td>
                                                                <td class='text-center'>".$r2['descripcion']."</td>
                                                                <td class='text-center' style='background: " .$bg. "'>".$armados2."</td>
                                                            </tr>";
                                                        
                                                        }
                                                       $codigoHTML.="</table>
                                                       </div>";


                                                       $codigoHTML .="
                                                       <br><br>
                                                       <div class='col-sm-4 text-center'><!-- Material en piso -->
                                                       <table id='tabla2' class='table table-bordered table-striped' style='text-align: center; font-size: 12px; border: 2px solid #1f64ad; '>
                                                       <thead class='bg-teal'>
                                                      <tr><td colspan='3'>MATERIAL EN PISO</td></tr>
                                                      <tr style='background: #1f64ad; font-size: 15px; color: #ffffff; '>
                                                                       <td class='text-center'><strong>Codigo</strong></td>
                                                                       <td class='text-center'><strong>Descripci&oacute;n</strong></td>
                                                                       <td class='text-center'><strong>Cantidad</strong></td>
                                                                   </tr>
                                                               </thead>
                                                                ";
                                                 /*
                                                        $codigoHTML .=" 
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class='col-sm-4'><!-- Material en piso -->
                                                <table class='table table-bordered table-striped table-hover'>
                                                    <thead class='bg-teal'>
                                                    <tr><td colspan='3'>MATERIAL EN PISO</td></tr>
                                                        <tr>
                                                            <td class='text-center'><strong>Codigo</strong></td>
                                                            <td class='text-center'><strong>Descripci&oacute;n</strong></td>
                                                            <td class='text-center'><strong>Cantidad</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";  */ 
                                                        
                                                        mysqli_data_seek($query, 0); //reinicia consulta
                                                        
                                                        while ($r = mysqli_fetch_assoc($query)) {
                                                            if ($id == "buy") {
                                                                $piso = ($armado[$r['codigo']]['TotalReal'] - $armado[$r['codigo']]['TotalArmado']) * -1;    
                                                            }elseif ($id == "rent") {
                                                                $piso = $armado[$r['codigo']]['TotalReal'] - $armado[$r['codigo']]['TotalArmado'];    
                                                            }else{
                                                               $piso = $armado[$r['codigo']]['TotalReal'] - $armado[$r['codigo']]['TotalArmado'];    
                                                            }
                                                            
                                                            if($piso < 0){
                                                                $bg = '#fbd6d6;';
                                                            }else{
                                                                $bg = 'transparent;';
                                                            }
                                                            
                                                            $codigoHTML .=" <tr>
                                                                <td class='text-center'>".$r['codigo']."</td>
                                                                <td class='text-center'>".$r['descripcion']."</td>
                                                                <td class='text-center' style='background: " .$bg. "'>".$piso."</td>
                                                            </tr>";
                                                        } 
                                                        
                                                        mysqli_data_seek($query2, 0); //reinicia consulta
                                                        
                                                        while ($r2 = mysqli_fetch_assoc($query2)) {
                                                            if ($id == "buy") {
                                                                $piso2 = ($armado[$r2['codigo']]['TotalReal'] - $armado[$r2['codigo']]['TotalArmado']) * -1;    
                                                            }elseif ($id == "rent") {
                                                                $piso2 = $armado[$r2['codigo']]['TotalReal'] - $armado[$r2['codigo']]['TotalArmado'];    
                                                            }else{
                                                               $piso2 = $armado[$r2['codigo']]['TotalReal'] - $armado[$r2['codigo']]['TotalArmado'];    
                                                            }                                            
                                                            if($piso2 < 0){
                                                                $bg = '#fbd6d6;';
                                                            }else{
                                                                $bg = 'transparent;';
                                                            }
                                                            
                                                            
                                                       $codigoHTML.="</table>
                                                       </div>";

                                                        } 
                                                           
                            
  $footer  = "  <footer>
  <div>
      <img src='../../../images/inventario/pie.png' style='width: 100%; padding-top: 1%;'>
  </div>
</footer>";

                        }else{

                           
          
            $codigoHTML ="<body>
                            <div style='padding-left: 15px;'>        
                              <table id='tabla1' class='table table-bordered table-striped' style='text-align: center; font-size: 12px; border: 2px solid #1f64ad; '>
                                  <tr style='background: #1f64ad; font-size: 15px; color: #ffffff; '>
                                    <th style='width: 95px; padding: 3px;'>Codigo</th>
                                    <th style='width: 275px; padding: 3px;'>Descripci贸n</th>
                                    <th style='width: 130px; padding: 3px;'>Categoria</th>
                                    <th style='width: 75px; padding: 3px;'>Cantidad</th>
                                    <th style='width: 110px; padding: 3px;'>Peso Total</th>
                                  </tr>";


                        $r = $crud->categoriaPiezas();
                        while ($dato = mysqli_fetch_array($r)) { 
                            
                        if ($_GET['id'] == "comp") {
                           
                         $header   = " <header>
                        <div>
                      <img src='../../../images/inventario/encabezado.png' style='width: 100%; padding-top: 5px;'>
                        </div>
          
                        <h4>Stock de Compras</h4>
                        </header>";

                        $query = $crud->total_compras();   
                        $query2 = $crud->almacen_Calculo();
                        }elseif($_GET['id']=="rent") {
                        $almacen = $_GET['idA'];
                        $query = $crud->total_rentas($almacen);
                        $query2 = $crud->almacen_Calculo();      
                        
                        $header   = " <header>
                        <div>
                      <img src='../../../images/inventario/encabezado.png' style='width: 100%; padding-top: 5px;'>
                        </div>
          
                        <h4>Stock de Layher</h4>
                        </header>";

                        }elseif($_GET['id']=="alm") {
                        $query = $crud->total_almacen_principal("cantidad");
                        $query2 = $crud->almacen_Calculo();

                        $header   = " <header>
                        <div>
                      <img src='../../../images/inventario/encabezado.png' style='width: 100%; padding-top: 5px;'>
                        </div>
          
                        <h4>Stock de almacen Central</h4>
                        </header>";

                        }
                         // $query = $crud->total_compras();
                         // $query2 = $crud->almacen_Calculo();
                          $n = 0;

                          while ($data = mysqli_fetch_array($query) and $data2 = mysqli_fetch_array($query2)) {
                            if ($dato['categoria'] == $data['categoria']) {
                              if ($_GET['id'] == "comp") { $cantidad = ($data['stock'] * -1 ); }elseif($_GET['id']=="rent") { $cantidad = $data['stock']; }
                              elseif($_GET['id']=="alm") {$cantidad =  $data['stock'] ; }
                              $TOTAL_Peso = $cantidad * $data2['peso'];
                              
                              if (($n % 2) != 0) {
                                $col = '#ebf0fa';
                              }else{
                                $col = '#ffffff';
                              }
                              
  $codigoHTML .="             <tr style='background:". $col ."'>
                                  <td style='border-right: 2px solid #1f64ad;'>". $data['codigo'] ."</td>
                                  <td style='border-right: 2px solid #1f64ad;'>". $data['descripcion'] ."</td>
                                  <td style='border-right: 2px solid #1f64ad;'>". $data['categoria'] ."</td>
                                  <td>". $cantidad."</td>
                                  <td style='width: 15%; padding-right: 10px; text-align: right'>". number_format($TOTAL_Peso,2,'.',',') ." Kg.
                                  </td>  
                              </tr>";

                              if ($data['Tipo'] == 'Copa') {
                                $Suma_TPiezas_Copa = $Suma_TPiezas_Copa + $data['cantidad'];
                                $suma_TPeso_Copa   = $suma_TPeso_Copa + $TOTAL_Peso;

                              }else if ($data['Tipo'] == 'Roseta') {
                                $Suma_TPiezas_Roseta = $Suma_TPiezas_Roseta + $data['cantidad'];
                                $suma_TPeso_Roseta   = $suma_TPeso_Roseta + $TOTAL_Peso;
                              }
                             
                              $Suma_TPiezas = $Suma_TPiezas + $data['cantidad'];
                              $suma_TPeso   = $suma_TPeso + $TOTAL_Peso;
                              
                              $n++;
                            }
                          }
                           mysqli_free_result($query);
                        } 
                    
                        mysqli_free_result($r);

  $codigoHTML .="       <tr>
                          <td colspan='2' style='border-top: 2px solid #1f64ad; border-right: 2px solid #1f64ad; background: grey'></td>
                          <td style='border-top: 2px solid #1f64ad; border-right: 2px solid #1f64ad; background: #1f64ad; color: white'><strong>TOTAL</strong></td>
                          <td style='border-top: 2px solid #1f64ad;'>". number_format($Suma_TPiezas, 0, '', ',') ." pz</td>
                          <td style='border-top: 2px solid #1f64ad;  text-align: right'>". number_format($suma_TPeso, 2, '.', ',') ." Kg</td>
                        </tr>
                    </table>
                  </div>
                  <br>

                  <table id='tabla1' class='table table-bordered table-striped' style='text-align: center; font-size: 12px;'>
                    <tr>
                      <td style='width: 250px; color: red;'>TIPO COPA</td>
                      <td style='width: 250px; color: red;'>TIPO ROSETA</td>
                      <td style='width: 250px; color: red;'>AMBOS</td>
                    </tr>

                    <tr>
                      <td>Total de Piezas: ". number_format($Suma_TPiezas_Copa,0,'',',') ." pz.</td>
                      <td>Total de Piezas: ". number_format($Suma_TPiezas_Roseta,0,'',',') ." pz.</td>
                      <td>Total de Piezas: ". number_format($Suma_TPiezas,0,'',',') ." pz.</td>
                    </tr>

                    <tr>
                      <td>Total de Peso: ". number_format($suma_TPeso_Copa,2,'.',',') ." Kg.</td>
                      <td>Total de Peso: ". number_format($suma_TPeso_Roseta,2,'.',',') ." Kg.</td>
                      <td>Total de Peso: ". number_format($suma_TPeso,2,'.',',') ." Kg.</td>
                    </tr>
                      
                    </tr>
                  </table>
                </body>";


                
  $footer  = "  <footer>
  <div>
      <img src='../../../images/inventario/pie.png' style='width: 100%; padding-top: 1%;'>
  </div>
</footer>";

                    }

  

  //Margenes
  $mpdf -> SetTopMargin(44);
  $mpdf -> SetAutoPageBreak(true, 15);//bottom
  
  //escribe en el objeto  
  $mpdf -> SetHTMLHeader($header);  
  //$mpdf -> SetFooter("Pagina {PAGENO} de {nb}",$footer); Pagina
  $mpdf -> SetHTMLFooter($footer);
  $mpdf -> WriteHTML($codigoHTML);  
  
  //genera el archivo pdf
  if (empty($_GET['s'])) {
    $mpdf -> Output('Materiales_pdf.pdf', 'I');

  }else if (isset($_GET['s']) && $_GET['s'] == 1) {
    $mpdf -> Output('Materiales_pdf.pdf','D'); 
  }  
?>


<?php

function codigo_fake($cadena){
  $verdad = false;
  
  for ( $i=0; $i<strlen($cadena); $i++){
  for($j=0; $j <10; $j++){
  if(substr($cadena, $i) == ""+$j){
  $verdad = true;
  }else{
    $verdad = false;
  }
  if(!$verdad){
    break;
  }
  }
  }
return $verdad;
}


function pz_Armadas($hoy, $almacen){
    require_once "../../../modules/inventario/almacen/consultas.php"; //carpeta movimientos
    $crud2 = new CRUD_IAlmacen;
    $objeto2 = new Objeto_IAlmacen;
    
    //Busco los proyectos que tengan el mismo nombre de almacen, y los gunto (50003,50050,50031)
    $objeto2->almacen = $almacen;
    $resultado = $crud2->ProyectosConAlmacen2($objeto2);
    
    $Proyectos = $resultado;//"'50003','50050','50031'";
    //$id_cliente = '6';
    
    $objeto2->hoy = $hoy;
    //$objeto2->cosulta = " AND clientes_id = '".$id_cliente."' AND n_proyecto in (".$Proyectos.")";
    
    if($Proyectos == ''){
        $armados = [];
    }else{
       $objeto2->cosulta = " AND n_proyecto in (".$Proyectos.")"; 
       $armados = $crud2->Buscar_PiezasArmadas($objeto2);
    }

    //recorrer codigos y sacar total pz armadas
    $cod = $crud2->codigos2();
    $aArmado = [];
    
    
    foreach ($cod as $key => $value) {  //ciclo Codigos 
        $total = 0;
        
        foreach ($armados as $key2 => $val) { //ciclo folios activos
          
          if($key == ''){//codigo sin nombre 'Rueda de pin 12'
            $buscarCodigo = ',:';
          }else{
            $buscarCodigo = $key. ':';
          }
          
          if (stripos($val['piezas'], $buscarCodigo) !== false) { //busca que exista pieza en cadena
            $sep2 = explode(",", $val['piezas']);
    
            foreach ($sep2 as $keyy => $valuee) { //ciclo piezas (separa de cadena piezas)
              $buscarCodi = $key. ':';
              
              if (stripos($valuee, $buscarCodi) !== false) { //buscar que exista
                $sep3 = explode(":", $valuee);
                
                if($sep3[0] == $key){
                    $total = $total + $sep3[1];
                    break;
                }
              }
            }        
          }      
        }
        $aArmado[$key]['TotalArmado'] = $total;
    }
    
    return $aArmado;
}
?>