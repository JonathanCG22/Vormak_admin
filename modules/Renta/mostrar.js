


function recargarLista(){
	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=recargar_plan",
		data:"idt=" + $('#lista1').val()+"-"+"v",
		success:function(r){
			$('#listaview').html(r);
		}
	});

}

function quitabotton(){
	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=quitar_boton_fila",
		data:"idt=" + $('#bandera').val(),
		success:function(r){
			$('#fila').html(r);
		}
	});

}


function bodym(){

	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=body_m",
		data:"idf="+$('#rentas').val(),
		success:function(r){
			$('#bodym').html(r);
		}
	});

	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=botonesm",
		data:"idf="+$('#rentas').val(),
		success:function(r){
			$('#botones').html(r);
		}
	});
}



function cancelar(){	
	var resultado = window.confirm('¿Seguro que deseas cancelar el folio/rentas?');
	if (resultado === true) {
		$.ajax({
			type:"POST",
			url:"modules/Renta/proses.php?act=cancelar_folio_rentas",
			success:function(r){
			
			}
		});
		location.href='../../main.php?module=Renta_Equipo&alert=8';
	} else { 
		window.alert('Okey continua :)');
	}
}



function enviarrenta(){
	if (document.getElementById('aceite').checked) { var aceite = 1;}
	if (document.getElementById('refrigerante').checked) { var refrigerante = 1; }
	if (document.getElementById('llavea').checked) { var llavea = 1; }
	if (document.getElementById('radiador').checked) { var radiador = 1; }
	if (document.getElementById('combustible').checked) { var combustible = 1; }
	if (document.getElementById('selectores').checked) { var selectores = 1; }
	if (document.getElementById('interruptores').checked) { var interruptores = 1; }
	if (document.getElementById('contactos').checked) { var contactos = 1; }
	if (document.getElementById('focos').checked) { var focos = 1; }
	if (document.getElementById('mastil').checked) { var mastil = 1; }
	if (document.getElementById('llantas').checked) { var llantas = 1; }
	if (document.getElementById('remolque').checked) { var remolque = 1; }
	if (document.getElementById('patin').checked) { var patin = 1; }
	if (document.getElementById('tiron').checked) { var tiron = 1; }
	if (document.getElementById('cadenas').checked) { var cadenas = 1; }
	if (document.getElementById('matachispas').checked) { var matachispas = 1; }
	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=insert_renta",
		data:"df="+$('#lista1').val()+"["+$('#lista2').val()+"["+$('#cant').val()+"["+$('#lista3').val()+"["+$('#fechai').val()+"["+$('#hora').val()+"["+$('#horometro').val()+"["+$('#diesel').val()+"["+$('#ubicacion').val()+"["+aceite+"["+refrigerante+"["+$('#marcabateria').val()+"["+llavea+"["+radiador+"["+combustible+"["+$('#tuercas').val()+"["+selectores+"["+interruptores+"["+contactos+"["+focos+"["+mastil+"["+llantas+"["+remolque+"["+patin+"["+tiron+"["+cadenas+"["+matachispas+"["+$('#condiciones').val()+"["+$('#accesorios').val(),
	
		success:function(r){
			document.getElementById("formularior").reset();
		}
		
	});

	if($('#equipos').val() == 1){
		location.href='../../main.php?module=Renta_Equipo&alert=1';
	   }

}

function equiposfaltantes(){

	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=equipos_faltantes",
		success:function(r){
			$('#equiposfaltantes').html(r);
		}
	});
}

function Guardarsalida(){
	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=crear_folio",
		data:"fol=" + $('#descripcion').val()+"*"+$('#equiposrequeridos').val(),
		success:function(r){
			document.getElementById("formulariof").reset();
		}
	});
}

function limpiar(){
	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=limpiar_tabla",
		success:function(r){
			$('#agregarM').html(r);
		}
	});
}



function recargarListam(){
	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=recargar_plan",
		data:"idt=" + $('#lista1').val()+"-"+"m",
		success:function(r){
			$('#planesmodal').html(r);
		}
	});

}

function recargartotalm(){
	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=calculartotal",
		data:"costo=" + $('#listam').val()+$('#cantm').val(),
		success:function(r){
			$('#itotal_m').html(r);
		}
	});

}



