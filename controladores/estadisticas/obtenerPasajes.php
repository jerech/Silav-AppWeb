<?php
	//Se verifica que la sesion sea regurar, si no se sale del archivo
	session_start();
	if(!$_SESSION['sesion_reg']){
        exit();
    }
    $idAgencia = $_SESSION['sesion_idAgencia'];

  	require_once("../../conexionBD.php");
  	
	$query = "select * from Pasajes where id_agencia=$idAgencia";  	
  	
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

    $query="select count(*) as cantidad, date_format(fecha,'%Y-%m') as fecha from Pasajes group by date_format(fecha,'%Y-%m') order by fecha asc";
    $resultado = mysql_query($query, $conexion) or die('Error: '.mysql_error().'. Nro: '.mysql_errno());

  $datos2 = array();
  $meses = array("Enero","Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre","Noviembre", "Diciembre");


    while ($array = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
      $num=(int)split("-", $array['fecha'])[1];
      $datos2[] = array('cantidad' => $array['cantidad'],'mes'=>$meses[$num-1]);
 
    }



    


    if($resultado){
    	echo json_encode(array('pasajes' => $datos,'datos_grafico'=>$datos2));
    	exit();
    }

	mysql_close($conexion);
?>