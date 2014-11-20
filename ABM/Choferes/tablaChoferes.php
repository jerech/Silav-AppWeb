<?php
	include("conexionBD.php");
	echo "<table id='tablaChoferes' align='center'>";
    echo "<thead>";
    echo "<th>Usuario</th><th>Password</th><th>Nombre</th><th>Apellido</th><th>Telefono</th><th>Venc. Licencia</th><th>Habilidado</th><th>Moviles</th>";
    echo "</thead>";
	echo "<tbody>";
	$color = 0;
	$conectar = establecerConexion();
    $sql = "SELECT id,usuario,contrasenia,nombre,apellido,numero_telefono,venc_licencia,habilitado FROM Choferes";
    $select = mysql_query($sql,$conectar);
	if($select){
		while($fila = mysql_fetch_array($select)){
			
			$sqlmoviles = "SELECT Moviles.numero FROM Moviles INNER JOIN AsignacionesMovil ON Moviles.id = AsignacionesMovil.id_movil INNER JOIN Choferes ON AsignacionesMovil.id_chofer = Choferes.id WHERE Choferes.usuario='$fila[1]' order by Moviles.numero";			
			$consulta=mysql_query($sqlmoviles,$conectar);
			$moviles="";
			while($arrayMoviles=mysql_fetch_array($consulta)){
					$moviles=$moviles.$arrayMoviles[0]."-";
			}
							
			if($color == 0){
?>
				<tr style='background-color:#ADD8E6;'>
				<td><?=$fila[1]?></td>
				<td><?=$fila[2]?></td>
				<td><?=$fila[3]?></td>
				<td><?=$fila[4]?></td>
				<td><?=$fila[5]?></td>
				<td><?=$fila[6]?></td>
				<td><?=$fila[7]?></td>
				<td><?=$moviles?></td>
				<td><a href='javascript:fnc_editar(<?=$fila[0]?>);'>Editar</td>
				<td><a href='javascript:fnc_eliminar(<?=$fila[0]?>);'>Eliminar</td>
				</tr>
<?php
				$color = 1;
			}else if($color == 1){
?>
				<tr style='background-color:#D5E6EC;'>
				<td><?=$fila[1]?></td>
				<td><?=$fila[2]?></td>
				<td><?=$fila[3]?></td>
				<td><?=$fila[4]?></td>
				<td><?=$fila[5]?></td>
				<td><?=$fila[6]?></td>
				<td><?=$fila[7]?></td>
				<td><?=$moviles?></td>
				<td><a href='javascript:fnc_editar(<?=$fila[0]?>);'>Editar</td>
				<td><a href='javascript:fnc_eliminar(<?=$fila[0]?>);'>Eliminar</td>
				</tr>
<?php
				$color = 0;
			}
		}
		mysql_close($conectar);//Cerramos la conexion
	}else{
		 mysql_close($conectar); //Cerramos la conexion
	}
	
	echo "</tbody>";
	echo "</table>";

?>