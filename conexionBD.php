<?php
//Funcion que establece la conexion con la base de datos devolviendo una variable
//que establece como conexion con MySQL
function establecerConexion(){
	//$usuarioDB="u545571603_root";
	//$contraseniaDB="js12345";
	//$servidorDB="mysql.hostinger.es";
	//$nombreDB='u545571603_silav';
	$usuarioDB="silav";
	$contraseniaDB="12345";
	$servidorDB="localhost";
	$nombreDB="silav";
	
	$mysql=mysql_connect($servidorDB, $usuarioDB, $contraseniaDB);
	if (!$mysql) {
    	die('No pudo conectarse: ' . mysql_error());
	}else{

		$bd = mysql_select_db($nombreDB, $mysql);
		if (!$bd) {
    		die ('No se puede usar jqueryphp : ' . mysql_error());
		}else{
			return $mysql;
		}
	}

}//Fin de Funcion
?>