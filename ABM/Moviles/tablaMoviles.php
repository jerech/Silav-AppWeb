<?php
	include("../conexionBD.php");
	echo "<table class='tabla-abm'>";
    echo "<tr>";
    echo "<td>Num. Movil</td><td>Patente</td><td>Marca</td><td>Modelo</td><td>Venc. Seguro</td><td>A.A.</td><td>GNC</td>";
    echo "</tr>";

	$conectar = establecerConexion();
    $sql = "SELECT numero,patente,marca,modelo,vencseguro,aa,gnc FROM Moviles order by numero";
    $select = mysql_query($sql,$conectar);
	if($select){
		while($fila = mysql_fetch_array($select)){
		
?>
				<tr>
				<td><?=$fila[0]?></td>
				<td><?=$fila[1]?></td>
				<td><?=$fila[2]?></td>
				<td><?=$fila[3]?></td>
				<td><?=$fila[4]?></td>
				<td><?=$fila[5]?></td>
				<td><?=$fila[6]?></td>
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