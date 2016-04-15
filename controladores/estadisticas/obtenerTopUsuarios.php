<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }
    $idAgencia = $_SESSION['sesion_idAgencia'];

  	require_once("../conexionBD.php");
  	
	$query = "SELECT c . * , count( p.usuario_chofer ) AS can
FROM Pasajes AS p
LEFT JOIN Choferes AS c ON c.usuario = p.usuario_chofer
where p.id_agencia=$idAgencia
GROUP BY p.usuario_chofer
ORDER BY can DESC
LIMIT 10 ";  	
  	
	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	$datosTopUsuarios = array();
    while ($array = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
    	$datosTopUsuarios[] = $array;
    }
    
?>