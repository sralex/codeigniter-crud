<?php

$config = array(
             	


             	'ActContestada' => array(array(
                                	'field'=>'ActAdicional_idActAdicional',
                                	'label'=>'ActAdicional_idActAdicional',
                                	'rules'=>'required|trim|xss_clean'
                                ),
								array(
                                	'field'=>'users_id',
                                	'label'=>'Users_id',
                                	'rules'=>'required|trim|xss_clean'
                                ))
			   
			   
				,

				'venta' => array(array(
                                	'field'=>'cliente_id',
                                	'label'=>'Cliente_id',
                                	'rules'=>'required|trim|xss_clean'
                                ),
								array(
                                	'field'=>'ventacol',
                                	'label'=>'Ventacol',
                                	'rules'=>'required|trim|xss_clean'
                                ))
			   );
			   
?>