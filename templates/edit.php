
<?php
echo form_open(current_url()); ?>
<?php echo $custom_error; ?>
{primary}
{forms_inputs}
<hr>
<p class="pull-right">
		 <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <input class="btn btn-primary" type="submit" value="Guardar">
</p>
<hr>
<?php echo form_close(); ?>


