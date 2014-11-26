$(document).ready(function () {
	$("#div-tabla").load("tablaChoferes.php");
	$("#tabla-moviles").load('tablaEdicionMoviles.php');
	
		$("#guardar").click(function () {
		var datosform = $("#formulario").serialize();
		$.ajax({
			type:"POST",
			url: "guardarChoferBD.php",
			data: datosform,
			contentType: "application/x-www-form-urlencoded",		
			beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
			  if(datos == 1){ //Dato que proviene del script php
				 $("#estado").html("Procesado satisfactoriamente"); //Mensaje de Satisfacción
				 $("#div-tabla").load('tablaChoferes.php');
			  }else if(datos == 0){ //Dato que sproviene del script php
				 $("#estado").html("Por favor ingrese todos los datos"); //Mensaje de error
			  }
		   }
		});
	
	
	});
	
	$("#cerrar").click(function () {
		setear_moviles_seleccionados();
		$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
		
	
	});
});

function setear_moviles_seleccionados() {
	var numMovil="", valCheckbox="";
	var movilesCheck="";
	var flagPrimerMovil=true;

	$('#tabla-edit-moviles tbody tr').each(function (index) {
		$(this).children("td").each(function (index2) {
			if(index2==0){
				numMovil=$(this).text();			
			}
			if (index2==4) {
				valCheckbox = $(this).find('.check-edit-moviles').is(':checked');
				if (valCheckbox==true) {
					if(!flagPrimerMovil){		
						movilesCheck=movilesCheck+"-"+numMovil;
					}else {
						movilesCheck=numMovil;
						flagPrimerMovil=false;
					}
				}
			}
		
		});
		
	});
	$("#listamoviles").attr("value", movilesCheck);
}

function mostrar_tabla_moviles() {
	
	var moviles = $("#listamoviles").attr("value");
	var listamoviles="";
	try {
		listamoviles=moviles.split("-");
		checker_moviles_tabla(listamoviles);
	}catch (error) {
		
	}
	$('.overlay-container').fadeIn(function () {
		$('.window-container').addClass('window-container-visible');
	});
	
}

function checker_moviles_tabla(listamoviles) {
	var numMovil="";
	var hacerCheck=false;

	$('#tabla-edit-moviles tbody tr').each(function (index) {
		$(this).children("td").each(function (index2) {
			if(index2==0){
				numMovil=$(this).text();		
				for (var i=0; i<listamoviles.length; i++) {
					if(numMovil==listamoviles[i]){
						hacerCheck=true;					
					}
				}	
			}

			if (index2==4) {				
				if(hacerCheck){
					$(this).find('.check-edit-moviles').prot("checked",true);
				}else {
					$(this).find('.check-edit-moviles').prot("checked",false);
				}
	
			}
		
		});
		hacerCheck=false;
		
	});
	
}


function fnc_eliminar(id){
	  $.ajax({
		   type: "POST", //Establecemos como se van a enviar los datos puede POST o GET
		   url: "eliminarChoferBD.php", //SCRIPT que procesara los datos, establecer ruta relativa o absoluta
		   data: 'id=' + id, //Variable que transferira los datos
		   contentType: "application/x-www-form-urlencoded", //Tipo de contenido que se enviara
		   beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
			  if(datos == 1){ //Dato que proviene del script php
				  $("#div-tabla").load('tablaChoferes.php');
				  $("#estado").html("Proceso realizado correctamente (Eliminar)"); //Mensaje de error
			  }else if(datos == 0){ //Dato que proviene del script php
				 $("#estado").html("Error al procesar script, verifique sus datos"); //Mensaje de error
			  }
		   }
	   });
	}
	
function fnc_editar(id) {
		$.ajax({
			type: "POST",
			url: "consultaChoferBD.php",
			data: 'id=' + id,
			contentType: "application/x-www-form-urlencoded", 
			beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
		   
		   var parametros = datos.split("&&");
		 
		  	$("#nombre").attr("value",parametros[0]);  	
		  	$("#apellido").attr("value",parametros[1]);
		  	$("#usuario").attr("value",parametros[2]);
		  	$("#usuario").attr("readonly",true);
		  	$("#pass").attr("value",parametros[3]);
		  	$("#telefono").attr("value",parametros[4]);
		  	$("#venclicencia").attr("value",parametros[5]);
		  	$("#listamoviles").attr("value",parametros[8]);
		  	
		  	if (parametros[6]=="si") {
		  		$("#habilitado").attr("checked",true);
		  	}
		  	if (parametros[7]=="mujer") {
		  		$("#sexo_m").attr("checked",true);
		  	}else {
		  		$("#sexo_m").attr("checked",false);
		  		}
		  	 		
			$("#estado").html("Movil listo para editar"); 
			  
		   }
						
			});
		}