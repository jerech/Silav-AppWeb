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

$registros=mysql_query("select direccion, latDireccion, lonDireccion
                       from PasajesEnCurso where id_agencia=$idAgencia
                       and (estado = 'por_asignar' OR estado = 'en_espera')
                       and (DATE_SUB( fechaDePedido , INTERVAL 10 MINUTE ) <= CURRENT_TIMESTAMP( ))", $conexion) or
  die("Problemas en el select:".mysql_error());

while ($reg=mysql_fetch_array($registros))
{
  $direccion = $reg['direccion'];
  $latitud = $reg['latDireccion'];
  $longitud = $reg['lonDireccion'];
  if ($latitud && $longitud) {
	$respuesta[] = $direccion . "_" . $latitud . "_" . $longitud;
  } else {
	$respuesta[] = '';
  }
}
	
require_once('json.php');
$json = new Services_JSON();
print $json->encode($respuesta);
?>