function recargarLista2(a){
  //let l = $('#fila_'+a).val();
  
  var sDatos = "&a="+a+"&l="+$('#fila_'+a).val()+"&des="+$('#descuento_'+a).val()+"&costo=";
  

  for (let i = 1; i <= $('#fila_'+a).val(); i++) {
    if($('#lista_'+a+i).val() !== undefined && $('#cant_'+a+i).val() !== undefined && $('#cant_'+a+i).val() !== "" && $('#lista_'+a+i).val() !== "" && $('#cant_'+a+i).val() >0){
   sDatos = sDatos+","+$('#lista_'+a+i).val()+$('#cant_'+a+i).val();
  }
  }
  
//  data:"costo=" + $('#lista_'+a+l).val()+$('#cant_'+a+l).val()+"&des="+$('#descuento_'+a).val()+"&a="+a,

$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=calculartotal",
		data: sDatos,
		success:function(r){
			$('#itotal_'+a).html(r);
		}
	});
  sDatos.clear();
}



function TablaVacia(){
  var r = true;
  for (let i = 1; i <= $('#bandera').val(); i++) {
    if($(`#codigo_${i}`).val() == "0" || $(`#cliente_${i}`).val() == "0" || $(`#fechai_${i}`).val() == "" || $(`#total_${i}`).val() == "$0"){
     r = true;
    }else{
		r = false;	
		}
  }

  if(r){
    $('#button').prop( "disabled", true ); $('#btnG').prop( "disabled", true );
    document.getElementById('button').style.background  = "black";		
    document.getElementById('vacio').style.display  = "block";
    }else{
    $('#button').prop( "disabled", false ); $('#btnG').prop( "disabled", false );
		document.getElementById('button').style.background  = "#3c8dbc";
		document.getElementById('vacio').style.display  = "none";	
    }

}



function recargarLista3(){

	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=calculartotal",
		data:"costo=" + $('#listam').val()+$('#cantm').val(),
		success:function(r){
			$('#itotal').html(r);
		}
	});
}


function vacios(x){

	if(x == 1){
	var lista1    = $('#lista1').val();
		var lista2         = $('#lista2').val();
		var lista3         = $('#lista3').val();
		var cant         = $('#cant').val();
		var fechai        = $('#fechai').val();
		var hora         = $('#hora').val();
		var horometro         = $('#horometro').val();
		var diesel         = $('#diesel').val();
		var ubicacion        = $('#ubicacion').val();
		var marcabateria         = $('#marcabateria').val();
		var condiciones         = $('#condiciones').val();
		var tuercas         = $('#tuercas').val();
		var accesorios        = $('#accesorios').val();



		if(diesel == "" || cant == "" || fechai == "" || hora == "" || ubicacion == "" || marcabateria == "" || lista1 == 0 || lista2 == 0 || lista3 == 0 || horometro == "" || accesorios == "" || tuercas == "" || condiciones == ""){
			$('#button').prop( "disabled", true );
			document.getElementById('button').style.background  = "black";		
			document.getElementById('vacio').style.display  = "block";
		}else{
			$('#button').prop( "disabled", false );
		document.getElementById('button').style.background  = "#3c8dbc";
		document.getElementById('vacio').style.display  = "none";		
		}
	}else if(x == 0){
    var descripcion = $('#descripcion').val();
	var equiposrequeridos = $('#equiposrequeridos').val();
    if(descripcion == "" || equiposrequeridos == "" ){
		$('#button1').prop( "disabled", true );
		document.getElementById('button1').style.background  = "black";		
		document.getElementById('vacio').style.display  = "block";
	}else{
		$('#button1').prop( "disabled", false );
	document.getElementById('button1').style.background  = "#3c8dbc";
	document.getElementById('vacio').style.display  = "none";		
	}
	}


}



function inicioEvent(x){
	/*Para bloquear la opcion de busqueda del prefijo en clientes*/
  	if (x == 0) {
    	var tag    = "tag";
  	}else{
    	var tag    = "tag1";
  	}

  	document.getElementById(tag).style.display='none';
}

