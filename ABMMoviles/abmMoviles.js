$(document).ready(function () {
	$("#listado").load('tablaMoviles.php'); //Cargamos la lista al inicio
	
	$("#limpiar").click(function () {
		$("#patente").attr("value","");
		$("#patente").attr("readonly",false);
		$("#numero").attr("value","");
		$("#numero").attr("readonly",false);
		$("#marca").attr("value","");
		$("#modelo").attr("value","");
		$("#vencseguro").attr("value",""); 
		$("#aire").attr("checked",false);
		$("#gnc").attr("checked",false);
		$("#estado").html("");
	});
	$("#guardar").click(function (){
	   var datos = $("#formulario").serialize();//Serializamos los datos a enviar
	   $.ajax({
		   type: "POST", //Establecemos como se van a enviar los datos puede POST o GET
		   url: "insertarMovilBD.php", //SCRIPT que procesara los datos, establecer ruta relativa o absoluta
		   data: datos, //Variable que transferira los datos
		   contentType: "application/x-www-form-urlencoded", //Tipo de contenido que se enviara
		   beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
			  if(datos == 1){ //Dato que proviene del script php
				 $("#estado").html("Procesado satisfactoriamente"); //Mensaje de Satisfacción
				 $("#listado").load('tablaMoviles.php');
			  }else if(datos == 0){ //Dato que proviene del script php
				 $("#estado").html("Por favor ingrese todos los datos"); //Mensaje de error
			  }
		   }
	   });
	});
	
	$("body").keydown(function (e) {
	    if(e.which == "13"){
	    	$('#guardar').trigger('click');
	    }
	});

	
});	


	
	
	function fnc_eliminar(id){
	  $.ajax({
		   type: "POST", //Establecemos como se van a enviar los datos puede POST o GET
		   url: "eliminarMovilBD.php", //SCRIPT que procesara los datos, establecer ruta relativa o absoluta
		   data: 'id=' + id, //Variable que transferira los datos
		   contentType: "application/x-www-form-urlencoded", //Tipo de contenido que se enviara
		   beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
			  if(datos == 1){ //Dato que proviene del script php
				  $("#listado").load('tablaMoviles.php');
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
			url: "consultaMovilBD.php",
			data: 'id=' + id,
			contentType: "application/x-www-form-urlencoded", 
			beforeSend: function() {//Función que se ejecuta antes de enviar los datos
			  $("#estado").html("Procesando...."); //Mostrar mensaje que se esta procesando el script
		   },
		   dataType: "html",
		   success: function(datos){ //Funcion que retorna los datos procesados del script PHP
		   
		   var parametros = datos.split("&&");
		  	$("#patente").attr("value",parametros[0]);  
		  	$("#patente").attr("readonly",true);
		  	$("#numero").attr("value",parametros[1]);
		  	$("#numero").attr("readonly",true);
		  	$("#marca").attr("value",parametros[2]);
		  	$("#modelo").attr("value",parametros[3]);
		  	$("#vencseguro").attr("value",parametros[4]);
		  	
		  	if (parametros[5]=="si") {
		  		$("#aire").attr("checked",true);
		  	}
		  	if (parametros[6]=="si") {
		  		$("#gnc").attr("checked",true);
		  	}
		  	 		
			$("#estado").html("Movil listo para editar"); //Mensaje de error
			  
		   }
						
			});
		}
		
	
	
	
	
	
	
	