<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }
    $idAgencia = $_SESSION['sesion_idAgencia'];
	require_once("../../conexionBD.php");
	$id = $_POST['id'];
	$query = "select * from Agencias where id=$idAgencia";

	$conexion = establecerConexion();
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
    	echo json_encode(array('agencia' => $datos));
    	exit();
    }
    mysql_close($conexion);

?>