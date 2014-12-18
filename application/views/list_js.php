<script type="text/javascript">
$(document).ready(function(){
    $('.toDelete').click(function(){
        $('a.borrar').attr('href',"<?=base_url()?>index.php/{controller_name_l}/delete/"+$(this).attr('id'));
    });
    $(".toSee").click(function(){
      $.ajax({
        url:"<?=base_url()?>index.php/{controller_name_l}/details/"+$(this).attr('id'),success:function(result){
          $("#result-3").html(result);
        }});
    });
    $(".toEdit").click(function(){
      $.ajax({
        url:"<?=base_url()?>index.php/{controller_name_l}/edit/"+$(this).attr('id'),success:function(result){
          $("#result-2").html(result);
        }});
    });
    $(".toAdd").click(function(){
      $.ajax({
        url:"<?=base_url()?>index.php/{controller_name_l}/add/",success:function(result){
          $("#result-4").html(result);
        }});
    });
    $('#galeria').on('show.bs.modal', function (e) {
      $.ajax({
       url:'<?=base_url()?>index.php/images/manage',
       type:'GET',
       success: function(data){
           $('.resultado').html(data);
       }
      });
    });
    $('#guarda').on('click',function(){
          var url = $('.resultado').find('input[type=radio]:checked').attr('value');
          $('input[name=foto]').attr('value',url);
          $('.foto').html('<img src="'+url+'" width="100px">');
    });
    $('#myModal').appendTo("body");
});
</script>