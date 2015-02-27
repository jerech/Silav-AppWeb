<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

  	require_once("../conexionBD.php");
  	
	$query = "select * from PasajesEnCurso"; 	
  	
	$coneccion = establecerConexion();
	if(!$coneccion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $coneccion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	$datos = array();
    while ($array = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
    	$datos[] = $array;
    }
    if($resultado){
    	echo json_encode(array('pasajes' => $datos));
    	exit();
    }

	mysql_close($coneccion);
?>