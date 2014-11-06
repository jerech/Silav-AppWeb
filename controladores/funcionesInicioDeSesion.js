function abrirPaginaPrincipal() {
	usuario = document.getElementById('usuario').value;
	clave = document.getElementById('clave').value;
	usuarioValido = validarUsuario(usuario);
	claveValida = validarClave(clave);
	
	if (usuarioValido == true) {
		if (usuario == "sebastian") {
			if (claveValida == true) {
				if (clave == "sebastian") {
					window.open("paginaPrincipal.html");
					window.close("inicioDeSesion.html");
				}
			   else {
			   	alert("Contraseña incorrecta");	
			   }		
			}
			else {
				alert("Debe ingresar una contraseña");
			}		
		}
		else {
			alert("Usuario incorrecto");	
		}		
	}
	else {
		alert("Debe ingresar un nombre de usuario");
	}		
}
function validarUsuario(usuario) {
   if( usuario == null || usuario.length == 0 || /^\s+$/.test(usuario) || !isNaN(usuario)) {
   	return(false);
	}
	else {
		return(true);
	}	
}
function validarClave(clave) {
   if( clave == null || clave.length == 0 || /^\s+$/.test(clave)) {
   	return(false);
	}
	else {
		return(true);
	}	
}