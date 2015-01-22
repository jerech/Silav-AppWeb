<?php

	require_once("../../conexionBD.php");

	$conexion = establecerConexion();

	$query = "
			SELECT
                s.id,
                s.nombre,
                IF(!ISNULL(s.id_seccion_padre), s.id_seccion_padre, 0) AS idPadre,
                IF(!ISNULL(s.id_seccion_padre), sp.nombre, 0) AS padre,
                IF(!ISNULL(s.id_seccion_padre), (s.id_seccion_padre * 100) + s.id, (s.id * 100)) AS orden
            FROM
                Secciones AS s LEFT JOIN
                Secciones AS sp ON s.id_seccion_padre = sp.id
            ORDER BY
                orden";

    if(!$conexion){
        echo "Error al conectar con la Base de Datos";
        exit();
    }

    $resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

    $datos = array();
    while ($array = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
    	$datos[] = $array;
    }

    if($resultado){
    	echo json_encode(array('secciones' => $datos));
    	exit();
    }

    mysql_close($conexion);

?>