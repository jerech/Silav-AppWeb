<?php

header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . " GMT" ); 
header( "Cache-Control: no-cache, must-revalidate" ); 
header( "Pragma: no-cache" );

session_start();
  if(!$_SESSION['sesion_reg']){
        exit();
    }

require_once("../conexionBD.php");

$idAgencia = $_SESSION['sesion_idAgencia'];

$conexion = establecerConexion();

$registros=mysql_query("select usuario, ubicacion_lat, ubicacion_lon, estado_movil
                       from ChoferesConectados where id_agencia=$idAgencia", $conexion) or
  die("Problemas en el select:".mysql_error());

while ($reg=mysql_fetch_array($registros))
{
  $nom1 = $reg['usuario'];
  $lat1 = $reg['ubicacion_lat'];
  $lon1 = $reg['ubicacion_lon'];
  $estado = $reg['estado_movil'];
  if ($lat1 && $lon1) {
	$latlon[] = $nom1 . "_" . $lat1 . "_" . $lon1 . "_" . $estado;
  } else {
	$latlon[] = '';
  }
}
	
require_once('json.php');
$json = new Services_JSON();
print $json->encode($latlon);
?>