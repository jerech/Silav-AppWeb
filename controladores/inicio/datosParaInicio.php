<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }
    $idAgencia = $_SESSION['sesion_idAgencia'];

    $fechaInicio=date("Y-m-d")." 00:00:00";
    $fechaFin=date("Y-m-d")." 23:59:59";

	require_once("../conexionBD.php");
	$id = $_POST['id'];
	$query = "select * from Pasajes where id_agencia=$idAgencia and fecha between '$fechaInicio' and '$fechaFin'";




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

    $canRechazados=0;
    $canAsignados=0;
    $canEnEspera=0;
    for($i=0;$i<count($datos);$i++){
    	if($datos[$i]['estado']=='rechazado'){
    		$canRechazados++;
    	}
    	if($datos[$i]['estado']=='asignado'){
    		$canAsignados++;
    	}
    	if($datos[$i]['estado']=='en_espera'){
    		$canEnEspera++;
    	}
    }


    $canPasajes=count($datos);
    $porDia=(((int)date("H"))*100)/24;

    $arrayDatos= array('canPasajes'=>$canPasajes,'porcDia'=>$porDia, 'canAsignados'=>$canAsignados, 'canRechazados'=>$canRechazados,'canEnEspera'=>$canEnEspera);

    mysql_close($conexion);

?>