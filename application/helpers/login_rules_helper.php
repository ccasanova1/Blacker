<?php
	function getloginRules(){
		return array(
        	array(
            	    'field' => 'email',
            	    'label' => 'Correo',
            	    'rules' => 'required|valid_email|trim',
            	    'errors' => array(
             	           'required' => 'Ingrese un %s.',
             	           'valid_email' => 'El %s es invalido'
            	    ),
        	),
       		array(
         	       'field' => 'password',
         	       'label' => 'Contraseña',
         	       'rules' => 'required',
         	       'errors' => array(
             	           'required' => 'Ingrese una %s.',
            	    ),
        	),
		);
	}