<?php
	include("http://www.silav.hol.es/BD/conexionBD.php");
	
	$numero=$_POST["numero"];
	$patente=$_POST["patente"];
	$vencseguro=$_POST["vencseguro"];
	$marca=$_POST["marca"];
	$modelo=$_POST["modelo"];
	$aire=$_POST["aire"];
	$gnc=$_POST["gnc"];
	
	//El script lo que hara es verificar que los campos del formulario tengan datos
if(!empty($numero) && !empty($patente) && !empty($marca) && !empty($modelo)){ //Si los campos tienen valores
   //Si todos los datos provenientes de los campos en el formulario
   //tienen datos se proceden a insertar en base de datos
   	$conectar = establecerConexion();
   	$sql = "INSERT INTO Moviles(patente,numero,marca,modelo,vencseguro,aa,gnc) values('$patente','$numero','$marca','$modelo','$vencseguro','$aire','$gnc')";
   	$insertar = mysql_query($sql,$conectar);
	if($insertar){
		echo "1"; //Enviamos el valor 1
		mysql_close($conectar);//Cerramos la conexion
	}else{
		// echo mysqli_error($conectar);
		 echo "0"; //Enviamos el valor 0
		 mysql_close($conectar); //Cerramos la conexion
	}
}
?>