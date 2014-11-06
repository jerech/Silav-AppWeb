function asignar() {
	if (document.getElementById('radioAutomatica').checked) {
		direccion = document.getElementById('direccionAutomatica').value;
		numero = document.getElementById('numeroAutomatica').value;
		direccionValida = validarDireccion(direccion);
		numeroValido = validarNumero(numero);
		
		if (direccionValida == true) {
			if (numeroValido == true) {
				//Asignar pasaje
			}
			else {
				alert("El número ingresado es incorrecto");
			}
		}
		else {
			alert("La dirección ingresada es incorrecta");
		}	
	}
	else {
		if (document.getElementById('radioManual').checked) {
		direccion = document.getElementById('direccionManual').value;
		numero = document.getElementById('numeroManual').value;
		chofer = document.getElementById('choferManual').value;
		direccionValida = validarDireccion(direccion);
		numeroValido = validarNumero(numero);
		choferValido = validarChofer(chofer);
		
		if (direccionValida == true) {
			if (numeroValido == true) {
				if (choferValido == true) {
					//Asignar pasaje
				}
				else {
					alert("El número ingresado es incorrecto");	
				}		
			}
			else {
				alert("El número ingresado es incorrecto");
			}
		}
		else {
			alert("La dirección ingresada es incorrecta");
		}	
	}
	}	
}
function habilitarAsignacionAutomatica() {
	document.getElementById('direccionManual').disabled=true;
	document.getElementById('direccionManual').value="";
	document.getElementById('numeroManual').disabled=true;
	document.getElementById('numeroManual').value="";
	document.getElementById('choferManual').disabled=true;
	document.getElementById('choferManual').value="";

	document.getElementById('direccionAutomatica').disabled=false;
	document.getElementById('numeroAutomatica').disabled=false;
}
function habilitarAsignacionManual() {
	document.getElementById('direccionAutomatica').disabled=true;
	document.getElementById('direccionAutomatica').value="";
	document.getElementById('numeroAutomatica').disabled=true;
	document.getElementById('numeroAutomatica').value="";
	
	document.getElementById('direccionManual').disabled=false;
	document.getElementById('numeroManual').disabled=false;
	document.getElementById('choferManual').disabled=false;
}
function validarDireccion(direccion) {
   if( direccion == null || direccion.length == 0 || /^\s+$/.test(direccion) || !isNaN(direccion)) {
   	return(false);
	}
	else {
		return(true);
	}	
}
function validarChofer(chofer) {
   if( chofer == null || chofer.length == 0 || /^\s+$/.test(chofer) || !isNaN(chofer)) {
   	return(false);
	}
	else {
		return(true);
	}	
}
function validarNumero(numero) {
   if( numero == null || numero.length == 0 || /^\s+$/.test(numero) || isNaN(numero)) {
   	return(false);
	}
	else {
		return(true);
	}	
}