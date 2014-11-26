<?php
	include("../../conexionBD.php");
	echo "<table class='tabla-mostrar-moviles' id=tabla-edit-moviles>";
    echo "<tr>";
    echo "<td>Num. Movil</td><td>Patente</td><td>Marca</td><td>Modelo</td>";
    echo "</tr>";
	$color = 0;
	$conectar = establecerConexion();
    $sql = "SELECT numero,patente,marca,modelo FROM Moviles order by numero";
    $select = mysql_query($sql,$conectar);
	if($select){
		while($fila = mysql_fetch_array($select)){
?>
				<tr>
				<td><?=$fila[0]?></td>
				<td><?=$fila[1]?></td>
				<td><?=$fila[2]?></td>
				<td><?=$fila[3]?></td>
				<td><input class="check-edit-moviles" type="checkbox"/></td>
				</tr>
<?php

		}
		mysql_close($conectar);//Cerramos la conexion
	}else{
		 mysql_close($conectar); //Cerramos la conexion
	}
	echo "</table>";
?>