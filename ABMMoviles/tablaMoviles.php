<?php
	include("conexionBD.php");
	echo "<table cellpadding='3' cellspacing='3' style='width:1000px; border:solid 1px #CCC;' align='center'>";
    echo "<thead>";
    echo "<th>Num. Movil</th><th>Patente</th><th>Marca</th><th>Modelo</th><th>Venc. Seguro</th><th>A.A.</th><th>GNC</th>";
    echo "</thead>";
	echo "<tbody>";
	$color = 0;
	$conectar = establecerConexion();
    $sql = "SELECT numero,patente,marca,modelo,vencseguro,aa,gnc FROM Moviles";
    $select = mysql_query($sql,$conectar);
	if($select){
		while($fila = mysql_fetch_array($select)){
			if($color == 0){
?>
				<tr style='background-color:#ADD8E6;'>
				<td><?=$fila[0]?></td>
				<td><?=$fila[1]?></td>
				<td><?=$fila[2]?></td>
				<td><?=$fila[3]?></td>
				<td><?=$fila[4]?></td>
				<td><?=$fila[5]?></td>
				<td><?=$fila[6]?></td>
				<td><a href='javascript:fnc_eliminar(<?=$fila[0]?>);'>Eliminar</td>
				<td><a href='javascript:fnc_editar(<?=$fila[0]?>);'>Editar</td>
				</tr>
<?php
				$color = 1;
			}else if($color == 1){
?>
				<tr style='background-color:#D5E6EC;'>
				<td><?=$fila[0]?></td>
				<td><?=$fila[1]?></td>
				<td><?=$fila[2]?></td>
				<td><?=$fila[3]?></td>
				<td><?=$fila[4]?></td>
				<td><?=$fila[5]?></td>
				<td><?=$fila[6]?></td>
				<td><a href='javascript:fnc_eliminar(<?=$fila[0]?>);'>Eliminar</td>
				<td><a href='javascript:fnc_editar(<?=$fila[0]?>);'>Editar</td>
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