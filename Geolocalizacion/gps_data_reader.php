<?php

header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . " GMT" ); 
header( "Cache-Control: no-cache, must-revalidate" ); 
header( "Pragma: no-cache" );

$servidorDB = "mysql.hostinger.es";
$usuarioDB = "u545571603_root";
$claveDB = "js12345";
$nombreDB = "u545571603_silav";

$conexion=mysql_connect($servidorDB, $usuarioDB, $claveDB) 
  or  die("Problemas en la conexion");

mysql_select_db($nombreDB, $conexion) 
  or  die("Problemas en la selección de la base de datos");

$registros=mysql_query("select usuario, ubicacion_lat, ubicacion_lon
                       from ChoferesConectados", $conexion) or
  die("Problemas en el select:".mysql_error());

while ($reg=mysql_fetch_array($registros))
{
  $nom1 = $reg['usuario'];
  $lat1 = $reg['ubicacion_lat'];
  $lon1 = $reg['ubicacion_lon'];
  if ($lat1 && $lon1) {
	$latlon[] = $nom1 . "_" . $lat1 . "_" . $lon1;
  } else {
	$latlon[] = '';
  }
}
	
require_once('json.php');
$json = new Services_JSON();
print $json->encode($latlon);
?>