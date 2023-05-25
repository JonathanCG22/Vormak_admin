/**Funcion para Enviar los datos del formulario por ajax
 * idForm -> id del form
 * urlFrom-> url, donde se quiere recibir los datos
 * name   -> Nombre Boton
 * idBtn  -> id del Boton From
 */
function enviarForm(idForm, urlFrom,idBtn, name) {
	const formID = document.getElementById(idForm);

    $.ajax({
	    url: urlFrom,
	    type: "POST",
	    data: new FormData(formID),
	    dataType: "JSON",
	    contentType: false,		/*obligatorio cuando se envian archivos*/
	    processData: false,		/*obligatorio cuando se envian archivos*/
	    beforeSend: function() {
	       btnForm(idBtn, name);
	    },
	    success : function(data) {
	       btnForm(idBtn, name, false);
	       location.href = data.url;
	    }
    });
    return false;
}

/**Funcion para bloquear boton
 * idBtn -> id del Boton
 * name  -> Nombre Boton
 * bloq  -> Bloquer Boton, true por default
 */
function btnForm(idBtn, name, bloq = true) {
	if (bloq) {
	  $("#" + idBtn).attr("disabled", true);
	  $("#" + idBtn).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span class="sr-only">sending...</span>Enviando...');
	}else {
	  $("#" + idBtn).attr("disabled", false);
	  $("#" + idBtn).html(name);
	}
}

/*Metodo para poner un numero con comita -> 1,200*/
const formatoMexico = (number) => {
  const exp = /(\d)(?=(\d{3})+(?!\d))/g;
  const rep = '$1,';
  return number.toString().replace(exp,rep);
}

/*Funcion para abrir un modal
 *a  (this, null)-> Para poder obtener el dato del id -> con this
 *name   (string)-> Nombre del modal. Ej. Permiso_Acceso -> modal_Permiso_Acceso
 *opcion (string)-> Para poder saber que url le corresponde abrir
 */
