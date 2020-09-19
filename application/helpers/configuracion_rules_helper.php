<?php
	function getregistroRulesConfig1(){
		return array(
        	array(
            	    'field' => 'nombreUsuario',
            	    'label' => 'Nombre',
            	    'rules' => 'required|trim|min_length[2]|max_length[20]|alpha_numeric_spaces',
            	    'errors' => array(
             	            'required' => 'Ingrese un %s',
             	            'min_length' => 'El %s tiene que tener minimo 2 caracteres',
                          'max_length' => 'El %s solo puede tener un maximo de 20 caracteres',
                          'alpha_numeric_spaces' => 'El %s solo puede tener letras, numeros y espacios'
            	    ),
        	),
          array(
                 'field' => 'password',
                 'label' => 'Contraseña',
                 'rules' => 'min_length[6]|max_length[20]|alpha_numeric',
                 'errors' => array(
                           'min_length' => 'Minimo 6 caracteres',
                           'max_length' => 'Maximo 20 caracteres',
                           'alpha_numeric' => 'Solo letras y numeros',
                  ),
          ),
          array(
                 'field' => 'rep_password',
                 'label' => 'Contraseñas',
                 'rules' => 'matches[password]',
                 'errors' => array(
                          'matches' => 'Las %s no coinciden',
                  ),
          ),
       		array(
         	       'field' => 'apellidoUsuario',
         	       'label' => 'Apellido',
         	       'rules' => 'required|trim|min_length[2]|max_length[20]|alpha_numeric_spaces',
         	       'errors' => array(
                          'required' => 'Ingrese un %s',
                          'min_length' => 'El %s tiene que tener minimo 2 caracteres',
                          'max_length' => 'El %s solo puede tener un maximo de 20 caracteres',
                          'alpha_numeric_spaces' => 'El %s solo puede tener letras, numeros y espacios'
            	    ),
        	),
          array(
                 'field' => 'estadoSentimentalUsuario',
                 'label' => 'Estado sentimental',
                 'rules' => 'trim|min_length[5]|max_length[20]|alpha_numeric_spaces',
                 'errors' => array(
                          'min_length' => 'El %s tiene que tener minimo 5 caracteres',
                          'max_length' => 'El %s solo puede tener un maximo de 20 caracteres',
                          'alpha_numeric_spaces' => 'El %s solo puede tener letras, numeros y espacios'
                  ),
          ),
          array(
                 'field' => 'ocupacionUsuario',
                 'label' => 'Ocupacion',
                 'rules' => 'trim|max_length[20]|alpha_numeric_spaces',
                 'errors' => array(
                          'max_length' => 'La %s solo puede tener un maximo de 20 caracteres',
                          'alpha_numeric_spaces' => 'La %s solo puede tener letras, numeros y espacios'
                  ),
          ),
          array(
                 'field' => 'generoUsuario',
                 'label' => 'Genero',
                 'rules' => 'in_list[Hombre,Mujer,Otro]',
                 'errors' => array(
                          'in_list' => '%s Incorrecto',
                  ),
          ),
            array(
         	       'field' => 'paisUsuario',
         	       'label' => 'Pais',
         	       'rules' => 'required|in_list[Afganistán,Akrotiri,Albania,Alemania,Andorra,Angola,Anguila,Antártida,Antigua y Barbuda,Antillas Neerlandesas,Arabia Saudí,Arctic Ocean,Argelia,Argentina,Armenia,Aruba,Ashmore andCartier Islands,Atlantic Ocean,Australia,Austria,Azerbaiyán,Bahamas,Bahráin,Bangladesh,Barbados,Bélgica,Belice,Benín,Bermudas,Bielorrusia,Birmania Myanmar,Bolivia,Bosnia y Hercegovina,Botsuana,Brasil,Brunéi,Bulgaria,Burkina Faso,Burundi,Bután,Cabo Verde,Camboya,Camerún,Canadá,Chad,Chile,China,Chipre,Clipperton Island,Colombia,Comoras,Congo,Coral Sea Islands,Corea del Norte,Corea del Sur,Costa de Marfil,Costa Rica,Croacia,Cuba,Dhekelia,Dinamarca,Dominica,Ecuador,Egipto,El Salvador,El Vaticano,Emiratos Árabes Unidos,Eritrea,Eslovaquia,Eslovenia,España,Estados Unidos,Estonia,Etiopía,Filipinas,Finlandia,Fiyi,Francia,Gabón,Gambia,Gaza Strip,Georgia,Ghana,Gibraltar,Granada,Grecia,Groenlandia,Guam,Guatemala,Guernsey,Guinea,Guinea Ecuatorial,Guinea-Bissau,Guyana,Haití,Honduras,Hong Kong,Hungría,India,Indian Ocean,Indonesia,Irán,Iraq,Irlanda,Isla Bouvet,Isla Christmas,Isla Norfolk,Islandia,Islas Caimán,Islas Cocos,Islas Cook,Islas Feroe,Islas Georgia del Sur y Sandwich del Sur,Islas Heard y McDonald,Islas Malvinas,Islas Marianas del Norte,IslasMarshall,Islas Pitcairn,Islas Salomón,Islas Turcas y Caicos,Islas Vírgenes Americanas,Islas Vírgenes Británicas,Israel,Italia,Jamaica,Jan Mayen,Japón,Jersey,Jordania,Kazajistán,Kenia,Kirguizistán,Kiribati,Kuwait,Laos,Lesoto,Letonia,Líbano,Liberia,Libia,Liechtenstein,Lituania,Luxemburgo,Macao,Macedonia,Madagascar,Malasia,Malaui,Maldivas,Malí,Malta,Man, Isle of,Marruecos,Mauricio,Mauritania,Mayotte,México,Micronesia,Moldavia,Mónaco,Mongolia,Montserrat,Mozambique,Namibia,Nauru,Navassa Island,Nepal,Nicaragua,Níger,Nigeria,Niue,Noruega,Nueva Caledonia,Nueva Zelanda,Omán,Pacific Ocean,Países Bajos,Pakistán,Palaos,Panamá,Papúa-Nueva Guinea,Paracel Islands,Paraguay,Perú,Polinesia Francesa,Polonia,Portugal,Puerto Rico,Qatar,Reino Unido,República Centroafricana,República Checa,República Democrática del Congo,República Dominicana,Ruanda,Rumania,Rusia,Sáhara Occidental,Samoa,Samoa Americana,San Cristóbal y Nieves,San Marino,San Pedro y Miquelón,San Vicente y las Granadinas,Santa Helena,Santa Lucía,Santo Tomé y Príncipe,Senegal,Seychelles,Sierra Leona,Singapur,Siria,Somalia,Southern Ocean,Spratly Islands,Sri Lanka,Suazilandia,Sudáfrica,Sudán,Suecia,Suiza,Surinam,Svalbard y Jan Mayen,Tailandia,Taiwán,Tanzania,Tayikistán,TerritorioBritánicodel Océano Indico,Territorios Australes Franceses,Timor Oriental,Togo,Tokelau,Tonga,Trinidad y Tobago,Túnez,Turkmenistán,Turquía,Tuvalu,Ucrania,Uganda,Unión Europea,Uruguay,Uzbekistán,Vanuatu,Venezuela,Vietnam,Wake Island,Wallis y Futuna,West Bank,World,Yemen,Yibuti,Zambia,Zimbabue]|trim',
         	       'errors' => array(
             	           'required' => 'Ingrese un %s',
                           'in_list' => '%s Incorrecto',
            	    ),
        	),
            array(
                    'field' => 'telefonoUsuario',
                    'label' => 'telefonoUsuario',
                    'rules' => 'required|trim|numeric',
                    'errors' => array(
                           'required' => 'Ingrese un %s',
                           'numeric' => 'Ingrese solo valores numericos',
                    ),
            ),
            array(
                   'field' => 'fechaNacUsuario',
                   'label' => 'Fecha de nacimiento',
                   'rules' => 'required',
                   'errors' => array(
                           'required' => 'Ingrese una %s',
                    ),
            ),
		);
	}
        function getregistroRulesConfig2(){
        return array(
            array(
                    'field' => 'nombreEntidad',
                    'label' => 'Nombre pagina',
                    'rules' => 'required|trim|min_length[2]|max_length[20]|alpha_numeric_spaces',
                    'errors' => array(
                          'required' => 'Ingrese un %s',
                          'min_length' => 'El %s tiene que tener minimo 2 caracteres',
                          'max_length' => 'El %s solo puede tener un maximo de 20 caracteres',
                          'alpha_numeric_spaces' => 'El %s solo puede tener letras, numeros y espacios'
                  ),
            ),
            array(
                 'field' => 'password',
                 'label' => 'Contraseña',
                 'rules' => 'min_length[6]|max_length[20]|alpha_numeric',
                 'errors' => array(
                           'min_length' => 'Minimo 6 caracteres',
                           'max_length' => 'Maximo 20 caracteres',
                           'alpha_numeric' => 'Solo letras y numeros',
                  ),
          ),
          array(
                 'field' => 'rep_password',
                 'label' => 'Contraseñas',
                 'rules' => 'matches[password]',
                 'errors' => array(
                          'matches' => 'Las %s no coinciden',
                  ),
          ),
            array(
                   'field' => 'numeroPagina',
                   'label' => 'Numero',
                   'rules' => 'trim|numeric',
                   'errors' => array(
                           'numeric' => 'Ingrese solo valores numericos',
                    ),
            ),
            array(
                 'field' => 'esquinaPagina',
                 'label' => 'Numero',
                 'rules' => 'trim|min_length[2]|max_length[30]|alpha_numeric_spaces',
                 'errors' => array(
                          'min_length' => 'La %s tiene que tener minimo 2 caracteres',
                          'max_length' => 'La %s solo puede tener un maximo de 30 caracteres',
                          'alpha_numeric_spaces' => 'La %s solo puede tener letras, numeros y espacios'
                  ),
          ),
            array(
                   'field' => 'telefonoPagina',
                   'label' => 'Telefono',
                   'rules' => 'trim|numeric',
                   'errors' => array(
                           'numeric' => 'Solo numeros',
                    ),
            ),
            array(
                   'field' => 'paisPagina',
                   'label' => 'Pais',
                   'rules' => 'trim|required|in_list[Afganistán,Akrotiri,Albania,Alemania,Andorra,Angola,Anguila,Antártida,Antigua y Barbuda,Antillas Neerlandesas,Arabia Saudí,Arctic Ocean,Argelia,Argentina,Armenia,Aruba,Ashmore andCartier Islands,Atlantic Ocean,Australia,Austria,Azerbaiyán,Bahamas,Bahráin,Bangladesh,Barbados,Bélgica,Belice,Benín,Bermudas,Bielorrusia,Birmania Myanmar,Bolivia,Bosnia y Hercegovina,Botsuana,Brasil,Brunéi,Bulgaria,Burkina Faso,Burundi,Bután,Cabo Verde,Camboya,Camerún,Canadá,Chad,Chile,China,Chipre,Clipperton Island,Colombia,Comoras,Congo,Coral Sea Islands,Corea del Norte,Corea del Sur,Costa de Marfil,Costa Rica,Croacia,Cuba,Dhekelia,Dinamarca,Dominica,Ecuador,Egipto,El Salvador,El Vaticano,Emiratos Árabes Unidos,Eritrea,Eslovaquia,Eslovenia,España,Estados Unidos,Estonia,Etiopía,Filipinas,Finlandia,Fiyi,Francia,Gabón,Gambia,Gaza Strip,Georgia,Ghana,Gibraltar,Granada,Grecia,Groenlandia,Guam,Guatemala,Guernsey,Guinea,Guinea Ecuatorial,Guinea-Bissau,Guyana,Haití,Honduras,Hong Kong,Hungría,India,Indian Ocean,Indonesia,Irán,Iraq,Irlanda,Isla Bouvet,Isla Christmas,Isla Norfolk,Islandia,Islas Caimán,Islas Cocos,Islas Cook,Islas Feroe,Islas Georgia del Sur y Sandwich del Sur,Islas Heard y McDonald,Islas Malvinas,Islas Marianas del Norte,IslasMarshall,Islas Pitcairn,Islas Salomón,Islas Turcas y Caicos,Islas Vírgenes Americanas,Islas Vírgenes Británicas,Israel,Italia,Jamaica,Jan Mayen,Japón,Jersey,Jordania,Kazajistán,Kenia,Kirguizistán,Kiribati,Kuwait,Laos,Lesoto,Letonia,Líbano,Liberia,Libia,Liechtenstein,Lituania,Luxemburgo,Macao,Macedonia,Madagascar,Malasia,Malaui,Maldivas,Malí,Malta,Man, Isle of,Marruecos,Mauricio,Mauritania,Mayotte,México,Micronesia,Moldavia,Mónaco,Mongolia,Montserrat,Mozambique,Namibia,Nauru,Navassa Island,Nepal,Nicaragua,Níger,Nigeria,Niue,Noruega,Nueva Caledonia,Nueva Zelanda,Omán,Pacific Ocean,Países Bajos,Pakistán,Palaos,Panamá,Papúa-Nueva Guinea,Paracel Islands,Paraguay,Perú,Polinesia Francesa,Polonia,Portugal,Puerto Rico,Qatar,Reino Unido,República Centroafricana,República Checa,República Democrática del Congo,República Dominicana,Ruanda,Rumania,Rusia,Sáhara Occidental,Samoa,Samoa Americana,San Cristóbal y Nieves,San Marino,San Pedro y Miquelón,San Vicente y las Granadinas,Santa Helena,Santa Lucía,Santo Tomé y Príncipe,Senegal,Seychelles,Sierra Leona,Singapur,Siria,Somalia,Southern Ocean,Spratly Islands,Sri Lanka,Suazilandia,Sudáfrica,Sudán,Suecia,Suiza,Surinam,Svalbard y Jan Mayen,Tailandia,Taiwán,Tanzania,Tayikistán,TerritorioBritánicodel Océano Indico,Territorios Australes Franceses,Timor Oriental,Togo,Tokelau,Tonga,Trinidad y Tobago,Túnez,Turkmenistán,Turquía,Tuvalu,Ucrania,Uganda,Unión Europea,Uruguay,Uzbekistán,Vanuatu,Venezuela,Vietnam,Wake Island,Wallis y Futuna,West Bank,World,Yemen,Yibuti,Zambia,Zimbabue]',
                   'errors' => array(
                           'required' => 'Ingrese un %s',
                           'in_list' => '%s Incorrecto',
                    ),
            ),
            array(
                    'field' => 'descripcionPagina',
                    'label' => 'Nombre',
                    'rules' => 'trim',
                    'errors' => array(       
                    ),
            ),
        );
    }