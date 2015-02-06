<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

  	require_once("../../conexionBD.php");

  	$id_movil = $_POST['id_movil'];
  	$id_chofer = $_POST['id_chofer'];

  	$query = "
  			DELETE FROM AsignacionesMovil 

         WHERE 
              id_movil=$id_movil AND id_chofer=$id_chofer";

	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	if($resultado){
		echo "OK_"; 
	}

	mysql_close($conexion);

?>