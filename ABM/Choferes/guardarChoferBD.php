<?php
	include("conexionBD.php");
	
	$usuario=$_POST["usuario"];
	$nombre=$_POST["nombre"];
	$apellido=$_POST["apellido"];
	$telefono=$_POST["telefono"];
	$venclicencia=$_POST["venclicencia"];
	$pass=$_POST["pass"];
	$habilitado=$_POST["habilitado"];
	
	if($habilitado=="on"){
		$habilitado="si";
		}else {
			$habilitado="no";
		}
	
	//El script lo que hara es verificar que los campos del formulario tengan datos
if(!empty($numero) && !empty($patente) && !empty($marca) && !empty($modelo)){ //Si los campos tienen valores
   //Si todos los datos provenientes de los campos en el formulario
   //tienen datos se proceden a insertar en base de datos
   	
   	if(!existeRegistro()) {
   		$conectar = establecerConexion();
   		$sql = "insert into Moviles(patente,numero,marca,modelo,vencseguro,aa,gnc) values('$patente','$numero','$marca','$modelo','$vencseguro','$aire','$gnc')";
   		$insertar = mysql_query($sql,$conectar);
			if($insertar){
				echo "1"; //Enviamos el valor 1
				mysql_close($conectar);//Cerramos la conexion
			}else{
				// echo mysqli_error($conectar);
		 		echo "0"; //Enviamos el valor 0
				 mysql_close($conectar); //Cerramos la conexion
			}
		}else {
			$conectar = establecerConexion();
			$otrasql="update Moviles set marca='$marca', modelo='$modelo', vencseguro='$vencseguro', aa='$aire', gnc='$gnc' where numero='$numero'";
			$resultadoUpdate=mysql_query($otrasql);
			if($resultadoUpdate){
				echo "1"; //Enviamos el valor 1
				mysql_close($conectar);//Cerramos la conexion
			}else{
				// echo mysqli_error($conectar);
		 		echo "0"; //Enviamos el valor 0
				 mysql_close($conectar); //Cerramos la conexion
			}
		}
}

function existeRegistro() {
	global $numero;
	$conexion=establecerConexion();
	$consulta="select numero from Moviles where numero='$numero'";
	$resultado=mysql_query($consulta);
	if(mysql_num_rows($resultado)==0){
		mysql_close($conexion);
		return false;
	}else {
		mysql_close($conexion);
		return true;
		}
}
?>