<?php
	include("../conexionBD.php");
	
	$conexion = establecerConexion();
	$id=$_POST["id"];
	$sql= "delete from Moviles where numero='$id'";
	$sql2="delete from AsignacionesMovil where id_movil='$id'";
	$resultado=mysql_query($sql,$conexion);
	$resultado2=mysql_query($sql2,$conexion);
	
	if($resultado && $resultado2){
		echo "1";
		mysql_close($conexion);//Cerramos la conexion
	}else{
		 echo "0";
		 mysql_close($conexion); //Cerramos la conexion
	}
?>