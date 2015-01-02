		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12 column">
		</div>
	</div>
</div>
<script>
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
</script>
</body>
</html>