<?php
require_once "../../../config/conexion.php";
    $objeto = new Objeto;
    $crud = new CRUD;
  
    if (!empty($_GET['nR'])) {
      //echo $_GET['nR'];
      $id = $_GET['nR'];
 }
 $consulta = $crud->consulta_rentas_E($id);  $data = mysqli_fetch_assoc($consulta);
 $consulta = $crud->consulta_folio2($data['Folio']);  $datos = mysqli_fetch_assoc($consulta);
 $consulta = $crud->consulta_inventario_E($data['NE']);  $datos2 = mysqli_fetch_assoc($consulta);

 function  comprobar($valor){
if($valor==1){
   return "V";
}else{
   return "F";
}
 };

include_once("../../../libreria/mPDF/vendor/autoload.php");
// $mpdf = new \Mpdf\Mpdf(['orientation' => 'L'],'A4'); CAMBIAR LA ORIENTATION
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle('FORMATO CHACON ');
$mpdf->SetAuthor('CHACON');
$mpdf->SetCreator('ARRENDADORA CHACON');
$mpdf->SetSubject('formato material-renta');
$mpdf->SetKeywords('PDF-1');
$css = file_get_contents('pdf.css');
 
$header = "
        <header class='color-secundario header' >
      
                 
                     <table class='tablaPDF' style='width:100%'>
                        <tr>
                          <td rowspan='6'><img src='logo.png' style='width:110px;'></td>
                          
                          <td colspan='2'><strong><h2>Arrendadora Chacon S.A de C.V</h2></strong></td>
                         
                        </tr>
                          <tr><td colspan='2'>Calle Justo Sierra No. 112 Col.Universidad Sur, Cd.Madero Tamps C.P 89109</td></tr>
                          <tr>
                            <td>RFC. ACA - 131211-SY5</td>
                            <td>Tel.833-575-99-18; Cel.833-402-42-49</td>
                          </tr>
                          <tr><td colspan='2'>rentas@chaconmx.com; pablo.rincon@chaconmx.com</td></tr>
                          <tr><td colspan='2'><strong class='letras-space'>CHECK LIST EQUIPOS</strong></td></tr>
                          <tr><td colspan='2'><strong><h4>DATOS GENERALES</h4></strong></td></tr>
                     </table>
         
        </header>";

