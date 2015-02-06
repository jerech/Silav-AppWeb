<?php

	include_once("../../conexionBD.php");

	$conexion = establecerConexion();

    $usuario = $_POST['usuario'];

	$query = "
			SELECT
                if(u.pasajes_activo,'si','no')
            FROM
                Usuarios as u
            WHERE 
                usuario='$usuario'";

    $resultado = mysql_query($query, $conexion);

    mysql_close($conexion);
    $array = mysql_fetch_row($resultado);
    exit($array[0]);

?>