function openModal(a = null, name, opcion = null, valor= null) {
	let valor_id = 0;
	let url = '';

	if (a != null) {
		valor_id = a.id;
		valor_id = valor_id.replace(/ /g, '%20'); //Para remplazar los vacios con %20 y el html no marque error
	}

    switch (opcion) {
    	case 'A1':
    		url = 'modules/user/permisos_acceso/modal_moduloMD.php?id=' + valor_id;
    		break;
    	case 'A2':
    		url = 'modules/user/permisos_acceso/modal_permisoMD.php?id=' + valor_id;
    		break;
        case 'A3':
            url = 'modules/user/permisos_planta/modal_permisoMD.php?id=' + valor_id;
            break;
    	case 'B1':
    		url = 'modules/clientes/modal.php?id=' + valor_id;
    		break;
    	case 'B2':
    		url = 'modules/clientes/usuarios/modal_verU.php?id=' + valor_id;
    		break;
    	case 'B3':
    		url = 'modules/clientes/usuarios/modal_Usuario.php?id=' + valor_id;
    		break;
    	case 'B4':
    		url = 'modules/clientes/cargos/modal_verC.php?id=' + valor_id;
    		break;
    	case 'B5':
    		url = 'modules/clientes/cargos/modal_Cargo.php?id=' + valor_id;
    		break;
    	case 'B6':
    		url = 'modules/clientes/correo/modal_verC.php?id=' + valor_id;
    		break;
    	case 'B7':
    		url = 'modules/clientes/correo/modal_Correo.php?id=' + valor_id;
    		break;
    	case 'C1':
    		url = 'modules/personal/mod_modal.php?id=' + valor_id;
    		break;
    	case 'D1':
    		url = 'modules/gastos/modal.php?id=' + valor_id;
    		break;
    	case 'D2':
    		url = 'modules/gastos/modal_Agr.php?id=' + valor_id;
    		break;
    	case 'D3':
    		url = 'modules/gastos/modal_Mod.php?id=' + valor_id;
    		break;
    	case 'E1':
    		url = 'modules/configuracion/CategoriasPreviw/modal_Mod.php?id=' + valor_id;
    		break;
    	case 'EE1':
    		url = 'modules/configuracion/Categorias/modal_Mod.php?id=' + valor_id;
    		break;
    	case 'E2':
    		url = 'modules/configuracion/Infonavit/modal_Mod.php?id=' + valor_id;
    		break;

    	case 'F1':
    		url = 'modules/inventario/XProyecto/modal.php?id=' + valor_id;
    		break;
    	case 'F2':
    		if(valor == 1){ //opcion 1 vista original
              url = 'modules/inventario/movimientos/modal.php?id=' + valor_id;
            }else{//opcion 2 vista reducido
              url = 'modules/inventario/movimientos/modal_ver.php?id=' + valor_id;
            }
    		break;
    	case 'F3':
    		if(valor == 1){ //opcion 1 vista original
              url = 'modules/inventario/movimientos/modal_Mod.php?id=' + valor_id;
            }else{//opcion 2 vista reducido
              url = 'modules/inventario/movimientos/modal_Mod_2.php?id=' + valor_id;
            }
    		break;
    	case 'F4':
    		url = 'modules/inventario/subir_Excel/subir_Excel.php?id=' + valor_id;
    		break;
    	case 'F5':
    		url = 'modules/inventario/movimientos/modal_SubirFoto.php?id=' + valor_id;
    		break;
    	case 'F6':
    		url = 'modules/inventario/subir_Excel/subir_Excel.php?id=' + valor_id;
    		break;
    	case 'F7':
    		url = 'modules/inventario/modal_NewAlmacen.php';
    		break;
    	case 'G1':
            if(valor == 'AgregarRapido'){ //opcion vista rapida, sin candados
              url = 'modules/hojas_trabajo/HT_Formato/modal_agr.php?Candado=1';
            }else{
              url = 'modules/hojas_trabajo/HT_Formato/modal_agr.php?Candado=0';
            }
    		break;
        case 'G2':
            url = 'modules/hojas_trabajo/modal_CancelarFolio.php?id=' + valor_id;
            break;
        case 'G3':
            url = 'modules/hojas_trabajo/modal_ClonarFolio.php?id=' + valor_id;
            break;
        case 'G4':
            url = 'modules/hojas_trabajo/modal_CorteParcial.php?id=' + valor_id;
            break;
        case 'G5':
            url = 'modules/hojas_trabajo/modal_SubirArchivos.php?id=' + valor_id;
            break;
    	case 'H1':
    		url = 'modules/proyecto/modal_HT.php?id=' + valor_id;
    		document.getElementById('modal_tablaHT_Proyec').style.display = "block";
    		break;
    	case 'H2':
    		url = 'modules/proyecto/modal_CT.php?id=' + valor_id;
    		break;
    	case 'I1':
    		url = 'modules/compras/requisiciones/modal_AgrS.php?id=' + valor_id; //compras
    		break;
    	case 'I2':
            if (valor_id != 0) {
                url = 'modules/compras/requisiciones/modal_ModR.php?id=' + valor_id;
            }else {
                url = 'modules/compras/requisiciones/modal_ModR.php?id=' + valor;
            }
    		break;
    	case 'I3':
    		url = 'modules/compras/requisiciones/modal_AgrC.php?id=' + valor_id;
    		break;
    	case 'I4':
    		url = 'modules/compras/requisiciones/modal_ModC.php?id=' + valor_id;
    		break;
    	case 'I5':
    		url = 'modules/compras/ordenes%20compra/modal_ModOC.php?id=' + valor_id + ':0';
    		break;
    	case 'I6':
    		url = 'modules/compras/modal_VerCompra.php?id=' + valor_id;
    		break;
    	case 'I7':
    		url = 'modules/compras/recepcion/modal_AgRCP.php?id=' + valor_id;
    		break;
        case 'I8':
    		url = 'modules/compras/recepcion/modal_ModRCP.php?id=' + valor_id;
    		break;
    	case 'I9':
    		url = 'modules/compras/productos/modal_ModP.php?id=' + valor_id;
    		break;
    	case 'I10':
    		url = 'modules/compras/proveedores/modal_modP.php?id=' + valor_id;
    		break;
    	case 'I11':
    		url = 'modules/compras/proveedores/Datos%20Bancarios/modal_verDB.php?id=' + valor_id;
    		break;
    	case 'I12':
    		url = 'modules/compras/proveedores/Datos%20Bancarios/modal_DB.php?id=' + valor_id;
    		break;
    	case 'I13':
    		url = 'modules/compras/tablas/modal_Categoria.php?id=' + valor_id;
    		break;
    	case 'I14':
    		url = 'modules/compras/tablas/modal_UnidadMedida.php?id=' + valor_id;
    		break;
    	case 'I15':
    		url = 'modules/compras/tablas/modal_FormaPago.php?id=' + valor_id;
    		break;
    	case 'I16':
    		url = 'modules/compras/tablas/modal_MetodoPago.php?id=' + valor_id;
    		break;
    	case 'J1':
    		url = 'modules/catalogo_proyectos/modal_mod.php?id=' + valor_id;
    		break;
    	case 'K1':
    		url = 'modules/solicitud_personal/modal_ModSpersonal.php?id=' + valor_id + ':0';
    		break;
    	case 'K2':
    		url = 'modules/solicitud_personal/modal_ModSandamio.php?id=' + valor_id + ':0';
    		break;
    	case 'L1':
    		url = 'modules/EPP/modal_ModSEPP.php?id=' + valor_id;
    		break;
        case 'L2':
            url = 'modules/EPP/modal_ProcesoEntrega.php?id=' + valor_id;
            break;
        case 'M1':
            url = 'modules/Cobranza/Caratulas/modal_SubirCaratula.php?id=' + valor_id;
            break;
        case 'M2':
            url = 'modules/Cobranza/Caratulas/modal_datos.php?id=' + valor_id;
            break;
        case 'M3':
            url = 'modules/Cobranza/Caratulas/modal_PDFs.php?id=' + valor_id;
            break;
        case 'M4':
            url = 'modules/Cobranza/Caratulas/modal_UpdateUsuarios.php?id=' + valor_id;
            break;
        case 'M5':
            url = 'modules/Cobranza/Caratulas/modal_UpdateNFactura.php?id=' + valor_id;
            break;
        case 'N1':
            url = 'modules/arrendamiento/modal.php?id=' + valor_id;
            break;
        case 'N2':
            url = 'modules/arrendamiento/ver_imagen.php?id=' + valor_id;
            break; 
        case 'O1':
            url = 'modules/Inventario_Equipo/agregar_tipo_e.php?id=' + valor_id;
            break;    
        case 'P1':
            url = 'modules/Inventario_Equipo/modal.php?id=' + valor_id;
            break;
        case 'P2':
            url = 'modules/Inventario_Equipo/Planes_Renta/view_plan.php';
            break;
        case 'P3':
            url = 'modules/Inventario_Equipo/Planes_Renta/nuevo_plan.php';
            break;
        case 'P4':
            url = 'modules/Inventario_Equipo/Planes_Renta/editar_plan.php?id=' + valor_id;
            break;
        case 'P5':
            url = 'modules/Inventario_Equipo/Peticiones_mantenimiento/view_peticion.php?';
            break;
        case 'Q1':
              url = 'modules/Mantenimiento_Equipo/modal.php?id=' + valor_id;
              break;
        case 'R1':
        url = 'modules/Renta/modal.php?idf=' + valor_id;
        break;
        case 'R2':
        url = 'modules/Renta/lista.php?id=' + valor_id;
        break;
        case 'R3':
              url = 'modules/Renta/acciones/modal_agr.php?';
    		break;
        case 'R4':
          url = 'modules/personal/solicitantes/modal_solicitantes.php?';
    break;
    	case 'Z1':
    		url = 'modal_advertencia.php?id=' + valor_id;
    		break;
    	default:
    		// statements_def
    		break;
    }

    $('#modal-'+ name).load(url,function(){
    	$('#modal_'+ name).modal('show');

        if (opcion == 'F3' || opcion == 'F2') { //para mostrar el total en modal movimientos inventario
           SumaTotalPiezas(1);
        }
    });
}

