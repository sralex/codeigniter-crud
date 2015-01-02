<?$this->load->view('header')?>
<div class="panel panel-default">
  <!-- Default panel contents -->
 <div class="panel-heading">
  <span class="glyphicon glyphicon-list"></span> {controller_name_l}
    <div class="pull-right action-buttons">
        <div class="btn-group pull-right">
            <div class="input-group" style="width:300px; float:left;">
            <span class="input-group-btn">
                    <button title="Click for search" type="button" data="searchbox" class="btn btn-info btn-sm borrar">
                        x
                    </button>
                </span>
                <input type="text" class="form-control input-sm"  placeholder="Buscar" id="searchbox">
            </div>
            <a href="#" class="toAdd btn btn-default btn-sm dropdown-toggle" data-toggle="modal" data-target="#myModal4">
                <span class="glyphicon glyphicon-plus" style="margin-right: 0px;"></span>
            </a>
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-cog" style="margin-right: 0px;"></span>
            </button>
            <ul class="dropdown-menu slidedown">
                <li><a href="#"><span class="glyphicon glyphicon-pencil"></span>Edit</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-trash"></span>Delete</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-flag"></span>Flag</a></li>
            </ul>
        </div>
    </div>
  </div>
  <div class="panel-body">
  </div>
<?php
$cadena = explode(" ", $consulta);
$elementos = explode(",", $cadena[1]);
if(!$results){
  echo '<h3>No hay datos :C</h3>';
}else{
  $header = array_keys($results[0]);
  $header['Edit']="";

for($i=0;$i<count($results);$i++){
            $id = array_values($results[$i]);
            $results[$i]['Edit']='
                          <div class="pull-right action-buttons">
                                <a href="#" class="toSee text-info" id="'.$id[0].'" data-toggle="modal" data-target="#myModal3"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="#" class="toEdit" style = "color:rgb(248, 148, 6);" id="'.$id[0].'" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="#" class="toDelete" style = "color:rgb(209, 91, 71);" id="'.$id[0].'" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>';
            //$results[$i]['Delete']   =                                           
            if(isset($results[$i]['foto'])){
            $results[$i]['foto'] = '<a target="blank_" href="'.$results[$i]['foto'].'"><img width="140px" src="'.$results[$i]['foto'].'"></a>';
            }
            array_shift($results[$i]);                        
        }

$clean_header = clean_header($header);
array_shift($header);
$this->table->set_heading($header); 
$this->table->set_footer($header);

// view
$tmpl = array ( 'table_open'  => '<table class="table table-striped table-bordered" id="example">' );
$this->table->set_template($tmpl);
echo $this->table->generate($results); 
echo $this->pagination->create_links();
}?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content" style="z-index:1000">
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
    <div class="modal-content" id="result-2">
    
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
    <div class="modal-content" id="result-4">
      
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
    $("#filtrar").click(function(){
    window.location = "<?=base_url()?>index.php/{controller_name_l}/manage/0/"+$( "#where option:selected" ).val()+"/"+$( "#operator option:selected" ).val()+"/"+$("#fecha").val();
    });
   
});
</script>

<?$this->load->view('footer')?>