<?$this->load->view('header')?>
<?php
echo anchor('#','<span class="glyphicon glyphicon-plus"></span> Agregar',array('class'=>'btn btn-primary toAdd',"data-toggle"=>"modal","data-target"=>"#myModal4"));
echo '<h1> {controller_name_l}</h1>';
if(!$results){
  echo '<h3>No hay datos :C</h3>';
}else{
  $header = array_keys($results[0]);


for($i=0;$i<count($results);$i++){
            $id = array_values($results[$i]);
            $results[$i]['Edit']     = '<div class="btn-group">'
            .anchor('#','<span class="glyphicon glyphicon-eye-open"></span>',array("id"=>$id[0],"class"=>"btn btn-success toSee","data-toggle"=>"modal","data-target"=>"#myModal3"))
            .anchor('#','<span class="glyphicon glyphicon-pencil"></span>',array('id'=>$id[0],'class'=>'btn btn-warning toEdit',"data-toggle"=>"modal","data-target"=>"#myModal2"))
            .anchor('#','<span class="glyphicon glyphicon-trash"></span>',array("id"=>$id[0],"class"=>"btn btn-danger toDelete","data-toggle"=>"modal","data-target"=>"#myModal")).'</div>';
            //$results[$i]['Delete']   =                                           

            array_shift($results[$i]);                        
        }

$clean_header = clean_header($header);
array_shift($clean_header);
$this->table->set_heading($clean_header); 

// view
$tmpl = array ( 'table_open'  => '<table class="table">' );
$this->table->set_template($tmpl);
echo $this->table->generate($results); 
?>
<?=$this->pagination->create_links();
}?>
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
});
</script>
<?$this->load->view('footer')?>
</body>
</html>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Alerta</h4>
      </div>
      <div class="modal-body">
        Seguro que desea continuar con la acción?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary borrar" href="#" >Si</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar</h4>
      </div>
      <div class="modal-body" id="result-2">
       
      </div>
    </div>
  </div>
</div>
<!-- Modal3 -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalles</h4>
      </div>
      <div class="modal-body" id="result-3">
       
      </div>
    </div>
  </div>
</div>
<!-- Modal3 -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalles</h4>
      </div>
      <div class="modal-body" id="result-4">
       
      </div>
    </div>
  </div>
</div>