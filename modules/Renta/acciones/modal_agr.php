<script type="text/javascript" src="modules/Renta/mostrar.js?v=10.5"></script>
<?php
 require '../../../config/conexion.php';
 $crud = new CRUD;
?>
    <form class="form-horizontal" id="formAgregar" method="POST" action="modules/Renta/proses.php?act=insertar_salida">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">AGREGAR RENTA</h4>
      </div>
      <div class="modal-body">
        <div align="center">
              <img src="img/logo_chacon_extendido.jpeg" style="width: 95%; height: 96px;">
        </div>

    
        <div class="box-body table-responsive" <?php // onchange="TablaVacia();" ?> onclick="inicial(0);" oninput="ocultarSP(0);">
           

            <div class="col-sm-12 tamaño" style="padding-top: 2%;">
              <div onmouseenter="TablaVacia();"  class="btnR" style="padding-top: 6px;  position: absolute;"><!--Boton para agregar-->
                <button type="button"  id="button" class='btn btn-success pull-right'  onclick="addFilasEnTablaMaterial('',0)" title='Agregar Fila' data-toggle='tooltip' style="width: 25px; height: 20px; padding: 0;">
                  <i class='fa fa-plus'></i>
                </button>
              </div>

              <table id="agregarM"  class="table table-bordered table-striped table-hover table-condensed" style="background: white; vertical-align: middle; text-align: center; ">
                <thead>
                  <tr bgcolor="black" >
                    <th colspan="14" style="text-align: center; color: gold; font-size: 15px; "><strong>EQUIPOS QUE VAN A SALIR</strong>
                    </th>
                  </tr>

                  <tr bgcolor="Coral">
                    <th colspan="2" style="text-align: center;" width="170px">NE</th>
                    <th colspan="2" style="text-align: center;" width="95px">MODELO</th>
                    <th colspan="1" style="text-align: center;" width="80px">DESCRIPCIÓN</th>
                    <th colspan="3" style="text-align: center;" width="70px">PLAN DE RENTA</th>
                    <th colspan="1" style="text-align: center;" width="170px">CLIENTE</th>
                    <th colspan="1" style="text-align: center;" width="210px">SALIDA ESTIMADA</th>
                    <th colspan="1" style="text-align: center;" width="10px">DESCUENTO</th>
                    <th colspan="2" style="text-align: center;" width="80px">TOTAL</th>
                    <th></th>
                  </tr>
                </thead>

                    <tbody id="material">
                      <tr id="1">

                        <td colspan='2' >
                        
                      <div class="form-group"  style=" width:auto;" >
                      <div class="col-sm-7" oninput="document.getElementById('total_1').value='$0'"  onchange="descripcionCodigo(1,0)" style=" width:auto;">
                      <SELECT class="form-control" id='codigo_1'  name='codigo_1' maxlength="5" > 
                        <?php  
                      $quer = $crud->consultar_inventario_E_D();
                      $i=0;
                      while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona equipo</option><?php $i++; } ?>
                      <option tipo="<?php echo $dat['ID_Tipo']; ?>" descripcion="<?php echo $dat['Descripcion']; ?>" value="<?php echo $dat['ID_Tipo']."*".$dat['NE']; ?>" title="<?php echo $dat['Modelo']; ?>"><?php echo $dat['NE']; ?> </option>
                      <?php } //terminacion while?> 
                      </SELECT>  
                      </div>
                      </div>
                      </td>

                      
                        <td colspan='2'>
                          <label id='modelo_1' name='modelo_1' ></label>
                          <div id="alert_1" ></div>
                        </td>
                        
                        <td>
                          <label id='descrip_1' name='descrip_1'   >
                        </td>

                        <td colspan='3'>
                        <div class="form-group"  >
                        <div class="col-sm-7" id="listaview_1" onchange="recargarLista2(1);"  style=" width:40px;">
                      </div>
                      </div>
                        </td>

                      

        <td> 

            <div class="form-group" >
                      <div class="col-sm-7" style=" width:auto;">
                      <SELECT class="form-control" id="cliente_1"  NAME="cliente_1" required> 
                      <?php  
                     $quer = $crud->clientes_A();
                      $i=0;
                      while ($dat = mysqli_fetch_assoc($quer)) {  if($i==0){?> <option value="0">Selecciona cliente</option><?php $i++; } ?>
                      <OPTION value="<?php echo $dat['ID_clientes']; ?>"><?php echo $dat['Razon_Social'];?></OPTION>
                      <?php } //terminacion while?> 
                      </SELECT>    
                      </div>
                      </div>
        </td>

        
                        <td colspan='1'>
                        <div class="form-group">
            <div class="col-sm-7" style=" width:auto;">
            <input type="date" id="fechai_1" name="fechai_1" class="form-control" required="required" maxlength="15">
            </div>
            </div>

            </td>
           <td colspan="1">
           <div class="form-group">
           <div  class="col-sm-7"  style=" width:auto;">
           <input id="descuento_1" type="range" min="0" max="15" step="0.01" oninput="document.getElementById('out_1').value='%'+value"  onchange="recargarLista2(1);" list="puntos">
           <output id= "out_1" name ="out_1">0</output>
           <datalist id="puntos">
            <option value="0"></option>
            <option value="2.5"></option>
            <option value="5"></option>
            <option value="7.5"></option>
            <option value="10"></option>
            <option value="12.5"></option>
            <option value="15"></option>
           </datalist>
           </div>
           </div>
                        </td>
        

                        </td>
                        <td colspan="2">
                        <div class="form-group" style=" width:auto;">
           <div id= "itotal_1" class="col-sm-7" >
           </div>
           </div>
                        </td>
            
                      </tr>  

                </tbody>
              </table>
            </div>
            
            
             <?php          
            if(isset($_GET['id'])){  ?>
              <!-- gabriel nuevo -->
            <div class="col-sm-12 tamaño" style="padding-top: 1%;">
              <div class="col-xs-12">
                <div class="col-xs-1" style="text-align: left;">
                  <label>RM diaria</label>
                </div>
                <div class="col-xs-3">
                  <input title='total_utilizado'  value="" data-toggle='tooltip' id="total_utilizado" name="total_utilizado" class="form-control">
                </div>
              </div>
            </div><?php } ?>

            
            <input type="hidden" value="<?php echo $anteproyecto['lista_rm'] ?>" id="listarm">  <!--  GABRIEL  NUEVO  -->
            <input type="hidden" value="<?php echo  1;  ?>" id="bandera" name="bandera">  <!--  G   -->
            <div class="col-sm-12"><input type="hidden" id="canMaterial" name="canMaterial" value="2"></div>
            <div class="col-sm-12"><input type="hidden" id="canPersonal" name="canPersonal" value="2"></div>
            <div class="col-sm-12">
              <input type="hidden" id="totales" name="totales" class="form-control" readonly>
            </div>


            <?php  
            if(isset($_GET['id'])){ ?>    <!-- G  -->
                <div class="col-sm-12 tamaño" style="padding-top: 1%;">
                  <div class="col-xs-12">
                    <div class="col-xs-4" style="text-align: right;">
                      <label>ELIGE TIPO DE MATERIAL:</label>
                    </div>
                    <div class="col-xs-7">
                      <select title=' Tipo de Tabla Material' data-toggle='tooltip' id="tipoMaterial" name="tipoMaterial" class="form-control">
                          <option value='' selected=''></option>
    
                          <option value="cotizado"    <?php   if(isset($_GET['id'])){ echo "selected";  } ?>   >MATERIAL COTIZADO</option>
                          <option value="real">MATERIAL REAL</option>
    
                      </select>
                    </div>
                  </div>
                </div><?php
            }  ?>     <!--  G  -->


          

        </div>
      </div>
      <div class="modal-footer"  <?php // onmouseenter="TablaVacia();" ?>>
        <input type="button" class="btn bg-success pull-left" value="Limpiar" onclick="limpiar();">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button id="btnG" type="submit" class="btn btn-primary" name="Guardar">Guardar</button>
      </div>
    </form>

<script type="text/javascript">
  $(function (){
    //Date picker
    $('.date-picker').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      autoclose: true,
      language: 'es'
    })
  })

  //Para mostrar etiquetas negras
  $(function(){
      $('[data-toggle="tooltip"]').tooltip();
  });
  
  window.addEventListener("keydown", function(e) {
      if (e.keyCode === 13){ //9
          e.preventDefault();
          //return false; 
      }
  });
</script>
