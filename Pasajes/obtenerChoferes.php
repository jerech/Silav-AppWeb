<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

  	require_once("../conexionBD.php");
  	
	$query = "select usuario,
					numero_movil
				 
<<<<<<< HEAD
				 from ChoferesConectados
				 
				 WHERE estado_movil = 'LIBRE'"; 	
=======
				 from ChoferesConectados where estado_movil='LIBRE'"; 	
>>>>>>> 19b16e6184e96dda18006742d3b0f6ff4ff090c0
  	
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
    	echo json_encode(array('choferes' => $datos));
    	exit();
    }

	mysql_close($coneccion);
?>