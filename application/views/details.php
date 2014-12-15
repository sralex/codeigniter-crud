<table class="table table-striped">
<?foreach($result[0] as $clave => $valor):?>
	<tr>
		<td><strong><?=str_replace("_"," ",$clave)?></strong></td>
		<td><?=$valor?></td>
	</tr>
<?endforeach;?>
</table>
<hr>
<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
