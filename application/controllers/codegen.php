<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * CI Generator
 * http://projects.keithics.com/crud-generator-for-codeigniter/ 
 * Copyright (c) 2011 Keith Levi Lumanog
 * Dual MIT and GPL licenses.
 *
 * A CI generator to easily generates CRUD CODE, feel free to improve my code or customized it the way you like.
 * as inspired by Gii of Yii Framework. Last update August 15, 2011
 */
 

class Codegen extends CI_Controller {
     function __construct() {
        parent::__construct();
    }  
    function checarLogin(){
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
    }
    function getTable($table="",$key="",$value){
        $this->load->database();
        $this->load->model('codegen_model');
        foreach($this->codegen_model->get($table,$key.",".$value,"","","") as $row){
            $list[$row[$key]]=$row[$value];
        }
        var_dump($list);
        //echo json_encode($this->codegen_model->get($table,$key.",".$value,'','',''));
    }
    function getControllers(){
        $this->load->library('controllerlist');
        $res = $this->controllerlist->getControllers();
         foreach($res as $row => $value){
            echo $row . "<br/>";
            foreach($value as $val){
                echo $val;
            }
        }
    }
    function getFields($table_name=""){
                $this->load->database();
                $table = $this->db->list_tables();
                $result = $this->db->query("SHOW FIELDS from ".$table_name);
                foreach($result->result() as $row) { $list[]=$row->Field;}
                echo json_encode($result->result());
    }
    function index(){
        $this->checarLogin();
        $this->load->library('form_validation');
        $this->load->model('codegen_model');
        $this->load->database();
        $this->load->helper('url');
        $table = $this->db->list_tables();
        $data['db_tables'] = $this->db->list_tables();
        $data['table'] = $table[$this->input->post('table')];
        $result = $this->db->query("SHOW FIELDS from " . $data['table']);
        $data['alias'] = $result->result();
        $this->load->view("codegen_form");
    }
    function manage(){
        $data = '';
        $this->load->library('form_validation');
        $this->load->model('codegen_model');
        $this->load->database();
        $this->load->helper('url');
        
        if ($this->input->post('table_data') || !$_POST)
        {
            // get table data
            $this->form_validation->set_rules('table', 'Table', 'required|trim|xss_clean|max_length[200]');

            if ($this->form_validation->run() == false)
            {
                
            } else
            {

                $table = $this->db->list_tables();
                $data['db_tables'] = $this->db->list_tables();
                $data['table'] = $table[$this->input->post('table')];
                $result = $this->db->query("SHOW FIELDS from " . $data['table']);
                $data['alias'] = $result->result();
                
            }
            $this->load->view('codegen', $data);

        } else
            if ($this->input->post('generate'))
            {
                $this->load->helper('file');
                
                $all_files = array(
                    'application/config/form_validation.php',
                    'application/controllers/'.$this->input->post('controller').'.php',
                    'application/models/codegen_model.php',
                    'application/views/'.$this->input->post('view').'_add.php',
                    'application/views/'.$this->input->post('view').'_edit.php',
                    'application/views/'.$this->input->post('view').'_list.php'
                    );

                //checking of files if they existed. comment if you want to overwrite files!
                $err = 0;
                /*** // uncomment me to allow overwrites
                foreach($all_files as $af){
                    if($this->fexist($af)){
                        $err++;
                        echo $this->fexist($af)."<br>";    
                    }
                }
                
                if($err > 0){
                    echo 'Files Exists - Generator stopped.<br>';
                    echo '<h3>Post Data Below:</h3><br>';
                    echo '<pre>';
                    print_r($_POST);
                    echo '<pre>';
                    exit;
                }
                ***/
                $permisos  = Array();
                if($this->input->post('permisos')!="")
                $permisos = $this->input->post('permisos');
                $rules = $this->input->post('rules');
                $label = $this->input->post('field');
                $type = $this->input->post('type');
                $preconsult[]="";
                
                // looping of labels and forms , for edit and add
                foreach($label as $k => $v){
                    if($type[$k][0] != 'exclude'){
                    $labels[] = $v;
                    $form_fields[] = $k;
                    if($rules[$k][0] != 'required'){
                        $required = '';
                        $req="";
                    }else{
                        $required = '<span class="required">*</span>';
                        $req="required";
                    }
                    // this will create a form for Add and Edit , quite dirty for now
                    if($type[$k][0] == 'user'){
                        
                    }else if($type[$k][0] == 'textarea'){
                         $add_form[] = '
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">                                
                                    <textarea '.$req.' class="form-control" id="'.$k.'" name="'.$k.'"><?php echo set_value(\''.$k.'\'); ?></textarea>
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>
                                    ';
                                    
                         $edit_form[] = '
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">                                
                                    <textarea '.$req.' class="form-control" id="'.$k.'" name="'.$k.'"><?php echo $result->'.$k.' ?></textarea>
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>
                                    ';                                    
                                    
                    }else if($type[$k][0] == 'datetime'){
                         $add_form[] = '
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                        <div class="col-sm-10">
                                            <div class="input-group date" id="'.$k.'" data-date-format="YYYY-MM-DD hh:mm:ss">
                                                <input '.$req.' class ="form-control" id="" type="text" name="'.$k.'" value="<?php echo set_value(\''.$k.'\'); ?>"  />
                                                <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $("#'.$k.'").datetimepicker({
                                            language: "es",
                                            pick12HourFormat: true
                                        });
                                    </script>
                                    ';
                                    
                         $edit_form[] = '

                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                        <div class="col-sm-10">
                                            <div class="input-group date" id="'.$k.'" data-date-format="YYYY-MM-DD hh:mm:ss">
                                                <input '.$req.' class ="form-control" id="" type="text" name="'.$k.'" value="<?php echo $result->'.$k.' ?>"  />
                                                <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $("#'.$k.'").datetimepicker({
                                            language: "es",
                                            pick12HourFormat: true
                                        });
                                    </script>
                                    ';                                    
                                    
                    }else if($type[$k][0] == 'picture'){
                         $add_form[] = '
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">  
                                    <input '.$req.' class ="form-control" id="'.$k.'"  type="hidden" name="'.$k.'" value="<?php echo set_value(\''.$k.'\'); ?>"  />
                                    <div class="'.$k.'"></div>
                                    <a href="#" class="btn btn-default" data-target="#galeria" id="gal" data-toggle="modal">Foto</a>
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>
                                    ';
                        $edit_form[] = '
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label"  for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">
                                    <div class="'.$k.'">
                                    <img height="100px" src="<?=$result->'.$k.'?>" />
                                    </div>                         
                                    <input '.$req.' class ="form-control" id="'.$k.'" type="hidden" name="'.$k.'" value="<?php echo $result->'.$k.' ?>"  />
                                    <a href="#" class="btn btn-default" data-target="#galeria" id="gal" data-toggle="modal">Foto</a>
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>
                                    ';                           
                                    
                    }else if($this->input->post($k.'default')){
                        $enum = explode(',',$this->input->post($k.'default'));
                         $add_form[] = '
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">                                
                                    <?php
                                    $enum = array('.$this->input->post($k.'default').'); 
                                    if(sizeof($enum)>4){
                                        echo form_dropdown(\''.$k.'\', $enum,"default",\'class="form-control" '.$req.'\'); 
                                    }else{
                                        $x=0;
                                    ?>
                                    <div class="btn-group" data-toggle="buttons">
                                      <?foreach($enum as $key => $v):?>
                                      <label class="btn btn-primary ">
                                        <input type="radio" name="'.$k.'" id="option<?=$x?>" autocomplete="off" value="<?=$v?>"  required> <?=$key?>
                                      </label>
                                      <?
                                        $x++;
                                      endforeach;?>
                                    </div>
                                    <?                                        
                                    }                                                     
                                    ?>
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>
                                    ';
                        $edit_form[] = '
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">
                                    <?php
                                    $enum = array('.$this->input->post($k.'default').');
                                    if(sizeof($enum)>4){
                                        echo form_dropdown(\''.$k.'\', $enum,$result->'.$k.',\'class="form-control" '.$req.'\'); 
                                    }else{
                                        $x=0;
                                    ?>
                                    <div class="btn-group" data-toggle="buttons">
                                      <?foreach($enum as $key => $v):?>
                                      <?if($result->'.$k.'==$key){$active = "active"; $checked = "checked";}else{$active=""; $checked = "";}?>
                                      <label class="btn btn-primary <?=$active?>">
                                        <input type="radio" name="'.$k.'" id="option<?=$x?>" autocomplete="off" value="<?=$v?>" <?=$checked?> required> <?=$key?>
                                      </label>
                                      <?
                                        $x++;
                                      endforeach;?>
                                    </div>
                                    <?                                        
                                    }                                                     
                                    ?>
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>
                                    ';                                    
                    }
                    else if($this->input->post($k.'value')){
                        $table = $this->db->list_tables();
                        $table = $table[$this->input->post($k.'table')];
                        $value = $this->input->post($k.'value');

                        $result = $this->db->query("SHOW FIELDS from " . $table);
                        $alias = $result->result();
                        $key="";
                        foreach($alias as $a){
                            if($a->Key == "PRI"){
                                $key = $a->Field;
                                break;
                            }
                        }
                        $preconsult[] = '
                                    $table=\''.$table.'\';
                                    $key=\''.$key.'\';
                                    $value=\''.$value.'\';
                                    $list = null;
                                    foreach($this->codegen_model->get($table,$key.",".$value,"","","") as $row){
                                        $list[$row[$key]]=$row[$value];
                                    }
                                    $this->data[\''.$k.'\'] = $list;';
                         $add_form[] = '
                                    <div class="clearfix"></div>
                                    <?
                                    $table=\''.$table.'\'; 
                                    if(!empty($'.$k.')){
                                    $class="";
                                    $input = form_dropdown(\''.$k.'\', array("" => "")+$'.$k.',"default",\'class="form-control" '.$req.'\'); 
                                    }else{
                                    $class = "has-error";
                                    $input = form_dropdown("error", array("0"=>"La tabla ".$table." debe tener almenos un registro"),"default", \'disabled="disabled" class="form-control"\');
                                    }
                                    ?>
                                    <div class="form-group <?=$class?>">
                                    <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">
                                      <div class="input-group">
                                      <?=$input;?>
                                      <span class="input-group-btn">
                                        <a class="btn btn-primary" href="<?=base_url().$table?>/manage" target="_blank"  ><span class="glyphicon glyphicon-plus"></span></a>
                                      </span>
                                    </div><!-- /input-group -->
                                    
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>
                                    ';
                        $edit_form[] = '
                                    <div class="clearfix"></div>
                                    <?php
                                    $table=\''.$table.'\';  
                                    if(!empty($'.$k.')){ 
                                    $class="";                                                 
                                    $input = form_dropdown(\''.$k.'\',array("" => "")+ $'.$k.',$result->'.$k.',\'class="form-control" '.$req.'\');
                                    }else{
                                    $class = "has-error";
                                    $input = form_dropdown("error", array("0"=>"La tabla ".$table." debe tener almenos un registro"),"default", \'disabled="disabled" class="form-control"\');
                                    }
                                    ?>
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    <div class="form-group <?=$class?>">
                                    <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">
                                      <div class="input-group">
                                      <?=$input;?>
                                      <span class="input-group-btn">
                                        <a class="btn btn-primary" href="<?=base_url().$table?>/manage" target="_blank"  ><span class="glyphicon glyphicon-plus"></span></a>
                                      </span>
                                    </div><!-- /input-group -->
                                    
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>

                                    ';                                    
                    }else{
                        //input
                        $add_form[] = '
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">  
                                    <input '.$req.' class ="form-control" id="'.$k.'" type="'.$type[$k][0].'" name="'.$k.'" value="<?php echo set_value(\''.$k.'\'); ?>"  />
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>
                                    ';
                        $edit_form[] = '
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label"  for="'.$k.'">'.$v.$required.'</label>
                                    <div class="col-sm-10">                                
                                    <input '.$req.' class ="form-control" id="'.$k.'" type="'.$type[$k][0].'" name="'.$k.'" value="<?php echo $result->'.$k.' ?>"  />
                                    <?php echo form_error(\''.$k.'\',\'<div>\',\'</div>\'); ?>
                                    </div>
                                    </div>
                                    ';
                        }
                    }
                }
              
                // this will ensure that the primary key will be selected first.
                $fields_list[] = $this->input->post('primaryKey');
                // looping of rules 
                foreach($rules as $k => $v){
                    $rules_array = array();
                    if($type[$k][0] != 'user'){
                    if($type[$k][0] != 'exclude'){
                        
                        foreach($rules[$k] as $k1 => $v1){
                            if($v1){
                            $rules_array[] = $v1;
                            }
                        }
                        $form_rules = implode('|',$rules_array);
                        $form_val_data[] = "array(
                                \t'field'=>'".$k."',
                                \t'label'=>'".$label[$k]."',
                                \t'rules'=>'".$form_rules."'
                                )";
                        $new_form_val_data[] = Array(
                                'field'=>$k,
                                'label'=>$label[$k],
                                'rules'=>$form_rules
                                );
                        $controller_form_data[] = "'".$k."' => set_value('".$k."')";
                        $controller_form_editdata[] = "'".$k."' => \$this->input->post('".$k."')";
                        $fields_list[] = $k;   
                    }
                    }else{
                        $controller_form_data[] = "'".$k."' => \$this->ion_auth->user()->row()->id";
                        $controller_form_editdata[] = "'".$k."' => \$this->ion_auth->user()->row()->id";
                        $fields_list[] = $k; 
                    }
                }

                
                $fields = implode(',',$fields_list);
                $form_data = implode(','."\n\t\t\t\t\t\t\t\t",$form_val_data);
                $file_validation = 'application/config/form_validation.php';
                $form_validation_data = "'".$this->input->post('table')."' => array(".$form_data.")";
                
                /////////////// add a new way to edit the form rules
                if(file_exists('application/config/form_validation.json')){
                    $form_d = file_get_contents('application/config/form_validation.json');
                    $config = json_decode($form_d,true);
                }
                $config["config"][$this->input->post('table')] =$new_form_val_data ;
                $this->writefile('application/config/form_validation.json',json_encode($config,JSON_PRETTY_PRINT));

               ////////////////////
                $c_path = 'application/controllers/';
                $m_path = 'application/models/'; 
                $v_path = 'application/views/';
                ///////////////// controller
                $controller = file_get_contents('templates/controller.php');
                $search = array('{grupos}','{pre}','{controller_name}', '{view}', '{table}','{validation_name}',
                '{data}','{edit_data}','{controller_name_l}','{primaryKey}','{fields_list}');
                $replace = array(
                            implode("','",$permisos),
                            implode(' ',$preconsult),
                            ucfirst($this->input->post('controller')), 
                            $this->input->post('view'),
                            $this->input->post('table'),
                             $this->input->post('validation'),
                             implode(','."\n\t\t\t\t\t",$controller_form_data),
                             implode(','."\n\t\t\t\t\t",$controller_form_editdata),
                             $this->input->post('controller'),
                             $this->input->post('primaryKey'),
                             $fields
                            );

                $c_content = str_replace($search, $replace, $controller);

                
                $file_controller = $c_path . $this->input->post('controller') . '.php';
                // create view/form, TODO, make this a function! and make a stop overwriting files
                
                //VIEW/LIST FORM
                $list_v = file_get_contents('templates/list.php');
                
                $list_content = str_replace('{controller_name_l}',$this->input->post('controller'),$list_v);

                //ADD FORM
                $add_v = file_get_contents('templates/add.php');
                
                $add_content = str_replace('{forms_inputs}',implode("\n",$add_form),$add_v);
                
                //EDIT FORM
                $edit_v = file_get_contents('templates/edit.php');
                $edit_search = array('{forms_inputs}','{primary}');
                $edit_replace = array(implode("\n",$edit_form),'<?php echo form_hidden(\''.$this->input->post('primaryKey').'\',$result->'.$this->input->post('primaryKey').') ?>');
                
                $edit_content = str_replace($edit_search,$edit_replace,$edit_v);
                
                $write_files = array(
                                'Controller' => array($file_controller, $c_content),
                                'view_edit'  => array($v_path.$this->input->post('view').'_edit.php', $edit_content),
                                'view_list'  => array($v_path.$this->input->post('view').'_list.php', $list_content),
                                'view_add'  => array($v_path.$this->input->post('view').'_add.php', $add_content)
                                );
                foreach($write_files as $wf){
                    if($this->writefile($wf[0],$wf[1])){
                        $err++;
                        echo $this->writefile($wf[0],$wf[1]);
                    }
                }        
                                                    
               if($err >0){
                    exit;
                }else{
                    $data['list_content'] = $list_content;
                    
                    $data['add_content'] = $add_content;
                                        
                    $data['edit_content'] = $edit_content;
                    
                    $data['controller'] = $c_content;
                    
                    $this->load->view('done',$data);
                    //echo 'DONE! view it here '. anchor(base_url().'index.php/'.$this->input->post('controller').'/');
                }   
            }// if generate
    }
    
    function fexist($path){
             if (file_exists($path))
            {
                // todo , automatically adds new validation
                return $path.' - File exists <br>';                    
            }
            else{
                return false;
            }        
    }
    
    function writefile($file,$content){
        
        if (!write_file($file, $content))
        {
            return $file. ' - Unable to write the file';
        } else
        {
            return false;
        }
    }


}

/* End of file codegen.php */
/* Location: ./application/controllers/codegen.php */
