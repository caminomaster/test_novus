<div class="row">
    <div class="col-md-12">
		<h1>Usuario <?=($p->id=='')?'nuevo':"No. $id";?></h1>
	</div>
</div>
<div class="row">
    <div class="col-md-6">
		<form method='post' action='?guardar_<?=$id;?>'>

			<h2>Editar usuario</h2>

			<div class="form-group">
				<label for="nombre">Nombre:</label>
				<input type='text' id='nombre' name='nombre' value='<?=$p->nombre;?>' class="form-control">
			</div>
			<div class="form-group">
				Tipo de documento: <select id="tipo" name="tipo" data-validation="required" class="form-control">
						<option disabled="true"<?if( '' == $p->tipo_documento) echo ' selected';?>>-</option>
						<option value="CC"<?if( 'CC' == $p->tipo_documento) echo ' selected';?>>Cédula de Ciudadanía</option>
						<option value="RC"<?if( 'RC' == $p->tipo_documento) echo ' selected';?>>Registro Civil</option>
						<option value="TI"<?if( 'TI' == $p->tipo_documento) echo ' selected';?>>Tarjeta de identidad</option>
						<option value="CE"<?if( 'CE' == $p->tipo_documento) echo ' selected';?>>Cédula de Extranjería</option>
						<option value="O"<?if( 'O' == $p->tipo_documento) echo ' selected';?>>Otro</option>
					</select>
			</div>
			<div class="form-group">
				<label for="nombre">Número de documento:</label>
				<input id="documento" type='text' name='documento' value='<?=$p->numero_documento;?>' class="form-control">
			</div>
			<input type='submit' value='Guardar' class="btn btn-primary">
		</form>
	</div>
<?
// Sólo se muestra la columna de amigos si el usuario ya existe
if( '' != $id ){
?>
    <div class="col-md-6">
		<h2>Amigos de <?=$p->nombre;?></h2>

		<form method='post' action='?guardar_<?=$id;?>'>
			<input id="persona" type="hidden" value="<?=$id;?>">
			<input id="amigo" type="hidden">
			<div class="form-group">
				<label for="buscar">Buscar:</label>
				<div class="form-row">
					<input id="buscar" type='text'>
					<input id="añadir" type='button' value='Añadir' class="btn btn-success">
				</div>
			</div>
		</form>

		<ul id="amigos" class="list-group">
<?
foreach( $p->amigos as $v ){
	echo '<li class="list-group-item list-group-item-action">'. $v->nombre . ' <a id="'. $v->id .'" href="#" title="borrar" class="btn btn-sm btn-outline-danger float-right borrar">Borrar</a></li>';
}
?>
		</ul>
	</div>
<?
}
?>