// es el cuerpo del documento del
$codigoHTML = "<body>
                    
                   <table>
                            <tr>
                               <td width='100px'><strong>CLIENTE</strong>:</td>
                               <td colspan='5' style='border-right:none'>".$datos['Nombre']."</td>
                               <td colspan='3' style='text-align:right;font-size:18px;border-left:none;'><strong class='folio' >FOLIO: ".$data['ID_Renta']."</strong></td>
                            </tr>
                      
                            <tr>
                               <td><strong>EMPRESA:</strong></td>
                               <td colspan='8'>".$datos['Razon_Social']."</td>
                            </tr>
                      
                            <tr>
                               <td><strong>EQUIPO:</strong></td>
                               <td colspan='6'>".$datos2['Modelo']."    ".$datos2['Descripcion']."</td>
                               <td width='100px'><strong>SERIE:</strong></td>
                               <td>".$datos2['NE']."</td>
                            </tr>

                   </table>
                   <table class='tablaDatos'>
                     
                      <tr>
                          <td colspan='4' style='text-align:center;background:#600003;color:#fff;'><strong>SALIDA DEL EQUIPO</strong></td>
                           
                       

                          <td  colspan='4' style='background:#d90429;color:white;text-align:center;'><strong>INGRESO DEL EQUIPO</strong></td>
                      </tr>

                      <tr>
                            <td width='200'><strong>FECHA</strong></td>
                            <td>".$data['Fecha_Inicio']."</td>
                            <td><strong>HORA</strong></td>
                            <td>".$data['Hora']."</td>
                            <td  width='200'><strong>FECHA</strong></td>
                            <td></td>
                            <td><strong>HORA</strong></td>
                            <td></td>
                      </tr>
                      <tr>
                          <td><strong>ECONOMICO</strong></td>
                          <td  colspan='3'>".$datos2['NE']."</td>
                        
                          <td><strong>ECONOMICO</strong></td>
                          <td  colspan='3'></td>
                      </tr>
                      <tr>
                          <td><strong>HOROMETRO</strong></td>
                          <td  colspan='3'>".$data['Horometro']."</td>
                          <td><strong>HOROMETRO</strong></td>
                          <td  colspan='3'></td>
                      </tr>
                      <tr>
                          <td><strong>DISEL</strong></td>
                          <td  colspan='3'>".$data['Diesel']."</td>
                          <td><strong>DISEL</strong></td>
                          <td  colspan='3'></td>
                      </tr>
                      <tr>
                          <td><strong>UBICACION</strong></td>
                          <td  colspan='3'>".$data['Ubicacion']."</td>
                          <td><strong>UBICACION</strong></td>
                          <td  colspan='3'></td>
                      </tr>
                      <tr>
                          <td style='background:#600003;color:#fff;'><strong>PUNTO A INSPECCIONAR</strong></td>
                          <td style='text-align:center;background:#600003;color:#fff;'  colspan='3'><strong>ESTATUS</strong></td>
                          <td style='background:#d90429;color:white;text-align:center;'><strong>PUNTO A INSPECCIONAR</strong></td>
                          <td  colspan='3' style='background:#d90429;color:white;text-align:center;' ><strong>ESTATUS</strong></td>
                      </tr>
                      <tr>
                        <td>NIVEL DE ACEITE</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Nivel_de_aceite'])."</td>
                        <td>NIVEL DE ACEITE</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                     <tr>
                        <td>NIVEL DE REFRIGERANTE</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Nivel_de_refrigerante'])."</td>
                        <td>NIVEL DE REFRIGERANTE</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                      <tr>
                        <td>MARCA DE BATERIA</td>
                        <td  colspan='3' style='text-align:center;'>".$data['Marca_de_bateria']."</td>
                        <td>MARCA DE BATERIA</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                      <tr>
                        <td>LLAVE DE ARRANQUE</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Llave_de_arranque'])."</td>
                        <td>LLAVE DE ARRANQUE</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                      <tr>
                        <td>TAPON DE RADIADOR</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Tapon_de_radiador'])."</td>
                        <td>TAPON DE RADIADOR</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                      <tr>
                        <td>TAPON COMBUSTIBLE</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Tapon_combustible'])."</td>
                        <td>TAPON COMBUSTIBLE</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                     <tr>
                        <td>TUERCAS,MARIPOSAS</td>
                        <td  colspan='3' style='text-align:center;'>".$data['Tuercas_mariposas']."</td>
                        <td>TUERCAS,MARIPOSAS</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                     <tr>
                        <td>SELECTORES</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Selectores'])."</td>
                        <td>SELECTORES</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                      <tr>
                        <td>INTERRUPTORES</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Interruptores'])."</td>
                        <td>INTERRUPTORES</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                     <tr>
                        <td>CONTACTOS</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Contactos'])."</td>
                        <td>CONTACTOS</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                     <tr>
                        <td>FOCOS Y MICAS</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Focos_micas'])."</td>
                        <td>FOCOS Y MICAS</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                     <tr>
                        <td>CABLE MASTIL</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Cable_masil'])."</td>
                        <td>CABLE MASTIL</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                     <tr>
                       <td>LLANTAS</td>
                       <td  colspan='3' style='text-align:center;'>".comprobar($data['Llantas'])."</td>
                       <td>LLANTAS</td>
                       <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                     <tr>
                        <td>ESTRUCTURA REMOLQUE</td>
                        <td  colspan='3' style='text-align:center;'>".comprobar($data['Estructura_remolque'])."</td>
                        <td>ESTRUCTURA REMOLQUE</td>
                        <td  colspan='3' style='text-align:center;'></td>
                     </tr>
                     <tr>
                        <td>GATO PATIN</td>
                        <td  colspan='3'  style='text-align:center;'>".comprobar($data['Gato_patin'])."</td>
                        <td>GATO PATIN</td>
                        <td  colspan='3'  style='text-align:center;'></td>
                     </tr>
                     <tr>
                        <td>TIRON</td>
                        <td  colspan='3'  style='text-align:center;'>".comprobar($data['Tiron'])."</td>
                        <td>TIRON</td>
                        <td  colspan='3'  style='text-align:center;'></td>
                     </tr>
                     <tr>
                       <td>CADENAS DE SEGURIDAD</td>
                       <td  colspan='3'  style='text-align:center;'>".comprobar($data['Cadenas_de_seguridad'])."</td>
                       <td>CADENAS DE SEGURIDAD</td>
                       <td  colspan='3'  style='text-align:center;'></td>
                     </tr>
                     <tr>
                       <td>MATACHISPAS</td>
                       <td  colspan='3' style='text-align:center;'>".comprobar($data['Matachispas'])."</td>
                       <td>MATACHISPAS</td>
                       <td  colspan='3'></td>
                     </tr>
                     <tr>
                       <td>CONDICIONES FISICAS</td>
                       <td  colspan='3' style='text-align:center;'>".comprobar($data['Condiciones_fisicas'])."</td>
                       <td>CONDICIONES FISICAS</td>
                       <td  colspan='3'></td>
                     </tr>
                     <tr>
                       <td><strong>ACCESORIOS ADICIONALES</strong></td>
                       <td  colspan='3' style='text-align:center;'>".$data['Accesorios_adicionales']."</td>
                       <td><strong>ACCESORIOS ADICIONALES</strong></td>
                       <td  colspan='3'></td>
                     </tr>
                     <tr>
                       <td colspan='4' height='40'></td>
                       <td colspan='4'></td>
                     </tr>
                     <tr>
                       <td><strong>NOTA:</strong></td>
                       <td colspan='7'>Se efectuaran cargos al cliente por daños en los equipos,sus partes y accesorios, asi como tambien por no entregar</td>
                     </tr>
                     <tr> 
                       <td colspan='8'>Las partes del mismo modelo y marca con que fue originalmente recibido y de encontrarse el combustible contaminado,tambien se efecturan cargos correspondientes por los daños derivados de cualquiera de estas situaciones, los equipos en renta pura deben ser devueltos con la misma cantidad de combustible que se recibieron. El equipo aqui descrito es propiedad de Arrendadora Chacon</td>
                    </tr>
                   </table>

                    <table>
                        <tr>    
                        <td  colspan='4' style='text-align:center;background:#600003;color:#fff;'><strong>DATOS DEL CLIENTE RECEPCION EQUIPO</strong></td> 
                        <td  colspan='4' style='background:#d90429;color:white;text-align:center'><strong>DATOS DEL CLIENTE ENTREGA EQUIPO</strong>
                          </td>
                        </tr>
           
                        <tr>
                            <td width='100px'><strong>NOMBRE</strong></td>
                            <td colspan='3'></td>
                            <td width='100px'><strong>NOMBRE</strong></td>
                            <td colspan='3'></td>
                        </tr>
                        <tr>
                            <td width='100px'><strong>PUESTO</strong></td>
                            <td colspan='3'></td>
                            <td width='100px'><strong>PUESTO</strong></td>
                            <td colspan='3'></td>
                            
                        </tr>
                        <tr>
                            <td width='100px'><strong>FIRMA</strong></td>
                            <td colspan='3'></td>
                            <td width='100px'><strong>FIRMA</strong></td>
                            <td colspan='3'></td>
                            
                        </tr>

                        <tr>
                              
                        <td  colspan='4' style='text-align:center;background:#600003;color:#fff;'><strong>DATOS PERSONAL DEL ARRENDATARIO QUE ENTREGA</strong></td>
                              
                          
                        <td  colspan='4' style='background:#d90429;color:white;text-align:center'><strong>DATOS PERSONAL DEL ARRENDATARIO QUE RECIBE</strong></td>
                        </tr>
                        <tr>
                            <td width='100px'><strong>NOMBRE</strong></td>
                            <td colspan='3'></td>
                            <td width='100px'><strong>NOMBRE</strong></td>
                            <td colspan='3'></td>
                            
                        </tr>
                        <tr>
                            <td width='100px'><strong>PUESTO</strong></td>
                            <td colspan='3'></td>
                            <td width='100px'><strong>PUESTO</strong></td>
                            <td colspan='3'></td>
                            
                        </tr>
                        <tr>
                            <td width='100px'><strong>FIRMA</strong></td>
                            <td colspan='3'></td>
                            <td width='100px'><strong>FIRMA</strong></td>
                            <td colspan='3'></td>
                            
                        </tr>
                        
                     </table>


             </body>

            
                
            
           ";



 $mpdf -> SetTopMargin(49);
$mpdf -> SetAutoPageBreak(true, 15);//bottom

//escribe en el objeto
$mpdf->writeHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->SetHTMLHeader($header);

$mpdf->WriteHTML($codigoHTML);

//$mpdf -> SetFooter("Pagina {PAGENO} de {nb}",$footer); Pagina
$mpdf->SetHTMLFooter($footer);

$mpdf->SetDisplayMode('fullpage');

$mpdf->Output('formato-chacon', 'I');


?>

