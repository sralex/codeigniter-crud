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
 

class Querys extends CI_Controller {
     function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('codegen_model','',TRUE);
    } 
    
    function index(){
                $this->load->database();
                $table = $this->db->list_tables();
                $data['table'] = $table[$this->input->post('table')];
                $result = $this->db->query("SHOW FIELDS from " . $data['table']);
                $data['alias'] = $result->result();
                $this->load->view('querys',$data);
    }
    function limpiar(){
        echo preg_replace( '/\s+/', ' ',trim($this->input->post('consulta')) );
    }
    function create(){
      header('Content-Type: text/html; charset=utf-8');
        $c =  'SELECT wp_posts.ID,wp_posts.post_content,post_title FROM wp_posts';
        $result = $this->codegen_model->query($c);

        foreach($result as $r){
          //$content = strip_tags($r['post_content'],'<p><p/>');
          $content = $r['post_content'];
          //remove caption
          echo $r['post_title'];
          $content =  preg_replace('#\[caption[^\]]*\](.*?)\[/caption\]#m', "", $content);
          $pos=strpos($content, '</p>', 300);
          echo $pos."<-";
          $string = substr($content,0,$pos );
         
          $string  = strip_tags($string,'<strong></strong>');
          $string = htmlspecialchars_decode($string);
          if(isset($string )){
          $data = Array(
            "post_excerpt"=>$string
            );
          var_dump($data);
             if($this->codegen_model->edit('wp_posts',$data,'ID',$r['ID'])){
              echo "se edito post ".$r['ID']."<br>";
              }
          }
         
        }
    }    
    function create2(){
      header('Content-Type: text/html; charset=utf-8');
        $c =  'SELECT wp_posts.ID,wp_posts.post_content,post_title FROM wp_posts where post_title like "%performance%"';
        $result = $this->codegen_model->query($c);

        foreach($result as $r){
          $content = $r['post_content'];
          //remove caption
          $titulo =  explode(" ",$r['post_title']);
          
          if(isset($titulo )){
          $data = Array(
            "post_id"=>$r['ID'],
            "meta_key"=> '_wp_attached_file',
            "meta_value"=> 'portadas/'.preg_replace('/\D/', '',$titulo[1]).".jpg"
            );
          var_dump($data);
             if($this->codegen_model->add('wp_postmeta',$data)){
              echo "se edito post ".$r['ID']."<br>";
             }
          }
         
        }
    }
    function edit(){
        header('Content-Type: text/html; charset=utf-8');
        $c =  'SELECT jos_content.id,jos_content.created_by_alias,wp_posts.ID as wp_id FROM jos_content join wp_posts on jos_content.title=wp_posts.post_title ';
        $result = $this->codegen_model->query($c);

        
        foreach($result as $r){
          $user = $r['created_by_alias'];
          if(isset($user )){
          $data = Array(
            "post_id"=>$r['wp_id'],
            "meta_key"=> 'Autor',
            "meta_value"=> $user 
            );
          var_dump($data);
             if($this->codegen_model->add('wp_postmeta',$data)){
              echo "se edito post ".$r['wp_id']."<br>";
              }
          }
         
        }
    }
}

/* End of file codegen.php */
/* Location: ./application/controllers/codegen.php */
