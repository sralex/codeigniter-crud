<?$this->load->view('header');?>
<script>

$(document).ready(function(){
    $(document).on('change','.tables',function(){
        var node = $(this);
        console.log($(node).find(":selected").text());
         $.ajax({
            url:'<?=base_url()?>index.php/codegen/getFields/'+$(node).find(":selected").text(),
            type:'POST',
            dataType: 'json',
            success: function( json ) {
                //console.log(json);
                $(node).parent().parent().find('#value').find('option').remove();
                $.each(json, function(i, value) {
                    $(node).parent().parent().find('#value').append($('<option>').text(value.Field).attr('value', value.Field));
                });
            }
        });
    });
    $(document).on('change', 'form#form_tablas_2', function() {
        alert("pollo");
        $.ajax({
            url     : $(this).attr('action'),
            type    : $(this).attr('method'),
            dataType: 'html',
            data    : $(this).serialize(),
            success : function( data ) {
                         $('.resultado-3').html(data);
            },
            error   : function( xhr, err ) {
                         alert('Error');
            }
        });
        return false;
    });
    $(document).on('change', 'form#form_tablas', function() {

        $.ajax({
            url     : $(this).attr('action'),
            type    : $(this).attr('method'),
            dataType: 'html',
            data    : $(this).serialize(),
            success : function( data ) {
                         $('.resultado-2').empty();
                         $('.resultado').html(data);
                         $('#table_1').val($('.auto_submit_item :selected').text());
            },
            error   : function( xhr, err ) {
                         alert('Error');
            }
        });
        return false;
    });
    $(document).on('submit', 'form#create', function() {         
        $.ajax({
            url     : $(this).attr('action'),
            type    : $(this).attr('method'),
            dataType: 'html',
            data    : $(this).serialize(),
            success : function( data ) {
                         $('.resultado-2').html(data);
            },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });    
        return false;
    });
    });
</script>
<div class="row clearfix">
    <div class="col-md-6">
        <form action="<?=base_url()?>codegen/manage" method="post" id="form_tablas">
        <p style="font-weight: bold; color:red;">MySQL Table</p>
        <?php
        $db_tables = $this->db->list_tables();
        echo form_dropdown('table',$db_tables,'default','class="form-control auto_submit_item"');
        ?>
        <input type="hidden" name="table_data" value="asdas">
        </form>
    </div>
    <div class="col-md-6">
        <form action="<?=base_url()?>codegen/manage" method="post" id="form_tablas_2">
        <p style="font-weight: bold; color:red;">Multivalue</p>
        <?php
        $db_tables = $this->db->list_tables();
        echo form_dropdown('table-2',Array(""=>"")+$db_tables,'default','class="form-control auto_submit_item"');
        ?>
        <input type="hidden" name="table_data" value="a">
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="resultado">
    
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="resultado-3">
    
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="resultado-2">
    
        </div>
    </div>
</div>
<?$this->load->view('footer');?>