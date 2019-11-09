<?
// Carga los datos básicos ('modelo') y devuelve un objeto
function persona($id){
	global $db;

	$sql = 'SELECT * FROM personas WHERE id='.$id;
	$res = $db->query($sql);
	$p = mysqli_fetch_object($res);
	mysqli_free_result($res);

	return $p;
}

// Carga la página de edición
function editar($id){
	global $db;

	// Si no se ha definido id, se carga formulario en blanco
	if( '' != $id ){
		// llamado al objeto básico
		$p = persona($id);

		// Carga de lista de amigos actual
		$p->amigos = array();
		$sql = 'SELECT a.id, nombre
		FROM (
			SELECT id, IF( persona1 = '.$id.', persona2, persona1) amigo 
			FROM amigos
			WHERE persona1 = '.$id.' OR persona2 = '.$id.'
		) a
		LEFT JOIN personas p
			ON a.amigo = p.id
		ORDER BY nombre';

		$res = $db->query($sql);
		while( $o = mysqli_fetch_object($res) ){
			$p->amigos[] = $o;
		}
		mysqli_free_result($res);
	}

	// plantillas
	include CARPETA_PLANTILLAS.'header.htm';
	include CARPETA_PLANTILLAS.'editar.php';
	include CARPETA_PLANTILLAS.'footer.htm';
}

// Guarda los datos provenientes de edición
function guardar($id){
	global $db;

	if($_POST){
		$values = 'nombre=\''.$_POST['nombre'].'\', tipo_documento=\''.$_POST['tipo'].'\', numero_documento=\''.$_POST['documento'].'\'';
		
		// Si no se define id, inserto, caso contrario actualizo
		if( '' == $id ){
			$sql = 'INSERT INTO personas SET '.$values;
			$res = $db->query($sql);
			$id = mysqli_insert_id($db);
		}else{
			$sql = 'UPDATE personas SET '.$values.' WHERE id='.$id;
			$res = $db->query($sql);
		}
		header('location:?ver_'.$id);
	}
	// Si no hay post, cargo la pantalla por defecto
	header('location:?');
}

// Muestra la lista de personas
function lista($id){
	global $db;

	// Consulta
	$sql = 'SELECT * FROM personas ORDER BY nombre';
	$res = $db->query($sql);

	// plantillas
	include CARPETA_PLANTILLAS.'header.htm';
	include CARPETA_PLANTILLAS.'lista.php';
	include CARPETA_PLANTILLAS.'footer.htm';

	mysqli_free_result($res);
}

// Consulta de posibles amigos vía AJAX
function consulta($id){
	global $db;
	$amigos = array();
	list($id, $phrase) = explode('-', $id);

	// La consulta excluye amigos actuales y al mismo usuario
	$sql = 'SELECT p.*
		FROM (
			SELECT IF( persona1 = '.$id.', persona2, persona1) amigo 
			FROM amigos
			WHERE persona1 = '.$id.' OR persona2 = '.$id.'
		) a
		RIGHT JOIN personas p
			ON a.amigo = p.id
		WHERE a.amigo IS NULL
		AND p.id != '.$id.'
		AND nombre LIKE \'%'.$phrase.'%\'
		ORDER BY id';

	$res = $db->query($sql);
	while( $o = mysqli_fetch_object($res) ){
		$amigos[] = $o;
	}
	mysqli_free_result($res);

	// Conversión del resultado a JSON
	$json = json_encode($amigos);
	echo $json;
}

// Inserción de nueva amistad vía AJAX
function anadir(){
	global $db;

	$persona = $_POST['persona'];
	$amigo = $_POST['amigo'];

	$amigos = array($persona, $amigo);
	sort($amigos);
	
	// Inserción de nueva amistad
	$sql = 'INSERT INTO amigos (persona1, persona2) VALUES (\''.$amigos[0].'\', \''.$amigos[1].'\')';
	$res = $db->query($sql);
	$ins = mysqli_insert_id($db);

	// Consulta de la amistad insertada
	$sql = 'SELECT a.id, nombre
		FROM (
			SELECT id, IF( persona1 = '.$persona.', persona2, persona1) amigo 
			FROM amigos
			WHERE persona1 = '.$persona.' OR persona2 = '.$persona.'
		) a
		JOIN personas p
		ON p.id = a.amigo
		WHERE a.id = \''.$ins.'\'';

	$res = $db->query($sql);
	$p = mysqli_fetch_object($res);
	mysqli_free_result($res);

	// Conversión del resultado a JSON
	$json = json_encode($p);
	echo $json;
}

// Borrado de amistades vía AJAX
function borrar(){
	global $db;
	$amistad = $_POST['amistad'];
	$sql = 'DELETE FROM amigos WHERE id='.$amistad;
	$res = $db->query($sql);

	// JSON de confirmación
	echo '{"result":"1"}';
}
?>