/**Funcion para validar el archivo
 * x -> identificador despues del nombre. Ej arcivo1
 */
function validarArchivo(x){
    let nomArchivo  = 'archivo'+x;
    let ext1 = $( "#"+nomArchivo ).val().split('.').pop();
    let ext  = ext1.toUpperCase();//poner en mayusculas

    if ($( "#"+nomArchivo ).val() != '') {

        if(ext == "PDF"){
            if($("#"+nomArchivo)[0].files[0].size > 5242880){
              // console.log("El documento excede el tamaño máximo");
              $("#"+nomArchivo).val('');
              document.getElementById('text'+x).style.color= "orangered";
              document.getElementById('imagenPreviw'+x).style.display='none';
              document.getElementById('imagenDefault'+x).style.display='block';
              document.getElementById('delete'+x).style.display='none';
              $('#button2').prop( "disabled", true );

              previewArchivo(x);

              alert("Se solicita un archivo no mayor a 5 MB. Por favor verifica. ");

            }else{
              document.getElementById('text'+x).style.color= "black";
              document.getElementById('imagenPreviw'+x).style.display='block';
              document.getElementById('imagenDefault'+x).style.display='none';
              $('#button2').prop( "disabled", false );

              previewArchivo(x);
            }

        }else{
            $( "#"+nomArchivo ).val('');
            document.getElementById('text'+x).style.color= "orangered";
            document.getElementById('imagenPreviw'+x).style.display='none';
            document.getElementById('imagenDefault'+x).style.display='block';
            $('#button2').prop( "disabled", true );

            previewArchivo(x);

            alert("Extensión no permitida: ." + ext + "\nPorfavor seleccione un archivo con extención .PDF");
        }
    }
}

