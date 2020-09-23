<!DOCTYPE html>
<html>
<title>Blacker</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">-->
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/W3CSS.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/W3CSSThemes.css'; ?>">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url_assets.'assets/css/emojionearea.min.css'; ?>">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
#cuerpoPiblicaciones a{text-decoration:none;}
#cuerpoPiblicaciones a:hover{text-decoration:underline;}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top w3-mobile" style="position: relative">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="<?php echo base_url()?>" class="w3-bar-item w3-button w3-padding-large w3-theme-d4">Blacker</a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
  <a href="<?php echo base_url('notificaciones'); ?>" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Notificaciones"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"><?php echo $notificaciones->CantNotificaciones; ?></span></a>  
  <?php if($seleccion == 'usuario'): ?>
    <form action="<?php echo base_url('inicio/buscar')?>" method="POST">
    <input class="w3-input w3-bar-item w3-mobile w3-padding-large w3-border " type="text" id="buscador" name="publicarBusqueda" placeholder="<?php echo $buscar ?>">
    </form>
  <?php endif; ?>
  <div class="w3-dropdown-hover w3-hide-small w3-hover-white w3-right">
    <button class="w3-button w3-padding-large" title="Notifications">
      <img src="<?php echo base_url_assets.'assets/'.$foto_perfil; ?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
    </button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px; right:0">
      <a href="<?php echo base_url('login/logout'); ?>" class="w3-bar-item w3-button">Salir</a>
      <a href="<?php echo base_url('inicio/configuracion'); ?>" class="w3-bar-item w3-button">Configuracion</a>
    </div>
  </div>
   <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large" >
    <button onclick="myFunction('Demo2')" class="w3-button w3-bar-item"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Mi Grupos</button>
     <div id="Demo2" class="w3-hide w3-container" style="padding: 0">
      <?php foreach ($grupos as $value) {
        echo "<a id='btn-grupo' class='w3-button w3-block w3-theme' href='".base_url('/Grupos/verGrupo/'.urlencode(strtr($this->encrypt->encode($value->id_grupo),array('+' => '.', '=' => '-', '/' => '~'))))."'>".$value->nombre."</a>";
      } ?>
    </div>
    <a href="#" class="w3-bar-item w3-button w3-padding-large" >Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large" >Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large" >Link 3</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large" >Mi Perfil</a>
  </div>
 </div>

</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;padding-top:20px">      
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?php echo $grupo->nombre; ?></h4>
         <p class="w3-center"><img src="<?php echo base_url_assets.'assets/grupos/fotos/'.$grupo->ruta_foto; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
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
          <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('Amigos')?>"><i class="fa fa-address-book fa-fw w3-margin-right"></i> Mis Amigos</a>
          <a class="w3-button w3-block w3-theme-l1 w3-left-align" href="<?php echo base_url('albums/vistaAlbums/'.$id_cuenta)?>"><i class="fa fa-users fa-fw w3-margin-right"></i> Mis Albums</a>
        </div>      
      </div>
      <br>

    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">

      <div class='w3-container w3-card w3-white w3-round w3-margin' id='publi_$value->id_publicacion' id="descripcion"><br>
        <h4>Descripcion del grupo:</h6>
        <p><?php echo $grupo->descripcion ?></p>
      </div>
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Publicar</h6>
              <form id="frm-publicarGrupo" action="<?php echo base_url('Publicacion/publicarGrupo')?>" method="POST">
                <input hidden type="text" id="id_grupo" class="w3-border w3-padding" style="width: 100%; margin-top: 0.5rem" name="id_grupo" value="<?php echo urlencode(strtr($this->encrypt->encode($grupo->id_grupo),array('+' => '.', '=' => '-', '/' => '~')))?>">
                <textarea id="publicarTexto" name="publicarTexto" class="w3-border w3-padding" style="width: 100%" rows="3" placeholder="Publica algo"></textarea> 
                <input type="text" id="publicarVideo" class="w3-border w3-padding" style="width: 100%; margin-top: 0.5rem" name="publicarVideo" placeholder="Ingrese URL de video de youtube">
                <p style="width: 100%">Suba una foto</p>
                <input type="file" class="custom-file-input w3-border w3-padding" id="customFileLang" lang="es" name="foto" style="width: 50%">
                <button type="submit" id="btn-publicar" class="w3-button w3-theme" style="margin-top: 0.5rem"><i class="fa fa-pencil"></i>  Post</button> 
              </form>
            </div>
          </div>
        </div>
      </div>
      <div id="cuerpoPublicaciones">
        
      </div>
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Visitas a mi perfil:</p>
          <p><strong><?php echo $visitas ?></strong></p>
        </div>
      </div>
      <br>
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<script type="text/javascript" src="<?=base_url_assets.'assets/js/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?=base_url_assets.'assets/js/emojionearea.min.js'; ?>"></script>

<script>
  var baseurl = "<?=base_url()?>";
  var id_grupo = "<?php echo urlencode(strtr($this->encrypt->encode($grupo->id_grupo),array('+' => '.', '=' => '-', '/' => '~'))) ?>";
// Accordion
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
<script type="text/javascript" src="<?=base_url_assets.'assets/js/grupos.js' ?>"></script>
</body>
</html> 