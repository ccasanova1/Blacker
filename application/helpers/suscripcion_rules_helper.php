<?php
	function getsuscripcionRules(){
		return array(
        	array(
            	    'field' => 'numeroTarjeta',
            	    'label' => 'Numero de tarjeta',
            	    'rules' => 'required|exact_length[16]|numeric',
            	    'errors' => array(
             	            'required' => 'Ingrese un %s',
             	            'exact_length' => 'El %s tiene que tener 16 numeros',
                          'numeric' => 'El %s solo puede contener numeros',
            	    ),
        	),
          array(
                 'field' => 'vencimientoMes',
                 'label' => 'Vencimiento Mes',
                 'rules' => 'required|exact_length[2]|numeric',
                 'errors' => array(
                           'required' => 'El %s es requerido',
                           'exact_length' => 'El %s tiene que tener 2 numeros',
                           'numeric' => 'El %s solo puede contener numeros',
                  ),
          ),
          array(
                 'field' => 'vencimientoAño',
                 'label' => 'Vencimiento Año',
                 'rules' => 'required|exact_length[2]|numeric',
                 'errors' => array(
                          'required' => 'El %s es requerido',
                          'exact_length' => 'El %s tiene que tener 2 numeros',
                          'numeric' => 'El %s solo puede contener numeros',
                  ),
          ),
       		array(
         	       'field' => 'CVC',
         	       'label' => 'CVC',
         	       'rules' => 'required|min_length[3]|max_length[4]|numeric',
         	       'errors' => array(
                          'required' => 'El %s es requerido',
                          'min_length' => 'El %s tiene que tener minimo 3 numeros',
                          'max_length' => 'El %s solo puede tener un maximo de 4 numeros',
                          'numeric' => 'El %s solo puede contener numeros',
            	    ),
        	),
		);
	}