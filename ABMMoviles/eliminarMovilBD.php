<?php
	include("conexionBD.php");
	
	$conexion = establecerConexion();
	$id=$_POST["id"];
	$sql= "delete from Moviles where numero='$id'";
	$resultado=mysql_query($sql,$conexion);
	
	if($resultado){
		echo "1";
		mysql_close($conexion);//Cerramos la conexion
	}else{
		 echo "0";
		 mysql_close($conexion); //Cerramos la conexion
	}
?>