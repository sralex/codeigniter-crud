<?$this->load->view('header');?>
<script>
    $(document).ready(function(){
        $('.tables').change(function(){
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
           
    });
</script>
<form action="<?php echo current_url();?>" method="post" id="form">
<p style="font-weight: bold; color:red;">Database tables/data and files will be reverted every hour</p>
<p>MySQL Table
<?php
$db_tables = $this->db->list_tables();
echo '<div class="col-md-3">';
echo form_dropdown('table',$db_tables,'default','class="form-control auto_submit_item"');
echo '</div>';
?>
<input class="btn btn-info" type="submit" name="table_data" value="Get Table Data" /></p>
</form>
<form action="<?php echo current_url();?>" method="post">
<?php
if(isset($alias)){
?>
<input type="hidden" name="table" value="<?php echo $table ?>" />
<table>
<tr>
    <td>
    <div class="row">
        <div class="col-md-3">
            Controller Name: <input class="form-control" type="text" name="controller" value="<?php echo $table ?>" />
        </div>
        <div class="col-md-3">
            View Name: <input class="form-control" type="text" name="view" value="<?php echo $table ?>" />
        </div>
        <div class="col-md-3">
            Validation Name: <input class="form-control" type="text" name="validation" value="<?php echo $table ?>" />
        </div>
        <div class="col-md-3">
         <br><input class="btn btn-success" type="submit" name="generate" value="Generate" />
        </div>
    </div>
    </td>
</tr>
<tr>
    <td>
    <h3>Table Data</h3>
    <?php
    //p($alias);
    
    $type = array(
                'exclude'  =>'Do not include',
                'text' => 'text input',
                'date' => 'date',
                'datetime' => 'dateTime',
                'password' => 'password',
                'textarea' => 'textarea' , 
                'dropdown' => 'dropdown',
                'file' => 'file',
                'select' => 'select',
                'email'=>'Email',
                'number' => 'Number',
                'user' => 'User',
                'picture' => 'Pic'
                );
   $sel = '';
    if(isset($alias)){
        foreach($alias as $a){
            $email_default = FALSE;
            $user_default = FALSE;
            echo '<div class="list-group">';
            echo '<div class="list-group-item">';
            echo '<div class="row clearfix">';
            echo '<div class="col-md-12">';
            echo 'Field: '.$a->Field." - ".$a->Type;
            echo '</div>';
            echo '</div>';
            echo '<div class="row clearfix">';
            echo '<div class="col-md-3">';
            echo 'Label:'.form_input('field['.$a->Field.']', ucfirst($a->Field),'class="form-control"');
            echo '</div>';
            if(strpos($a->Key,'MUL') !== false){
                if(strpos($a->Field,'users_id') !== false){
                 $sel = 'user';
                }else{
                echo '<div class="col-md-3">';
                echo 'Link:'.form_dropdown($a->Field.'table',$db_tables,'default', 'class="tables form-control"'); 
                echo '</div>';
                echo '<div class="col-md-3">';
                echo 'Display value:<select class="form-control" id="value" name="'.$a->Field.'value" id=""></select>';
                echo '</div>';
                $sel = 'select';
                }
            }else if($a->Key == 'PRI'){
                $sel = 'exclude';
                echo form_hidden('primaryKey',$a->Field);
            }elseif(strpos($a->Type,'date') !== false){
                $sel = 'date';
            }elseif(strpos($a->Type,'timestamp') !== false){
                $sel = 'exclude';
            }elseif(strpos($a->Type,'enum') !== false){
                $string = "";
                $result= "";
                if (preg_match_all("|\'(.*)\'|U", $a->Type, $result)){
                    foreach($result[0] as $r){
                        $string.= $r."=>".$r.",";
                    }
                }
                echo '<div class="col-md-3">';
                echo ' Enum Values (CSV): <input class="form-control"  type="text" value="'.$string.'" name="'.$a->Field.'default">';
                echo '</div>';
                $sel = 'dropdown';
            }elseif(strpos($a->Type,'blob') !== false || strpos($a->Type,'text') !== false){
                $sel = 'textarea';
            }else if(strpos($a->Field,'password') !== false){
                $sel = 'password';
            }else if(strpos($a->Field,'email') !== false){
                $email_default = TRUE;
            }elseif(strpos($a->Type,'int') !== false){
                $sel = 'number';
            }else{
                $sel = 'text';
            }
            echo '<div class="col-md-3">';
            echo 'Type:'.form_dropdown('type['.$a->Field.'][]', $type,$sel,'class="form-control"');
            echo '</div>';
            echo '<div class="col-md-3">';
            echo form_checkbox('rules['.$a->Field.'][]', 'required', TRUE) . ' required :: ';
            echo form_checkbox('rules['.$a->Field.'][]', 'trim', TRUE) . ' trim :: ';
            echo form_checkbox('rules['.$a->Field.'][]', 'valid_email', $email_default) . ' email :: ';
            echo form_checkbox('rules['.$a->Field.'][]', 'xss_clean', TRUE) . ' xss_clean ::';
            //echo ':: custom rule '. form_input('rules['.$a->Field.'][]', '');
            echo '</div>';
            echo '</div> ';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
    </td>
</tr>
</table>

</form>
<?php
}
?>



<?$this->load->view('footer');?>