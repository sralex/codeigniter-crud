<div id="output2">
<?php 
echo form_open(current_url(),Array('id'=>'myForm2')); ?>
<?php echo $custom_error; ?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<h4 class="modal-title" id="myModalLabel">Agregar</h4>
</div>
<div class="modal-body">
{forms_inputs}
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <input class="btn btn-primary" type="submit" value="Guardar">
</div>
<?php echo form_close(); ?>
</div>
<script>
	$(document).ready(function() { 
    var options = { 
        target:'#output2' 
    }; 
    $('#myForm2').submit(function() { 
        $(this).ajaxSubmit(options); 
        return false; 
    });
	}); 
</script>