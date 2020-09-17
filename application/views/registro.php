<!DOCTYPE html>
<html>
<title>Registro</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url('assets/css/W3CSS.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/W3CSSThemes.css')?>">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/estilos.css') ?>">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
</style>
<body class="w3-theme-l5">

<!-- Navigation Bar -->
<div class="w3-bar w3-left-align w3-large w3-theme-d2" >
  <a href="<?php echo base_url()?>" class="w3-bar-item w3-button w3-mobile w3-theme-d4 w3-hide-small w3-padding-large"></i>Blacker</a>
  <a href="<?php echo base_url()?>" class="w3-bar-item w3-button w3-mobile w3-hide-small w3-padding-large w3-hover-white">Login</a>
  <a href="registro.html" class="w3-bar-item w3-button w3-mobile w3-theme-l5 w3-hide-small w3-padding-large w3-hover-white">Registrate</a>
</div>
<!-- Header -->


<!-- Page content -->
<div class="w3-content" style="max-width:1200px;">

 	<div class="w3-container w3-margin-top w3-center" id="registro">
    <h2>REGISTRATE</h2>
  </div>
  

  <div class="w3-row-padding " id="about">
  	<form action="<?php echo base_url('login/registro');?>" onKeypress="if (event.keyCode == 13) event.returnValue = false;" method="POST" id="frm-login">
    <div class="w3-col l4 12 formulario" >
    	<div class="w3-col w3-margin-top" id="seleccion">
      	<label> Seleccione Tipo Usuario</label>
      	<select class="w3-select" name="seleccion">
      		<option value="Usuario">Usuario</option>
      		<option value="Pagina">Pagina</option>
      	</select>
      	<div class="invalido w3-text-red"><span></span></div>
    		</div>
        <div class="w3-col w3-margin-top" id="nombre">
            <label> Nombre</label>
            <input class="w3-input w3-border" type="text" name="nombre" placeholder="Tu nombre">
            <div class="invalido w3-text-red"><span></span></div>
        </div>
        <div class="w3-col w3-margin-top w3-hide" id="nombre_pag" >
            <label> Nombre pagina</label>
            <input class="w3-input w3-border" type="text" name="nombre_pag" placeholder="Nombre pagina">
            <div class="invalido w3-text-red"><span></span></div>
        </div>
    <div class="w3-col w3-margin-top" id="apellido">
      <label> Apellido</label>
      <input class="w3-input w3-border" type="text" name="apellido" placeholder="Tu apellido">
      <div class="invalido w3-text-red"><span></span></div>
    </div>
    <div class="w3-col w3-margin-top" id="fecha_nac">
      <label> Fecha de nacimiento</label>
      <input class="w3-input w3-border" type="date" name="fecha_nac" >
      <div class="invalido w3-text-red"><span></span></div>
    </div>
     <div class="w3-col w3-margin-top" id="pais">
        <label for="formGroupExampleInput2">Pais</label>
       	<select class="w3-select" name="pais">
            <option value="Afganistán ">Afganistán </option>
            <option value="Akrotiri ">Akrotiri </option>
            <option value="Albania ">Albania </option>
            <option value="Alemania ">Alemania </option>
            <option value="Andorra ">Andorra </option>
            <option value="Angola ">Angola </option>
            <option value="Anguila ">Anguila </option>
            <option value="Antártida ">Antártida </option>
            <option value="Antigua y Barbuda ">Antigua y Barbuda </option>
            <option value="Antillas Neerlandesas ">Antillas Neerlandesas </option>
            <option value="Arabia Saudí ">Arabia Saudí </option>
            <option value="Arctic Ocean ">Arctic Ocean </option>
            <option value="Argelia ">Argelia </option>
            <option value="Argentina ">Argentina </option>
            <option value="Armenia ">Armenia </option>
            <option value="Aruba ">Aruba </option>
            <option value="Ashmore andCartier Islands ">Ashmore andCartier Islands </option>
            <option value="Atlantic Ocean ">Atlantic Ocean </option>
            <option value="Australia ">Australia </option>
            <option value="Austria ">Austria </option>
            <option value="Azerbaiyán ">Azerbaiyán </option>
            <option value="Bahamas ">Bahamas </option>
            <option value="Bahráin ">Bahráin </option>
            <option value="Bangladesh ">Bangladesh </option>
            <option value="Barbados ">Barbados </option>
            <option value="Bélgica ">Bélgica </option>
            <option value="Belice ">Belice </option>
            <option value="Benín ">Benín </option>
            <option value="Bermudas ">Bermudas </option>
            <option value="Bielorrusia ">Bielorrusia </option>
            <option value="Birmania Myanmar ">Birmania Myanmar </option>
            <option value="Bolivia ">Bolivia </option>
            <option value="Bosnia y Hercegovina ">Bosnia y Hercegovina </option>
            <option value="Botsuana ">Botsuana </option>
            <option value="Brasil ">Brasil </option>
            <option value="Brunéi ">Brunéi </option>
            <option value="Bulgaria ">Bulgaria </option>
            <option value="Burkina Faso ">Burkina Faso </option>
            <option value="Burundi ">Burundi </option>
            <option value="Bután ">Bután </option>
            <option value="Cabo Verde ">Cabo Verde </option>
            <option value="Camboya ">Camboya </option>
            <option value="Camerún ">Camerún </option>
            <option value="Canadá ">Canadá </option>
            <option value="Chad ">Chad </option>
            <option value="Chile ">Chile </option>
            <option value="China ">China </option>
            <option value="Chipre ">Chipre </option>
            <option value="Clipperton Island ">Clipperton Island </option>
            <option value="Colombia ">Colombia </option>
            <option value="Comoras ">Comoras </option>
            <option value="Congo ">Congo </option>
            <option value="Coral Sea Islands ">Coral Sea Islands </option>
            <option value="Corea del Norte ">Corea del Norte </option>
            <option value="Corea del Sur ">Corea del Sur </option>
            <option value="Costa de Marfil ">Costa de Marfil </option>
            <option value="Costa Rica ">Costa Rica </option>
            <option value="Croacia ">Croacia </option>
            <option value="Cuba ">Cuba </option>
            <option value="Dhekelia ">Dhekelia </option>
            <option value="Dinamarca ">Dinamarca </option>
            <option value="Dominica ">Dominica </option>
            <option value="Ecuador ">Ecuador </option>
            <option value="Egipto ">Egipto </option>
            <option value="El Salvador ">El Salvador </option>
            <option value="El Vaticano ">El Vaticano </option>
            <option value="Emiratos Árabes Unidos ">Emiratos Árabes Unidos </option>
            <option value="Eritrea ">Eritrea </option>
            <option value="Eslovaquia ">Eslovaquia </option>
            <option value="Eslovenia ">Eslovenia </option>
            <option value="España ">España </option>
            <option value="Estados Unidos ">Estados Unidos </option>
            <option value="Estonia ">Estonia </option>
            <option value="Etiopía ">Etiopía </option>
            <option value="Filipinas ">Filipinas </option>
            <option value="Finlandia ">Finlandia </option>
            <option value="Fiyi ">Fiyi </option>
            <option value="Francia ">Francia </option>
            <option value="Gabón ">Gabón </option>
            <option value="Gambia ">Gambia </option>
            <option value="Gaza Strip ">Gaza Strip </option>
            <option value="Georgia ">Georgia </option>
            <option value="Ghana ">Ghana </option>
            <option value="Gibraltar ">Gibraltar </option>
            <option value="Granada ">Granada </option>
            <option value="Grecia ">Grecia </option>
            <option value="Groenlandia ">Groenlandia </option>
            <option value="Guam ">Guam </option>
            <option value="Guatemala ">Guatemala </option>
            <option value="Guernsey ">Guernsey </option>
            <option value="Guinea ">Guinea </option>
            <option value="Guinea Ecuatorial ">Guinea Ecuatorial </option>
            <option value="Guinea-Bissau ">Guinea-Bissau </option>
            <option value="Guyana ">Guyana </option>
            <option value="Haití ">Haití </option>
            <option value="Honduras ">Honduras </option>
            <option value="Hong Kong ">Hong Kong </option>
            <option value="Hungría ">Hungría </option>
            <option value="India ">India </option>
            <option value="Indian Ocean ">Indian Ocean </option>
            <option value="Indonesia ">Indonesia </option>
            <option value="Irán ">Irán </option>
            <option value="Iraq ">Iraq </option>
            <option value="Irlanda ">Irlanda </option>
            <option value="Isla Bouvet ">Isla Bouvet </option>
            <option value="Isla Christmas ">Isla Christmas </option>
            <option value="Isla Norfolk ">Isla Norfolk </option>
            <option value="Islandia ">Islandia </option>
            <option value="Islas Caimán ">Islas Caimán </option>
            <option value="Islas Cocos ">Islas Cocos </option>
            <option value="Islas Cook ">Islas Cook </option>
            <option value="Islas Feroe ">Islas Feroe </option>
            <option value="Islas Georgia del Sur y Sandwich del Sur ">Islas Georgia del Sur y Sandwich del Sur </option>
            <option value="Islas Heard y McDonald ">Islas Heard y McDonald </option>
            <option value="Islas Malvinas ">Islas Malvinas </option>
            <option value="Islas Marianas del Norte ">Islas Marianas del Norte </option>
            <option value="IslasMarshall ">IslasMarshall </option>
            <option value="Islas Pitcairn ">Islas Pitcairn </option>
            <option value="Islas Salomón ">Islas Salomón </option>
            <option value="Islas Turcas y Caicos ">Islas Turcas y Caicos </option>
            <option value="Islas Vírgenes Americanas ">Islas Vírgenes Americanas </option>
            <option value="Islas Vírgenes Británicas ">Islas Vírgenes Británicas </option>
            <option value="Israel ">Israel </option>
            <option value="Italia ">Italia </option>
            <option value="Jamaica ">Jamaica </option>
            <option value="Jan Mayen ">Jan Mayen </option>
            <option value="Japón ">Japón </option>
            <option value="Jersey ">Jersey </option>
            <option value="Jordania ">Jordania </option>
            <option value="Kazajistán ">Kazajistán </option>
            <option value="Kenia ">Kenia </option>
            <option value="Kirguizistán ">Kirguizistán </option>
            <option value="Kiribati ">Kiribati </option>
            <option value="Kuwait ">Kuwait </option>
            <option value="Laos ">Laos </option>
            <option value="Lesoto ">Lesoto </option>
            <option value="Letonia ">Letonia </option>
            <option value="Líbano ">Líbano </option>
            <option value="Liberia ">Liberia </option>
            <option value="Libia ">Libia </option>
            <option value="Liechtenstein ">Liechtenstein </option>
            <option value="Lituania ">Lituania </option>
            <option value="Luxemburgo ">Luxemburgo </option>
            <option value="Macao ">Macao </option>
            <option value="Macedonia ">Macedonia </option>
            <option value="Madagascar ">Madagascar </option>
            <option value="Malasia ">Malasia </option>
            <option value="Malaui ">Malaui </option>
            <option value="Maldivas ">Maldivas </option>
            <option value="Malí ">Malí </option>
            <option value="Malta ">Malta </option>
            <option value="Man, Isle of ">Man, Isle of </option>
            <option value="Marruecos ">Marruecos </option>
            <option value="Mauricio ">Mauricio </option>
            <option value="Mauritania ">Mauritania </option>
            <option value="Mayotte ">Mayotte </option>
            <option value="México ">México </option>
            <option value="Micronesia ">Micronesia </option>
            <option value="Moldavia ">Moldavia </option>
            <option value="Mónaco ">Mónaco </option>
            <option value="Mongolia ">Mongolia </option>
            <option value="Montserrat ">Montserrat </option>
            <option value="Mozambique ">Mozambique </option>
            <option value="Namibia ">Namibia </option>
            <option value="Nauru ">Nauru </option>
            <option value="Navassa Island ">Navassa Island </option>
            <option value="Nepal ">Nepal </option>
            <option value="Nicaragua ">Nicaragua </option>
            <option value="Níger ">Níger </option>
            <option value="Nigeria ">Nigeria </option>
            <option value="Niue ">Niue </option>
            <option value="Noruega ">Noruega </option>
            <option value="Nueva Caledonia ">Nueva Caledonia </option>
            <option value="Nueva Zelanda ">Nueva Zelanda </option>
            <option value="Omán ">Omán </option>
            <option value="Pacific Ocean ">Pacific Ocean </option>
            <option value="Países Bajos ">Países Bajos </option>
            <option value="Pakistán ">Pakistán </option>
            <option value="Palaos ">Palaos </option>
            <option value="Panamá ">Panamá </option>
            <option value="Papúa-Nueva Guinea ">Papúa-Nueva Guinea </option>
            <option value="Paracel Islands ">Paracel Islands </option>
            <option value="Paraguay ">Paraguay </option>
            <option value="Perú ">Perú </option>
            <option value="Polinesia Francesa ">Polinesia Francesa </option>
            <option value="Polonia ">Polonia </option>
            <option value="Portugal ">Portugal </option>
            <option value="Puerto Rico ">Puerto Rico </option>
            <option value="Qatar ">Qatar </option>
            <option value="Reino Unido ">Reino Unido </option>
            <option value="República Centroafricana ">República Centroafricana </option>
            <option value="República Checa ">República Checa </option>
            <option value="República Democrática del Congo ">República Democrática del Congo </option>
            <option value="República Dominicana ">República Dominicana </option>
            <option value="Ruanda ">Ruanda </option>
            <option value="Rumania ">Rumania </option>
            <option value="Rusia ">Rusia </option>
            <option value="Sáhara Occidental ">Sáhara Occidental </option>
            <option value="Samoa ">Samoa </option>
            <option value="Samoa Americana ">Samoa Americana </option>
            <option value="San Cristóbal y Nieves ">San Cristóbal y Nieves </option>
            <option value="San Marino ">San Marino </option>
            <option value="San Pedro y Miquelón ">San Pedro y Miquelón </option>
            <option value="San Vicente y las Granadinas ">San Vicente y las Granadinas </option>
            <option value="Santa Helena ">Santa Helena </option>
            <option value="Santa Lucía ">Santa Lucía </option>
            <option value="Santo Tomé y Príncipe ">Santo Tomé y Príncipe </option>
            <option value="Senegal ">Senegal </option>
            <option value="Seychelles ">Seychelles </option>
            <option value="Sierra Leona ">Sierra Leona </option>
            <option value="Singapur ">Singapur </option>
            <option value="Siria ">Siria </option>
            <option value="Somalia ">Somalia </option>
            <option value="Southern Ocean ">Southern Ocean </option>
            <option value="Spratly Islands ">Spratly Islands </option>
            <option value="Sri Lanka ">Sri Lanka </option>
            <option value="Suazilandia ">Suazilandia </option>
            <option value="Sudáfrica ">Sudáfrica </option>
            <option value="Sudán ">Sudán </option>
            <option value="Suecia ">Suecia </option>
            <option value="Suiza ">Suiza </option>
            <option value="Surinam ">Surinam </option>
            <option value="Svalbard y Jan Mayen ">Svalbard y Jan Mayen </option>
            <option value="Tailandia ">Tailandia </option>
            <option value="Taiwán ">Taiwán </option>
            <option value="Tanzania ">Tanzania </option>
            <option value="Tayikistán ">Tayikistán </option>
            <option value="TerritorioBritánicodel Océano Indico ">TerritorioBritánicodel Océano Indico </option>
            <option value="Territorios Australes Franceses ">Territorios Australes Franceses </option>
            <option value="Timor Oriental ">Timor Oriental </option>
            <option value="Togo ">Togo </option>
            <option value="Tokelau ">Tokelau </option>
            <option value="Tonga ">Tonga </option>
            <option value="Trinidad y Tobago ">Trinidad y Tobago </option>
            <option value="Túnez ">Túnez </option>
            <option value="Turkmenistán ">Turkmenistán </option>
            <option value="Turquía ">Turquía </option>
            <option value="Tuvalu ">Tuvalu </option>
            <option value="Ucrania ">Ucrania </option>
            <option value="Uganda ">Uganda </option>
            <option value="Unión Europea ">Unión Europea </option>
            <option value="Uruguay ">Uruguay </option>
            <option value="Uzbekistán ">Uzbekistán </option>
            <option value="Vanuatu ">Vanuatu </option>
            <option value="Venezuela ">Venezuela </option>
            <option value="Vietnam ">Vietnam </option>
            <option value="Wake Island ">Wake Island </option>
            <option value="Wallis y Futuna ">Wallis y Futuna </option>
            <option value="West Bank ">West Bank </option>
            <option value="World ">World </option>
            <option value="Yemen ">Yemen </option>
            <option value="Yibuti ">Yibuti </option>
            <option value="Zambia ">Zambia </option>
            <option value="Zimbabue ">Zimbabue </option>
                                </select>
                                <div class="invalido w3-text-red"><span></span></div>
                            
    </div>
    <div class="w3-col w3-margin-top" id="telefono">
            <label> Telefono</label>
            <input class="w3-input w3-border" type="text" name="telefono" placeholder="telefono">
            <div class="invalido w3-text-red"><span></span></div>
        </div>
     <div class="w3-col w3-margin-top" id="email">
      <label> Correo</label>
      <input class="w3-input w3-border" type="email" name="email" placeholder="ejemplo@ejemplo.com">
      <div class="invalido w3-text-red"><span></span></div>
    </div>
    <div class="w3-col w3-margin-top" id="password">
      <label> Contraseña</label>
      <input class="w3-input w3-border" type="password" name="password" placeholder="Contraseña">
      <div class="invalido w3-text-red"><span></span></div>
    </div>
    <div class="w3-col w3-margin-top" id="rep_password">
      <label> Confirme contraseña</label>
      <input class="w3-input w3-border" type="password" name="rep_password" placeholder="Confirme contraseña">
      <div class="invalido w3-text-red"><span></span></div>
    </div>

    <div class="w3-col w3-margin-top" id="foto_perfil">
    	<label class="" for="customFileLang">Foto de perfil: </label>
        <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="foto_perfil">
        <div class="invalido w3-text-red"><span></span></div>
    </div>
    <div class="w3-col w3-margin-top">
      <button class="w3-button w3-block w3-theme-d2" id="registrar" type="submit">Registrarse</button>
    </div>
    </div>
    </form>
    <div class="w3-col l8 12 w3-border-left texto">

     <h3>About</h3>
      <h6 style="text-align: justify;text-justify: inter-word;">Our hotel is one of a kind. It is truely amazing. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</h6>

    </div>

  </div>

<!-- End page content -->
</div>

<!-- Footer -->
<div class=" w3-theme-d5 w3-center w3-container w3-teal w3-margin-top" >
  <h5>Blackers</h5>
  <p>Derechos recervados bla bla bla</p>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</div>
    <script src="<?=base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?=base_url('assets/js/registro.js') ?>"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>


</html>
