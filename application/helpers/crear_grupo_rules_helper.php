<?php

	function getcreargruporules(){
		return array(
        	array(
            	    'field' => 'descripcionGrupo',
            	    'label' => 'descripcionGrupo',
            	    'rules' => 'max_length[255]|trim|required',
            	    'errors' => array(
             	           'max_length' => 'Maximo 255 letras.',
                           'required' => 'La descripcion es requerida',

            	    ),
        	),
       		array(
         	       'field' => 'nombreGrupo',
         	       'label' => 'nombreGrupo',
         	       'rules' => 'max_length[50]|trim|required|is_unique[grupo.nombre]',
         	       'errors' => array(
             	           'required' => 'El nombre es requerido',
                           'max_length' => 'Maximo 50 caracteres.',
                           'is_unique' => 'El %s ya se encuentra en uso',
            	    ),
        	),
		);
	}