

function fechaprox(){
	$.ajax({
		type:"POST",
		url:"modules/Renta/proses.php?act=proxima_fecha",
		data:"fecha=" + $('#fecha_man').val(),
		success:function(r){
			$('#prox_fecha').html(r);
		}
	});

}



function camposVacios(x){
	
	if (x == 0) {
		var razonsocial    = $('#razonsocial').val();
		var nombre         = $('#nombre').val();
		var ciudad         = $('#ciudad').val();
		var estado         = $('#estado').val();
		var prefijo        = $('#prefijo').val();
		var razonsocialDIV = 'razonsocial';
		var nombreDIV      = 'nombre';
		var ciudadDIV      = 'ciudad';
		var estadoDIV      = 'estado';
		var prefijoDIV     = 'prefijo';

	}else{
		var razonsocial    = $('#razonsocialMD').val();
		var nombre         = $('#nombreMD').val();
		var ciudad         = $('#ciudadMD').val();
		var estado         = $('#estadoMD').val();
		var prefijo        = $('#prefijoMD').val();
		var razonsocialDIV = 'razonsocialMD';
		var nombreDIV      = 'nombreMD';
		var ciudadDIV      = 'ciudadMD';
		var estadoDIV      = 'estadoMD';
		var prefijoDIV     = 'prefijoMD';
	}


	var cont=0;
	if (razonsocial != "" ) {
		document.getElementById(razonsocialDIV).style.borderColor  = "#d4d8e0";
	}else{
		document.getElementById(razonsocialDIV).style.borderColor  = "red";
		cont++;
	}

	if (nombre != "" ) {
		document.getElementById(nombreDIV).style.borderColor  = "#d4d8e0";
	}else{
		document.getElementById(nombreDIV).style.borderColor  = "red";
		cont++;
	}

	if (ciudad != "" ) {
		document.getElementById(ciudadDIV).style.borderColor  = "#d4d8e0";
	}else{
		document.getElementById(ciudadDIV).style.borderColor  = "red";
		cont++;
	}

	if (estado != "" ) {
		document.getElementById(estadoDIV).style.borderColor  = "#d4d8e0";
	}else{
		document.getElementById(estadoDIV).style.borderColor  = "red";
		cont++;
	}

	if (prefijo != "" ) {
		document.getElementById(prefijoDIV).style.borderColor  = "#d4d8e0";
	}else{
		document.getElementById(prefijoDIV).style.borderColor  = "red";
		cont++;
	}

	if (cont == 0) {
		$('#button').prop( "disabled", false );
		document.getElementById('button').style.background  = "#3c8dbc";
		document.getElementById('vacio').style.display  = "none";		

	}else{		
		$('#button').prop( "disabled", true );
		document.getElementById('button').style.background  = "black";		
		document.getElementById('vacio').style.display  = "block";	
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