/*Buscador de prefijo, muestra las que estan en la base de datos*/
function ExistePrefijo(x){
	if (x == 0) {
		var div     = "#container_tags";
		var espera  = "loading";
		var prefijo = 'prefijo';
	}else{
		var div     = "#container_tags1";
		var espera  = "loading1";
		var prefijo = 'prefijoMD';
	}

	var valorPF = $('#'+prefijo).val();	
	var Dato = "&prefijo="+valorPF+"&x="+x+"&dato=consultarPrefijo";
	
	$.ajax({
      url: "modules/clientes/proses.php",
      type: "POST",
      data: Dato,
      dataType: "json",
      beforeSend: function() {	      	
      	$('#'+espera).css("text-align", "center");
      	$('#'+espera).css("position", "absolute");
      	$('#'+espera).css("width", "191px");
      	$('#'+prefijo).css("color", "transparent");
		    $('#'+espera).empty().append('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span class="sr-only">Loading...</span>');
	  }   
    }).done(function(r){	
  	    $('#'+prefijo).css("color", "#555");
  		$('#'+espera).empty().append("");
  		$(div).empty().append(r);				
    });
	
}

function ocultarPrefijo(x){
  if (x == 0) {
    var tag    = "tag";
  }else{
    var tag    = "tag1";
  }

  document.getElementById(tag).style.display='none';
}

function updatePrefijo(x, prefijo){
	if (x == 0) {
		var PF = 'prefijo';
	}else{
		var PF = 'prefijoMD';
	}
	$('#'+PF).val(prefijo);
}






//Mostar js agregar

var a = 2, b = 2, idM, idM2, idP, idP2, idA, valor, v, va, nomArchivo, filename;

