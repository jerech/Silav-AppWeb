<?php
	include("conexionBD.php");
	echo "<table class='tabla-abm'>";
    echo "<tr>";
    echo "<td>Usuario</td><td>Password</td><td>Nombre</td><td>Apellido</td><td>Telefono</td><td>Venc. Licencia</td><td>Habilidado</td><td>Sexo</td><td>Moviles</td>";
    echo "</tr>";

	$conectar = establecerConexion();
    $sql = "SELECT id,usuario,contrasenia,nombre,apellido,numero_telefono,venc_licencia,habilitado,sexo FROM Choferes order by apellido";
    $select = mysql_query($sql,$conectar);
	if($select){
		while($fila = mysql_fetch_array($select)){
			
			$sqlmoviles = "SELECT Moviles.numero FROM Moviles INNER JOIN AsignacionesMovil ON Moviles.id = AsignacionesMovil.id_movil INNER JOIN Choferes ON AsignacionesMovil.id_chofer = Choferes.id WHERE Choferes.usuario='$fila[1]' order by Moviles.numero";			
			$consulta=mysql_query($sqlmoviles,$conectar);
			$moviles="";
			$flagPrimerEntrada = true;
			while($arrayMoviles=mysql_fetch_array($consulta)){
				if($flagPrimerEntrada){
						$moviles=$arrayMoviles[0];
						$flagPrimerEntrada = false;
						}else {
							$moviles=$moviles."-".$arrayMoviles[0];						
							}
					
			}
							
			
?>
				<tr>
				<td><?=$fila[1]?></td>
				<td><?=$fila[2]?></td>
				<td><?=$fila[3]?></td>
				<td><?=$fila[4]?></td>
				<td><?=$fila[5]?></td>
				<td><?=$fila[6]?></td>
				<td><?=$fila[7]?></td>
				<td><?=$fila[8]?></td>
				<td><?=$moviles?></td>
				<td><a href='javascript:fnc_editar(<?=$fila[0]?>);'>Editar</td>
				<td><a href='javascript:fnc_eliminar(<?=$fila[0]?>);'>Eliminar</td>
				</tr>
<?php
				
		}
		mysql_close($conectar);//Cerramos la conexion
	}else{
		 mysql_close($conectar); //Cerramos la conexion
	}
	
	echo "</table>";

?>