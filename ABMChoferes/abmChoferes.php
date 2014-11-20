<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ABM Choferes</title>
	</head>
	<body>
		<table align="center" width="1000" cellpadding="0" cellspacing="0">
			<tr>
			<div>
				<!--Formulario con tabla contenedora de datos de Movil-->
				<form id="formulario">
					
					<table cellpadding="6px" align="center" style="border:solid 1px #CCC;">
						<tr>
							<td><label>Usuario:</label> <input type="text" name="usuario" id="usuario"/></td>
							<td><label>Password:</label> <input type="text" name="pass" id="pass"/></td>
							<td><label>Venc. Licencia:</label> <input type="text" name="venclicencia" id="venclicencia"/></td>
						</tr>
						<tr>
							<td align="right"><label>Nombre:</label> <input type="text" name="nombre" id="nombre"/></td>
							<td><label>Telefono:</label> <input type="text" name="telefono" id="telefono"/></td>
							<td rowspan="2"><label>Moviles:</label><select name="listamoviles" id="listamoviles"/></td>
						</tr>
						<tr>
							<td><label>Apellido:</label><input type="text" id="apellido" name="apellido"></td>
							<td><label>Habilitado:</label><input type="checkbox" id="habilitado"/></td>
							
						</tr>
						<tr>
							<td></td>
							<td colspan=3 align="right"><input type="button" id="guardar" value="Guardar" name="guardar"> <input type="button" value="Limpiar" id="limpiar"></td>
						</tr>
						<tr>
							<td colspan="3">
							<!-- Etiqueta que muestra mensaje -->
							<div id="estado" style="text-align:center;"></div>
							</td>
						</tr>
					</table>
				</form></br>
			</div>
			</tr>
			<tr>
				<div id="listado"></div>
				
			</tr>
		</table>
	
	</body>
</html>