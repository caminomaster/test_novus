<div class="row">
    <div class="col-md-6">
		<h1>Lista de personas</h1>
	</div>
</div>
<div class="row">
    <div class="col-md-6">

<?
// Si no hay datos, muestra mensaje en lugar de tabla
if ( 0 == $res->num_rows ) {
?>
	<p>No hay personas registradas</p>
<?
}else{
?>

<table class="table table-sm table-hover">
<thead class="thead-dark">
	<tr>
		<th>No.</th>
		<th>Nombre</th>
		<th>documento</th>
	</tr>
</thead>
<?
	while ($p = mysqli_fetch_object($res) ){
		$p->documento = $p->tipo_documento .' '. $p->numero_documento;
?>
<tr>
	<td><?=$p->id;?></td>
	<td><a href="?editar_<?=$p->id;?>"><?=$p->nombre;?></a></td>
	<td><?=$p->documento;?></td>
</tr>
<?
	}
}
?>
</table>
<a href='?editar'>Insertar persona</a>
