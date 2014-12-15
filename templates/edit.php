<?$this->load->view('header')?>

<?php
echo form_open(current_url()); ?>
<?php echo $custom_error; ?>
{primary}
{forms_inputs}
<p class="pull-right">
		<input type="button" action="action" class="btn btn-default" onclick="history.go(-1);" value="Cancelar">
        <input class="btn btn-primary" type="submit" value="Guardar">
</p>

<?php echo form_close(); ?>
<?$this->load->view('footer')?>

