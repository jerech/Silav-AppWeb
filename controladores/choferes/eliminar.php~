<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }

  	require_once("../../conexionBD.php");

  	$id = $_POST['id'];
//elimina cambiando el estado activo a 0
  	$query = "
  			UPDATE 
  				  Choferes
			SET
				  activo=0
         WHERE 
              id=$id";

	$conexion = establecerConexion();
	if(!$conexion){
		echo "Error al conectar con la Base de Datos";
		exit();
	}

	$resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

	if($resultado){
		eliminarMovilesAsignados($id);
		echo "OK_"; 
	}

	mysql_close($conexion);

	function eliminarMovilesAsignados($idChofer) {
		  	$query2 = "
  				DELETE FROM AsignacionesMovil 

         	WHERE 
              id_chofer=$idChofer";
			
			$respuesta = mysql_query($query2)or die('Error: '.mysql_error().'. Nro: '.mysql_errno());
	}
?>