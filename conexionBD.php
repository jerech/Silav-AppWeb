<?php
//Funcion que establece la conexion con la base de datos devolviendo una variable
//que establece como conexion con MySQL
function establecerConexion(){

	$usuarioDB="root";
	$contraseniaDB="nbanhl06";
	$servidorDB="localhost";
	$nombreDB="silav";
	
	$mysql=mysql_connect($servidorDB, $usuarioDB, $contraseniaDB);
	if (!$mysql) {
    	die('No pudo conectarse: ' . mysql_error());
	}else{

		$bd = mysql_select_db($nombreDB, $mysql);
		if (!$bd) {
    		die ('No se puedo conectar a la Base de Datos : ' . mysql_error());
		}else{
			mysql_query("SET NAMES 'utf8'");
			return $mysql;
		}
	}

}//Fin de Funcion
?>
