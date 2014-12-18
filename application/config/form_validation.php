<?php
if(file_exists('application/config/form_validation.json')){
	$form_d = file_get_contents('application/config/form_validation.json');
	$config = json_decode($form_d,true);
	$config = $config["config"];
}	   
?>