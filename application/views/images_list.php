
<div class="contenido">
<?php
if(!$results){
  echo '<h3>No existen datos</h3>';
}else{
?>
<div class="row galeria" style="max-height:600px; overflow:scroll; overflow-x:hidden;">
<?foreach($results as $r):?>
      <div class="col-md-4">
        <div class="thumbnail">
          <input type="radio" name="foto" value="<?=base_url()?><?=$dir?><?=$r;?>" style="visibility:hidden;">
          <img src="<?=base_url()?><?=$dir?><?=$r;?>" style="height:150px;" class="img-responsive">
          <a href="#" id="<?=$r;?>" class="btn btn-danger toDelete_" data-toggle="modal" data-target="#modal_delete"><span class="glyphicon glyphicon-remove"></span></a>
        </div>
      </div>
<?endforeach;?>
</div>
<?//=$this->pagination->create_links();?>
<script type="text/javascript">
var id  = "";

$(document).ready(function(){
    $('.thumbnail').on('click',function(){
    $(this).find('input').prop("checked", true);
    $('input[type=radio]').closest('.thumbnail').css('background','');
    if($('input[type=radio]').is(':checked')) {
      $(this).css('background','#c0c0c0');
    }
  });
});
</script>

</div>
<?
}
?>