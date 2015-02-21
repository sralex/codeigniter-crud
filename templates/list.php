<div class="panel panel-default">
  <!-- Default panel contents -->
 <div class="panel-heading text-center">
    {controller_name_l}
    <div class="pull-left action-buttons">
        <div class="btn-group ">
            <button class="get_action btn btn-default btn-xs dropdown-toggle" data-id="" data-result="#modal-result" data-action="add" data-toggle="modal" data-target="#module_modal">
                <span class="glyphicon glyphicon-plus" style="margin-right: 0px;"></span>
            </button>
        </div>
    </div>
  </div>
  <div class="panel-body">
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
                                <a href="#" class="get_action" data-action="view" data-id="'.$id[0].'" data-result="#modal-result" data-toggle="modal" data-target="#module_modal"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="#" class="get_action" style = "color:rgb(248, 148, 6);" data-action="edit" data-id="'.$id[0].'" data-result="#modal-result" data-toggle="modal" data-target="#module_modal"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="#" class="delete_action" style = "color:rgb(209, 91, 71);" data-update="{controller_name_l}" data-id="'.$id[0].'" data-toggle="modal" data-target="#modal_delete"><span class="glyphicon glyphicon-trash"></span></a>
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
//$this->table->set_footer($header);

// view
$tmpl = array ( 'table_open'  => '<table class="table table-striped " id="example">' );
$this->table->set_template($tmpl);
echo $this->table->generate($results); 
echo $this->pagination->create_links();
}?>
