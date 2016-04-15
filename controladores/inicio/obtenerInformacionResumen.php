<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }
    $idAgencia = $_SESSION['sesion_idAgencia'];

	require_once("../../conexionBD.php");

	$query1 = "select count(*) as cantidad from ChoferesConectados where id_agencia=$idAgencia";
	$query2 = "select count(*) as cantidad from Choferes where id_agencia=$idAgencia";
	$query3 = "select count(*) as cantidad from PasajesEnCurso where id_agencia=$idAgencia";
	
	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query1, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

    while ($array = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
    	$respuesta1 = $array['cantidad'];
    }

	$resultado = mysql_query($query2, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

    while ($array = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
    	$respuesta2 = $array['cantidad'];
    }
    
    $resultado = mysql_query($query3, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

    while ($array = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
    	$respuesta3 = $array['cantidad'];
    }

    $respuesta = $respuesta1 . "_" . $respuesta2 . "_" . $respuesta3;


    $sql="select * from ChoferesConectados where sos=1";
    $resultado = mysql_query($sql, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());
    $datos2=array();
    if($resultado){
        $datos2=mysql_fetch_array($resultado, MYSQL_ASSOC);
    }

    if(count($datos2)>0){
        $sql="update ChoferesConectados set sos=0 where usuario='".$datos2['usuario']."'";
        mysql_query($sql, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());
    }
    
    echo json_encode(array($respuesta, $datos2));

    mysql_close($conexion);

?>