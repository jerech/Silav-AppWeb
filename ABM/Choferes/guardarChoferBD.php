<?php
	include("../conexionBD.php");
	
	$usuario=$_POST["usuario"];
	$nombre=$_POST["nombre"];
	$apellido=$_POST["apellido"];
	$telefono=$_POST["telefono"];
	$venclicencia=$_POST["venclicencia"];
	$pass=$_POST["pass"];
	$habilitado=$_POST["habilitado"];
	$moviles=$_POST["listamoviles"];
	$sexo=$_POST["sexo"];
	
	
	if($habilitado=="on"){
		$habilitado="si";
		}else {
			$habilitado="no";
		}
	
	//El script lo que hara es verificar que los campos del formulario tengan datos
if(!empty($usuario) && !empty($nombre) && !empty($apellido) && !empty($pass)){ //Si los campos tienen valores
   //Si todos los datos provenientes de los campos en el formulario
   //tienen datos se proceden a insertar en base de datos
   	
   	if(!existeRegistro()) {
   		$conectar = establecerConexion();
   		$sql = "insert into Choferes(usuario,nombre,apellido,contrasenia,numero_telefono,venc_licencia,habilitado,sexo) values('$usuario','$nombre','$apellido','$pass','$telefono','$venclicencia','$habilitado','$sexo')"; 		
   		$insertar = mysql_query($sql,$conectar);
   		
   		guardarAsignacionMoviles();
   		
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
			$sqlupdate="update Choferes set nombre='$nombre', apellido='$apellido', contrasenia='$pass', numero_telefono='$telefono', habilitado='$habilitado', sexo='$sexo', venc_licencia='$venclicencia' where usuario='$usuario'";
			$resultadoUpdate=mysql_query($sqlupdate,$conectar);
			$consulta_chofer = mysql_fetch_row(mysql_query("select id from Choferes where usuario='$usuario'", $conectar));
   		$id_chofer=$consulta_chofer[0];
			$sql2="delete from AsignacionesMovil where id_chofer='$id_chofer'";
			$resultado2=mysql_query($sql2,$conectar);
			
			guardarAsignacionMoviles();
			
			
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
	global $usuario;
	$conexion=establecerConexion();
	$consulta="select usuario from Choferes where usuario='$usuario'";
	$resultado=mysql_query($consulta);
	if(mysql_num_rows($resultado)==0){
		mysql_close($conexion);
		return false;
	}else {
		mysql_close($conexion);
		return true;
		}
}

function guardarAsignacionMoviles() {
	global $moviles,$usuario;
	$conexion=establecerConexion();
	
	$array_moviles=explode("-", $moviles);
   		$consulta_chofer = mysql_fetch_row(mysql_query("select id from Choferes where usuario='$usuario'", $conexion));
   		$id_chofer=$consulta_chofer[0];
   		
   		foreach($array_moviles as $num_movil){
   			$consulta_movil = mysql_fetch_row(mysql_query("select id from Moviles where numero='$num_movil'", $conexion));
   			$id_movil=$consulta_movil[0];
   			$insertar2 = mysql_query("insert into AsignacionesMovil(id_chofer,id_movil) values('$id_chofer','$id_movil')", $conexion);
   		}
}
?>