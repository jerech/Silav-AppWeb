<?php
	session_start();
	include_once("../conexionBD.php");

	$conexion = establecerConexion();

    $usuario = $_SESSION['sesion_usuario'];

	$query = "UPDATE Usuarios SET mapa_activo = 0 where usuario='$usuario'";

    $resultado = mysql_query($query, $conexion);

    mysql_close($conexion);

	$_SESSION = array();

	session_destroy();
	
	header("Location: ../index.php");	
	
?>