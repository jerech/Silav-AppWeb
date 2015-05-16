<?php

	include_once("../../conexionBD.php");

	$conexion = establecerConexion();

    $usuario = $_POST['usuario'];

	$query = "UPDATE Usuarios SET mapa_activo = 0 where usuario='$usuario'";

    $resultado = mysql_query($query, $conexion);

    mysql_close($conexion);

    exit();

?>