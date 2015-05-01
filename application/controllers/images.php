<?php

class Images extends CI_Controller {
    
    function __construct() {
        parent::__construct();
		$this->load->library('form_validation');
        $this->load->database();
        $this->load->helper(array('form','url','codegen_helper'));
        $this->load->model('codegen_model','',TRUE);
         $this->load->library('ion_auth');
         $this->load->helper('directory');
    }   
    function checkLogin(){
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            redirect('home/profile', 'refresh');
        }
    }
	
   function index(){
    $this->checkLogin();
     $dir = '/uploads/'.$this->ion_auth->user()->row()->id."/";
   $this->data['results'] = directory_map($dir);
    $this->data['dir'] = $dir;
     $this->load->view('header');
    $this->load->view('images_add');
    $this->load->view('images_list', $this->data);
     $this->load->view('footer');
    }
    function add()
    {           
        $dir = './uploads/'.$this->ion_auth->user()->row()->id."/";
        if(!file_exists($dir)){
            mkdir($dir);
        }
        $this->file="";
        if(@$_FILES['file']['name']!=""){
            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name'] = FALSE;
            $config['remove_spaces'] = TRUE;
            $config['max_size'] = '4048';
            $this->upload_file($config,'file');
        }
        $this->data['results'] = directory_map($dir);
        $this->data['dir'] = $dir;
        $this->load->view('images_list', $this->data); 
            
    }
	function manage(){
	$this->checkLogin();
    $dir = './uploads/'.$this->ion_auth->user()->row()->id."/";
    $this->data['results'] = directory_map($dir);
    $this->load->view('images_add');
    $this->data['dir'] = $dir;
    $this->load->view('images_list', $this->data); 
		
    }
	function update(){
        $dir = './uploads/'.$this->ion_auth->user()->row()->id."/";
        $this->data['results'] = directory_map($dir);
        $this->data['dir'] = $dir;
        $this->load->view('images_list', $this->data); 
    }
	
    function delete($ID){
    		$this->checkLogin();
            $dir = './uploads/'.$this->ion_auth->user()->row()->id."/";
            unlink($dir.$ID);
    }
    public  function check_file($field,$field_value)
    {
        if(isset($this->custom_errors[$field_value]))
        {
            $this->form_validation->set_message('check_file', $this->custom_errors[$field_value]);
            unset($this->custom_errors[$field_value]);
            return FALSE;
        }
        return TRUE;
    }
    function upload_file($config,$fieldname)
    {
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload($fieldname);
        $error = $this->upload->display_errors();
        if(empty($error))
        {
            $data = $this->upload->data();
            $this->$fieldname = $data['file_name'];
        }
        else
        {
            $this->custom_errors[$fieldname] = $error;
        }
        echo $error;
    }
    
    function success()
    {
        //$this->load->view("header");
        $this->load->view("success");
        //$this->load->view("footer");
    }
}

/* End of file images.php */
/* Location: ./system/application/controllers/images.php */