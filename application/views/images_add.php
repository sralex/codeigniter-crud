<fieldset><legend>Imagenes</legend>
<?php   
$attributes = array('class' => 'form-horizontal', 'id' => 'formulario');
//echo form_open_multipart('Images', $attributes); ?>
<form id="formulario">
<div class="control-group">
    <label for="file" class="control-label">Imagen</label>
	<div class='controls'>
        <input id="file" type="file" name="file" required/>
		<?php echo form_error('file'); ?>
	</div>
</div>
<div class="control-group">
	<label></label>
	<div class='controls'>
        <input type="submit" class="btn btn-success" value="Cargar">
	</div>
</div>
<?php echo form_close(); ?></fieldset>

<script>

$(document).ready(function(){
	$('#formulario').submit(function() { 
            var form = new FormData($(this)[0]); 
            $.ajax({
                url: '<?=base_url();?>images/add',
                type: 'POST',
                xhrFields: {
                    withCredentials: true
                },
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                beforeSend: function () {
                    $(".contenido").html("Uploading, please wait....");
                },
                success: function (html) { 
                    $(".contenido").html(html);
                    $(form).find('input').attr('value','');
                    $(form).find('textarea').attr('value','');
                },
                complete: function (html) {
                   // $(".contenido").html("upload complete.");
                },
                error: function () {
                    //alert("ERROR in upload");
                    location.reload();
                }
            }).done(function() { 
                //alert('Event created successfully..');

            }).fail( function(xhr, textStatus, errorThrown) {
        alert(xhr.responseText);
    });
            event.preventDefault();
        });
});
</script>