<!DOCTYPE html>
<html>
<title>Blacker</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url('assets/css/W3CSS.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/W3CSSThemes.css'); ?>">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/emojionearea.min.css'); ?>">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="<?php echo base_url()?>" class="w3-bar-item w3-button w3-padding-large w3-theme-d4">Blacker</a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
  <a href="<?php echo base_url('notificaciones'); ?>" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Notificaciones"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"><?php echo $notificaciones->CantNotificaciones; ?></span></a>  
  <form action="<?php echo base_url('inicio/buscar')?>" method="POST">
  <input class="w3-input w3-bar-item w3-padding-large w3-border" type="text" id="buscador" name="publicarBusqueda" placeholder="<?php echo $buscar ?>">
  </form>
  <div class="w3-dropdown-hover w3-hide-small w3-hover-white w3-right">
    <button class="w3-button w3-padding-large" title="Notifications">
      <img src="<?php echo base_url('assets/'.$foto_perfil); ?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
    </button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px; right:0">
      <a href="<?php echo base_url('login/logout'); ?>" class="w3-bar-item w3-button">Salir</a>
      <a href="<?php echo base_url('#'); ?>" class="w3-bar-item w3-button">Configuracion</a>
      <a href="#" class="w3-bar-item w3-button">no se que</a>
    </div>
  </div>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Mi Perfil</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?php if(empty($perfil->nombre)){
                                    echo $perfil->nombre_entidad;       
                                    }else{
                                echo "<a href='".base_url('inicio/perfil')."/".urlencode(strtr($this->encrypt->encode($this->session->userdata("id")),array('+' => '.', '=' => '-', '/' => '~')))."'>".$perfil->nombre.' '.$perfil->apellido."</a>";
                            }?></h4>
         <p class="w3-center"><img src="<?php echo base_url('assets/'.$foto_perfil); ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>Pais: <?php if(!empty($cuenta->pais)){ echo $cuenta->pais;} ?></p>
          <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme">Fecha Nacimiento: </i> <?php if(!empty($perfil->fecha_nacimiento)){ echo $perfil->fecha_nacimiento;} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Telefono: <?php if(!empty($cuenta->telefono)){ echo $cuenta->telefono;}else{ echo "Sin telefono";} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Genero: <?php if(!empty($perfil->genero)){ echo $perfil->genero;}else{ echo "Sin especificar genero";} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Estado Sentimental: <?php if(!empty($perfil->estado_sentimental)){ echo $perfil->estado_sentimental;}else{ echo "Sin estado sentimental";} ?></p>
          <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Ocupacion: <?php if(!empty($perfil->ocupacion)){ echo $perfil->ocupacion;}else{ echo "Sin ninguna ocupacion";} ?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('GruposDrop')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Mis Grupos</button>
          <div id="GruposDrop" class="w3-hide w3-container" style="padding: 0">
            <?php foreach ($grupos as $value) {
                echo "<a id='btn-grupo' class='w3-button w3-block w3-theme' href='".base_url('/Grupos/verGrupo/'.urlencode(strtr($this->encrypt->encode($value->id_grupo),array('+' => '.', '=' => '-', '/' => '~'))))."'>".$value->nombre."</a>";
              } ?>
            <a id="btn-grupo" class="w3-button w3-block w3-theme" href="<?php echo base_url('Grupos/crearGrupo')?>">Crear Grupo</a>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p>Some other text..</p>
          </div>
          <?php if($seleccion == 'usuario'): ?>
            <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('Amigos')?>"><i class="fa fa-address-book fa-fw w3-margin-right"></i> Mis Amigos</a>
          <?php endif; ?>
          <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('albums/vistaAlbums/'.$id_cuenta)?>"><i class="fa fa-users fa-fw w3-margin-right"></i> Mis Albums</a>
        </div>      
      </div>
      <br>
      
      
      <!-- Alert Box -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Hey!</strong></p>
        <p>People are looking at your profile. Find out who.</p>
      </div>
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
     <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Configuracion</h6>
              <form id="frm-configuracion" class="w3-container" action="<?php echo base_url('Inicio/cargarConfiguracion')?>" method="POST">
                <?php if ($this->session->userdata("seleccion") == "usuario"): ?>
                <div class="w3-bottombar" style="margin-left: 1rem">
                <h6 style="margin-top: 0.5rem;margin-right: 1rem">Configuracion de notificaciones</h6>
                  <p><input type="checkbox" id="checkPublicacion" class="w3-check" value="si" style="margin-top: 0.5rem;margin-right: 1rem" name="mostrarPublicaciones" <?php if ($configuracion->not_publicacion == 'si'){ echo "checked='true'";} ?>><label>Mostrar Publicaciones</label></p>
                  <p><input type="checkbox" id="checkComentario" class="w3-check" value="si" style="margin-top: 0.5rem;margin-right: 1rem" name="mostrarComentarios" <?php if ($configuracion->not_comentario == 'si'){ echo "checked='true'";} ?>><label>Mostrar Comentarios</label></p>
                  <p><input type="checkbox" id="checkMeGusta" class="w3-check" value="si" style="margin-top: 0.5rem;margin-right: 1rem;margin-bottom: 1rem" name="mostrarMeGustas" <?php if ($configuracion->not_megusta == 'si'){ echo "checked='true'";} ?>><label>Mostrar Me Gusta</label></p>
                  <p><input type="checkbox" id="checkComparte" class="w3-check" value="si" style="margin-top: 0.5rem;margin-right: 1rem;margin-bottom: 1rem" name="mostrarComparte" <?php if ($configuracion->not_comparte == 'si'){ echo "checked='true'";} ?>><label>Mostrar Comparten</label></p>
                  <p><input type="checkbox" id="checkPerfil" class="w3-check" value="si" style="margin-top: 0.5rem;margin-right: 1rem;margin-bottom: 1rem" name="mostrarPerfil" <?php if ($configuracion->not_perfil == 'si'){ echo "checked='true'";} ?>><label>Mostrar cambios Perfil</label></p>
                </div>
                <div style="margin-left: 1rem">
                  <h6 style="margin-top: 0.5rem;margin-right: 1rem">Configuracion de Usuario</h6>
                  <div id="nombreUsuario"><p><label>Nombre</label><input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="nombreUsuario" value="<?php echo $configuracion->nombre ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="apellidoUsuario"><p><label>Apellido</label><input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="apellidoUsuario" value="<?php echo $configuracion->apellido ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="fechaNacUsuario"><p><label>Fecha de nacimiento</label><input type="date" class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="fechaNacUsuario" value="<?php echo $configuracion->fecha_nacimiento ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="estadoSentimentalUsuario"><p><label>Estado sentimental</label><input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="estadoSentimentalUsuario" value="<?php echo $configuracion->estado_sentimental ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="ocupacionUsuario"><p><label>Ocupacion</label><input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="ocupacionUsuario" value="<?php echo $configuracion->ocupacion ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="generoUsuario"><p><label>Genero</label><select class="w3-select" style="margin-top: 0.5rem;margin-right: 1rem" name="generoUsuario">
                    <option value="" id="selected" <?php if($configuracion->genero == null OR $configuracion->genero == ''){ echo 'selected';} ?>>Seleccione...</option> 
                    <option value="Hombre" id="Hombre" <?php if($configuracion->genero == 'Hombre'){echo 'selected';}?>>Hombre</option> 
                    <option value="Mujero" id="Mujero" <?php if($configuracion->genero == 'Mujer'){echo 'selected';}?>>Mujer</option> 
                    <option value="Otro" id="Otro" <?php if($configuracion->genero == 'Otro'){echo 'selected';}?>>Otro</option>
                  </select></p><div class="invalido w3-text-red"><span></span></div></div> 
                  <div id="paisUsuario"><p><label>Pais</label>
                    <select class="w3-select" style="margin-top: 0.5rem;margin-right: 1rem" name="paisUsuario">
                      <option value="" id="selected" selected>Seleccione...</option>  
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
                  </select></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="telefonoUsuario">
                    <p>
                      <label>Telefono</label>
                      <input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="telefonoUsuario" value="<?php echo $configuracion->telefono ?>">
                    </p>
                    <div class="invalido w3-text-red"><span></span></div>
                  </div>
                  <div id="fotoUsuario">
                    <p>
                      <label>Canbiar foto perfil</label><br>
                      <input type="file" class="custom-file-input" id="customFileLang" lang="es" style="margin-top: 0.5rem;margin-right: 1rem" name="fotoUsuario" >
                    </p>
                    <div class="invalido w3-text-red"><span></span></div>
                  </div>
                  <div id="password">
                    <p>
                      <label>Contraseña</label>
                      <input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="password" type="password" value="">
                    </p>
                    <div class="invalido w3-text-red"><span></span></div>
                  </div>
                  <div id="rep_password">
                    <p>
                      <label>Contraseña</label>
                      <input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="rep_password" type="password" value="">
                    </p>
                    <div class="invalido w3-text-red"><span></span></div>
                  </div>
                </div>
                <?php elseif ($this->session->userdata("seleccion") == "pagina"): ?>
                <div style="margin-left: 1rem">
                  <h6 style="margin-top: 0.5rem;margin-right: 1rem">Configuracion de Usuario</h6>
                  <div id="nombreEntidad"><p><label>Nombre de la pagina</label><input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="nombreEntidad" value="<?php echo $configuracion->nombre_entidad ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="paisPagina"><p><label>Pais</label>
                    <select class="w3-select" style="margin-top: 0.5rem;margin-right: 1rem" name="paisPagina">
                      <option value="" id="selected" selected>Seleccione...</option>  
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
                  </select></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="callePagina"><p><label>Calle</label><input  class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="callePagina" value="<?php echo $configuracion->calle ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="numeroPagina"><p><label>Numero</label><input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="numeroPagina" value="<?php echo $configuracion->numero ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="esquinaPagina"><p><label>Esquina</label><input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="esquinaPagina" value="<?php echo $configuracion->esquina ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="telefonoPagina"><p><label>Telefono</label><input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="telefonoPagina" value="<?php echo $configuracion->telefono ?>"></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="descripcionPagina"><p><label>Descripcion</label><textarea style="margin-top: 0.5rem;margin-right: 1rem; width: 100%" rows="3"  name="descripcionPagina" value="<?php echo $configuracion->descripcion ?>"><?php echo $configuracion->descripcion ?></textarea></p><div class="invalido w3-text-red"><span></span></div></div>
                  <div id="password">
                    <p>
                      <label>Contraseña</label>
                      <input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="password" type="password" value="">
                    </p>
                    <div class="invalido w3-text-red"><span></span></div>
                  </div>
                  <div id="rep_password">
                    <p>
                      <label>Contraseña</label>
                      <input class="w3-input" style="margin-top: 0.5rem;margin-right: 1rem" name="rep_password" type="password" value="">
                    </p>
                    <div class="invalido w3-text-red"><span></span></div>
                  </div>
                </div>
                <?php endif; ?>
                <button type="submit" id="btn-configurar" class="w3-button w3-theme" style="margin-top: 0.5rem"><i class="fa fa-pencil"></i> Configurar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Upcoming Events:</p>
          <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
          <p><strong>Holiday</strong></p>
          <p>Friday 15:00</p>
          <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
        </div>
      </div>
      <br>
      
      <?php if($seleccion == 'usuario'): ?>
      <div class="w3-card w3-round w3-white w3-center" style="padding-bottom: 8px">
        <div class="w3-container">
          <p>Solicitudes de amistad</p>
          <?php foreach ($amigoPendiente as $value2):?>
            <div class="mySlides">
              <img src="<?php echo base_url('assets/'.$value2->foto_perfil); ?>" alt="Avatar" style="width:50%"><br>
              <a href="<?php base_url('inicio/perfil').'/'.urlencode(strtr($this->encrypt->encode($value->id_cuenta),array('+' => '.', '=' => '-', '/' => '~')))?>"><span><?php echo $value2->nombre." ".$value2->apellido; ?></span></a>
              <div class="w3-row w3-opacity">
                <div class="w3-half">
                  <button class="w3-button w3-block w3-green w3-section" id="btn-aceptar" value="<?php echo urlencode(strtr($this->encrypt->encode($value2->id_cuenta),array('+' => '.', '=' => '-', '/' => '~'))) ?>" title="Aceptar" onclick="plusDivs(1)"><i class="fa fa-check"></i></button>
                </div>
                <div class="w3-half">
                  <button class="w3-button w3-block w3-red w3-section" id="btn-rechazar" value="<?php echo urlencode(strtr($this->encrypt->encode($value2->id_cuenta),array('+' => '.', '=' => '-', '/' => '~'))) ?>" title="Rechazar" onclick="plusDivs(1)"><i class="fa fa-remove"></i></button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <div class="mySlides">
            <span>Ninguna peticion pendiente</span>
          </div>
        </div>
      </div>
      <br>
      <?php endif; ?>

      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>


<script type="text/javascript" src="<?=base_url('assets/js/jquery.min.js') ?>"></script>
<script>
// Accordion
var baseurl = "<?=base_url()?>";
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
<script type="text/javascript" src="<?=base_url('assets/js/configurar.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/amigo.js') ?>"></script>


</body>
</html> 