function inicial(x){   
  //(modal agregar)
  $('body #material').on('change', 'input', function(){
    //   mostrarTotalRenta(x);
  }); 
  //(modal modificar)
  $('body #material2').on('change', 'input', function(){
    //   mostrarTotalRenta(x);
  }); 
   
  //obtiene el valor del id del select (modal agregar)
  $('body #material').on('change', 'select', function(){
    idM = $(this).attr('id');
    //   mostrardescripcionC(x);
    //   mostrarTotalRenta(x);
  });    

  $('body #personal').on('change', 'select', function(){
      idP = $(this).attr('id');
  }); 

  //obtiene el valor del id del select (modal modificar)
  $('body #material2').on('change', 'select', function(){
    idM2 = $(this).attr('id');
    //if (x == 1) { recargarCodigos2(a,x); }
    //   mostrardescripcionC(x);
    //   mostrarTotalRenta(x);
  });    

  $('body #personal2').on('change', 'select', function(){
      idP2 = $(this).attr('id');   
  });       

  // evento para eliminar la fila (modal agregar)
  $("#agregarM").on("click", ".del", function(){
    $(this).parents("tr").remove();
    // mostrarTotalRenta(x);//para mostar total de renta
    

     var   listarm    = $(`#listarm`);
     if(listarm!=='undefinided'){
          sumarPrecio();
     }
  });

  $("#agregarP").on("click", ".del", function(){
      $(this).parents("tr").remove();
  });

  // evento para eliminar la fila en (modal modificar)
  $("#agregarM2").on("click", ".del", function(){
    $(this).parents("tr").remove();
    // mostrarTotalRenta(x);//para mostar total de renta
  });

  $("#agregarP2").on("click", ".del", function(){
      $(this).parents("tr").remove();
  });

  //obtiene el valor del id del checkbox (modal agregar/modificar)
  $('body #ArchivoAdjunto').on('change', 'input', function(){   
    
    idA = $(this).attr('id'); 
    
    if (idA.substr(0,7) == 'archivo') {
      valor = idA.substr(7);

      validarArchImag(valor,x);
    };    
  });

  //para que el input de ese checkbox sea llenado
  if (x == 1) {
    var checkNP      = "checkboxNP2",        checkAD  = "checkboxAD2", checkT  = "checkboxT2", checkV  = "checkboxV2", checkC  = "checkboxC2", checkAM  = "checkboxAM2", checkP = "checkboxP2", checkB = "checkboxB2";
    var DivNP        = "NP2",                DivAD    = "AD2",         DivT    = "T2",         DivV    = "V2",         DivC    = "C2",         DivAM    = "AM2",         DivP   = "P2",         DivB   = "B2";
    var boton        = 'button2';
    var IPDesplante  = 'AlturadeDesplante2', IPvolado = 'volado2',  IPcolgante = 'colgante2';

  }else{
    var checkNP      = "checkboxNP",     checkAD  = "checkboxAD",  checkT  = "checkboxT",  checkV  = "checkboxV",  checkC  = "checkboxC", checkAM  = "checkboxAM", checkP = "checkboxP", checkB = "checkboxB";
    var DivNP        = "NP",             DivAD    = "AD",          DivT    = "T",          DivV    = "V",          DivC    = "C",         DivAM    = "AM",         DivP   = "P",         DivB   = "B";
    var boton        = 'button';
    var IPDesplante  = 'AlturadeDesplante',  IPvolado = 'volado',   IPcolgante = 'colgante';
  }

  $('#'+checkAD).change(function(){   
    if ($('#'+checkAD).prop('checked')) {
      $('#'+IPDesplante).prop( "required", true );
      $('#'+IPDesplante).prop( "disabled", false );
    }else{
      $('#'+IPDesplante).prop( "required", false ).val("");
      $('#'+IPDesplante).prop( "disabled", true );
    }
  });

  $('#'+checkV).change(function(){
    if ($('#'+checkV).prop('checked')) {
      $('#'+IPvolado).prop( "required", true );
      $('#'+IPvolado).prop( "disabled", false );
    }else{
      $('#'+IPvolado).prop( "required", false ).val("");
      $('#'+IPvolado).prop( "disabled", true );
    }
  });

  $('#'+checkC).change(function(){
    if ($('#'+checkC).prop('checked')) {
      $('#'+IPcolgante).prop( "required", true );
      $('#'+IPcolgante).prop( "disabled", false );
    }else{
      $('#'+IPcolgante).prop( "required", false ).val("");
      $('#'+IPcolgante).prop( "disabled", true );
    }
  });

  $(document).click(function(){
    //para que se seleccione un checkbox
    if ($('#'+checkNP).prop('checked') || $('#'+checkAD).prop('checked') || $('#'+checkT).prop('checked') || $('#'+checkV).prop('checked') || $('#'+checkC).prop('checked') || $('#'+checkAM).prop('checked') || $('#'+checkP).prop('checked') || $('#'+checkB).prop('checked')) {
      document.getElementById(DivNP).style.color = "black";
      document.getElementById(DivAD).style.color = "black";
      document.getElementById(DivT).style.color  = "black";
      document.getElementById(DivV).style.color  = "black";
      document.getElementById(DivC).style.color  = "black";
      document.getElementById(DivAM).style.color = "black";
      document.getElementById(DivP).style.color  = "black";
      document.getElementById(DivB).style.color  = "black";
      $('#'+boton).prop( "disabled", false );
      document.getElementById(boton).style.background  = "#3c8dbc";

    }else{
      document.getElementById(DivNP).style.color = "red";
      document.getElementById(DivAD).style.color = "red";
      document.getElementById(DivT).style.color  = "red";
      document.getElementById(DivV).style.color  = "red";
      document.getElementById(DivC).style.color  = "red";
      document.getElementById(DivAM).style.color = "red";
      document.getElementById(DivP).style.color  = "red";
      document.getElementById(DivB).style.color  = "red";
     
      if(x == 0){        
        if($('#Candado').val() != 1){
          $('#'+boton).prop( "disabled", true ); 
          document.getElementById(boton).style.background  = "black";
        }
      }else{
         $('#'+boton).prop( "disabled", true ); 
         document.getElementById(boton).style.background  = "black";
      }      
    }

    if($('#Candado').val() != 1){
      $('#codigo_1').prop( "required", true );
      $('#nombre_1').prop( "required", true );
    }
  });

  $("[type='submit']").click(function(){
    
    var longitud     = $('#largo').val();
    var ancho        = $('#ancho').val();
    var altura       = $('#altura').val();
    var F_Dificultad = $('#fDif').val();

    if (longitud == '') {
      $('#largo').val("0.00");
    }
    if (longitud == '') {
      $('#ancho').val("0.00");
    }
    if (longitud == '') {
      $('#altura').val("0.00");
    }
    if (longitud == '') {
      $('#fDif').val("0.00");
    }
  });
  
  /*Para bloquear la opcion de busqueda del sp en hojas trabajo*/
  if (x == 0) {
    var tag    = "tag";
  }else{
    var tag    = "tag1";
  }

  document.getElementById(tag).style.display='none';
}//Fin función inicial

/* Funcion para añadir una nueva fila en la tabla material.
 * y -> el numero que esta en el id, ejem: codigo2
 * x -> 0 si es modal agregar y 1 modal modificar
 */
