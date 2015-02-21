
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Modal title</h4>
</div>
<div class="modal-body">
<table class="table table-striped">
<?foreach($result[0] as $clave => $valor):?>
	<tr>
		<td><strong><?=str_replace("_"," ",$clave)?></strong></td>
		<td><?=$valor?></td>
	</tr>
<?endforeach;?>
</table>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
</div>