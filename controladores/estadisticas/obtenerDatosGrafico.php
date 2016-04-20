<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }
    $idAgencia = $_SESSION['sesion_idAgencia'];

  	require_once("../conexionBD.php");
  	
	$query = "SELECT count( substring_index( p.fecha, ' ', 1 ) ) as can, substring_index( p.fecha, ' ', 1 ) as fecha
FROM Pasajes AS p
GROUP BY substring_index( p.fecha, ' ', 1 )
LIMIT 8";  	
  	
	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	$datos = array();
    while ($array = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
    	$datos[] = array('x' => $array['fecha'], 'y' => $array['can']);
    }

	//echo print_r($datos);
    //$datosGrafico=json_encode(array('pasajes' => $datos));

    mysql_close($conexion);
    
?>