function addFilasEnTablaMaterial(y,x){
  var r = true;
  
  for (let i = 1; i <= $('#bandera').val(); i++) {
if($(`#total_${i}`).val() != undefined && $(`#codigo_${i}`).val() != "0" ){
  if($(`#codigo_${i}`).val() == "0" || $(`#fechai_${i}`).val() == "" || $(`#total_${i}`).val() == "$0"  ){
  r = true;
  }else{
	r = false;	
  document.getElementById(`codigo_${i}`).disabled = true ;
 }
}else if ($(`#codigo_${i}`).val() == "0"){
  r = true;
}
  }
 
 

  if(!r){
   if(y == ''){

        var valorFila = 'addFilasEnTablaMaterial("",0)';
      
        bandera=document.getElementById('bandera').value;               
        if(bandera>0){
            a= parseInt(bandera);
        }
      
   }else{
      var valorFila = 'addFilasEnTablaMaterial("2",1)';
   }

   
  var nuevaFila = `
        <tr id="${(a+1)}" class="remueve-agregadas">
            
      
            <td colspan='2'>
         <div class="form-group"  oninput="document.getElementById('total_${(a+1)}').value='$0'"  onchange="descripcionCodigo(${(a+1)},0)">
         <div class="col-sm-7" id="listae${y}_${(a+1)}" style=" width:auto;">
         </div>
         </div>
           </td>

			<td colspan='2'>
			<label id='modelo${y}_${(a+1)}' name='modelo${y}_${(a+1)}'></label>
			<div id="alert_1" ></div>
		  
			<td>
			<label id='descrip${y}_${(a+1)}' name='descrip${y}_${(a+1)}' >
		  </td>
     
         
		  <td colspan='3'>
		  <div class="form-group"  onchange="recargarLista2(${(a+1)});">
		  <div class="col-sm-7" id="listaview${y}_${(a+1)}" style=" width:auto;">
		</div>
		</div>
		  </td>

		 
<td> 

</td>

		  </td>
		  <td colspan='1'>
		  <div class="form-group">
<div class="col-sm-7" style=" width:auto;">
<input type="date" id="fechai${y}_${(a+1)}" name="fechai${y}_${(a+1)}" class="form-control" required="required" maxlength="15">
</div>
</div>
		  </td>

      <td colspan="1">
      <div class="form-group">
      <div  class="col-sm-7"  style=" width:auto;">
      <input id="descuento${y}_${(a+1)}" type="range" min="0" max="15" step="0.01" oninput="document.getElementById('out${y}_${(a+1)}').value='%'+value"  onchange="recargarLista2(${a+1});" list="puntos">
      <output id="out${y}_${(a+1)}" name="out">0</output>
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


		  <td colspan="2">
		  <div class="form-group" width='80px'>
<div id= "itotal${y}_${(a+1)}" class="col-sm-7" style=" width:auto;">
</div>
</div>
		  </td>

            <td>
              <div>
                <a type='button' class='del btn btn-danger pull-right' onclick="restarbandera();" title='Eliminar Fila' data-toggle='tooltip' value='Eliminar Fila' style='width: 25px; height: 20px; padding: 0;'>
                  <i class='fa fa-minus'></i>
                </a>
              </div>
            </td>
        </tr>`;
    
    $("#agregarM"+y+" #material"+y).append(nuevaFila);
    a = a + 1;
    recargarCodigos(a);

     $("#canMaterial"+y).val(a);
    
    if(y == ''){
        if(bandera>0){     //G
            $("#bandera"+y).val(a);
        }
    }
  }

}

function restarbandera(){
  bandera=document.getElementById('bandera').value;               
  if(bandera>0){
      a= parseInt(bandera);
  }
  a = a - 1;
  $("#bandera").val(a);
  document.getElementById(`codigo_${a}`).disabled = false;
}


/* Funcion para añadir una nueva fila en la tabla personal.
 * y -> el numero que esta en el id, ejem: nombre2
 * x -> 0 si es modal agregar y 1 modal modificar
 */