//Para mostrar la imagen que selecciono en el file
function previewArchivo(x) {
    PDF_file = document.getElementById('archivo'+x).files[0];

    if( PDF_file != '' && PDF_file != undefined){
        PDF_file_url = URL.createObjectURL(PDF_file);
        $('#Previw' +x).attr('src',PDF_file_url);

        $('#archivo'+x).prop( "required", true );

    }else{
        $('#Previw' +x).attr('src',' ');
        $('#archivo'+x).prop( "required", false );
    }
}

/*Funcion para ordenar ASC los nombres
 *SelectId -> Es el nombre que se le dio al id del select
 */
function ordenarASC(SelectId){
    //Separo la primera opción del select (vacío) porque no quiero ordenarla
    var foption = $('#' + SelectId + ' option:first');
    //Ordeno todas menos la primera (Si el texto de a y el de b son iguales no se hace nada, si el de a es menor que el de b es porque tiene que ir en un índice anterior (en la documentación indicada se explican todos los casos posibles de la compareFunction())
    var soptions = $('#' + SelectId + ' option:not(:first)').sort(function (a, b) {
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    });
    //Reasigno al select los valores ordenados y le añado antes la primera opción
    $('#' + SelectId).html(soptions).prepend(foption);
}

/*para mostrar caracteres sobrantes en texarea
 *obj    -> this
 *max    -> Es el numero maximo de caracteres a escribir (maxlength)
 *option -> Es un identificador, por si hay mas de un "charNum"
 */
function countChars(obj,max,option){
    var maxLength = max;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);

    if(charRemain < 0){
        document.getElementById("charNum"+option).innerHTML = '<span style="color: red;">You have exceeded the limit of '+maxLength+' characters</span>';
    }else if(charRemain == 0){
        document.getElementById("charNum"+option).innerHTML = '<span style="color: red;">'+charRemain+' caracteres restantes</span>';
    }else{
        document.getElementById("charNum"+option).innerHTML = charRemain+' caracteres restantes';
    }
}

/*Para numeros y punto decimal*/
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode != 46 && charCode > 31 &&
    (charCode < 48 || charCode > 57))
    return false;

  return true;
}

function obtener_cp(cp){
  var codigo_postal = cp;
  var domicilio = document.getElementById('domicilio');
  domicilio.innerHTML = `<div class="col-sm-4">
    <label class="control-label">Colonia</label>
    <select class="form-control input-sm" id="colonia" name="colonia" data-placeholder="-- Seleccionar --" autocomplete="off" >
      <option value=""></option>
    </select>
  </div>
  <div class="col-sm-4">
    <label class="control-label">Ciudad</label>
    <select class="form-control input-sm" id="ciudad" name="ciudad" data-placeholder="-- Seleccionar --" autocomplete="off" >
      <option value=""></option>
    </select>
  </div>
  <div class="col-sm-4">
    <label class="control-label">Estado</label>
    <select class="form-control input-sm" id="estado" name="estado" data-placeholder="" autocomplete="off" >
      <option value=""></option>
    </select>
  </div>`;
  obtener_estados(cp);
  obtener_municipios(cp);
  obtener_colonias(cp);
}

/*muestra el personal en el select*/
function obtener_estados(cp){
  var sDatos = "&dato=estados&codigo="+cp;
  $.ajax({
      url: "modules/personal/estadosymunicipios.php",
      type: "POST",
      data: sDatos,
      success:function(r){
        console.log("hola");
        if ($('#estado').val() == '') {
           $('#estado').html(r);
        }
      }
  });
}

function obtener_municipios(cp){
  var sDatos = "&dato=municipios&codigo="+cp;
  $.ajax({
      url: "modules/personal/estadosymunicipios.php",
      type: "POST",
      data: sDatos,
      success:function(r){
        if ($('#ciudad').val() == '') {
           $('#ciudad').html(r);
        }
      }
  });
}

function obtener_colonias(cp){
  var sDatos = "&dato=colonias&codigo="+cp;
  $.ajax({
      url: "modules/personal/estadosymunicipios.php",
      type: "POST",
      data: sDatos,
      success:function(r){
        if ($('#colonia').val() == '') {
           $('#colonia').html(r);
        }
      }
  });
}
