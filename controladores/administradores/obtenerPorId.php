<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

	require_once("../../conexionBD.php");
	$id = $_POST['id'];
	$query = "select * from Usuarios where id=$id";
	$queryPermisos = "select * from Permisos where Usuarios_id=$id";

	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());
	$resultadoPermisos = mysql_query($queryPermisos, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	$datos = array();
    while ($array = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
    	$datos[] = $array;
    }

    $datosPermisos = array();
    while ($array = mysql_fetch_array($resultadoPermisos, MYSQL_ASSOC)) {
    	$datosPermisos[] = $array;
    }

    if($resultado && $resultadoPermisos){
    	echo json_encode(array('administradores' => $datos,
    							'permisos' => $datosPermisos));
    	exit();
    }
    mysql_close($conexion);



?>