function addFilasEnTablaPersonal(y,x){  
    if(y == ''){
        var valorFila2 = 'addFilasEnTablaPersonal("",0)';
    }else{
        var valorFila2 = 'addFilasEnTablaPersonal("2",1)';
    }
    var nuevaFila = `
        <tr id="${(b+1)}" class="remueve-agregadasP">
            <td colspan='2'>
                <select id='nombre${y}_${(b+1)}' name='nombre${y}_${(b+1)}' class='form-control' onchange='mostrarPuestonombe(this,${x});'>
                    <option value='' selected=''></option>
                </select>
            </td>
            <td colspan='2'>
                <select id='puesto${y}_${(b+1)}' name='puesto${y}_${(b+1)}' class='form-control'>
                    <option value=''></option>
                </select>
            </td>
            <td colspan='2'>
                <select id='nombre${y}_${(b+2)}' name='nombre${y}_${(b+2)}' class='form-control' onchange='mostrarPuestonombe(this,${x});' onfocus='${valorFila2}'>
                    <option value='' selected=''></option>
                </select>
            </td>
            <td colspan='2'>
                <select id='puesto${y}_${(b+2)}' name='puesto${y}_${(b+2)}' class='form-control'>
                    <option value=''></option>
                </select>
            </td>
            <td>
              <div>
                <a type='button' class='del btn btn-danger pull-right' title='Eliminar Fila' data-toggle='tooltip' value='Eliminar Fila' style='width: 25px; height: 20px; padding: 0;'>
                  <i class='fa fa-minus'></i>
                </a>
              </div>
            </td>
        </tr>`;

    $("#agregarP"+y+" #personal"+y).append(nuevaFila);
    b = b + 2;  
    recargarPersonal(b,x);  
    recargarPuestoP(b,x);  
  $("#canPersonal"+y).val(b);
}

function mostrar(x){ //mostrar codigos y personal en el select inicial
 
   if (x == 1) {
      var montaje        = $('#montajeM').val(); 
      var montajeReal    = 'montajeRealM';
      var hrsArmado      = 'hrsArmadoM';
      var desmontaje     = 'desmontajeM';
      var desmontajeReal = 'desmontajeRealM';
      var hrsDesarmado   = 'hrsDesarmadoM';
      var Vacio1         = 'Vacio1M';
      var Vacio2         = 'Vacio2M';
      var Vacio3         = 'Vacio3M';
      var Vacio4         = 'Vacio4M';
   }else{
      var montaje        = $('#montaje').val(); 
      var montajeReal    = 'montajeReal';
      var hrsArmado      = 'hrsArmado';
      var desmontaje     = 'desmontaje';
      var desmontajeReal = 'desmontajeReal';
      var hrsDesarmado   = 'hrsDesarmado';
      var Vacio1         = 'Vacio1';
      var Vacio2         = 'Vacio2';
      var Vacio3         = 'Vacio3';
      var Vacio4         = 'Vacio4';
   }
   
   if (montaje == '') {
      $('#' + montajeReal).prop( "disabled", true ).val("");
      $('#' + hrsArmado).prop( "disabled", true ).val("");
      $('#' + desmontaje).prop( "disabled", true ).val("");
      $('#' + desmontajeReal).prop( "disabled", true ).val("");
      $('#' + hrsDesarmado).prop( "disabled", true ).val("");

      document.getElementById(Vacio1).style.display  = "none";
      document.getElementById(Vacio2).style.display  = "none";
      document.getElementById(Vacio3).style.display  = "none";
      document.getElementById(Vacio4).style.display  = "none";

   }else{
      $('#' + montajeReal).prop( "disabled", false );
      $('#' + hrsArmado).prop( "disabled", false );
      $('#' + desmontaje).prop( "disabled", false );
      $('#' + desmontajeReal).prop( "disabled", false );
      $('#' + hrsDesarmado).prop( "disabled", false );
   }
}

function mostrarPersonal(b,x){
   recargarPersonal(b,x);
   recargarPuestoP(b,x); 
}

