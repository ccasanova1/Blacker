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

    function getlogincontraseñagetrules(){
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
        );
    }

    function getlogincontraseñasetrules(){
        return array(
            array(
                   'field' => 'password',
                   'label' => 'Contraseña',
                   'rules' => 'required|min_length[6]|max_length[20]|alpha_numeric',
                   'errors' => array(
                           'required' => 'Ingrese una %s',
                           'min_length' => 'Minimo 6 caracteres',
                           'max_length' => 'Maximo 20 caracteres',
                           'alpha_numeric' => 'Solo letras y numeros',
                    ),
            ),
          array(
                 'field' => 'rep_password',
                 'label' => 'Contraseñas',
                 'rules' => 'required|matches[password]',
                 'errors' => array(
                         'required' => 'Ingrese una Contraseña',
                          'matches' => 'Las %s no coinciden',
                  ),
          ),
        );
    }