
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
          <input type="radio" name="foto" value="<?=base_url()?>uploads/<?=$r;?>" style="visibility:hidden;">
          <img src="<?=base_url()?>uploads/<?=$r;?>" style="height:150px;" class="img-responsive">
          <a href="#" id="<?=$r;?>" class="btn btn-danger toDelete_" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span></a>
        </div>
      </div>
<?endforeach;?>
</div>
<?//=$this->pagination->create_links();?>
<script type="text/javascript">
$(document).ready(function(){
    var id  = "";
    $('.toDelete_').click(function(){
      id = $(this).attr('id');
    });
    $('.borrar').click(function(){
      $.ajax({
       url:'<?=base_url()?>index.php/images/delete/',
       type: "post",
       data:{id:id},
       success: function(data){
       }
      });
    });
    $('#myModal').on('hidden.bs.modal', function (e) {
      $.ajax({
       url:'<?=base_url()?>index.php/images/update/',
       type: "post",
       data:{id:id},
       success: function(data){
           $('.contenido').html(data);
       }
      });
    });
    $('.thumbnail').on('click',function(){
    console.log("ok");
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