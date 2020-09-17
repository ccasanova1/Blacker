<?php

	function getpublicaRules(){
		return array(
        	array(
            	    'field' => 'publicarTexto',
            	    'label' => 'PublicarTexto',
            	    'rules' => 'max_length[255]|trim',
            	    'errors' => array(
             	           'max_length' => 'Maximo 255 letras.',
            	    ),
        	),
       		array(
         	       'field' => 'publicarVideo',
         	       'label' => 'PublicarVideo',
         	       'rules' => 'max_length[255]|trim',
         	       'errors' => array(
             	           'max_length' => 'Maximo 255 caracteres en la URL.',
            	    ),
        	),
		);
	}