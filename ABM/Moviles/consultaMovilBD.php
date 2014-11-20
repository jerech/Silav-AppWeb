<?php
	include('conexionBD.php');
	
	$conectar = establecerConexion();
	$id=$_POST["id"];
    $sql = "SELECT patente,numero,marca,modelo,vencseguro,aa,gnc FROM Moviles where numero=".$id;
    $select = mysql_query($sql,$conectar);
    
    if($select){
    	$resultado = mysql_fetch_row($select);
    	$patente=$resultado[0];
    	$numero=$resultado[1];
    	$marca=$resultado[2];
    	$modelo=$resultado[3];
    	$vencseguro=$resultado[4];
    	$aa=$resultado[5];
    	$gnc=$resultado[6];
    	
    	echo $patente."&&".$numero."&&".$marca."&&".$modelo."&&".$vencseguro."&&".$aa."&&".$gnc;
    	
    	mysql_close($conectar);
    }else {
    	mysql_close($conectar);
    }
    
 ?>