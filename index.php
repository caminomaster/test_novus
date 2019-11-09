<?
// Ruta a las 'vistas'
DEFINE('CARPETA_PLANTILLAS','plantillas/');

// incluir archivo de conexión a la BD
require 'db.php';

// archivo con las funciones (controlador)
require 'persona.php';

// Convierte la URL en parámetros
list( $funcion, $id, $sobrante ) = explode( '_', $_SERVER['QUERY_STRING'], 3 );
// Función por defecto
if( empty($funcion) ){
	$funcion = 'lista';
}

// Llamado a la función
$funcion($id);
?>