function mostrarProyectos(x){
    if (x == 1) {
      var planta    = $('#planta2').val();
      var nProyecto = 'nProyecto2';
      var cargo     = 'cargo2';
    }else{
      var planta    = $('#planta1').val();
      var nProyecto = 'nProyecto';
      var cargo     = 'cargo';
    }

    var sDatos = "&planta="+planta+"&x="+x+"&dato=mostrar_nProyecto";

    $.ajax({
      url: "modules/hojas_trabajo/proses.php",
      type: "POST",
      data: sDatos,
        success:function(r){          
           $('#'+nProyecto).html(r);         
      }
    });

    var Dato = "&planta="+planta+"&x="+x+"&dato=mostrar_cargo";

    $.ajax({
      url: "modules/hojas_trabajo/proses.php",
      type: "POST",
      data: Dato,
        success:function(r){          
           $('#'+cargo).html(r);         
      }
    });

    if (planta != '') {
      $('#'+nProyecto).prop( "disabled", false ).val("");
      $('#'+cargo).prop( "disabled", false ).val("");
    }else{
      $('#'+nProyecto).prop( "disabled", true ).val("");
      $('#'+cargo).prop( "disabled", true ).val("");
    }
}
function mostrarCargo(){
    
      var x=0;
      var planta    = $('#planta1').val();
      var nProyecto = 'nProyecto';
      var cargo     = 'cargo';
    


    var Dato = "&planta="+planta+"&x="+x+"&dato=mostrar_cargo";

    $.ajax({
      url: "modules/hojas_trabajo/proses.php",
      type: "POST",
      data: Dato,
        success:function(r){          
           $('#'+cargo).html(r);         
      }
    });

    if (planta != '') {
      $('#'+nProyecto).prop( "disabled", false ).val("");
      $('#'+cargo).prop( "disabled", false ).val("");
    }else{
      $('#'+nProyecto).prop( "disabled", true ).val("");
      $('#'+cargo).prop( "disabled", true ).val("");
    }
}

function mostrarUsuario(x){
        
    if (x == 1) {
      var nProyecto  = $('#nProyecto2').val();
      var user       = 'usuario2';
      var tipoPrecio = 'tipoPrecio2';
    }else{
      var nProyecto  = $('#nProyecto').val();
      var user       = 'usuario';
      var tipoPrecio = 'tipoPrecio';
    }
        
    var sDatos = "&nProyecto="+nProyecto+"&dato=mostrar_usuario";

    $.ajax({
      url: "modules/hojas_trabajo/proses.php",
      type: "POST",
      data: sDatos,
        success:function(r){          
           $('#'+user).html(r);         
      }
    });

    if (nProyecto != '') {
      var sDatos = "&nProyecto="+nProyecto+"&dato=mostrar_tipoPrecio";

      $.ajax({
        url: "modules/hojas_trabajo/proses.php",
        type: "POST",
        data: sDatos,
          success:function(r){         
            var TP  = r.replace('\"', ''); 
            var tP  = TP.replace('\"', ''); 
            $('#'+tipoPrecio).val(tP);    
       
            mostrarTotalRenta(x);
        }
      });
      
      $('#'+user).prop( "disabled", false ).val("");      
      
    }else{
      $('#'+user).prop( "disabled", true ).val("");
    }
}

/*muestra los codigos en el select*/
function recargarCodigos(valor){
  
  var sDatos = "&bandera="+$('#bandera').val()+"&a="+valor+"&dato=datos_codigos"+"&ne=";


  for (let i = 1; i <= valor; i++) {
   
    if($(`#codigo_${i} option:selected`).attr("value") !== undefined){
   sDatos = sDatos+","+$(`#codigo_${i} option:selected`).attr("value");
    }
  }
  
  

  $.ajax({
    type:"POST",
    url:"modules/Renta/proses.php",
    data: sDatos,
    success:function(r){
      $('#listae_'+valor).html(r);
    
    }
  }
  );
}

/*Para mostrar la descripcion despues de seleccionar algun codigo en el select*/
function descripcionCodigo(valor,x){ 
 let modelo;
  if (x == 0) {
    modelo = $(`#codigo_${valor} option:selected`).attr("title")
    modelov  = 'modelo_' + valor;
    descrip = 'descrip_' + valor;
  }else{
    modelo = $(`#codigo2_${valor} option:selected`).attr("title")
    modelov  = 'modelo_'+valor;
    descrip = 'descrip_' + valor;
  }

  if (typeof modelo == 'undefined') {
    $('#'+modelov).text(""); 
    $('#'+descrip).val("");
  }else{
    $('#'+modelov).text(modelo);
	$('#'+descrip).text($(`#codigo_${valor} option:selected`).attr("descripcion"));
  }    
 
  $.ajax({
	type:"POST",
	url:"modules/Renta/proses.php?act=recargar_plan",
	data:"a="+valor+"&idt="+$(`#codigo_${valor} option:selected`).attr("tipo")+"-"+"v",
	success:function(r){
		$('#listaview_'+valor).html(r);

	}
});

$.ajax({
	type:"POST",
	url:"modules/Renta/proses.php?act=recargar_clientes",
	data:"a="+valor,
	success:function(r){
		$('#listac_'+valor).html(r);

	}
});

}


