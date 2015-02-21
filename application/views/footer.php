		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12 column">
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="module_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-result">
      
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alerta</h4>
      </div>
      <div class="modal-body">
        Seguro  que desear continuar con la accion?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="btn_delete" type="button" data-dismiss="modal" data-action="delete" data-result="#modal_result" class="btn btn-primary get_action " > Aceptar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="galeria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Galeria</h4>
      </div>
      <div class="modal-body resultado">
       
      </div>
      <div class="modal-footer">
        <button type="button" id="guarda" data-dismiss="modal" class="btn btn-primary">Guardar</button>
      </div>
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
          $('#gal').parent().find('input').attr('value',url);
          $('#gal').parent().find('div').html('<img src="'+url+'" width="100px">');
          console.log(url);
    });
    $('#myModal').appendTo("body");
</script>
</body>
</html>