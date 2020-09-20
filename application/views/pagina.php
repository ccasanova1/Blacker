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
      <img src="<?php echo base_url('assets/'.$foto_perfil); ?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
    </button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px; right:0">
      <a href="<?php echo base_url('login/logout'); ?>" class="w3-bar-item w3-button">Salir</a>
      <a href="<?php echo base_url('inicio/configuracion'); ?>" class="w3-bar-item w3-button">Configuracion</a>
    </div>
  </div>
   <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large" >
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
         <h4 class="w3-center"><?php echo $perfil->nombre_entidad; ?></h4>
         <p class="w3-center"><img src="<?php echo base_url('assets/'.$cuenta->foto_perfil); ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <?php if($premium === TRUE){echo "<p><i class='fa fa-pencil fa-fw w3-margin-right w3-text-theme'></i>Pagina Premium</p> ";} ?>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Calle: <?php if(!empty($perfil->calle)){ echo $perfil->calle;}else{ echo "Sin ninguna calle";} ?></p>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Esquina: <?php if(!empty($perfil->esquina)){ echo $perfil->esquina;}else{ echo "Sin ninguna esquina";} ?></p>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Numero Puerta: <?php if(!empty($perfil->numero)){ echo $perfil->numero;}else{ echo "Sin ninguna numero de puerta";} ?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>Pais: <?php if(!empty($cuenta->pais)){ echo $cuenta->pais;} ?></p>
          <?php if (empty($sigue->estado) AND $premium === TRUE): ?>
          <form method="POST" id="frm-seguir">
          <input class="" type="text" id="id-seguir" value="<?php echo $perfil->id_cuenta; ?>" name="seguir" hidden>
          <button class="w3-button w3-block w3-theme-d2" id="btn-seguir" title="Seguir">Seguir</button>
          </form>
          <?php elseif ($sigue->estado == 'bloqueado'): ?>
            <p class="w3-red w3-center">Bloqueado</p> 
          <?php elseif ($sigue->estado == 'siguiendo'): ?>
            <p class="w3-green w3-center">Siguiendo</p> 
            <form method="POST" id="frm-eliminar">
            <input class="" type="text" id="id-eliminar" value="<?php echo $perfil->id_cuenta; ?>" name="seguir" hidden>
            <button class="w3-button w3-block w3-red" id="btn-eliminar" title="Seguir">Dejar de seguir</button>
            </form>
          <?php endif; ?>
            
        </div>
      </div>
      <br>
        
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
  
      <div id="cuerpoPublicaciones">
        
      </div>
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Visitas: a mi perfil:</p>
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


<script src="<?=base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/emojionearea.min.js'); ?>"></script>

<script>
  var baseurl = "<?=base_url()?>";
  var sigueEstado = "<?php echo $sigue->estado ?>";
  var id_cuenta = "<?php echo $perfil->id_cuenta ?>";
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
<script src="<?=base_url('assets/js/publicarPagina.js') ?>"></script>
<script src="<?=base_url('assets/js/sigue.js') ?>"></script>
</body>
</html> 
