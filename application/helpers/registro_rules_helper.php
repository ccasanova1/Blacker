<?php
	function getregistroRules1(){
		return array(
        	array(
            	    'field' => 'email',
            	    'label' => 'Correo',
            	    'rules' => 'required|valid_email|is_unique[cuenta_frontend.email]|trim',
            	    'errors' => array(
             	            'required' => 'Ingrese un %s',
             	            'valid_email' => 'El %s es invalido',
                          'is_unique' => 'El %s esta en uso'
            	    ),
        	),
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
            array(
         	       'field' => 'telefono',
         	       'label' => 'Telefono',
         	       'rules' => 'numeric|trim',
         	       'errors' => array(
                           'numeric' => 'Solo numeros',
            	    ),
            ),
            array(
         	       'field' => 'pais',
         	       'label' => 'Pais',
         	       'rules' => 'required|in_list[Afganistán,Akrotiri,Albania,Alemania,Andorra,Angola,Anguila,Antártida,Antigua y Barbuda,Antillas Neerlandesas,Arabia Saudí,Arctic Ocean,Argelia,Argentina,Armenia,Aruba,Ashmore andCartier Islands,Atlantic Ocean,Australia,Austria,Azerbaiyán,Bahamas,Bahráin,Bangladesh,Barbados,Bélgica,Belice,Benín,Bermudas,Bielorrusia,Birmania Myanmar,Bolivia,Bosnia y Hercegovina,Botsuana,Brasil,Brunéi,Bulgaria,Burkina Faso,Burundi,Bután,Cabo Verde,Camboya,Camerún,Canadá,Chad,Chile,China,Chipre,Clipperton Island,Colombia,Comoras,Congo,Coral Sea Islands,Corea del Norte,Corea del Sur,Costa de Marfil,Costa Rica,Croacia,Cuba,Dhekelia,Dinamarca,Dominica,Ecuador,Egipto,El Salvador,El Vaticano,Emiratos Árabes Unidos,Eritrea,Eslovaquia,Eslovenia,España,Estados Unidos,Estonia,Etiopía,Filipinas,Finlandia,Fiyi,Francia,Gabón,Gambia,Gaza Strip,Georgia,Ghana,Gibraltar,Granada,Grecia,Groenlandia,Guam,Guatemala,Guernsey,Guinea,Guinea Ecuatorial,Guinea-Bissau,Guyana,Haití,Honduras,Hong Kong,Hungría,India,Indian Ocean,Indonesia,Irán,Iraq,Irlanda,Isla Bouvet,Isla Christmas,Isla Norfolk,Islandia,Islas Caimán,Islas Cocos,Islas Cook,Islas Feroe,Islas Georgia del Sur y Sandwich del Sur,Islas Heard y McDonald,Islas Malvinas,Islas Marianas del Norte,IslasMarshall,Islas Pitcairn,Islas Salomón,Islas Turcas y Caicos,Islas Vírgenes Americanas,Islas Vírgenes Británicas,Israel,Italia,Jamaica,Jan Mayen,Japón,Jersey,Jordania,Kazajistán,Kenia,Kirguizistán,Kiribati,Kuwait,Laos,Lesoto,Letonia,Líbano,Liberia,Libia,Liechtenstein,Lituania,Luxemburgo,Macao,Macedonia,Madagascar,Malasia,Malaui,Maldivas,Malí,Malta,Man, Isle of,Marruecos,Mauricio,Mauritania,Mayotte,México,Micronesia,Moldavia,Mónaco,Mongolia,Montserrat,Mozambique,Namibia,Nauru,Navassa Island,Nepal,Nicaragua,Níger,Nigeria,Niue,Noruega,Nueva Caledonia,Nueva Zelanda,Omán,Pacific Ocean,Países Bajos,Pakistán,Palaos,Panamá,Papúa-Nueva Guinea,Paracel Islands,Paraguay,Perú,Polinesia Francesa,Polonia,Portugal,Puerto Rico,Qatar,Reino Unido,República Centroafricana,República Checa,República Democrática del Congo,República Dominicana,Ruanda,Rumania,Rusia,Sáhara Occidental,Samoa,Samoa Americana,San Cristóbal y Nieves,San Marino,San Pedro y Miquelón,San Vicente y las Granadinas,Santa Helena,Santa Lucía,Santo Tomé y Príncipe,Senegal,Seychelles,Sierra Leona,Singapur,Siria,Somalia,Southern Ocean,Spratly Islands,Sri Lanka,Suazilandia,Sudáfrica,Sudán,Suecia,Suiza,Surinam,Svalbard y Jan Mayen,Tailandia,Taiwán,Tanzania,Tayikistán,TerritorioBritánicodel Océano Indico,Territorios Australes Franceses,Timor Oriental,Togo,Tokelau,Tonga,Trinidad y Tobago,Túnez,Turkmenistán,Turquía,Tuvalu,Ucrania,Uganda,Unión Europea,Uruguay,Uzbekistán,Vanuatu,Venezuela,Vietnam,Wake Island,Wallis y Futuna,West Bank,World,Yemen,Yibuti,Zambia,Zimbabue]|trim',
         	       'errors' => array(
             	           'required' => 'Ingrese un %s',
                           'in_list' => '%s Incorrecto',
            	    ),
        	),
            array(
                    'field' => 'nombre',
                    'label' => 'Nombre',
                    'rules' => 'required|trim',
                    'errors' => array(
                           'required' => 'Ingrese un %s',
                    ),
            ),
            array(
                   'field' => 'apellido',
                   'label' => 'Apellido',
                   'rules' => 'required|trim',
                   'errors' => array(
                           'required' => 'Ingrese un %s',
                    ),
            ),
            array(
                   'field' => 'fecha_nac',
                   'label' => 'Fecha de nacimiento',
                   'rules' => 'required',
                   'errors' => array(
                           'required' => 'Ingrese una %s',
                    ),
            ),
		);
	}
        function getregistroRules2(){
        return array(
            array(
                    'field' => 'email',
                    'label' => 'Correo',
                    'rules' => 'required|valid_email|is_unique[cuenta_frontend.email]|trim',
                    'errors' => array(
                           'required' => 'Ingrese un %s',
                           'valid_email' => 'El %s es invalido',
                            'is_unique' => 'El %s esta en uso'
                    ),
            ),
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
            array(
                   'field' => 'telefono',
                   'label' => 'Telefono',
                   'rules' => 'required|numeric|trim',
                   'errors' => array(
                           'required' => 'Ingrese un %s',
                           'numeric' => 'Solo numeros',
                    ),
            ),
            array(
                   'field' => 'pais',
                   'label' => 'Pais',
                   'rules' => 'required|in_list[Afganistán,Akrotiri,Albania,Alemania,Andorra,Angola,Anguila,Antártida,Antigua y Barbuda,Antillas Neerlandesas,Arabia Saudí,Arctic Ocean,Argelia,Argentina,Armenia,Aruba,Ashmore andCartier Islands,Atlantic Ocean,Australia,Austria,Azerbaiyán,Bahamas,Bahráin,Bangladesh,Barbados,Bélgica,Belice,Benín,Bermudas,Bielorrusia,Birmania Myanmar,Bolivia,Bosnia y Hercegovina,Botsuana,Brasil,Brunéi,Bulgaria,Burkina Faso,Burundi,Bután,Cabo Verde,Camboya,Camerún,Canadá,Chad,Chile,China,Chipre,Clipperton Island,Colombia,Comoras,Congo,Coral Sea Islands,Corea del Norte,Corea del Sur,Costa de Marfil,Costa Rica,Croacia,Cuba,Dhekelia,Dinamarca,Dominica,Ecuador,Egipto,El Salvador,El Vaticano,Emiratos Árabes Unidos,Eritrea,Eslovaquia,Eslovenia,España,Estados Unidos,Estonia,Etiopía,Filipinas,Finlandia,Fiyi,Francia,Gabón,Gambia,Gaza Strip,Georgia,Ghana,Gibraltar,Granada,Grecia,Groenlandia,Guam,Guatemala,Guernsey,Guinea,Guinea Ecuatorial,Guinea-Bissau,Guyana,Haití,Honduras,Hong Kong,Hungría,India,Indian Ocean,Indonesia,Irán,Iraq,Irlanda,Isla Bouvet,Isla Christmas,Isla Norfolk,Islandia,Islas Caimán,Islas Cocos,Islas Cook,Islas Feroe,Islas Georgia del Sur y Sandwich del Sur,Islas Heard y McDonald,Islas Malvinas,Islas Marianas del Norte,IslasMarshall,Islas Pitcairn,Islas Salomón,Islas Turcas y Caicos,Islas Vírgenes Americanas,Islas Vírgenes Británicas,Israel,Italia,Jamaica,Jan Mayen,Japón,Jersey,Jordania,Kazajistán,Kenia,Kirguizistán,Kiribati,Kuwait,Laos,Lesoto,Letonia,Líbano,Liberia,Libia,Liechtenstein,Lituania,Luxemburgo,Macao,Macedonia,Madagascar,Malasia,Malaui,Maldivas,Malí,Malta,Man, Isle of,Marruecos,Mauricio,Mauritania,Mayotte,México,Micronesia,Moldavia,Mónaco,Mongolia,Montserrat,Mozambique,Namibia,Nauru,Navassa Island,Nepal,Nicaragua,Níger,Nigeria,Niue,Noruega,Nueva Caledonia,Nueva Zelanda,Omán,Pacific Ocean,Países Bajos,Pakistán,Palaos,Panamá,Papúa-Nueva Guinea,Paracel Islands,Paraguay,Perú,Polinesia Francesa,Polonia,Portugal,Puerto Rico,Qatar,Reino Unido,República Centroafricana,República Checa,República Democrática del Congo,República Dominicana,Ruanda,Rumania,Rusia,Sáhara Occidental,Samoa,Samoa Americana,San Cristóbal y Nieves,San Marino,San Pedro y Miquelón,San Vicente y las Granadinas,Santa Helena,Santa Lucía,Santo Tomé y Príncipe,Senegal,Seychelles,Sierra Leona,Singapur,Siria,Somalia,Southern Ocean,Spratly Islands,Sri Lanka,Suazilandia,Sudáfrica,Sudán,Suecia,Suiza,Surinam,Svalbard y Jan Mayen,Tailandia,Taiwán,Tanzania,Tayikistán,TerritorioBritánicodel Océano Indico,Territorios Australes Franceses,Timor Oriental,Togo,Tokelau,Tonga,Trinidad y Tobago,Túnez,Turkmenistán,Turquía,Tuvalu,Ucrania,Uganda,Unión Europea,Uruguay,Uzbekistán,Vanuatu,Venezuela,Vietnam,Wake Island,Wallis y Futuna,West Bank,World,Yemen,Yibuti,Zambia,Zimbabue]|trim',
                   'errors' => array(
                           'required' => 'Ingrese un %s',
                           'in_list' => '%s Incorrecto',
                    ),
            ),
            array(
                    'field' => 'nombre_pag',
                    'label' => 'Nombre pagina',
                    'rules' => 'required|trim',
                    'errors' => array(
                           'required' => 'Ingrese un %s',
                    ),
            ),
        );
    }