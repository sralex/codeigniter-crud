
<?php 
echo form_open(current_url(),array('class'=>'form-horizontal')); ?>
<?php echo $custom_error; ?>
{forms_inputs}
<hr>
<p class="pull-right">
		 <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <input class="btn btn-primary" type="submit" value="Guardar">
</p>
<hr>
<?php echo form_close(); ?>