/*muestra el personal en el select*/
function recargarPersonal(b,x){
  var sDatos = "&x="+x+"&dato=datos_personal";

  $.ajax({
      url: "modules/hojas_trabajo/proses.php",
      type: "POST",
      data: sDatos,
      success:function(r){
        var n=1;
        if (x == 0) {
        while(n <= b){ 
            if ($('#nombre_'+n).val() == '') {
               $('#nombre_'+n).html(r);
               ordenarASC('nombre_'+n);
            }
            n++;
        }
        }else{
          while(n <= b){
            if ($('#nombre2_'+n).val() == '') {
               $('#nombre2_'+n).html(r);
               ordenarASC('nombre2_'+n);
            }
            n++;
        }
        }
      }
  });
}

/*muestra el puesto personal en el select*/
function recargarPuestoP(b,x){
  var sDatos = "&x="+x+"&dato=datos_puestoP";

  $.ajax({
      url: "modules/hojas_trabajo/proses.php",
      type: "POST",
      data: sDatos,
      success:function(r){
        var n=1;
        if (x == 0) {
          while(n <= b){
              if ($('#puesto_'+n).val() == '') {
                 $('#puesto_'+n).html(r);
              }
              n++;
          }
        }else{
          while(n <= b){
            if ($('#puesto2_'+n).val() == '') {
               $('#puesto2_'+n).html(r);
            }
            n++;
        }
        }       
      }
  });
}

function mostrarPuestonombe(a,x){ /*Para mostrar el puesto del personal que se selecciono*/
  var id     = a.id;
  if (x == 1) {
    var valor  = id.substr(8);
    var puesto = '#puesto2_' + valor;
  }else{
    var valor  = id.substr(7);
    var puesto = '#puesto_' + valor;
  }
  
  var nombre = $('#'+id).val();
   
  var sDatos = "&nombre="+nombre+"&dato=datos_puestoPnombre";

  $.ajax({
      url: "modules/hojas_trabajo/proses.php",
      type: "POST",
      data: sDatos,
      success:function(r){
         $(puesto).html(r);               
      }
  });
}

//Funcion para hacer aparecer una alerta por medio de un boton y mostrar informacion.
function alert_cmentario(n, comentario, opcion = 0){
  var text; var text2; var texto;

  if(opcion == 1){
    text = $('#alert_comentario'+ n).html();
    text2 = text.replace(/<br \/>/gi,"\n");
    texto = text2 + "\n\n" + comentario;
  }else{
    texto = comentario;
  }   

  alert(texto);
}



//gabriel
function sumarPrecio(valor){
  

 //   codigo    = $(`#codigo_${valor}`).val();
   var  canMaterial    = $(`#canMaterial`).val();
   var   listarm    = $(`#listarm`).val();
   var piezas='piezas';
   var totalPrecio=0;
   var codigo="";
   codigo    = $(`#codigo_1`).val();


        //    $array[$i][0]=$data['codigo'];
        //    $array[$i][1]=$data['precio2020'];
        //    $array[$i][2]=$data['precioAnterior'];
        //    $array[$i][3]=$data['cabot'];
    var noPrecio=0;

    if(listarm=='precio2020'){
      noPrecio=1;
    }else if(listarm=='precioAnterior'){
      noPrecio=2;
    }else if(listarm=='cabot'){
      noPrecio=3;
    }
    

  $.ajax({
      url: "modules/hojas_trabajo/proses.php",
      type: "POST",
      data: {listarm:listarm,act:piezas},
      success:function(array){
   
       try {

  let filas=JSON.parse(array);
  var m=1;
  while(m<=canMaterial){



  codigo    = $(`#codigo_`+m).val();
  cantidad    = parseFloat($(`#cantidad_`+m).val());
  if(typeof codigo !== 'undefined' && !isNaN(cantidad)  ){
  
  cantidad    = parseFloat($(`#cantidad_`+m).val());

  for(let i=0; i< filas.length;i++){

  if(filas[i][0]==codigo){

  totalPrecio= totalPrecio + (cantidad * parseFloat(filas[i][noPrecio]));
 
  }


  }//endFors
   
  }//endif

 m++;
}//endwhile
 
 }catch (error) {
 
 
}
totalPrecio= totalPrecio.toFixed(2);

 var  inputTotalUtilizado =document.getElementById("total_utilizado");
 inputTotalUtilizado.value=totalPrecio;

      }

  }); 

}
