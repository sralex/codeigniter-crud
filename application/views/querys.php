<?$this->load->view('header')?>
  <script>
  function limpiarC(){
  
    $.ajax({
                url:'<?=base_url()?>index.php/querys/limpiar/',
                type:'POST',
                dataType: 'html',
                data: {consulta: $('.consulta').text()},
                success: function( json ) {
                    console.log(json);
                    $('.salida').val(json);
                }
            });
  }
  function CloseMySelf(sender) {
      try {
          window.opener.HandlePopupResult($('.consulta').text());
      }
      catch (err) {}
      window.close();
      return false;
  }
    $(document).ready(function(){
      var tables =2;
      var k =0;
        $(document).on('change','.tables', function(){ 
            var node = $(this);
            var num_tabla = $(this).parent().parent().attr('id');
            var tabla = $(node).find(":selected").text();
            $('.joins').find('#'+num_tabla).find('.text').text(' join '+tabla+' on ');
             $.ajax({
                url:'<?=base_url()?>index.php/codegen/getFields/'+tabla,
                type:'POST',
                dataType: 'json',
                success: function( json ) {
                    console.log(json);
                    $('.first_table').empty().append($('.container #1').find(":selected").text());
                    var fields = $(node).parent().parent().find('.fields');
                    $(fields).empty();
                    $.each(json, function(i, value) {
                        var field = $('.plantilla').children().clone();
                        $(field).find('input').attr('id',value.Field);
                        $(field).find('input[type=radio]:first').attr({'value':tabla+"."+value.Field,'id':num_tabla,'name':num_tabla+'-A'});
                        $(field).find('input[type=radio]:last').attr({'tipo':value.Type,'value':tabla+"."+value.Field,'id':1+Number(num_tabla),'name':num_tabla+'-B'});
                        $(field).find('input[type=checkbox]').attr({'onclick':'checbox()','class':tabla,'value':value.Field});
                        $(field).find('input[type=radio]').attr('onclick','radio()');
                        $(field).find('input[type=text]').attr('placeholder',value.Field);
                        $(fields).append(field);
                        if(num_tabla>1){
                          $('.input-group-addon').find('#'+num_tabla).prop('disabled',false);
                          $(field).find('input[type=radio]:first').prop('disabled', false);
                          $(field).find('input[type=radio]:last').prop('disabled', true);
                        }
                        k++;
                    });
                    cargar();
                }
            });
             
        });
        $(document).on('click','#clonar', function(){ 
            var nuevo = $( "#1" ).clone().attr('id',tables);
            $(nuevo).find('.fields').empty();
            $('#contenedor').append(nuevo);
            $('#query').append($('<div><div/>').attr('id',tables).html(tables));
            if(tables>=2){
              $( ".joins" ).append($('<div/>').attr({'id':tables,'class':'join'}));
              $( ".joins ").find('#'+tables).append($('<div/>').attr({'class':'text'}).text('join table on '));
              $( ".joins ").find('#'+tables).append($('<div/>').attr({'class':'on'}).text('id=id'));
            }
            tables++;
        });
        ///////////////////
        $(document).on('change','.where', function(){ 
          where();
        });
        $(document).on('change','.operator', function(){ 
          where();
        });
        $(document).on('input','.fecha', function(){ 
          where();
        });
        $("#datetimepicker1").on("dp.hide",function (e) {
            where();
        });
        ///////////////////
        $(document).on('change','#select_all',function() {
            var checkboxes = $(this).closest('.col-md-3').find(':checkbox');
            if($(this).is(':checked')) {
                checkboxes.prop('checked',true);
            } else {
                checkboxes.prop('checked',false);
            }
            checbox();
        });
        $(document).on('change','input[type=text]',function() {
          var id = $(this).attr('id');
          var tabla = $(this).closest('.col-md-3').attr('id');
          var texto = $(this).attr('value');
          $('#'+id+' .'+tabla).attr('value',texto);
        });
    });
    function checbox(){
            $('.campos').empty();
            var i = 0;
            $(".fields input[type=checkbox]:checked").each(function(){
            var tabla = $(this).closest(".col-md-3").find(":selected");
            console.log(tabla.html());
            $('.campos').append(tabla.text()+"."+$(this).attr('value'));
            if(i<$(".fields input[type=checkbox]:checked").length-1){
              $('.campos').append(',<br>');
            }
            i++;
            });
      }
      function radio(){
        var f = 1;
        var anterior = "";
        var izquierda = Array();
        var derecha = Array();
        console.log("hola");
        $(".r input[type=radio]:checked").each(function(){
          console.log($(this).attr("value"));
          derecha.push($(this).attr("value"));
        });
        $(".l input[type=radio]:checked").each(function(){
          console.log($(this).attr("value"));
          izquierda.push($(this).attr("value"));
        });
        
          for(var i = 0 ; i < izquierda.length ; i++){
            $('.joins').find('#'+(i+2)).find('.on').text(derecha[i]+"="+izquierda[i]);
            console.log(i+"-"+"d"+derecha[i]+"="+izquierda[i]+"i");
          }
        }
        function where(){
          var s=" where ";
          $('.el_where').each(function(i){
            var tipo = $(this).find('.where').find(':selected').attr('type');
            var where = $(this).find('.where').find(':selected').text();
            var operator = $(this).find('.operator').find(':selected').text();
            var string = $(this).find('.fecha').val();
            console.log(where+operator+string);
            console.log(tipo);
            if(tipo == "int"){
              s +=where+" "+operator+" "+string; 
            }else{
              s += where+" "+operator+" '"+string+"'";
            }
            if(!i<$('.el_where').length-1){
              s+=" and ";
            }
            $('.wheres').text(s);
          });
        }
      function cargar(){
        //$('.consult').html($('.consulta').text().replace(/(\s+)/g,' '));
        $('.where').empty();
        $('.where').append('<option value=""></option>');
        $(".fields .r input[type=radio]").each(function(){
          $('.where').append('<option type="'+$(this).attr("tipo").substring(0,3)+'" value="'+$(this).attr("value")+'">'+$(this).attr("value")+'</option>');
        });
      }
      function operator(){
        var nuevo = $( ".el_where" ).clone();
        $(nuevo).find('.input').attr('id','datetimepicker'+conter);
        $('#w_').append(nuevo);
        $('#datetimepicker'+conter).datetimepicker({
          language: 'es',
          pick12HourFormat: true
        });
        conter++;
        
      }
      conter = 2;
