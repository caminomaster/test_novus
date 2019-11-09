<?
// Conectar a la BD
$db = mysqli_connect("localhost","usuario","contrasena","test_novus");

// revisar conexión
if (mysqli_connect_errno()){
	echo 'Error conectando a MySQL: ' . mysqli_connect_error();
}

// DEfinir coinjunto de caracteres
$db->set_charset('utf8');
?>