</script>
<div class="container">
<div class="col-md-12">
      <a href="#" id="clonar" class="btn btn-primary">Agregar tabla</a>
      <a href="#" result="allow" onclick="return CloseMySelf(this);" class="btn btn-warning">Aceptar</a>
      <a href="#" onclick="limpiarC()" class="btn btn-success">Limpiar</a>
      <a href="#" onclick="operator()" class="btn btn-success">Agregar operador</a>
</div>
<div class="col-md-12">
    <div id="contenedor">
          <div class="col-md-3" id="1">
            <div class="input-group input-group-sm">
              <span class="input-group-addon" style="font-size:10px;">
                FK
              </span>
              <span class="input-group-addon">
                <input type="checkbox"  id="select_all">
              </span>
                  <?php
                  $db_tables = $this->db->list_tables();
                  echo form_dropdown('table',$db_tables,'default','class="form-control tables"');
                  ?>
              <span class="input-group-addon" style="font-size:10px;">
                FK  
              </span>
            </div>
            <div class="fields">
                        
            </div>
          </div>
    </div>
    <div class="col-md-3" id="w_">
        <div class="input-group input-group-sm el_where">
        <button type="button" class="close" data-dismiss="alert" >
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
              <select class="form-control where" name="where[]" id="">
                <option value=""></option>
              </select>
              <select class="form-control operator" name="operator[]" id="">
                  <option value=""></option>
                  <option value="=">=</option>
                  <option value=">">&gt;</option>
                  <option value=">=">&gt;=</option>
                  <option value="<">&lt;</option>
                  <option value="<=">&lt;=</option>
                  <option value="!=">!=</option>
                  <option value="LIKE">LIKE</option>
                  <option value="LIKE %...%">LIKE %...%</option>
                  <option value="NOT LIKE">NOT LIKE</option>
                  <option value="IN (...)">IN (...)</option>
                  <option value="NOT IN (...)">NOT IN (...)</option>
                  <option value="BETWEEN">BETWEEN</option>
                  <option value="NOT BETWEEN">NOT BETWEEN</option>
                  <option value="IS NULL">IS NULL</option>
                  <option value="IS NOT NULL">IS NOT NULL</option>
              </select>
              <div class="input-group input" id="datetimepicker1" data-date-format="YYYY-MM-DD hh:mm:ss">
                  <input required="" class="form-control fecha" id="" type="text" name="fecha" value="">
                  <span class="input-group-addon">
                  <span class="glyphicon-calendar glyphicon"></span>
                  </span>
              </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-12">
  <code>
    <div class="consulta" >
        <div class="select">
              SELECT 
        </div>
        <div class="campos">
              *
        </div>
        <div class="from">
              FROM 
        </div>
        <div class="first_table">
              tabla 
        </div>
        <div class="joins">
        </div>
        <div class="wheres">
        </div>
  </div>
  </code>
  <br>
      <textarea name="" class="salida" id="" cols="300" rows="5"></textarea>
</div>

</div>

<div class="plantilla" style="visibility:hidden">
   <div class="input-group input-group-sm">
      <span class="input-group-addon l" >
        <input type="radio" disabled>
      </span>
      <span class="input-group-addon">
        <input type="checkbox">
      </span>
      <input type="text" class="form-control">
      <span class="input-group-addon r">
        <input type="radio">
      </span>
    </div>
</div>
<?$this->load->view('footer')?>